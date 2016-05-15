<?php defined('OK') or die(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="gl">

<!-- HEAD ____________________________________________________________________ -->
	
<?php include_once($rutas['plantillas'].'head.php'); ?>

<!-- BODY ____________________________________________________________________ -->
	
	<body>
		<div class="paxina">
			<div id="navegacion" class="rcolumna ancho9">
			<div id="en_navegacion" class="ancho7 abaixo3 esquerda1">
			
				<div class="arriba3 abaixo2">
					<h1><?php print(href($resultado['textos']['letrag'], $rutas['w'])); ?></h1>
					<p class="opcions">
						<?php print((LANG == 'gal') ? $resultado['textos']['idioma_gal'] : href($resultado['textos']['idioma_gal'], 'http://gl.letrag.com'.$_SERVER['REQUEST_URI'])); ?> | 
						<?php print((LANG == 'cas') ? $resultado['textos']['idioma_cas'] : href($resultado['textos']['idioma_cas'], 'http://es.letrag.com'.$_SERVER['REQUEST_URI'])); ?>
					</p>
				</div>
				<hr class="separador" />
				
<!-- MENÚ ____________________________________________________________________ -->
				
				<?php include_once($rutas['plantillas'].'menu.php'); ?>
				
				<hr class="separador" />
				
<!-- BUSCADOR ____________________________________________________________________ -->
				
				<?php include_once($rutas['plantillas'].'buscador.php'); ?>
				
				<?php
				if ($v_plantilla_menu) {
					include_once($rutas['plantillas']."menu_$v_plantilla_menu.php");
				}
				?>
			</div>
			</div>
			
<!-- CONTIDO ____________________________________________________________________ -->

			<div id="contido" class="columna ancho15 final arriba1 abaixo2">
				<?php include_once($rutas['plantillas']."contido_$v_plantilla_contido.php"); ?>
			</div>
			
			<hr class="separador" />
			
			<div id="pe" class="arriba3 abaixo1">
				<?php include_once($rutas['plantillas'].'pe.php'); ?>
			</div>
		</div>

<!-- GOOGLE ANALYTICS ____________________________________________________________________ -->

		
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
			var pageTracker = _gat._getTracker("UA-110819-1");
			var pageTracker = _gat._getTracker("<?php if (LANG == 'gal') { print('UA-110819-1'); } else if (LANG == 'cas') { print('UA-110819-8'); } ?>");
			pageTracker._initData();
			pageTracker._trackPageview();
		</script>
	</body>
</html>