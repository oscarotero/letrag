<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'ligazons';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome_gal, nome_cas, url';		//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome_gal, referencia';		//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Nome',
		'datos'		=> 'nome_gal',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Referencia',
		'datos'		=> 'referencia',
		'tipo'		=> 'texto',
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome_gal, nome_cas, url, idioma, referencia, texto_gal, texto_cas'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome galego',
		'tipo'		=> 'text',
		'datos'		=> 'nome_gal',
	),
	array(
		'label'		=> 'Nome castellano',
		'tipo'		=> 'text',
		'datos'		=> 'nome_cas',
	),
	array(
		'label'		=> 'Texto galego',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto_gal',
	),
	array(
		'label'		=> 'Texto castellano',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto_cas',
	),
	array(
		'label'		=> 'Url',
		'tipo'		=> 'url',
		'datos'		=> 'url',
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
		'label'		=> 'Referencia',
		'tipo'		=> 'text',
		'datos'		=> 'referencia',
	),
);
?>