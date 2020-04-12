@extends('templates.base_talent')

@if(property_exists($data[0],'cabecera_title')) 
	@section('title', $data[0]->cabecera_title)
@endif

@section('head')
    <style type="text/css">
    	
		.margin-conects-left {
			margin-left: 0px !important;
		}
    	.match_hl {
    		min-height: 100% !important;
    		height: 100%;
    	}
		.col-height {
			height: 100%;
			min-height: 100%;
		}
		.screen-large {
			height: 720px !important;
		}
		.borderyseccion {
			margin-left: 6% !important;
		}
		.cursor-hand {
			cursor: pointer;
		}


    </style>
@endsection

@section('content')

  	<h2 class="letraextragrande left-header"><b class="margin-conects-left">Connections</b></h2>

    <div class="row" style="padding-left: 1.5em;padding-right: 1.5em;">

			      <div class="col-md-8 screen-large">
					  <div class="borderyseccion inner-div-content col-height">

						  <div style="">
							  @if(count($data[1])>0)
								  @foreach($data[1] as $c)
									  @if(!is_null($c->message))

										  <div class="row">
											  <div class="col-sm-1 col-md-1 col-lg-1">
												  @if(property_exists($c->message,'profile_image'))
													  <img src="{{$c->message->profile_image}}" class="img-circle rond" onerror="this.onerror=null;this.src='img/img_avatar.png';">
												  @endif
												  @if(property_exists($c->message,'profile_img'))
													  <img src="{{$c->message->profile_img}}" class="img-circle rond" onerror="this.onerror=null;this.src='img/img_avatar.png';">
												  @endif
											  </div>
											  <div class="col-sm-8 col-md-8 col-lg-8">
												  @if(property_exists($c->message,'name'))
													  <p class="pnobottom">{{$c->message->name}}</p><p class="pnobottom">
														  @endif
														  @if(property_exists($c->message,'user_type'))
															  @if($c->message->user_type=="t")
																  T
															  @else
																  C
															  @endif
															  Cate
														  @endif
													  </p></div>
											  <div class="col-sm-1 col-md-1 col-lg-1">
												  <img src="{{URL::asset('/img/menu_2.png')}}" class="img-circle rond">
											  </div>
											  <div class="col-sm-1 col-md-1 col-lg-1"><a href="{{ route('remove_connection', ['id' => $c->message->_id]) }}">Remove Conection</a></div>
											  <div class="col-md-1"></div>
										  </div>
									  @endif
								  @endforeach
							  @else
								  <p style="text-align: center;">No data available!</p>
							  @endif
						  </div>

					  </div>
			      </div>


			    <div class="col-md-4 screen-large">
			      <div style="border: 1px solid #E6E6E6;margin-right: 60px;background-color: #FFF;padding: 4% 4% 4% 4%;" class="col-height">
			      	<div style="height:55vh;">
			      		<h2 class="letraextragrande" style="text-align: center;">Talents/Recruiters you might like to connect with</h2>
			            <div id="rightsectiondata" class="container" style="max-height: 100%;height: 100%;max-width: 100%;overflow-y: auto;display: none;"></div>
				        <p id="emptymsg" style="text-align: center;display: none;">No suggestions...</p>
				        <img id="default_data_image" src="img/tb-skeleton.gif">
			      	</div>
			      </div>
			    </div>
      </div>

@endsection

@section('scripts')

  @include('generalconfigfooter')
  <script type="text/javascript" src="../js/connections.js"></script>

@endsection