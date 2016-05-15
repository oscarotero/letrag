<?php
defined('OK') or die();

//v.1.4

//DATOS PRINCIPAIS
$taboa		= 'glosario';				//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar';			//Modos que pode ter
$campos_buscar	= '';					//Campos polos que se poden facer búsquedas
$eliminar	= true;					//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, glosario_palabras, seccions';	//Campos que se seleccionan no modo listado
$listado_datos	= array(				//Datos que se mostran no listado
	array(
		'titulo'	=> 'Número',
		'datos'		=> 'id',
		'tipo'		=> 'numero',
	),
	array(
		'titulo'	=> 'Palabras',
		'datos'		=> 'glosario_palabras',
		'tipo'		=> 'referencia',
		'array'		=> 'lista_palabras',
		'campo'		=> 'nome_gal',
	),
	array(
		'titulo'	=> 'Seccions',
		'datos'		=> 'seccions',
		'tipo'		=> 'referencia',
		'array'		=> 'lista_seccions',
		'campo'		=> 'nome_gal',
	),
);



//MODO MODIFICAR
$modificar_campos = 'glosario_palabras, seccions, glosario_textos'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Id palabra',
		'tipo'		=> 'text',
		'datos'		=> 'glosario_palabras',
	),
	array(
		'label'		=> 'Id seccion',
		'tipo'		=> 'text',
		'datos'		=> 'seccions',
	),
	array(
		'label'		=> 'Id texto',
		'tipo'		=> 'text',
		'datos'		=> 'glosario_textos',
	),
);



//CONSULTAS EXTRAS
$consultas = array(
	array(
		'array'		=> 'lista_palabras',
		'tabla'		=> 'glosario_palabras',
		'campos'	=> 'id, nome_gal',
		'consulta'	=> "",
	),
	array(
		'array'		=> 'lista_seccions',
		'tabla'		=> 'seccions',
		'campos'	=> 'id, nome_gal',
		'consulta'	=> "taboa_relacion = 'glosario'",
	),
);

?>