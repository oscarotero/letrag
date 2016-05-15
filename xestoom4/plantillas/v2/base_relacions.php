<?php defined('OK') or die(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="gl">

<!-- HEAD _______________________________________________________________ -->

	<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['head']); ?>
	
<!-- BODY _______________________________________________________________ -->
	
	<body>
	
		<!-- Cabeceira -->
		<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['cabeceira']); ?>
		
		<div class="paxina">
			
			<!-- Menú -->
			<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['menu']); ?>
			
			<!-- Contido -->
			<div id="contido" class="columna ancho20 final arriba1">
				
				<!-- Buscador -->
				<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['buscador']); ?>
				
				
				<!-- Menú modo -->
				<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['menu_modo']); ?>
				
				
				<!-- Información -->
				<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['informacion']); ?>
				
				
				<!-- Contido -->
				<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['contido']); ?>
				
				<!-- Relacións -->
				<?php include_once($rutas['x_plantillas'].$resultado['plantillas']['relacions']); ?>
				
			</div>
		</div>
	</body>
</html>