<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['tags'].'</strong>', 'tags.php', $resultado['textos']['tit_tags']));
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['tags']); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['textos']['tit_tags']); ?>
						</span>
					</p>
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>
				
				<div class="listado abaixo2">
				
				<?php foreach ($resultado['etiquetas'] as $valor) { ?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor[$c_nome], 'tag.php', '', '', 'id='.$valor['id'])); ?></h3>
				</div>
				<?php } ?>
				
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>