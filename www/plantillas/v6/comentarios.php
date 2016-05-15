<?php defined('OK') or die(); ?>

			<script src="<?php print($rutas['w_js']); ?>comentarios.js" type="text/javascript"></script>
					
			<div id="comentarios" class="arriba2">
				<h3 class="esquerda5"><span id="num_comentarios"><?php print($resultado['comentarios']['total']); ?></span> <?php print($resultado['textos']['comentarios']); ?>:</h3>
				
				<?php foreach ($resultado['comentarios']['comentarios'] as $valor) { ?>
				<div class="comentario arriba1 abaixo1 borrar">
					<p class="columna ancho5">
						<span class="comentario_autor"><?php print($valor['nome'] ? $valor['nome'] : $resultado['textos']['anonimo']); ?></span><br />
						<span class="comentario_direccion">
							<?php
							if ($valor['web']) {
								print(href($valor['web'], 'http://'.$valor['web']));
							} else if ($valor['email']) {
								print(href($valor['email'], 'mailto:'.$valor['email']));
							}
							?>
						</span>
					</p>

					<p class="comentario_texto columna ancho10 final">
						<?php print(nl2br($valor['texto'])); ?>
					</p>
				</div>
				<?php } ?>

				<?php /*
				
				<div class="comentario arriba1 abaixo1 borrar">
					<form id="comentarios_form" action="">

					<fieldset class="invisible">
					<div class="columna ancho5">
						<input name="id_comentarios" id="id" value="<?php print($resultado['comentarios']['id']); ?>" type="hidden" />
						<input name="t_comentarios" id="t" value="<?php print($resultado['comentarios']['taboa']); ?>" type="hidden" />
						<input name="s_comentarios" id="s" value="<?php print($resultado['comentarios']['spam']); ?>" type="hidden" />
						<input name="email" class="oculto" type="text" />
						<input name="nome_comentarios" id="formc_nome" value="<?php print($resultado['textos']['nome']); ?>" type="text" class="ancho5" />
						<input name="direccion_comentarios" id="formc_direccion" value="<?php print($resultado['textos']['direccion']); ?>" type="text" class="ancho5" />
					</div>
					<div class="columna ancho10 final">
						<textarea name="texto_comentarios" id="formc_texto" class="ancho10" rows="20" cols="20"><?php print($resultado['textos']['oteu_comentario']); ?></textarea>
						<input type="submit" id="formc_enviar" value="Enviar" />
					</div>
					</fieldset>
					</form>
				</div>

				*/ ?>
			</div>