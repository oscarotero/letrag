<?php
defined('OK') or die();

//v.1.4

//DATOS PRINCIPAIS
$taboa		= 'novas';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar';			//Modos que pode ter
$campos_buscar	= 'titulo_gal, titulo_cas, texto_gal, texto_cas'; //Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, titulo_gal, data, activo';	//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Título',
		'datos'		=> 'titulo_gal',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Activo',
		'datos'		=> 'activo',
		'tipo'		=> 'boleano',
	),
	array(
		'titulo'	=> 'Data',
		'datos'		=> 'data',
		'tipo'		=> 'data',
		'hora'		=> true,
	),
);



//MODO MODIFICAR
$modificar_campos = 'titulo_gal, titulo_cas, texto_gal, texto_cas, data, url, activo'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Título galego',
		'tipo'		=> 'text',
		'datos'		=> 'titulo_gal',
	),
	array(
		'label'		=> 'Título castelán',
		'tipo'		=> 'text',
		'datos'		=> 'titulo_cas',
	),
	array(
		'label'		=> 'Texto galego',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'texto_gal',
	),
	array(
		'label'		=> 'Texto castelán',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'texto_cas',
	),
	array(
		'label'		=> 'Data',
		'tipo'		=> 'data',
		'datos'		=> 'data',
		'defecto'	=> time(),
		'hora'		=> true,
	),
	array(
		'label'		=> 'Url',
		'tipo'		=> 'url',
		'datos'		=> 'url',
	),
	array(
		'label'		=> 'Activo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'activo',
	),
);
?>