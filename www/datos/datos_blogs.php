<?php
defined('OK') or die();


//Variables
$variables->rexistra('pax', 'n');


//Seleccionar todos os blogs
$datos->paxinado_seleccionar('blogosfera', 'id, nome, descricion, url, idioma', '', 'nome', $variables->variables['pax'], 50);
$datos->paxinado_resultado('blogs');

$datos->datos['titulo_head'] = $datos->datos['textos']['blogs'].' - ';
?>