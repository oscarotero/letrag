<?php
defined('OK') or die();


/*
CONTROL DE DATOS EN SECCIÓNS E SUBSECCIÓNS
Navega por categorías e subcategorías de productos
1.3
*/

class Clasificacion extends Datos_extend {
	var $taboa_seccions	= 'seccions';		//Taboa das seccións
	var $taboa_productos	= 'tipografias';	//Taboa dos productos
	var $taboa_relacions	= 'relacions';		//Taboa relacions
	var $seccion		= 0;			//Sección actual
	var $texto		= '';			//Texto polo que buscar
	var $paxina		= '';			//Páxina actual
	var $limite_paxina	= 50;			//Numero de elementos por páxina
	var $campos_buscar	= 'nome_gal, nome_cas, texto_gal, texto_cas';	//Campos das seccións onde buscar
	
	
	//Obten o listado de subseccións actuais
	function menu_seccions ($array = 'menu_seccions', $campos = 'id, nome_gal, texto_gal', $orde = 'nome_gal') {
		
		//Seleccionar todas as subseccions
		if ($this->texto) {
			$query = $this->buscar_query_automatico($this->texto, $this->taboa_seccions, $this->campos_buscar);
			if ($query['campos']) {
				$orde = 'relevancia';
				$campos .= ', '.$query['campos'];
			}
			
			$this->seleccionar($this->taboa_seccions, $campos, "taboa_relacion = '$this->taboa_productos' AND ".$query['query']." AND activo = 1", $orde.' ASC', '');
		} else {
			$this->seleccionar($this->taboa_seccions, $campos, "taboa_relacion = '$this->taboa_productos' AND seccion = ".intval($this->seccion)." AND activo = 1", $orde.' ASC', '');
		}
		$resultado = $this->resultado('', '');
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return($resultado);
		}
	}
	
	
	//Obten os datos da sección actual
	function seccion_actual ($array = 'seccion_actual', $campos = 'id, nome_gal, texto_gal') {
		
		if ($this->seccion) {
			//Seleccionar a sección actual
			if ($this->seccion) {
				$this->seleccionar($this->taboa_seccions, "$campos, fin", "taboa_relacion = '$this->taboa_productos' AND id = $this->seccion AND activo = 1");
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
	
	
	//Obter os datos para construir un menú de fungallas
	function menu_fungallas ($array = 'menu_fungallas', $campos = 'id, nome_gal') {
		
		if ($this->seccion) {
		
			$resultado = $this->fungallas('', $this->taboa_productos,$this->seccion, $campos, $this->taboa_seccions);
	
			//Gardar array ou devolver resultado
			if ($array) {
				$this->datos[$array] = $resultado;
			} else {
				return $resultado;
			}
		}
	}
	
	
	//Devolve os productos clasificados dentro da sección actual
	function productos ($array = 'resultado', $campos = 'id, nome', $orde = 'nome') {
		
		//Calcular a orde dos campos na taboa relacions
		$cr = array($this->taboa_seccions, $this->taboa_productos);
		sort($cr);
		$taboa1 = $cr[0];
		$taboa2 = $cr[1];
		
		if ($taboa1 == $this->taboa_seccions) {
			$id1 = 'id1';
			$id2 = 'id2';
		} else {
			$id1 = 'id2';
			$id2 = 'id1';
		}
		
		//Facer a selección
		$this->paxinado_seleccionar("$this->taboa_relacions | $this->taboa_productos", " | $campos", "relacions.taboa1 = '$taboa1' AND relacions.taboa2 = '$taboa2' AND relacions.$id2 = $this->taboa_productos.id AND relacions.$id1 = $this->seccion", $orde, $this->paxina, $this->limite_paxina);
		
		//Gardar array ou devolver resultado
		if ($array) {
			$resultado = $this->paxinado_resultado($array);
		} else {
			return $this->paxinado_resultado('');
		}
	}
	
	
	//Garda todo na clase Datos
	function gardar () {
		global $datos;
		$datos->engadir($this->datos);
		$this->datos = array();
	}
}
$datosClasificacion = new Clasificacion;
?>