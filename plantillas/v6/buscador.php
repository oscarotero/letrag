<?php defined('OK') or die(); ?>

				<form id="buscador" action="" class="arriba2 abaixo2 borrar">
					<fieldset class="invisible">
						<div class="borrar">
							<label for="buscador_texto" class="columna ancho2 final"><?php print($resultado['textos']['buscar']); ?></label>
							<input type="text" id="buscador_texto" class="columna ancho5 final" name="texto" value="<?php print($resultado['variables']['texto']); ?>" />
						</div>
						<div class="borrar">
							<label for="buscador_lugar" class="columna ancho2 final"><?php print($resultado['textos']['buscar_en']); ?></label>
							<select name="lugar" id="buscador_lugar" class="columna ancho5 final">
								<option <?php if ($v_lugar=='blogosfera') { print('selected="selected" ');} ?>value="blogosfera"><?php print($resultado['textos']['blogosfera']); ?></option>
								<option <?php if ($v_lugar=='caracteres') { print('selected="selected" ');} ?>value="caracteres"><?php print($resultado['textos']['caracteres']); ?></option>
								<option <?php if ($v_lugar=='clasificacion') { print('selected="selected" ');} ?>value="clasificacion"><?php print($resultado['textos']['clasificacion']); ?></option>
								<option <?php if ($v_lugar=='desenadores') { print('selected="selected" ');} ?>value="desenadores"><?php print($resultado['textos']['menu_desenadores']); ?></option>
								<option <?php if ($v_lugar=='tags') { print('selected="selected" ');} ?>value="tags"><?php print($resultado['textos']['tags']); ?></option>
								<option <?php if ($v_lugar=='glosario_seccions') { print('selected="selected" ');} ?>value="glosario_seccions"><?php print($resultado['textos']['glosario_seccions']); ?></option>
								<option <?php if ($v_lugar=='glosario_palabras') { print('selected="selected" ');} ?>value="glosario_palabras"><?php print($resultado['textos']['glosario_palabras']); ?></option>
								<option <?php if ($v_lugar=='ligazons') { print('selected="selected" ');} ?>value="ligazons"><?php print($resultado['textos']['ligazons']); ?></option>
								<option <?php if ($v_lugar=='tipografias') { print('selected="selected" ');} ?>value="tipografias"><?php print($resultado['textos']['tipografias']); ?></option>
								<option <?php if ($v_lugar=='mais_comuns') { print('selected="selected" ');} ?>value="mais_comuns"><?php print($resultado['textos']['mais_comuns']); ?></option>
							</select>
						</div>
					</fieldset>
				</form>