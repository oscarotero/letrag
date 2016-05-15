<?php
defined('OK') or die();


//Variables
$variables->rexistra('seccion, similar, texto, pax, paso', 'n');
$variables->rexistra('texto', 't');


//Seleccionar por sección
if ($variables->variables['seccion']) {
	include_once($rutas['includes'].'include_datos_clasificacion.php');
	
	$datosClasificacion->taboa_productos = 'tipografias';
	$datosClasificacion->seccion = $variables->variables['seccion'];
	$datosClasificacion->seccion_actual('seccion_actual', "id, $c_nome, $c_texto");
	$datosClasificacion->productos('tipografias', "id, nome, $c_texto, ano", 'nome');
	$datosClasificacion->menu_fungallas('fungallas', "id, $c_nome, $c_texto");
	$datosClasificacion->gardar();


//Seleccionar por identificar
} else if ($variables->variables['paso']) {
	include_once($rutas['includes'].'include_datos_identificar.php');
	
	$datosIdentificar->paso = $variables->variables['paso'];
	$datosIdentificar->consulta($_GET);
	$datosIdentificar->productos('tipografias', "id, nome, $c_texto, ano", 'nome');
	$datosIdentificar->gardar();


//Seleccionar por tipografias parecidas
} else if ($variables->variables['similar']) {
	include_once($rutas['includes'].'include_datos_identificar.php');
	$datos->seleccionar('tipografias', "id, nome", 'id='.$variables->variables['similar']);
	$datos->resultado('tipografia_actual');
	
	$datosIdentificar->productos_parecidos('tipografias', "id, nome, $c_texto, ano", 'nome', $variables->variables['similar'], 10);
	$datosIdentificar->gardar();


//Seleccionar por busqueda nos textos
} else if ($variables->variables['texto']) {
	
	$query = $datos->buscar_query_automatico($variables->variables['texto'], 'tipografias', 'nome, texto_gal, texto_cas', 'nome');
	$datos->paxinado_seleccionar('tipografias', "id, nome, $c_texto, ano", $query['query'], 'nome', $variables->variables['pax'], 50);
	$datos->paxinado_resultado('tipografias');


//Listar todas as tipografias
} else {

	$datos->paxinado_seleccionar('tipografias', "id, nome, $c_texto, ano", '', 'nome', $variables->variables['pax'], 50);
	$datos->paxinado_resultado('tipografias');
}

//Seleccionar os deseñadores de cada tipografía
$in = $datos->query_in($datos->datos['tipografias'], 'id');
if ($in) {
	$datos->seleccionar('desenadores | relacions', 'id, nome | id2', "relacions.taboa1 = 'desenadores' AND relacions.taboa2 = 'tipografias' AND relacions.id2 IN ($in) AND relacions.id1 = desenadores.id", '', '');
	$datos->resultado('desenadores', '', 'id2', true);
}

$datos->datos['titulo_head'] = $datos->datos['seccion_actual'][$c_nome] ? $datos->datos['seccion_actual'][$c_nome].' - ' : $datos->datos['textos']['tipografias'].' - ';
?>