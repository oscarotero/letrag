<?php
defined('OK') or die();

//v.1.1

$resultado = array();
$resultado = $datos->datos;
$resultado['variables'] = $variables->variables;

$erros->imprimir();

//Borrar clases
unset($erros);
unset($sql);
unset($variables);
unset($datos);
unset($arquivos);
?>