<?php defined('OK') or die(); ?>

	<head>
		<title><?php print($resultado['titulo_head'].'letrag'); ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="ES" />
		<meta name="author" content="Oscar Otero - https://oscarotero.com"/>
		<link type="application/rss+xml" href="rss.php" title="Novedades de letrag" rel="alternate"/>
		
		<link rel="stylesheet" href="<?php print($rutas['w_css']); ?>cssoom_screen.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php print($rutas['w_css']); ?>cssoom_print.css" type="text/css" media="print" />
		<link rel="stylesheet" href="<?php print($rutas['w_css']); ?>estilos.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php print($rutas['w_css']); ?>jcal.css" type="text/css" media="screen" />
		
		<script src="<?php print($rutas['w_js']); ?>jquery.js" type="text/javascript"></script>
		<script src="<?php print($rutas['w_js']); ?>buscar.js" type="text/javascript"></script>
	</head>