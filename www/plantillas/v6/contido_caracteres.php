<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['unicode'].'</strong>', 'unicode.php', $resultado['textos']['tit_unicode']));
					if ($resultado['seccion_actual']) {
						print(' &gt; '.$resultado['seccion_actual'][$c_nome]);
					}
					?>
				</div>
				
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<?php if ($resultado['variables']['seccion']) { ?>
					<h1><?php print($resultado['seccion_actual'][$c_nome]); ?></h1>
					<p class="descricion">
						<span><?php print($resultado['textos']['lista_caracteres']); ?></span>
					</p>
					
					<?php } else if ($resultado['variables']['texto']) { ?>
					<h1><?php print($resultado['textos']['menu_caracteres']); ?></h1>
					<p class="descricion">
						<span><?php print($resultado['textos']['buscando_por'].' <em><q>'.$resultado['variables']['texto'].'</q></em>'); ?></span>
					</p>
					<?php } ?>
				</div>
				
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>
				
				
				<?php
				if (!$resultado['caracteres']) {
					print($resultado['textos']['sen_resultados']);
				} else {
				$n = 0;
				foreach ($resultado['caracteres'] as $valor) {
					if ($n%5) {
						$class = '';
						$separacion = '';
					} else {
						$class = 'final';
						$separacion = '<hr class="separador" />';
					}
					$n++;
				?>
				<?php print($separacion); ?>
				<div class="listado_bloque columna ancho3 <?php print($class); ?>">
					<?php
					print(href('<img src="'.$rutas['w_caracteres'].($valor['imaxe'] ? $valor['imaxe'] : 'no.png').'" width="100" height="100">', 'caracter.php', '', '', 'id='.$valor['id']).'<br />');
					print(href($valor[$c_nome] ? $valor[$c_nome] : $valor['nome'], 'caracter.php', '', '', 'id='.$valor['id']));
					?>
				</div>
				
				<?php } ?>
				<?php } ?>
				
				<hr class="separador" />
				<div class="navegacion arriba2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>