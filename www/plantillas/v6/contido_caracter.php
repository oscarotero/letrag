<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					print(href('<strong>'.$resultado['textos']['unicode'].'</strong>', 'unicode.php', $resultado['textos']['tit_unicode']));
					print(' &gt; '.href($resultado['seccion'][$c_nome], 'caracteres.php', '', '', 'id='.$resultado['seccion']['id']));
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['caracter'][$c_nome] ? $resultado['caracter'][$c_nome] : $resultado['caracter']['nome']); ?></h1>
					<p class="descricion">
						<span><?php print($resultado['textos']['tit_caracter']); ?></span>
					</p>
				</div>
				
				<div class="columna ancho8">
					<img class="imaxe" src="<?php print($rutas['w_caracteres'].($resultado['caracter']['imaxe'] ? $resultado['caracter']['imaxe'] : 'no.png')); ?>" alt="<?php print($resultado['caracter']['nome']); ?>" />
				</div>
				
				<div class="caracteres columna ancho7 final">
					<?php
					if ($resultado['caracter'][$c_nome]) {
						print('<p>'.$resultado['textos']['nome_orixinal'].': <strong>'.$resultado['caracter']['nome'].'</strong></p>');
					}
					print('<p>');
					print($resultado['textos']['codigo_html_dec'].': <strong>&amp;#'.$resultado['caracter']['id'].';</strong>');
					print('<br />'.$resultado['textos']['codigo_html_hex'].': <strong>&amp;#x'.$resultado['caracter']['hexadecimal'].';</strong>');
					if ($resultado['caracter']['html_nome']) {
						print('<br />'.$resultado['textos']['codigo_html_nome'].': <strong>&amp;'.$resultado['caracter']['html_nome'].';</strong>');
					}
					print('</p>');
					?>
					<p><?php print($resultado['textos']['previsualizar_caracter']); ?>:</p>
					<table class="caracter">
						<tr><td><?php print('&#x'.$resultado['caracter']['hexadecimal'].';'); ?></td></tr>
					</table>
					<form action="">
						<fieldset class="invisible">
						<select id="select_fontlist">
							<option><?php print($resultado['textos']['selecciona_tipografia']); ?></option>
						</select>
						</fieldset>
					</form>
					<object type="application/x-shockwave-flash" data="<?php print($rutas['w_flash']); ?>tipos_instaladas.swf" width="1" height="1" id="flash_instaladas">
					<param name="movie" value="<?php print($rutas['w_flash']); ?>tipos_instaladas.swf" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#FFFFFF" />
					</object>
			
					<script src="<?php print($rutas['w_js']); ?>caracter.js" type="text/javascript"></script>
				</div>