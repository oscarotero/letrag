<?php
defined('OK') or die();


//Variables
$variables->rexistra('id, IDE', 'n');
$variables->rexistra('texto', 't');

//Redirixir se existe IDE
if ($variables->variables['IDE']) {
	header("HTTP/1.1 301 Moved Permanently");
	header('location: clasificacion.php?id='.$variables->variables['IDE']);
	exit();
}


//Includes
include_once($rutas['includes'].'include_datos_clasificacion.php');


//Datos das seccións
$datosClasificacion->taboa_seccions	= 'seccions';
$datosClasificacion->taboa_productos	= 'tipografias';
$datosClasificacion->seccion		= $variables->variables['id'];
$datosClasificacion->texto		= $variables->variables['texto'];


//Seleccionar
$fin = $datosClasificacion->seccion_actual('seccion_actual', "id, $c_nome, $c_texto");
if ($fin) { header('location: tipografias.php?seccion='.$variables->variables['id']); }

$datosClasificacion->menu_seccions('seccions', "id, $c_nome, $c_texto", $c_nome);
$datosClasificacion->menu_fungallas('fungallas', "id, $c_nome");
$datosClasificacion->gardar();

$datos->datos['titulo_head'] = $datos->datos['seccion_actual'][$c_nome] ? $datos->datos['seccion_actual'][$c_nome].' - ' : $datos->datos['textos']['clasificacion'].' - ';
?>