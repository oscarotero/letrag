<?php
defined('OK') or die();


/*
CONTROL DAS OPERACIÓNS BÁSICAS DO XESTOOM
Controla as operacións básicas como insertar/eliminar/modificar rexistros, listados, relacións, etc

Extensión de: Datos->Datos_extend
Necesita as clases: $arquivos, $variables, $imaxes
v.1.3.3
*/

class Xestoom extends Datos_extend {
	var $xestoom_seccion;
	var $xestoom_modo;
	
	var $xestoom_paxina;
	var $xestoom_orde;
	var $xestoom_filtro;
	var $xestoom_filtro_campo;
	var $xestoom_filtro_tipo;
	var $xestoom_lista_limite = 50;
	
	var $xestoom_id;
	var $xestoom_accion;
	
	//Variables da seccion
	var $xestoom_taboa;
	var $xestoom_taboa_relacion;
	var $xestoom_modificar_campos;
	var $xestoom_modificar_datos;
	var $xestoom_listado_campos;
	var $xestoom_listado_datos;
	var $xestoom_consultas;
	var $xestoom_operacions;
	
	//Relacions
	var $xestoom_relacion;
	var $xestoom_relacions;
	var $xestoom_relacion_id;
	var $xestoom_relacion_taboa;
	var $xestoom_relacion_modo;
	
	//Outras clases e variables
	var $imaxes;
	var $rutas;
	var $variables;
	var $arquivos;
	
	
	//Inicia a clase (recolle todas as variables necesarias)
	function iniciar () {
		
		//Importa as clases externas e rutas
		global $rutas, $variables, $arquivos;
		$this->rutas = $rutas;
		$this->variables = &$variables;
		$this->arquivos = &$arquivos;
		
		//Recolle as variables de relacion
		global $relacions;
		$this->xestoom_relacions = $relacions[$this->xestoom_seccion]['relacions'];
		if ($this->xestoom_relacion) {
			$this->xestoom_relacion_taboa	= $this->xestoom_relacion;
			$this->xestoom_relacion_modo	= $relacions[$this->xestoom_relacion_taboa]['relacions'][$this->xestoom_taboa]['modo'];
		}
		
		//Valores por defecto se non existen
		if (!$this->xestoom_paxina) {
			$this->xestoom_paxina = 1;
		}
		if (!$this->xestoom_modo) {
			$this->xestoom_modo = 'listar';
		}
		if ($this->xestoom_orde) {
			$this->xestoom_orde = $this->xestoom_taboa.'.'.$this->xestoom_orde;
		} else {
			$this->xestoom_orde = $this->xestoom_taboa.'.id DESC';
		}
		
		//Calcula variables que non existan
		if (!$this->xestoom_id && $this->xestoom_modo == 'modificar') {
			
			if ($this->xestoom_filtro && $this->xestoom_filtro_campo) {
				$query = " AND $this->xestoom_filtro_campo LIKE '%$this->xestoom_filtro%'";
			}
			if ($this->xestoom_taboa_relacion) {
				$query .= " AND taboa_relacion = '$this->xestoom_relacion_taboa'";
			}
			if ($this->xestoom_taboa_query) {
				$query .= " AND $this->xestoom_taboa_query";
			}
			
			//Seleccionar o id anterior ou seguinte se existe
			$this->variables->rexistra('id_ant, id_seg', 'n');
			if ($this->variables->variables['id_ant']) {
				$this->seleccionar($this->xestoom_taboa, 'id', 'id < '.$this->variables->variables['id_ant'].$query, 'id DESC');
				$resultado = $this->resultado();
				$this->xestoom_id = $resultado['id'];
			} else if ($this->variables->variables['id_seg']) {
				$this->seleccionar($this->xestoom_taboa, 'id', 'id > '.$this->variables->variables['id_seg'].$query, 'id ASC');
				$resultado = $this->resultado();
				$this->xestoom_id = $resultado['id'];
			}
						
			//Cambiar a modo listar se non hai id
			if (!$this->xestoom_id) {
				$this->xestoom_modo = 'listar';
			} else {
				$this->variables->variables['id'] = $this->xestoom_id;
			}
		}
		
		
		//Realiza outras operacións iniciais
		$this->consultas_supletorias ();
	}
	
	
	//Selecciona os datos para o modo listar
	function modo_listar ($considerar_relacion = true) {
		
		//Definir filtro
		if ($this->xestoom_filtro && $this->xestoom_filtro_campo) {
			switch ($this->xestoom_filtro_tipo) {
				case 'conten':
				$filtro = "$this->xestoom_taboa.$this->xestoom_filtro_campo LIKE '%$this->xestoom_filtro%'";
				break;
				
				case 'exacto':
				$filtro = "$this->xestoom_taboa.$this->xestoom_filtro_campo = '$this->xestoom_filtro'";
				break;
			}
				
		}
		if ($this->xestoom_taboa_relacion && $this->xestoom_relacion_taboa) {
			$filtro .= $filtro ? 'AND ' : '';
			$filtro .= "$this->xestoom_taboa.taboa_relacion = '$this->xestoom_relacion_taboa'";
		}
		if ($this->xestoom_taboa_query) {
			$filtro .= $filtro ? 'AND ' : '';
			$filtro .= $this->xestoom_taboa_query;
		}
		

		//Realizar a consulta
		if ($this->xestoom_relacion && $this->xestoom_relacion_id && $considerar_relacion) {
			$filtro = $filtro ? 'AND '.$filtro : '';
			switch ($this->xestoom_relacion_modo) {
				
				case 1:
				$cr = $this->campos_relacions($this->xestoom_taboa, $this->xestoom_relacion_taboa);
				extract($cr);
				$this->datos['total'] = $this->contar("relacions, $this->xestoom_taboa", "relacions.taboa1 = '$taboa1' && relacions.taboa2 = '$taboa2' && relacions.$id1 = $this->xestoom_taboa.id && relacions.$id2 = $this->xestoom_relacion_id $filtro");
				$this->paxinado_seleccionar($this->xestoom_taboa.' | relacions', $this->xestoom_listado_campos.' | ', "relacions.taboa1 = '$taboa1' && relacions.taboa2 = '$taboa2' && relacions.$id1 = $this->xestoom_taboa.id && relacions.$id2 = $this->xestoom_relacion_id $filtro", $this->xestoom_orde, $this->xestoom_paxina, $this->xestoom_lista_limite);
				break;
				
				case 2:
				$this->datos['total'] = $this->contar($this->xestoom_taboa, "id_relacion = $this->xestoom_relacion_id $filtro");
				$this->paxinado_seleccionar($this->xestoom_taboa, $this->xestoom_listado_campos, "id_relacion = $this->xestoom_relacion_id $filtro", $this->xestoom_orde, $this->xestoom_paxina, $this->xestoom_lista_limite);
				break;
				
				case 3:
				$this->seleccionar("$this->xestoom_taboa | $this->xestoom_relacion_taboa", "$this->xestoom_listado_campos | ", "$this->xestoom_relacion_taboa.id = $this->xestoom_relacion_id AND $this->xestoom_relacion_taboa.id_relacion = $this->xestoom_taboa.id");
				break;
				
				case 4:
				$this->datos['total'] = $this->contar($this->xestoom_taboa, "$this->xestoom_relacion_taboa = $this->xestoom_relacion_id $filtro");
				$this->paxinado_seleccionar($this->xestoom_taboa, $this->xestoom_listado_campos, "$this->xestoom_relacion_taboa = $this->xestoom_relacion_id $filtro", $this->xestoom_orde, $this->xestoom_paxina, $this->xestoom_lista_limite);
				break;
				
				case 5:
				$this->seleccionar("$this->xestoom_taboa | $this->xestoom_relacion_taboa", "$this->xestoom_listado_campos | ", "$this->xestoom_relacion_taboa.id = $this->xestoom_relacion_id AND $this->xestoom_taboa.id = $this->xestoom_relacion_taboa.$this->xestoom_taboa");
				break;
			}
		} else {
			$this->datos['total'] = $this->contar($this->xestoom_taboa, $filtro);
			$this->paxinado_seleccionar($this->xestoom_taboa, $this->xestoom_listado_campos, $filtro, $this->xestoom_orde, $this->xestoom_paxina, $this->xestoom_lista_limite);
		}
		$this->paxinado_resultado('datos');
		$this->datos['paxinado']['total'] = ceil($this->datos['total'] / $this->xestoom_lista_limite);
		
		
		
		//Fai a transformación de datos necesaria
		foreach ((array)$this->xestoom_listado_datos as $valor) {
			switch ($valor['tipo']) {
				
				case 'data':
				foreach ($this->datos['datos'] as $subclave => $subvalor) {
					$this->datos['datos'][$subclave][$valor['datos']] = $this->modificar_data($subvalor[$valor['datos']], $valor['hora'], false);
				}
				break;
				
				case 'referencia':
				foreach ($this->datos['datos'] as $subclave => $subvalor) {
					$this->datos['datos'][$subclave][$valor['datos']] = '('.$subvalor[$valor['datos']].') '.$this->datos[$valor['array']][$subvalor[$valor['datos']]][$valor['campo']];
				}
				break;
				
				case 'texto_longo':
				foreach ($this->datos['datos'] as $subclave => $subvalor) {
					$texto = strip_tags($subvalor[$valor['datos']]);
					if (strlen($texto) > 200) {
						$texto = substr(strip_tags($subvalor[$valor['datos']]), 0, 200);
						$restar = strlen(strrchr($texto, ' '));
						if ($restar) {
							$texto = substr($texto, 0, -$restar);
						}
					}
					$this->datos['datos'][$subclave][$valor['datos']] = $texto;
				}
				break;
			}
		}
	}
	
	
	//Selecciona os datos para o modo relacionar
	function modo_relacionar () {
		
		//Seleccionar os datos xerais
		$this->modo_listar(false);
		$resultado = $this->datos;
		$resultado['ids'] = $this->query_in($resultado['datos'], 'id');
		unset($resultado['datos']);
		$this->engadir($resultado);
		
		//Seleccionar os datos relacionados
		switch ($this->xestoom_relacion_modo) {
			
			case 1:
			$cr = $this->campos_relacions($this->xestoom_taboa, $this->xestoom_relacion_taboa);
			extract($cr);
			$in = $this->query_in($this->datos['datos'], 'id');
			if ($in) {
				$this->seleccionar('relacions', $id1, "taboa1 = '$taboa1' && taboa2 = '$taboa2' && $id1 IN ($in) && $id2 = $this->xestoom_relacion_id", '', $this->xestoom_lista_limite);
			}
			$this->resultado('datos2', '', $id1);
			break;
			
			case 2:
			$in = $this->query_in($this->datos['datos'], 'id');
			if ($in) {
				$this->seleccionar($this->xestoom_taboa, 'id', "$this->xestoom_taboa.id IN ($in) && id_relacion = $this->xestoom_relacion_id", '', $this->xestoom_lista_limite);
			}
			$this->resultado('datos2', '', 'id');
			break;
			
			case 3:
			$this->seleccionar("$this->xestoom_taboa | $this->xestoom_relacion_taboa", 'id | ', "$this->xestoom_relacion_taboa.id = $this->xestoom_relacion_id AND $this->xestoom_relacion_taboa.id_relacion = $this->xestoom_taboa.id");
			$this->resultado('datos2', '', 'id');
			$this->datos['notas']['relacion3'] = true;
			break;
			
			case 4:
			$in = $this->query_in($this->datos['datos'], 'id');
			if ($in) {
				$this->seleccionar($this->xestoom_taboa, 'id', "$this->xestoom_taboa.id IN ($in) && $this->xestoom_relacion_taboa = $this->xestoom_relacion_id", '', $this->xestoom_lista_limite);
			}
			$this->resultado('datos2', '', 'id');
			break;
			
			case 5:
			$this->seleccionar("$this->xestoom_taboa | $this->xestoom_relacion_taboa", 'id | ', "$this->xestoom_relacion_taboa.id = $this->xestoom_relacion_id AND $this->xestoom_taboa.id = $this->xestoom_relacion_taboa.$this->xestoom_taboa");
			$this->resultado('datos2', '', 'id');
			$this->datos['notas']['relacion3'] = true;
			break;
		}
	}
	
	
	//Acción de insertar un novo rexistro
	function accion_insertar () {
	
		//Xenerar o id
		$campos = 'id';
		$valores = "''";
		if ($this->xestoom_taboa_relacion) {
			$campos .= ', taboa_relacion';
			$valores .= ", '$this->xestoom_relacion_taboa'";
		}
		$this->xestoom_id = $this->insertar($this->xestoom_taboa, $campos, $valores);
		$this->variables->variables['id'] = $this->xestoom_id;
		
		//Establecer a relación
		if ($this->xestoom_relacion_taboa && $this->xestoom_relacion_id) {
			$taboa = $this->xestoom_taboa_relacion && $this->xestoom_relacion_modo == 2 ? 'id_relacion' : $this->xestoom_relacion_taboa;
			$this->relacionar_taboas($this->xestoom_taboa, $taboa, $this->xestoom_relacion_modo, $this->xestoom_relacion_id, $this->xestoom_id);
		}
		
		//Actualizar o resto de datos
		$this->accion_modificar();
		
		//Realizar outras operacións
		foreach ((array)$this->xestoom_operacions['insertar'] as $valor) {
			$nome_dato = $valor['dato'];
			$valor_dato = $this->variables->variables[$nome_dato];
			$consulta = str_replace('{'.$nome_dato.'}', $valor_dato, $valor['consulta']);
			$this->mysql->put_query($consulta);
		}
		
		//Cambiar o modo para modificar
		$this->xestoom_modo = 'modificar';
	}
	
	
	//Acción de modificar un rexistro
	function accion_modificar () {
		
		//Rexistrar as variables recibidas
		$vars = array();
		foreach ((array)$this->xestoom_modificar_datos as $valor) {
			if ($valor['datos']) {
				$vars[] = $valor['datos'];
			}
		}
		$this->variables->rexistra(implode(', ', $vars), 't');
		
		//Fai a transformación de datos necesaria
		foreach ((array)$this->xestoom_modificar_datos as $valor) {
			switch ($valor['tipo']) {
				
				case 'url':
				$txt = $this->modificar_url($this->variables->variables[$valor['datos']]);
				$this->variables->variables[$valor['datos']] = $txt;
				break;
				
				case 'data':
				$this->variables->rexistra($valor['datos'].'_hora', 't');
				$txt = $this->modificar_data($this->variables->variables[$valor['datos']], $this->variables->variables[$valor['datos'].'_hora']);
				$this->variables->variables[$valor['datos']] = $txt;
				break;
				
				case 'wysiwyg':
				$txt = $this->modificar_wysiwyg($this->variables->variables[$valor['datos']]);
				$this->variables->variables[$valor['datos']] = $txt;
				break;
				
				case 'gmap':
				$this->modificar_gmap($valor['prefixo']);
				break;
				
				case 'imaxe':
				$this->modificar_imaxe($valor['datos'], $valor['arquivo'], $valor['copias']);
				break;
				
				case 'file':
				$this->modificar_arquivo($valor['datos'], $valor['arquivo']);
				break;
				
				case 'orde':
				$this->modificar_orde($valor['datos']);
				break;
			}
		}
		
		//Gardar datos
		$actualizacion = '';
		foreach ((array)$this->xestoom_modificar_datos as $valor) {
			if ($valor['datos']) {
				$actualizacion .= ', '.$valor['datos']." = '".$this->variables->variables[$valor['datos']]."'";
			}
		}
		$actualizacion = substr($actualizacion, 2);
		$this->actualizar($this->xestoom_taboa, $actualizacion, "id = $this->xestoom_id", 1);
	}
	
	
	//Acción para borrar un rexistro
	function accion_eliminar () {
		
		//Rexistrar as variables recibidas
		$vars = array();
		foreach ((array)$this->xestoom_modificar_datos as $valor) {
			$vars[] = $valor['datos'];
		}
		$this->variables->rexistra(implode(', ', $vars), 't');
		
		//Elimina o rexistro na base de datos
		$this->eliminar($this->xestoom_taboa, "id = $this->xestoom_id",  1);
		
		//Elimina datos externos
		if ($this->xestoom_modo == 'modificar') {
			foreach ((array)$this->xestoom_modificar_datos as $valor) {
				switch ($valor['tipo']) {
					
					case 'file':
					$directorio = $this->rutas[$valor['arquivo'][0]];
					if ($valor['arquivo'][1]) {
						$directorio .= $this->variables->variables[$valor['arquivo'][1]].'/';
					}
					$this->variables->rexistra('file_'.$valor['datos'], 't');
					$nome_arquivo = $this->variables->variables['file_'.$valor['datos']];
					if ($nome_arquivo) {
						$this->arquivos->borrar_arquivo($directorio.$nome_arquivo);
					}
					
					//Eliminar copias de arquivos
					foreach ((array)$valor['procesar_imaxes'] as $copia) {
						$directorio_copia = $copia[0];
						if ($copia[1]) {
							$directorio_copia .= $this->variables->variables[$copia[1]].'/';
						}
						$nome_copia = $copia[2].$nome_arquivo;
						$this->arquivos->borrar_arquivo($directorio_copia.$nome_copia);
					}
					break;
				}
			}
		}
		
		//Elimina relacións con outras taboas
		foreach ((array)$this->xestoom_relacions as $clave => $valor) {
			$modo = $valor['modo'];
			$eliminar = $valor['eliminar'];
			$tabla = $clave;
			
			switch ($valor['modo']) {
				
				case 1:
				$cr = $this->campos_relacions($clave, $this->xestoom_taboa);
				extract($cr);
				$this->eliminar('relacions', "taboa1 = '$taboa1' AND taboa2 = '$taboa2' AND $id2 = $this->xestoom_id", '');
				break;
				
				case 2:
				if ($valor['eliminar']) {
					$this->eliminar($clave, $this->xestoom_seccion.' = '.$this->xestoom_id, '');
				}
				break;
			}
		}
		
		//Realizar outras operacións
		foreach ((array)$this->xestoom_operacions['eliminar'] as $valor) {
			$nome_dato = $valor['dato'];
			$valor_dato = $this->variables->variables[$nome_dato];
			$consulta = str_replace('{'.$nome_dato.'}', $valor_dato, $valor['consulta']);
			$this->mysql->put_query($consulta);
		}
		
		//Pasa a modo listar
		$this->xestoom_modo = 'listar';
		$this->variables->variables['v_modo'] = $this->xestoom_modo;
	}
	
	
	//Acción de relacionar un rexistro
	function accion_relacionar () {
		$this->variables->rexistra('ids', 't');
		$this->variables->rexistra('checkbox', 'a');
		if ($this->variables->variables['checkbox']) {
			$checkbox = implode(', ', $this->variables->variables['checkbox']);
		}
		$this->relacionar_taboas($this->xestoom_taboa, $this->xestoom_relacion_taboa, $this->xestoom_relacion_modo, $this->xestoom_relacion_id, $checkbox, $this->variables->variables['ids']);
	}
	
	
	//Crear relacions entre duas táboas
	function relacionar_taboas ($taboa1, $taboa2, $modo, $id_relacion, $ids_novas_relacions, $ids_ambito = '') {
	
		switch ($modo) {
		
			case 1:
			$cr = $this->campos_relacions($taboa1, $taboa2);
			extract($cr);
			if ($ids_ambito) {
				$query_ambito = $ids_ambito ? "AND $id1 IN ($ids_ambito)" : '';
				$this->eliminar('relacions', "taboa1 = '$taboa1' AND taboa2 = '$taboa2' AND $id2 = $id_relacion $query_ambito", '');
			}
			$array_novas_relacions = explode(', ', $ids_novas_relacions);
			foreach($array_novas_relacions as $valor) {
				$id = intval($valor);
				$this->insertar('relacions', "taboa1, taboa2, $id1, $id2", "'$taboa1', '$taboa2', $id, $id_relacion");
			}
			break;
			
			case 2:
			if ($ids_ambito) {
				$query_ambito = $ids_ambito ? "AND id IN ($ids_ambito)" : '';
				$this->actualizar($taboa1, "id_relacion = 0", "id_relacion = $id_relacion $query_ambito", '');
				if ($ids_novas_relacions) {
					$this->actualizar($taboa1, "id_relacion = $id_relacion", "id IN ($ids_novas_relacions)", '');
				}
			} else {
				$this->actualizar($taboa1, "id_relacion = $id_relacion", "id = $ids_novas_relacions", '');
			}
			break;
			
			case 3:
				$ids_novas_relacions = intval($ids_novas_relacions);
				$this->actualizar($taboa2, "id_relacion = $ids_novas_relacions", "id = $id_relacion", '');
			break;
			
			case 4:
			if ($ids_ambito) {
				$query_ambito = $ids_ambito ? "AND id IN ($ids_ambito)" : '';
				$this->actualizar($taboa1, "$taboa2 = 0", "$taboa2 = $id_relacion $query_ambito", '');
				if ($ids_novas_relacions) {
					$this->actualizar($taboa1, "$taboa2 = $id_relacion", "id IN ($ids_novas_relacions)", '');
				}
			} else {
				$this->actualizar($taboa1, "$taboa2 = $id_relacion", "id = $ids_novas_relacions", '');
			}
			break;
			
			case 5:
				$ids_novas_relacions = intval($ids_novas_relacions);
				$this->actualizar($taboa2, "$taboa1 = $ids_novas_relacions", "id = $id_relacion", '');
			break;
		}
	}
	
	
	//Selecciona os datos para o modo modificar
	function modo_modificar () {
		
		//Obter datos da base de datos
		$this->seleccionar($this->xestoom_taboa, $this->xestoom_modificar_campos.', id', "id = $this->xestoom_id");
		$this->resultado('datos');
		
		//Fai a transformación de datos necesaria
		foreach ((array)$this->xestoom_modificar_datos as $valor) {
			switch ($valor['tipo']) {
				
				case 'data':
				$data = $this->modificar_data($this->datos['datos'][$valor['datos']], $valor['hora'], false);
				if ($valor['hora']) {
					$data = explode(' ', $data);
					$this->datos['datos'][$valor['datos']] = $data[0];
					$this->datos['datos'][$valor['datos'].'_hora'] = $data[1];
				} else {
					$this->datos['datos'][$valor['datos']] = $data;
				}
				break;
			}
		}
	}
	
	
	//Selecciona os datos para o modo insertar
	function modo_insertar () {
		if ($this->xestoom_relacion_taboa && $this->xestoom_relacion_id) {
			$this->datos['datos'][$this->xestoom_relacion_taboa] = $this->xestoom_relacion_id;
		}
		
		//Fai a transformación de datos necesaria
		foreach ((array)$this->xestoom_modificar_datos as $valor) {
			if ($valor['defecto']) {
			
				if ($valor['tipo'] == 'data') {
					$data = $this->modificar_data($valor['defecto'], $valor['hora'], false);
					if ($valor['hora']) {
						$data = explode(' ', $data);
						$this->datos['datos'][$valor['datos']] = $data[0];
						$this->datos['datos'][$valor['datos'].'_hora'] = $data[1];
					} else {
						$this->datos['datos'][$valor['datos']] = $data;
					}
				} else {
					$this->datos['datos'][$valor['datos']] = $valor['defecto'];
				}
			}
		}
	}
	
	
	//Calcula os campos taboa1, taboa2, id1 e id2 da taboa relacións
	function campos_relacions ($taboa1, $taboa2) {
		$cr = array($taboa1, $taboa2);
		sort($cr);
		
		$nova_taboa1 = $cr[0];
		$nova_taboa2 = $cr[1];
		
		if ($nova_taboa1 == $taboa1) {
			$id1 = 'id1';
			$id2 = 'id2';
		} else {
			$id1 = 'id2';
			$id2 = 'id1';
		}
		
		$resultado = array ('taboa1' => $nova_taboa1, 'taboa2' => $nova_taboa2, 'id1' => $id1, 'id2' => $id2);
		return ($resultado);
	}
	
	
	//Devolve variables
	function variable ($nome) {
		$nome = 'xestoom_'.$nome;
		return $this->$nome;
	}
	
	
	//Garda todo na clase Datos e actualiza as variables máis críticas
	function gardar () {
		global $datos;
		
		$datos->engadir($this->datos);
		$this->datos = array();
		
		$this->variables->variables['v_modo'] = $this->xestoom_modo;
		$this->variables->variables['id'] = $this->xestoom_id;
	}
	
	
	//Modificar datos de tipo url
	function modificar_url ($url) {
		$url = str_replace('http://', '', $url);
		return $url;
	}
	
	
	//Modificar datos de tipo data
	function modificar_data ($data, $hora = '', $devolver_timestamp = true) {
		if ($data) {
			if ($devolver_timestamp) {
				$data = explode('-', $data);
				if ($hora && $hora != 'x') {
					$hora = explode(':', $hora);
					$h = $hora[0];
					$m = $hora[1];
					$s = $hora[2];
					$data = mktime($h, $m, $s, $data[1], $data[0], $data[2]);
				} else {
					$data = mktime(0, 0, 1, $data[1], $data[0], $data[2]);
				}
			} else {
				if ($hora) {
					$data = date('d-m-Y H:i:s', $data);
				} else {
					$data = date('d-m-Y', $data);
				}
			}
		}
		return $data;
	}
	
	
	//Modificar a orde dun rexistro
	function modificar_orde ($orde = 'orde') {
		$this->variables->rexistra('orde_'.$orde, 'n');
		$orde_antiga = $this->variables->variables['orde_'.$orde];
		$orde_nova = $this->variables->variables[$orde];
		
		if ($orde_antiga != $orde_nova) {
			if (!$orde_antiga) {
				$this->actualizar($this->xestoom_taboa, "$orde = $orde + 1", "$orde >= $orde_nova", '');
			} else if ($orde_nova < $orde_antiga || !$orde_antiga) {
				$this->actualizar($this->xestoom_taboa, "$orde = $orde + 1", "$orde >= $orde_nova AND $orde < $orde_antiga", '');
			} else if ($orde_nova > $orde_antiga) {
				$this->actualizar($this->xestoom_taboa, "$orde = $orde - 1", "$orde > $orde_antiga AND $orde <= $orde_nova", '');
			}
		} else if ($this->xestoom_accion == 'insertar') {
			$this->actualizar($this->xestoom_taboa, "$orde = $orde + 1", "$orde >= $orde_nova", '');
		}
	}
	
	
	//Modifica os textos escritos con wysiwyg
	function modificar_wysiwyg ($texto) {
	
		//Substituír etiquetas
		$buscar = array (
			'/<span style="font-weight: bold;">([^<]*)<\/span>/',
			'/<span style="font-style: italic;">([^<]*)<\/span>/',
			'/<span style="font-weight: bold; font-style: italic;">([^<]*)<\/span>/',
			'/ style="[^\"]*"/',
			'/ class="[^\"]*"/',
			'/ jQuery[0-9]+="[0-9]+"/',
			'/&nbsp;/',
			'/<br>/',
			'/<br \/><\/p>/',
			'/<p>\s*<\/p>/',
			'/\t+/',
			'/\s\s+/',
			'/<\/(p|h1|h2|h3|h4|h5|ul|ol|li)>(\s+)/',
			'/\s+<\/(p|h1|h2|h3|h4|h5|ul|ol|li)>/',
		);
		$reemplazar = array (
			"<strong>$1</strong>",
			"<em>$1</em>",
			"<strong><em>$1</strong></em>",
			'',
			'',
			' ',
			'',
			'<br />',
			'</p>',
			'',
			' ',
			' ',
			"</$1>\n",
			"</$1>",
		);
			
		$texto = preg_replace($buscar, $reemplazar, $texto);
		
		//Eliminar o resto de etiquetas
		$etiquetas_permitidas = '<p><br><h1><h2><h3><h4><ul><ol><li><a><img><strong><em><address><object><param><embed>';
		$texto = strip_tags($texto, $etiquetas_permitidas);
		return $texto;
	}
	
	
	//Modifica coordenadas google maps
	function modificar_gmap ($dato) {
		$this->variables->rexistra($dato.'_x', 'f');
		$this->variables->rexistra($dato.'_y', 'f');
		$this->variables->rexistra($dato.'_z', 'n');
		
		$this->xestoom_modificar_datos[]['datos'] = $dato.'_x';
		$this->xestoom_modificar_datos[]['datos'] = $dato.'_y';
		$this->xestoom_modificar_datos[]['datos'] = $dato.'_z';
	}
	
	
	
	//Modificar os datos dunha imaxe
	function modificar_imaxe ($arquivo, $array_operacions, $array_copias = '') {
		$this->variables->rexistra('file_'.$arquivo, 't');
		
		if ($this->arquivos->comprobar_arquivo($_FILES[$arquivo]['tmp_name'])) {
			
			//Importa a clase para transformar un arquivo
			if (!$this->imaxes) {
				include_once($this->rutas['includes_comun'].'include_imaxes.php');
				$this->imaxes = $imaxes;
			}
			
			//Garda o arquivo e obten o nome
			$directorio = $this->rutas[$array_operacions[0]];
			$nome_arquivo = $_FILES[$arquivo]['name'];
			if ($array_operacions[2]) {
				$nome_arquivo = $this->variables->variables[$array_operacions[2]].strrchr($nome_arquivo, '.');
			}
			$nome_arquivo = $this->arquivos->copiar_arquivo($_FILES[$arquivo]['tmp_name'], $directorio, $array_operacions[1], $nome_arquivo);
						
			//Borra o arquivo antigo se existe
			$this->variables->rexistra('file_'.$arquivo, 't');
			if ($this->variables->variables['file_'.$arquivo] && $this->variables->variables['file_'.$arquivo] != $nome_arquivo) {
				$this->arquivos->borrar_arquivo($directorio.$_POST['file_'.$arquivo]);
			}
			$this->variables->variables[$arquivo] = $nome_arquivo;
			
			//Comproba se hai que crear copias da imaxe a outros tamaños
			foreach ((array)$array_copias as $copia) {
				$directorio_copia = $copia[0];
				$nome_copia = $copia[1].$nome_arquivo;
				$imx_ancho = $copia[2];
				$imx_alto = $copia[3];
				$recortar = $copia[4];
				
				if ($recortar) {
					$imaxes->crop($directorio.$nome_arquivo, $imx_ancho, $imx_alto, $directorio_copia.$nome_copia);
				} else {
					$imaxes->resize($directorio.$nome_arquivo, $imx_ancho, $imx_alto, $directorio_copia.$nome_copia);
				}
			}
			
			//Comproba se hai que facerlle algunha modificación á imaxe orixinal
			if ($array_operacions[3] && $array_operacions[4]) {
				$imx_ancho = $array_operacions[3];
				$imx_alto = $array_operacions[4];
				$recortar = $array_operacions[5];
				
				if ($recortar) {
					$imaxes->crop($directorio.$nome_arquivo, $imx_ancho, $imx_alto);
				} else {
					$imaxes->resize($directorio.$nome_arquivo, $imx_ancho, $imx_alto);
				}
			}
		} else {
			$this->variables->variables[$arquivo] = $this->variables->variables['file_'.$arquivo];
		}
	}
	
	
	//Modificar os datos dun arquivo
	function modificar_arquivo ($arquivo, $array_operacions) {
		$this->variables->rexistra('file_'.$arquivo, 't');
		
		if ($this->arquivos->comprobar_arquivo($_FILES[$arquivo]['tmp_name'])) {
			
			//Garda o arquivo e obten o nome
			$directorio = $this->rutas[$array_operacions[0]];
			$nome_arquivo = $_FILES[$arquivo]['name'];
			if ($array_operacions[2]) {
				$nome_arquivo = $this->variables->variables[$array_operacions[2]].strrchr($nome_arquivo, '.');
			}
			$nome_arquivo = $this->arquivos->copiar_arquivo($_FILES[$arquivo]['tmp_name'], $directorio, $array_operacions[1], $nome_arquivo);
			
			//Borra o arquivo antigo se existe
			if ($this->variables->dame('file_'.$arquivo) && $this->variables->variables['file_'.$arquivo] != $nome_arquivo) {
				$this->arquivos->borrar_arquivo($directorio.$_POST['file_'.$arquivo]);
			}
			$this->variables->variables[$arquivo] = $nome_arquivo;
			
		} else {
			$this->variables->variables[$arquivo] = $this->variables->variables['file_'.$arquivo];
		}
	}
	
	
	
	//Realizar consultas supletorias
	function consultas_supletorias () {
		foreach ((array)$this->xestoom_consultas as $valor) {
			$this->seleccionar($valor['tabla'], $valor['campos'], $valor['consulta'], '', '');
			$this->resultado($valor['array'], '', 'id');
		}
	}
}

$datosXestoom = new Xestoom;
?>