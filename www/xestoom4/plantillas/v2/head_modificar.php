<?php defined('OK') or die();

//v.1.1
?>

	<head>
		<title><?php print($resultado['menu'][0]); ?> | <?php print($v_textos['cabeceira']['titulo']); ?></title>

		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="gl"/>
		<meta name="author" content="Oscar Otero - http://oscarotero.com"/>
		<link rel="shortcut icon" href="favicon.ico" />

		<script type="text/javascript" src="<?php print($rutas['xw_js']); ?>jquery.js"></script>
		<script type="text/javascript" src="<?php print($rutas['xw_js']); ?>javascript.js"></script>
		<script type="text/javascript" src="<?php print($rutas['xw_js']); ?>jquery-wysiwyg.js"></script>
		<script type="text/javascript" src="<?php print($rutas['xw_js']); ?>jquery-datepicker.js"></script>
		<script type="text/javascript" src="<?php print($rutas['xw_js']); ?>jquery-timeentry.js"></script>

		<link type="text/css" rel="stylesheet" href="<?php print($rutas['xw_css']); ?>framework.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php print($rutas['xw_css']); ?>framework_imprimir.css" media="print" />
		<link type="text/css" rel="stylesheet" href="<?php print($rutas['xw_css']); ?>estilos.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php print($rutas['xw_css']); ?>estilos-wysiwyg.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php print($rutas['xw_css']); ?>estilos-datepicker.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="<?php print($rutas['xw_css']); ?>estilos-timeentry.css" media="screen" />
	</head>