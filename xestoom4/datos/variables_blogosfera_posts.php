<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'blogosfera_posts';			//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'titulo, texto';			//Campos polos que se poden facer búsquedas
$eliminar	= true;					//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, titulo, data';			//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Título',
		'datos'		=> 'titulo',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Data',
		'datos'		=> 'data',
		'tipo'		=> 'data',
		'hora'		=> true,
	),
);



//MODO MODIFICAR
$modificar_campos = 'titulo, data, texto, url';		//Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Título',
		'tipo'		=> 'text',
		'datos'		=> 'titulo',
	),
	array(
		'label'		=> 'Texto',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto',
	),
	array(
		'label'		=> 'Data',
		'tipo'		=> 'data',
		'datos'		=> 'data',
		'hora'		=> true,
	),
	array(
		'label'		=> 'Url',
		'tipo'		=> 'url',
		'datos'		=> 'url',
	),
);
?>