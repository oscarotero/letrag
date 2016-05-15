<?php
defined('OK') or die();

//v.1.2


//Idioma do xestor
$v_idioma = 'gal';


//Menú principal
$v_menu_principal = array(
	'artigos' => array('Artigos', '', array(
		'comentarios' => array('Comentarios', 'v_relacion=artigos'),
		)
	),
	'blogosfera' => array('Blogosfera', '', array(
		'blogosfera_posts' => array('Posts', ''),
		)
	),
	'caracteres' => array('Caracteres', '', array(
		'caracteres_partes_unicode' => array('Seccións unicode', ''),
		)
	),
	'desenadores' => array('Deseñadores', ''),
	'glosario' => array('Glosario', '', array(
		'glosario_textos' => array('Textos', ''),
		'seccions' => array('Seccions', 'v_relacion=glosario'),
		)
	),
	'glosario_palabras' => array('Glosario palabras', '', array(
		'comentarios' => array('Comentarios', 'v_relacion=glosario_palabras'),
		)
	),
	'identificar' => array('Identificar', '', array(
		'identificar_respostas' => array('Respostas', ''),
		)
	),
	'ligazons' => array('Ligazóns', '', array(
		'seccions' => array('Seccions', 'v_relacion=ligazons'),
		)
	),
	'tipografias' => array('Tipografías', '', array(
		'seccions' => array('Clasificación', 'v_relacion=tipografias'),
		'comentarios' => array('Comentarios', 'v_relacion=tipografias'),
		'tipografias_instaladas' => array('Instaladas', ''),
		'etiquetas' => array('Tags', ''),
		'tipografias_mostras_seccions' => array('Variantes', ''),
		)
	),
	'textos' => array('Textos', ''),
	'comentarios' => array('Comentarios', ''),
	'novas' => array('Noticias', ''),
);


//Menú secundario
$v_menu_secundario = array(
	
	array('Google', array(
		array('Google Reader', 'http://www.google.com/reader/view/'),
		array('Google Analytics', 'https://www.google.com/analytics/home/?et=reset'),
		array('Google Adsense', 'https://www.google.com/adsense/'),
		array('Google Tipografía', 'http://www.google.com/coop/manage/cse/stats?cx=016719214230591524574%3Axhaxydpdfli'),
	)),
	
	array('Utilidades', array(
		array('Capturar posts', '../capturar_feed.php'),
		array('Actualizar comentarios (tipografías)', '../actualizar_comentarios.php?taboa_relacion=tipografias'),
		array('Actualizar comentarios (artigos)', '../actualizar_comentarios.php?taboa_relacion=artigos'),
		array('Actualizar comentarios (glosario)', '../actualizar_comentarios.php?taboa_relacion=glosario_palabras'),
	)),
	
	array('Servidor', array(
		array('phpMyAdmin', 'http://letrag.com:2082/3rdparty/phpMyAdmin/index.php'),
		array('cPanel', 'http://letrag.com:2082/frontend/x/index.html'),
		array('Arquivos', 'http://devaio.com:2082/frontend/x/files/index.html'),
	)),
);


/*
Relacións entre as distintas seccións
 * modo 1: (x, x) xenérica - usa a táboa 'relacións'
 * modo 2: (1, x) xenérica - usa os campos taboa_relacion e id_relacion
 * modo 3: (x, 1) xenérica - modo inverso ó modo 2
 * modo 4: (1, x) especial - usa un campo co mesmo nome que a taboa coa que se relaciona
 * modo 5: (x, 1) especial - modo inverso ó modo 4
*/
$variables->rexistra('v_relacion', 't');
$relacions = array (
	'artigos' => array(
		'titulo' => 'Artigos',
		'relacions' => array (
		),
	),
	'blogosfera' => array(
		'titulo' => 'Blogosfera',
		'relacions' => array (
			'blogosfera_posts' => array('modo' => 4),
		),
	),
	'caracteres' => array(
		'titulo' => 'Caracteres',
		'relacions' => array (
			'caracteres_partes_unicode' => array('modo' => 5),
		),
	),
	'caracteres_partes_unicode' => array(
		'titulo' => 'Seccións unicode',
		'relacions' => array (
			'caracteres' => array('modo' => 4),
		),
	),
	'comentarios' => array(
		'titulo' => 'Comentarios',
		'relacions' => array (
			'tipografia' => array('modo' => 3),
			'artigos' => array('modo' => 3),
			'glosario_palabras' => array('modo' => 3),
		),
	),
	'blogosfera_posts' => array(
		'titulo' => 'Posts',
		'relacions' => array (
			'blogosfera' => array('modo' => 5),
		),
	),
	'desenadores' => array(
		'titulo' => 'Deseñadores',
		'relacions' => array (
			'ligazons' => array('modo' => 1),
			'tipografias' => array('modo' => 1),
		),
	),
	'etiquetas' => array(
		'titulo' => 'Tags',
		'relacions' => array (
			'tipografias' => array('modo' => 1),
		),
	),
	'identificar' => array(
		'titulo' => 'Identificar',
		'relacions' => array (
			'identificar_respostas' => array('modo' => 4),
		),
	),
	'identificar_respostas' => array(
		'titulo' => 'Respostas',
		'relacions' => array (
			'identificar' => array('modo' => 5),
		),
	),
	'ligazons' => array(
		'titulo' => 'Ligazóns',
		'relacions' => array (
			'seccions' => array('modo' => 1),
		),
	),
	'tipografias' => array(
		'titulo' => 'Tipografías',
		'relacions' => array (
			'desenadores' => array('modo' => 1),
			'comentarios' => array('modo' => 2),
			'seccions' => array('modo' => 1),
			'tipografias_instaladas' => array('modo' => 4),
			'etiquetas' => array('modo' => 1),
			'ligazons' => array('modo' => 1),
			'tipografias_mostras' => array('modo' => 4),
			'identificar' => array('v_operacions' => 'respostas'),
		),
	),
	'glosario' => array(
		'titulo' => 'Glosario',
		'relacions' => array (
			'glosario_textos' => array('modo' => 5),
			'glosario_palabras' => array('modo' => 5),
			'seccions' => array('modo' => 5),
		),
	),
	'glosario_textos' => array(
		'titulo' => 'Textos',
		'relacions' => array (
		),
	),
	'glosario_palabras' => array(
		'titulo' => 'Palabras',
		'relacions' => array (
			'comentarios' => array('modo' => 2),
		),
	),
	'tipografias_instaladas' => array(
		'titulo' => 'Instaladas',
		'relacions' => array (
			'tipografias' => array('modo' => 5),
		),
	),
	'tipografias_mostras_seccions' => array(
		'titulo' => 'Variantes',
		'relacions' => array (
			'tipografias_mostras' => array('modo' => 4),
		),
	),
	'tipografias_mostras' => array(
		'titulo' => 'Arquivos flash',
		'relacions' => array (
			'tipografias' => array('modo' => 5),
			'tipografias_mostras_seccions' => array('modo' => 5),
		),
	),
	'seccions' => array(
		'titulo' => 'Seccións',
		'relacions' => array (
			'ligazons' => array('modo' => 1),
			'tipografias' => array('modo' => 1),
			'glosario_palabras' => array('v_operacions' => 'triple_relacion'),
			'glosario_textos' => array('v_operacions' => 'triple_relacion'),
		),
	),
	'textos' => array(
		'titulo' => 'Textos',
		'relacions' => array (
		),
	),
);
?>