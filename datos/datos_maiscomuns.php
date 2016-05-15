<?php
defined('OK') or die();


//Variables
$variables->rexistra('pax, id', 'n');
$variables->rexistra('texto', 't');


//Seleccionar as tipografias
if ($variables->variables['id']) {
	$datos->seleccionar('tipografias', 'nome', 'id = '.$variables->variables['id']);
	$datos->resultado('tipografia');
	$query = 'tipografias = '.$variables->variables['id'];
} else if ($variables->variables['texto']) {
	$query = "nome LIKE '%".$variables->variables['texto']."%'";
}
$datos->paxinado_seleccionar('tipografias_instaladas', 'nome, tipografias, hit', $query, 'hit DESC', $variables->variables['pax'], 100);
$datos->paxinado_resultado('tipografias');

$datos->datos['titulo_head'] = $datos->datos['textos']['mais_comuns'];
$datos->datos['titulo_head'] .= $datos->datos['tipografia']['nome'] ? ' ('.$datos->datos['tipografia']['nome'].') - ' : ' - ';
?>