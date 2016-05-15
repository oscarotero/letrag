<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['menu_desenadores'].'</strong>', 'desenadores.php', $resultado['textos']['menu_tit_desenadores']));
					print(' &gt; '.$resultado['desenador']['nome']);
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['desenador']['nome']); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['textos']['menu_tit_desenador']); ?>
						</span>
					</p>
				</div>
				
				<div class="listado">
					<?php include_once($rutas['plantillas'].'listado_tipografias.php'); ?>
				</div>
				
				<?php if ($resultado['ligazons']) { ?>
				<div class="listado">
				
				<h2 class="separador arriba2">Ligazons</h2>
				<div class="listado">
					<?php include_once($rutas['plantillas'].'listado_ligazons.php'); ?>
				</div>
				<?php } ?>