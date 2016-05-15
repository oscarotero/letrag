<?php
defined('OK') or die();


//Variables
$variables->rexistra('id, IDE', 'n');

if (!$variables->variables['id']) {
	if ($variables->variables['IDE']) {
		header("HTTP/1.1 301 Moved Permanently");
		header('location: artigo.php?id='.$variables->variables['IDE']);
		exit();
	} else {
		header('location: artigos.php');
		exit();
	}
}


//Includes
include_once($rutas['includes'].'include_datos_comentarios.php');


//Seleccionar o artigo actual
$datos->seleccionar('artigos', "id, $c_titulo, $c_intro, $c_descricion, $c_texto, autor, comentarios", 'id = '.$variables->variables['id']);
$datos->resultado('artigo');


//Clase comentarios
$datosComentarios->taboa	= 'artigos';
$datosComentarios->id		= $datos->datos['artigo']['id'];
$datosComentarios->num_comentarios = $datos->datos['artigo']['comentarios'];
$datosComentarios->listar_comentarios();
$datosComentarios->gardar();


//Seleccionar o resto de artigos
$datos->seleccionar('artigos', "id, $c_titulo, autor", 'id != '.$variables->variables['id'], 'id DESC', '');
$datos->resultado('artigos', '');

$datos->datos['titulo_head'] = $datos->datos['artigo'][$c_titulo].' - ';
?>