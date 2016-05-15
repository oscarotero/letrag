<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['tipografias'].'</strong>', 'tipografias.php').' &gt; ');
					if ($v_seccion == 'clasificacion') {
						include_once($rutas['plantillas'].'fungallas.php');
					
					} else if ($v_seccion == 'identificar') {
						print(href('<strong>'.$resultado['textos']['menu_identificar'].'</strong>', 'identificar.php', $resultado['textos']['menu_tit_identificar']));
						if ($resultado['variables']['similar']) {
							print(' &gt; '.href($resultado['tipografia_actual']['nome'], 'tipografia.php', '', '', 'id='.$resultado['tipografia_actual']['id']));
						}
					}
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<?php
					if ($v_seccion == 'clasificacion' || $v_seccion == 'tipografias') {
						include_once($rutas['plantillas'].'cabeceira_seccions.php');
					} else {
						if ($resultado['variables']['similar']) {
					?>
					<h1><?php print($resultado['tipografia_actual']['nome']); ?></h1>
					<p class="descricion"><span><?php print($resultado['textos']['tit_similar']); ?></span></p>
					
					<?php } else { ?>
					<h1><?php print($resultado['textos']['identificar']); ?></h1>
					<p class="descricion"><span><?php print($resultado['textos']['identificar_resultados']); ?></span></p>
					<?php } ?>
					<?php } ?>
				</div>
				
				<?php if ($v_seccion == 'tipografias') { ?>
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include_once($rutas['plantillas'].'paxinacion.php'); ?>
				</div>
				<?php } ?>
				
				<div class="listado">
					<?php include_once($rutas['plantillas'].'listado_tipografias.php'); ?>
				</div>