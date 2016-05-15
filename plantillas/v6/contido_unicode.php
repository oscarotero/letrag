<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['unicode'].'</strong>', 'unicode.php', $resultado['textos']['tit_unicode']));
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['unicode']); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['textos']['tit_unicode']); ?>
						</span>
					</p>
				</div>
				
				<div class="listado abaixo2">
				
				<?php foreach ($resultado['seccions'] as $valor) { ?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor[$c_nome], 'caracteres.php', '', '', 'seccion='.$valor['id'])); ?></h3>
				</div>
				<?php } ?>
				
				</div>