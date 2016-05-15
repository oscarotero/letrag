<?php
defined('OK') or die();


//Seleccionar os artigos todos
$datos->seleccionar('novas', "id, $c_titulo, $c_texto, data, url", 'activo = 1', 'id DESC', '');
$datos->resultado('novas', '');
?>