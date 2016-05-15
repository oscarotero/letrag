<?php
defined('OK') or die();

//v.1.3

//DATOS PRINCIPAIS
$taboa		= 'glosario_palabras';			//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome_gal, nome_cas';			//Campos polos que se poden facer búsquedas



//MODO LISTADO
$listado_campos	= 'id, nome_gal, nome_cas';		//Campos que se seleccionan no modo listado
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
);



//MODO MODIFICAR
$modificar_campos = 'nome_gal, nome_cas'; 		//Campos que se van a modificar
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
);
?>