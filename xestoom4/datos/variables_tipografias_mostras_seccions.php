<?php
defined('OK') or die();

//v.1.2

//DATOS PRINCIPAIS
$taboa		= 'tipografias_mostras_seccions';	//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome';				//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome, orden';			//Campos que se seleccionan no modo listado
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
		'titulo'	=> 'Orde',
		'datos'		=> 'orden',
		'tipo'		=> 'texto',
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome, orden'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome',
		'tipo'		=> 'text',
		'datos'		=> 'nome',
	),
	array(
		'label'		=> 'Orde',
		'tipo'		=> 'orde',
		'datos'		=> 'orden',
	),
);

?>