<?php
defined('OK') or die();


/*
CONTROL DE BASE DE DATOS
Realiza as operaci√≥ns b√°sicas coa base de datos
v.1.0
*/

class SQL {
	var $erros;
	var $conexion;
	var $resultado;
	var $depurar = true;
	var $FILE = __FILE__;
	var $LINE;
	var $lock = false;
	var $host;
	var $usuario;
	var $contrasinal;
	var $base_datos;
	var $filas;
	var $consulta;
	var $query;
	var $indice;
	
	
	//Mete os datos da conexi√≥n
	function iniciar ($host, $usuario, $contrasinal, $base_datos) {
		global $erros;
		$this->erros = &$erros;
		$this->host = $host;
		$this->usuario = $usuario;
		$this->contrasinal = $contrasinal;
		$this->base_datos = $base_datos;
	}
	
	
	//Conecta coa base de datos e carga as variables necesarias
	function conecta () {
		$this->LINE = __LINE__+1;
		$this->conexion = mysqli_connect($this->host,$this->usuario,$this->contrasinal);
		if (!$this->conexion && $this->depurar) { // Non se puido conectar
			$this->erros->erro(mysqli_error($this->conexion));
			return false;
		}
		$this->LINE = __LINE__+1;
		if (!mysqli_select_db($this->conexion, $this->base_datos) && $this->depurar) { // Non se puido conectar
			$this->erros->erro(mysqli_error($this->conexion));
		} else {
			mysqli_query($this->conexion, "SET NAMES 'utf8'");
		}
		return $this->conexion;
	}
	
	
	//Realiza una consulta e garda o resultado
	function query ($cadena) {
		$this->resultado = mysqli_query($this->conexion, $cadena);
		if (!$this->resultado && $this->depurar) {
			$this->erros->erro("<b>Query:</b> $cadena<br /><b>Erro:</b> ".mysqli_error($this->conexion));
			return -1;
		} else {
			return true;
		}
	}
	
	
	//Realiza unha actualizaciÛn na base de datos
	function actualizar ($cadena) {
		$this->query($cadena);
		return mysqli_affected_rows($this->conexion);
	}
	
	
	//Devolve os datos da fila actual do resultado dunha consulta
	function fila () {
		return mysqli_fetch_array($this->resultado);
	}
	
	
	//Cerra a conexiÛn coa base de datos
	function desconectar () {
		mysqli_close($this->conexion);
	}
	
	
	//Realiza unha consulta e obten un array de resultados
	function recuperar ($query) {
		$this->query($query);
		$resultado = array();
		while ($algo = $this->fila()) {
			$resultado[] = $algo;
		}
		mysqli_free_result($this->resultado);
		return $resultado;
	}
	
	
	//Devolve o ID do ˙ltimo rexistro insertado
	function id_ultimo () {
		return mysqli_insert_id();
	}
	
	
	//Bloquea as t√°boas recibidas en $tablas en modo WRITE/READ
	function lock ($tablas, $modo = 'WRITE') {
		if ($this->lock) {
			return true;
		}
		if (is_array($tablas)) {
			$cadena = 'LOCK TABLES '.implode(" $modo,", $tablas)." $modo;";
		} else {
			$cadena = "LOCK TABLES $tablas $modo;";
		}
		if (!mysqli_query($cadena) && $this->depurar) {
			$file = $this->FILE;
			$line = $this->LINE;
			$this->FILE = __FILE__;
			$this->LINE = __LINE__-4;
			$this->erros->erro("<b>Lock:</b> $cadena<br /><b>Erro:</b> ".mysqli_error());
			$this->LINE = $line;
			$this->FILE = $file;
			return -1;
		}
		$this->lock = true;
	}
	
	
	//Desbloquea as t·boas bloqueadas con LOCK
	function unlock () {
		if ($this->lock) {
			if (!mysqli_query("UNLOCK TABLES;") && $this->depurar) {
				$file = $this->FILE;
				$line = $this->LINE;
				$this->FILE = __FILE__;
				$this->LINE = __LINE__-4;
				$this->erros->erro("<b>Unlock:</b> $cadena<br /><b>Erro:</b> ".mysqli_error());
				$this->LINE = $line;
				$this->FILE = $file;
				return -1;
			}
			$this->lock = false;
		}
	}
	
	
	//Escribe no rexistro de erros os problemas en consultas e conexiÛn
	function rexistro_error ($erro) {
		$this->erros->erro($erro);
		if ($this->log) {
			if (is_file($this->log)) {
				$fp = fopen($this->log,'a+');
			} else {
				$fp = fopen($this->log,'w');
			}
			flock($fp, LOCK_EX);
			$txt = '<p><strong>Data:</strong> '.date('Y/m/d H:i:s').'<br /><strong>Arquivo:</strong> '.$this->FILE.'<br /><strong>Li√±a</strong> '.$this->LINE.'<br /><strong>Peticion:</strong> '.getenv('REQUEST_URI').'<br /><strong>Erro:</strong> '.$erro.'</p>';
			fwrite($fp, addslashes($txt));
			flock($fp, LOCK_UN);
			fclose($fp);
		}
	}
	
	
	//Executa a consulta e almacena o resultado
	function serializa () {
		$this->consulta = $this->recuperar($this->query);
		$this->filas = count($this->consulta);
		$this->indice = 0;
	}
	
	
	//Executa a consulta $query
	function put_query ($query,$arq='',$lin='') {
		$this->query = $query;
		$this->FILE = $arq;
		$this->LINE = $lin;
		$this->serializa();
		return $this->filas;
	}
	
	
	//Devolve a ˙ltima consulta executada
	function get_query () {
		return $this->query;
	}
	
	
	//Devolve o resultado da ˙ltima consulta executada
	function resultado () {
		return $this->consulta;
	}
	
	
	//Se non recibe ning˙n par·metro, devolve a posiciÛn actual do √≠ndice, senÛn coloca o √≠ndice na posiciÛn $i
	function indice ($i='') {
		if (strlen($i))
			$this->indice = intval($i);
		else
			return $this->indice;
	}
	
	
	//Se non recibe ning˙n par·metro, suma 1 ao Õndice da posiciÛn actual, senÛn suma $i
	function seguinte ($i='') {
		if (empty($i))
			$this->indice++;
		else
			$this->indice += $i;
	}
	
	
	//Comproba si se chegou ao final dos rexistros
	function mais () {
		if ($this->indice < $this->filas) return true;
		else return false;
	}
	
	
	//Devolve o n˙mero de rexistros da ˙ltima consulta executada
	function filas () {
		return $this->filas;
	}
	
	
	//Devolve o valor da columna $campo do rexistro actual
	function get ($campo='id') {
		return $this->consulta[$this->indice][$campo];
	}
	
	
	//Devolve o valor da columna $campo do rexistro con posiciÛn $indice
	function indice_campo ($indice, $campo='id') {
		return $this->consulta[$indice][$campo];
	}
}
$mysql = new SQL;
?>