//Coller tipografias instaladas
function obxecto_Flash (movieName) {
	if (window.document[movieName]) {
		return window.document[movieName];
	}
	if (navigator.appName.indexOf("Microsoft Internet") == -1) {
		if (document.embeds && document.embeds[movieName]) {
			return document.embeds[movieName];
		}
	} else {
		return document.getElementById(movieName);
	}
}

function tipografias_en_select () {
	var peliculaFlash = obxecto_Flash("flash_instaladas");
	var tipografias = "",
	tipografias = peliculaFlash.GetVariable("/:tipografias");
	tipografias = unescape(tipografias);
	tipografias = tipografias.split(',');
	var total = tipografias.length;
	var select = document.getElementById("select_fontlist");
	for (n = 0; n < total; n++) {
		select.options[n] = new Option(tipografias[n], tipografias[n]);
	}
}

//Cambiar tipografía caracter
$("#select_fontlist").click(function () {
	var select = document.getElementById("select_fontlist");
	if (select.options.length == 1) {
		tipografias_en_select();
	}
});

$("#select_fontlist").change(function () {
	var font = $("#select_fontlist").val();
	font = "\"" + font + "\"";
	$(".caracter").css("font-family", font);
});