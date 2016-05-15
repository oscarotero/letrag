<?php
defined('OK') or die();


/*
CONTROL DE OPERACIÓNS DE PREGUNTAS E RESPOSTAS
Controla as operacións de tipo preguntas con varias respostas posibles (de tipo identificar)

Extensión de: Datos->Datos_extend
v.1.0
*/

class Xestoom_respostas extends Datos_extend {
	var $xestoom_seccion;
	var $xestoom_relacion_id;
	
	//Variables propias da clase
	var $xestoom_taboa_preguntas;
	var $xestoom_campo_preguntas;
	var $xestoom_taboa_respostas;
	var $xestoom_campo_respostas;
	var $xestoom_taboa_relacions;
	var $xestoom_taboa_producto;
	
	
	//Selecciona todas as preguntas e as respostas
	function listar () {
		
		//Seleccionar todas as preguntas
		$this->seleccionar($this->xestoom_taboa_preguntas, "id, $this->xestoom_campo_preguntas", '', '', '');
		$this->resultado('preguntas', '');
		
		//Seleccionar todas as respostas e ordenalas por preguntas
		$this->seleccionar($this->xestoom_taboa_respostas, "id, $this->xestoom_campo_respostas, $this->xestoom_taboa_preguntas", '', '', '');
		$this->resultado('respostas', '', $this->xestoom_taboa_preguntas, true);
		
		//Seleccionar todas as relacións de preguntas e respostas
		$campos = array();
		foreach ($this->datos['preguntas'] as $valor) {
			$campos[] = 'p'.$valor['id'];
		}
		$campos = implode(', ', $campos);
		$this->seleccionar($this->xestoom_taboa_relacions, "$this->xestoom_taboa_producto, $campos", "$this->xestoom_taboa_producto = $this->xestoom_relacion_id");
		$resultado = $this->resultado();
		
		//Unir cada resposta coa súa relación
		foreach ($this->datos['preguntas'] as $valor) {
			$relacion = $resultado['p'.$valor['id']];
			$relacion = substr($relacion, 1, -1);
			$relacion = explode('/', $relacion);
			
			foreach ($this->datos['respostas'][$valor['id']] as $subclave => $subvalor) {
				if (in_array($subvalor['id'], $relacion)) {
					$this->datos['respostas'][$valor['id']][$subclave]['seleccionado'] = true;
				}
			}
		}
	}
	
	
	//Fai a relación
	function accion_relacionar () {
		global $variables;
		$variables->rexistra('resposta', 'a');
		$respostas = $variables->variables['resposta'];
		
		//Obten a cadea de actualización
		foreach ($respostas as $clave => $valor) {
			$campos = array_keys($valor);
			$campos = '/'.implode('/', $campos).'/';
			
			$query .= ", p$clave = '$campos'";
		}
		$query = substr($query, 2);
		
		//Elimina o rexistro de relación se existe e crea un novo vacío (para asegurarse de que sempre exista un rexistro)
		$this->eliminar($this->xestoom_taboa_relacions, "$this->xestoom_taboa_producto = $this->xestoom_relacion_id", '');
		$this->insertar($this->xestoom_taboa_relacions, $this->xestoom_taboa_producto, $this->xestoom_relacion_id);
		
		//Fai a actualización
		$this->actualizar($this->xestoom_taboa_relacions, $query, "$this->xestoom_taboa_producto = $this->xestoom_relacion_id");
	}
	
	
	//Garda todo na clase Datos e actualiza as variables máis críticas
	function gardar () {
		global $datos;
		
		$datos->engadir($this->datos);
		$this->datos = array();
	}
}

$datosXestoomRespostas = new Xestoom_respostas;
?>