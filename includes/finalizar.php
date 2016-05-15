<?php
defined('OK') or die();

$resultado = array();
$resultado = $datos->datos;
$resultado['variables'] = $variables->variables;

//Cachear o array resultado
//$cache->crear_cache_array($resultado);

$erros->imprimir();
?>
