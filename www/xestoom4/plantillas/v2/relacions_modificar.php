<?php
defined('OK') or die();

//v.1.1
?>

<?php if (!$resultado['variables']['v_id'] && $resultado['variables']['id']) { ?>

<?php	
	$pestanas = array();
	$n = 0;
	foreach ((array)$relacions[$taboa]['relacions'] as $clave => $valor) {
		if ($taboa_relacion) {
			if ($clave == $resultado['variables']['v_relacion']) {
				$pestanas[$n]['v_seccion'] = $clave;
				if ($valor['v_operacions']) {
					$pestanas[$n]['v_operacions'] = $valor['v_operacions'];
				}
			}
		} else {
			$pestanas[$n]['v_seccion'] = $clave;
			if ($valor['v_operacions']) {
				$pestanas[$n]['v_operacions'] = $valor['v_operacions'];
			}
		}
		$n++;
	}
?>
				<?php if ($pestanas) { ?>
				<div id="menu_relacions" class="ancho20 arriba5">
					<ul class="pestanas">
						<?php foreach($pestanas as $clave => $valor) { ?>
						<li><a href="#tab_<?php print($clave); ?>"><span><?php print($relacions[$valor['v_seccion']]['titulo']); ?></span></a></li>
						<?php } ?>
					</ul>
				</div>
				
				<?php foreach($pestanas as $clave => $valor) { ?>
				<div id="tab_<?php print($clave); ?>" class="pestanas_contido_oculto ancho20">
					<iframe frameborder="0" id="<?php print('iframe'.$clave); ?>" longdesc="<?php print('index.php?v_seccion='.$valor['v_seccion'].($valor['v_operacions'] ? '&amp;v_operacions='.$valor['v_operacions'] : '')."&amp;v_relacion=$taboa&amp;v_id=".$resultado['variables']['id']); ?>" class="ancho20"></iframe>
				</div>
				<?php } ?>
				<?php } ?>

<?php } ?>