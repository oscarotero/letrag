<?php
defined('OK') or die();


//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Seleccionar os textos
$datos->seleccionar_textos_pequenos ('textos', $c_texto, 'textos');
?>