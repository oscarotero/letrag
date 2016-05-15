<?php defined('OK') or die();

//v.1.1
?>


<fieldset>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4">
	<?php print($valor['label']); ?>
	<?php if ($valor['caracteres']) { ?>
	<br />
	(<span id="carac_id_<?php print($valor['datos']); ?>"></span> <?php print($v_textos['formulario']['lim_caracter']); ?>)
	<span class="oculto" id="carac_id_<?php print($valor['datos']); ?>_max"><?php print($valor['caracteres']); ?></span>
	<?php } ?>
</label>

<textarea tabindex="<?php print($n); ?>" class="campo_textarea ancho15 final <?php if ($valor['caracteres']) { print('limitar_caracteres'); } ?>" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" cols="60" rows="20">
<?php print(htmlspecialchars($resultado['datos'][$valor['datos']])); ?>
</textarea>

</fieldset>