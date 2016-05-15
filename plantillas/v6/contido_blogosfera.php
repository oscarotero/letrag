<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['menu_blogosfera'].'</strong>', 'blogosfera.php', $resultado['textos']['menu_tit_blogosfera'])); ?>
					
					<?php
					if ($resultado['variables']['id']) {
						print(' &gt; '.$resultado['blog_actual']['nome']);
					}
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<?php if ($resultado['variables']['id']) { ?>
					<h1><?php print($resultado['blog_actual']['nome']); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['blog_actual']['descricion']); ?>
						<?php print(href(' ('.$resultado['textos']['visitar'].')', 'http://'.$resultado['blog_actual']['url'])); ?>
						</span>
					</p>
					
					<?php } else { ?>
					<h1><?php print($resultado['textos']['blogosfera']); ?></h1>
					<p class="descricion">
						<span>
						<?php
						if ($resultado['variables']['texto']) {
							print($resultado['textos']['buscando_por'].' <em><q>'.$resultado['variables']['texto'].'</q></em>');
							print(' '.href('('.$resultado['textos']['mostrar_todo'].')', 'blogosfera.php'));
						} else {
							print($resultado['textos']['menu_tit_blogosfera']);
						}
						?>
						</span>
					</p>
					<?php } ?>
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php print(href($resultado['textos']['listado_blogs'], 'blogs.php', '', 'rcolumna'))?>
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>
				
				<div class="listado abaixo2">
				
				<?php
				if (!$resultado['posts']) {
					print($resultado['textos']['sen_resultados']);
				} else {
					foreach ($resultado['posts'] as $valor) { ?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor['titulo'], $valor['url'])); ?></h3>
					<p class="detalles"><?php print(href($valor['nome'], 'blogosfera.php', '', '', 'id='.$valor['id_blog']).' '.href($resultado['textos']['ver_mais'], 'http://'.$valor['url_blog']).'&nbsp;&nbsp;&nbsp;'.tempo($valor['data'])); ?></p>
					<p class="intro">
						<?php print($valor['texto']); ?>
						<?php print(href($resultado['textos']['ver_mais'], $valor['url'])); ?>
					</p>
				</div>
				<?php } ?>
				<?php } ?>
				
				</div>
				
				<hr class="separador" />
				<div class="navegacion abaixo2">
					<?php include($rutas['plantillas'].'paxinacion.php'); ?>
				</div>