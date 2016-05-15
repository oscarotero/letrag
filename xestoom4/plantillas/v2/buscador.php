<?php defined('OK') or die(); ?>

				<div id="buscador" class="ancho20">
					<form action="index.php">
						<fieldset class="oculto">
							<?php print(hidden('v_seccion, v_relacion, v_id, v_modo')); ?>
					
							<select name="v_campofiltro">
								<?php foreach (explode(', ', $campos_buscar) as $valor) { ?>
								<option value="<?php print($valor); ?>" <?php if ($resultado['variables']['v_campofiltro'] == $valor) { print('selected="selected"'); } ?>><?php print($valor); ?></option>
								<?php } ?>
							</select>
							
							<select name="v_tipofiltro">
								<option value="conten" <?php if ($resultado['variables']['v_tipofiltro'] == 'conten') { print('selected="selected"'); } ?>>Conten</option>
								<option value="exacto" <?php if ($resultado['variables']['v_tipofiltro'] == 'exacto') { print('selected="selected"'); } ?>>É</option>
							</select>
							<input type="text" name="v_filtro" id="filtro" value="<?php print($resultado['variables']['v_filtro']); ?>" />
							
							<?php
							if ($resultado['variables']['v_filtro']) {
								$imx = '<img alt="'.$v_textos['buscar']['eliminar'].'" src="'.$rutas['xw_css'].'non_buscar.png" width="22" height="22" />';
								print(href($imx, 'index.php', $v_textos['buscar']['eliminar'], '', get('v_seccion, v_orden, v_relacion, v_id, v_modo')));
							}
							?>
				
							<input type="image" id="buscar" title="<?php print($v_textos['buscar']['buscar']); ?>" src="<?php print($rutas['xw_css']); ?>buscar.png" />
						</fieldset>
					</form>
				</div>