<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'caracteres';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome, nome_gal, nome_cas';		//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome, nome_gal, nome_cas, imaxe, activo'; //Campos que se seleccionan no modo listado
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
		'titulo'	=> 'Nome galego',
		'datos'		=> 'nome_gal',
		'tipo'		=> 'texto',
	),
	array(
		'titulo'	=> 'Nome castelán',
		'datos'		=> 'nome_cas',
		'tipo'		=> 'texto',
	),
	array(
		'titulo'	=> 'Imaxe',
		'tipo'		=> 'imaxe',
		'arquivo'	=> array('caracteres', '', 'imaxe'), //Directorio, prefixo, valor do nome
	),
	array(
		'titulo'	=> 'Activo',
		'datos'		=> 'activo',
		'tipo'		=> 'boleano',
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome_gal, nome_cas, nome, caracteres_partes_unicode, activo, arquivo'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome',
		'tipo'		=> 'text',
		'datos'		=> 'nome',
	),
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
		'label'		=> 'Seccion',
		'tipo'		=> 'select',
		'datos'		=> 'caracteres_partes_unicode',
		'consulta'	=> array('lista_seccions', 'nome_gal', 'id'), //Array co listado, campo que se ensina, campo value (se se escolle unha consulta extra)
	),
	array(
		'label'		=> 'Activo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'activo',
	),
	array(
		'label'		=> 'Arquivo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'arquivo',
	),
);



//CONSULTAS EXTRAS
$consultas = array(
	array(
		'array'		=> 'lista_seccions',
		'tabla'		=> 'caracteres_partes_unicode',
		'campos'	=> 'id, nome_gal',
		'consulta'	=> "",
	),
);
?>