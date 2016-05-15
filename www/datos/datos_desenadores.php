<?php
defined('OK') or die();


//Variables
$variables->rexistra('pax', 'n');
$variables->rexistra('texto', 't');

$query = '';
if ($variables->variables['texto']) {
	$query = $datos->buscar_query_like($variables->variables['texto'], 'desenadores', 'nome');
	$query = $query['query'];
}


//Seleccionar deseñador
$datos->paxinado_seleccionar('desenadores', 'id, nome', $query, 'nome', $variables->variables['pax'], 50);
$datos->paxinado_resultado('desenadores');

$datos->datos['titulo_head'] = $datos->datos['textos']['menu_desenadores'].' - ';
?>