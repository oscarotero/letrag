<?php defined('OK') or die(); ?>

<fieldset>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>
<span class="formulario_comentario columna">http://</span> 
<input type="text" tabindex="<?php print($n); ?>" class="campo_texto ancho13 final" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" />

<?php
if ($resultado['datos'][$valor['datos']]) {
	print(href('<img src="'.$rutas['xw_css'].'visitar.png" alt="'.$v_textos['formulario']['url_visitar'].'" />', 'http://'.$resultado['datos'][$valor['datos']], $v_textos['formulario']['url_visitar']));
}
?>

</fieldset>