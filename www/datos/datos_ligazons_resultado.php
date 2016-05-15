<?php
defined('OK') or die();


//Variables
$variables->rexistra('seccion', 'n');
$variables->rexistra('texto', 't');

if (!$variables->variables['seccion'] && !$variables->variables['texto']) {
	header('location: ligazons.php');
}


//Buscar por sección
if ($variables->variables['seccion']) {
	include_once($rutas['includes'].'include_datos_clasificacion.php');
	
	$datosClasificacion->taboa_productos	= 'ligazons';
	$datosClasificacion->seccion		= $variables->variables['seccion'];
	
	$datosClasificacion->seccion_actual('seccion_actual', "id, $c_nome, $c_texto");
	$datosClasificacion->productos('ligazons', "id, $c_nome, $c_texto, idioma, url", $c_nome);
	$datosClasificacion->menu_fungallas('fungallas', "id, $c_nome, $c_texto");
	$datosClasificacion->gardar();

//Buscar por texto
} else if ($variables->variables['texto']) {
	
	$query = $datos->buscar_query_automatico($variables->variables['texto'], 'ligazons', 'nome_gal, nome_cas, referencia, texto_gal, texto_cas', "$c_nome, url");
	
	if ($query['campos']) {
		$orde = 'relevancia';
		$campos = ', '.$query['campos'];
	} else {
		$orde = $c_nome;
		$campos = '';
	}
	
	$datos->seleccionar('ligazons', "id, $c_nome, $c_texto, idioma, url$campos", $query['query'], $orde, '');
	$datos->resultado('ligazons', '');
}

$datos->datos['titulo_head'] = $datos->datos['seccion_actual'][$c_nome] ? $datos->datos['seccion_actual'][$c_nome].' - ' : $datos->datos['textos']['ligazons'].' - ';
?>