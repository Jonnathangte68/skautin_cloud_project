function clearForm() {
    $('#fill_add_wrong_items').empty();
    $('#username').css('border-color', 'rgb(204, 204, 204)');
    $('#password1').css('border-color', 'rgb(204, 204, 204)');
    $('#password2').css('border-color', 'rgb(204, 204, 204)');
    $('#name').css('border-color', 'rgb(204, 204, 204)');
    $('#gender').css('border-color', 'rgb(204, 204, 204)');
    $('#yearofbirth').css('border-color', 'rgb(204, 204, 204)');
    $('#country').css('border-color', 'rgb(204, 204, 204)');
    $('#state').css('border-color', 'rgb(204, 204, 204)');
    $('#city').css('border-color', 'rgb(204, 204, 204)');
    return 1;
}

$( "#yearofbirth" ).keydown(function( event ) {
    if(event.which > 105 && event.which < 96) {
        event.preventDefault();
    }
});
$( "#yearofbirth").focusout(function() {
    var d = new Date
    if($( "#yearofbirth").val() < (d.getFullYear() - 120) || $( "#yearofbirth").val() > d.getFullYear()) {
        $( "#yearofbirth").val("");
    }
});

function usernameMask(username) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(username);
}

function passwordMask(pass) {
    let aprove = true;
    var re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    return re.test(pass);
}

function errorHandler(error) {
    switch (error) {
        case 1:
			$('#username').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Username cannot be empty!</p>");
            $('#username').focus();
			break;
        case 2:
            $('#password1').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Password cannot be empty!</p>");
            $('#password1').focus();
            break;
        case 3:
            $('#password2').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Password Confirmation cannot be empty!</p>");
            $('#password2').focus();
			return "<p>Name is not valid!</p>";
			break;
		case 4:
            $('#name').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please enter a Name!</p>");
            $('#name').focus();
            break;
        case 5:
            $('#gender').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please select Gender!</p>");
            $('#gender').focus();
			break;
        case 6:
            $('#yearofbirth').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please enter Year of birth!</p>");
            $('#yearofbirth').focus();
			break;
        case 7:
            $('#country').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please enter a country!</p>");
            $('#country').focus();
			break;
        case 8:
            $('#state').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please enter a state!</p>");
            $('#state').focus();
			break;
        case 9:
            $('#city').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please enter a city!</p>");
            $('#city').focus();
			break;
		case 10:
            $('#level').css('border-color', 'red');
            $('#fill_add_wrong_items').append("<p>* Please select Level!</p>");
            $('#level').focus();
            break;
		case 11:
            $('#fill_add_wrong_items').append("<p>* Please upload you Profile Image!</p>");
            break;
        case 12:
            $('#fill_add_wrong_items').append("<p>* Password and Password Confirmation do not match!</p>");
            break;
        case 13:
            $('#fill_add_wrong_items').append("<p>* Password should be at least 6 character long and contain at least One special character (!@#$%^&*), One digit (123456789), One Mayus Letter and One Minus Letter!</p>");
            break;
        case 14:
            $('#fill_add_wrong_items').append("<p>* Password Confirmation should be at least 6 character long and contain at least One special character (!@#$%^&*), One digit (123456789), One Mayus Letter and One Minus Letter!</p>");
            break;
    }
}


$('form').submit(function(e) {
    let xv = false;
    clearForm();
    if(!$('#username').val()) {
        errorHandler(1);
        xv = true;
    }else if(!usernameMask($('#username').val())) {
        errorHandler(12);
        xv = true;
    }
    if(!$('#password1').val()) {
        errorHandler(2);
        xv = true;
    }
    if(!$('#password2').val()) {
        errorHandler(3);
        xv = true;
    }
    if($('#password1').val() && $('#password2').val() && $('#password1').val()!==$('#password2').val()) {
        errorHandler(12);
        xv = true;
    }
    if($('#password1').val() && !passwordMask($('#password1').val())) {
        errorHandler(13);
        xv = true;
    }
    if($('#password2').val() && !passwordMask($('#password2').val())) {
        errorHandler(14);
        xv = true;
    }
    if(!$('#name').val()) {
        errorHandler(4);
        xv = true;
    }
    if(!$('#gender').val()) {
        errorHandler(5);
        xv = true;
    }
    if(!$('#yearofbirth').val()) {
        errorHandler(6);
        xv = true;
    }
    if(!$('#country').val()) {
        errorHandler(7);
        xv = true;
    }
    if(!$('#state').val()) {
        errorHandler(8);
        xv = true;
    }
    if(!$('#city').val()) {
        errorHandler(9);
        xv = true;
    }
    if(!$('#pic').val()) {
        errorHandler(11);
        xv = true;
    }
    if(xv===true) {
        e.preventDefault();
    }

});