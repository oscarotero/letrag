<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php include_once($rutas['plantillas'].'fungallas.php'); ?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					<?php include_once($rutas['plantillas'].'cabeceira_seccions.php'); ?>
				</div>
				
				<div class="listado">
				
				<?php
				if (!$resultado['glosario']) {
					print($resultado['textos']['sen_resultados']);
				} else {
					foreach ($resultado['glosario'] as $valor) {
				?>
				<hr class="separador" />
				<div class="listado_elemento borrar">
					<h3><?php print(href($valor[$c_nome], 'palabra.php', '', '', 'id='.$valor['id'])); ?></h3>
				</div>
				<?php } ?>
				<?php } ?>
				
				</div>