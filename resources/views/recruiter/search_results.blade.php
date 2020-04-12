@extends('templates.base_recruiter')

@section('title', 'Skauting discover')

@section('content')

    <h2 class="textocb18 letraextragrande left-header" style="left-margin:4% !important;"><b>Search results for <span id="tbusq"></span></b></h2>
    <div class="container borderyseccion">

      <section>

        <!--<div class="row title-navigators-mn">
          <div class="col-md-2"></div>
          <div id="stl" class="col-md-2 letramedia active-link-s">Talents</div>
          <div class="col-md-1"><div class="circle-separator"></div></div>
          <div id="srec" class="col-md-2 letramedia">Recruiters</div>
          <div class="col-md-1"><div class="circle-separator"></div></div>
          <div id="sjbs" class="col-md-2 letramedia">Jobs</div>
          <div class="col-md-2"></div>
        </div>-->
        <div class="header-search-items">
            <p id="stl" class="letramedia active-link-s">Talents</p>
            <!--<div class="circle-separator"></div>-->
            <i class="fas fa-dot-circle"></i>
            <p id="srec" class="letramedia">Recruiters</p>
            <!--<div class="circle-separator"></div>-->
            <i class="fas fa-dot-circle"></i>
            <p id="sjbs" class="letramedia">Jobs</p>
        </div>

        <div id="contenido" class="contenido" style="height: 2000px;">
           
          <div id="results_for_search" class="row"><!--
            <div class="col-md-3"><div class="card-s"><img src="{{URL::asset('img/img_avatar.png')}}" alt="Avatar" class="sch_img"><div class="container"><h4><b>John Doe</b></h4><p>Architect &amp; Engineer</p></div></div></div> -->
          </div>
         
        </div>

      </section>

    </div>

    <script type="text/javascript">

      var s = {!! json_encode($data[1]) !!};
      var n = 0;
      var loaded_values = [];

function imgError(image) {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
  if($('#stl').hasClass( "active-link-s" )){
  image.onerror = "";
  image.src = baseUrl+"img/search_default_talent_image.png";
  return true;
  }
  if($('#srec').hasClass( "active-link-s" )){
  image.onerror = "";
  image.src = baseUrl+"img/search_default_recruiter_image.png";
  return true;
  }
}

        $(window).scroll(function() {
           if($(window).scrollTop() + $(window).height() == $(document).height()) {         
if($('#stl').hasClass( "active-link-s" )){


$.get( "searcht_results", { terms: s, pass_values: loaded_values, qtype:'talent_search' } )
.done(function( data ) {
    var tmp = JSON.parse(data);
    var results = tmp.results;
    for (var i = results.length - 1; i >= 0; i--) {
        //console.log("inside loop: "+i+"  "+results[i].name);
        $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img' onerror='imgError(this);'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
    }
});


    
}
if($('#srec').hasClass( "active-link-s" )){


$.get( "searcht_results", { terms: s, pass_values: loaded_values, qtype:'recruiter_search' } )
.done(function( data ) {
    var tmp = JSON.parse(data);
    var results = tmp.results;
    for (var i = results.length - 1; i >= 0; i--) {
        //console.log("inside loop: "+i+"  "+results[i].name);
        $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
    }
});


    
}
if($('#sjbs').hasClass( "active-link-s" )){


$.get( "searchr_results", { terms: s, pass_values: loaded_values, qtype:'job_search' } )
.done(function( data ) {
    var tmp = JSON.parse(data);
    var results = tmp.results;
    for (var i = results.length - 1; i >= 0; i--) {
        //console.log("inside loop: "+i+"  "+results[i].name);
        $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
    }
});


    
}
           }
        });

        // Fin del evento desplazar ventana

        $( document ).ready(function() {
          $('#tbusq').text('Talent');
            // Primera entrada busqueda por talentos, no hay resultados
             if($('#contenido').find('.row > div:first').length > 0) {}else {

                $.get( "searchr_results", { terms: s, pass_values: loaded_values, qtype:'talent_search' } )
                .done(function( data ) {
                  //alert( "Data Loaded: " + data );
                    console.log("data ");
                    console.log(JSON.parse(data));
                    var tmp = JSON.parse(data);
                    var results = tmp.results;
                    console.log(results[0].name);
                    for (var i = results.length - 1; i >= 0; i--) {
                        console.log("inside loop: "+i+"  "+results[i].name);
                        $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img' onerror='imgError(this);'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
                    }
                });
             } 
        });

        // Fin al entrar

        $('#stl').click(function(){
            $(this).addClass( "active-link-s" );
            if($('#srec').hasClass( "active-link-s" )){
                $('#srec').removeClass("active-link-s");
            }
            if($('#sjbs').hasClass( "active-link-s" )){
                $('#sjbs').removeClass("active-link-s");
            }

            // Clear the Screen
            $('#contenido').empty();

            // Titulo busqueda
            $('#tbusq').text('Talents');

            // Ajax request load results

            //alert('Here!');

            $.get( "searchr_results", { terms: s, pass_values: null, qtype:'talent_search' } )
            .done(function( data ) {
                var tmp = JSON.parse(data);
                var results = tmp.results;
                $('#contenido').append("<div id='results_for_search' class='row'>");
                for (var i = results.length - 1; i >= 0; i--) {
                    //console.log("inside loop: "+i+"  "+results[i].name);
                    $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
                }
                $('#contenido').append("</div>");
            });
        });
        $('#srec').click(function(){
            $(this).addClass( "active-link-s" );
            if($('#stl').hasClass( "active-link-s" )){
                $('#stl').removeClass("active-link-s");
            }
            if($('#sjbs').hasClass( "active-link-s" )){
                $('#sjbs').removeClass("active-link-s");
            }

            // Clear the Screen
            $('#contenido').empty();

            // Titulo Busqueda
            $('#tbusq').text('Recruiters');

            // hjqr
            $.get( "searchr_results", { terms: s, pass_values: null, qtype:'recruiter_search' } )
            .done(function( data ) {
                var tmp = JSON.parse(data);
                var results = tmp.results;
                $('#contenido').append("<div id='results_for_search' class='row'>");
                for (var i = results.length - 1; i >= 0; i--) {
                    //console.log("inside loop: "+i+"  "+results[i].name);
                    $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
                }
                $('#contenido').append("</div>");
            });
        });
        $('#sjbs').click(function(){
            $(this).addClass( "active-link-s" );
            if($('#stl').hasClass( "active-link-s" )){
                $('#stl').removeClass("active-link-s");
            }
            if($('#srec').hasClass( "active-link-s" )){
                $('#srec').removeClass("active-link-s");
            }

            // Clear the Screen
            $('#contenido').empty();

            // Titulo Busqueda
            $('#tbusq').text('Jobs');

            $.get( "searchr_results", { terms: s, pass_values: null, qtype:'job_search' } )
            .done(function( data ) {
                var tmp = JSON.parse(data);
                var results = tmp.results;
                $('#contenido').append("<div id='results_for_search' class='row'>");
                for (var i = results.length - 1; i >= 0; i--) {
                    //console.log("inside loop: "+i+"  "+results[i].name);
                    $('#results_for_search').append("<div class='col-md-3'><div class='card-s'><img src='"+results[i].profile_image+"' alt='Avatar' class='sch_img'><div class='container'><h4><b>"+results[i].name+"</b></h4><p>"+results[i].title+"</p></div></div></div>");
                }
                $('#contenido').append("</div>");
            });
        });

        // Fin cambiar busqueda
    </script>

@endsection