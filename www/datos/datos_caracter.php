<?php
defined('OK') or die();


//Variables
$variables->rexistra('id, IDE', 'n');

//Redirixir se non existe id
if (!$variables->variables['id']) {
	if ($variables->variables['IDE']) {
		header("HTTP/1.1 301 Moved Permanently");
		header('location: caracter.php?id='.$variables->variables['IDE']);
		exit();
	} else {
		header('location: unicode.php');
		exit();
	}
}

//Seleccionar o caracter
$datos->seleccionar('caracteres', "id, $c_nome, nome, hexadecimal, imaxe, html_nome, caracteres_partes_unicode", 'activo = 1 AND id = '.$variables->variables['id']);
$datos->resultado('caracter');
$datos->datos['caracter']['binario'] = decbin($datos->datos['caracter']['id']);

//Seleccionar a sección á que pertence
$datos->seleccionar('caracteres_partes_unicode', "id, $c_nome", 'id = '.$datos->datos['caracter']['caracteres_partes_unicode']);
$datos->resultado('seccion');

$datos->datos['titulo_head'] = $datos->datos['caracter'][$c_nome] ? $datos->datos['caracter'][$c_nome].' - ' : $datos->datos['caracter']['nome'].' - ';
?>