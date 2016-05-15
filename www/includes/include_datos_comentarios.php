<?php
defined('OK') or die();


/*
CONTROL DE COMENTARIOS
Controla os comentarios que se deixan na páxina
1.1
*/

class Comentarios extends Datos {
	var $taboa_comentarios = 'comentarios';	//Taboa onde se gardan os comentarios
	var $taboa = 'noticias';		//Taboa cos rexistros que levan comentarios
	var $id = 0;				//Id do rexistro actual
	var $tempo_inicial = 0;			//Límite inicial de tempo (para seleccionar os últimos comentarios)
	var $limite = '';			//Límite de posts que se seleccionan
	var $orde = 'id';			//Campo polo que se ordenan os comentarios (por id, por data)
	var $spam = false;			//Variable de seguridade para evitar o spam
	var $num_comentarios = 0;		//Número de comentarios deste rexistro
	
	
	//Seleccionar os comentarios
	function listar_comentarios ($campos = 'id, nome, email, web, texto') {
		if (!$this->spam) {
			$query = "taboa_relacion = '$this->taboa' AND id_relacion = $this->id";
			if ($this->tempo_inicial) {
				$query .= "AND data > $this->tempo_inicial";
			}
			
			$orde = $this->limite ? 'DESC' : 'ASC'; //Se hai límite, pilla os últimos senón pilla todo ordenado en sentido inverso
			$this->seleccionar($this->taboa_comentarios, $campos, $query, "$this->orde $orde", $this->limite);
			$this->resultado('comentarios', $this->limite);
		}
	}
	
	
	
	//Comprobar spam (límite 4 horas)
	function spam ($captcha, $solucion = 10, $limite_tempo = 14400, $separador = '-') {
		$tempo = time();
		$array_captcha = explode('-', $captcha);
		
		if ($array_captcha[0] < $tempo && $array_captcha[0] > ($tempo - $limite_tempo) && $array_captcha[1] == $solucion) {
			$this->spam = false;
		} else {
			$this->spam = true;
		}
	}
	
	
	//Gardar comentario
	function gardar_comentario ($texto = '', $nome = '', $email = '', $web = '', $data = '') {
		if (!$this->spam) {
		
			$campos = array();
			$valores = array();
		
			//Comprobar datos
			if ($email) {
				if (ereg("^[a-zA-Z0-9_\.\-]{2,}@[a-zA-Z0-9_\.\-]{2,}\.[a-zA-Z]{2,4}$", $email)) {
					$campos[] = 'email';
					$valores[] = "'".strtolower($email)."'";
				}
			}
			
			if ($web) {
				if (ereg("^(http:\/\/|ftp:\/\/)?[a-zA-Z0-9_\.\-]*(\/?)([a-zA-Z0-9\-\.\?\/\\\+\:&amp;%\$#_=]*)?$", $web)) {
					$web = str_replace('http://', '', $web);
					$campos[] = 'web';
					$valores[] = "'".strtolower($web)."'";
				}
			}
			
			if ($nome) {
				$nome = strip_tags($nome);
				$nome = mysql_real_escape_string($nome);
				$campos[] = 'nome';
				$valores[] = "'$nome'";
			}
		
			if ($texto) {
				$texto = strip_tags($texto, '<a>');
				$texto = mysql_real_escape_string($texto);
				$campos[] = 'texto';
				$valores[] = "'$texto'";
			}
		
			if ($campos && $valores) {
				$campos[] = 'taboa_relacion';
				$campos[] = 'id_relacion';
				$valores[] = "'$this->taboa'";
				$valores[] = "'$this->id'";
				
				$campos = implode($campos, ', ');
				$valores = implode($valores, ', ');
			}
		
			//Gardar os datos
			$this->insertar($this->taboa_comentarios, $campos, $valores);
			
			//Actualizar o reconto de comentarios totais
			$this->num_comentarios = $this->contar($this->taboa_comentarios, "taboa_relacion = '$this->taboa' AND id_relacion = $this->id");
			$this->actualizar($this->taboa, "$this->taboa_comentarios = $this->num_comentarios", "id = $this->id", 1);
		}
	}
	
	
	//Garda todo na clase Datos
	function gardar ($array = 'comentarios') {
		global $datos;
		
		$datos->datos[$array] = array();
		$datos->datos[$array]['comentarios']	= $this->datos['comentarios'];
		$datos->datos[$array]['total']		= $this->num_comentarios;
		$datos->datos[$array]['spam']		= time();
		$datos->datos[$array]['taboa']		= $this->taboa;
		$datos->datos[$array]['id']		= $this->id;
		
		$this->datos = array();
	}
	
}
$datosComentarios = new Comentarios;
?>