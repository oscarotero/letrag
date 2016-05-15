<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'identificar_respostas';		//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome_gal, nome_cas';			//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome_gal, nome_cas, imaxe';	//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Nome galego',
		'datos'		=> 'nome_gal',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Nome castelán',
		'datos'		=> 'nome_cas',
		'tipo'		=> 'titulo',
	),
	array(
		'titulo'	=> 'Imaxe',
		'tipo'		=> 'imaxe',
		'arquivo'	=> array('identificar', '', 'imaxe'), //Directorio, prefixo, valor do nome
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome_gal, nome_cas, imaxe';	//Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome galego',
		'tipo'		=> 'text',
		'datos'		=> 'nome_gal',
	),
	array(
		'label'		=> 'Nome castelán',
		'tipo'		=> 'text',
		'datos'		=> 'nome_cas',
	),
	array(
		'label'		=> 'Imaxe',
		'tipo'		=> 'imaxe',
		'datos'		=> 'imaxe',
		'arquivo'	=> array('identificar', '', 'id'), //Directorio, prefixo, valor do nome, ancho max, alto max, recortar
	),
);
?>