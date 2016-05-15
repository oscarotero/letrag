<?php
defined('OK') or die();

//v.1.2

//Includes
include_once ($rutas['includes_comun'].'include_erros.php');
include_once ($rutas['includes_comun'].'include_sql.php');
include_once ($rutas['includes_comun'].'include_variables.php');
include_once ($rutas['includes_comun'].'include_datos.php');
include_once ($rutas['includes_comun'].'include_datos_extend.php');
include_once ($rutas['includes_comun'].'include_arquivos.php');
include_once ($rutas['x_includes'].'funcions_html.php');


//Variables do xestoom
include_once ($rutas['x_datos'].'configuracion.php');


//Funcions html, textos
include_once ($rutas['x_includes'].'funcions_html.php');
include_once ($rutas['x_includes'].'textos_'.$v_idioma.'.php');


//Variables da sección actual
$variables->rexistra('v_seccion, v_operacions', 't');
if ($variables->variables['v_seccion']) {
	include_once ($rutas['x_datos'].'variables_'.$variables->variables['v_seccion'].'.php');
}


//Iniciar, arquivo para procesar datos (se estamos nunha seccion) e finalizar
if (!$variables->variables['v_operacions']) {
	$variables->variables['v_operacions'] = 'defecto';
}
if ($variables->variables['v_seccion']) {
	include_once ($rutas['x_includes'].'inicializar.php');
	include_once($rutas['x_includes'].'operacions_'.$variables->variables['v_operacions'].'.php');
	include_once ($rutas['x_includes'].'finalizar.php');

	//Plantillas por defecto
} else {
	$resultado = array();
	$resultado['plantillas']['base'] = 'base_inicio.php';
	$resultado['plantillas']['cabeceira'] = 'cabeceira.php';
	$resultado['plantillas']['head'] = 'head_listar.php';
	$resultado['plantillas']['menu'] = 'menu.php';
	
	$resultado['menu'][0] = 'Inicio';
	$resultado['menu']['nome_1'] = 'Benvido';
	$resultado['menu']['url_1'] = $rutas['xw'];
}
?>