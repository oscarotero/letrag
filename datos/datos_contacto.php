<?php
defined('OK') or die();


//Variables
$variables->rexistra('cnome, cdireccion, ctexto, cspam', 't');

if ($variables->variables) {
	$spam = $variables->variables['cspam'];
	$spam = explode('-', $spam);
	$tempo = time();
	
	if ($variables->variables['ctexto'] == $datos->datos['textos']['oteu_comentario']) {
		$variables->variables['ctexto'] = '';
	}
	
	if ($variables->variables['ctexto'] && $spam[0] < $tempo && $spam[0] > ($tempo - 14400) && $spam[1] == 10) {
	
		//Enviar o contacto por correo
		$contido_correo =	'Nome: '.$variables->variables['cnome']."\n".
					'Direccion: '.$variables->variables['cdireccion']."\n".
					"---------------\n".$variables->variables['ctexto'];
		mail('oom@oscarotero.com', 'Contacto letrag de '.$variables->variables['cnome'], $contido_correo,'FROM: comentarios@oscarotero.com');
		$contacto = 'enviado';
	} else {
		$contacto = 'erro';
	}
}

$datos->datos['titulo_head'] = $datos->datos['textos']['contacto'].' - ';
?>