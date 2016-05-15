<?php
defined('OK') or die();


//Seleccionar os artigos todos
$datos->seleccionar('artigos', "id, $c_titulo, $c_intro, autor", '', 'id DESC', '');
$datos->resultado('artigos', '');

$datos->datos['titulo_head'] = $datos->datos['textos']['artigos'].' - ';
?>