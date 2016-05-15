<?php

//Facer includes
include_once('rutas.php');
include_once($rutas['includes_comun'].'include_erros.php');
include_once($rutas['includes_comun'].'include_sql.php');
include_once($rutas['includes_comun'].'include_datos.php');
include_once($rutas['includes_comun'].'include_variables.php');


//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Variables
$variables->rexistra('taboa_relacion', 't');
$taboa_relacion = $variables->variables['taboa_relacion'] ? $variables->variables['taboa_relacion'] : 'tipografias';


$datos->seleccionar('comentarios', 'id_relacion', "taboa_relacion = '$taboa_relacion'", '', '');
$resultado = $datos->resultado('', '', 'id_relacion', true);

foreach ($resultado as $clave => $valor) {
	$total = count ($valor);
	$datos->actualizar($taboa_relacion, "comentarios = $total", "id = $clave");
}

?>