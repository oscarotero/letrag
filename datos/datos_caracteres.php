<?php
defined('OK') or die();


//Variables
$variables->rexistra('seccion, pax', 'n');
$variables->rexistra('texto', 't');

if (!$variables->variables['seccion'] && !$variables->variables['texto']) {
	header('location: unicode.php');
	exit();
}


//Seleccionar os caracteres por sección
if ($variables->variables['seccion']) {
	$datos->seleccionar('caracteres_partes_unicode', $c_nome, 'id = '.$variables->variables['seccion']);
	$datos->resultado('seccion_actual');
	
	$query = 'caracteres_partes_unicode = '.$variables->variables['seccion'];
	
//Seleccionar os caracteres por texto
} else if ($variables->variables['texto']) {
	$query = $datos->buscar_query_like($variables->variables['texto'], 'caracteres', 'nome, nome_gal, nome_cas');
	$query = $query['query'];
}

$datos->paxinado_seleccionar('caracteres', "id, $c_nome, nome, hexadecimal, imaxe", "activo = 1 AND $query", 'id', $variables->variables['pax'], 50);
$datos->paxinado_resultado('caracteres');

$datos->datos['titulo_head'] = $datos->datos['seccion_actual'][$c_nome] ? $datos->datos['seccion_actual'][$c_nome].' - ' : $datos->datos['textos']['caracteres'].' - ';
?>