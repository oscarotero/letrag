<?php
defined('OK') or die();


/*
MANEXO DE XML
Controla os datos dun arquivo en formato xml
v.1.0
*/

class Xml {
	var $parseador;
	
	var $profundidade = -1;				//Profundidade actual do xml
	var $contador = array();			//Contador para entradas repetidas
	var $etiquetas = array();			//Etiquetas dende profundidade 0 ata actual
	var $elemento_novo;					//Si se introduce un valor novo ou non (necesario para que non se fragmenten os valores de cada elemento)
	var $elemento_actual = array();		//Array con "datos" e "parámetros" do valor actual
	var $array_xml = array();			//Array onde se gardan todos os datos do xml
	
	
	
	//Constructor da clase (inicia algunhas variables, etc);
	function Xml () {
		$this->contador = array_fill (0, 6, 0);
	}
	
	
	
	
	/*
	CARGAR UN XML
	Carga e procesa un arquivo xml gardando os datos en forma de array para a súa correcta manipulacion
	$url = url do arquivo xml
	*/
	function cargar ($url) {
		$this->parseador = xml_parser_create();
		xml_set_object($this->parseador, $this);
		xml_set_element_handler($this->parseador, 'elemento_inicio', 'elemento_fin');
		xml_set_character_data_handler($this->parseador, "parsear");
		
		if (!($abrir = fopen($url, "r"))) {
			die("Non se pode abrir o ficheiro XML");
		}
		
		while ($datos = fread($abrir, 4096)) {
			if (!xml_parse($this->parseador, $datos, feof($abrir))) {
				die(sprintf("XML erro: %s na liña %d", xml_error_string(xml_get_error_code($this->parseador)), xml_get_current_line_number($this->parseador), xml_get_current_column_number($this->parseador)));
			}
		}
		fclose($abrir);
		xml_parser_free($this->parseador);
	}
	
	
	
	
	//Funcion interna para coller os valores de cada elemento do xml
	function parsear ($parseador, $datos) {
		if ($this->elemento_novo) {
			$this->elemento_actual['valor'] = $datos;
		} else {
			$this->elemento_actual['valor'] .= $datos;
		}
	}
	
	
	
	
	//Funcion interna que se executa ó principio de cada elemento do xml recollendo os atributos
	function elemento_inicio ($parser, $nome, $atributos) {
		
		$this->profundidade++;
		
		if ($this->etiquetas[$this->profundidade] == $nome) {
			$this->contador[$this->profundidade]++;
		} else {
			$this->contador[$this->profundidade] = 0;
			$this->etiquetas[$this->profundidade] = $nome;
		}
		
		$this->etiquetas[$this->profundidade] = $nome;
		$this->elemento_novo = false;
		
		if ($atributos) {
			$this->elemento_actual['atributos'] = $atributos;
		}
	}
	
	
	
	//Funcion interna que se exectua ó final de cada elemento do xml gardando os datos no xml
	function elemento_fin($parser, $nome) {
		
		if (!$this->elemento_actual['valor']) {
			unset($this->elemento_actual['valor']);
		}
		
		switch ($this->profundidade) {

			case 0:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						= $this->elemento_actual;
				}
			break;
			
			case 1:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]][$this->etiquetas[1]][$this->contador[1]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						[$this->etiquetas[1]][$this->contador[1]]
						= $this->elemento_actual;
				}
			break;
			
			case 2:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]][$this->etiquetas[1]][$this->contador[1]][$this->etiquetas[2]][$this->contador[2]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						[$this->etiquetas[1]][$this->contador[1]]
						[$this->etiquetas[2]][$this->contador[2]]
						= $this->elemento_actual;
				}
			break;
			
			case 3:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]][$this->etiquetas[1]][$this->contador[1]][$this->etiquetas[2]][$this->contador[2]][$this->etiquetas[3]][$this->contador[3]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						[$this->etiquetas[1]][$this->contador[1]]
						[$this->etiquetas[2]][$this->contador[2]]
						[$this->etiquetas[3]][$this->contador[3]]
						= $this->elemento_actual;
				}
			break;
			
			case 4:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]][$this->etiquetas[1]][$this->contador[1]][$this->etiquetas[2]][$this->contador[2]][$this->etiquetas[3]][$this->contador[3]][$this->etiquetas[4]][$this->contador[4]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						[$this->etiquetas[1]][$this->contador[1]]
						[$this->etiquetas[2]][$this->contador[2]]
						[$this->etiquetas[3]][$this->contador[3]]
						[$this->etiquetas[4]][$this->contador[4]]
						= $this->elemento_actual;
				}
			break;
			
			case 5:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]][$this->etiquetas[1]][$this->contador[1]][$this->etiquetas[2]][$this->contador[2]][$this->etiquetas[3]][$this->contador[3]][$this->etiquetas[4]][$this->contador[4]][$this->etiquetas[5]][$this->contador[5]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						[$this->etiquetas[1]][$this->contador[1]]
						[$this->etiquetas[2]][$this->contador[2]]
						[$this->etiquetas[3]][$this->contador[3]]
						[$this->etiquetas[4]][$this->contador[4]]
						[$this->etiquetas[5]][$this->contador[5]]
						= $this->elemento_actual;
				}
			break;
			
			case 6:
				if (!$this->array_xml[$this->etiquetas[0]][$this->contador[0]][$this->etiquetas[1]][$this->contador[1]][$this->etiquetas[2]][$this->contador[2]][$this->etiquetas[3]][$this->contador[3]][$this->etiquetas[4]][$this->contador[4]][$this->etiquetas[5]][$this->contador[5]][$this->etiquetas[6]][$this->contador[6]]) {
					$this->array_xml
						[$this->etiquetas[0]][$this->contador[0]]
						[$this->etiquetas[1]][$this->contador[1]]
						[$this->etiquetas[2]][$this->contador[2]]
						[$this->etiquetas[3]][$this->contador[3]]
						[$this->etiquetas[4]][$this->contador[4]]
						[$this->etiquetas[5]][$this->contador[5]]
						[$this->etiquetas[6]][$this->contador[6]]
						= $this->elemento_actual;
				}
			break;
		}

		array_splice($this->etiquetas, $this->profundidade+1);
		$this->elemento_actual = array();
		$this->profundidade--;
		$this->elemento_novo = true;
	}
	
	
	
	
	/*
	DEVOLVE UN FEED EN ATOM
	Procesa o array como se fose de Atom e devolveo formateado
	*/
	function dame_atom() {
	
		$atom = array();
		foreach ($this->array_xml['FEED'][0] as $clave => $valor) {
		
			if ($clave == 'ENTRY') {
				foreach ($valor as $indice => $entrada) {
					foreach ($entrada as $etiqueta => $contido) {
						
						switch ($etiqueta) {
							case 'TITLE':
							$atom['posts'][$indice]['titulo'] = $this->preparar_texto($contido[0]['valor']);
							break;
							
							case 'PUBLISHED':
							$atom['posts'][$indice]['data_publicacion'] = $this->preparar_datas($contido[0]['valor']);
							break;
							
							case 'UPDATED':
							$atom['posts'][$indice]['data_actualizacion'] = $this->preparar_datas($contido[0]['valor']);
							break;
							
							case 'LINK':
							$atom['posts'][$indice]['url'] = $contido[0]['atributos']['HREF'];
							break;
							
							case 'CATEGORY':
							$atom['posts'][$indice]['categorias'][] = $this->preparar_texto($contido[0]['atributos']['TERM']);
							break;
							
							case 'SUMMARY':
							$atom['posts'][$indice]['contido_resumo'] = $this->preparar_texto($contido[0]['valor']);
							break;
							
							case 'CONTENT':
							$atom['posts'][$indice]['contido_texto'] = $this->preparar_texto($contido[0]['valor']);
							break;
							
							case 'AUTHOR':
							$atom['posts'][$indice]['autor_nome'] = $this->preparar_texto($contido[0]['NAME'][0]['valor']);
							$atom['posts'][$indice]['autor_email'] = $contido[0]['EMAIL'][0]['valor'];
							break;
							
							case 'SOURCE':
							$atom['posts'][$indice]['fonte']['id'] = $contido[0]['ID'][0]['valor'];
							$atom['posts'][$indice]['fonte']['titulo'] = $this->preparar_texto($contido[0]['TITLE'][0]['valor']);
							$atom['posts'][$indice]['fonte']['url'] = $contido[0]['LINK'][0]['atributos']['HREF'];
							$atom['posts'][$indice]['fonte']['feed'] = $contido[0]['atributos']['GR:STREAM-ID'];
							break;
						}
					}
				}
			} else {
   	   			switch ($clave) {
   	   				case 'GENERATOR':
   	   				$atom['generador_nome'] = $this->preparar_texto($valor[0]['valor']);
   	   				$atom['generador_url'] = $valor[0]['atributos']['URI'];
   	   				break;
   	   				
   	   				case 'ID':
   	   				$atom['id'] = $valor[0]['valor'];
   	   				break;
   	   				
   	   				case 'TITLE':
   	   				$atom['titulo'] = $this->preparar_texto($valor[0]['valor']);
   	   				break;
   	   				
   	   				case 'UPDATED':
   	   				$atom['actualizado'] = $this->preparar_datas($valor[0]['valor']);
   	   				break;
   	   				
   	   				case 'AUTHOR':
   	   				$atom['autor_nome'] = $this->preparar_texto($valor[0]['NAME'][0]['valor']);
   	   				$atom['autor_email'] = $valor[0]['EMAIL'][0]['valor'];
   	   				break;
   	   			}
			}
		}
		return $atom;
	}
	
	
	//Funcion interna para xestionar as comiñas limpar textos e eliminar etiquetas html
	function preparar_texto ($texto) {
		$texto = html_entity_decode($texto);
		$texto = strip_tags($texto);
		$texto = str_replace("\t", ' ', $texto);
		$texto = str_replace("\n", '', $texto);
		$texto = preg_replace("/ {2,}/", ' ', $texto);
		
		$texto = stripslashes($texto);
		$texto = str_replace('&#39;', "'", $texto);
		$texto = str_replace("'", "\\'", $texto);
		return $texto;
	}
	
	
	//Funcion interna para pasar as datas a timestamp
	function preparar_datas ($data) {
		$tempo = preg_replace("/([0-9]{4})-([0-9]{2})-([0-9]{2})(T)([0-9]{2})\:([0-9]{2})\:([0-9]{2})(.*)/", "\\3 \\2 \\1 \\5 \\6 \\7", $data);
		$tempo = explode(' ', $tempo);
		$timestamp = mktime($tempo[3], $tempo[4], $tempo[5], $tempo[1], $tempo[0], $tempo[2]);
		if (!$timestamp) {
			$timestamp = time();
		}
		return $timestamp;
	}
	
	
	
	/*
	DEVOLVER O ARRAY DO XML
	Devolve o array que conten todos os datos do xml
	*/
	function dame() {
		return $this->array_xml;
	}
}

$xml = new Xml();
?>