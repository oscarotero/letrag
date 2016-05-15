<?php
defined('OK') or die();



//DATOS PRINCIPAIS
$taboa		= 'textos';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= "";					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar';			//Modos que pode ter
$campos_buscar	= 'lugar, texto_gal, texto_cas';	//Campos polos que se poden facer búsquedas
$eliminar	= true;					//Se se permite eliminar directamete o rexistro (no modo listar)



//DATOS LISTADO
$listado_campos = 'id, lugar, texto_gal, texto_cas, activo';			//Campos que se seleccionan ao listar
$listado_datos = array(					//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Lugar',
		'datos'		=> 'lugar',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Texto galego',
		'datos'		=> 'texto_gal',
		'tipo'		=> 'texto_longo',
	),
	array(
		'titulo'	=> 'Texto castelán',
		'datos'		=> 'texto_cas',
		'tipo'		=> 'texto_longo',
	),
	array(
		'titulo'	=> 'Activo',
		'datos'		=> 'activo',
		'tipo'		=> 'boleano',
	),
);



//DATOS MODIFICAR
$modificar_campos = 'lugar, activo, texto_gal, texto_cas'; //Campos que se van a modificar
$modificar_datos = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Lugar',
		'tipo'		=> 'text',
		'datos'		=> 'lugar',
	),
	array(
		'label'		=> 'Activo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'activo',
		'defecto'	=> 1,
	),
	array(
		'label'		=> 'Texto en galego',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto_gal',
	),
	array(
		'label'		=> 'Texto en castelan',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto_cas',
	),
);
?>