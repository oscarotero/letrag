<?php defined('OK') or die(); ?>
				
				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['menu_visualizador'].'</strong>', 'visualizador.php', $resultado['textos']['menu_tit_visualizador'])); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo4">
					<h1><?php print($resultado['textos']['visualizador']); ?></h1>
					<p class="descricion">
						<span><?php print($resultado['textos']['menu_tit_visualizador']); ?></span>
					</p>
				</div>
				
				<script src="<?php print($rutas['w_js']); ?>jquery_flash.js" type="text/javascript"></script>
				<script src="<?php print($rutas['w_js']); ?>pantaiacompleta.js" type="text/javascript"></script>
				
				<script type="text/javascript">
					$(document).ready(function () {
						$('#flash').flash({
							src: '<?php print($rutas['w_flash']); ?>visualizador.swf',
							width: '100%',
							height: '100%'
						});
					})
				</script>
				
				<div id="contenedor_flash">
					<div id="flash" class="abaixo2"></div>
					<a class="pantallacompleta" href=""><?php print($resultado['textos']['pantallacompleta']); ?></a>
					<a class="pantallasalir" href=""><?php print($resultado['textos']['pantallasalir']); ?></a>
				</div>