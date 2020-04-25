<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Login to Skautin</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function errorLogin() {
            alert("Sorry user id not recognized please try again");
            setTimeout(function() {
                authenticate();
            }, 2000);
        }

        function authenticate() {
            const user = window.prompt("Please enter, user ID:","000000000000");

            $.ajax({
                method: "POST",
                url: "/validate",
                data: { 'userID': user },
                dataType: 'json',
                })
                .done(function( result ) {
                    if(user) {
                        if (!result.status) {
                            errorLogin();
                        } else {
                            location.replace('/landing');
                        } 
                    } else {
                        errorLogin();
                    }
                });
        }

        $( document ).ready(async function () {
            authenticate();
        });
    </script>
    </body>
</html>
