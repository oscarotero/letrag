<?php defined('OK') or die(); ?>

				<hr class="separador" />
				<script src="<?php print($rutas['w_js']); ?>jquery_jcal.js" type="text/javascript"></script>
				<script src="<?php print($rutas['w_js']); ?>jquery_color.js" type="text/javascript"></script>
				<script type="text/javascript">
					$(document).ready(function () {
						var data = new Date();
						<?php if ($resultado['variables']['a'] && $resultado['variables']['m'] && $resultado['variables']['d']) { ?>
						data.setFullYear(<?php print($resultado['variables']['a']); ?>, <?php print($resultado['variables']['m']-1); ?>, <?php print($resultado['variables']['d']); ?>);
						<?php } ?>
						$('#calendario').jCal({
							day:			data,
							days:			1,
							showMonths:		1,
							sDate:			new Date(),
							eDate:			new Date(),
							css:			"<?php print($rutas['w_css']); ?>",
							ml:			[
										'<?php print($resultado['textos']['xaneiro']); ?>',
										'<?php print($resultado['textos']['febreiro']); ?>',
										'<?php print($resultado['textos']['marzo']); ?>',
										'<?php print($resultado['textos']['abril']); ?>',
										'<?php print($resultado['textos']['maio']); ?>',
										'<?php print($resultado['textos']['xuno']); ?>',
										'<?php print($resultado['textos']['xullo']); ?>',
										'<?php print($resultado['textos']['agosto']); ?>',
										'<?php print($resultado['textos']['setembro']); ?>',
										'<?php print($resultado['textos']['outubro']); ?>',
										'<?php print($resultado['textos']['novembro']); ?>',
										'<?php print($resultado['textos']['decembro']); ?>'],
										
							dow:			[
										'<?php print($resultado['textos']['domingo']); ?>',
										'<?php print($resultado['textos']['luns']); ?>',
										'<?php print($resultado['textos']['martes']); ?>',
										'<?php print($resultado['textos']['mercores']); ?>',
										'<?php print($resultado['textos']['xoves']); ?>',
										'<?php print($resultado['textos']['venres']); ?>',
										'<?php print($resultado['textos']['sabado']); ?>'],
										
							dCheck:			function (day) {
											return (day.getDay() != 6);
										},
							callback:		function (day, days) {
											var mes = day.getMonth() + 1;
											var dia = day.getDate();
											var ano = day.getFullYear();
											var idioma = "";
											<?php
											if ($resultado['variables']['idioma']) {
												print('idioma = "'.$resultado['variables']['idioma'].'";');
											} ?>
											var url = "blogosfera.php?d=" + dia + "&m=" + mes + "&a=" + ano;
											if (idioma) {
												url = url + "&idioma=" + idioma;
											}
											window.location = url;
											return true;
										}
						});
					});
				</script>
				
				<div class="arriba2 abaixo2 borrar">
					<h4><?php print($resultado['textos']['calendario']); ?>:</h4>
					<div class="centrado arriba1">
						<div id="calendario">
						</div>
					</div>
				</div>
				
				<hr class="separador" />
				
				<div class="arriba2 abaixo2 borrar">

					<h4><?php print($resultado['textos']['filtrar_idiomas']); ?></h4>
					<?php $idioma = $resultado['variables']['idioma'] ? $resultado['variables']['idioma'] : 'todos'; ?>
					
					<ul class="columna ancho3 menu_secundario">
						<li><?php print(href($resultado['textos']['todos'], 'blogosfera.php', '', seleccionado('todos', 'idioma'), get('d, m, a'))); ?></li>
						<li><?php print(href($resultado['textos']['idioma_a'], 'blogosfera.php', '', seleccionado('a', 'idioma'), get('d, m, a', 'idioma=a'))); ?></li>
						<li><?php print(href($resultado['textos']['idioma_c'], 'blogosfera.php', '', seleccionado('c', 'idioma'), get('d, m, a', 'idioma=c'))); ?></li>
						<li><?php print(href($resultado['textos']['idioma_l'], 'blogosfera.php', '', seleccionado('l', 'idioma'), get('d, m, a', 'idioma=l'))); ?></li>
					</ul>
					<ul class="columna ancho3 final menu_secundario">
						<li><?php print(href($resultado['textos']['idioma_g'], 'blogosfera.php', '', seleccionado('g', 'idioma'), get('d, m, a', 'idioma=g'))); ?></li>
						<li><?php print(href($resultado['textos']['idioma_i'], 'blogosfera.php', '', seleccionado('i', 'idioma'), get('d, m, a', 'idioma=i'))); ?></li>
						<li><?php print(href($resultado['textos']['idioma_t'], 'blogosfera.php', '', seleccionado('t', 'idioma'), get('d, m, a', 'idioma=t'))); ?></li>
						<li><?php print(href($resultado['textos']['idioma_p'], 'blogosfera.php', '', seleccionado('p', 'idioma'), get('d, m, a', 'idioma=p'))); ?></li>
					</ul>

				</div>