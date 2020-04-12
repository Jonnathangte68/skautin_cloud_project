var messageObj = {
    0: "*  Name cannot be empty!",
    1: "*  Title cannot be empty!",
    2: "*  Description cannot be empty", 
    3: "*  Please select a category for this vacant", 
    4: "*  Please select a subcategory for this vacant", 
    5: "*  Select country for this vacant", 
    6: "*  Select state for this vacant", 
    7: "*  Select a city for this vacant", 
    8: "*  Select level required for this vacant"
}

/* Validate submission */



$('form').submit(function(e) {
    let dontSubmit = false;
    if($('#name').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[0]}</p>`);
        $('#name').css('border-color', 'red');
        $('#name').focus();
    }
    if($('#title').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[1]}</p>`);
        $('#title').css('border-color', 'red');
        $('#title').focus();
    }
    if($('#description').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[2]}</p>`);
        $('#description').css('border-color', 'red');
        $('#description').focus();
    }
    if($('#category').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[3]}</p>`);
        $('#category').css('border-color', 'red');
        $('#category').focus();
    }
    if($('#subcategory').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[4]}</p>`);
        $('#subcategory').css('border-color', 'red');
        $('#subcategory').focus();
    }
    if($('#country').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[5]}</p>`);
        $('#country').css('border-color', 'red');
        $('#country').focus();
    }
    if($('#state').val()) {
        
    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[6]}</p>`);
        $('#state').css('border-color', 'red');
        $('#state').focus();
    }
    if($('#city').val()) {

    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[7]}</p>`);
        $('#city').css('border-color', 'red');
        $('#city').focus();
    }
    if($('#level').val()) {

    }else {
        dontSubmit = true;
        $('.errors').append(`<p style='color:red;font-weight:bold;'>${messageObj[8]}</p>`);
        $('#level').css('border-color', 'red');
        $('#level').focus();
    }
    
    if(dontSubmit===true) {
        e.preventDefault();
    }
});