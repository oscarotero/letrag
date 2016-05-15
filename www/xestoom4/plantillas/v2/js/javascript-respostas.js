//v.1.0

$(document).ready(function () {
	
	//Marcar as filas relacionadas
	$("#respostas :checkbox").each(function (i) {
		if ($(this).attr('checked')) {
			var p = $(this).parent();
			$(p).addClass('seleccionado');
		}
	});
	
	
	//Marcar ou desmarcar as filas ao seleccionalas
	$("#respostas :checkbox").change(function () {
		var p = $(this).parent();
		if ($(this).attr('checked')) {
			$(p).addClass('seleccionado');
		} else {
			$(p).removeClass('seleccionado');
		}
	});	
});