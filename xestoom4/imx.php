<?php

//v.1.1

//Includes
include_once('../rutas.php');
include_once($rutas['includes_comun'].'include_imaxes.php');

header ("Cache-control: public, max-age=10800");

$imaxes->cache($rutas['cache']);

if ($_GET['file']) {
	$imx = $rutas[$_GET['dir']].$_GET['file'];
} else {
	$imx = $rutas['x_css'].'non_imx.png';
}

$imaxes->view($_GET['mode'], $imx, $_GET['size']);
?>