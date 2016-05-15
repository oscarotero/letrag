<?php defined('OK') or die(); ?>

<fieldset>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>
<a href="id_<?php print($valor['datos']); ?>" id="boton_subir" title="<?php print($v_textos['formulario']['orde_subir']); ?>"><img src="<?php print($rutas['xw_css']); ?>arriba.png" alt="<?php print($v_textos['formulario']['orde_subir']); ?>" /></a>
<input type="text" tabindex="<?php print($n); ?>" class="campo_numero ancho2 final" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" value="<?php print(intval($resultado['datos'][$valor['datos']])); ?>" />
<input type="hidden" name="orde_<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" />
<a href="id_<?php print($valor['datos']); ?>" id="boton_baixar" title="<?php print($v_textos['formulario']['orde_baixar']); ?>"><img src="<?php print($rutas['xw_css']); ?>abaixo.png" alt="<?php print($v_textos['formulario']['orde_baixar']); ?>" /></a>

</fieldset>