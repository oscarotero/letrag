<?php defined('OK') or die(); ?>

<fieldset>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>

<select tabindex="<?php print($n); ?>" class="campo_select ancho15 final" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>">
	<option value="0">- - - - - - - - -</option>
	
	<?php
	$opcions = array();
	if ($valor['consulta']) {
		foreach ($resultado[$valor['consulta'][0]] as $subvalor) {
			$opcions[$subvalor[$valor['consulta'][2]]] = $subvalor[$valor['consulta'][1]];
		}
	} else if ($valor['array']) {
		$opcions = $valor['array'];
	}
	natcasesort($opcions);
	
	foreach ($opcions as $clave => $subvalor) { ?>
	<option value="<?php print($clave); ?>" <?php if ($resultado['datos'][$valor['datos']] == $clave) { print('selected="selected"'); } ?>><?php print($subvalor); ?></option>
	<?php } ?>

</select>

</fieldset>