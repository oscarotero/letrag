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
				<div id="benvido" class="ancho20 arriba2">
					<div class="columna ancho3 esquerda1">
						<img src="<?php print($rutas['xw_css']); ?>benvido2.png" alt="Benvido" />
					</div>
					<div class="columna ancho15 final arriba2 esquerda1">
						<h2><?php print($v_textos['inicio']['titulo']); ?></h2>
						<p>
						<?php print($v_textos['inicio']['descricion']); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>