<formato texto="<?php print(htmlentities($_POST["texto"])); ?>" background="<?php print($_POST["background"]); ?>">

<?php
$formatos = array("size", "color", "letterSpacing", "leading", "tipografia");

foreach ($formatos as $valor) {
	$n = 1;
	?>
	<atributo tipo="<?php print($valor); ?>">
<?php while (isset($_POST[$valor.$n])) { ?>
		<elemento indice="<?php print($_POST['n'.$valor.$n]); ?>" valor="<?php print($_POST[$valor.$n]); ?>" />
<?php
		$n++;
	}
?>
	</atributo>
<?php } ?>

</formato>