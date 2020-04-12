@extends('templates.base_recruiter_deprecated')

@section('title', 'Skauting discover')

@section('content')
    <h2 class="letraextragrande left-header"><b>Jobs posted</b></h2>
    <div class="container borderyseccion">
        <section class="results hmatch-large">
          <div class="row searchrow">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <select id="selectbasic" name="selectbasic" class="form-control controlly-notbrak">
                  <option value="1">Sort by...</option>
                  <option value="2">Newest</option>
                  <option value="3">Oldest</option>
                </select>
                <button id="show_as_list" class="btn btn-default"><span id="icon_list_toggle_im_forms" class="glyphicon glyphicon-th-list"></span></button>
            </div>
          </div>
          <div class="row">
                <div class="col-md-3 item-vacant">
                    <h3></h3>
                    <p style="word-break: break-all;"><span class="innerCountry"></span>,<span class="innerState"></span>,<span class="innerCity"></span></p>
                    <p></p>
                    <p class="pega-derecha timeago-maketime"></p>
                </div>
              <!--<div class="row"><div class="col-md-10"></div><div class="col-md-2"></div></div>-->
              <a href="{{route('vacant.create')}}" class="wpointr nosuby-on-link add-new-vac-title lnk-positioning-btm">Add (+) new vacant...</a>
          </div>
        </section>
    </div>
@endsection

@section('head')
    @parent
    {!! Html::style('css/vacantmanagstyles.css') !!}
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://timeago.yarp.com/jquery.timeago.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery.timeago.min.js')}}"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('.timeago-maketime').each(function(k, v) {
                $(v).text($.timeago($(v).text()));
            });
        });
    </script>
    <script type="text/javascript">

        function updateDates() {
            $('.item-vacant').each(function(k, v) {
                var regionInfo = $($(v)[0]).children().eq(1).text();
                var xy = regionInfo;
                var vArray = xy.split(",");
                $(v).find(".innerCountry").text(countries.find(o => o._id === vArray[0]).name);
                $(v).find(".innerState").text(" "+states.find(o => o._id === vArray[1]).name);
                $(v).find(".innerCity").text(" "+cities.find(o => o._id === vArray[2]).name);
                
            });
        }

        function reorderDates() {
            $('.timeago-maketime').each(function(k, v) {
                $(v).text($.timeago($(v).text()));
            });
        }

        function compareAsc( a, b ) {
            if ( a.Created_date < b.Created_date ){
                return -1;
            }
            if ( a.Created_date > b.Created_date ){
                return 1;
            }
            return 0;
        }
        function compareDesc( a, b ) {
            if ( a.Created_date > b.Created_date ){
                return -1;
            }
            if ( a.Created_date < b.Created_date ){
                return 1;
            }
            return 0;
        }

        $(document).ready(function() {
            setTimeout(function() {
                updateDates();
            },250);
        });

        $('#show_as_list').click(function() {
            $('.item-vacant').each(function(k, v) {
                    if($(v).hasClass('col-md-12')) {
                        $('#icon_list_toggle_im_forms').addClass('glyphicon-th-list');
                        $('#icon_list_toggle_im_forms').removeClass('glyphicon-th');
                        $(v).addClass("col-md-3");
                        $(v).removeClass("col-md-12");
                    } else {
                        $('#icon_list_toggle_im_forms').removeClass('glyphicon-th-list');
                        $('#icon_list_toggle_im_forms').addClass('glyphicon-th');
                        $(v).removeClass("col-md-3");
                        $(v).addClass("col-md-12");
                    }
            });
        });

        $('#selectbasic').change(function() {

            var classForm = ($('#icon_list_toggle_im_forms').hasClass('glyphicon-th-list')) ? 'col-md-3' : 'col-md-12';

            if($('#selectbasic').val()=="2") {
                $(".results").children("div").eq(1).empty();
                var bk = vacantsArray.sort( compareDesc );
                var k = 0;
                while(k < bk.length) {
                    var htmlContent = `<div class="${classForm} item-vacant">
                            <h3>${bk[k].title}</h3>
                            <p style="word-break: break-all;"><span class="innerCountry">${bk[k].country}</span>,<span class="innerState">${bk[k].state}</span>,<span class="innerCity">${bk[k].city}</span></p>
                            <p>${bk[k].description}</p>
                            <p class="pega-derecha timeago-maketime">${bk[k].Created_date}</p>
                        </div>`;
                    $(".results").children("div").eq(1).append(htmlContent);
                    k++;
                }
                updateDates();
                reorderDates();
            }else {
                $(".results").children("div").eq(1).empty();
                var bk = vacantsArray.sort( compareAsc );
                var k = 0;
                while(k < bk.length) {
                    var htmlContent = `<div class="${classForm} item-vacant">
                            <h3>${bk[k].title}</h3>
                            <p style="word-break: break-all;"><span class="innerCountry">${bk[k].country}</span>,<span class="innerState">${bk[k].state}</span>,<span class="innerCity">${bk[k].city}</span></p>
                            <p>${bk[k].description}</p>
                            <p class="pega-derecha timeago-maketime">${bk[k].Created_date}</p>
                        </div>`;
                    $(".results").children("div").eq(1).append(htmlContent);
                    k++;
                }
                updateDates();
                reorderDates();
            }
        });


    </script> -->
@endsection