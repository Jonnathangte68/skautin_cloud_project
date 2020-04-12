@extends('templates.base_talent')

@section('title', 'Skauting discover')

@section('content')


  <h2 class="textocb18" style="margin-top: 24px;margin-left: 120px;">Talents</h2>

    <div class="row" style="padding-left: 1.5em;padding-right: 1.5em;">
      <br>
          <div class="col-md-2"></div>
          <div class="col-md-8" style="border: 1px solid #E6E6E6;height:400px;background-color: #FFF;">

            {!! Form::open(['action' => 'VideoController@uploadVideo', 'files' => true]) !!}
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="name">Video Name</label>  
                  <div class="col-md-6">
                  <input id="name" name="name" type="text" placeholder="" class="form-control input-md">
                    
                  </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="description">Description</label>
                  <div class="col-md-8">                     
                    <textarea class="form-control" id="description" name="description">E.g: Short video to demonstrate my skills mastering soccer balls</textarea>
                  </div>
                </div>

                <!-- File Button --> 
                <div class="form-group">
                  <label class="col-md-4 control-label" for="videosubmis">Video</label>
                  <div class="col-md-4">
                    <input id="videosubmis" name="videosubmis" class="input-file" type="file">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Send</button>
                  </div>
                </div>

                
            {!! Form::close() !!}

          </div>
      </div>



@endsection