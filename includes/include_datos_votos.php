<?php
defined('OK') or die();


/*
VOTACIÓNS
Control de votacións
1.0
*/

class Votos extends Datos {
	var $taboa	= 'tipografias';	//Taboa onde se vota
	var $id		= 0;			//Id do rexistro que se vota
	var $estrelas	= 5;			//Número de estrelas que se pode dar
	var $puntos	= 0;			//Puntuación actual do rexistro
	var $votos	= 0;			//Número de votos do rexistro
	var $valoracion	= 0;			//Valoración media entre os puntos e os votos
	var $porcentaxe	= 0;			//Porcentaxe de puntuación tendo en conta as estrelas
	
	
	//Efectúa unha votación
	function votar () {
		$this->actualizar($this->taboa, "puntos = puntos + $this->puntos, votos = votos + 1", "id = $this->id");
		
		//Recolle os novos datos
		$this->calcular();
	}
	
	
	//Calcula todos os datos actuais do rexistro
	function calcular ($votos = '', $puntos = '') {
		
		$resultado = array();
		if ($votos && $puntos) {
			$resultado['votos'] = $votos;
			$resultado['puntos'] = $puntos;
		} else {
			$this->seleccionar($this->taboa, 'puntos, votos', "id = $this->id");
			$resultado = $this->resultado();
		}
		
		$this->votos = $resultado['votos'];
		$this->puntos = $resultado['puntos'];
		$this->valoracion = round($this->puntos/$this->votos, 2);
		$this->porcentaxe = round(($this->puntos/($this->votos * $this->estrelas)) * 100, 2);
	}
	
	
	//Garda todo na clase Datos
	function gardar () {
		$resultado = array();
		$resultado['votos']['taboa']	= $this->taboa;
		$resultado['votos']['id']	= $this->id;
		$resultado['votos']['puntos']	= $this->puntos;
		$resultado['votos']['votos']	= $this->votos;
		$resultado['votos']['valoracion'] = $this->valoracion;
		$resultado['votos']['porcentaxe'] = $this->porcentaxe;
		
		global $datos;
		$datos->engadir($resultado);
	}
}
$datosVotos = new Votos;
?>