<?php defined('OK') or die(); ?>

				<?php
				if (!$resultado['seccions']) {
					print($resultado['textos']['sen_resultados']);
				} else {
					foreach ($resultado['seccions'] as $valor) { ?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor[$c_nome], $v_seccion.'.php', '', '', 'id='.$valor['id'])); ?></h3>
					<p class="intro">
						<?php print($valor[$c_texto]); ?>
					</p>
				</div>
				<?php } ?>
				<?php } ?>