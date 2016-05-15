<?php
defined('OK') or die();

//v.1.0

//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();



//Iniciar variables
$variables->rexistra('v_id, id_ant, id_seg, id, v_pax', 'n');
$variables->rexistra('v_orden, v_relacion, v_filtro, v_tipofiltro, v_campofiltro, v_accion, v_seccion, v_modo', 't');
?>