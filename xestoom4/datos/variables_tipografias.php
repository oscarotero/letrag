<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'tipografias';			//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome, texto_gal, texto_cas';		//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome, comentarios';		//Campos que se seleccionan no modo listado
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
		'titulo'	=> 'comentarios',
		'datos'		=> 'comentarios',
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome, ano, descargar, texto_gal, texto_cas'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome',
		'tipo'		=> 'text',
		'datos'		=> 'nome',
	),
	array(
		'label'		=> 'Ano',
		'tipo'		=> 'text',
		'datos'		=> 'ano',
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
		'label'		=> 'Url de descarga',
		'tipo'		=> 'url',
		'datos'		=> 'descargar',
	),
);
?>