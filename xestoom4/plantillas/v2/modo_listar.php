<?php defined('OK') or die();

//v.1.2
?>

				<div id="listado" class="ancho20 arriba2">
					<table class="ancho20" id="<?php print($taboa); ?>">
					
						<!-- Cabeceira -->
						<?php include_once($rutas['x_plantillas'].'modo_listar_cabeceira_taboa.php'); ?>
						
						
						
						<!-- Rexistros -->
						<?php foreach((array)$resultado['datos'] as $valor) { ?>
						
						<tr id="f_<?php print($valor['id']); ?>">
							<?php foreach($listado_datos as $subvalor) { ?>
							
							<?php switch ($subvalor['tipo']) {
							
							case 'boleano': ?>
							<td class="<?php print($subvalor['tipo']); ?>"><?php print href('<img src="'.$rutas['xw_css'].'boleano_'.$valor[$subvalor['datos']].'.png" alt="'.$valor[$subvalor['datos']].'" />', 'ajax_defecto.php', '', '', 'taboa='.$taboa.'&amp;id='.$valor['id'].'&amp;campo='.$subvalor['datos'].'&amp;accion=modificar&amp;valor='.($valor[$subvalor['datos']] ? 0 : 1)); ?></td>
							<?php break;
							
							case 'imaxe': ?>
							<td class="<?php print($subvalor['tipo']); ?>"><?php print(img ($subvalor['arquivo'][0], $subvalor['arquivo'][1].$valor[$subvalor['arquivo'][2]], 'crop', '50x50')); ?></td>
							<?php break;
							
							case 'titulo':
							case 'texto': ?>
							<td title="<?php print($v_textos['listado']['doble_clic']); ?>" class="<?php print($subvalor['tipo']); ?>" abbr="<?php print($subvalor['datos']); ?>"><?php print($valor[$subvalor['datos']]) ?></td>
							<?php break;
							
							default: ?>
							<td class="<?php print($subvalor['tipo']); ?>" abbr="<?php print($subvalor['datos']); ?>"><?php print($valor[$subvalor['datos']]) ?></td>
							<?php } } ?>
							
							<td class="accions">
								<?php
								print(' '.href('<img src="'.$rutas['xw_css'].'modificar.png" alt="'.$v_textos['listado']['modificar'].'" />', $rutas['xw_xestor'].'index.php', $v_textos['listado']['modificar'], '', get('v_seccion, v_relacion, v_id, v_filtro, v_campofiltro', 'v_modo=modificar&amp;id='.$valor[id])));
								if ($eliminar) {
									print(' '.href('<img src="'.$rutas['xw_css'].'eliminar.png" alt="'.$v_textos['listado']['eliminar'].'" />', 'ajax_defecto.php', $v_textos['listado']['eliminar'], 'borrar_rexistro', 'taboa='.$taboa.'&amp;id='.$valor['id'].'&amp;accion=eliminar'));
								}
								?>
							</td>
						</tr>
						
						<?php } ?>
						
					</table>
				</div>