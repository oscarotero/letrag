<?php
defined('OK') or die();


/*
CONTROL DE DATOS DE BLOG E POSTS ARQUIVADOS
Mostra blog e posts da base de datos
v.1.2
*/

class Blogosfera extends Datos_extend {
	var $taboa_blogs	= 'blogosfera';		//Taboa onde se gardan os blogs
	var $taboa_posts	= 'blogosfera_posts';	//Taboa onde se gardan os posts
	var $blog		= 0;			//Blog actual
	var $dia		= 0;			//Día actual
	var $mes		= 0;			//Mes actual
	var $ano		= 0;			//Ano actual
	var $idioma		= 0;			//Idioma actual
	var $paxina		= 0;			//Páxina actual
	var $limite		= 50;			//Límite de posts por páxina
	var $buscar		= '';			//Texto polo que se fai unha búsqueda
	
	
	//Obten o listado de todos os blogs
	function menu_blogs ($array = 'menu_blogs') {
		
		//Seleccionar todos os blogs
		$this->seleccionar($this->taboa_blogs, 'id, nome, url', 'activo = 1', 'nome ASC', '');
		$resultado = $this->resultado('', '', 'id');
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return($resultado);
		}
	}
	
	
	//Obten o listado de posts
	function posts ($array = 'posts', $array_blog = 'blog_actual') {
		
		//Preparar consulta de categoría
		if ($this->idioma) {
			$idioma = " AND $this->taboa_blogs.idioma = '$this->idioma'";
		}
		
		//Preparar consulta de data
		if ($this->dia && $this->mes && $this->ano) {
			$tempo_fin = mktime(0, 0, 0, $this->mes, $this->dia, $this->ano);
			$tempo_inicio = mktime(0, 0, 0, $this->mes, $this->dia+1, $this->ano);
			$data = " AND $this->taboa_posts.data > $tempo_fin AND $this->taboa_posts.data < $tempo_inicio";
		} else {
			$tempo_inicio = time();
			$data = " AND $this->taboa_posts.data < $tempo_inicio";
		}
		
		//Preparar a consulta de blog
		if ($this->blog) {
			$blog = " AND $this->taboa_blogs.id = $this->blog";
		}
		
		//Preparar consulta de buscar texto
		if ($this->buscar) {
			$query_buscar = $this->buscar_query_like($this->buscar, $this->taboa_posts, 'titulo, texto');
			if ($query_buscar) {
				$buscar = 'AND '.$query_buscar['query'];
			}
		}
		
		//Orde dos resultados
		$orde = "$this->taboa_posts.data DESC";
		
		
		//Facer a consulta
		$this->paxinado_seleccionar("$this->taboa_blogs | $this->taboa_posts", 'nome, id as id_blog, url as url_blog | titulo, texto, url, data', "$this->taboa_posts.$this->taboa_blogs = $this->taboa_blogs.id $idioma $data $blog $buscar", $orde, $this->paxina, $this->limite);
		$resultado = $this->paxinado_resultado($array);
		
		//Selecciona o blog actual se existe
		if ($this->blog) {
			$this->seleccionar($this->taboa_blogs, 'nome, url, descricion', "id = $this->blog");
			$resultado_blog = $this->resultado($array_blog);
		}
		
		//Gardar array ou devolver resultado
		if ($resultado) {
			return($resultado);
		}
	}
	
	
	//Obten o listado de posts
	function blogs ($array = 'seccion_actual') {
	
	}
	
	
	//Garda todo na clase Datos
	function gardar () {
		global $datos;
		$datos->engadir($this->datos);
		$this->datos = array();
	}
}
$datosBlogosfera = new Blogosfera;
?>