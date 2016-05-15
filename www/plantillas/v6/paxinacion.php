<?php defined('OK') or die();
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

				<?php
					if ($resultado['paxinado']['anterior']) {
						print(href($resultado['textos']['anterior'], $url, '', '', get('id, idioma, texto, seccion, d, m, a', 'pax='.$resultado['paxinado']['anterior'])));
					} else {
						print($resultado['textos']['anterior']);
					}
					
					print('&nbsp;&nbsp;&nbsp;'.$resultado['textos']['paxina'].' '.$resultado['paxinado']['actual'].'&nbsp;&nbsp;&nbsp;');
					
					if ($resultado['paxinado']['seguinte']) {
						print(href($resultado['textos']['seguinte'], $url, '', '', get('id, idioma, texto, seccion, d, m, a', 'pax='.$resultado['paxinado']['seguinte'])));
					} else {
						print($resultado['textos']['seguinte']);
					}
				?>