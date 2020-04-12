@extends('templates.base_talent')

@if(property_exists($data[0],'cabecera_title')) 
    @section('title', $data[0]->cabecera_title)
@endif

@section('content')

    <div class="row">
      <div class="col-md-4 .col-sm-1 .col-1"></div>
      <div class="col-md-4 .col-sm-10 .col-10 box-detopciones">

              <form id="edit_password" class="form-horizontal" style="display: none;">

                  <legend><a id="toggle_password_visibility"><i class="fas fa-arrow-circle-left" style="color:black;font-size: 35px;"></i></a><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Change Password</span></legend>
                  <!-- Text input-->


                  <div id="alert_boxes" style="text-align: center;display: none;">
                      <p id="password_change_error_msg_1" style="color: green;display: none;font-weight: bold;">Password successfully changed!</p>
                      <p id="password_change_error_msg_2" style="color: red;display: none;font-weight: bold;">Passwords do not match!</p>
                      <p id="password_change_error_msg_3" style="color: red;display: none;font-weight: bold;">Wrong password!</p>
                      <br>
                  </div>


                  <div class="form-group">
                      <label class="col-md-5 control-label" for="old_password">Old Password</label>
                      <div class="col-md-4">
                          <input id="old_password" name="old_password" type="text" placeholder="" class="form-control input-md">

                      </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                      <label class="col-md-5 control-label" for="new_password">New Password</label>
                      <div class="col-md-4">
                          <input id="new_password" name="new_password" type="text" placeholder="" class="form-control input-md">

                      </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                      <label class="col-md-5 control-label" for="new_password_repeat">New Password (Repeat)</label>
                      <div class="col-md-4">
                          <input id="new_password_repeat" name="new_password_repeat" type="text" placeholder="" class="form-control input-md">

                      </div>
                  </div>

                  <br><div style="width: 100%;text-align: center;"><button id="change_pass" class="btn btn-primary">CHANGE</button></div>
              </form>
            <form id="normal_user_edition_form" class="form-horizontal">
            <fieldset>

            <!-- Form Name -->
            <legend><a href="/account-configuration-settings/account-management"><i class="fas fa-arrow-circle-left" style="color:black;font-size: 35px;"></i></a><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit User Account!</span></legend>
                <div class="row">
                    <div class="col-md-4"><a href="#" class="btn btn-primary" style="width: 100%;font-weight: bold;">View Public Profile</a></div>
                    <div class="col-md-4"><a id="change_usr_pass" class="btn btn-success" style="width: 100%;font-weight: bold;">Change password</a></div>
                    <div class="col-md-4"><a id="modify_interest_list" class="btn btn-success" style="width: 100%;font-weight: bold;">Add / Edit  Interest</a></div>
                </div>
                <br>

                @include('recruiter.form')

            </fieldset>

                <br><br>
                <div style="width: 100%;text-align: center;"><button id="save_user_changes" class="btn btn-primary">SAVE</button></div>
            </form>

            <form id="edit_rec_interest" class="form-horizontal" style="display: none !important;">
                    @include('recruiter.interestform')
                </form>
      </div>
      <div class="col-md-4 .col-sm-1 .col-1"></div>
    </div>

@endsection

@section('head')
    <style type="text/css">
        .box-detopciones {
            margin-bottom: 5% !important;
            padding-bottom: 2% !important;
            background-color: #FFFFFF;
        }
        legend {
            padding: 15px;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">

        $(document).ready(function() {
            $('#pcategoria').hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        var userObj = <?php echo json_encode($data['userdata']); ?>;
        var subCategories = <?php echo json_encode($data['sub_ctgs']); ?>;
        var usrAddress = <?php echo json_encode($data['address']); ?>;
        //console.log(usrAddress);
        //console.log("Print address...");
        //console.log(usrAddress);
        $("#name").val(userObj.name);
        $("#gender").val(userObj.gender);
        $("#yearofbirth").val(userObj.birth_year);
        if (usrAddress) {
            $("#country").val(usrAddress.country);
            $("#state").val(usrAddress.state);
            $("#city").val(usrAddress.city);
        }
        $("#level").val(userObj.level);

        var imgp = String("<?= $data['userdata']->profile_image; ?>");
        $('#prvw_image').attr('src', imgp);
        userObj.category.forEach(function(ct) {
            $(':checkbox[value="'+ct+'"]').trigger('click');
            subCategories.forEach(function(sc) {
                if (sc.category==ct)
                    $('#subcategory').append("<option value='"+sc._id+"'>"+sc.name+"</option>");
            });
        });


        $(':checkbox[class="category"]').change(function() {
            $('#subcategory').empty();
            for (var i = 0, len = $(':checkbox[class="category"]').length; i < len; i++) {
                subCategories.forEach(function(sc) {
                    if ($($(':checkbox[class="category"]')[i]).is(":checked")){
                        if (sc.category==$(':checkbox[class="category"]')[i].value)
                            $('#subcategory').append("<option value='"+sc._id+"'>"+sc.name+"</option>");
                    }
                });
            }
        });

        $("#save_user_changes").click(function() {
            $.ajax({
                method: "POST",
                url: "{{route('post_edition_talent')}}",
                data: { _id: userObj._id, country: $("#country").val(), state: $("#state").val(), city: $("#city").val(), gender: $("#gender").val(), yearofbirth: $('#yearofbirth').val(), level: $("#level").val(), name: $("#name").val() },
                dataType: 'json'
            })
                .done(function( msg ) {
                    console.log("Store data");
                    console.log(msg);
                });

                var input = document.getElementById("pic");
                console.log(input);
                file = input.files[0];
                if(file != undefined){
                    formData= new FormData();
                    if(!!file.type.match(/image.*/)){
                        formData.append("image", file);
                        console.log(file);
                        $.ajax({
                            url: "/changeTalentProfileImg",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data){
                                alert("Img uploaded!");
                            }
                        });
                    }else{
                    }
                }else{
                }

        });

        $('#change_usr_pass').click(function() {
             $('#normal_user_edition_form').toggle('display');
             $('#edit_password').toggle('display');
        });

        $('#toggle_password_visibility').click(function () {
            $('#normal_user_edition_form').toggle('display');
            $('#edit_password').toggle('display');
        });
        
        $('#category').click(function () {
            $('#pcategoria').toggle('display');
        })

        $('#normal_user_edition_form').submit(function(e) {
            e.preventDefault();
            // Implements validation logic...

        });

        $('#edit_password').submit(function(e) {
            e.preventDefault();
            // Implements validation logic...

        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#prvw_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#pic").change(function() {
            readURL(this);
        });

        $('#change_pass').click(function() {
            if ($('#new_password').val()==$('#new_password_repeat').val()) {
                $.ajax({
                    method: "POST",
                    url: "{{route('update_change_password_talent')}}",
                    data: { oldPass: $('#old_password').val(), newPass: $('#new_password').val() },
                    dataType: 'json'
                })
                    .done(function( msg ) {
                        if (msg) {

                            console.log(msg);
                            console.log("Aqui fin de llamada");

                            if (msg.status == 0 && msg.message == "wrong password") {
                                $('#password_change_error_msg_3').show();
                                $('#alert_boxes').show();
                                setTimeout(function() {$('#password_change_error_msg_3').hide();$('#alert_boxes').hide();},5000);
                            }else {
                                $('#password_change_error_msg_1').show();
                                $('#alert_boxes').show();
                                setTimeout(function() {$('#password_change_error_msg_1').hide();$('#alert_boxes').hide();},5000);
                            }
                        }
                    });
            }else {
                $('#password_change_error_msg_2').show();
                $('#alert_boxes').show();
                setTimeout(function() {$('#password_change_error_msg_2').hide();$('#alert_boxes').hide();},5000);
            }
        });




    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                if($('#rtype').val()=="1") {
                    $("#frmorganization").show();
                    $("#frmwebsite").show();
                    $("#frmorganization_phone").show();
                }else {
                    $("#frmorganization").hide();
                    $("#frmwebsite").hide();
                    $("#frmorganization_phone").hide();
                }
            },150);
        });
    </script>

    <script type="text/javascript">
        $("#rtype").click(function() {
            if($('#rtype').val()=="1") {
                $("#frmorganization").show();
                $("#frmwebsite").show();
                $("#frmorganization_phone").show();
            }else {
                $("#frmorganization").hide();
                $("#frmwebsite").hide();
                $("#frmorganization_phone").hide();
            }
        });
    </script>

    <script type="text/javascript">
        /* Add Edit interest... */
        $('#modify_interest_list').click(function() {
            if(!$("#edit_rec_interest").is(":visible")) {
                $('#edit_rec_interest').show();
                $('.form_for_recruiter_edition').hide();
                $('#save_user_changes').hide();
                $('#modify_interest_list').text('Edit Form');
                $('#modify_interest_list').attr('id', 'show_edit_form_recruiter');
            }
        });
        $('#show_edit_form_recruiter').click(function() {
                alert('Handle Click...');
                $('#edit_rec_interest').hide();
                $('#show_edit_form_recruiter').text('Add / Edit  Interest');
                $('#show_edit_form_recruiter').attr('id', 'modify_interest_list');
        });
    </script>
@endsection