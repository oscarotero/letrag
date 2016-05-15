<?php defined('OK') or die(); ?>

<fieldset>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>
<input type="checkbox" tabindex="<?php print($n); ?>" class="campo_checkbox" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" value="1" <?php
if (isset($resultado['datos'][$valor['datos']])) {
	if ($resultado['datos'][$valor['datos']]) {
		print('checked="checked"');
	}
} else {
	if ($valor['defecto']) {
		print('checked="checked"');
	}
}

?>/>

</fieldset>