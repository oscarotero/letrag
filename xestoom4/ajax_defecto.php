<?php

//v.1.2

//Arquivo de rutas
include_once('../rutas.php');


//Includes
include_once ($rutas['includes_comun'].'include_erros.php');
include_once ($rutas['includes_comun'].'include_sql.php');
include_once ($rutas['includes_comun'].'include_variables.php');
include_once ($rutas['includes_comun'].'include_datos.php');


//Iniciar clases
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Variables
$variables->rexistra('id', 'n');
$variables->rexistra('taboa, campo, valor, accion', 't');
$taboa	= $variables->variables['taboa'];
$campo	= $variables->variables['campo'];
$valor	= $variables->variables['valor'];
$id	= $variables->variables['id'];
$accion	= $variables->variables['accion'];

//Executar a consulta
if ($taboa && $campo && $id && $accion == 'modificar') {
	$datos->actualizar($taboa, "$campo = '$valor'", "id = $id");
	$datos->seleccionar($taboa, $campo, "id = $id");
	$resultado = $datos->resultado();
	$resultado = $resultado[$campo];

} else if ($taboa && $id && $accion == 'eliminar') {
	$datos->eliminar($taboa, "id = $id");
}


//Imprimir cabeceiras
header('Content-Type: text/xml');
print('<?xml version="1.0" encoding="utf-8" ?>');
?>

<datos>
	<dato><?php print($resultado); ?></dato>
</datos>