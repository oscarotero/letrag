<?php
defined('OK') or die();


/*
CONTROL DE ERROS
Almacena todos os erros que haxa nas distintas clases
v.1.0
*/

class Erros {
	var $erros = array();
	var $arquivo;
	
	
	//Engade un novo erro
	function erro ($texto) {
		$rexistro = debug_backtrace();
		$rexistro[1]['erro'] = $texto;
		$rexistro[1]['data'] = date('Y/m/d H:i:s');
		array_push($this->erros, $rexistro[1]);
	}
	
	
	//Imprimir todos os erros
	function imprimir () {
		foreach ($this->erros as $clave => $valor) {
			print('<p>'.$valor['erro']."</p> \n");
		}
	}
	
	
	//Especifica un arquivo de texto para gardar os erros
	function arquivo ($arquivo) {
		$this->arquivo = $arquivo;
	}
	
	
	//Garda os erros nun arquivo de texto
	function gardar () {
		if ($this->erros) {
			foreach ($this->erros as $clave => $valor) {
				$texto .= '<p>'.$valor['erro']."</p> \n";
			}
			if (is_file($this->arquivo)) {
				$abrir = fopen($this->arquivo,'a+');
			} else {
				$abrir = fopen($this->arquivo,'w');
			}
			flock($abrir, LOCK_EX);
			fwrite($abrir, addslashes($texto));
			flock($abrir, LOCK_UN);
			fclose($abrir);
		}
	}
	
}
$erros = new Erros;
?>