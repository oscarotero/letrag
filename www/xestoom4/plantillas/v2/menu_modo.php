<?php defined('OK') or die();

//v.1.0
?>

				<div id="menu_modo" class="ancho20">
					<ul class="pestanas">
						
						<?php if ($resultado['variables']['v_modo'] == 'modificar') { ?>
							<li class="seleccionado"><?php print(href('<span>'.$v_textos['modos']['modificar'].'</span>', 'index.php',$v_textos['modos']['t_modificar'], '', get('v_seccion, v_relacion, v_id, id', 'v_modo=modificar'))); ?></li>
						<?php } ?>
						
						<?php
						foreach ((array)explode(', ', $modos) as $seccion) {
							switch ($seccion) {
							
							case 'Insertar': ?>
							<li<?php if ($resultado['variables']['v_modo'] == 'insertar') { print(' class="seleccionado"'); } ?>><?php print(href('<span>'.$v_textos['modos']['insertar'].'</span>', 'index.php', $v_textos['modos']['t_insertar'], '', get('v_seccion, v_relacion, v_id', 'v_modo=insertar'))); ?></li>
							<?php break;
							
							case 'Listar': ?>
							<li<?php if ($resultado['variables']['v_modo'] == 'listar') { print(' class="seleccionado"'); } ?>><?php print(href('<span>'.$v_textos['modos']['listar'].'</span>', 'index.php', $v_textos['modos']['t_listar'], '', get('v_seccion, v_relacion, v_id, id', 'v_modo=listar'))); ?></li>
							<?php break;
							
							case 'Relacionar':
							if ($resultado['variables']['v_id']) { ?>
							<li<?php if ($resultado['variables']['v_modo'] == 'relacionar') { print(' class="seleccionado"'); } ?>><?php print(href('<span>'.$v_textos['modos']['relacionar'].'</span>', 'index.php', $v_textos['modos']['t_relacionar'], '', get('v_seccion, v_relacion, v_id, id', 'v_modo=relacionar'))); ?></li>
							<?php } break;
							}
						}
						?>
					</ul>
				</div>