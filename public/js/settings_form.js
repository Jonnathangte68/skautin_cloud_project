$(document).ready(function(){
	$('#settingslk').hide();
	$('#accountlk').hide();
	$('#helplk').hide();
});

$( "#enlacesettingslk" ).click(function(){
	$("#settingslk").toggle();
});
$( "#enlaceaccountlk" ).click(function(){
	$("#accountlk").toggle();
});
$( "#enlacehelplk" ).click(function(){
	$("#helplk").toggle();
});
$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-danger").slideUp(500);
});
$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
/*
$( "#accountlk" ).toggle();
$( "#helplk" ).toggle();



*/