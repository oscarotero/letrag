<?php defined('OK') or die(); ?>

				<div id="informacion" class="ancho20 arriba1">
					<p>
						<span><strong><?php print($resultado['total']); ?></strong> <?php print($v_textos['informacion']['resultados']); ?></span>
						<span><?php print($v_textos['informacion']['paxina']); ?> <strong><?php print($resultado['paxinado']['actual']); ?></strong> / <?php print($resultado['paxinado']['total']); ?></span>
						<span><?php
						if ($resultado['paxinado']['anterior']) {
							print(href($v_textos['informacion']['anterior'], 'index.php', $v_textos['informacion']['pax_anterior'], '',  get('v_seccion, v_orden, v_relacion, v_id, v_filtro, v_campofiltro, v_modo', 'v_pax='.$resultado['paxinado']['anterior'])));
						} else {
							print($v_textos['informacion']['anterior']);
						} ?> | <?php
						if ($resultado['paxinado']['seguinte']) {
							print(href($v_textos['informacion']['seguinte'], 'index.php', $v_textos['informacion']['pax_seguinte'], '',  get('v_seccion, v_orden, v_relacion, v_id, v_filtro, v_campofiltro, v_modo', 'v_pax='.$resultado['paxinado']['seguinte'])));
						} else {
							print($v_textos['informacion']['seguinte']);
						} ?></span>
					</p>
				</div>
				
