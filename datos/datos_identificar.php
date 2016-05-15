<?php
defined('OK') or die();


//Variables
$variables->rexistra('paso', 'n');
$variables->rexistra('mostra', 't');

if ($variables->variables['paso']) {

	//Includes
	include_once($rutas['includes'].'include_datos_identificar.php');

	//Datos de identificar
	$datosIdentificar->paso	= $variables->variables['paso'];

	//Preparar os datos
	$datosIdentificar->texto($variables->variables['mostra']);
	$datosIdentificar->consulta($_GET);

	//Obter os datos
	$datosIdentificar->pregunta('pregunta', "id, $c_nome");
	$datosIdentificar->respostas('respostas', "id, $c_nome, imaxe");
	$datosIdentificar->reconto('total');
	$datosIdentificar->gardar();
	$d_variables = $datosIdentificar->variables();
	
	//Redireccionar se hai menos de 5 tipografias atopadas ou se chegamos á última pregunta
	if ($datos->datos['total']['resultados'] <= 5 || $datos->datos['total']['preguntas'] - $variables->variables['paso'] < 0) {
		header('location: tipografias.php?'.str_replace('&amp;', '&', $d_variables));
	}

} else {
	$v_plantilla_contido = 'identificar_inicio';
}

$datos->datos['titulo_head'] = $datos->datos['textos']['identificar'].' - ';
?>