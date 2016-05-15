<?php defined('OK') or die(); 

//v.1.1
?>

<fieldset>

<?php
$gmap_x = $resultado['datos'][$valor['prefixo'].'_x'];
$gmap_y = $resultado['datos'][$valor['prefixo'].'_y'];
$gmap_z = $resultado['datos'][$valor['prefixo'].'_z'];

if (!$gmap_x) {
	$gmap_x = $valor['inicio'][0];
}
if (!$gmap_y) {
	$gmap_y = $valor['inicio'][1];
}
if (!$gmap_z) {
	$gmap_z = $valor['inicio'][2];
}
$id_mapa = 'mapa_'.$valor['prefixo'];
$var_mapa = 'map_'.$valor['prefixo'];
$var_punto = 'punto_'.$valor['prefixo'];
?>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php print($valor['key']); ?>" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		if (GBrowserIsCompatible()) {
			
			//Xenera e centra o mapa
			var <?php print($var_mapa); ?> = new GMap2(document.getElementById("<?php print($id_mapa); ?>"));
			var <?php print($var_punto); ?> = new GLatLng(<?php print($gmap_x); ?>, <?php print($gmap_y); ?>);
			var geocodigo = new GClientGeocoder();
			<?php print($var_mapa); ?>.setCenter(<?php print($var_punto); ?>, <?php print($gmap_z); ?>);
			<?php print($var_mapa); ?>.addControl(new GLargeMapControl());
			<?php print($var_mapa); ?>.addControl(new GMapTypeControl());
			
			//Punto
			var propiedades = new Object ();
			propiedades.draggable = true;
			propiedades.clickable = true;
			var marca_<?php print($var_punto); ?> = new GMarker(<?php print($var_punto); ?>, propiedades);
			<?php print($var_mapa); ?>.addOverlay(marca_<?php print($var_punto); ?>);
			
			//Eventos
			function pincha_mapa_<?php print($var_mapa); ?> (overlay, point) {
				if (point) {
					marca_<?php print($var_punto); ?>.setPoint(point);
					$("#id_<?php print($valor['prefixo']); ?>_x").val(point.y);
					$("#id_<?php print($valor['prefixo']); ?>_y").val(point.x);
				}
			}
			function arrastra_mapa_<?php print($var_mapa); ?> () {
				var point = this.getPoint();
				$("#id_<?php print($valor['prefixo']); ?>_x").val(point.y);
				$("#id_<?php print($valor['prefixo']); ?>_y").val(point.x);
			}
			function zoom_mapa_<?php print($var_mapa); ?> (oldLevel, newLevel) {
				$("#id_<?php print($valor['prefixo']); ?>_z").val(newLevel);
			}
			GEvent.addListener(<?php print($var_mapa); ?>, 'click', pincha_mapa_<?php print($var_mapa); ?>);
			GEvent.addListener(<?php print($var_mapa); ?>, 'zoomend', zoom_mapa_<?php print($var_mapa); ?>);
			GEvent.addListener(marca_<?php print($var_punto); ?>, 'dragend', arrastra_mapa_<?php print($var_mapa); ?>);
			
			
			//Funcions propias
			function recargar_<?php print($var_mapa); ?> () {
				var x = parseFloat($("#id_<?php print($valor['prefixo']); ?>_x").val());
				var y = parseFloat($("#id_<?php print($valor['prefixo']); ?>_y").val());
				var z = parseInt($("#id_<?php print($valor['prefixo']); ?>_z").val());
				
				var punto_actual = new GLatLng(x, y);
				<?php print($var_mapa); ?>.setCenter(punto_actual, z);
				marca_<?php print($var_punto); ?>.setPoint(punto_actual);
				$("#id_<?php print($valor['prefixo']); ?>_x").val(punto_actual.y);
				$("#id_<?php print($valor['prefixo']); ?>_y").val(punto_actual.x);
				return false;
			}
			function buscar_<?php print($var_mapa); ?> () {
				var texto = $("#buscar_gmap_<?php print($valor['prefixo']); ?>").val();
				geocodigo.getLatLng(texto, function(point) {
					if (!point) {
						alert("<?php print($v_textos['formulario']['gmap_alert1']); ?>");
					} else {
						<?php print($var_mapa); ?>.setCenter(point);    // 12 indica el valor de zoom
						marca_<?php print($var_punto); ?>.setPoint(point);
						$("#id_<?php print($valor['prefixo']); ?>_x").val(point.y);
						$("#id_<?php print($valor['prefixo']); ?>_y").val(point.x);
					}
				});
				return false;
			}
			$("#<?php print('gmap_recargar_'.$id_mapa); ?>").click(recargar_<?php print($var_mapa); ?>);
			$("#<?php print('boton_gmap_'.$id_mapa); ?>").click(buscar_<?php print($var_mapa); ?>);
			

			$("#<?php print('gmap_refrescar_'.$id_mapa); ?>").click(function() {
				<?php print($var_mapa); ?>.setCenter(<?php print($var_punto); ?>, <?php print($gmap_z); ?>);
				marca_<?php print($var_punto); ?>.setPoint(<?php print($var_punto); ?>);
				$("#id_<?php print($valor['prefixo']); ?>_x").val(<?php print($var_punto); ?>.y);
				$("#id_<?php print($valor['prefixo']); ?>_y").val(<?php print($var_punto); ?>.x);
				return false;
			});
			
			
			$("#id_<?php print($valor['prefixo']); ?>_x, #id_<?php print($valor['prefixo']); ?>_y, #id_<?php print($valor['prefixo']); ?>_z").keydown(function(event){
				if (event.keyCode == 13) {
					recargar_<?php print($var_mapa); ?>();
					return false;
				}
			});
			
			$("#buscar_gmap_<?php print($valor['prefixo']); ?>").keydown(function(event){
				if (event.keyCode == 13) {
					buscar_<?php print($var_mapa); ?>();
					return false;
				}
			});
		}
	});
</script>

<label class="ancho4"><?php print($valor['label']); ?></label>
<br />
<br />
<div id="mapa_<?php print($valor['prefixo']); ?>" class="campo_gmap columna ancho13"></div>

<div class="columna ancho6 final">

	<label for="id_<?php print($valor['prefixo']); ?>_x" class="columna ancho5"><?php print($v_textos['formulario']['gmap_x']); ?></label>
	<input id="id_<?php print($valor['prefixo']); ?>_x" type="text" class="campo_texto columna ancho5 final" name="<?php print($valor['prefixo']); ?>_x" value="<?php print($gmap_x); ?>" />
	
	<label for="id_<?php print($valor['prefixo']); ?>_y" class="columna ancho5 arriba1"><?php print($v_textos['formulario']['gmap_y']); ?></label>
	<input id="id_<?php print($valor['prefixo']); ?>_y" type="text" class="campo_texto columna ancho5 final" name="<?php print($valor['prefixo']); ?>_y" value="<?php print($gmap_y); ?>" />
	
	<label for="id_<?php print($valor['prefixo']); ?>_z" class="columna ancho5 arriba1"><?php print($v_textos['formulario']['gmap_z']); ?></label>
	<input id="id_<?php print($valor['prefixo']); ?>_z" type="text" class="campo_texto columna ancho1 final" name="<?php print($valor['prefixo']); ?>_z" value="<?php print($gmap_z); ?>" />
	
	<a href="index.php" id="<?php print('gmap_recargar_'.$id_mapa); ?>" class="columna ancho2" title="<?php print($v_textos['formulario']['gmap_centrar']); ?>"><img src="<?php print($rutas['xw_css']); ?>ir.png" alt="<?php print($v_textos['formulario']['gmap_centrar']); ?>" /></a>
	
	<hr />
	
	<input type="text" class="campo_texto columna ancho5 final" name="buscar_gmap" id="buscar_gmap_<?php print($valor['prefixo']); ?>" />
	<a href="index.php" id="<?php print('boton_gmap_'.$id_mapa); ?>" title="<?php print($v_textos['formulario']['gmap_buscar']); ?>"><img src="<?php print($rutas['xw_css']); ?>buscar.png" alt="<?php print($v_textos['formulario']['gmap_buscar']); ?>" /></a>
	
	<hr />
	<a href="index.php" id="<?php print('gmap_refrescar_'.$id_mapa); ?>" title="<?php print($v_textos['formulario']['gmap_recargar']); ?>"><img src="<?php print($rutas['xw_css']); ?>recargar.png" alt="<?php print($v_textos['formulario']['gmap_recargar']); ?>" /></a>

</div>
						
</fieldset>