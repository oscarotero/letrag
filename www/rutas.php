<?php
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('expose_php', 0);

//Variable de seguridade
define('OK', 'true');



//Punto de referencia para todas as rutas posibles
$arquivos		= dirname(__FILE__);
$web			= '';
$xestor			= '/xestoom4';
$plantilla_web		= 'v6';
$plantilla_xestoom	= 'v2';



$rutas = array(

	'includes'	=> $arquivos.'/includes/',
	'includes_comun'=> $arquivos.'/includes/comun/',
	'plantillas'	=> $arquivos."/plantillas/$plantilla_web/",
	'modulos'	=> $arquivos."/modulos/",
	'datos'		=> $arquivos.'/datos/',
	'cache'		=> $arquivos.'/cache/',
	'artigos'	=> $arquivos.'/artigos/',
	'caracteres'	=> $arquivos.'/caracteres/',
	'identificar'	=> $arquivos.'/identificar/',
	
	'w'		=> $web.'/',
	'w_modulos'	=> $web.'/modulos/',
	'w_css'		=> $web."/plantillas/$plantilla_web/css/",
	'w_js'		=> $web."/plantillas/$plantilla_web/js/",
	'w_artigos'	=> $web."/artigos/",
	'w_flash'	=> $web."/flash/",
	'w_caracteres'	=> $web."/caracteres/",
	'w_identificar'	=> $web."/identificar/",
	
	'x_includes'	=> $arquivos.$xestor.'/includes/',
	'x_datos'	=> $arquivos.$xestor.'/datos/',
	'x_plantillas'	=> $arquivos.$xestor."/plantillas/$plantilla_xestoom/",
	
	'xw'		=> $web.$xestor.'/',
	'xw_css'	=> $web.$xestor."/plantillas/$plantilla_xestoom/css/",
	'xw_js'		=> $web.$xestor."/plantillas/$plantilla_xestoom/js/",

);



//Configuración
$configuracion = array();

throw new Exception('Configura a base de datos!');

$configuracion['mysql'] = array(
	'servidor'	=> 'localhost',
	'usuario'	=> '',
	'contrasinal'	=> '',
	'basedatos'	=> ''
);
?>
