<?php
defined('OK') or die();


//Variables
$variables->rexistra('pax', 'n');
$variables->rexistra('texto', 't');

$query = '';
if ($variables->variables['texto']) {
	$query = $datos->buscar_query_like($variables->variables['texto'], 'desenadores', 'nome_gal, nome_cas');
	$query = $query['query'];
}


//Seleccionar deseñador
$datos->paxinado_seleccionar('etiquetas', "id, $c_nome", $query, $c_nome, $variables->variables['pax'], 50);
$datos->paxinado_resultado('etiquetas');

$datos->datos['titulo_head'] = $datos->datos['textos']['tags'].' - ';
?>