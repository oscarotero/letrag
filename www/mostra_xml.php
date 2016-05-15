<?php

include_once('rutas.php');

//Includes
include_once($rutas['includes_comun'].'include_erros.php');
include_once($rutas['includes_comun'].'include_sql.php');
include_once($rutas['includes_comun'].'include_variables.php');
include_once($rutas['includes_comun'].'include_datos.php');


//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Iniciar variables
$variables->rexistra('id', 'n');


//Facer a seleccion
$datos->seleccionar('tipografias_mostras | tipografias_mostras_seccions', 'url | nome', 'tipografias_mostras.tipografias_mostras_seccions = tipografias_mostras_seccions.id AND tipografias_mostras.tipografias = '.$variables->variables['id'], 'tipografias_mostras_seccions.orden', '');
$resultado = $datos->resultado('', '');


//Imprimir cabeceiras
header('Content-Type: text/xml');
print('<?xml version="1.0" encoding="utf-8" ?>');
?>

<tipografias>
	<?php foreach($resultado as $valor) { ?>
	<tipo nome="<?php print($valor['nome']); ?>" url="<?php print(substr($valor['url'], 0, -4)); ?>"/>
	<?php } ?>
</tipografias>