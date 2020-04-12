<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/advance_search_style.css') }}">
</head>
<body>

	<!-- Barra de Navegacion -->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid barra">
	    <div class="navbar-header padleft">
	      <a class="navbar-brand" href="#">Logo</a>
	    </div>
	    <ul class="nav navbar-nav navbar-left">
	          <li><a href="#">Moto</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-center">
	          <li class="aftermoto">
	              <div class="input-group search" style="width:100%;">
	                <span class="fa fa-search"></span>
	                <!--<input placeholder="Search term">-->
	                <input id="prependedtext" name="prependedtext" class="form-control" placeholder="Search talents, recruiters and Jobs" type="text"/>
	              </div style="float: right;clear: both;">
	          </li>
	          <li class="nav-advance"><a href="{{route('busqueda_avanzada_talento')}}">Advanced Search</a></li>
	    </ul>    
        <ul class="nav navbar-nav navbar-right padright">
          <li><a href="#"><img src="{{ URL::asset('img/menu_1.png') }}" class="img-navbar-menu"></a></li>
          <li><a href="#"><img src="{{ URL::asset('img/menu_2.png') }}" class="img-navbar-menu"></a></li>
          <!--<li><a href="#"><img src="briefcase.png" style="width: 28px;"></a></li>-->
          <li><a href="#"><img src="{{ URL::asset('img/menu_4.png') }}" class="img-navbar-menu"></a></li>
        </ul>
	  </div>
	</nav>
	<!-- Fin de la Barra -->
    @yield('content')

    <!--<script type="text/javascript" src="{{ URL::asset('js/registration.js') }}"></script>-->
</body>
</html>