//v.1.2

$(document).ready(function () {
	
	//Mostrar/ocultar menu
	$('.flecha').click(function () {
		var li = $(this).parent();

		if ($(li).attr('class') == 'menu_aberto') {
			$(li).attr('class', 'menu_pechado');
		} else if ($(li).attr("class") == 'menu_pechado') {
			$(li).attr('class', 'menu_aberto');
		}
		return false;
	});
	
	
	//Enviar como novo rexistro
	$('#copiar_rexistro').click(function () {
		$("#formulario input[name='id']").removeAttr('value');
		$("#formulario input[name^='file_']").removeAttr('value');
		$("#formulario input[name='v_accion']").val('insertar');
		return true;
	});
	
	
	//Eliminar rexistro formulario
	$('#borrar_rexistro').click(function () {
		if(confirm('Seguro que queres eliminar este rexistro?')) {
			$("#formulario input[name='v_accion']").val('eliminar');
			return true;
		} else {
			return false;
		}
	});
	
	
	//Pestanas
	$("#menu_relacions .pestanas a").click(function () {
		$("#menu_relacions .pestanas .seleccionado").removeClass("seleccionado");
		$(this).parent().attr("class", "seleccionado");
		$(".pestanas_contido").attr("class", "pestanas_contido_oculto");
		var capa_actual = $(this).attr("href");
		$(capa_actual).attr("class", "pestanas_contido");
		$(capa_actual).removeClass("pestanas_contido_oculto");
		
		if (!$(capa_actual+" > iframe").attr("src")) {
			var src = $(capa_actual+" > iframe").attr("longdesc");
			$(capa_actual+" > iframe").attr("src", src);
		}
		
		//Redimensionar frames
		var id_frame = $(capa_actual+" > iframe").attr("id");
		$("#"+id_frame).load(function() {
			var frame_actual = document.getElementById(id_frame);
			var frame_alto = "";
			if (!frame_actual.contentDocument) {
				frame_alto = document.frames[id_frame].document.body.offsetHeight;
			} else {
				frame_alto = frame_actual.contentDocument.body.offsetHeight;
			}
			if (frame_alto >= 50) {
				$("#"+id_frame).css("height", frame_alto+50+"px");
			}
			window.location = "#menu_relacions";
		});
		return false;
	});
	
	
	//Marcar as filas relacionadas
	$(".accions :checkbox, .accions :radio").each(function (i) {
		if ($(this).attr('checked')) {
			var tr = $(this).parent().parent();
			$(tr).addClass('seleccionado');
		}
	});
	
	
	//Marcar ou desmarcar as filas ao seleccionalas
	$(".accions :checkbox").change(function () {
		var tr = $(this).parent().parent();
		if ($(this).attr('checked')) {
			$(tr).addClass('seleccionado');
		} else {
			$(tr).removeClass('seleccionado');
		}
	});
	
	
	//Marcar ou desmarcar os inputs de tipo radio
	$(".accions :radio").change(function () {
		$('tr.seleccionado').removeClass('seleccionado');
		$(this).parent().parent().addClass('seleccionado');
	});
	
	
	//Marcar/desmarcar checkboxes
	$('.opcions .marcar_todos').click(function () {
		$(".accions :checkbox").attr("checked", "checked");
		$("#listado table tr").addClass('seleccionado');
		var cabeceira = $("#listado table tr").get(0);
		$(cabeceira).removeClass('seleccionado');
		return false;
	});
	$('.opcions .desmarcar_todos').click(function () {
		$(".accions :checkbox").removeAttr("checked");
		$(".accions :radio").removeAttr("checked");
		$("#listado table tr").removeClass('seleccionado');
		return false;
	});
	
	//Invertir checkboxes
	$('.opcions .invertir').click(function () {
		$(".accions :checkbox").each(function() {
			if ($(this).attr("checked")) {
				$(this).removeAttr("checked");
			} else {
				$(this).attr("checked", "checked");
			}
		});
		$("#listado table tr").toggleClass('seleccionado');
		return false;
	});

	
	//Ajax
	//Boleano
	$(".boleano a").click(function () {
		var imaxe = $('img', this);
		var ligazon = $(this);
		var variables = $(this).attr('href');
		variables = variables.replace('ajax_defecto.php?', '');
		var nova_imaxe = $(imaxe).attr('src');
		nova_imaxe = nova_imaxe.replace('boleano_1.png', '');
		nova_imaxe = nova_imaxe.replace('boleano_0.png', '');
		
		$.ajax({
			type: "post",
			dataType: "xml",
			url: 'ajax_defecto.php',
			data: variables,
			success: function(xml) {
				
				$("datos", xml).each(function() {
					var valor = $("dato", this).text();
					
					if (!valor || valor == 0) {
						nova_imaxe = nova_imaxe + 'boleano_0.png';
						variables = variables.replace('valor=0', 'valor=1');
					} else {
						nova_imaxe = nova_imaxe + 'boleano_1.png';
						variables = variables.replace('valor=1', 'valor=0');
					}
					$(imaxe).attr('src', nova_imaxe);
					$(ligazon).attr('href', 'ajax_defecto.php?' + variables);
				})
			}
		});
		return false;
	});


	//Titulos
	$("td.titulo, td.texto").dblclick(function () {
		if ($(this).parent().parent().parent().attr('id') != 'formulario_relacionar') {
			var valor = $(this).html();
			if (valor = prompt("Introduce un novo valor", valor)) {
				var id = $(this).parent().attr('id');
				id = id.replace('f_', '');
				var campo = $(this).attr('abbr');
				var taboa = $(this).parent().parent().parent().attr('id');
				var td = $(this);
				
				$.ajax({
					type: "post",
					dataType: "xml",
					url: 'ajax_defecto.php',
					data:	"id=" + id +
						"&campo=" + campo +
						"&taboa=" + taboa +
						"&valor=" + valor +
						"&accion=modificar",
					success: function(xml) {
						$("datos", xml).each(function() {
							var valor = $("dato", this).text();
							$(td).html(valor);
						})
					}
				});
			}
		}
	});
	
	
	//Eliminar rexistro por ajax
	$('.borrar_rexistro').click(function () {
		if(confirm('Seguro que queres eliminar este rexistro?')) {
			var variables = $(this).attr('href');
			var tr = $(this).parent().parent();
			variables = variables.replace('ajax_defecto.php?', '');
			$.ajax({
				type: "post",
				dataType: "xml",
				url: 'ajax_defecto.php',
				data: variables,
				success: function(xml) {
					$(tr).fadeOut();
				}
			});
			return false;
		} else {
			return false;
		}
	});
	
	
	//Subir e baixar nos campos de orde
	$("#boton_subir").click(function () {
		var input = $(this).attr("href");
		var valor = parseInt($("#" + input).val());
		if (!valor) {
			valor = 0;
		}
		valor++;
		$("#" + input).val(valor);
		return false;
	});
	$("#boton_baixar").click(function () {
		var input = $(this).attr("href");
		var valor = parseInt($("#" + input).val());
		if (!valor) {
			valor = 0;
		} else if (valor > 0) {
			valor--;
		}
		$("#" + input).val(valor);
		return false;
	});
	
	
	//Limitar os caracteres nun campo
	$(".limitar_caracteres").keyup(function() {
		var id = $(this).attr("id");
		var max = $("#carac_" + id + "_max").html();
		var actuales = $(this).val().length;
		var quedan = max - actuales;
		if (!quedan) {
			quedan = "0";
		}
		$("#carac_" + id).html(quedan);
		
		if (quedan < 0) {
			$("#carac_" + id).addClass("alerta");
		} else {
			$("#carac_" + id).removeClass("alerta");
		}
	});
	$(".limitar_caracteres").trigger("keyup");
	
	
});