<?php
defined('OK') or die();

//v.1.3

//DATOS PRINCIPAIS
$taboa		= 'glosario_textos';			//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'texto_gal, texto_cas';		//Campos polos que se poden facer búsquedas



//MODO LISTADO
$listado_campos	= 'id, texto_gal, texto_cas';		//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
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
);



//MODO MODIFICAR
$modificar_campos = 'texto_gal, texto_cas'; 		//Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
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
);
?>