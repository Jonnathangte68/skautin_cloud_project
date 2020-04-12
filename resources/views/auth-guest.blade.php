<!DOCTYPE html>
<html>

<head>
    <title>XTake - Talent is Everywhere!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta author="xtake">
    <meta description="Xtake is a new platform created with you in mind. Offers its services to help recruiters find staff that can meet their needs and allows the public to be found while showing their talents">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
</head>

<body>
    
    <script>
        (async function(){
            let condition = false;
            let intents = 0;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                do {
                    if(intents > 0) {
                        alert("Sorry, wrong password!");
                    }
                    const user = prompt("Please enter your user", "");
                    const pass = prompt("Please enter your password", "");
                    await $.ajax({
                        method: "POST",
                        url: "/authenticate-incoming",
                        data: { user, pass },
                        dataType: "json"
                        })
                        .done(function( msg ) {
                            if(msg.status) {
                                alert("redirect");
                                condition = true;
                            }
                        });
                        intents++;
                } while(!condition);
            location.replace("/home");
        })();
    </script>

</body>

</html>