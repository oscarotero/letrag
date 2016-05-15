<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['menu_identificar'].'</strong>', 'identificar.php', $resultado['textos']['menu_tit_identificar']));
					
					if ($resultado['variables']['mostra']) {
						print(' &gt; '.$resultado['textos']['identificar_mostra'].' <em><q>'.$resultado['variables']['mostra'].'</q></em>');
					}
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['pregunta'][$c_nome]); ?></h1>
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
				<?php
					print($resultado['total']['resultados'].' '.$resultado['textos']['identificar_atopadas']);
					print('&nbsp;&nbsp;&nbsp;'.str_replace('--1--', ($resultado['total']['preguntas']-$resultado['variables']['paso']), $resultado['textos']['identificar_restantes']));
					
					if ($resultado['total']['resultados'] <= 50) {
						print('&nbsp;&nbsp;&nbsp;'.href($resultado['textos']['mostrar_resultados'], 'tipografias.php', $resultado['textos']['tit_mostrar_resultados'], '', $d_variables));
					}
				?>
				</div>
				
				
				<div class="listado_bloque columna ancho5 <?php print($class); ?>">
					<?php
					print(href('<img src="'.$rutas['w_identificar'].'0.png" width="150" height="150">', 'identificar.php', '', '', $d_variables).'<br />');
					print(href($resultado['textos']['saltar_pregunta'], 'identificar.php', '', '', $d_variables));
					?>
				</div>
				
				
				<?php
				$n = 2;
				foreach ($resultado['respostas'] as $valor) {
					if ($n%3) {
						$class = '';
						$separacion = '';
					} else {
						$class = 'final';
						$separacion = '<hr class="separador" />';
					}
					$n++;
				?>
				<div class="listado_bloque columna ancho5 <?php print($class); ?>">
					<?php
					print(href('<img src="'.$rutas['w_identificar'].$valor['imaxe'].'" width="150" height="150">', 'identificar.php', '', '', $resultado['pregunta']['id'].'='.$valor['id'].'&amp;'.$d_variables).'<br />');
					print(href($valor[$c_nome], 'identificar.php', '', '', $resultado['pregunta']['id'].'='.$valor['id'].'&amp;'.$d_variables));
					?>
				</div>
				<?php print($separacion); ?>
				<?php } ?>
