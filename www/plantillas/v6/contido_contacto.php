<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['contacto'].'</strong>', 'contacto.php', $resultado['textos']['tit_contacto'])); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['contacto']); ?></h1>
					
					<p class="descricion">
						<span><?php print($resultado['textos']['tit_contacto']); ?></span>
					</p>
				</div>
				
				<hr class="separador" />
				
				<div class="texto arriba2">
					<?php print($resultado['textos']['texto_contacto']); ?>
				</div>
				
				<?php
				if ($contacto == 'enviado') {
					print('<strong>'.$resultado['textos']['contacto_ok'].'</strong>');
				} else {
					if ($contacto == 'erro') {
						print('<strong>'.$resultado['textos']['contacto_ko'].'</strong>');
					}
				?>
				<script src="<?php print($rutas['w_js']); ?>contacto.js" type="text/javascript"></script>
				<div class="comentario arriba1 abaixo1 borrar">
					<form id="comentarios_form" action="" method="post">

					<fieldset class="invisible">
					<div class="columna ancho5">
						<input name="cspam" id="s" value="<?php print(time()); ?>" type="hidden" />
						<input name="cnome" id="formc_nome" value="<?php print($resultado['textos']['nome']); ?>" type="text" class="ancho5" />
						<input name="cdireccion" id="formc_direccion" value="<?php print($resultado['textos']['direccion']); ?>" type="text" class="ancho5" />
					</div>
					<div class="columna ancho10 final">
						<textarea name="ctexto" id="formc_texto" class="ancho10" rows="20" cols="20"><?php print($resultado['textos']['oteu_comentario']); ?></textarea>
						<input type="submit" id="formc_enviar" value="Enviar" />
					</div>
					</fieldset>
					</form>
				</div>
				<?php } ?>