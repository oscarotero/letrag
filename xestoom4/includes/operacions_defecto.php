<?php
defined('OK') or die();

//v.1.3.1

//Incluír a clase
include_once ($rutas['x_includes'].'include_datos_xestoom.php');

//Introducir os datos
$datosXestoom->xestoom_taboa 		= $taboa;
$datosXestoom->xestoom_taboa_relacion	= $taboa_relacion;
$datosXestoom->xestoom_taboa_query	= $taboa_query;
$datosXestoom->xestoom_listado_campos 	= $listado_campos;
$datosXestoom->xestoom_listado_datos 	= $listado_datos;
$datosXestoom->xestoom_modificar_campos	= $modificar_campos;
$datosXestoom->xestoom_modificar_datos	= $modificar_datos;
$datosXestoom->xestoom_consultas	= $consultas;
$datosXestoom->xestoom_operacions	= $operacions;

$datosXestoom->xestoom_seccion		= $variables->variables['v_seccion'];
$datosXestoom->xestoom_modo		= $variables->variables['v_modo'];
$datosXestoom->xestoom_relacion		= $variables->variables['v_relacion'];
$datosXestoom->xestoom_relacion_id	= $variables->variables['v_id'];
$datosXestoom->xestoom_paxina		= $variables->variables['v_pax'];
$datosXestoom->xestoom_orde		= $variables->variables['v_orden'];
$datosXestoom->xestoom_filtro		= $variables->variables['v_filtro'];
$datosXestoom->xestoom_filtro_campo	= $variables->variables['v_campofiltro'];
$datosXestoom->xestoom_filtro_tipo	= $variables->variables['v_tipofiltro'];
$datosXestoom->xestoom_id		= $variables->variables['id'];
$datosXestoom->xestoom_accion		= $variables->variables['v_accion'];





$datosXestoom->iniciar();



//Accións dispoñibles
if ($datosXestoom->variable('accion')) {
	switch ($datosXestoom->variable('accion')) {
		
		case 'insertar':
		$datosXestoom->accion_insertar();
		break;
		
		case 'modificar':
		$datosXestoom->accion_modificar();
		break;
		
		case 'relacionar':
		$datosXestoom->accion_relacionar();
		break;
		
		case 'eliminar':
		$datosXestoom->accion_eliminar();
		break;
	}
}



//Modos de seleccion
switch ($datosXestoom->variable('modo')) {

	case 'listar':
	$datosXestoom->modo_listar();
	break;
	
	case 'modificar':
	$datosXestoom->modo_modificar();
	break;
	
	case 'insertar':
	$datosXestoom->modo_insertar();
	break;
	
	case 'relacionar':
	$datosXestoom->modo_relacionar();
	break;
}



//Gardar os datos
$datosXestoom->gardar();



//Plantillas de contidos
$plantillas = array();
switch ($datosXestoom->variable('modo')) {

	case 'listar':
	$plantillas['base'] = 'base_estandar.php';
	$plantillas['head'] = 'head_listar.php';
	$plantillas['informacion'] = 'informacion_listar.php';
	$plantillas['contido'] = 'modo_listar.php';
	break;
	
	case 'relacionar':
	$plantillas['base'] = 'base_estandar.php';
	$plantillas['head'] = 'head_listar.php';
	$plantillas['informacion'] = 'informacion_listar.php';
	$plantillas['contido'] = 'modo_relacionar.php';
	break;
	
	case 'insertar':
	$plantillas['base'] = 'base_estandar.php';
	$plantillas['head'] = 'head_modificar.php';
	$plantillas['informacion'] = 'informacion_insertar.php';
	$plantillas['contido'] = 'modo_modificar.php';
	break;
	
	case 'modificar':
	$plantillas['base'] = 'base_relacions.php';
	$plantillas['head'] = 'head_modificar.php';
	$plantillas['informacion'] = 'informacion_modificar.php';
	$plantillas['contido'] = 'modo_modificar.php';
	$plantillas['relacions'] = 'relacions_modificar.php';
	break;
}
$plantillas['cabeceira'] = 'cabeceira.php';
$plantillas['menu'] = 'menu.php';
$plantillas['buscador'] = 'buscador.php';
$plantillas['menu_modo'] = 'menu_modo.php';

if ($datosXestoom->variable('relacion_taboa') && $datosXestoom->variable('relacion_id')) {
	$plantillas['base'] = 'base_pestana.php';
}


//Obter titulo e subtítulo da páxina
$menu = array();

if ($v_menu_principal[$datosXestoom->variable('seccion')]) {
	$menu[1] = $datosXestoom->variable('seccion');
} else {
	$menu[2] = $datosXestoom->variable('seccion');
	
	if ($datosXestoom->variable('relacion')) {
		$menu[1] = $datosXestoom->variable('relacion');
	} else {
		foreach($v_menu_principal as $clave => $valor) {
			if (is_array($valor[2])) {
				if (array_key_exists($menu[2], $valor[2])) {
					$menu[1] = $clave;
					break;
				}
			}
		}
	}
}

$menu['nome_1'] = $v_menu_principal[$menu[1]][0];
$menu['url_1'] = 'index.php?v_seccion='.$menu[1];
if ($v_menu_principal[$menu[1]][1]) {
	$menu['url_1'] .= '&amp;'.$v_menu_principal[$menu[1]][1];
}
$menu[0] = $menu['nome_1'];

if ($menu[2]) {
	$menu['nome_2'] = $v_menu_principal[$menu[1]][2][$menu[2]][0];
	$menu['url_2'] = 'index.php?v_seccion='.$menu[2];
	if ($v_menu_principal[$menu[1]][2][$menu[2]][1]) {
		$menu['url_2'] .= '&amp;'.$v_menu_principal[$menu[1]][2][$menu[2]][1];
	}
	$menu[0] .= ' &gt; '.$menu['nome_2'];
}

$datosXestoom->engadir(array('plantillas' => $plantillas, 'menu' => $menu));



//Gardar os datos
$datosXestoom->gardar();
?>