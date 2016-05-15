<?php
defined('OK') or die();

//v.1.0

//Incluír a clase
include_once ($rutas['x_includes'].'include_datos_xestoom_respostas.php');

//Introducir os datos
$datosXestoomRespostas->xestoom_taboa_preguntas	= $taboa;
$datosXestoomRespostas->xestoom_campo_preguntas	= $campo_preguntas;
$datosXestoomRespostas->xestoom_taboa_respostas	= $taboa_respostas;
$datosXestoomRespostas->xestoom_campo_respostas	= $campo_respostas;
$datosXestoomRespostas->xestoom_taboa_relacions	= $taboa_relacions;

$datosXestoomRespostas->xestoom_taboa_producto	= $variables->variables['v_relacion'];
$datosXestoomRespostas->xestoom_seccion		= $variables->variables['v_seccion'];
$datosXestoomRespostas->xestoom_relacion_id	= $variables->variables['v_id'];


//Facer a relación se se enviou o formulario
if ($variables->variables['v_accion'] == 'relacionar') {
	$datosXestoomRespostas->accion_relacionar();
}


//Listar as preguntas e respostas
$datosXestoomRespostas->listar();


//Plantillas
$plantillas['base']		= 'base_pestana.php';
$plantillas['head']		= 'head_respostas.php';
$plantillas['contido']		= 'operacions_respostas.php';
$plantillas['cabeceira']	= 'cabeceira.php';
$plantillas['menu']		= 'menu.php';

$datosXestoomRespostas->datos['plantillas'] = $plantillas;


//Gardar os datos
$datosXestoomRespostas->gardar();
?>