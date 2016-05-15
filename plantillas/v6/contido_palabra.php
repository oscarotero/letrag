<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['menu_glosario'].'</strong>', 'glosario.php', $resultado['textos']['menu_tit_glosario'])); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['glosario']['palabra'][$c_nome]); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['textos']['definicion_palabra']); ?>
						</span>
					</p>
				</div>
				
				<div class="listado">
				
				<?php
				$n = 0;
				foreach ($resultado['glosario']['definicions'] as $valor) {
				$n++;
				?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h2 class="separador columna anterior1"><?php print($n); ?></h2>
					<p class="detalles abaixo1">
						<?php
						print(href($resultado['textos']['menu_glosario'], 'glosario.php', $resultado['textos']['menu_tit_glosario']));
						foreach ($valor['fungallas'] as $subvalor) {
							print(' &gt; '.href($subvalor[$c_nome], 'glosario.php', '', '', 'id='.$subvalor['id']));
						}
						?>
					</p>
					<p class="intro">
						<?php print($valor[$c_texto]); ?>
					</p>
					
					<?php if ($valor['sinonimos']) { ?>
					<p class="tags arriba1">
						<?php
						print($resultado['textos']['sinonimos'].': ');
						$imprimir = array();
						foreach ($valor['sinonimos'] as $subvalor) {
							$imprimir[] = href($subvalor[$c_nome], 'palabra.php', '', '', 'id='.$subvalor['id']);
						}
						print(implode($imprimir, ', '));
						?>
					</p>
					<?php } ?>
				</div>
				<?php } ?>
				
				</div>
				
				<?php include_once($rutas['plantillas'].'comentarios.php'); ?>