<?php defined('OK') or die(); ?>

					<?php if ($resultado['seccion_actual']) { ?>
					<h1><?php print($resultado['seccion_actual'][$c_nome]); ?></h1>
					<p class="descricion">
						<span>
						<?php print($resultado['seccion_actual'][$c_texto]); ?>
						</span>
					</p>
					
					<?php } else { ?>
					
					<h1><?php print($resultado['textos'][$v_seccion]); ?></h1>
					
					<?php if ($resultado['variables']['texto']) { ?>
					<p class="descricion"><span>
						<?php
						print($resultado['textos']['buscando_por'].' <em><q>'.$resultado['variables']['texto'].'</q></em>');
						print(' '.href('('.$resultado['textos']['mostrar_todo'].')', $v_seccion.'.php'));
						?>
					</span></p>
					
					<?php } else if ($resultado['variables']['letra']) { ?>
					<p class="descricion"><span>
						<?php print($resultado['textos']['palabras_empezan'].' <em><q>'.$resultado['variables']['letra'].'</q></em>'); ?>
					</span></p>
					
					<?php } else if ($resultado['textos']['menu_tit_'.$v_seccion]) { ?>
					<p class="descricion"><span>
						<?php print($resultado['textos']['menu_tit_'.$v_seccion]); ?>
					</span></p>
					<?php } ?>
					
					<?php } ?>