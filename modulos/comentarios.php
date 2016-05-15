<?php

die();

if ($_POST['email'] || $_GET['email']) {
	die();
}

include_once('../rutas.php');

//Includes
include_once($rutas['includes_comun'].'include_erros.php');
include_once($rutas['includes_comun'].'include_sql.php');
include_once($rutas['includes_comun'].'include_variables.php');
include_once($rutas['includes_comun'].'include_datos.php');
include_once($rutas['includes_comun'].'include_datos_extend.php');
include_once($rutas['includes'].'funcions_html.php');
include_once($rutas['includes'].'include_datos_comentarios.php');


//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Textos
$datos->seleccionar_textos_pequenos('textos', 'texto_gal', 'textos');


//Iniciar variables
$variables->rexistra('t_comentarios, spam, texto_comentarios, direccion_comentarios, nome_comentarios', 't');
$variables->rexistra('id_comentarios', 'n');

if ($variables->variables['nome_comentarios'] == $datos->datos['textos']['nome']) {
	$variables->variables['nome_comentarios'] = '';
}
if ($variables->variables['direccion_comentarios'] == $datos->datos['textos']['direccion']) {
	$variables->variables['direccion_comentarios'] = '';
}
if ($variables->variables['texto_comentarios'] == $datos->datos['textos']['oteu_comentario']) {
	$variables->variables['texto_comentarios'] = '';
}
if (strpos($variables->variables['direccion_comentarios'], '@')) {
	$email = $variables->variables['direccion_comentarios'];
	$web = '';
} else {
	$web = $variables->variables['direccion_comentarios'];
	$email = '';
}


//Clase comentarios
$datosComentarios->taboa	= $variables->variables['t_comentarios'];
$datosComentarios->id		= $variables->variables['id_comentarios'];
$datosComentarios->limite	= 1;

$datosComentarios->spam($variables->variables['spam'], 4);
$datosComentarios->gardar_comentario($variables->variables['texto_comentarios'], $variables->variables['nome_comentarios'], $email, $web);

$datosComentarios->listar_comentarios();
$valor = $datosComentarios->datos['comentarios'];

if ($valor) {
?>

					<p class="columna ancho5">
						<span class="comentario_autor"><?php print($valor['nome'] ? $valor['nome'] : $datos->datos['textos']['anonimo']); ?></span><br />
						<span class="comentario_direccion">
							<?php
							if ($valor['web']) {
								print(href($valor['web'], 'http://'.$valor['web']));
							} else if ($valor['email']) {
								print(href($valor['email'], 'mailto:'.$valor['email']));
							}
							?>
						</span>
					</p>

					<p class="comentario_texto columna ancho10 final">
						<?php print(nl2br($valor['texto'])); ?>
					</p>
<?php } else { ?>
					<p class="comentario_texto"><strong><?php print($datos->datos['textos']['comentario_ko']); ?></strong></p>
<?php } ?>