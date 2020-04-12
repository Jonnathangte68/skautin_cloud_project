@extends('templates.base_recruiter')

@if(property_exists($data[0],'cabecera_title')) 
    @section('title', $data[0]->cabecera_title)
@endif

@section('head')
    <style type="text/css">.switch{position:relative;display:inline-block;width:60px;height:34px}.switch input{display:none}.slider{position:absolute;cursor:pointer;top:0;left:0;right:0;bottom:0;background-color:#ccc;-webkit-transition:.4s;transition:.4s}.slider:before{position:absolute;content:"";height:26px;width:26px;left:4px;bottom:4px;background-color:#fff;-webkit-transition:.4s;transition:.4s}input:checked+.slider{background-color:#2196f3}input:focus+.slider{box-shadow:0 0 1px #2196f3}input:checked+.slider:before{-webkit-transform:translateX(26px);-ms-transform:translateX(26px);transform:translateX(26px)}.slider.round{border-radius:34px}.slider.round:before{border-radius:50%}.is-option-settings{cursor:pointer;padding:15px!important}a:link{color:#000;text-decoration:none}a:visited{color:#000;text-decoration:none}a:hover{color:#000;text-decoration:none}a:active{color:#000;text-decoration:none}h1,h2,h3,h4,h5,h6{line-height:inherit;margin-top:unset!important;margin-bottom:unset!important}.box-detopciones{background-color:#fff!important}.box-detopciones h3:first-child{margin-top:20px!important}.box-detopciones h3:last-child{margin-bottom:20px!important}</style>
@endsection

@section('content')

    <div class="row">
      <div class="col-md-4 .col-sm-1 .col-1"></div>
      <div class="col-md-4 .col-sm-10 .col-10 box-detopciones">
        <h3 id="fb_invites" class="is-option-settings">Invite friends from Fb</h3>
          <!--id="fb_invites"-->
        <hr>
        <h3 id="enlacesettingslk" class="is-option-settings">Settings</h3>
        <div id="settingslk">
        

        <p data-toggle="modal" data-target="#languageModal" class="is-option-settings"><i class="fas fa-circle bola-centrada-lista"></i>  Language</p>
        <p id="btn-notificaciones" class="is-option-settings"><i class="fas fa-circle bola-centrada-lista"></i>  Notifications</p>
        <div class="panel-hidden-notifications">
        <div class="row" style="padding-bottom:1%;vertical-align:middle;"><div class="col-md-1"></div><div class="col-md-8" style="text-align:justify;">Mostrar notificaciones relacionadas con la actividad del usuario</div><div class="col-md-3"><label class="switch"><input id="nt1" type="checkbox"><span class="slider round"></span></label></div></div>
        <div class="row" style="padding-bottom:1%;vertical-align:middle;"><div class="col-md-1"></div><div class="col-md-8" style="text-align:justify;">Mostrar notificaciones de Chat</div><div class="col-md-3"><label class="switch"><input id="nt2" type="checkbox"><span class="slider round"></span></label></div></div>
        <div class="row" style="padding-bottom:1%;vertical-align:middle;"><div class="col-md-1"></div><div class="col-md-8" style="text-align:justify;">Mostrar notificaciones relacionadas a seguidores y conexiones</div><div class="col-md-3"><label class="switch"><input id="nt3" type="checkbox"><span class="slider round"></span></label></div></div>
        </div>


        </div>
        <hr>
        <h3 id="enlaceaccountlk" class="is-option-settings">Account</h3>
        <div id="accountlk">
        <p class="is-option-settings"><a href="{{ route('recruiter_account_edit') }}"><i class="fas fa-circle bola-centrada-lista"></i>  Edit Profile</a></p>
        <p id="private_acc" class="is-option-settings"><i class="fas fa-circle bola-centrada-lista"></i>  Private Account</p>
        <p id="del_account" class="is-option-settings"><i class="fas fa-circle bola-centrada-lista"></i>  Delete Account</p>          
        </div>
        <hr>
        <h3 id="enlacehelplk" class="is-option-settings">Help</h3>
        <div id="helplk">
        <p class="is-option-settings"><a href="/about"><i class="fas fa-circle bola-centrada-lista"></i>  Terms &amp; Privacy</a></p>
        <p class="is-option-settings"><a href="/contact"><i class="fas fa-circle bola-centrada-lista"></i>  Contact Us</a></p>
        <p class="is-option-settings"><a href="/terms"><i class="fas fa-circle bola-centrada-lista"></i>  About Us</a></p>
        </div>
        <hr>
          <h3 class="is-option-settings"><a href="{{ route('logOut') }}">Log out</a></h3>
      </div>
      <div class="col-md-4 .col-sm-1 .col-1"></div>
    </div>

<!-- Modal -->
<div id="languageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Language Selection.</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="{{ URL::asset('js/settings_form.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.panel-hidden-notifications').hide();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <script type="text/javascript">

        setTimeout(function(){
            var lala = {!! json_decode($data[1]); !!}
            console.log(lala);
            if (lala==1) {
                $('#fb_invites').trigger('click');
            }else if(lala==2) {
                $('#settingslk').show();
            }
            else if(lala==3) {
                $('#accountlk').show();
            }
            else if(lala==4) {
                $('#helplk').show();
            }
            else if(lala==5) {

            }
            else{
                // 0 show any
            }
        }, 400);

        $('#enlacesettingslk').click(function() {
            if ($('#settingslk').is(':visible')) {
                $('#settingslk').animate({height: '0px'}, "slow", function() { $('#settingslk').hide(); });
            } else {
                $('#settingslk').css({'height':'0px','display':'block'});
                $('#settingslk').animate({height: 'auto'}, "slow", function() { $('#settingslk').css({'height':'auto'}); });
                $('#accountlk').animate({height: '0px'}, "slow", function() { $('#accountlk').hide(); });
                $('#helplk').animate({height: '0px'}, "slow", function() { $('#helplk').hide(); });
            }
        });
        $('#enlaceaccountlk').click(function() {
            if ($('#accountlk').is(':visible')) {
                $('#accountlk').animate({height: '0px'}, "slow", function() { $('#accountlk').hide(); });
            } else {
                $('#accountlk').css({'height':'0px','display':'block'});
                $('#accountlk').animate({height: 'auto'}, "slow", function() {$('#accountlk').css({'height':'auto'});});
                $('#settingslk').animate({height: '0px'}, "slow", function() { $('#settingslk').hide(); });
                $('#helplk').animate({height: '0px'}, "slow", function() { $('#helplk').hide(); });
            }
        });
        $('#enlacehelplk').click(function() {
            if ($('#helplk').is(':visible')) {
                $('#helplk').animate({height: '0px'}, "slow", function() { $('#helplk').hide(); });
            } else {
                $('#helplk').css({'height':'0px','display':'block'});
                $('#helplk').animate({height: 'auto'}, "slow", function() {$('#helplk').css({'height':'auto'});});
                $('#settingslk').animate({height: '0px'}, "slow", function() { $('#settingslk'); });
                $('#accountlk').animate({height: '0px'}, "slow", function() { $('#accountlk').hide(); });
            }
        });

    </script>

    <script type="text/javascript">
        $('#del_account').click(function(){
            try {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: "/deleteuser-status",
                            data: {}
                        })
                            .done(function( msg ) {
                                if (msg){
                                    swal(
                                        'Deleted!',
                                        'Account has been deleted.',
                                        'success'
                                    )
                                    try {
                                        window.location.replace("{!! route('logOut') !!}");
                                    }catch (err2) {
                                        window.location.href = "{!! route('logOut') !!}";
                                    }
                                } else {
                                    swal(
                                        'Something bad happen!',
                                        'Error processing the request.',
                                        'error'
                                    )
                                }
                            });
                    }else {
                        return true;
                    }
                })
            } catch (err) {
                console.log("ERROR CODE: AW11");
                console.log(err);
            }
        });
    </script>

    <script type="text/javascript">
        $('#private_acc').click(function() {
            try {
                swal({
                    title: "Are you sure?",
                    text: "If you become Private, will not appear on searches and couldn't be contact by people outside your connections!",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Privatize me!'
                })
                    .then((willDelete) => {
                        if (willDelete.value) {
                            $.ajax({
                                method: "POST",
                                url: "/change-privateaccount-status",
                                data: {}
                            })
                                .done(function( msg ) {
                                    if (msg){
                                        swal(
                                            'Change has been made!',
                                            'You\'re now a private user.',
                                            'success'
                                        )
                                    } else {
                                        swal(
                                            'Something bad happen!',
                                            'Error processing the request.',
                                            'error'
                                        )
                                    }
                                });

                        }else {
                            return true;
                        }
                    })
            }catch (err) {
                console.log("ERROR CODE: AW10");
                console.log(err);
            }
        });
    </script>

    <script type="text/javascript">
        $('#btn-notificaciones').click(function(){
            $('.panel-hidden-notifications').toggle();
        });
    </script>

    <script type="text/javascript">

        /*Retrieve facebook friends */
        $("#fb_invites").click(function() {
            FB.ui({
                app_id:'722008658215991',
                method: 'send',
                name: "sdfds jj jjjsdj j j ",
                link: 'https://apps.facebook.com/xxxxxxxaxsa',
                description:'sasa d d dssd ds sd s s s '

            });
        });
    </script>

    <!-- Facebook scripts -->
    <script>
        $(document).ready(function() {
            $.ajaxSetup({ cache: true }); // since I am using jquery as well in my app
            $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
                // initialize facebook sdk
                FB.init({
                    appId: '722008658215991', // replace this with your id
                    status: true,
                    cookie: true,
                    version: 'v2.8'
                });

                // attach login click event handler
                $("#btn-login").click(function(){
                    FB.login(processLoginClick, {scope:'public_profile,email,user_friends,pages_messaging', return_scopes: true});
                });
            });

            // function to send uid and access_token back to server
            // actual permissions granted by user are also included just as an addition
            function processLoginClick (response) {
                var uid = response.authResponse.userID;
                var access_token = response.authResponse.accessToken;
                var permissions = response.authResponse.grantedScopes;
                var data = { uid:uid,
                    access_token:access_token,
                    _token:'{{ csrf_token() }}', // this is important for Laravel to receive the data
                    permissions:permissions
                };
                postData("{{ url('/loginfb') }}", data, "post");
            }

            // function to post any data to server
            function postData(url, data, method)
            {
                method = method || "post";
                var form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", url);
                for(var key in data) {
                    if(data.hasOwnProperty(key))
                    {
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", data[key]);
                        form.appendChild(hiddenField);
                    }
                }
                document.body.appendChild(form);
                form.submit();
            }


            /* Notification settings */

            $.ajax({
                method: "GET",
                url: "{{route('get_statuses_tnotifications_now')}}"
            })
                .done(function( msg ) {
                    console.log(msg);
                    if (!msg || msg == undefined || msg == "" || msg == 0 || msg==null) {
                        console.log("click to all");
                        $("#nt1").trigger('click');
                        $("#nt2").trigger('click');
                        $("#nt3").trigger('click');
                    }else {
                        console.log("no click");
                        console.log(msg);
                    }
                });


        })

    </script>
@endsection