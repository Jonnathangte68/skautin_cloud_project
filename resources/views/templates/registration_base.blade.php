<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/registration.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/jquery-ui.min.css') }}">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>

	<style type="text/css">
		.ui-autocomplete-loading {
		  	background: white url("img/ui-anim_basic_16x16.gif") right center no-repeat;
		}
		.logo-sz {
		  width: 27px;
		}
	</style>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	@yield('head')
</head>
<body>
	<!-- Barra de Navegacion -->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid barra">
	    <div class="navbar-header padleft">
	      <a class="navbar-brand" href="/"><img src="/img/logo.jpg" class="logo-sz"></a>
	    </div>
	  </div>
	</nav>
	<!-- Fin de la Barra -->
		@yield('content')
		{{--Scripts--}}
		@yield('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/registration.js') }}"></script>
</body>
</html>