<?php

include_once('../rutas.php');

//Includes
include_once($rutas['includes_comun'].'include_erros.php');
include_once($rutas['includes_comun'].'include_sql.php');
include_once($rutas['includes_comun'].'include_variables.php');
include_once($rutas['includes_comun'].'include_datos.php');
include_once($rutas['includes'].'include_datos_votos.php');


//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Iniciar variables
$variables->rexistra('t_votos', 't');
$variables->rexistra('id_votos, puntos_votos', 'n');


//Clase votos
$datosVotos->taboa	= $variables->variables['t_votos'];
$datosVotos->id		= $variables->variables['id_votos'];
$datosVotos->puntos	= $variables->variables['puntos_votos'];

$datosVotos->votar();

//Imprimir cabeceiras
header('Content-Type: text/xml');
print('<?xml version="1.0" encoding="utf-8" ?>');
?>

<votacion>
	<votos><?php print($datosVotos->votos); ?></votos>
	<valoracion><?php print($datosVotos->valoracion); ?></valoracion>
	<porcentaxe><?php print($datosVotos->porcentaxe); ?></porcentaxe>
</votacion>