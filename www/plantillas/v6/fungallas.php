<?php defined('OK') or die(); ?>

					<?php
					print(href('<strong>'.$resultado['textos']['menu_'.$v_seccion].'</strong>', $v_seccion.'.php', $resultado['textos']['menu_tit_'.$v_seccion]));
					
					foreach ((array)$resultado['fungallas'] as $valor) {
						print(' &gt; '.href($valor[$c_nome], $v_seccion.'.php', '', '', 'id='.$valor['id']));
					}
					?>