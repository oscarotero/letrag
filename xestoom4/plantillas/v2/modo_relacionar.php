<?php defined('OK') or die(); ?>

				<div id="listado" class="ancho20 arriba2">
				
				<div class="opcions ancho19 abaixo1">
					<?php if (!$resultado['notas']['relacion3']) { ?>
					<a href="index.php" class="marcar_todos"><?php print($v_textos['relacionar']['marcar']); ?></a> | 
					<a href="index.php" class="invertir"><?php print($v_textos['relacionar']['invertir']); ?></a> | 
					<?php } ?>
					<a href="index.php" class="desmarcar_todos"><?php print($v_textos['relacionar']['desmarcar']); ?></a>
				</div>
				
				<form action="index.php" method="post">
					<input type="hidden" name="ids" value="<?php print($resultado['ids']); ?>" />
					<input type="hidden" name="v_accion" value="<?php print($resultado['variables']['v_modo']); ?>" />
					<?php print(hidden('v_seccion, v_orden, v_pax, v_filtro, v_campofiltro, v_relacion, v_id, v_modo')); ?>
					<table class="ancho20" id="formulario_relacionar">
					
						<!-- Cabeceira -->
						<?php include_once($rutas['x_plantillas'].'modo_listar_cabeceira_taboa.php'); ?>
						
						
						
						<!-- Rexistros -->
						<?php foreach((array)$resultado['datos'] as $valor) { ?>
						
						<tr>
							<?php foreach($listado_datos as $subvalor) { ?>
							
							<?php switch ($subvalor['tipo']) {
							
							case 'boleano': ?>
							<td class="<?php print($subvalor['tipo']); ?>"><img src="<?php print($rutas['xw_css'].'boleano_'.$valor[$subvalor['datos']]) ?>.png" alt="<?php print($valor[$subvalor['datos']]) ?>" /></td>
							<?php break;
							
							case 'imaxe': ?>
							<td class="<?php print($subvalor['tipo']); ?>"><?php print(img ($subvalor['arquivo'][0], $subvalor['arquivo'][1].$valor[$subvalor['arquivo'][2]], 'crop', '50x50')); ?></td>
							<?php break;
							
							default: ?>
							<td class="<?php print($subvalor['tipo']); ?>"><?php print($valor[$subvalor['datos']]) ?></td>
							<?php } } ?>
							
							<td class="accions">
								<?php if ($resultado['notas']['relacion3']) { ?>
								<input type="radio" name="checkbox[]" value="<?php print($valor['id']); ?>" <?php if ($resultado['datos2'][$valor['id']]) { print('checked="checked"'); } ?> />
								<?php } else { ?>
								<input type="checkbox" name="checkbox[]" value="<?php print($valor['id']); ?>" <?php if ($resultado['datos2'][$valor['id']]) { print('checked="checked"'); } ?> />
								<?php } ?>
							</td>
						</tr>
						
						<?php } ?>
						
					</table>
					
					<fieldset>
						<input type="submit" class="formulario_submit rcolumna" value="<?php print($v_textos['relacionar']['relacionar']); ?>" />
					</fieldset>
	</form>
				</div>