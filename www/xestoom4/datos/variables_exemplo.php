<?php
defined('OK') or die();

//v.1.4

//DATOS PRINCIPAIS
$taboa		= 'ilustradores';			//Tabla onde se gardan os datos
$taboa_relacion	= false;				//Se existe un campo onde se relaciona con outras taboas
$taboa_query	= '';					//Consulta para filtrar os rexistros que se manipulan
$modos		= 'Insertar, Listar, Relacionar';	//Modos que pode ter
$campos_buscar	= 'nome';				//Campos polos que se poden facer búsquedas
$eliminar	= false;				//Se se permite eliminar directamete o rexistro (no modo listar)



//MODO LISTADO
$listado_campos	= 'id, nome, activo';			//Campos que se seleccionan no modo listado
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
		'titulo'	=> 'Autor',
		'datos'		=> 'autor',
		'tipo'		=> 'texto',
	),
	array(
		'titulo'	=> 'Intro',
		'datos'		=> 'autor',
		'tipo'		=> 'texto_longo',
	),
	array(
		'titulo'	=> 'Activo',
		'datos'		=> 'activo',
		'tipo'		=> 'boleano',
	),
	array(
		'titulo'	=> 'Data',
		'datos'		=> 'data',
		'tipo'		=> 'data',
		'hora'		=> true,
	),
	array(
		'titulo'	=> 'Ilustrador',
		'datos'		=> 'ilustradores',
		'tipo'		=> 'referencia',
		'array'		=> 'lista_ilustradores',
		'campo'		=> 'nome',
	),
	array(
		'titulo'	=> 'Miniatura',
		'tipo'		=> 'imaxe',
		'arquivo'	=> array('imaxes', '', 'url'), //Directorio, prefixo, valor do nome
	),
);



//MODO MODIFICAR
$modificar_campos = 'nome, texto, url, seccions, usuario, contrasinal, activo, gmap_x, gmap_y, gmap_z'; //Campos que se van a modificar
$modificar_datos  = array(				//Datos que se mostran no formulario
	array(
		'label'		=> 'Nome',
		'tipo'		=> 'text',
		'datos'		=> 'nome',
		'caracteres'	=> 255,
	),
	array(
		'label'		=> 'Intro',
		'tipo'		=> 'textarea',
		'datos'		=> 'intro',
		'caracteres'	=> 255,
	),
	array(
		'label'		=> 'Texto',
		'tipo'		=> 'wysiwyg',
		'datos'		=> 'texto',
	),
	array(
		'label'		=> 'Data',
		'tipo'		=> 'data',
		'datos'		=> 'data',
		'defecto'	=> time(),
		'hora'		=> true,
	),
	array(
		'label'		=> 'Orde',
		'tipo'		=> 'orde',
		'datos'		=> 'orde',
	),
	array(
		'label'		=> 'Url',
		'tipo'		=> 'url',
		'datos'		=> 'url',
	),
	array(
		'label'		=> 'Posición',
		'tipo'		=> 'gmap',
		'prefixo'	=> 'gmap',
		'inicio'	=> array(42.867912483915305, -8.228759765625, 7), //x, y, zoom
		'key'		=> 'ABQIAAAArQUJFBEpCqHBgbMp0eMEXBT2yXp_ZAY8_ufC3CFXhHIE1NvwkxQ-9ESbD0M1trQER4et6mKPzJA1Ww',
	),
	array(
		'label'		=> 'Seccion',
		'tipo'		=> 'select',
		'datos'		=> 'seccions',
		'consulta'	=> array('lista_seccions', 'nome', 'id'), //Array co listado, campo que se ensina, campo value (se se escolle unha consulta extra)
		'array'		=> array ( //Array cos datos e o valor (no caso de ter unhas poucas opcións fixas sempre
					'valor' => 'nome',
				),
	),
	array(
		'label'		=> 'Activo',
		'tipo'		=> 'checkbox',
		'datos'		=> 'activo',
	),
	array(
		'label'		=> 'Url',
		'tipo'		=> 'imaxe',
		'datos'		=> 'url',
		'arquivo'	=> array('imaxes', '', ''), //Directorio, prefixo, valor do nome, ancho max, alto max, recortar
	),
	array(
		'label'		=> 'Arquivo',
		'tipo'		=> 'file',
		'datos'		=> 'arquivo',
		'arquivo'	=> array('arquivos', 'doc_', ''), //Directorio, prefixo, valor do nome
	),
	array(
		'tipo'		=> 'hidden',
		'datos'		=> 'tipo',
		'valor'		=> 'pequeno',
	),
);



//CONSULTAS EXTRAS
$consultas = array(
	array(
		'array'		=> 'lista_seccions',
		'tabla'		=> 'seccions',
		'campos'	=> 'id, nome',
		'consulta'	=> "taboa_relacion = 'ilustradores'",
	),
);



//OPERACIÓNS DESPOIS DE INSERTAR/ELIMINAR UN REXISTRO
$operacions = array(
	'insertar' => array(
		array(
			'dato'		=> 'id',
			'consulta'	=> 'INSERT INTO ilustracions (ilustradores, cabeceira) VALUES ({id}, 1)',
		),
	),
	'eliminar' => array(
		array(
			'dato'		=> 'id',
			'consulta'	=> 'INSERT INTO ilustracions (ilustradores, cabeceira) VALUES ({id}, 1)',
		),
	),
);


//PLUGGINS: Respostas
$campo_preguntas = 'nome_gal';
$taboa_respostas = 'identificar_respostas';
$campo_respostas = 'nome_gal';
$taboa_relacions = 'relacion_identificar_tipografias';
?>