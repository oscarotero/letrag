<?php
defined('OK') or die();


//Variables
$variables->rexistra('seccion', 'n');
$variables->rexistra('letra, texto', 't');

if (!$variables->variables['seccion'] && !$variables->variables['letra'] && !$variables->variables['texto']) {
	header('location: glosario.php');
	exit();
}


//Includes
include_once($rutas['includes'].'include_datos_glosario.php');

//Datos do glosario
$datosGlosario->taboa_seccions	= 'seccions';
$datosGlosario->taboa_palabras	= 'glosario_palabras';
$datosGlosario->taboa_relacions	= 'glosario';
$datosGlosario->campo_letra	= $c_nome;
$datosGlosario->seccion		= $variables->variables['seccion'];
$datosGlosario->texto		= $variables->variables['texto'];
$datosGlosario->letra		= $variables->variables['letra'];

$datosGlosario->menu_fungallas('fungallas', "id, $c_nome");
$datosGlosario->seccion_actual('seccion_actual', "id, $c_nome, $c_texto");
$datosGlosario->productos('glosario', "id, $c_nome", $c_nome);

$datosGlosario->gardar();

$datos->datos['titulo_head'] = $datos->datos['seccion_actual'][$c_nome] ? $datos->datos['seccion_actual'][$c_nome].' - ' : $datos->datos['textos']['glosario'].' - ';
?>