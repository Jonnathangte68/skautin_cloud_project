@extends('templates.base_recruiter')

@section('content')

    <h2 class="letraextragrande left-header"><b class="margin-conects-left">Chats</b></h2>

    <div class="container-fluid">
        <div class="row correct-paddings">
            <div class="col-md-12 borderyseccion" style="height: 80%;min-height: 80%;">

                <div class="row">

                    <div class="col-xs-8 col-sm-8 col-md-8 col-xl-8 hmatch-large">
                        <div style="height:60vh;" class="inner-div-content hall-match">

                            <div class="row">

                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <img id="img_contact" src="{{asset('img/user.png')}}" style="display: inline;" class="img-logo-main img-circle img-contact-round"></img>&nbsp;<span id="title_contact" class="title-c-text-font"></span>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 align-tools">
                                    <a><i class="fa fa-search fa-w-18 icons-font"></i></a>
                                    <a><img src="{{asset('img/attach.png')}}" class="icon-image-w space-between-icons top-margin-align"></a>
                                    <a><i class="fa fa-ellipsis-v space-between-icons icons-font" aria-hidden="true"></i></a>
                                </div>

                            </div>

                            <br><br>

                            <div id="msglist" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            </div>

                            <span id="fmessage" class="notification_first_message">This is the first message between you two...</span>

                            <div class="row bottom_page_message force-row">
                                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                    <textarea class="form-control text-area-message-body" id="new_message_content" name="new_message_content"></textarea>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                    <button id="btn_send" class="btn btn-default btn-send-message">Send</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="chat_bitacora" class="col-xs-4 col-sm-4 col-md-4 col-xl-4 hmatch-large">
                        <div style="border-left: 1px solid #E6E6E6;background-color: #FFF;padding: 4% 4% 4% 4%;" class="hall-match">
                            <div style="height:55vh;">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input id="textinput" name="textinput" type="text" placeholder="Buscar contacto" class="form-control input-md bottom-margin">
                                    </div>
                                </div>

                                <div id="rightsectiondata" class="container" style="max-height: 70%;height: 70%;max-width: 100%;overflow-y: auto;display: none;"></div>

                                <p id="emptymsg" style="text-align: center;display: none;">No suggestions...</p>
                                <img id="default_data_image" src="img/tb-skeleton.gif">

                            </div>


                        </div>
                    </div>
                    <!-- End inner row -->
                </div>
                <!-- End row -->
            </div>
            <!--<div id="chat_bitacora" class="col-md-4">
                <div style="border: 1px solid #E6E6E6;margin-right: 60px;background-color: #FFF;padding: 4% 4% 4% 4%;">
                    <div style="height:55vh;">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="textinput" name="textinput" type="text" placeholder="Buscar contacto" class="form-control input-md bottom-margin">
                            </div>
                        </div>
                        <div id="rightsectiondata" class="container" style="max-height: 70%;height: 70%;max-width: 100%;overflow-y: auto;display: none;"></div>
                        <p id="emptymsg" style="text-align: center;display: none;">No suggestions...</p>
                        <img id="default_data_image" src="img/tb-skeleton.gif">
                    </div>
                </div>
            </div>-->
        </div>
    </div>

    <input id="txt_to_message" type="hidden" value="<?= isset($_REQUEST['to']) ?  $_REQUEST['to'] : '' ?>">

@endsection

@section('head')
    @parent
    <style type="text/css">body{background-color:#f5f5f5}.aftermoto{width:245px;padding-top:5px}#prependedtext{width:100%;margin-left:165px;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;height:20%;margin-top:8px}.padright{padding-right:5%}.padleft{padding-left:5%}.nav-advance{padding-left:16rem;margin-top:.3rem;font-weight:700}.section-topspaced{margin-top:4%;padding-left:23%;margin-bottom:2%}.barra{background-color:#fff;border-bottom:1px solid #e6e6e6;border-top:0 solid #fff!important;border-left:0 solid #fff!important;border-right:0 solid #fff!important}.navbar{border-bottom:1px solid #e6e6e6;border-top:0 solid #fff!important;border-left:0 solid #fff!important;border-right:0 solid #fff!important}.cuadro-registration{padding:3% 1% 1% 1%;width:60%;margin-left:20%;margin-right:20%;border:2px solid #a6a6a6}.letraextragrande{font-family:Calibri,sans-serif;font-size:2rem;color:#686868}.letragrande{font-family:Calibri,sans-serif;font-size:1.5rem;color:#686868}.letramedia{font-family:Calibri,sans-serif;font-size:1.4rem;color:#686868}.letrachica{font-family:Calibri,sans-serif;font-size:1.2rem;color:#686868}.letraextrachica{font-family:Calibri,sans-serif;font-size:1rem;color:#686868}.circle-separator{width:10px;height:10px;border-radius:50%;background-color:#686868;margin-top:6px}li>a:hover{color:#000!important}.navbar-brand>a{color:#000!important}.searchrow{margin-bottom:2%}.titulojob{margin-bottom:0}.titulojoblocation{margin-bottom:7%}.cuadro-registration{padding:3% 1% 1% 1%;width:60%;margin-left:20%;margin-right:20%;border:1px solid #a6a6a6}.textoc10{color:#686868}.inner-carret{color:#686868;margin-left:99.5%;font-size:17px;vertical-align:middle}.search{position:relative;color:#aaa;font-size:16px}.search input{width:250px;height:32px;z-index:101;background:#fafafa!important;border:1px solid #aaa;border-radius:5px}.search input{text-indent:32px}.search .fa-search{position:absolute;top:15px;left:180px;z-index:100}.institutinfo{color:#686868;text-align:center}.step{height:15px;width:15px;margin:0 2px;background-color:#bbb;border:none;border-radius:50%;display:inline-block;opacity:.5}.step-active{opacity:1}.step-finish{background-color:#4caf50}.centersteps{text-align:center;margin-bottom:15px}.cornerbtnsmall{width:6rem;height:5rem}.sel-info{margin-bottom:1%}.sel-info>p{display:inline}.selected-bold{font-weight:700}.boton-azul{background-color:#31859c!important;font-size:bold}.img-navbar-menu{width:3rem;height:2.2rem}.left-header{margin-left:5%;margin-top:4%;margin-bottom:1.5rem}.borderyseccion{border:1px solid #e6e6e6;background-color:#fff;padding:0}.borderyseccion>section{padding:1% 2% 2% 2%}.txtinnerusedetails>p{margin-bottom:0}.specialnumber{text-align:center;font-weight:700;font-size:2em}.subtitlemenuit{font-size:.7em;text-align:center}.imagemenuit{display:inline;width:3rem;height:3rem}.pmenuit{display:inline;font-size:.8em}.containermenuit{width:100%;height:80%;display:block;padding-top:10%}.img-vacant-description{width:100%;height:100%}.details-row{margin-top:1%}.column{float:left;padding:10px;height:300px}.leftxlk{height:22rem;width:65%;border-right:1px solid #e6e6e6}.middlexlk{width:35%}.rowxlk:after{content:"";display:table;clear:both}.fa-ellipsis-h{color:#000;font-size:2em;vertical-align:middle}.linklittlf{padding-left:3%}.pnobottom{margin-bottom:0}.img-map-points{padding-top:5%;height:100%}#firstsearchelem{padding-top:0}.elemsearch{padding-top:8%}.row-alta{height:100%;padding-top:5%}.row-alta2{height:45rem!important;background-repeat:no-repeat}.titleadvancesearch{color:#fff;margin-left:58%;margin-top:27%}.btnadvsearch{margin-left:64%}.inner-div-content{padding:2% 2% 2% 2%}.rond{width:3rem;height:3rem}.boxofdetails{padding-left:8%;padding-right:0}.boxofdetails>p{width:100%}.divact>a>*{text-decoration:none}.separcircle{font-size:.5em;vertical-align:middle;margin-left:1%}.elementtopseparation{padding-top:.3rem}.boxlitbig{height:15rem!important}.no-backgroundblackstrange{background:#fff!important;background-color:#fff!important}.link-hand{cursor:pointer}.box-detopciones{border:1px solid #e6e6e6;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;margin-top:3%}.bola-centrada-lista{vertical-align:middle;font-size:.5rem}.intervideo{padding-top:5%}.intervideo>div>p{margin:0}.container-video-media-dos{position:relative;z-index:-1000;width:100%;height:100%;background-color:#000}.inside-play-btn{z-index:1;font-size:1em;color:#fff;position:absolute;top:9;left:52}.video_fondo{background-color:#000;width:100%;height:8rem}.vvideo{cursor:pointer!important}#prependedtext,#prependedtext::-webkit-input-placeholder{font-size:12px;line-height:3}.logo-sz{width:42px;padding:0!important}.margin-conects-left{margin-left:4%}.margin-profile-left{margin-left:9%}.title-navigators-mn{padding-bottom:2%}.main-panel-aux{border:1px solid #e6e6e6;min-height:100%;background-color:#fff}.card-s{box-shadow:0 4px 8px 0 rgba(0,0,0,.2);transition:.3s;border-radius:5px}.sch_img{width:100%;border-radius:5px 5px 0 0}.active-link-s{font-weight:700}.header-search-items{text-align:center;display:block;width:100%;padding-bottom:5%;padding-top:2%}.header-search-items>p{cursor:pointer;display:inline}</style>
    <style type="text/css">.bottom-margin{margin-bottom:4%}.icon-image-w{width:3rem}.space-between-icons{margin-left:12px}.icons-font{font-size:23px;color:#686868!important}.top-margin-align{margin-top:-8px}.img-logo-main{width:3rem}.notification_first_message{color:#d6d8d9;margin-left:40%}.bottom_page_message{position:absolute;bottom:10px}.force-row{width:100%!important;min-width:100%!important}.text-area-message-body{width:100%;resize:none}.btn-send-message{background:#fff;border-color:#fff;font-size:2rem}.btn-send-message:hover{background:#fff;border-color:#fff;font-size:2rem}.btn-send-message:focus{background:#fff;border-color:#fff;font-size:2rem}.message_send{position:relative;background:#00bb2b;border-radius:.4em;padding:2%}.message_send:after{content:'';position:absolute;right:0;top:50%;width:0;height:0;border:20px solid transparent;border-left-color:#00bb2b;border-right:0;border-bottom:0;margin-top:-10px;margin-right:-20px}.message_receive{position:relative;background:#0ab;border-radius:.4em;padding:2%}.message_receive:after{content:'';position:absolute;left:0;top:50%;width:0;height:0;border:20px solid transparent;border-right-color:#0ab;border-left:0;border-bottom:0;margin-top:-10px;margin-left:-20px}.msg_bottom_note{color:#fff;font-style:italic;position:absolute;right:14px;font-size:1.3rem}.chat-text-content{font-size:2rem;color:#fff}</style>
    <style type="text/css">.img-list-chat-people{width:80%!important}.top-space-chat-people{padding-top:3%}.boldUserSelected{font-weight:700}#msgList{height:75%!important;overflow-y:auto!important}.title-c-text-font{font-size:1.8rem;margin-left:2%}#msgList .row{margin-bottom:4px!important}.message-bottom-margin{margin-bottom:4px!important}.img-contact-round{width:8%;height:54px}</style>
    <style type="text/css">.hmatch-large{height:720px!important}.hall-match{min-height:100%!important;height:100%!important}.correct-paddings{padding-right:6%!important;padding-left:6%!important}.align-tools{padding-top:1%}.margin-conects-left{margin-left:16px}</style>
@endsection


@section('scripts')
    @parent
    <script type="text/javascript" src="https://timeago.yarp.com/jquery.timeago.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery.timeago.min.js')}}"></script>
    <script type="text/javascript">
        function imgError(image) {
            var getUrl = window.location;
            var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
            image.onerror = "";
            image.src = baseUrl+"img/search_default_talent_image.png";
            return true;
        }
        function openThread(thread_id) {
            var thrd = allThreads.map(function(e) { return e['id']; }).indexOf(thread_id);
            $('#title_contact').text(allThreads[thrd].user.name);
            $('#img_contact').attr('src', allThreads[thrd].user.profile_img);
            $('#txt_to_message').val(allThreads[thrd].user._id);
            allThreads[thrd].messages.forEach(function(t) {
                $.ajax({
                    method: "GET",
                    url: "/get-this-message",
                    data: { id: t._id }
                })
                    .done(function( msgInfo ) {
                        if (msgInfo!==1) {
                            // Handle information.
                            var parsed_msg = JSON.parse(msgInfo);
                            if (parsed_msg.user===myUser) {
                                $("#msglist").append("<div class='row message-bottom-margin'><div class='col-xs-2 col-sm-2 col-md-8 col-lg-8'></div><div class='col-xs-10 col-sm-10 col-md-4 col-lg-4 message_send'><p class='chat-text-content'>"+parsed_msg.text+"</p><p class='msg_bottom_note'>now</p></div></div>");
                            } else {
                                $("#msglist").append("<div class='row message-bottom-margin'><div class='col-xs-10 col-sm-10 col-md-4 col-lg-4 message_receive'><p class='chat-text-content'>"+parsed_msg.text+"</p><p class='msg_bottom_note'>now</p></div><div class='col-xs-2 col-sm-2 col-md-8 col-lg-8'></div></div>");
                            }
                        }
                    });
            });
        }
    </script>
    <script>

        var allMessages = {!! json_encode($data['messages']) !!};
        var allThreads = [];
        var msg_receiver = $("#txt_to_message").val();
        var thisThreadId = "";
        var myUser = "{!! session('user')->email !!}";
        var myUserId = String({!! json_encode($data['userId']) !!});
        var categs = {!! json_encode($data['categories']) !!};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        setTimeout(function() {
            /*if ($("#default_data_image").is(":visible")) {
                $("#default_data_image").hide();
            }*/
        },250);

        if (allMessages && allMessages.message.length>0) {
            $("#fmessage").hide();
        }

        if (msg_receiver) {
            var msg_receiver_u = msg_receiver;
            console.log("In 1");
            $.ajax({
                method: "GET",
                url: "/get-load-user-detail-normal",
                async: false,
                data: { id: msg_receiver }
            })
                .done(function( msg ) {
                    var p = JSON.parse(msg);
                    msg_receiver_u = p.user;
                });

            allMessages.message.forEach(function(msg) {
                // Loop over all user threads
                if (msg.to_user == msg_receiver_u || msg.user == msg_receiver_u ) {
                    thisThreadId = msg._id;
                    msg.messages.forEach(function(singlemsg) {
                        // Implement
                        // Search this message singlemsg.messages
                        $.ajax({
                            method: "GET",
                            url: "/get-this-message",
                            data: { id: singlemsg.messages }
                        })
                            .done(function( msgInfo ) {
                                if (msgInfo!==1) {
                                    // Handle information.
                                    var parsed_msg = JSON.parse(msgInfo);
                                    if (parsed_msg.user===myUser) {
                                        $("#msglist").append("<div class='row message-bottom-margin'><div class='col-xs-2 col-sm-2 col-md-8 col-lg-8'></div><div class='col-xs-10 col-sm-10 col-md-4 col-lg-4 message_send'><p class='chat-text-content'>"+parsed_msg.text+"</p><p class='msg_bottom_note'>now</p></div></div>");
                                    }else {
                                        $("#msglist").append("<div class='row message-bottom-margin'><div class='col-xs-10 col-sm-10 col-md-4 col-lg-4 message_receive'><p class='chat-text-content'>"+parsed_msg.text+"</p><p class='msg_bottom_note'>now</p></div><div class='col-xs-2 col-sm-2 col-md-8 col-lg-8'></div></div>");
                                    }
                                }
                            });
                    });

                }

            });
        }
        $('#btn_send').click(function() {
            var message = $('#new_message_content').val();
            $('#new_message_content').val("");
            $("#msglist").append("<div class='row message-bottom-margin'><div class='col-xs-2 col-sm-2 col-md-8 col-lg-8'></div><div class='col-xs-10 col-sm-10 col-md-4 col-lg-4 message_send'><p class='chat-text-content'>"+message+"</p><p class='msg_bottom_note'>now</p></div></div>");
            $.ajax({
                method: "POST",
                url: "/save-message",
                data: { to: $('#txt_to_message').val(), text: message }
            })
                .done(function( msg ) {
                    //console.log(msg);
                });
        });

        /* Right side loads list of other threads if empty receiver load all messages from first thread */
        /* NOTE: First 100 messages for each user and each thread */
        console.log(allMessages.message);
        allMessages.message.forEach(function(msg) {
            console.log("In script");
            var uid = (msg.to_user === myUserId) ? msg.user : msg.to_user ;
            var thread = {
                id: msg._id,
                messages: [],
                user: {}
            }
            var oneHundredCounter = 0;
            msg.messages.forEach(function(m) {
                $.ajax({
                    method: "GET",
                    url: "/get-this-message",
                    async: false,
                    data: { id: m.messages }
                })
                .done(function( msj ) {
                    if (oneHundredCounter<=100) {
                        thread.messages.push(JSON.parse(msj));
                        oneHundredCounter++;
                    }
                });
            });
            // User info
            $.ajax({
                method: "GET",
                url: "/get-load-user-detail",
                async: false,
                data: { id: uid }
            })
            .done(function( msg ) {
                thread.user = JSON.parse(msg);
            });
            allThreads.push(thread);

        });
        if (!(allThreads.length>0)) {
            // Show message Empty chat list...

        } else {
            // Add elements to List
            $("#default_data_image").hide();
            $("#rightsectiondata").show();
            allThreads.forEach(function(th) {
                // language=HTML
                var injectableData = "";
                var ctrlJ = 0;
                if (th.user.hasOwnProperty('category')) {
                    th.user.category.forEach(function(ct) {
                        var g = categs[categs.map(function(e) { return e['_id']; }).indexOf(ct)];
                        if (ctrlJ!=0) {injectableData += ', '+g.name;}else {injectableData += g.name;}
                        ctrlJ++;
                    });
                } else {
                    // Rec
                    injectableData += 'skautin'
                }

                var gHtml = `<div class="row" data-thread_id='${th.id}'>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <img src="${th.user.profile_img}" onerror='imgError(this);' class="img-circle img-list-chat-people">
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 top-space-chat-people">
                          <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 user-name-m `+(($("#txt_to_message").val()==th.user._id) ? 'boldUserSelected' : '')+`">
                                        ${th.user.name}
                                  </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        ${injectableData}
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        ${th.messages[th.messages.length-1].text}
                                  </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        ${jQuery.timeago(th.messages[th.messages.length-1].Created_date)}
                                  </div>
                              </div>
                        </div>
                    </div>`;
                $("#rightsectiondata").append(gHtml);
            });

            /* Not opening a conversation from user */

            if ($("#rightsectiondata :first-child").data('thread_id') && !msg_receiver) {
                openThread($("#rightsectiondata :first-child").data('thread_id'));
                $("#rightsectiondata :first-child .user-name-m").addClass("boldUserSelected");
            }

        }

        
    </script>

@endsection