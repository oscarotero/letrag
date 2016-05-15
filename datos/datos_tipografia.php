<?php
defined('OK') or die();


//Variables
$variables->rexistra('id, IDE', 'n');


//Redirixir se existe IDE
if ($variables->variables['IDE']) {
	header("HTTP/1.1 301 Moved Permanently");
	header('location: tipografia.php?id='.$variables->variables['IDE']);
	exit();
}


//Redirixir a unha tipografia aleatoria se non existe o IDE
if (!$variables->variables['id']) {
	$datos->seleccionar('tipografias', 'id', '', 'RAND()', 1);
	$id = $datos->resultado();
	header('location: '.$rutas['w'].'tipografia.php?id='.$id['id']);
	exit();
}




//Seleccionar os datos da tipografia
$datos->seleccionar('tipografias', "id, nome, ano, descargar, votos, puntos, comentarios, $c_texto", 'id = '.$variables->variables['id']);
$datos->resultado('tipografia');


//Clase votacións
include_once($rutas['includes'].'include_datos_votos.php');
				
$datosVotos->taboa	= 'tipografias';
$datosVotos->id		= $datos->datos['tipografia']['id'];
$datosVotos->calcular($datos->datos['tipografia']['votos'], $datos->datos['tipografia']['puntos']);
$datosVotos->gardar();


//Clase comentarios
include_once($rutas['includes'].'include_datos_comentarios.php');

$datosComentarios->taboa	= 'tipografias';
$datosComentarios->id		= $datos->datos['tipografia']['id'];
$datosComentarios->num_comentarios = $datos->datos['tipografia']['comentarios'];
$datosComentarios->listar_comentarios();
$datosComentarios->gardar();


//Seleccionar os deseñadores
$datos->seleccionar('desenadores | relacions', 'id, nome | ', "relacions.taboa1 = 'desenadores' AND relacions.taboa2 = 'tipografias' AND relacions.id1 = desenadores.id AND relacions.id2 = ".$variables->variables['id'], 'desenadores.nome', '');
$datos->resultado('desenadores', '');


//Seleccionar as seccións
$datos->seleccionar('seccions | relacions', 'id | ', "relacions.taboa1 = 'seccions' AND relacions.taboa2 = 'tipografias' AND relacions.id1 = seccions.id AND relacions.id2 = ".$variables->variables['id'], "seccions.$c_nome", '');
$datos->resultado('seccions', '');
foreach ($datos->datos['seccions'] as $clave => $valor) {
	$datos->datos['seccions'][$clave] = $datos->fungallas('', 'tipografias', $valor['id'], "id, $c_nome", 'seccions');
}


//Seleccionar as tipografias relacionadas
$datos->seleccionar('tipografias | relacions', 'id, nome | ', "relacions.taboa1 = 'tipografias' AND relacions.taboa2 = 'tipografias' AND ((relacions.id1 = tipografias.id AND relacions.id2 = ".$variables->variables['id'].") OR (relacions.id2 = tipografias.id AND relacions.id1 = ".$variables->variables['id']."))", 'tipografias.nome', '');
$datos->resultado('relacionadas', '');


//Seleccionar as etiquetas
$datos->seleccionar('etiquetas | relacions', "id, $c_nome | ", "relacions.taboa1 = 'etiquetas' AND relacions.taboa2 = 'tipografias' AND relacions.id1 = etiquetas.id AND relacions.id2 = ".$variables->variables['id'], "etiquetas.$c_nome", '');
$datos->resultado('etiquetas', '');


//Seleccionar ligazóns relacionadas
$in = $datos->query_in($datos->datos['desenadores'], 'id');
$datos->seleccionar('ligazons | relacions', "id, $c_nome, $c_texto, url, idioma | ", "(relacions.taboa1 = 'ligazons' AND relacions.taboa2 = 'tipografias' AND relacions.id1 = ligazons.id AND relacions.id2 = ".$variables->variables['id'].") OR (relacions.taboa1 = 'desenadores' AND relacions.taboa2 = 'ligazons' AND relacions.id2 = ligazons.id AND relacions.id1 IN ($in))", '', '');
$datos->resultado('ligazons', '');


$datos->datos['titulo_head'] = $datos->datos['tipografia']['nome'].' - ';
?>