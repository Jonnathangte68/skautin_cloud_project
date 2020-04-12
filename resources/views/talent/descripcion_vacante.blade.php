@extends('templates.base_talent')

@if(property_exists($third_data,'title')) 
  @section('title', $third_data->title)
@endif

@section('head')

  <link rel="stylesheet" type="text/css" href="../css/descripcion_vacante.css">

@endsection

@section('content')

  <h2 class="textocb18 left-header">Talents</h2>

    <div class="row" style="padding-left: 1.5em;padding-right: 1.5em;">
      <br>
      <div class="col-md-1"></div>
      <div class="col-md-7" style="border: 1px solid #E6E6E6;height:400px;background-color: #FFF;">

        <!-- Section of the Video tag -->

        

        <!--<div style="width:15%;height:25%;background-color:red;">x</div>
        <div>Aqui</div>
        <div></div>-->

        <div class="row">
        	<div class="col-md-2">
        		<img src="{{ URL::asset('img/institutional_info_button.png') }}" class="img-circle img-vacant-description">
        	</div>
        	<div class="col-md-5">
            <input type="hidden" id="job_id" value="{{$third_data->_id}}">
        		<div class="col-md-12"><p class="letraextragrande pnobottom">{{$third_data->title}}</p></div>
        		<div class="col-md-12"><p class="letragrande pnobottom"></p></div>
        		<div class="col-md-12"><p class="letramedia pnobottom">{{$region}}</p></div>
        		<div class="col-md-12"><p class="letrachica pnobottom">{{\Carbon\Carbon::createFromTimestamp(strtotime($data[1]->Created_date))->diffForHumans()}}</p></div>
        	</div>

        	<div class="col-md-1">
        		
        	</div>
        	<div class="col-md-4">
        		<a id="btn_apply_to_vacant" class="btn btn-primary boton-azul"><b>Apply</b></a>
        		<a href="#" class="linklittlf"><img src="{{ URL::asset('img/goto.png') }}"></a>
        		<a href="#" class="linklittlf"><i class="fas fa-ellipsis-h"></i></a>
        	</div>
        </div>

        <div class="row rowxlk">
		  <div class="column leftxlk">
		    <h2>Job Description</h2>
        @if(property_exists($data[1],'description'))
          <p>{{ $data[1]->description }}</p>
        @else 
          <p>No description</p>
        @endif
		    <h2>Requirements</h2>
        @if(property_exists($data[1],'requirements'))
          <p>{{ $data[1]->requirements }}</p>
        @else 
          <p>No requirements</p>
        @endif
		  </div>
		  <div class="column middlexlk">
		    @if(array_key_exists('2', $data) && $data!=null)
          <p>{{!is_null($data[2]) ? $data[2]->name : ''}}</p>
        @endif
        
		    @if(array_key_exists('3', $data) && $data!=null)
          <p>{{!is_null($data[3]) ? $data[3]->name : ''}}</p>
        @endif
        @if(array_key_exists('4', $data) && $data!=null)
          <p>{{!is_null($data[4]) ? $data[4]->name : ''}}</p>
        @endif
        @if(array_key_exists('5', $data) && $data!=null)
          <p>{{!is_null($data[5]) ? $data[5]->name : ''}}</p>
        @endif
		    
		    
		  </div>
		</div>


      </div>
        <div class="col-md-4">
          <div style="border: 1px solid #E6E6E6;margin-right: 60px;height:400px;background-color: #FFF;">

            <h2 class="letraextragrande">&nbsp;&nbsp;&nbsp;Other jobs you might like</h2>
                 
            <div id="anexus_jobs" class="container-fluid">




              
            </div>

          </div>
        </div>
      </div>


@endsection

@section('scripts')

  @include('generalconfigfooter')
  <script type="text/javascript" src="../js/descripcion_vacante.js"></script>

@endsection