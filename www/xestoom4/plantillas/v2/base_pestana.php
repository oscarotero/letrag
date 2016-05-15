<?php defined('OK') or die();

//v.1.1
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="gl">

<!-- HEAD _______________________________________________________________ -->

	<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['head']); ?>
	
<!-- BODY _______________________________________________________________ -->
	
	<body id="tab">
	
		<div class="paxina ancho20">
			
			<!-- Contido -->
			<div id="contido" class="columna ancho20 final arriba1">
				
				<!-- Buscador -->
				<?php
				if ($resultado['plantillas']['buscador']) {
					include_once($rutas['x_plantillas'].$resultado['plantillas']['buscador']);
				}
				?>
				
				
				<!-- Menú modo -->
				<?php
				if ($resultado['plantillas']['menu_modo']) {
					include_once($rutas['x_plantillas'].$resultado['plantillas']['menu_modo']);
				}
				?>
				
				
				<!-- Información -->
				<?php
				if ($resultado['plantillas']['informacion']) {
					include_once($rutas['x_plantillas'].$resultado['plantillas']['informacion']);
				}
				?>
				
				
				<!-- Contido -->
				<?php
				if ($resultado['plantillas']['contido']) {
					include_once($rutas['x_plantillas'].$resultado['plantillas']['contido']);
				}
				?>
				
			</div>
		</div>
	</body>
</html>