<?php
defined('OK') or die();


//Variables
$variables->rexistra('id, IDE, pax, d, m, a', 'n');
$variables->rexistra('texto, idioma', 't');


//Redirixir se existe IDE
if ($variables->variables['IDE']) {
	header("HTTP/1.1 301 Moved Permanently");
	header('location: blogosfera.php?id='.$variables->variables['IDE']);
	exit();
}


//Includes
include_once($rutas['includes'].'include_datos_blogosfera.php');


//Datos da blogosfera
$datosBlogosfera->taboa_blogs	= 'blogosfera';
$datosBlogosfera->taboa_posts	= 'blogosfera_posts';
$datosBlogosfera->blog		= $variables->variables['id'];
$datosBlogosfera->paxina	= $variables->variables['pax'];
$datosBlogosfera->idioma	= $variables->variables['idioma'];
$datosBlogosfera->buscar	= $variables->variables['texto'];
$datosBlogosfera->dia		= $variables->variables['d'];
$datosBlogosfera->mes		= $variables->variables['m'];
$datosBlogosfera->ano		= $variables->variables['a'];


//Seleccionar
$datosBlogosfera->posts('posts');
$datosBlogosfera->gardar();

$datos->datos['titulo_head'] = $datos->datos['textos']['blogosfera'].' - ';
$datos->datos['titulo_head'] = $datos->datos['blog_actual']['nome'] ? $datos->datos['blog_actual']['nome'].' - ' : $datos->datos['textos']['blogosfera'].' - ';
?>