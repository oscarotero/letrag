<?php
defined('OK') or die();



//DATOS PRINCIPAIS
$taboa		= 'seccions';				//Tabla onde se gardan os datos
$taboa_relacion	= true;					//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome_gal, nome_cas, texto_gal, texto_cas'; //Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//DATOS LISTADO
$listado_campos = 'id, nome_gal, texto_gal, taboa_relacion, activo'; //Campos que se seleccionan ao listar
$listado_datos = array(					//Datos que se mostran no listado
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
		'titulo'	=> 'Texto galego',
		'datos'		=> 'texto_gal',
		'tipo'		=> 'texto_longo',
	),
	array(
		'titulo'	=> 'Relación',
		'datos'		=> 'taboa_relacion',
		'tipo'		=> 'texto',
	),
	array(
		'titulo'	=> 'Activo',
		'datos'		=> 'activo',
		'tipo'		=> 'boleano',
	),
);



//DATOS MODIFICAR
$modificar_campos = 'seccion, nome_gal, nome_cas, activo, texto_gal, texto_cas, fin'; //Campos que se van a modificar
$modificar_datos = array(				//Datos que se mostran no formulario
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
		'label'		=> 'Texto en galego',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto_gal',
	),
	array(
		'label'		=> 'Texto en castelan',
		'tipo'		=> 'textarea',
		'datos'		=> 'texto_cas',
	),
	array(
		'label'		=> 'Seccion',
		'tipo'		=> 'select',
		'datos'		=> 'seccion',
		'consulta'	=> array('lista_seccions', 'nome_gal', 'id'), //Array co listado, campo que se ensina, campo value (se se escolle unha consulta extra)
	),
	array(
		'label'		=> 'Activo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'activo',
		'defecto'	=> 1,
	),
	array(
		'label'		=> 'Fin',
		'tipo'		=> 'checkbox',
		'datos'		=> 'fin',
		'defecto'	=> 0,
	),
);


//CONSULTAS EXTRAS
$variables->rexistra('v_relacion', 't');
$consultas = array(
	array(
		'array'		=> 'lista_seccions',
		'tabla'		=> 'seccions',
		'campos'	=> 'id, nome_gal',
		'consulta'	=> "taboa_relacion = '".$variables->variables['v_relacion']."'",
	),
);
?>