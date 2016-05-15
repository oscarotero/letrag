<?php
defined('OK') or die();


/*
CONTROL DE ARQUIVOS
Controla o manexo de arquivos e carpetas
v.1.0
*/

class Arquivos {
	var $erros;
	
	
	function __construct () {
		global $erros;
		$this->erros = &$erros;
	}
	
	
	//Comproba se existe un arquivo ou directorio, se é editable e se é "a" (arquivo) ou "d" (directorio)
	function comprobar_arquivo ($ruta, $editable = false, $tipo = '') {
	
		$valido = false;
		
		if ($editable) {
			if (is_writable($ruta)) {
				$valido = true;
			}
		} else {
			if (is_readable($ruta)) {
				$valido = true;
			}
		}
		
		if ($valido && $tipo) {
		
			switch ($tipo) {
				case 'a':
				if (!is_file($ruta)) {
					$valido = false;
				}
				break;
				
				case 'd':
				if (!is_dir($ruta)) {
					$valido = false;
				}
				break;
			}
		}
		return $valido;
	}
	
	
	//Devolve o texto gardado nun arquivo
	function le_texto_arquivo ($arquivo) {
		if ($this->comprobar_arquivo($arquivo, '', 'a')) {
			if ($abrir = fopen($arquivo, 'r')) {
				$valor = '';
				while (!feof($abrir)) {
					$valor .= fgets($abrir, 4096);
				}
				fclose($abrir);
				return ($valor);
			} else {
				$this->erros->erro("O arquivo '$arquivo' non se pode abrir");
			}
		
		} else {
			$this->erros->erro("O arquivo '$arquivo' non existe");
		}
	}
	
	
	//Garda un texto nun arquivo 
	function escribe_texto_arquivo ($texto, $directorio, $arquivo, $modo = 'w') {
		$valido = false;		

		if ($this->comprobar_arquivo($directorio.$arquivo, true, 'a')) {
			$valido = true;
		} else if (!$this->comprobar_arquivo($directorio.$arquivo, false, 'a') && $this->comprobar_arquivo($directorio, true, 'd')) {
			$valido = true;
		} else {
			$this->erros->erro("Non se pode escribir en '$directorio.$arquivo'");
		}
		
		if ($valido) {
			$abrir = fopen($directorio.$arquivo, $modo);
			fwrite($abrir, $texto);
			fclose($abrir);
		}
	}
	
	
	//Simplificar o nome dun arquivo eliminando caracteres problematicos
	function simplificar ($texto) {
		$busca = array  ('á','é','í','ó','ú','à','è','ì','ò','ù','â','ê','î','ô','û','ä','ë','ï','ö','ü','Á','É','Í','Ó','Ú','À','È','Ì','Ò','Ù','Â','Ê','Î','Ô','Û','Ä','Ë','Ï','Ö','Ü','ñ','Ñ','ç','Ç',' ');
		$cambia = array ('a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','A','E','I','O','U','A','E','I','O','U','A','E','I','O','U','A','E','I','O','U','n','N','c','C','_');
		$texto = str_replace($busca, $cambia, trim(strtolower($texto)));
		$texto = preg_replace('/[^a-z0-9_-]/', '', $texto);
		return $texto;
	}
	
	
	//Copiar un arquivo nun directorio (se non se especifica o nome, colle o orixinal)
	function copiar_arquivo ($arquivo, $directorio, $prefixo = '', $nome = '', $sufixo = '') {
	
		if ($this->comprobar_arquivo($arquivo)) {
		
			$extension = strrchr($nome, '.');
			$nome_arquivo = substr($nome, 0, strripos($nome, '.'));
			$nome_arquivo = $this->simplificar($nome_arquivo);
			$nome_arquivo = $prefixo.$nome_arquivo.$sufixo.$extension;
			
			if ($this->comprobar_arquivo($directorio, true, 'd')) {
				copy ($arquivo, $directorio.$nome_arquivo);
			} else {
				$this->erros->erro("Non se pode gardar o arquivo '$nome_arquivo' no directorio '$directorio'");
			}
			return $nome_arquivo;
		} else {
			return false;
		}
	}
	
	
	
	//Crear un directorio novo
	function crear_directorio ($ruta, $nome, $permisos = 0777) {
		if ($this->comprobar_arquivo($ruta, true, 'd')) {
			mkdir($ruta.$nome, $permisos);
		} else {
			$this->erros->erro("Non se pode crear o directorio '$nome' en '$ruta'");
		}
	}
	
	
	//Borrar un arquivo
	function borrar_arquivo ($arquivo) {
		if ($this->comprobar_arquivo($arquivo, true, 'a')) {
			unlink($arquivo);
		} else {
			$this->erros->erro("Non se pode eliminar o arquivo '$arquivo'");
		}
	}
}

$arquivos = new Arquivos;
?>
