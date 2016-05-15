<?php defined('OK') or die(); ?>

				<?php
				if (!$resultado['ligazons']) {
					print($resultado['textos']['sen_resultados']);
				} else {
					foreach ($resultado['ligazons'] as $valor) {
				?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor[$c_nome], 'http://'.$valor['url'])); ?></h3>
					<p class="intro">
						<span class="direccion"><?php print(href($valor['url'], 'http://'.$valor['url'])); ?></span><br />
						<?php print($valor[$c_texto]); ?>
					</p>
				</div>
				<?php } ?>
				<?php } ?>