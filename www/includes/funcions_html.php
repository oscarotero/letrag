<?php
defined('OK') or die();


/*
XENERAR UNHA LIGAZÓN v.1.0
Devolve o código dunha ligazón con todas as variables que precisa.

$texto = texto que mostra a ligazon
$url = url á que leva (se non existe, ponse a variable texto
$titulo = titulo da ligazon (opcional)
$class = estilo css (opcional)
$var = variables GET que conten (opcional)
*/
function href($texto, $url = '', $titulo = '', $class = '', $var = '') {
	
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
	
	$valor = '<a href="'.$url.$var.'"'.$titulo.$class.$target.'>'.$texto.'</a>';
	return $valor;
}


/*
COLOCAR A CLASE SELECCIONADO NOS MENÚS
Imprime a clase seleccionado nos menús se coincide a sección do documento coa sección actual
$seccion = sección coa que se quere comparar
$var_seccion = nome da variable que conten o nome da sección actual
$texto = texto que se quere que se devolva, (por defecto "seleccionado")
*/
function seleccionado ($seccion, $var_seccion = 'v_seccion', $texto = 'seleccionado') {
	global $$var_seccion;
	
	if ($seccion == $$var_seccion) {
		return $texto;
	}
}

/*
XERAR UNHA IMAXE v.1.0
Xera o código html para unha imaxe xerada dinamicamente

$dir = clave do array $rutas onde esta a imaxe orixinal
$arquivo = nome do arquivo de imaxe
$modo = modo de manipulación da imaxe (crop/resize)
$size = ancho e alto da imaxe (por exemplo 200x400)
$id = id da imaxe (opcional)
$class = atributo class da imaxe (opcional)
$alt = atributo alt da imaxe (sairá en branco se non se especifica nada)
*/
function img ($dir, $arquivo, $modo, $size, $id = '', $class = '', $alt = '') {
	$imx = "imx.php?mode=$modo&amp;size=$size&amp;dir=$dir&amp;file=$arquivo";
	if ($id) {
		$id = ' id="'.$id.'"';
	}
	if ($class) {
		$class = ' class="'.$class.'"';
	}
	$alt = ' alt="'.$alt.'"';
	if ($modo == 'crop') {
		$tamano = explode('x', $size);
		$tamano = ' width="'.$tamano[0].'" height="'.$tamano[1].'"';
	}
	return '<img src="'.$imx.'"'.$alt.$tamano.$id.$class.' />';
}


/*
XERAR UNHA CADEA GET v.1.0
Devolve unha ou varias variables dentro do array $resultado['variables'] en formato GET.

$nomes = nomes das variables que se inclúen, separados por comas
$engadidos = novos engadidos á cadea final
*/
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


/*
IMPRIMIR O ARRAY RESULTADO v.1.0
Imprime o array $resultado dunha maneira máis cómoda
*/
function imprimir_datos () {
	global $resultado;
	foreach ($resultado as $clave => $valor) {
		print("<h1>$clave:</h1>");
		
		if (is_array($valor)) {
			if ($valor) {
			print('<ul>');
				foreach ($valor as $subclave => $subvalor) {
					print('<li>');
					print("<strong>$subclave</strong>: ");
					if (is_array($subvalor)) {
						print_r($subvalor);
					} else {
						print($subvalor);
					}
					print('</li>');
				}
				print('</ul>');
			}
		} else {
			print($valor);
		}
	}
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
CALCULA DIFERENCIA TEMPORAL v.1.0
A partir dunha fecha en formato timestamp, devolve o tempo que pasou ata o presente

$tempo = numero timestamp co que se quere contrastar
$agora = colle o timestamp actual se non se especifica senón o que se poña
*/
function tempo ($tempo, $agora = '') {
	$texto = array (
		'f'	=> LANG == 'gal' ? 'hai' : 'hace',
		'd'	=> 'día',
		'h'	=> 'hora',
		'm'	=> 'minuto',
		'ds'	=> 'días',
		'hs'	=> 'horas',
		'ms'	=> 'minutos',
	);
	
	if (!$agora) {
		$agora = time();
	}
	$diferencia = $agora - $tempo;
	
	//Se fai máis dunha semana
	if ($diferencia >= 604800) {
		$valor = date('d/m/Y', $tempo);
	
	//Se fai máis dun día
	} elseif ($diferencia >= 86400) {
		$dias = intval($diferencia / 86400);
		$horas = intval(($diferencia % 86400) / 3600);
		$ds = ($dias > 1) ? $texto['ds'] : $texto['d'];
		$valor = $texto['f']." $dias $ds";
	
	//Se fai máis dunha hora
	} elseif ($diferencia >= 3600) {
		$horas = intval($diferencia / 3600);
		$minutos = intval(($diferencia % 3600) / 60);
		$hs = ($horas > 1) ? $texto['hs'] : $texto['h'];
		$ms = ($minutos > 1) ? $texto['ms'] : $texto['m'];
		
		//Se sobran minutos
		if ($minutos > 0) {
			$valor = $texto['f']." $horas $hs, $minutos $ms";
		
		//Se fai unha hora xusta
		} else {
			$valor = $texto['f']." $horas $hs";
		}
	
	//Se fai uns poucos minutos
	} else {
		$minutos = intval($diferencia / 60);
		$minutos = ($minutos == 0) ? 1 : $minutos;
		$ms = ($minutos > 1) ? $texto['ms'] : $texto['m'];

		$valor = $texto['f']." $minutos $ms";
	}
	return $valor;
}


/*
RECORTAR TEXTO v.2.0
Recorta un texto mantendo as palabras intactas cunha lonxitude especificada
$texto = texto que se vai buscar
$lonxitude = lonxitude final do texto (por defecto 150 caracteres)
$fin = cadena final que se lle pode meter (por defecto ...)
*/
function recortar ($texto, $limite = 150, $fin = '...') {

	if (strlen($texto) <= $limite) {
		return $texto;
	} else {
		$texto = substr($texto, 0, $limite);
		$restar = strlen(strrchr($texto, ' '));
		if ($restar) {
			$texto = substr($texto, 0, -$restar);
		}
		return $texto.$fin;
	}
}
?>