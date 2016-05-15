<?php
defined('OK') or die();


/*
CONTROL DE DATOS
Controla os datos que se mostran na páxina, realizando as consultas necesarias
v.1.1
*/

class Datos {
	var $erros;		//Clase para os erros
	var $mysql;		//Clase para as consultas mysql
	var $datos = array();	//Array onde se gardan os resultados
	var $query;		//Consulta actual
	var $campos = array();	//Array cos nomes de todos os campos da consulta actual
	
	
	//Constructor da clase (inicia a base de datos, etc);
	function __construct () {
		global $erros, $mysql;
		$this->erros = &$erros;
		$this->mysql = &$mysql;
	}
	
	
	//Selecciona datos na base de datos
	function seleccionar ($taboas, $campos, $consulta = '', $orden = '', $limite = 1) {
		
		//Preparar campos e táboas para seleccionar
		$this->campos = array();
		$array_taboas = explode(' | ', $taboas);
		$array_campos = explode(' | ', $campos);
		
		foreach ($array_campos as $clave => $valor) {
			if (trim($valor)) {
				
				if (strpos($valor, 'AGAINST')) {
					$campo = preg_match('/, MATCH \([a-z_\., ]+\) AGAINST \([^\)]+\)( as [a-z]+)?/i', $valor, $coincidencia);
					$valor = str_replace($coincidencia[0], '', $valor);
					$q_campos .= $coincidencia[0];
					$this->campos[] = $coincidencia[0];
				}
				
				$a_campos = explode(', ', $valor);
				$q_campos .= ', '.$array_taboas[$clave].'.'.implode(', '.$array_taboas[$clave].'.', $a_campos);
				$this->campos = array_merge($this->campos, $a_campos);
			}
		}
		$q_campos = substr($q_campos, 2);
		$q_taboas = implode('`, `', $array_taboas);
		$q_taboas = "`$q_taboas`";
		
		//Preparar a consulta
		$this->query = "SELECT $q_campos FROM $q_taboas";
		if ($consulta) {
			$this->query .= " WHERE $consulta";
		}
		if ($orden) {
			$this->query .= " ORDER BY $orden";
		}
		if ($limite) {
			$this->query .= " LIMIT $limite";
		}
		
		//Facer a consulta
		$this->mysql->put_query ($this->query);
	}
	
	
	//Garda os resultados dunha consulta no array datos
	function resultado ($array = '', $limite = 1, $indice = '', $varios_por_indice = '') {
		
		//Preparar campos
		$resultado = array();
		foreach ($this->campos as $clave => $valor) {
			if ($novo_nome = strstr($valor, ' as ')) {
				$this->campos[$clave] = substr($novo_nome, 4);
			}
		}
		$this->campos = array_unique($this->campos);

		
		//Gardar datos
		if ($limite == 1) {
			foreach ($this->campos as $valor) {
				$resultado[$valor] = $this->mysql->get($valor);
			}
		} else {
			if ($indice) {
				if ($varios_por_indice) {
					for (; $this->mysql->mais(); $this->mysql->seguinte()) {
						foreach ($this->campos as $valor) {
							$resultado[$this->mysql->get($indice)][$this->mysql->indice()][$valor] = $this->mysql->get($valor);
						}
					}
				} else {
					for (; $this->mysql->mais(); $this->mysql->seguinte()) {
						foreach ($this->campos as $valor) {
							$resultado[$this->mysql->get($indice)][$valor] = $this->mysql->get($valor);
						}
					}
				}
			} else {
				for (; $this->mysql->mais(); $this->mysql->seguinte()) {
					foreach ($this->campos as $valor) {
						$resultado[$this->mysql->indice()][$valor] = $this->mysql->get($valor);
					}
				}
			}
		}
		
		//Gardar array ou devolver resultado
		if ($array) {
			$this->datos[$array] = $resultado;
		} else {
			return($resultado);
		}
	}
	
	
	//Inserta un rexistro na base de datos e devolve o id
	function insertar ($taboa, $campos, $valores) {
		$this->query = "INSERT INTO `$taboa` ($campos) VALUES ($valores)";
		$this->mysql->put_query($this->query);
		return $this->mysql->id_ultimo();
	}
	
	
	//Actualiza un rexistro na base de datos
	function actualizar ($taboa, $actualizacion, $consulta, $limite = 1) {
		
		if ($limite) {
			$limite = 'LIMIT '.$limite;
		}
		$this->query = "UPDATE `$taboa` SET $actualizacion WHERE $consulta $limite";
		$this->mysql->put_query($this->query);
	}
	
	
	//Elimina un ou varios rexistros na base de datos
	function eliminar ($taboa, $consulta, $limite = 1) {
		
		if ($limite) {
			$limite = 'LIMIT '.$limite;
		}
		
		$this->query = "DELETE FROM $taboa WHERE $consulta $limite";
		$this->mysql->put_query($this->query);
	}
	
	
	//Fai un reconto de rexistros na base de datos
	function contar ($taboa, $consulta = '') {
		$taboa = str_replace(', ', '`, `', $taboa);
		
		$this->query = "SELECT COUNT(*) as total FROM `$taboa`";
		if ($consulta) {
			$this->query .= ' WHERE '.$consulta;
		}
		$this->mysql->put_query($this->query);
		return $this->mysql->get('total');
	}
	
	
	//Imprime a última consulta efectuada
	function imprimir_query () {
		print("<p>$this->query</p>");
	}
	
	
	//Convirte un array con ids para que poida ser metido nun IN ()
	function query_in ($array, $valor_in = '') {
		$novo_array = array();
		
		if ($valor_in) {
			foreach ((array)$array as $clave => $valor) {
				$novo_array[$clave] = $valor[$valor_in];
			}
		} else {
			foreach ((array)$array as $clave => $valor) {
				$novo_array[$clave] = $clave;
			}
		}
		$novo_array = array_unique($novo_array);
		return implode(',', $novo_array);
	}
	
	
	//Engade máis cousas no array Datos
	function engadir ($engadido) {
		$this->datos = array_merge($this->datos, $engadido);
	}
}
$datos = new Datos;
?>