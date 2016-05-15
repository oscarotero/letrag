<?php
defined('OK') or die();


//Variables
$variables->rexistra('id', 'n');

if (!$variables->variables['id']) {
	header('location: tags.php');
	exit();
}

//Seleccionar o tag
$datos->seleccionar('etiquetas', "id, $c_nome", 'id = '.$variables->variables['id']);
$datos->resultado('etiqueta');


//Seleccionar tipografías
$datos->seleccionar('tipografias | relacions', "id, nome, $c_texto, ano | ", "relacions.taboa1 = 'etiquetas' AND relacions.taboa2 = 'tipografias' AND relacions.id2 = tipografias.id AND relacions.id1 = ".$variables->variables['id'], 'nome', '');
$datos->resultado('tipografias', '');


//Seleccionar os deseñadores de cada tipografía
$in = $datos->query_in($datos->datos['tipografias'], 'id');
if ($in) {
	$datos->seleccionar('desenadores | relacions', 'id, nome | id2', "relacions.taboa1 = 'desenadores' AND relacions.taboa2 = 'tipografias' AND relacions.id2 IN ($in) AND relacions.id1 = desenadores.id", '', '');
	$datos->resultado('desenadores', '', 'id2', true);
}

$datos->datos['titulo_head'] = $datos->datos['etiqueta'][$c_nome].' - ';
?>