<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'blogosfera';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome, url, descricion';		//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome, idioma, activo';		//Campos que se seleccionan no modo listado
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
		'titulo'	=> 'Idioma',
		'datos'		=> 'idioma',
		'tipo'		=> 'texto',
	),
	array(
		'titulo'	=> 'Activo',
		'datos'		=> 'activo',
		'tipo'		=> 'boleano',
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome, url, descricion, feed, idioma, activo'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome',
		'tipo'		=> 'text',
		'datos'		=> 'nome',
	),
	array(
		'label'		=> 'Url',
		'tipo'		=> 'url',
		'datos'		=> 'url',
	),
	array(
		'label'		=> 'Feed',
		'tipo'		=> 'url',
		'datos'		=> 'feed',
	),
	array(
		'label'		=> 'Descricion',
		'tipo'		=> 'text',
		'datos'		=> 'descricion',
	),
	array(
		'label'		=> 'Idioma',
		'tipo'		=> 'select',
		'datos'		=> 'idioma',
		'array'		=> array ( //Array cos datos e o valor (no caso de ter unhas poucas opcións fixas sempre
					'a' => 'Alemán',
					'c' => 'Castelán',
					'l' => 'Catalán',
					'g' => 'Galego',
					'i' => 'Inglés',
					't' => 'Italiano',
					'p' => 'Portugués',
				),
	),
	array(
		'label'		=> 'Activo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'activo',
	),
);
?>