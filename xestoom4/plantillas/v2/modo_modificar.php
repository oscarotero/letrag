<?php defined('OK') or die(); ?>

				<div id="formulario" class="ancho20 arriba2">
					<form class="ancho20" enctype="multipart/form-data" action="index.php" method="post">
						
						<input type="hidden" name="v_accion" value="<?php print($resultado['variables']['v_modo']); ?>" />
						<?php print(hidden('id, v_seccion, v_modo, v_relacion, v_id')); ?>
						
						<?php
						$n = 0;
						foreach ($modificar_datos as $valor) {
						$n++;
						?>
						
						<?php include($rutas['x_plantillas'].'formulario_'.$valor['tipo'].'.php'); ?>
						
						<?php } ?>
						
						<hr />
						
						<fieldset>
							<input type="submit" class="formulario_submit rcolumna" value="<?php print($v_textos['modificar']['gardar']); ?>" />
							
							<?php if ($resultado['variables']['id']) { ?>
							<input type="submit" id="borrar_rexistro" class="formulario_eliminar columna" value="<?php print($v_textos['modificar']['eliminar']); ?>" />
							<input type="submit" id="copiar_rexistro" class="formulario_submit_pequeno columna" value="<?php print($v_textos['modificar']['enviar_novo']); ?>" />
							<?php } ?>
						</fieldset>
					</form>
				</div>