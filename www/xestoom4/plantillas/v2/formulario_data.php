<?php defined('OK') or die();

//v.1.1
?>

<fieldset>

<script type="text/javascript">
	$(document).ready(function() {
		$('#id_<?php print($valor['datos']); ?>').datepicker({showOn: 'button', buttonImage: '<?php print($rutas['xw_css']); ?>calendario.png', buttonImageOnly: true});
		
		<?php if ($valor['hora']) { ?>
		$('#id_<?php print($valor['datos']); ?>_hora').timeEntry({
			spinnerImage: '<?php print($rutas['xw_css']); ?>hora.png'
		});
		<?php } ?>
	});
</script>

<label for="id_<?php print($valor['datos']); ?>" class="columna ancho4"><?php print($valor['label']); ?></label>
<input type="text" tabindex="<?php print($n); ?>" class="campo_texto ancho6" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" value="<?php print($resultado['datos'][$valor['datos']]); ?>" />

<?php
if ($valor['hora']) {
$n++;
?>
<input type="text" tabindex="<?php print($n); ?>" class="campo_texto ancho6 final" id="id_<?php print($valor['datos']); ?>_hora" name="<?php print($valor['datos']); ?>_hora" value="<?php print($resultado['datos'][$valor['datos'].'_hora']); ?>" />
<?php } ?>

</fieldset>