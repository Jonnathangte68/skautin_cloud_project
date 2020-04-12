function checkValidate(error_code) {
	switch (error_code) {
		case 1:
			$('#username').css('border-color', 'red');
			return "<p>Username must be a valid email address!</p>";
			break;
		case 2:
			$('#password1').css('border-color', 'red');
			$('#password2').css('border-color', 'red');
			return "<p>Password should be at least 6 character long and contain at least One special character (!@#!-_%^&*()), One digit (123456789), One Mayus Letter and One Minus Letter!</p>";
			break;
		case 3:
			$('#name').css('border-color', 'red');
			return "<p>Name is not valid!</p>";
			break;
		case 4:
			$('#gender').css('border-color', 'red');
			return "<p>Gender not valid!</p>";
			break;
		case 5:
			$('#yearofbirth').css('border-color', 'red');
			return "<p>Birth year is not valid!</p>";
			break;
		case 6:
			$('#country').css('border-color', 'red');
			return "<p>Country is not valid!</p>";
			break;
		case 7:
			$('#state').css('border-color', 'red');
			return "<p>State is not valid!</p>";
			break;
		case 8:
			$('#city').css('border-color', 'red');
			return "<p>City is not valid!</p>";
			break;
		case 9:
			$('#rtype').css('border-color', 'red');
			return "<p>Recruiter Type not valid!</p>";
			break;
		case 10:
			return "<p>Error processing Profile Image please select a new one or try to upload again!</p>";
			break;
		case 11:
			return "<p>User is already registered!</p>";
			break;
		case 12:
			return "<p>Password and Password Confirmation doesn't match!</p>";
			break;
		case 13:
			return "<p>Email domain is invalid! Ex: (@hotmail.com, @gmail.com, @yahoo.com, @outlook.com)</p>";
			break;
		case 14:
			return "<p>Incorrect birth year!</p>";
			break;
		default:
			return "ERROR processing your request, please try again later or contact support.";
	}
}

function checkValidateTal(error_code) {
	switch (error_code) {
		case 1:
			$('#username').css('border-color', 'red');
			return "<p>Username must be a valid email address!</p>";
			break;
		case 2:
			$('#password1').css('border-color', 'red');
			$('#password2').css('border-color', 'red');
			return "<p>Password should be at least 6 character long and contain at least One special character (!@#$%^&*), One digit (123456789), One Mayus Letter and One Minus Letter!</p>";
			break;
		case 3:
			$('#name').css('border-color', 'red');
			return "<p>Name is not valid!</p>";
			break;
		case 4:
			$('#gender').css('border-color', 'red');
			return "<p>Gender not valid!</p>";
			break;
		case 5:
			$('#yearofbirth').css('border-color', 'red');
			return "<p>Birth year is not valid!</p>";
			break;
		case 6:
			$('#country').css('border-color', 'red');
			return "<p>Country is not valid!</p>";
			break;
		case 7:
			$('#state').css('border-color', 'red');
			return "<p>State is not valid!</p>";
			break;
		case 8:
			$('#city').css('border-color', 'red');
			return "<p>City is not valid!</p>";
			break;
		case 9:
			$('#rtype').css('border-color', 'red');
			return "<p>Recruiter Type not valid!</p>";
			break;
		case 10:
			return "<p>Error processing Profile Image please select a new one or try to upload again!</p>";
			break;
		case 11:
			return "<p>You have to select at least one category</p>";
			break;
		case 12:
			return "<p>You have to select at least one subcategory!</p>";
			break;
		case 13:
			return "<p>User already registered!</p>";
			break;
		case 14:
			return "<p>Password and password confirmation doesn't match!</p>";
			break;
		case 15:
			return "<p>Email domain is invalid! Ex: (@hotmail.com, @gmail.com, @yahoo.com, @outlook.com)</p>";
			break;
		case 16:
			return "<p>Incorrect birth year!</p>";
			break;
		default:
			return "ERROR processing your request, please try again later or contact support.";
	}
}


$(document).ready(function () {
	$('#pcategoria').hide();
	$('#subcategory').select2();
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
	$("#frmcategory").hide();
	$("#frmsubcategory").hide();
	$("#frminterestlevel").hide();
	$("#frminterestgender").hide();
	$("#frminterestage").hide();

	try {
		if (errors && errors[0] != '-1' && errors != '-1') {
			errors.split(",").forEach(function (e) {
				if (e && e !== undefined && e != null && e != "") {
					$('#fill_add_wrong_items').append((window.location.pathname == "/new-recruiter-registration") ? checkValidate(parseInt(e)) : checkValidateTal(parseInt(e)));
				}
			});
		}
	} catch (err) {
		console.log('Err: 9GLB');
	}
});


/* -- */

$("#country").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: "/api/countries",
			dataType: "json",
			data: { q: request.term },
			success: function (data) {
				response(data);
			}
		});
	},
	minLength: 1,
	select: function (event, ui) {
		setTimeout(function () { $('#country').val(ui.item.label) }, 30);
		$('input[name="countrykey"]').val(ui.item.value);
	}
});
$("#state").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: "/api/states",
			dataType: "json",
			data: { q: request.term, country: $("#country").val() },
			success: function (data) {
				response(data);
			}
		});
	},
	minLength: 1,
	select: function (event, ui) {
		setTimeout(function () { $('#state').val(ui.item.label) }, 30);
		$('input[name="statekey"]').val(ui.item.value);
	}
});
$("#city").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: "/api/cities",
			dataType: "json",
			data: { q: request.term, state: $("#state").val() },
			success: function (data) {
				response(data);
			}
		});
	},
	minLength: 1,
	select: function (event, ui) {
		setTimeout(function () { $('#city').val(ui.item.label) }, 30);
		$('input[name="citykey"]').val(ui.item.value);
	}
});
$("#category").click(function () {
	if ($('#pcategoria').is(":visible")) {
		$('#pcategoria').hide();
	} else {
		$('#pcategoria').show();
	}
});
$('#password1').mouseout(function () {
	if (!$('#password1').val() && $('#password1').val() == "") {
		$('#password_don_match_error').hide();
	}
	else if (!$('#password2').val() && $('#password2').val() == "") {
		$('#password_don_match_error').hide();
	}
	else if ($('#password1').val() && $('#password1').val() !== "" && $('#password1').val() !== null) {
		if ($('#password2').val() && $('#password2') !== "" && $('#password2') !== null) {
			if ($('#password1').val() === $('#password2').val()) {
				//alert('Ok password');
			}
			else {
				if ($('#password_don_match_error').css('display') === "none") {
					$('#password_don_match_error').show();
					$('#password1').focus();
				}
			}
		}
	}
});
$('#password2').mouseout(function () {
	if (!$('#password1').val() && $('#password1').val() == "") {
		$('#password_don_match_error').hide();
	}
	else if (!$('#password2').val() && $('#password2').val() == "") {
		$('#password_don_match_error').hide();
	}
	else if ($('#password1').val() && $('#password1').val() !== "" && $('#password1').val() !== null) {
		if ($('#password2').val() && $('#password2') !== "" && $('#password2') !== null) {
			if ($('#password1').val() === $('#password2').val()) {
				//alert('Ok password');
			}
			else {
				if ($('#password_don_match_error').css('display') === "none") {
					$('#password_don_match_error').show();
					$('#password2').focus();
				}
			}
		}
	}
});
$(document).mouseup(function (e) {
	var container = $("#pcategoria");

	// if the target of the click isn't the container nor a descendant of the container
	if (!container.is(e.target) && container.has(e.target).length === 0) {
		container.hide();
	}
});
/*
$('.category').change(function(){
  $('.category:checkbox:checked').each(function () {
    $.ajax({
        url:"{{ URL::to('/getcategsxsubcategs') }}" + "/" + $(this).val(),
        type: "get",
        success: function(response) {
          arreglo = eval(response);
          $.each(arreglo, function (i,item) {
              $('#subcategory').append($('<option>', {
                  value: item._id,
                  text : item.name
              }));
          });
        },
        error: function(xhr) {
          //console.log(xhr);
        }
    });
  })
});*/