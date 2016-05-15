$(document).ready(function () {

	//Comentarios
	var comentario_defecto	= $("#formc_texto").val();
	var nome_defecto	= $("#formc_nome").val();
	var direccion_defecto	= $("#formc_direccion").val();
	
	$("#formc_texto").focus(function () {
		if ($(this).val() == comentario_defecto) {
			$(this).val('');
		}
	});
	
	$("#formc_nome").focus(function () {
		if ($(this).val() == nome_defecto) {
			$(this).val('');
		}
	});
	
	$("#formc_direccion").focus(function () {
		if ($(this).val() == direccion_defecto) {
			$(this).val('');
		}
	});
	
	
	$("#comentarios_form").submit(function () {
		var comentario_actual = jQuery.trim($("#formc_texto").val());
		
		if (comentario_actual == '' || comentario_actual == comentario_defecto) {
			alert('Comentario necesario');
			$("#formc_texto").focus();
			return false;
		} else {
			var spam = prompt('Control de spam: 5+5?');
			spam = $("#s").val() + '-' + spam;
			$("#s").val(spam);
			return true;
		}
	});
});