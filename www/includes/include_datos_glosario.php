<?php
defined('OK') or die();


/*
CONTROL DE DATOS EN SECCIÓNS E SUBSECCIÓNS, PRODUCTOS E DESCRIPCIÓN DE PRODUCTOS DE XEITO TRIDIMENSIONAL
Para casos onde haxa tres taboas relacionadas entre si (seccions, productos, descricion e relacions)
1.2
*/

class Glosario extends Datos_extend {
	var $taboa_seccions	= 'seccions';		//Táboa das seccións
	var $taboa_palabras	= 'glosario_palabras';	//Táboa das palabras
	var $taboa_descricion	= 'glosario_textos';	//Táboa das descricións
	var $taboa_relacions	= 'glosario';		//Táboa de relacións
	var $seccions_todas	= array();		//Array con todas as seccións
	var $seccion		= 0;			//Sección actual
	var $texto		= '';			//Texto actual
	var $letra		= '';			//Letra actual (para buscar palabras que comecen por esa letra)
	var $campos_buscar	= 'nome_gal, nome_cas';	//Campos polos que se busca
	var $campo_letra	= 'nome_gal';		//Campo polo que se busca por letra
	var $palabra		= 0;			//Palabra actual
	
	
	//Obter os datos para construir un menú de fungallas
	function menu_fungallas ($array = 'menu_fungallas', $campos = 'id, nome_gal', $id = '') {
		
		if (!$id) {
			$id = $this->seccion;
		}
		
		if ($id) {
			$resultado = $this->fungallas('', $this->taboa_relacions, $id, $campos, $this->taboa_seccions);
			
			//Gardar array ou devolver resultado
			if ($array) {
				$this->datos[$array] = $resultado;
			} else {
				return $resultado;
			}
		}
	}
	
	
	//Obten os datos da sección actual
	function seccion_actual ($array = 'seccion_actual', $campos = 'id, nome_gal, texto_gal') {
		
		if ($this->seccion) {
		
			//Seleccionar a sección actual
			if ($this->seccion) {
				$this->seleccionar($this->taboa_seccions, "$campos, fin", "taboa_relacion = '$this->taboa_relacions' AND id = $this->seccion AND activo = 1");
				$resultado = $this->resultado();
			}
			
			//Gardar array ou devolver resultado
			if ($array) {
				$this->datos[$array] = $resultado;
			} else {
				return($resultado);
			}
			
			//Devolve se é o final das subseccións
			return $resultado['fin'];
		}
	}
	
	
	//Devolve os productos clasificados dentro da sección actual
	function productos ($array = 'resultado', $campos = 'id, nome', $orde = '') {
		
		//Facer a selección
		if ($orde) {
			$orde = "$this->taboa_palabras.$orde";
		}
		
		if ($this->texto) {
			$query = $this->buscar_query_like($this->texto, $this->taboa_palabras, $this->campos_buscar);
			$this->seleccionar($this->taboa_palabras, $campos, $query['query'], $orde, '');
		} else if ($this->letra) {
			$this->seleccionar($this->taboa_palabras, $campos, "$this->campo_letra LIKE '$this->letra%'", $orde, '');
		} else if ($this->seccion) {
			$this->seleccionar("$this->taboa_relacions | $this->taboa_palabras", " | $campos", "$this->taboa_relacions.$this->taboa_seccions = $this->seccion AND $this->taboa_relacions.$this->taboa_palabras = $this->taboa_palabras.id", $orde, '');
		}
		
		$resultado = $this->resultado('', '');
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return $resultado;
		}
	}
	
	
	//Devolve todos os datos dunha palabra
	function palabra ($array = 'glosario', $campos_palabra = 'id, nome', $campos_textos = 'texto', $campos_fungallas = 'id, nome') {
		$resultado = array();
		
		
		//Seleccionar a palabra
		$this->seleccionar($this->taboa_palabras, $campos_palabra, "id = $this->palabra");
		$resultado['palabra'] = $this->resultado();
		
		
		//Seleccionar as definicións da palabra
		$this->seleccionar("$this->taboa_descricion | $this->taboa_relacions", "$campos_textos | $this->taboa_descricion, $this->taboa_seccions", "$this->taboa_relacions.$this->taboa_palabras = $this->palabra AND $this->taboa_relacions.$this->taboa_descricion = $this->taboa_descricion.id", '', '');
		$resultado['definicions'] = $this->resultado('', '', $this->taboa_descricion);
		
		
		//Seleccionar sinónimos de cada definición
		$definicions = $this->query_in($resultado['definicions']);
		if ($definicions) {
			$this->seleccionar("$this->taboa_palabras | $this->taboa_relacions", "$campos_palabra | $this->taboa_descricion", "$this->taboa_relacions.$this->taboa_descricion IN ($definicions) AND $this->taboa_relacions.$this->taboa_palabras != $this->palabra AND $this->taboa_relacions.$this->taboa_palabras = $this->taboa_palabras.id", '', '');
		}
		
		foreach ($this->resultado('', '', $this->taboa_descricion) as $clave => $valor) {
			$resultado['definicions'][$clave]['sinonimos'][] = $valor;
		}
		
		
		//Seleccionar menu fungallas de cada definición
		foreach ($resultado['definicions'] as $clave => $valor) {
			$resultado['definicions'][$clave]['fungallas'] = $this->menu_fungallas('', $campos_fungallas, $valor[$this->taboa_seccions]);
		}
		
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return $resultado;
		}
	}
	
	
	//Garda todo na clase Datos
	function gardar () {
		global $datos;
		$datos->engadir($this->datos);
		$this->datos = array();
	}
}
$datosGlosario = new Glosario;
?>