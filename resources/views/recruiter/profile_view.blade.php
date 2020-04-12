@extends('templates.base_recruiter')

@if(property_exists($data[0],'cabecera_title')) 
  @section('title', $data[0]->cabecera_title)
@endif

@section('content')

<div class="row" style="padding-left: 1.5em;padding-right: 1.5em;">
      
      <div class="col-md-1"></div>
      <div class="col-md-7" style="border: 1px solid #E6E6E6;height:400px;background-color: #FFF;">

        <div class="row up-separated-tiny">
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div style="width:12rem;height:12rem;background-color:blue;"></div>
          </div>
          <div class="col-md-3">
            <p class="letragrande">Texto 1</p>
            <p class="letramedia">Texto 2</p>
            <p class="letrachica">Texto 3</p>
          </div>
          <div class="col-md-5">
              <a href="#" class="btn btn-default btn-inside-rec-profile"><b>Connect</b></a>
              <a href="#" class="btn btn-primary btn-inside-rec-profile"><b>Follow</b></a>
          </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
              <h2 class="title-notebook-content">About Recruiter</h2>
              <p class="notebook-line">llenar</p>
            </div>
            <div class="col-md-6"></div>          
        </div>

      </div>
      <div class="col-md-4">
        <div style="border: 1px solid #E6E6E6;margin-right: 60px;height:400px;background-color: #FFF;">

          <h2 class="letraextragrande">&nbsp;&nbsp;&nbsp;Jobs from this recruiter</h2>
               
          <div class="container-fluid">
            
          </div>

        </div>
      </div>
</div>


@endsection
