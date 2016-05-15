<?php
defined('OK') or die();


//Variables
$variables->rexistra('id', 'n');


//Includes
include_once($rutas['includes'].'include_datos_clasificacion.php');


//Datos das seccións
$datosClasificacion->taboa_seccions	= 'seccions';
$datosClasificacion->taboa_productos	= 'ligazons';
$datosClasificacion->seccion		= $variables->variables['id'];


//Seleccionar
$fin = $datosClasificacion->seccion_actual('seccion_actual', "id, $c_nome, $c_texto");
if ($fin) { header('location: ligazons_resultado.php?seccion='.$variables->variables['id']); }

$datosClasificacion->menu_seccions('seccions', "id, $c_nome, $c_texto", $c_nome);
$datosClasificacion->menu_fungallas('fungallas', "id, $c_nome");
$datosClasificacion->gardar();

$datos->datos['titulo_head'] = $datos->datos['seccion_actual'][$c_nome] ? $datos->datos['seccion_actual'][$c_nome].' - ' : $datos->datos['textos']['ligazons'].' - ';
?>