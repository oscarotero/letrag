<?php
defined('OK') or die();

//Includes
include_once ($rutas['includes_comun'].'include_erros.php');
include_once ($rutas['includes_comun'].'include_sql.php');
include_once ($rutas['includes_comun'].'include_variables.php');
include_once ($rutas['includes_comun'].'include_datos.php');
include_once ($rutas['includes_comun'].'include_datos_extend.php');
include_once ($rutas['includes_comun'].'include_arquivos.php');
include_once ($rutas['includes_comun'].'include_arquivos_cache.php');
include_once ($rutas['includes'].'funcions_html.php');


//Definir idioma
switch ($_SERVER['HTTP_HOST']) {
	
	case 'gl.letrag.com':
	$idioma = 'gal';
	break;
	
	case 'es.letrag.com':
	$idioma = 'cas';
	break;
	
	default:
	header('location: http://gl.letrag.com'.$_SERVER['REQUEST_URI']);
	exit();
}
define('LANG', $idioma);


//Nomes dos campos en distintos idiomas
$c_nome		= 'nome_'.LANG;
$c_texto	= 'texto_'.LANG;
$c_titulo	= 'titulo_'.LANG;
$c_intro	= 'intro_'.LANG;
$c_descricion	= 'descricion_'.LANG;


//Comprobar caché
$cache->iniciar($v_cache);

//Iniciar clases e variables
include_once ($rutas['include'].'inicializar.php');

//Iniciar arquivo de datos
if ($v_datos) {
	include_once ($rutas['datos'].'datos_'.$v_datos.'.php');
}

//Finalizar operacións
include_once ($rutas['include'].'finalizar.php');


//Importar plantilla
include_once ($rutas['plantillas'].$v_plantilla.'.php');
?>
