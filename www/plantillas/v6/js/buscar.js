$(document).ready(function () {


//Buscar
function validar_busqueda () {
	var valor = jQuery.trim($("#buscador_texto").val());
	
	if (valor == '' || valor.length < 3) {
		alert('3 letras como mínimo');
		return false;
	} else {
		switch($("#buscador_lugar").val()) {
		
			case "blogosfera":
			$("#buscador").attr("action", "blogosfera.php");
			break;
			
			case "caracteres":
			$("#buscador").attr("action", "caracteres.php");
			break;
			
			case "clasificacion":
			$("#buscador").attr("action", "clasificacion.php");
			break;
			
			case "desenadores":
			$("#buscador").attr("action", "desenadores.php");
			break;
			
			case "glosario_palabras":
			$("#buscador").attr("action", "palabras.php");
			break;
			
			case "glosario_seccions":
			$("#buscador").attr("action", "glosario.php");
			break;
			
			case "ligazons":
			$("#buscador").attr("action", "ligazons_resultado.php");
			break;
			
			case "tags":
			$("#buscador").attr("action", "tags.php");
			break;
			
			case "tipografias":
			$("#buscador").attr("action", "tipografias.php");
			break;
			
			case "mais_comuns":
			$("#buscador").attr("action", "maiscomuns.php");
			break;
		}
		return true;
	}
}

$("#buscador").submit(function () {
	return validar_busqueda();
});

});