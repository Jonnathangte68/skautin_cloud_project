<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/home_talent.css') }}">
	<script type="text/javascript">let gvalues={API_URL:"http://localhost:3002/",NOTIFICATION_THREAD:-1};</script>
	<style type="text/css">/* Weird search bar style for firefox */#prependedtext{line-height:14px!important}.btn-mobile-navigation{position:absolute;top:20%;right:5%}.btn-mobile-navigation>img{width:13px}.responsive-menu-main{z-index:100;left:0;position:absolute;top:100%;background:#ddd;width:100%;margin:0!important;padding:0!important}.list-menu-responsive{list-style-type:none;padding-left:0!important}.list-menu-responsive>li{padding:4%;color:#000;font-weight:700;border-bottom:1px solid #fff}.list-menu-responsive>li:last-child{border-bottom-style:none}.img_list_item_mobile_menu{display:inline;float:left;clear:both;margin-right:2%;width:8%;color:#000;font-size:21px}.img_list_item_mobile_menu svg{margin-right:12px!important}</style>
	<link rel="stylesheet" type="text/css" href="{{asset('css/responsive_styles.css')}}">
	@yield('head')
	<style>.left_add_user{width:1.9rem}.rigth_add_user{width:1.9rem;float:right;clear:both}.inner_card_body{padding:5%}.popover{width:650px!important}.popover-title{text-align:center;font-weight:700}.popover-content{height:365px;overflow-y:auto;overflow-x:hidden;padding-left:10%;padding-right:10%}.no-padd{padding-left:2px;padding-right:0;padding-top:0;padding-bottom:0}.img-notif{width:100%;border-radius:50%}.advanced-search-text{position:absolute;top:18px;left:55%}.search{left:24%;width:21%;margin-top:5px!important}.search svg{left:17px!important;top:14px}#prependedtext{margin-left:0!important}</style>
</head>
<body>

	@if(Session::has('status')) 
    <div class="alert alert-danger" style="display: none;">
      {{ Session::get('status')}}
    </div>
    @endif
    @if(Session::has('suc')) 
    <div class="alert alert-success" style="display: none;">
      {{ Session::get('suc')}}
    </div>
    @endif
	<div id="hidden_dv" style="display: none;">
	    <div class="alert alert-success" style="display: none;">
		  <strong id="success_title">Success!</strong> <span id="success_body"></span>.
		</div>

		<div class="alert alert-info" style="display: none;">
		  <strong id="info_title">Info!</strong> <span id="info_body"></span>.
		</div>

		<div class="alert alert-warning" style="display: none;">
		  <strong id="warning_title">Warning!</strong> <span id="warning_body"></span>.
		</div>

		<div class="alert alert-danger" style="display: none;">
		  <strong id="danger_title">Danger!</strong> <span id="danger_body"></span>.
		</div>
	</div>
	<!-- Barra de Navegacion -->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid barra">
	    <div class="navbar-header padleft">
	      <a class="navbar-brand" href="#" style="padding-top: 9px;padding-right: 2px;"><img src="/img/logo.jpg" class="logo-sz"></a>
	    </div>
	    <ul class="nav navbar-nav navbar-left">
                <div style="line-height: 0.5;padding-top: 9px;"><p id="pmoto" class="logomoto letraextragrande" style="width:100%;margin: 0 !important;color:#31859C;font-family:Calibri,sans-serif;padding-top: 8px;"><b style="padding-bottom: 0px !important;">Skautin</b></p></div>
                <div style="width:100%;font-family:Calibri,sans-serif;">
					<b style="color: #686868;">Because talent is everywhere</b>
                </div>
	          </li>
	    </ul>
	    <!--<ul class="nav navbar-nav navbar-center">
	          <li class="aftermoto">
	              <div class="input-group search" style="width:100%;">
	                <span class="fa fa-search"></span>
	                <input id="prependedtext" name="prependedtext" class="form-control" placeholder="Search talents, recruiters and Jobs" type="text"/>
	              </div>
	          </li>
	          <li class="nav-advance"><a href="{{route('busqueda_avanzada_talento')}}">Advanced Search</a></li>
	    </ul>  -->
        <ul class="nav navbar-nav navbar-right padright">
			<li class="hide-on-mobile"><a title="NOTIFICATIONS" data-toggle="popover" data-placement="bottom" data-content="" class="popover-notifications">
			<img src="{{ URL::asset('img/bell.png') }}" class="img-navbar-menu"></a></li>
          <!--<li><a href="#"><i class="fas fa-bell" class="img-navbar-menu" style="color:#FFD700;"></i></a></li>-->
          <li class="hide-on-mobile"><a href="{{route('vacant_management')}}"><img src="{{ URL::asset('img/menu_3.jpg') }}" class="img-navbar-menu"></a></li>
          <li class="hide-on-mobile"><a href="{{route('connectios_recruiter')}}"><img src="{{ URL::asset('img/menu_1.png') }}" class="img-navbar-menu"></a></li>
          <li class="hide-on-mobile"><a href="{{route('dash_chatr')}}"><img src="{{ URL::asset('img/menu_2.png') }}" class="img-navbar-menu"></a></li>
          <!--<li><a href="#"><img src="briefcase.png" style="width: 28px;"></a></li>-->
          <li class="dropdown hide-on-mobile"><a data-toggle="dropdown" class="no-backgroundblackstrange link-hand"><img src="{{ URL::asset('img/menu_4.png') }}" class="img-navbar-menu"></a>
			<ul class="dropdown-menu">
					<li><a href="/home-prospects"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</a></li>
					<li class="divider"></li>
		    	<li><a href="{{ route('rec_account_settings') }}/invite-fb">Invite friends from Fb</a></li>
		    	<li class="divider"></li>
		    	<li><a href="{{ route('rec_account_settings') }}/global-settings">Settings</a></li>
		    	<li class="divider"></li>
		    	<li><a href="{{ route('rec_account_settings') }}/account-management">Account</a></li>
		    	<li class="divider"></li>
		    	<li><a href="{{ route('rec_account_settings') }}/help">Help</a></li>
		    	<li class="divider"></li>
		    	<li><a href="{{ route('logOut') }}">Log out</a></li>
		  	</ul>
		  </li>
        </ul>

		  <div class="input-group search normal-bar-nav-search hide-on-mobile">
			  <span class="fa fa-search"></span>
			  <!--<input placeholder="Search term">-->
			  <input id="prependedtext" name="prependedtext" class="form-control nav-advance-search-search" placeholder="Search talents, recruiters and Jobs" type="text"/>
		  </div>
		  <a href="{{route('busqueda_avanzada_talento')}}" class="advanced-search-text hide-on-mobile">Advanced Search</a>
		  <button id="menu_mobile_handler" class="show-on-mobile btn-mobile-navigation"><img src="{{asset('img/menu_4.png')}}"></button>
		  <!-- nav options for mobile -->
		  <div class="responsive-menu-main">
			  <ul class="list-menu-responsive" style="display: none;">
				  <li><img src="{{URL::asset('img/menu_3_nb.png')}}" class="img_list_item_mobile_menu">HOME</li>
				  <li><img src="{{URL::asset('img/menu_1_nb.png')}}" class="img_list_item_mobile_menu">CONNECT</li>
				  <li><img src="{{URL::asset('img/menu_2_nb.png')}}" class="img_list_item_mobile_menu">CHAT</li>
				  <li><i class="fa fa-cog img_list_item_mobile_menu"></i>SETTINGS</li>
			  </ul>
		  </div>
	  </div>
	</nav>

	<!-- Fin de la Barra -->
    @yield('content')
		<script type="text/javascript" src="{{ URL::asset('js/settings_form.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/notification.js') }}"></script>
		<script type="text/javascript">function checkFill(){$("#prependedtext").is(":focus")||""!=$("#prependedtext").val()||($(".search").animate({width:"21%"},1500),$(".advanced-search-text").animate({left:"55%"},1500)),setTimeout(function(){checkFill()},5e3)}$(document).ready(function(){$('[data-toggle="popover"]').popover();checkFill()}),$('[data-toggle="popover"]').on("show.bs.popover",function(){$(".popover-content").append("<div id='' style='text-align: center;'><img src='img/ui-anim_basic_16x16.gif'/></div>")});</script>
		<script type="text/javascript">$("#prependedtext").click(function(){$(".search").animate({width:"30%"},1500),$(".advanced-search-text").animate({left:"64%"},1500),setTimeout(function(){$("#prependedtext").is(":focus")||""!=$("#prependedtext").val()||($(".search").animate({width:"21%"},1500),$(".advanced-search-text").animate({left:"55%"},1500))},4500)});</script>
		<script type="text/javascript">
			$('#menu_mobile_handler').click(function() {
				$('.list-menu-responsive').toggle( "slow", function() {});
			});
		</script>
		<!--<script type="text/javascript" src="{{ URL::asset('js/registration.js') }}"></script>-->
		<!--<script type="text/javascript" src="{{ URL::asset('js/talent.js') }}"></script>-->
		<!-- <script> Last script... </script> -->
		<!-- <script type="text/javascript" src="{{ URL::asset('js/redirectIfnotAuthenticated.js') }}"></script> -->
	@yield('scripts')
</body>
</html>