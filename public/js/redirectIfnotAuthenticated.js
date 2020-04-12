$(function() {
    console.log("Doc ready!");
    (function chkAuthJls () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "GET",
            url: "/checkUserAuthL",
            dataType: "json"
        })
            .done(function( msg ) {
                if (!msg.result) {
                    try{location.replace("/");}catch(Err){window.location.replace("/");}
                }
            });
        setTimeout(function() {
            chkAuthJls();
        },1000);
    }());
})