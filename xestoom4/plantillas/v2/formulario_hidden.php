<?php defined('OK') or die(); ?>

<?php
$value = htmlspecialchars($resultado['datos'][$valor['datos']]);
if (!$value) {
	$value = $valor['valor'];
}
?>
<input type="hidden" id="id_<?php print($valor['datos']); ?>" name="<?php print($valor['datos']); ?>" value="<?php print($value); ?>" />