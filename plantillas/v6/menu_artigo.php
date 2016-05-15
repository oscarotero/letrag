<?php defined('OK') or die(); ?>

				<hr class="separador" />
				
				
				<div class="arriba2 abaixo2 borrar">
					<h4><?php print($resultado['textos']['outros_artigos']); ?>:</h4>
						<ul class="menu_secundario">
						
							<?php foreach ($resultado['artigos'] as $valor) { ?>
							<li><?php print(href($valor[$c_titulo], 'artigo.php', $valor['autor'], '', 'id='.$valor['id'])) ?></li>
							<?php } ?>
						</ul>
				</div>