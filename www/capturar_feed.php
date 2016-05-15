<?php

//Facer includes
include_once('rutas.php');
include_once($rutas['includes_comun'].'include_erros.php');
include_once($rutas['includes_comun'].'include_sql.php');
include_once($rutas['includes_comun'].'include_datos.php');
include_once($rutas['includes'].'funcions_html.php');
include_once($rutas['includes'].'include_xml.php');


//Conexión á base de datos
$mysql->iniciar($configuracion['mysql']['servidor'], $configuracion['mysql']['usuario'], $configuracion['mysql']['contrasinal'], $configuracion['mysql']['basedatos']);
$mysql->conecta();


//Variables
$blogs = array();
$posts = array();
$arquivo = 'http://www.google.com/reader/public/atom/user/02465487500740263984/label/letrag';


//Ler o arquivo xml
$xml->cargar($arquivo);
$posts = $xml->dame_atom();


//Lista de blogs
$datos->seleccionar('blogosfera', 'id, feed', '', '', '');
$resultado = $datos->resultado('', '');

foreach ($resultado as $clave => $valor) {
	$k = md5($valor['feed']);
	$blogs[$k] = $valor['id'];
}

foreach ($posts['posts'] as $valor) {
			
	//url do feed (funcionaria como id
	$feed = str_replace('tag:google.com,2005:reader/feed/http://', '', $valor['fonte']['id']);
	$id_feed = md5($feed);
	
	//Obter e limpar contido
	$contido = $valor['contido_texto'] ? $valor['contido_texto'] : $valor['contido_resumo'];
	$contido = recortar($contido, 275);
	
	//Gardar un novo blog se existe
	if (!$blogs[$id_feed]) {
		$id_blog = $datos->insertar('blogosfera', 'feed', "'$feed'");
		$datos->imprimir_query();
		$id_feed = md5($feed);
		$blogs[$id_feed] = $id_blog;
	} else {
		$id_blog = $blogs[$id_feed];
	}
	
	//Gardar o post
	$mysql->actualizar("INSERT IGNORE INTO blogosfera_posts (`titulo`, `data`, `texto`, `url`, `blogosfera`) VALUES ('".$valor['titulo']."', '".$valor['data_publicacion']."', '$contido', '".$valor['url']."', '$id_blog')");
	//print("INSERT IGNORE INTO blogosfera_posts (`titulo`, `data`, `texto`, `url`, `blogosfera`) VALUES ('".$valor['titulo']."', '".$valor['data_publicacion']."', '$contido', '".$valor['url']."', '$id_blog');");
	
?>

	<p><?php print(href($valor['titulo'], $valor['url'], '')); ?><br />
	<?php print($contido); ?><br />
	<?php print($valor['data_publicacion']); ?></p>

<?php } ?>