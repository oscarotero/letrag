<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['menu_artigos'].'</strong>', 'artigos.php', $resultado['textos']['menu_tit_artigos'])); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['artigos']); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['textos']['menu_tit_artigos']); ?>
						</span>
					</p>
				</div>
				
				<div class="listado">
				
				<?php foreach ($resultado['artigos'] as $valor) { ?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor[$c_titulo], 'artigo.php', $valor['autor'], '', 'id='.$valor['id'])); ?></h3>
					<p class="detalles"><?php print($valor['autor']); ?></p>
					<p class="intro">
						<?php print($valor[$c_intro]); ?>
					</p>
				</div>
				<?php } ?>
				
				</div>