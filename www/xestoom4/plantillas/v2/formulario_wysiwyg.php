<?php defined('OK') or die();

//v.1.0
?>

<fieldset>

<script type="text/javascript">
	$(document).ready(function() {
		$('#id_<?php print($valor['datos']); ?>').wysiwyg();
	});
</script>

<label for="id_<?php print($valor['datos']); ?>" class="ancho4"><?php print($valor['label']); ?></label>
<br />
<br />
<textarea tabindex="<?php print($n); ?>" class="campo_wysiwyg ancho20" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" cols="60" rows="20">
<?php print(htmlspecialchars($resultado['datos'][$valor['datos']])); ?>
</textarea>

</fieldset>