@extends('templates.base_talent')

@section('content')


  <h2 class="textocb18 left-header margin-profile-left">Talents</h2>

    <div class="row" style="padding-left: 1.5em;padding-right: 1.5em;">
      <br>
      <div class="col-md-1"></div>
      <div class="col-md-7" style="border: 1px solid #E6E6E6;height:700px;background-color: #FFF;">
        <div class="row details-row">
          <div class="col-md-1"></div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 txtinnerusedetails"><p style="font-family:'Calibri';font-weight: bold;font-size:1.2em"><b>
                  {{ $data['user_data']->name }}
              </b></p></div>
              <div class="col-md-12 txtinnerusedetails"><p>City, State, Country</p></div>
              <div class="col-md-12 txtinnerusedetails">
                <p class="cursor-hand" data-toggle="tooltip" data-placement="top" 
                    title="Incomplete profile!" onclick="showFullProfileInfo()">
                  ...
                </p>
              </div>
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
          <div class="col-md-1"></div>
          <div class="col-md-2"></div>
        </div>
        <video id="pvideo" width="90%" height="75%" 
            style="margin-left:5%;margin-top:2%;" controls autoplay="autoplay">
            @if(!empty($data['video_list_details']))
                <source src="http://localhost:3002/gvideo/{{$data['video_list_details'][0]->url}}" type="video/mp4"> 
            @endif
            Your browser does not support the video tag.
        </video>


      </div>
        <div class="col-md-4">
          <div style="border: 1px solid #E6E6E6;margin-right: 60px;height:700px;background-color: #FFF;">

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

              <a data-toggle="modal" data-target="#newVideo" class="add-video-bottom">Add new video +</a>
            </div>

          </div>
        </div>
      </div>
      <div id="newVideo" class="modal fade" role="dialog">
        <div class="modal-dialog">
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
                      <div class="col-md-1"></div><div class="col-md-1"><label>Source</label></div><div class="col-md-2"><input id="videosubmis" name="videosubmis" class="input-file" type="file"></div>
                    </div>
                {!! Form::close() !!}
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Send</button>
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
                <div id="modal_details_talent" class="full-modal-window">
                    @include("talent.form_talent_detail_add")
                </div>
                <div id="edit_main_details_x" class="full-modal-window hidden-modal">
                          <br><br>
                          <div class="container full-form">
                          <h4>Current Education</h4>
                          <table class="table-without-border">
                              <thead></thead>
                              <tbody class="table-without-border">
                                <tr class="table-without-border">
                                  <td>Bachelors Degree</td>
                                  <td><i class="glyphicon glyphicon-trash"></i></td>
                                </tr>
                              </tbody>
                          </table>
                          <br>
                          <h4>Add new Education/Degree</h4>
                          <form class="form-horizontal">
                            <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="name_educ">Name</label>  
                                <div class="col-md-6">
                                <input id="name_educ" name="name_educ" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="year_educ">Ending Year:</label>  
                                <div class="col-md-6">
                                <input id="year_educ" name="year_educ" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label" for="description_educ">Description:</label>  
                                <div class="col-md-6">
                                <textarea rows="4" cols="50" class="form-control"></textarea>
                                  
                                </div>
                              </div>

                              <!-- Select Basic -->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="type_educ">Type:</label>
                                <div class="col-md-6">
                                  <select id="type_educ" name="type_educ" class="form-control">
                                  </select>
                                </div>
                              </div>

                              
                          </form>
                          </div>
                </div>
                <div id="add_expertice_info" class="full-modal-window hidden-modal">
                      <div class="container full-form">
                          <h4>Current Experience</h4>
                          <table class="table-without-border">
                              <thead></thead>
                              <tbody class="table-without-border">
                                <tr class="table-without-border">
                                  <td>Bachelors Degree</td>
                                  <td><i class="glyphicon glyphicon-trash"></i></td>
                                </tr>
                              </tbody>
                          </table>
                          <br>
                          <h4>Add new Experience</h4>
                          <form class="form-horizontal">
                            <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="name_work">Name</label>  
                                <div class="col-md-6">
                                <input id="name_work" name="name_work" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label" for="year_work">Begin Year:</label>  
                                <div class="col-md-6">
                                <input id="year_work_begin" name="year_work_begin" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="year_work">Ending Year:</label>  
                                <div class="col-md-6">
                                <input id="year_work" name="year_work" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label" for="description_work">Description:</label>  
                                <div class="col-md-6">
                                <textarea rows="4" cols="50" class="form-control"></textarea>
                                  
                                </div>
                              </div>
                              
                          </form>
                          </div>
                </div>
                <div id="add_awards_info" class="full-modal-window hidden-modal">
                      <div class="container full-form">
                          <h4>Current Awards</h4>
                          <table class="table-without-border">
                              <thead></thead>
                              <tbody class="table-without-border">
                                <tr class="table-without-border">
                                  <td>Bachelors Degree</td>
                                  <td><i class="glyphicon glyphicon-trash"></i></td>
                                </tr>
                              </tbody>
                          </table>
                          <br>
                          <h4>Add new Award</h4>
                          <form class="form-horizontal">
                            <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="name_award">Name</label>  
                                <div class="col-md-6">
                                <input id="name_award" name="name_award" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label" for="description_award">Description:</label>  
                                <div class="col-md-6">
                                <textarea rows="4" cols="50" class="form-control"></textarea>
                                  
                                </div>
                              </div>
                              
                          </form>
                          </div>
                </div>
                <div id="add_certifications_info" class="full-modal-window hidden-modal">
                <div class="container full-form">
                          <h4>Current Certifications</h4>
                          <table class="table-without-border">
                              <thead></thead>
                              <tbody class="table-without-border">
                                <tr class="table-without-border">
                                  <td>Bachelors Degree</td>
                                  <td><i class="glyphicon glyphicon-trash"></i></td>
                                </tr>
                              </tbody>
                          </table>
                          <br>
                          <h4>Add new Certification</h4>
                          <form class="form-horizontal">
                            <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="name_certif">Name</label>  
                                <div class="col-md-6">
                                <input id="name_certif" name="name_certif" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="col-md-4 control-label" for="year_certif">Ending Year:</label>  
                                <div class="col-md-6">
                                <input id="year_certif" name="year_certif" type="text" placeholder="" class="form-control input-md">
                                  
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-md-4 control-label" for="description_certif">Description:</label>  
                                <div class="col-md-6">
                                <textarea rows="4" cols="50" class="form-control"></textarea>
                                  
                                </div>
                              </div>
                              
                          </form>
                          </div>
                </div>
            </div>
            <div class="modal-footer" style="text-align:center;">
              <button id="buttons_normal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <div id="buttons_other" class="row hidden-modal">
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                  <button type="button" class="btn btn-primary">Add</button>
                </div>
                <div class="col-sm-2">
                  <button id="close_secondary" type="button" class="btn btn-default">Close</button>
                </div>
                <div class="col-sm-4"></div>
              </div>
            </div>
          </div>

        </div>
      </div>





      <script type="text/javascript">
            $(document).ready(function() {
              $('.cursor-hand').tooltip({placement: 'left', trigger: 'manual'}).tooltip('show');
            });
            $('.vvideo').click(function() {
                var id_video = this.id;
                var lnk_newVideo = 'http://localhost:3200/gvideo/'+id_video;
                $('#srcVideo').attr('src', lnk_newVideo);
                $("#pvideo")[0].load();
            });
            function showFullProfileInfo() {
              $('.cursor-hand').tooltip('destroy');
              $('#modal_details_talent').show();
              $('#buttons_normal').show();
              $('#buttons_other').hide();
              $('#edit_main_details_x').hide();
              $('#talentDetails').modal('toggle');
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
    $('#user_main_details_edit').click(function() {
      window.location = '/edit-account';
    });
    $('#user_education_edit').click(function() {
      $('#modal_details_talent').hide();
      $('#add_expertice_info').hide();
      $('#add_awards_info').hide();
      $('#add_certifications_info').hide();
      $('#edit_main_details_x').show();
      $('#buttons_normal').hide();
      $('#buttons_other').show();
    });
    $('#user_level_edit').click(function() {
      window.location = '/edit-account';
    });
    $('#user_experience_edit').click(function() {
      $('#modal_details_talent').hide();
      $('#edit_main_details_x').hide();
      $('#add_awards_info').hide();
      $('#add_certifications_info').hide();
      $('#add_expertice_info').show();
      $('#buttons_normal').hide();
      $('#buttons_other').show();
    });
    $('#user_awards_edit').click(function() {
      $('#modal_details_talent').hide();
      $('#edit_main_details_x').hide();
      $('#add_expertice_info').hide();
      $('#add_certifications_info').hide();
      $('#add_awards_info').show();
      $('#buttons_normal').hide();
      $('#buttons_other').show();
    });
    $('#user_certifications_edit').click(function() {
      $('#modal_details_talent').hide();
      $('#edit_main_details_x').hide();
      $('#add_expertice_info').hide();
      $('#add_awards_info').hide();
      $('#add_certifications_info').show();
      $('#buttons_normal').hide();
      $('#buttons_other').show();
    });
    $('#close_secondary').click(function() {
      $('#modal_details_talent').show();
      $('#edit_main_details_x').hide();
      $('#add_certifications_info').hide();
      $('#add_expertice_info').hide();
      $('#add_awards_info').hide();
      $('#buttons_normal').show();
      $('#buttons_other').hide();
    });
  </script>

@endsection

@section('head')
    @parent
    
    <style type="text/css">
        .add-video-bottom {
          position: absolute;
          bottom: 15px;
          right: 15%;
          z-index: 100;
        }
        .video-rigth-align {
          float: right;
          margin-right: 10px;
        }
        .cursor-hand {
          cursor: pointer;
        }
        .add-right {
          float: right;
          clear: both;
        }
        .full-modal-window {
          width: 100%;
          height: 100%;
        }
        .hidden-modal {
          display: none;
        }
        .full-form {
            width: 100%;
        }
        .table-without-border {
          width: 100%;
          border: 0px solid #FFF;
        }
    </style>
@endsection