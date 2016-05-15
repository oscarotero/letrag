$(document).ready(function () {

//Mostrar o visualizador de tipografías a pantaia completa
$(".pantallasalir").hide();
var offset = '';

$(".pantallacompleta").click(function () {
	if (!offset) {
		offset = $("#contenedor_flash").offset();
	}
	
	$("#contenedor_flash").css('position', 'absolute');
	$("#contenedor_flash").css('padding', '5%');
	$("#contenedor_flash").animate(
		{
		left: 0,
		top: 0,
		width: "90%",
		height: "90%"
		},
		{ duration: "slow" }
	);
	window.scroll(0, 0);
	
	$(".pantallacompleta").hide();
	$(".pantallasalir").show();
	
	return false;
});

$(".pantallasalir").click(function () {
	
	$("#contenedor_flash").css('position', 'static');
	$("#contenedor_flash").css('width', '590px');
	$("#contenedor_flash").css('height', '500px');
	$("#contenedor_flash").css('padding', '0');
	$("#contenedor_flash").css('top', offset.top + 'px');
	$("#contenedor_flash").css('left', offset.left + 'px');
	
	$(".pantallacompleta").show();
	$(".pantallasalir").hide();
	
	return false;
});

});