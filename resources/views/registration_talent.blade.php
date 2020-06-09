@extends('templates.registration_base')

@section('title', 'Skauting - Register new Talent')

@section('content')

    <div style="width: 50%;margin-left: 25%;margin-right: 25%;">

    <h2 class="textocb18 letraextragrande" style="text-align: left !important; float: left; clear: both;"><b>Sign up as Talent</b></h2>
      <br><br>
      <br><br>
      <section class="cuadro-registration" style="padding-bottom: 5%;">

      <div id="fill_add_wrong_items"><!-- Empty container to add errors if exists --></div>

      {{ Form::open(array('action' => 'HomeController@registerUser', 'method' => 'POST' , 'files' => true , 'class' => 'form-horizontal')) }}

        <!--<form method="post" class="form-horizontal">-->

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="username">Username:</label>  
                <div class="col-md-6">
                <input id="username" name="username" type="text" placeholder="" class="form-control input-md" value="xx">
                  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="password">Password:</label>  
                <div class="col-md-6">
                <input id="password1" name="password1" type="password" placeholder="" class="form-control input-md" value="xx">
                  
                </div>
              </div>

              <p id="password_don_match_error" style="text-align: center; font-weight: bold; color: red;display: none;">Passwords do not match!</p>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="password2">Confirm Password:</label>  
                <div class="col-md-6">
                <input id="password2" name="password2" type="password" placeholder="" class="form-control input-md" value="xx">
                  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="name">Name:</label>  
                <div class="col-md-6">
                <input id="name" name="name" type="text" placeholder="" class="form-control input-md" value="xx">
                  
                </div>
              </div>

              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="gender">Gender</label>
                <div class="col-md-6">
                  <select id="gender" name="gender" class="form-control" style="background-color:#FAFAFA;">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        <option value="3">Other</option>
                  </select>
                </div>
              </div> 

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="yearofbirth">Year of birth:</label>  
                <div class="col-md-6">
                <input id="yearofbirth" name="yearofbirth" type="number" placeholder="" class="form-control input-md" style="background-color:#FAFAFA;" value="xx">
                  
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="country">Country:</label>  
                <div class="col-md-6">
                  <input id="country" name="country" type="text" placeholder="" class="form-control input-md ui-widget" style="background-color:#FAFAFA;">
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="state">State:</label>  
                <div class="col-md-6">
                  <input id="state" name="state" type="text" placeholder="" class="form-control input-md" style="background-color:#FAFAFA;">
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="city">City:</label>  
                <div class="col-md-6">
                  <input id="city" name="city" type="text" placeholder="" class="form-control input-md" style="background-color:#FAFAFA;">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="category">Category:</label>
                <div class="col-md-6">
                  <a id="category" name="category" class="btn btn-primary btn-block" style="height:32px;background-color:#FFF;border:1px solid #ccc;"><i class="fas fa-caret-down inner-carret"></i>
                  </a>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-6">
                  <div id="pcategoria" class="panel" style="border:1px solid #ccc;height:8rem;overflow-y:auto;overflow-x:hidden;">
                        <div class="row" style="margin-left:2%;">
                          <div class="col-md-4"><span style="font-size:0.6em;" class="checkcat"><input type="checkbox" class="category" name="categorieschk[]" value="music"/>Music</span></div>
                        </div>
                  </div>
                </div>
              </div>

              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="subcategory">Subcategory:</label>
                <div class="col-md-6">
                  <select id="subcategory" name="subcategory[]" multiple="multiple" style="width: 100%;">
                    <!--<option value="1">Option one</option>
                    <option value="2">Option two</option>-->
                  </select>
                </div>
              </div>

              <!-- Select Basic -->
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="level">Level:</label>
                <div class="col-md-6">
                    <select id="level" name="level" class="form-control">
                      <option value="amateur">Amateur</option>
                      <option value="professional">Professional</option>
                    </select>
                </div>
              </div>

              <!-- File Button --> 
              <div class="form-group">
                <label class="col-md-4 control-label textoc10" for="pic">Profile picture</label>
                <div class="col-md-4">
                  <input id="pic" name="pic" class="input-file" type="file">
                </div>
              </div>

              {{ Form::hidden('user_type', 'talent') }}

              <button type="submit" class="btn btn-primary btn-md center-block boton-azul"><b>Sign up</b></button>

          <!--</form>-->
          {{ Form::close() }}


      </section>

    <script type="text/javascript">
      $('.category').change(function(){
          $('.category:checkbox:checked').each(function () {
            $.ajax({
                url:"{{ URL::to('/api/getcategsxsubcategs') }}" + "?category=" + $(this).val(),
                type: "get",
                success: function(response) {
                  arreglo = eval(response);
                  $.each(arreglo, function (i,item) {
                      $('#subcategory').append($('<option>', { 
                          value: item._id,
                          text : item.name 
                      }));
                  });
                },
                error: function(xhr) {
                  //console.log(xhr);
                }
            });
          })
      });
    </script>

    <br><br>
    
    </div>

@endsection

@section('head')
      @parent
      <style type="text/css">
          .cuadro-registration {
            background: #FFF;
          }
      </style>
@endsection

@section('scripts')
    <script>
        var errors = [];
    </script>
    @parent
    {{ Html::script('js/customregisterscripts.js') }}
    {{ Html::script('js/customregisterscriptsxtalent.js') }}
@endsection