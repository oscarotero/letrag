<?php defined('OK') or die(); ?>

<fieldset>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>

<div class="columna ancho2">
	<?php print(href(img($valor['arquivo'][0], $resultado['datos'][$valor['datos']], 'crop', '50x50'), $rutas['w_'.$valor['arquivo'][0]].$resultado['datos'][$valor['datos']])); ?>	
</div>

<input type="file" name="<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" class="campo_file final" tabindex="<?php print($n); ?>" id="id_<?php print($valor['datos']); ?>" />
<input type="hidden" name="file_<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" />

<?php if ($resultado['datos'][$valor['datos']]) { ?>
<br />
<span class="formulario_comentario"><?php print($rutas['w_'.$valor['arquivo'][0]].$resultado['datos'][$valor['datos']]); ?></span>
<?php } ?>

</fieldset>