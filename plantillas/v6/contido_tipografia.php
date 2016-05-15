<?php defined('OK') or die(); ?>

				<div class="fungallas">
					<?php
					foreach ($resultado['seccions'] as $valor) {
						print(href('<strong>'.$resultado['textos']['menu_clasificacion'].'</strong>', 'clasificacion.php', $resultado['textos']['menu_tit_clasificacion']));
					
						foreach ($valor as $subvalor) {
							print(' &gt; '.href($subvalor[$c_nome], 'clasificacion.php', '', '', 'id='.$subvalor['id']));
						}
						print('<br />');
					}
					
					print(href('<strong>'.$resultado['textos']['menu_identificar'].'</strong>', 'identificar.php', $resultado['textos']['menu_tit_identificar']));
					print(' &gt; '.href($resultado['textos']['identificar_similares'], 'tipografias.php', '', '', 'similar='.$resultado['tipografia']['id']));
					print('<br />');
					
					print(href('<strong>'.$resultado['textos']['menu_maiscomuns'].'</strong>', 'maiscomuns.php', $resultado['textos']['menu_tit_maiscomuns']));
					print(' &gt; '.href($resultado['textos']['tipografia_maiscomuns'], 'maiscomuns.php', '', '', 'id='.$resultado['tipografia']['id']));
					print('<br />');
					
					print(href('<strong>'.$resultado['textos']['menu_blogosfera'].'</strong>', 'blogosfera.php', $resultado['textos']['menu_tit_blogosfera']));
					print(' &gt; '.href($resultado['textos']['blogosfera_tipografia'], 'blogosfera.php', '', '', 'texto='.$resultado['tipografia']['nome']));
					?>
				</div>
				
				<div id="cabeceira" class="arriba2 abaixo2">
					
					<?php if ($resultado['tipografia']['descargar']) { ?>
						<div class="destaque_gratuita_<?php print(LANG); ?>">
							<?php print(href($resultado['textos']['tipografia_gratuita'], 'http://'.$resultado['tipografia']['descargar'])); ?>
						</div>
					<?php } else { ?>
						<div class="destaque_comercial_<?php print(LANG); ?>">
							<?php print(href($resultado['textos']['tipografia_comercial'], 'http://www.google.com/cse', '', '', 'cx=016719214230591524574%3Axhaxydpdfli&amp;q='.$resultado['tipografia']['nome'])); ?>
						</div>
					<?php } ?>
					
					<h1><?php print($resultado['tipografia']['nome']); ?></h1>
					<p class="descricion abaixo1">
						<?php
						$imprimir = array();
						foreach ($resultado['desenadores'] as $valor) {
							$imprimir[] = href($valor['nome'], 'desenador.php', '', '', 'id='.$valor['id']);
						}
						print(implode($imprimir, ', '));
						?>
						 (<?php print($resultado['tipografia']['ano']); ?>)
					</p>
				</div>
				
				<hr class="separador" />
				
				<?php if ($resultado['etiquetas']) { ?>
				<div class="tags">
					<?php
					print($resultado['textos']['tags'].': ');
					$imprimir = array();
					foreach($resultado['etiquetas'] as $valor) {
						$imprimir[] = href($valor[$c_nome], 'tag.php', '', '', 'id='.$valor['id']);
					}
					print(implode($imprimir, ', '));
					?>
				</div>
				<?php } ?>

				
				<?php include_once($rutas['plantillas'].'votacion.php'); ?>
				
				
				<div class="texto arriba2 abaixo2">
					<?php print($resultado['tipografia'][$c_texto]); ?>
					
					<?php if ($resultado['ligazons']) { ?>
					<h3><?php print($resultado['textos']['ligazons']); ?></h3>

					<ul class="ligazons">
						<?php foreach ($resultado['ligazons'] as $valor) { ?>
						<li>
							<strong><?php print(href($valor[$c_nome], 'http://'.$valor['url'])); ?></strong><br />
							<span class="direccion"><?php print(href($valor['url'], 'http://'.$valor['url'])); ?></span><br />
							<span class="descricion"><?php print($valor[$c_texto].' ('.$resultado['textos']['idioma_'.$valor['idioma']].')'); ?></span>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
				
				<hr class="separador" />
				
				
				<script src="<?php print($rutas['w_js']); ?>jquery_flash.js" type="text/javascript"></script>
				<script src="<?php print($rutas['w_js']); ?>pantaiacompleta.js" type="text/javascript"></script>
				
				<script type="text/javascript">
					$(document).ready(function () {
						$('#flash').flash({
							src: '<?php print($rutas['w_flash']); ?>cargador6.swf',
							width: '100%',
							height: '100%',
							flashvars: { id: <?php print($resultado['tipografia']['id']); ?> }
						});
					})
				</script>
				
				<div id="contenedor_flash">
					<div id="flash" class="abaixo2"></div>
					<a class="pantallacompleta" href=""><?php print($resultado['textos']['pantallacompleta']); ?></a>
					<a class="pantallasalir" href=""><?php print($resultado['textos']['pantallasalir']); ?></a>
				</div>
				
				
				<?php include_once($rutas['plantillas'].'comentarios.php'); ?>