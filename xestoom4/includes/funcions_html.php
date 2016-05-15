<?php
defined('OK') or die();

//v.1.0


/*
XENERAR UNHA LIGAZÓN
Devolve o código dunha ligazón con todas as variables que precisa.

$texto = texto que mostra a ligazon
$url = url á que leva (se non existe, ponse a do texto)
$titulo = titulo da ligazon (opcional)
$class = estilo css (opcional)
$var = variables GET que conten (opcional)
$id = id da ligazon (opcional)
*/
function href($texto, $url = '', $titulo = '', $class = '', $var = '', $id = '') {

	if (!$url) {
		$url = $texto;
	} else {
		if (strpos($url, '?')) {
			if ($var) {
				$url .= '&amp;'.$var;
				$var = '';
			}
		}
	}
	
	if ($var) {
		$var = '?'.$var;
	}
	
	if ($titulo) {
		$titulo = ' title="'.$titulo.'"';
	}
	
	if ($class) {
		$class = ' class="'.$class.'"';
	}
	
	if ($id) {
		$id = ' id="'.$id.'"';
	}
	
	$valor = '<a href="'.$url.$var.'"'.$titulo.$class.$id.'>'.$texto.'</a>';
	return $valor;
}



//Devolve unha ou varias variables dentro do array $resultado['variables'] en formato GET.
function get ($nomes = '', $engadidos = '') {
	global $resultado;
	$get = array();
	$nomes = explode(', ', $nomes);
	
	foreach ($nomes as $valor) {
		if (isset($resultado['variables'][$valor])) {
			$get[] = $valor.'='.$resultado['variables'][$valor];
		}
	}
	$get[] = $engadidos;
	return implode('&amp;', $get);
}


//Devolve unha ou varias variables dentro do array $resultado['variables'] en formato de campo hidden de formulario
function hidden ($nomes = '') {
	global $resultado;
	$nomes = explode(', ', $nomes);
	
	foreach ($nomes as $valor) {
		if (isset($resultado['variables'][$valor])) {
			$hidden .= '<input type="hidden" name="'.$valor.'" value="'.$resultado['variables'][$valor].'" />';
		}
	}
	return $hidden;
}



/*
XERAR UNHA IMAXE
Xera o código html para unha imaxe xerada dinamicamente
$dir = clave do array $rutas onde esta a imaxe orixinal
$arquivo = nome do arquivo de imaxe
$modo = modo de manipulación da imaxe (crop/resize)
$size = ancho e alto da imaxe (por exemplo 200x400)
*/
function img ($dir, $arquivo, $modo, $size, $id = '', $alt = '') {
	$imx = "imx.php?mode=$modo&amp;size=$size&amp;dir=$dir&amp;file=$arquivo";
	if (!$alt) {
		$alt = $arquivo;
	}
	if ($id) {
		$id = ' id="'.$id.'"';
	}
	if ($modo == 'crop') {
		$tamano = explode('x', $size);
		$tamano = ' width="'.$tamano[0].'" height="'.$tamano[1].'"';
	}
	return '<img src="'.$imx.'"'.$tamano.$id.' alt="'.$alt.'" />';
}




/*
XENERA UN CODIGO FLASH
Devolve o codigo necesario para insertar un documento flash (swf)

$url = url do arquivo flash
$w = ancho en pixeles
$h = alto en pixels
$fon = cor de fondo do flash. Se non se especifica nada sería tranparente.
*/
function flash ($url, $w, $h, $fondo = '') {
	$codigo = '<object type="application/x-shockwave-flash" data="'.$url.'" width="'.$w.'" height="'.$h.'">';
	$codigo .= $fondo ? '<param name="bgcolor" value="#'.$fondo.'" />' : '<param name="wmode" value="transparent" />';
	$codigo .= '<param name="movie" value="'.$url.'" /><param name="quality" value="high" /></object>';
	return $codigo;
}
?>