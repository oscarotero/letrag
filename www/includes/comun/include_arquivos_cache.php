<?php
defined('OK') or die();


/*
CONTROL DE CACHÉ
Controla o manexo de arquivos de caché
v.1.1
*/

class Cache extends Arquivos {
	var $cache_activo = true;	//Activa ou desactiva a lectura de cache
	var $cache_crear = true;	//Activa ou desactiva a escritura de cache
	var $cache_arquivo = '';	//Nome do arquivo cache
	var $cache_directorio = '';	//Ruta do directorio da cache
	var $cache_limite = 86400;	//Limite de tempo que permanece un arquivo cache activo (12 horas por defecto)
	var $cache_texto = '';		//Contido do arquivo cache
	
	
	//Meter os datos da cache
	function iniciar ($activar = true) {
		$this->cache_activo = $this->cache_crear = $activar ? true : false;
		
		//Variables
		if ($_POST) {
			$this->cache_activo = false;
			$this->cache_crear = false;
		
		} else if ($_GET['cache']) {
			switch (trim($_GET['cache'])) {
			
				case 'non':
				$this->cache_activo = false;
				$this->cache_crear = false;
				break;
				
				case 'si':
				$this->cache_activo = true;
				$this->cache_crear = true;
				break;
				
				case 'soler':
				$this->cache_activo = true;
				$this->cache_crear = false;
				break;
				
				case 'socrear':
				$this->cache_activo = false;
				$this->cache_crear = true;
				break;
			}
		}
		
		
		//Ruta do directorio cache
		global $rutas;
		$this->cache_directorio = $rutas['cache'];
		
		//Nome do arquivo cache
		$this->cache_arquivo = md5($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	}
	
	
	//Comproba a existencia do arquivo cache
	function ler_cache_array () {
		if ($this->cache_activo) {
			//Comprobar que existe o arquivo
			if ($this->comprobar_arquivo ($this->cache_directorio.$this->cache_arquivo)) {
				$data_agora = time();
				$data_arquivo = filemtime($this->cache_directorio.$this->cache_arquivo);
				
				if ($data_agora - $data_arquivo < $this->cache_limite) {
					include ($this->cache_directorio.$this->cache_arquivo);
					return $array;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
	
	//Crea un arquivo cache de array cos resultados
	function crear_cache_array ($array_datos) {
		if (is_array($array_datos) && $this->cache_crear) {
			$this->cache_texto = '';
			$this->recorre_array($array_datos, 1);
			$this->cache_texto = "<?php\ndefined('OK') or die();\n\$array = array(".substr($this->cache_texto, 0, -1)."\n);\n?>";
			$this->escribe_texto_arquivo($this->cache_texto, $this->cache_directorio, $this->cache_arquivo.'.php');
		}
	}
	
	
	
	//Recorre recursivamente todos os elementos dun array para crear un texto multidimensional
	function recorre_array ($datos, $nivel) {
		foreach ((array)$datos as $k => $v) {
			$k = trim($k);
			if (is_array($v)) {
				$this->cache_texto .= "\n".str_repeat("\t", $nivel)."'".$k."' => array(";
				$nivel++;
				$this->recorre_array($v, $nivel);
				$nivel--;
				$this->cache_texto .= "\n".str_repeat("\t", $nivel).'),';
			} else {
				$this->cache_texto .= "\n".str_repeat("\t", $nivel)."'".$k."' => '".str_replace("'", "\\'", $v)."',";
			}
		}
	}
}

$cache = new Cache;
?>