<?php defined('OK') or die(); ?>
				
				<script type="text/javascript">
				<!--
				google_ad_client = "pub-6320239092929501";
				/* 728x15, creado 15/06/08 */
				google_ad_slot = "6913799303";
				google_ad_width = 728;
				google_ad_height = 15;
				//-->
				</script>
				<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
				
				<div class="arriba2">
				<?php print($resultado['textos']['creative_commons']); ?>
				</div>
				
				<div class="arriba1">
				<?php
				print(href('<img id="oom" src="'.$rutas['w_css'].'oom_letrag.png" />', 'http://oscarotero.com', $resultado['textos']['creada_por_oom']));
				print(' - '.href($resultado['textos']['contacto'], 'contacto.php', $resultado['textos']['tit_contacto']));
				?>
				</div>