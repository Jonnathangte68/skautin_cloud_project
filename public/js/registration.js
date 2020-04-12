$('#firstoptrecruiter').click(function(){
    $( "#firstoptrecruiter" ).toggleClass( 'selected-bold' );
    $( "#secondoptrecruiter" ).removeClass( 'selected-bold' );

    // Mostrar componentes

    $("#frmusername").show();
    $("#frmpassword").show();
    $("#frmpassword2").show();
    $("#frmname").show();
    $("#frmgender").show();
    $("#frmyearofbirth").show();
    $("#frmcountry").show();
    $("#frmstate").show();
    $("#frmcity").show();
    $("#frmrtype").show();
    $("#frmpic").show();
    $("#frmorganization").hide();
    $("#frmwebsite").hide();
    $("#frmrtype").show();
    $("#frmorganization_phone").hide();
    $(".institutinfo").hide();
    $("#institutionline").hide();
    $("#frmcategory").hide();
    $("#frmsubcategory").hide();
    $("#frminterestlevel").hide();
    $("#frminterestgender").hide();
    $("#frminterestage").hide();

    if (parseInt($("#rtype").val())===1) {
        $("#frmorganization").show();
        $("#frmwebsite").show();
        $("#frmorganization_phone").show();
    }
});

$('#secondoptrecruiter').click(function(){
    $( "#secondoptrecruiter" ).toggleClass( 'selected-bold' );
    $( "#firstoptrecruiter" ).removeClass( 'selected-bold' );

    // Mostrar componentes

    $("#frmusername").hide();
    $("#frmpassword").hide();
    $("#frmpassword2").hide();
    $("#frmname").hide();
    $("#frmgender").hide();
    $("#frmyearofbirth").hide();
    $("#frmcountry").hide();
    $("#frmcity").hide();
    $("#frmstate").hide();
    $("#frmrtype").hide();
    $("#frmpic").hide();
    $("#frmrtype").hide();
    $("#frmorganization").hide();
    $("#frmwebsite").hide();
    $("#frmorganization_phone").hide();
    $(".institutinfo").hide();
    $("#institutionline").hide();


    $("#frmcategory").show();
    $("#frmsubcategory").show();
    $("#frminterestlevel").show();
    $("#frminterestgender").show();
    $("#frminterestage").show();
});

$('#rtype').change(function(){
    if ($('#rtype').val()==1) {
        $("#frmorganization").show();
        $("#frmwebsite").show();
        $("#frmorganization_phone").show();
    }else{
        $("#frmorganization").hide();
        $("#frmwebsite").hide();
        $("#frmorganization_phone").hide();
    }
});


//$( "#firstoptrecruiter" ).toggleClass( 'selected-bold', addOrRemove );

/*$(document).ready(function(){
    $("#imgrecruiterinfo").css({"opacity":1});
    $("#imginstitutioninfo").css({"opacity":0.2});
    $("#first-tab").addClass("step-active");
    $("#second-tab").removeClass("step-active");
    // Hide Validate form fields
    $("#frmusername").show();
    $("#frmpassword").show();
    $("#frmpassword2").show();
    $("#frmname").show();
    $("#frmgender").show();
    $("#frmyearofbirth").show();
    $("#frmcountry").show();
    $("#frmstate").show();
    $("#frmrtype").show();
    $("#frmpic").show();
    $("#frmorganization").hide();
    $("#frmwebsite").hide();
    $("#frmrtype").show();
    $("#frmorganization_phone").hide();
    $(".institutinfo").hide();
    $("#institutionline").hide();
    $("#frmcategory").hide();
    $("#frmsubcategory").hide();
    $("#frminterestlevel").hide();
    $("#frminterestgender").hide();
    $("#frminterestage").hide();
});
$("#recinfo").click(function(){
    //alert("Prueba");
    $("#imgrecruiterinfo").css({"opacity":1});
    $("#imginstitutioninfo").css({"opacity":0.2});
    $("#first-tab").addClass("step-active");
    $("#second-tab").removeClass("step-active");
    // Hide Validate form fields
    $("#frmusername").show();
    $("#frmpassword").show();
    $("#frmpassword2").show();
    $("#frmname").show();
    $("#frmgender").show();
    $("#frmyearofbirth").show();
    $("#frmcountry").show();
    $("#frmstate").show();
    $("#frmrtype").show();
    $("#frmpic").show();
    $("#frmrtype").show();

    if ($("rtype").val()==1) {
        $("#frmorganization").show();
        $("#frmwebsite").show();
        $("#frmorganization_phone").show();
        $(".institutinfo").show();
        $("#institutionline").show();
    }

    $("#frmcategory").hide();
    $("#frmsubcategory").hide();
    $("#frminterestlevel").hide();
    $("#frminterestgender").hide();
    $("#frminterestage").hide();
});
$("#insinfo").click(function(){
    //alert("Prueba");
    $("#imginstitutioninfo").css({"opacity":1});
    $("#imgrecruiterinfo").css({"opacity":0.2});
    $("#first-tab").removeClass("step-active");
    $("#second-tab").addClass("step-active");

    $("#frmusername").hide();
    $("#frmpassword").hide();
    $("#frmpassword2").hide();
    $("#frmname").hide();
    $("#frmgender").hide();
    $("#frmyearofbirth").hide();
    $("#frmcountry").hide();
    $("#frmstate").hide();
    $("#frmcategory").hide();
    $("#frmsubcategory").hide();
    $("#frmrtype").hide();
    $("#frmpic").hide();
    $("#frmorganization").hide();
    $("#frmwebsite").hide();
    $("#frmrtype").hide();
    $("#frmorganization_phone").hide();
    $(".institutinfo").hide();
    $("#institutionline").hide();

    $("#frmcategory").show();
    $("#frmsubcategory").show();
    $("#frminterestlevel").show();
    $("#frminterestgender").show();
    $("#frminterestage").show();
});
$( "#rtype" ).change(function() {
    if ($(this).val()==1) {
        $("#frmorganization").show();
        $("#frmwebsite").show();
        $("#frmorganization_phone").show();
        $(".institutinfo").show();
        $("#institutionline").show();    
    }
    else {
        $("#frmorganization").hide();
        $("#frmwebsite").hide();
        $("#frmorganization_phone").hide();
        $(".institutinfo").hide();
        $("#institutionline").hide(); 
    }
});

*/