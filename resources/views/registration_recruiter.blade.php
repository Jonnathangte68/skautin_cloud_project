@extends('templates.registration_base')

@section('title', 'Skauting - Register new Recruiter')

@section('content')

<div style="width: 50%;margin-left: 25%;margin-right: 25%;">

<h2 class="textocb18 letraextragrande" style="text-align: left !important; float: left; clear: both;"><b>Sign up as Recruiter</b></h2>
  <br><br>
  <br><br>
    

<section class="cuadro-registration" style="padding-bottom: 5%;">

  <div class="sel-info">
      <p id="firstoptrecruiter" class="letragrande selected-bold">Recruiter Info</p>
      <p class="selected-bold">|</p>
      <p id="secondoptrecruiter" class="letragrande">Other Info</p>
  </div>

  <div id="fill_add_wrong_items"><!-- Empty container to add errors if exists --></div>

{{ Form::open(array('action' => 'HomeController@registerUser', 'method' => 'POST' , 'files' => true , 'class' => 'form-horizontal')) }}


<div class="step_one" style="width:100%;">
        <div id="frmusername" class="form-group">
          <label class="col-md-4 control-label textoc10" for="username">Username:</label>  
          <div class="col-md-6">
          <input id="username" name="username" type="text" placeholder="" class="form-control input-md" >
            
          </div>
        </div>

        <div id="frmpassword" class="form-group">
          <label class="col-md-4 control-label textoc10" for="password">Password:</label>  
          <div class="col-md-6">
          <input id="password1" name="password1" type="password" placeholder="" class="form-control input-md">
            
          </div>
        </div>

        <div id="frmpassword2" class="form-group">
          <label class="col-md-4 control-label textoc10" for="password2">Confirm Password:</label>  
          <div class="col-md-6">
          <input id="password2" name="password2" type="password" placeholder="" class="form-control input-md">
            
          </div>
        </div>


        <div id="frmname" class="form-group">
          <label class="col-md-4 control-label textoc10" for="name">Name:</label>  
          <div class="col-md-6">
          <input id="name" name="name" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>

        
        <div id="frmgender" class="form-group">
          <label class="col-md-4 control-label textoc10" for="gender">Gender</label>
          <div class="col-md-6">
            <select id="gender" name="gender" class="form-control" style="background-color:#FAFAFA;">
              <option value="1">Male</option>
              <option value="2">Female</option>
              <option value="3">Other</option>
            </select>
          </div>
        </div> 

        
        <div id="frmyearofbirth" class="form-group">
          <label class="col-md-4 control-label textoc10" for="yearofbirth">Year of birth:</label>  
          <div class="col-md-6">
          <input id="yearofbirth" name="yearofbirth" type="number" placeholder="" class="form-control input-md" style="background-color:#FAFAFA;">
            
          </div>
        </div>

        
        <div id="frmcountry" class="form-group">
          <label class="col-md-4 control-label textoc10" for="country">Country:</label>  
          <div class="col-md-6">
          <input id="country" name="country" type="text" placeholder="" class="form-control input-md" style="background-color:#FAFAFA;">
            
          </div>
        </div>

        
        <div id="frmstate" class="form-group">
          <label class="col-md-4 control-label textoc10" for="state">State:</label>  
          <div class="col-md-6">
          <input id="state" name="state" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>


        <div id="frmcity" class="form-group">
          <label class="col-md-4 control-label textoc10" for="city">City:</label>  
          <div class="col-md-6">
            <input id="city" name="city" type="text" placeholder="" class="form-control input-md" style="background-color:#FAFAFA;">
          </div>
        </div>

        
        <div id="frmrtype" class="form-group">
          <label class="col-md-4 control-label textoc10" for="rtype">Recruiter Type:</label>
          <div class="col-md-6">
            <select id="rtype" name="rtype" class="form-control">
              <option value="0">Please, select one...</option>
              <option value="1">Institutional</option>
              <option value="2">Individual</option>
            </select>
          </div>
        </div>

          
        <div id="frmpic" class="form-group">
          <label class="col-md-4 control-label textoc10" for="pic">Profile picture</label>
          <div class="col-md-4">
            <input id="pic" name="pic" class="input-file" type="file">
          </div>
        </div>

        <div id="frmorganization" class="form-group">
          <label class="col-md-4 control-label textoc10" for="organization">Organization:</label>  
          <div class="col-md-6">
          <input id="organization" name="organization" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>


        <div id="frmwebsite" class="form-group">
          <label class="col-md-4 control-label textoc10" for="website">Website:</label>  
          <div class="col-md-6">
          <input id="website" name="website" type="text" placeholder="" class="form-control input-md" >
            
          </div>
        </div>


        <div id="frmorganization_phone" class="form-group">
          <label class="col-md-4 control-label textoc10" for="organization_phone">Phone Number:</label>  
          <div class="col-md-6">
          <input id="organization_phone" name="organization_phone" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>
</div>


<div class="step_two" style="width:100%;">
  <div class="form-group" id="frmcategory">
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
    <div class="form-group" id="frmsubcategory">
      <label class="col-md-4 control-label textoc10" for="subcategory">Subcategory:</label>
      <div class="col-md-6">
        <select id="subcategory" name="subcategory[]" multiple="multiple" style="width: 100%;">
          <!--<option value="1">Option one</option>
          <option value="2">Option two</option>-->
        </select>
      </div>
    </div>

  
    <div id="frminterestage" class="form-group">
      <label class="col-md-4 control-label textoc10" for="interestage">Age</label>
      <div class="col-md-4">
      <div class="checkbox">
        <label for="ages-0">
          <input type="checkbox" name="ages[]" id="ages-0" value="1">
          13 - 19
        </label>
      </div>
      <div class="checkbox">
        <label for="ages-1">
          <input type="checkbox" name="ages[]" id="ages-1" value="2">
          20 - 29
        </label>
      </div>
      <div class="checkbox">
        <label for="ages-2">
          <input type="checkbox" name="ages[]" id="ages-2" value="3">
          30 - 39
        </label>
      </div>
      <div class="checkbox">
        <label for="ages-3">
          <input type="checkbox" name="ages[]" id="ages-3" value="4">
          40+
        </label>
      </div>
      </div>
    </div>

    <div id="frminterestgender" class="form-group">
      <div class="col-md-2"></div>
      <label class="col-md-2 control-label textoc10" for="interestgender">Gender</label>
      <div class="col-md-6">
        <label class="checkbox-inline" for="interestgender-0">
          <input type="checkbox" name="interestgender[]" id="interestgender-0" value="1">
          Male
        </label>
        <label class="checkbox-inline" for="interestgender-1">
          <input type="checkbox" name="interestgender[]" id="interestgender-1" value="2">
          Female
        </label>
        <label class="checkbox-inline" for="interestgender-2">
          <input type="checkbox" name="interestgender[]" id="interestgender-2" value="3">
          Other
        </label>
      </div>
    </div>

    <div id="frminterestlevel" class="form-group">
      <label class="col-md-4 control-label textoc10" for="level">Level:</label>
      <div class="col-md-6">
          <select id="levels" name="levels[]" class="form-control" multiple>
            <option value="beginner">Beginner</option>
            <option value="intermediate">Intermediate</option>
            <option value="senior">Senior</option>
          </select>
      </div>
    </div>
</div>


        {{ Form::hidden('user_type', 'recruiter') }}
        {{ Form::hidden('countrykey', '') }}
        {{ Form::hidden('statekey', '') }}
        {{ Form::hidden('citykey', '') }}


        <button type="submit" class="btn btn-primary btn-md center-block boton-azul"><b>Sign up</b></button>

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
  <br><br>

</div>
@endsection

@section('head')
      @parent
      <style type="text/css">
          #secondoptrecruiter {
              cursor: pointer;
          }
          #firstoptrecruiter {
              cursor: pointer;
          }
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
    {{ Html::script('js/customregisterscriptsxrec.js') }}
@endsection