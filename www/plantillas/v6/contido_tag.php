<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['tags'].'</strong>', 'tags.php', $resultado['textos']['tit_tags']));
					print(' &gt; '.$resultado['etiqueta'][$c_nome]);
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['etiqueta'][$c_nome]); ?></h1>
					<p class="descricion"><span><?php print($resultado['textos']['tit_tag']); ?></span></p>
				</div>
				
				<div class="listado">
					<?php include_once($rutas['plantillas'].'listado_tipografias.php'); ?>
				</div>