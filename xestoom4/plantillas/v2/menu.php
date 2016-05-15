<?php defined('OK') or die(); ?>

			<div id="menu" class="columna ancho4 arriba3">
				<ul class="menu_principal">
				
				<?php foreach ((array)$v_menu_principal as $clave => $valor) { ?>
					
					<?php if ($valor[2]) { ?>
					<li class="<?php print($clave == $resultado['menu'][1] ? 'menu_aberto' : 'menu_pechado'); ?>"><a class="flecha">&nbsp;</a>
						<?php print (href($valor[0], 'index.php?v_seccion='.$clave, '', $clave == $resultado['menu'][1] ? 'seleccionado' : '', $valor[1])); ?>
						
						<ul>
						<?php foreach((array)$valor[2] as $subclave => $subvalor) { ?>
							<li><?php print (href($subvalor[0], 'index.php?v_seccion='.$subclave, '', $subclave == $resultado['menu'][2] ? 'seleccionado' : '', $subvalor[1])); ?></li>
						<?php } ?>
						</ul>
					</li>
					
					<?php } else { ?>
					<li><?php print (href($valor[0], 'index.php?v_seccion='.$clave, '', $clave == $resultado['menu'][1] ? 'seleccionado' : '', $valor[1])); ?></li>
					<?php } ?>
					
				<?php } ?>
				
				</ul>
				
				
				
				<?php foreach ((array)$v_menu_secundario as $valor) { ?>
				<h4 class="arriba2"><?php print($valor[0]); ?></h4>
				<ul class="menu_secundario">
					
					<?php foreach((array)$valor[1] as $subvalor) { ?>
					<li><a href="<?php print($subvalor[1]); ?>" ><?php print($subvalor[0]); ?></a></li>
					<?php } ?>
				
				</ul>
				<?php } ?>
				
			</div>