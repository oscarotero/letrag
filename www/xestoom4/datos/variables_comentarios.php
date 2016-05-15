<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'comentarios';			//Tabla onde se gardan os datos
$taboa_relacion	= true;					//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar';			//Modos que pode ter
$campos_buscar	= 'nome, email, texto, web';		//Campos polos que se poden facer búsquedas
$eliminar	= true;					//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome, texto';			//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Nome',
		'datos'		=> 'nome',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Texto',
		'datos'		=> 'texto',
		'tipo'		=> 'texto_longo',
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome, email, texto, web';		//Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome',
		'tipo'		=> 'text',
		'datos'		=> 'nome',
	),
	array(
		'label'		=> 'Email',
		'tipo'		=> 'text',
		'datos'		=> 'email',
	),
	array(
		'label'		=> 'Web',
		'tipo'		=> 'url',
		'datos'		=> 'web',
	),
	array(
		'label'		=> 'Texto',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto',
	),
);
?>