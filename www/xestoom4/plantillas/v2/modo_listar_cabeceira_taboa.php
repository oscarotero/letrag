<?php defined('OK') or die(); ?>

						<tr>
						<?php foreach($listado_datos as $valor) { ?>
							<th class="<?php print($valor['tipo']); ?>">
							<?php
							if ($valor['datos']) {
								$orde = '';
								$frecha = '';
								$estilo = '';
								$titulo = '';
								switch ($resultado['variables']['v_orden']) {
									case $valor['datos'].' DESC':
									$orde = $valor['datos'].' ASC';
									$frecha = $v_textos['listado']['f_abaixo'];
									$estilo = 'seleccionado';
									$titulo = $v_textos['listado']['t_abaixo'];
									break;
									
									case $valor['datos'].' ASC':
									$frecha = $v_textos['listado']['f_arriba'];
									$estilo = 'seleccionado';
									
									default:
									$orde = $valor['datos'].' DESC';
									$titulo = $v_textos['listado']['t_arriba'];
								}
								print(href($valor['titulo'], 'index.php', $titulo, $estilo, get('v_seccion, v_relacion, v_id, v_filtro, v_campofiltro, v_modo', 'v_orden='.$orde)).' '.$frecha);
							} else {
								print($valor['titulo']);
							}
							?>
							</th>
						<?php } ?>
							<th class="accions">&nbsp;</th>
						</tr>