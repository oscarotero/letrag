<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['menu_blogosfera'].'</strong>', 'blogosfera.php', $resultado['textos']['menu_tit_blogosfera']));
					print(' &gt; '.$resultado['textos']['blogs']);
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['blogs']); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['textos']['tit_blogs']); ?>
						</span>
					</p>
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php print(href($resultado['textos']['volver_blogosfera'], 'blogosfera.php', '', 'rcolumna'))?>
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>
				
				<div class="listado abaixo2">
				
				<?php foreach ($resultado['blogs'] as $valor) { ?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor['nome'], 'blogosfera.php', '', '', 'id='.$valor['id'])); ?></h3>
					<p class="detalles"><?php print(href($valor['url'], 'http://'.$valor['url'])); ?></p>
					<p class="intro"><?php print($valor['descricion']); ?> (<?php print($resultado['textos']['idioma_'.$valor['idioma']]); ?>)</p>
				</div>
				<?php } ?>
				
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>