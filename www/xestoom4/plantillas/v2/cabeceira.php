<?php defined('OK') or die(); ?>

		<div id="cabeceira">
			<div class="paxina">
				<h1 class="columna ancho4"><a href="<?php print($rutas['xw']); ?>" class="columna ancho4" title="<?php print($v_textos['cabeceira']['portada']); ?>"><?php print($v_textos['cabeceira']['titulo']); ?></a></h1>
				<div id="fungallas">
					<?php
					print(href('<strong>'.$resultado['menu']['nome_1'].'</strong>', $resultado['menu']['url_1']));
					if ($resultado['menu'][2]) {
						print(' &gt; '.href($resultado['menu']['nome_2'], $resultado['menu']['url_2']));
					}
					?>
				</div>
			</div>
		</div>