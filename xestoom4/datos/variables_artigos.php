<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'artigos';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar';			//Modos que pode ter
$campos_buscar	= 'titulo_gal, titulo_cas';		//Campos polos que se poden facer búsquedas



//MODO LISTADO
$listado_campos	= 'id, titulo_gal, autor, comentarios';	//Campos que se seleccionan no modo listado
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
		'titulo'	=> 'Autor',
		'datos'		=> 'autor',
		'tipo'		=> 'texto',
	),
	array(
		'titulo'	=> 'Comentarios',
		'datos'		=> 'comentarios',
		'tipo'		=> 'numero',
	),
);



//MODO MODIFICAR
$modificar_campos = 'titulo_gal, titulo_cas, descricion_gal, descricion_cas, intro_gal, intro_cas, texto_gal, texto_cas'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Título galego',
		'tipo'		=> 'text',
		'datos'		=> 'titulo_gal',
	),
	array(
		'label'		=> 'Título castellano',
		'tipo'		=> 'text',
		'datos'		=> 'titulo_cas',
	),
	array(
		'label'		=> 'Intro galego',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'intro_gal',
	),
	array(
		'label'		=> 'Intro castellano',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'intro_cas',
	),
	array(
		'label'		=> 'Texto galego',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'texto_gal',
	),
	array(
		'label'		=> 'Texto castellano',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'texto_cas',
	),
	array(
		'label'		=> 'Descrición galego',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'descricion_gal',
	),
	array(
		'label'		=> 'Descrición castellano',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'descricion_cas',
	),
);

?>