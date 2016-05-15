<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['menu_artigos'].'</strong>', 'artigos.php', $resultado['textos']['menu_tit_artigos'])); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['artigo'][$c_titulo]); ?></h1>
					
					<p class="descricion abaixo1">
						<?php print($resultado['artigo']['autor']); ?>
					</p>
					<p class="intro">
						<span>
						<?php print($resultado['artigo'][$c_intro]); ?>
						</span>
					</p>
				</div>
				
				<hr class="separador" />
				
				<div class="texto arriba2">
					<?php print($resultado['artigo'][$c_texto]); ?>
				</div>
				
				<?php if ($resultado['artigo'][$c_descricion]) { ?>
				<div class="info">
					<?php print($resultado['artigo'][$c_descricion]); ?>
				</div>
				<?php } ?>
				
				<?php include_once($rutas['plantillas'].'comentarios.php'); ?>