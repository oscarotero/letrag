$(document).ready(function () {

	//Votar
	$("#votos a").click(function () {
		var variables = $(this).attr("href");
		
		$.ajax({
			type: "post",
			dataType: "xml",
			url: "modulos/votos.php",
			data: variables,
			beforeSend: function() {
				var clases = '';
				$("#votos li:not(.votoactual)").each(function () {
					var clase = $('a', this).attr('class');
					var html = $('a', this).html();
					var contido = '<span class="' + clase + '">' + html + '</span>';
					$(this).html(contido);
				});
			},
			success: function(xml) {
				$("votacion", xml).each(function () {
					var votos = $("votos", this).text();
					var valoracion = $("valoracion", this).text();
					var porcentaxe = $("porcentaxe", this).text();
					
					$("#num_votos").html(votos);
					$("#num_valoracion").html(valoracion);
					$(".voto_actual").css('width', porcentaxe + 'px');
					
				});
			}
		});
		return false;
	});
});