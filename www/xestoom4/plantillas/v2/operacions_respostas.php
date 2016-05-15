<?php defined('OK') or die();

//v.1.0
?>

				<div id="respostas" class="ancho20 arriba2">
					<form action="index.php" method="post">
					<input type="hidden" name="v_accion" value="relacionar" />
					<?php print(hidden('v_seccion, v_relacion, v_id, v_operacions')); ?>
					
					<?php foreach ($resultado['preguntas'] as $valor) { ?>
					<fieldset>
					<legend><?php print($valor[$campo_preguntas]) ?></legend>
						<?php foreach ($resultado['respostas'][$valor['id']] as $subvalor) { ?>
							<p>
							<input type="checkbox" name="resposta[<?php print($valor['id']); ?>][<?php print($subvalor['id']); ?>]" id="id_<?php print($valor['id'].'-'.$subvalor['id']); ?>" value="1" <?php if ($subvalor['seleccionado']) { print('checked="checked"'); }?> />
							<label for="id_<?php print($valor['id'].'-'.$subvalor['id']); ?>"><?php print($subvalor[$campo_respostas]); ?></label>
							</p>
						<?php } ?>
					</fieldset>
					<?php } ?>
					
					<fieldset>
						<input type="submit" class="formulario_submit rcolumna" value="<?php print($v_textos['relacionar']['relacionar']); ?>" />
					</fieldset>
					
					</form>
				</div>