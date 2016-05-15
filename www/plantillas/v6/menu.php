<?php defined('OK') or die(); ?>

				<div class="arriba2 abaixo1 borrar">
					<ul class="menu_principal columna ancho3">
						<li><?php print(href($resultado['textos']['menu_clasificacion'], 'clasificacion.php', $resultado['textos']['menu_tit_clasificacion'], seleccionado('clasificacion'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_identificar'], 'identificar.php', $resultado['textos']['menu_tit_identificar'], seleccionado('identificar'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_aleatoria'], 'tipografia.php', $resultado['textos']['menu_tit_aleatoria'], seleccionado('aleatoria'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_artigos'], 'artigos.php', $resultado['textos']['menu_tit_artigos'], seleccionado('artigos'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_glosario'], 'glosario.php', $resultado['textos']['menu_tit_glosario'], seleccionado('glosario'))); ?></li>
					</ul>
					<ul class="menu_principal columna ancho4 final">
						<li><?php print(href($resultado['textos']['menu_blogosfera'], 'blogosfera.php', $resultado['textos']['menu_tit_blogosfera'], seleccionado('blogosfera'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_ligazons'], 'ligazons.php', $resultado['textos']['menu_tit_ligazons'], seleccionado('ligazons'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_visualizador'], 'visualizador.php', $resultado['textos']['menu_tit_visualizador'], seleccionado('visualizador'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_maiscomuns'], 'maiscomuns.php', $resultado['textos']['menu_tit_maiscomuns'], seleccionado('maiscomuns'))); ?></li>
						<li><?php print(href($resultado['textos']['menu_caracteres'], 'unicode.php', $resultado['textos']['menu_tit_caracteres'], seleccionado('caracteres'))); ?></li>
					</ul>
				</div>
				
				