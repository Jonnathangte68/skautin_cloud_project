@extends('templates.base_recruiter')

@if(property_exists($data[0],'cabecera_title')) 
	@section('title', $data[0]->cabecera_title)
@endif

@section('content')

  	<h2 class="letraextragrande left-header"><b class="margin-conects-left">Connections</b></h2>

    <div class="row" style="padding-left: 1.5em;padding-right: 1.5em;">
      <div class="col-md-1"></div>

			      <div class="col-md-7 borderyseccion inner-div-content hmatch-large">

			      	@if($data[1]>0)
			      		@foreach($data[1] as $c)

			      		@if(!is_null($c))

				        <div class="row">
				          <div class="col-sm-1 col-md-1 col-lg-1">
				          	@if(property_exists($c,'profile_image'))
				          		<img src="{{$c->profile_image}}" class="img-navbar-menu">
				          	@endif
				          </div>
				          <div class="col-sm-8 col-md-8 col-lg-8">
				          	@if(property_exists($c,'name'))
				          		<p class="pnobottom">{{$c->name}}</p><p class="pnobottom">
				          	@endif
				          	@if(property_exists($c,'user_type'))
				          		@if($c->user_type=="t")
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
				          <div class="col-sm-1 col-md-1 col-lg-1"><a href="{{ route('remove_connection', ['id' => $c->_id]) }}">Remove Conection</a></div>
				          <div class="col-md-1"></div>
				        </div>

				    		@endif



			      		@endforeach

				    @else

				        <div class="row empty-line-conex">
				          <div class="col-sm-12 col-md-12 col-lg-12"><br><b>No Connections yet..</b></div>
				        </div>

			      	@endif




			      </div>


						<div class="col-md-4 screen-large">
			      <div style="border: 1px solid #E6E6E6;margin-right: 60px;background-color: #FFF;padding: 4% 4% 4% 4%;height:100%;" class="col-height">
			      	<div style="height:55vh;">
								<h2 class="letraextragrande" style="text-align: center;">Talents/Recruiters you might like to connect with</h2>
								<br><br>
			            <div id="rightsectiondata" class="container" style="max-height: 100%;height: 100%;max-width: 100%;overflow-y: auto;display: none;"></div>

				        <p id="emptymsg" style="text-align: center;display: none;">No suggestions...</p>

				        <!--<img src="img/tk-skeleton.gif">-->
				        <img id="default_data_image" src="img/tb-skeleton.gif">

			      	</div>
			        

			      </div>
			    </div>



      </div>

@endsection

@section('head')
		{!! Html::style('css/conextionsview.css') !!}
		<style type="text/css">
				.screen-large {
						height: 720px !important;
				}
				::-webkit-scrollbar {
					width: 8px;
				}
				
				::-webkit-scrollbar-track {
					-webkit-box-shadow: inset 0 0 4px rgba(0,0,0,0.3); 
					border-radius: 8px;
				}
				
				::-webkit-scrollbar-thumb {
					border-radius: 10px;
					background-color: rgba(0,0,0,0.3);
				}
				.titleOne {
						font-size: 2.1rem;
				}
				.titleSecond {
						font-size: 1.3rem;
						font-style: italic;
				}
		</style>
@endsection

@section('scripts')
		@parent
		<script type="text/javascript" src="../js/conexpendingsugg.js"></script>
@endsection