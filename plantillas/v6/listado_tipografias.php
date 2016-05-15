<?php defined('OK') or die(); ?>

				<?php
				if (!$resultado['tipografias']) {
					print($resultado['textos']['sen_resultados']);
				} else {
					foreach ($resultado['tipografias'] as $valor) {
				?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3 class="columna ancho5"><?php print(href($valor['nome'], 'tipografia.php', '', '', 'id='.$valor['id'])); ?></h3>
					<div class="columna ancho10 final">
						<p class="detalles">
							<?php 
							foreach ($resultado['desenadores'][$valor['id']] as $subvalor) {
								print(href($subvalor['nome'], 'desenador.php', '', '', 'id='.$subvalor['id']).', ');
							}
							print($valor['ano']);
							?>
						</p>
						<p class="intro">
							<?php print(recortar(strip_tags($valor[$c_texto]), 200)); ?>
						</p>
					</div>
				</div>
				<?php } ?>
				<?php } ?>