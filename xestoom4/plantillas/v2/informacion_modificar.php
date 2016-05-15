<?php defined('OK') or die(); ?>

				<div id="informacion" class="ancho20 arriba1">
					<p>
						<span><?php print($v_textos['informacion']['modificar']); ?> <strong><?php print($resultado['variables']['id']); ?></strong></span> 
						
						<?php if (!$resultado['variables']['v_id']) { ?>
						<span>
						<?php
						if ($resultado['variables']['id'] > 1) {
							print(href($v_textos['informacion']['anterior'], 'index.php', $v_textos['informacion']['id_anterior'], '', get('v_seccion, v_orden, v_pax, v_relacion, v_filtro, v_campofiltro, v_modo', 'id_ant='.$resultado['variables']['id'])));
						} else {
							print($v_textos['informacion']['anterior']);
						} ?> | <?php
						print (href($v_textos['informacion']['seguinte'], 'index.php', $v_textos['informacion']['id_seguinte'], '', get('v_seccion, v_orden, v_pax, v_relacion, v_filtro, v_campofiltro, v_modo', 'id_seg='.$resultado['variables']['id'])));
						?>
						</span>
						<?php } ?>
					</p>
				</div>