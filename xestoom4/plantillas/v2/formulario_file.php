<?php defined('OK') or die(); ?>

<fieldset>

<?php
$extension = strrchr($resultado['datos'][$valor['datos']], '.');
$extension = substr(strtolower($extension), 1);
?>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>

<?php if ($extension) { ?>
<div class="columna ancho2">
	<?php print(href('<img src="'.$rutas['xw_css'].'arquivo_'.$extension.'.png" alt="Arquivo '.$extension.'" />', $rutas['w_'.$valor['arquivo'][0]].$resultado['datos'][$valor['datos']])); ?>
</div>
<?php } ?>

<input type="file" name="<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" class="campo_file final" tabindex="<?php print($n); ?>" id="id_<?php print($valor['datos']); ?>" />
<input type="hidden" name="file_<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" />

<?php if ($resultado['datos'][$valor['datos']]) { ?>
<br />
<span class="formulario_comentario"><?php print($rutas['w_'.$valor['arquivo'][0]].$resultado['datos'][$valor['datos']]); ?></span>
<?php } ?>

</fieldset>