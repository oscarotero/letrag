<?php

//Variables
$v_datos		= 'tipografias';
$v_plantilla		= 'base';
$v_plantilla_contido	= 'tipografias';

if (!empty($_GET['paso']) || !empty($_GET['similar'])) {
	$v_seccion	= 'identificar';
} else if (!empty($_GET['seccion'])) {
	$v_seccion	= 'clasificacion';
} else {
	$v_seccion	= 'tipografias';
}

$v_lugar		= 'tipografias';


//Includes
include_once('rutas.php');
include_once($rutas['includes'].'includes.php');
?>