<?php
defined('OK') or die();


/*
CONTROL DE DATOS PARA IDENTIFICAR UN REXISTRO
Controla o proceso de responder preguntas para chegar a un rexistro concreto
v.1.3.1
*/

class Identificar extends Datos {
	var $taboa_preguntas	= 'identificar';			//Táboa coas preguntas
	var $taboa_respostas	= 'identificar_respostas';		//Táboa coas respostas
	var $taboa_productos	= 'tipografias';			//Táboa cos productos
	var $taboa_relacions	= 'relacion_identificar_tipografias';	//Táboa coas relacións
	var $pregunta		= 0;					//Pregunta actual
	var $paso		= 0;					//Paso actual
	var $query_preguntas	= '';					//Query para facer a pregunta
	var $query_resultado	= '';					//Query para os resultados
	
	
	//Prepara o texto para filtrar as preguntas
	function texto ($texto = '') {
	
		if ($texto) {
					
			//Coller as letras
			$busca =  array ('á','é','í','ó','ú','à','è','ì','ò','ù','â','ê','î','ô','û','ä','ë','ï','ö','ü','Á','É','Í','Ó','Ú','À','È','Ì','Ò','Ù','Â','Ê','Î','Ô','Û','Ä','Ë','Ï','Ö','Ü','ñ','Ñ','ç','Ç');
			$cambia = array ('a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','A','E','I','O','U','A','E','I','O','U','n','N','c','C');
			$texto = str_replace($busca, $cambia, $texto);
			$texto = preg_replace('/[^a-z]/i', '', $texto);
			$texto = preg_replace('/([A-Z])/', ' \\1'.'2', $texto);
			$texto = preg_replace('/([a-z])/', ' \\1'.'1', $texto);
			$texto = str_replace('  ', ' ', $texto);
			
			$array_mostras = explode(' ', trim($texto));
			$array_mostras = array_unique($array_mostras);
			
			//Preparar o query
			$query = '';
			foreach ((array)$array_mostras as $letra) {
				$query .= "letras LIKE '%".$letra."%' || ";
			}
			$this->query_preguntas = "$query letras LIKE 'todas'";
		}
	}
	
	
	
	//Prepara a consulta para filtrar as respostas
	function consulta ($variables) {
		$query = '';
		foreach ($variables as $key => $valor) {
			if (is_numeric($key)) {
				$query .= " && $this->taboa_relacions.p".intval($key)." LIKE '%/".intval($valor)."/%'";
			}
		}
		if ($query) {
			$this->query_resultado = '('.substr($query, 4).')';
		}
	}

		
	
	//Obten a pregunta actual
	function pregunta ($array = 'pregunta', $campos = 'id, nome_gal') {
		
		$this->paso = intval($this->paso) - 1;
		
		if ($this->paso >= 0) {
			$this->seleccionar($this->taboa_preguntas, $campos, $this->query_preguntas, 'orden', "$this->paso, 1");
			$resultado = $this->resultado();
			$this->pregunta = $resultado['id'];
		
			//Gardar array ou devolver resultado
			if ($array) {
				$this->datos[$array] = $resultado;
			} else {
				return $resultado;
			}
		}
	}
	
	
	
	//Obter as respostas actuais
	function respostas ($array = 'respostas', $campos = 'id, nome_gal') {
		
		if ($this->pregunta) {
			$this->seleccionar($this->taboa_respostas, $campos, "$this->taboa_preguntas = $this->pregunta", '', '');
			$resultado = $this->resultado('', '');
		
			//Gardar array ou devolver resultado
			if ($array) {
				$this->datos[$array] = $resultado;
			} else {
				return $resultado;
			}
		}
	}
	
	
	//Contar os resultados totais e as preguntas totais
	function reconto ($array = 'total') {
		$resultado = array();
		
		//Resultados atopados
		$resultado['resultados'] = $this->contar($this->taboa_relacions, $this->query_resultado);
		
		//Preguntas totais
		$resultado['preguntas'] = $this->contar($this->taboa_preguntas, $this->query_preguntas);
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return $resultado;
		}
	}
	
	
	//Devolve os productos atopados
	function productos ($array = 'resultado', $campos = 'id, nome', $orde = 'nome') {
	
		//Seleccionar os productos
		if ($this->query_resultado) {
			$this->seleccionar("$this->taboa_productos | $this->taboa_relacions", "$campos | ", "$this->query_resultado && $this->taboa_relacions.$this->taboa_productos = $this->taboa_productos.id", $orde, '');
			$resultado = $this->resultado('', '');
		}
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return $resultado;
		}
	}
	
	
	//Encontra productos parecidos ao especificado
	function productos_parecidos ($array = 'resultado', $campos = 'id, nome', $orde = 'nome', $id_producto, $num_resultados) {
		
		//Seleccionar as preguntas
		$this->seleccionar($this->taboa_preguntas, 'id, letras', '', '', '');
		$resultado = $this->resultado('', '', 'id');
		
		//Aplicar a puntuación de cada pregunta (hai preguntas máis importantes ca outras)
		$campos_respostas = $this->taboa_productos;
		foreach ($resultado as $clave => $valor) {
			$resultado[$clave]['puntos'] = $valor['letras'] == 'todas' ? 5 : 1;
			$campos_respostas .= ", p$clave";
		}
		
		//Coller as caracteristicas de similitude do producto
		$this->seleccionar($this->taboa_relacions, $campos_respostas, "$this->taboa_productos = $id_producto");
		$resultado2 = $this->resultado('');
		foreach ($resultado as $clave => $valor) {
			$resultado[$clave]['resposta'] = substr($resultado2["p$clave"], 1, -1);
			$resultado[$clave]['resposta'] = explode('/', $resultado[$clave]['resposta']);
		}
		
		//Seleccionar todos os productos
		$this->seleccionar($this->taboa_relacions, $campos_respostas, "$this->taboa_productos != $id_producto", '', '');
		$resultado2 = $this->resultado('', '');
		
		//Ordenar productos por similitude
		$similitude = array();
		foreach ($resultado2 as $clave => $valor) {
			$id = $valor[$this->taboa_productos];
			foreach ($resultado as $subclave => $subvalor) {
				$resposta = substr($valor["p$subclave"], 1, -1);
				$resposta = explode('/', $resposta);
				
				foreach ($resposta as $subsubvalor) {
					if (in_array($subsubvalor, $subvalor['resposta'])) {
						$similitude[$id] += $resultado[$subclave]['puntos'];
					}
				}
			}
		}
		arsort($similitude);
		$similitude = array_slice($similitude, 0, $num_resultados, true);
		
		//Seleccionar os productos resultantes
		$in = $this->query_in($similitude);
		$this->seleccionar($this->taboa_productos, $campos, "id IN ($in)", '', '');
		$resultado = $this->resultado('', '', 'id');
		
		//Ordenar os productos resultantes por similitude
		$resultado2 = array();
		$n = 0;
		foreach ($similitude as $clave => $valor) {
			$resultado2[$n] = $resultado[$clave];
			$resultado2[$n]['similitude'] = $valor;
			$n++;
		}

		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado2;
		} else {
			return $resultado2;
		}
	}
	
	
	//Obten as variables para as ligazón do seguinte paso
	function variables () {
		$variables = strstr($_SERVER['REQUEST_URI'], '?');
		if ($variables) {
			$variables = substr($variables, 1);
			$variables = preg_replace('/paso=[0-9]{1,2}/', 'paso='.($this->paso + 2), $variables);
			$variables = str_replace('&', '&amp;', $variables);
			return $variables;
		} else {
			return false;
		}
	}
		
	

	
	//Garda todo na clase Datos
	function gardar () {
		global $datos;
		$datos->engadir($this->datos);
		$this->datos = array();
	}
}
$datosIdentificar = new Identificar;
?>
