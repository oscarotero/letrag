<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php print(href('<strong>'.$resultado['textos']['menu_identificar'].'</strong>', 'identificar.php', $resultado['textos']['menu_tit_identificar'])); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<h1><?php print($resultado['textos']['identificar']); ?></h1>
					<p class="descricion"><span><?php print($resultado['textos']['menu_tit_identificar']); ?></span></p>
				</div>
				
				<hr class="separador" />
				
				<form action="identificar.php" method="get" class="arriba1 identificar">
					<script type="text/javascript">
						$(document).ready(function () {
							$("#mostra").focus(function () {
								$("#opcion1").attr("checked", "checked");
							});
							$("#opcion2").change(function () {
								$("#comezar").removeAttr("disabled");
							});
							$("#opcion1").change(function () {
								if (jQuery.trim($("#mostra").val())) {
									$("#comezar").removeAttr("disabled");
								} else {
									$("#comezar").attr("disabled", "disabled");
								}
							});
							$("#mostra").bind("keydown mouseout", function () {
								if (jQuery.trim($(this).val())) {
									$("#comezar").removeAttr("disabled");
								} else {
									$("#comezar").attr("disabled", "disabled");
								}
							});
						});
					</script>
					<fieldset class="invisible">
						<input type="radio" id="opcion1" name="paso" value="1" />
						<label for="opcion1"><?php print($resultado['textos']['mostrar_preguntas']); ?></label>
						<input type="text" id="mostra" name="mostra" /><br />
						
						<input type="radio" id="opcion2" name="paso" value="1" />
						<label for="opcion2"><?php print($resultado['textos']['mostrar_todas_preguntas']); ?></label>
						<p class="arriba1"><input type="submit" id="comezar" disabled="disabled" value="comezar" /></p>
					</fieldset>
				</form>