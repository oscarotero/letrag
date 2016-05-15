<?php
defined('OK') or die();


/*
CONTROL DE VARIABLES
Controla as variables GET e POST existentes na páxina
v.2.0
*/

class Variables {
	var $variables = array();
	
	
	//Recolle unha ou varias variables GET ou POST
	function rexistra ($nomes, $tipo = 'n') {
		$array_nomes = explode(', ', $nomes);
		
		foreach ($array_nomes as $nome) {
			if ($nome) {
				$valor = $_GET[$nome] ? $_GET[$nome] : $_POST[$nome];
				if (isset($valor)) {
					switch ($tipo) {
						case 'n':
						$valor = $this->variable_n($valor);
						break;
					
						case 't':
						$valor = $this->variable_t($valor);
						break;
						
						case 'b':
						$valor = $this->variable_b($valor);
						break;
						
						case 'a':
						$valor = $this->variable_a($valor);
						break;
					}
					$this->variables[$nome] = $valor;
				}
			}
		}
	}
	
	
	//Variables de texto
	function variable_t ($valor) {
		$valor = trim(stripslashes($valor));
		$valor = str_replace("'", "\\'", $valor);
		return $valor;
	}
	
	
	//Variable numérica
	function variable_n ($valor) {
		$valor = $valor ? intval($valor) : 0;
		return $valor;
	}
	
	//Variable booleana
	function variable_b ($valor) {
		return $valor ? true : false;
	}
	
	//Variable array
	function variable_a ($valor) {
		if (is_array($valor)) {
			return $valor;
		} else {
			return false;
		}
	}
}
$variables = new Variables;
?>