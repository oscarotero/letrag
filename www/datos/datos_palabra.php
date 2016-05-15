<?php
defined('OK') or die();


//Variables
$variables->rexistra('id', 'n');


//Seleccionar
if ($variables->variables['id']) {
	include_once($rutas['includes'].'include_datos_glosario.php');
	
	$datosGlosario->taboa_seccions	= 'seccions';
	$datosGlosario->taboa_palabras	= 'glosario_palabras';
	$datosGlosario->taboa_relacions	= 'glosario';
	$datosGlosario->palabra		= $variables->variables['id'];
	
	$datosGlosario->palabra('glosario', "id, $c_nome, comentarios", "id, $c_texto", "id, $c_nome");
	$datosGlosario->gardar();
	
	
	//Clase comentarios
	include_once($rutas['includes'].'include_datos_comentarios.php');
	
	//Clase comentarios
	$datosComentarios->taboa	= 'glosario_palabras';
	$datosComentarios->id		= $datos->datos['glosario']['palabra']['id'];
	$datosComentarios->num_comentarios = $datos->datos['glosario']['palabra']['comentarios'];
	$datosComentarios->listar_comentarios();
	$datosComentarios->gardar();
}

//Redirixir se non hai resultados
if (!$datos->datos['glosario']['palabra'][$c_nome]) {
	header('location: glosario.php');
}

$datos->datos['titulo_head'] = $datos->datos['glosario']['palabra'][$c_nome].' - ';
?>