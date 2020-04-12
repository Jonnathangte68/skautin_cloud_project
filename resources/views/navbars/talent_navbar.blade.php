<!-- Barra de Navegacion -->
<nav class="navbar navbar-inverse">
	  <div class="container-fluid barra">
	    <div class="navbar-header padleft">
	      <a class="navbar-brand" href="#" style="padding-top: 9px;padding-right: 2px;"><img src="{{$data[0]->logo_url}}" class="logo-sz"></a>
	    </div>
	    <ul class="nav navbar-nav navbar-left">
	          <li><!--<a href="#" style="padding-left:2px;color:#31859C;padding-top:7px;padding-bottom:0px;"><b style="font-size: 1.4em;line-height: 0.5;">{{$data[0]->moto}}<br><span style="color:black;color:#686868;font-size: 0.7em;">
	          	@if(property_exists($data[0],'sub_moto'))
                        <b style="color: #686868;">{{$data[0]->sub_moto}}</b>
                    @endif
                </span></b></a>-->
                <div style="line-height: 0.5;padding-top: 9px;"><p id="pmoto" class="logomoto letraextragrande" style="width:100%;margin: 0 !important;color:#31859C;font-family:Calibri,sans-serif;padding-top: 8px;"><b style="padding-bottom: 0px !important;">{{$data[0]->moto}}</b></p></div>
                <div style="width:100%;font-family:Calibri,sans-serif;">
                    @if(property_exists($data[0],'sub_moto'))
                        <b style="color: #686868;">{{$data[0]->sub_moto}}</b>
                    @endif
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
						<li class="hide-on-mobile"><a title="NOTIFICATIONS" data-toggle="popover" data-placement="bottom" data-content="" 
							class="popover-notifications"><img src="{{ URL::asset('img/bell.png') }}" class="img-navbar-menu"></a></li>
								<!--<li><a href="#"><i class="fas fa-bell" class="img-navbar-menu" style="color:#FFD700;"></i></a></li>-->
								<li class="hide-on-mobile"><a href="{{route('hoportunities')}}"><img src="{{ URL::asset('img/menu_3.jpg') }}" class="img-navbar-menu"></a></li>
								<li class="hide-on-mobile"><a href="{{route('relations_talento')}}"><img src="{{ URL::asset('img/menu_1.png') }}" class="img-navbar-menu"></a></li>
								<li class="hide-on-mobile"><a href="{{route('dash_chat')}}"><img src="{{ URL::asset('img/menu_2.png') }}" class="img-navbar-menu"></a></li>
								<!--<li><a href="#"><img src="briefcase.png" style="width: 28px;"></a></li>-->
								<li class="dropdown hide-on-mobile"><a data-toggle="dropdown" class="no-backgroundblackstrange link-hand"><img src="{{ URL::asset('img/menu_4.png') }}" class="img-navbar-menu"></a>
								<ul class="dropdown-menu">
										<li><a href="{{ route('account_settings') }}/invite-fb">Invite friends from Fb</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('account_settings') }}/global-settings">Settings</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('account_settings') }}/account-management">Account</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('account_settings') }}/help">Help</a></li>
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