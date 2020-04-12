@extends('templates.dinamic_base')

@if(property_exists($data[0],'cabecera_title')) 
  @section('title', $data[0]->cabecera_title)
@endif

@section('navbar_nav')
    @if($data['usr_type']=='r')
        @include('navbars.recruiter_navbar')
    @else 
        @include('navbars.talent_navbar')
    @endif
@endsection

@section('content')

    <div class="row container-talent-profile">
      <br>
      <div class="col-md-1"></div>
      <div class="col-md-7 borderyseccion-1">

        <!-- Section of the Video tag -->

        <div class="row details-row">
          <div class="col-md-4">
            <div class="row left-info-talent">
              <div class="col-md-12 txtinnerusedetails"><p style="font-family:'Calibri';font-weight: bold;font-size:1.2em"><b>{{ $data['talent_name'] }}</b></p></div>
              <div class="col-md-12 txtinnerusedetails"><p>{{ $data['talent_address'] }}</p></div>
              <div class="col-md-12 txtinnerusedetails clickHandler" onclick="viewEntireProfile()"><p>...</p></div>
            </div>
          </div>
          <!-- Views, followers, connections, following -->
          <div class="col-md-1">
            <div class="row">
              <div class="col-md-12 txtinnerusedetails specialnumber">{{ $data['nbr_views'] }}</div>
              <div class="col-md-12 txtinnerusedetails subtitlemenuit">Views</div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="row">
              <div class="col-md-12 txtinnerusedetails specialnumber">{{ $data['nbr_followers'] }}</div>
              <div class="col-md-12 txtinnerusedetails subtitlemenuit">followers</div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="row">
              <div class="col-md-12 txtinnerusedetails specialnumber">{{ $data['nbr_connections'] }}</div>
              <div class="col-md-12 txtinnerusedetails subtitlemenuit">Connections</div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="row">
              <div class="col-md-12 txtinnerusedetails specialnumber">{{ $data['nbr_following'] }}</div>
              <div class="col-md-12 txtinnerusedetails subtitlemenuit">Following</div>
            </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="containermenuit right-content-info">
              @if($data['are_we_connected']!=='')
              <img id="conexButton" src="{{ URL::asset('img/menu_1_remove.png') }}" class="imagemenuit">
              @else
              <img id="conexButton" src="{{ URL::asset('img/menu_1.png') }}" class="imagemenuit">
              @endif
              <img id="oButton" src="{{ URL::asset('img/menu_2.png') }}" class="imagemenuit"><p id="followButton" class="pmenuit">Follow</p>
            </div>
          </div>
        </div>

        <!-- Video -->

        @if(!empty($data['video_list_details']))

          <video id="pvideo" width="90%" height="75%" 
              style="margin-left:5%;margin-top:2%;" controls autoplay="autoplay">
              @if(!empty($data['video_list_details']))
                  <source src="http://localhost:3002/gvideo/{{$data['video_list_details'][0]->url}}" type="video/mp4"> 
              @endif
              Your browser does not support the video tag.
          </video>

        @else

            <div style="width:100%;text-align:center;">
              <p class="center-text-middle-screen-no-video">This talent have not upload any video yet...</p>
            </div>

        @endif

      </div>
        <div class="col-md-4">
          <div class="borderyseccion-2">
            <h2 class="letraextragrande">&nbsp;&nbsp;&nbsp;Other videos from this talent</h2>
                 
            <div class="container-fluid">

            <!-- video individual de other videos -->
            @for ($i = 0; $i < count($data['video_list_details']); $i++)
                <div class="row intervideo">
                  <div class="col-md-4">
                    <div class="video_fondo">
                        <a id="{{$data['video_list_details'][$i]->url}}" class="vvideo video-rigth-align"><i class="fa fa-play-circle" 
                            style="margin-left:9rem;color:white;"></i></a>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <p>{{$data['video_list_details'][$i]->name}}</p>
                    <p>{{$data['video_list_details'][$i]->description}}</p>
                    <p>Views:</p>
                  </div>
                </div>
              @endfor

            </div>

          </div>
        </div>
      </div>


      <!-- Modal -->
      <div id="newVideo" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Upload new Video!</h4>
            </div>
            <div class="modal-body">

              <div class="container">
                



                {!! Form::open(['action' => 'VideoController@uploadVideo', 'files' => true]) !!}


                    <div class="row">
   
                      <div class="col-md-1"></div><div class="col-md-1"><label>Name</label></div><div class="col-md-2"><input id="name" name="name" type="text" placeholder="" class="form-control input-md"></div>

                    </div>

                    <div class="row elementtopseparation">
   
                      <div class="col-md-1"></div><div class="col-md-1"><label>Description</label></div><div class="col-md-2"><textarea class="form-control boxlitbig" id="description" name="description" placeholder="E.g: Short video to demonstrate my skills mastering soccer balls"></textarea></div>

                    </div>

                    <div class="row elementtopseparation">
   
                      <div class="col-md-1"></div><div class="col-md-1"><label>Video</label></div><div class="col-md-2"><input id="videosubmis" name="videosubmis" class="input-file" type="file"></div>

                    </div>

                    <div class="row elementtopseparation">
   
                      <div class="col-md-1"></div><div class="col-md-1"><label></label></div><div class="col-md-2"><button type="submit" class="btn btn-success">Send</button></div>

                    </div>

                    
                {!! Form::close() !!}






              </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>




      <!-- Modal -->
      <div id="talentDetails" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                @include("talent.form_talent_detail")
            </div>
            <div class="modal-footer" style="text-align:center;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>





      <script type="text/javascript">
          $('.vvideo').click(function() {
              //alert( this.id );
              // Ese es el id del video
              var id_video = this.id;
              var lnk_newVideo = 'http://localhost:3200/gvideo/'+id_video;
              $('#srcVideo').attr('src', lnk_newVideo);
              console.log('nuevo video enlace');
              console.log(lnk_newVideo);
              $("#pvideo")[0].load();
          });
      </script>

      <script type="text/javascript">
          function viewEntireProfile() {
              $('#talentDetails').modal("toggle");
          }
      </script>

      <script type="text/javascript">
      

            var txtNameField = {!! json_encode($data['talent_name']); !!};
            var txtAgeField = {!! json_encode($data['birth_year']); !!};
            var txtLocationField = {!! json_encode($data['talent_address']); !!};
            var txtCategorySubcategoryField = {!! json_encode($data['talent_csinfo']); !!};

            var educationList = {!! json_encode($data['talent_education']); !!};
            var experticeList = {!! json_encode($data['talent_expertice']); !!};
            var achivementList = {!! json_encode($data['talent_achivements']); !!};
            var awardsList = {!! json_encode($data['talent_awards']); !!};

            $('#txtName').text(txtNameField);
            $('#txtAge').text(txtAgeField);
            $('#txtLocation').text(txtLocationField);
            $('#txtCategory').text(txtCategorySubcategoryField);
            $('#imgProfile').attr('src', {!! json_encode($data['talent_profile_img']); !!});
            $('#txtLevelTalent').text({!! json_encode($data['talent_level']->name); !!});

            educationList.forEach(function(obj) {
                if($('#education_content').html()) {
                    $('#education_content').append("<br>");
                }
                $('#education_content').append(obj.name);
            });
            experticeList.forEach(function(obj) {
                if($('#experience_content').html()) {
                    $('#experience_content').append("<br>");
                }
                $('#experience_content').append(obj.name);
            });
            achivementList.forEach(function(obj) {
                if($('#certifications_content').html()) {
                    $('#certifications_content').append("<br>");
                }
                $('#certifications_content').append(obj.name);
            });
            awardsList.forEach(function(obj) {
                if($('#awards_content').html()) {
                    $('#awards_content').append("<br>");
                }
                $('#awards_content').append(obj.name);
            });

      
      </script>

      <script type="text/javascript">
            function toggleImageConnection() {
                console.log($("#conexButton").attr('src').split("/")[$("#conexButton").attr('src').split("/").length-1]);
                let baseWeb = 'http://localhost:8000/img/';
                if($("#conexButton").attr('src').split("/")[$("#conexButton").attr('src').split("/").length-1]==="menu_1.png") {
                  $("#conexButton").attr('src', baseWeb+'menu_1_remove.png');
                }else {
                  $("#conexButton").attr('src', baseWeb+'menu_1.png');                  
                }
            }
            $('#conexButton').click(function() {
              const urlParams = new URLSearchParams(window.location.search);
              const myParam = urlParams.get('qMby');
              $.ajax({
                  method: "POST",
                  url: "/connectUsers",
                  data: { right: myParam }
                })
                  .done(function( msg ) {
                    console.log(msg);
                    toggleImageConnection();
                    $("#conexButton").attr('title', 'Connection request sent!').tooltip('fixTitle').tooltip('show');
                  });
            });

            $('#followButton').click(function() {
                $.ajax({
                  method: "POST",
                  url: "/add_follow_new",
                  data: { id_to_follow: $data['talent_id'] }
                })
                  .done(function( msg ) {

                  });
            });
            
      </script>

@endsection

@section('head')
          <style type="text/css">
              .container-talent-profile {
                  padding-left: 1.5em;
                  padding-right: 1.5em;
                  margin-top: 57px;
              }
              .borderyseccion-1 {
                  height: 720px !important;
                  padding: 1%;
                  border: 1px solid #E6E6E6;
                  background-color: #FFF;
              }
              .borderyseccion-2 {
                  border: 1px solid #E6E6E6;
                  margin-right: 60px;
                  background-color: #FFF;
                  height: 720px !important;
                  padding: 1%;
              }
              .btn-bottom-add-new-video {
                  position: absolute;
                  bottom: 30px;
                  right: 15%;
              }
              .left-info-talent {
                  padding-left: 16%;
              }
              .right-content-info {
                  padding-right: 28%;
                  text-align: right;
              }
              .center-text-middle-screen-no-video {
                  width: 100%;
                  min-height: 100%;
                  /* vertical-align: middle; */
                  padding-top: 25%;
                  text-align: center;
              }
              .clickHandler {
                  cursor: pointer;
              }
              .imagemenuit, .pmenuit {
                  display: inline;
                  width: 3.8rem;
                  height: 3rem;
                  padding: 3px;
                  cursor: pointer;
              }
          </style>
@endsection