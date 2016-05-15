<?php
defined('OK') or die();


//Seleccionar as seccións dos caracteres todos
$datos->seleccionar('caracteres_partes_unicode', "id, $c_nome", '', 'id', '');
$datos->resultado('seccions', '');

$datos->datos['titulo_head'] = $datos->datos['textos']['unicode'].' - ';
?>