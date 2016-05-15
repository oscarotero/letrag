<?php
defined('OK') or die();


/*
EXTENSIÓN DA CLASE DATOS
Extensión da clase Datos con máis funcións
v.1.1.1
*/

class Datos_extend extends Datos {
	var $paxinado = array();	//Datos das funcións de paxinar
	var $buscar = array();		//Datos das funcións de buscar
	var $fungallas = array();	//Datos das funcións de fungallas
	
	
	//Fai unha selección para paxinar os resultados
	function paxinado_seleccionar ($taboas, $campos, $query, $orde, $paxina, $limite, $total = false) {
		$this->buscar = array();
		
		$this->paxinado['pax'] = $paxina;
		if (!$this->paxinado['pax']) {
			$this->paxinado['pax'] = 1;
		}
		$this->paxinado['limite'] = $limite;
		$this->paxinado['limite_2'] = $limite ? $limite : 100;
		
		//Calcular os límites da selección
		$this->paxinado['limite_1'] = ($this->paxinado['pax'] * $this->paxinado['limite_2']) - $this->paxinado['limite_2'];
		
		//Calcula os rexistros totais
		if ($total) {
			$taboas_contar = str_replace(' | ', ', ', $taboas);
			$total = $this->contar($taboas_contar, $query);
			$this->paxinado['total_rexistros'] = $total;
			$this->paxinado['total'] = true;
		}
		
		//Fai a selección
		$this->seleccionar($taboas, $campos, $query, $orde, $this->paxinado['limite_1'].', '.($this->paxinado['limite_2'] + 1));
	}
	
	
	//Executa a funcion de resultado gardando a maiores os valores das páxinas
	function paxinado_resultado ($array = '', $indice = '', $varios_por_indice = '') {
	
		$resultado = $this->resultado('', '', $indice, $varios_por_indice);
		$paxinado = array();
		
		if ($this->paxinado) {
			//Calcula as páxinas seguinte e anterior
			if (count($resultado) >= ($this->paxinado['limite_2'] + 1)) {
				array_pop($resultado);
				$paxinado['seguinte'] = $this->paxinado['pax'] + 1;
			}
			if ($this->paxinado['pax'] > 1) {
				$paxinado['anterior'] = $this->paxinado['pax'] - 1;
			}
			$paxinado['actual'] = $this->paxinado['pax'];
			$paxinado['indice'] = $this->paxinado['limite_1'] + 1;

			if ($this->paxinado['total']) {
				$paxinado['total_rexistros'] = $this->paxinado['total_rexistros'];
				$paxinado['total_paxinas'] = ceil($this->paxinado['total_rexistros'] / $this->paxinado['limite']);
				if (!$paxinado['total_paxinas']) {
					$paxinado['total_paxinas'] = 1;
				}
			}
			
			$this->paxinado = array();
		}
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
			$this->datos['paxinado'] = $paxinado;
		} else {
			$resultado['paxinado'] = $paxinado;
			return($resultado);
		}
	}
	
	
	//Devolve un query de búsqueda automaticamente vendo cal é a mellor maneira
	function buscar_query_automatico ($texto, $taboa, $campos, $campos_like = '', $modo_boleano = false) {
		$palabras = explode(' ', $texto);
		foreach ($palabras as $clave => $valor) {
			if (strlen($valor) < 3) {
				unset($palabras[$clave]);
			}
		}
		$palabras = count($palabras);
		
		if ($palabras == 1 || strpos($texto, '"') || strpos($texto, '"') === 0) {
			if (!$campos_like) {
				$campos_like = $campos;
			}
			$query = $this->buscar_query_like($texto, $taboa, $campos_like);
		} else {
			$query = $this->buscar_query_fulltext($texto, $taboa, $campos, $modo_boleano);
		}
		
		return $query;
	}
	
	//Crea unha consulta para realizar búsquedas sobre índices fulltext
	function buscar_query_fulltext ($texto, $taboa, $campos, $modo_boleano = false, $limite_relevancia = 0) {
		$this->buscar = array();

		if (strlen($texto) >= 3) {
			$this->buscar['tipo'] = 'fulltext';
			$this->buscar['texto'] = $texto;
			
			if ($modo_boleano) {
				$boleano = 'IN BOOLEAN MODE';
			}
			
			$array_campos = explode (', ', $campos);
			foreach ($array_campos as $clave => $valor) {
				$array_campos[$clave] = "$taboa.$valor";
			}
			$campos = implode($array_campos, ', ');
			
			$this->buscar['query'] = "MATCH ($campos) AGAINST ('$texto' $boleano)";
			if ($limite_relevancia) {
				$this->buscar['query'] .= " > $limite_relevancia";
			}
			$this->buscar['campos'] = "MATCH ($campos) AGAINST ('$texto' $boleano) as relevancia";
		}
		
		return $this->buscar;
	}
	
	
	//Crea unha consulta para realizar búsquedas con Like
	function buscar_query_like ($texto, $taboa, $campos) {
		$this->buscar = array();
		
		if (strlen($texto) >= 3) {
			$this->buscar['tipo'] = 'like';
			$this->buscar['texto'] = $texto;
			$array_palabras = array();
			
			//Buscar textos entre comiñas
			preg_match_all('/"([^"]*)"/', $texto, $palabras);
			$texto = str_replace('"', '', $texto);
			
			foreach ($palabras[1] as $valor) {
				if (strlen($valor) >= $this->buscar_palabra_minima) {
					$array_palabras[] = $valor;
				}
				$texto = str_replace($valor, '', $texto);
			}
			
			//Eliminar caracteres raros
			$texto = preg_replace('/[^A-Za-z0-9áéíóúçñüAÉÍÓÚÇÑÜ]+/', ' ', $texto);
			$texto = preg_replace('/[ ]{2,}/', ' ', trim($texto));
	
			//Buscar resto de palabras
			$palabras = explode(' ', $texto, 5);
			$palabras = array_unique($palabras);
			
			foreach ($palabras as $valor) {
				if (strlen($valor) >= $this->buscar_palabra_minima) {
					$array_palabras[] = $valor;
				}
			}
			
			//Crear a consulta
			if (count($array_palabras)) {
				$campos = explode(', ', $campos);
				foreach ($array_palabras as $valor) {
					$subquery = '';
					foreach ($campos as $subvalor) {
						$subquery .= " OR $subvalor LIKE '%$valor%'";
					}
					$subquery = substr($subquery, 4);
					$this->buscar_query['query'] .= " AND ($subquery)";
				}
				$this->buscar['query'] = substr($this->buscar_query['query'], 4);
			}
		}
		
		return $this->buscar;
	}
	
	
	//Selecciona un ou varios textos estáticos da web
	function seleccionar_textos ($lugar = '', $array = 'textos', $tipo = 'grande', $campos = 'texto', $taboa = 'textos') {
		$query = 'activo = 1';
		if ($lugar) {
			$query .= " AND lugar = '$lugar'";
		}
		if ($tipo) {
			$query .= " AND tipo = '$tipo'";
		}
		$this->seleccionar($taboa, $campos.', lugar', $query, 'orde DESC', '');
		$resultado = $this->resultado('', '', 'lugar');
		
		if (!$this->datos[$array][$tipo]) {
			$this->datos[$array][$tipo] = array();
		}
		$this->datos[$array][$tipo] += $resultado;
	}
	
	
	//Seleccionar os textos pequenos da web
	function seleccionar_textos_pequenos ($array = 'textos', $campo = 'texto', $taboa = 'textos') {
		$this->seleccionar($taboa, $campo.', lugar', "activo = 1", 'lugar', '');
		$resultado = $this->resultado('', '');
		
		if (!$this->datos[$array]) {
			$this->datos[$array] = array();
		}
		
		foreach ($resultado as $valor) {
			$this->datos[$array][$valor['lugar']] = $valor[$campo];
		}
	}
	
	
	//Obter un menú de fungallas
	function fungallas ($array, $taboa_relacion, $seccion, $campos = 'id, nome', $taboa_seccions = 'seccions') {
	
		//Seleccionar todas as seccions que haxa (no caso de que non se seleccionaran antes)
		if (!$this->fungallas[$taboa_relacion]) {
			$this->seleccionar($taboa_seccions, $campos.', seccion', "taboa_relacion = '$taboa_relacion' AND activo = 1", '', '');
			$this->fungallas[$taboa_relacion] = $this->resultado('', '', 'id');
		}
		
		$resultado = array();
		$indice = $seccion;
		
		//Crear o menú fungallas
		while ($indice) {
			$resultado[] = $this->fungallas[$taboa_relacion][$indice];
			$indice = $this->fungallas[$taboa_relacion][$indice]['seccion'];
		}
		krsort($resultado);
		
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return $resultado;
		}
	}
}


$datos = new Datos_extend;
?>
