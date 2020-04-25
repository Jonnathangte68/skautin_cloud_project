<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body onload="redirect()">
    <script>
        function redirect() {
            alert('gets executed!');
            const replaceUrl = window.location.protocol + '//' + window.location.hostname;
            history.replaceState(null, document.title, location.pathname + "#!/");
            history.pushState(null, document.title, location.pathname);
            history.replaceState(null, document.title, location.pathname);
            location.replace(replaceUrl);
        }
    </script>
</body>

</html>