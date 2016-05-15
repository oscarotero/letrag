<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['menu_maiscomuns'].'</strong>', 'maiscomuns.php', $resultado['textos']['menu_tit_maiscomuns']));
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['mais_comuns']); ?></h1>
					<p class="descricion">
						<span>
						<?php
						if ($resultado['variables']['texto']) {
							print($resultado['textos']['buscando_por'].' <em><q>'.$resultado['variables']['texto'].'</q></em>');
							print(' '.href('('.$resultado['textos']['mostrar_todo'].')', 'maiscomuns.php'));
						} else if ($resultado['variables']['id']) {
							print($resultado['textos']['mostrar_tipografia'].' <em>'.$resultado['tipografia']['nome'].'</em>');
							print(' '.href('('.$resultado['textos']['mostrar_todo'].')', 'maiscomuns.php'));
						} else {
							print($resultado['textos']['menu_tit_maiscomuns'].'. ');
							$imprimir = str_replace('--1--', $resultado['textos']['mais_comuns_votos'], $resultado['textos']['desc_maiscomuns']);
							$imprimir = str_replace('--2--', $resultado['textos']['mais_comuns_total_tipos'], $imprimir);
							print($imprimir);
						}
						?>
						</span>
					</p>
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>
				
				<table class="maiscomuns ancho15">
				<tr>
					<th class="numero"><?php print($resultado['textos']['numero']); ?></th>
					<th class="numero"><?php print($resultado['textos']['porcentaxe']); ?></th>
					<th class="numero"><?php print($resultado['textos']['ver_mais']); ?></th>
					<th><?php print($resultado['textos']['nome']); ?></th>
				</tr>
				<?php
				$n = $resultado['paxinado']['indice'];
				$votos = $resultado['textos']['mais_comuns_votos'];
				foreach ($resultado['tipografias'] as $valor) {
				?>
				<tr>
					<td class="numero"><?php print($n); $n++; ?></td>
					<td class="numero"><?php print(round(($valor['hit']/$votos)*100).'%'); ?></td>
					
					<?php if ($valor['tipografias']) { ?>
					<td class="numero"><?php print(href($resultado['textos']['ver_mais'], 'tipografia.php', '', '', 'id='.$valor['tipografias'])); ?></td>
					<td><?php print(href($valor['nome'], 'maiscomuns.php', '', '', 'id='.$valor['tipografias'])); ?></td>
					
					<?php } else { ?>
						<td class="numero">&nbsp;</td>
						<td><?php print($valor['nome']); ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
				
				</table>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>