@extends('new_refactor.single_square_box')

@section('page_title', 'Jobs')

@section('center_box')
  <section class="results">
    <p class="letragrande"><b>{{-- count($data['vacantes']) --}} Opportunities for you</b></p>
    <div class="row searchrow">
      <div class="col-md-8">
        <p style="display:inline">Recruiters</p><i class="fas fa-circle separcircle" style="margin-right: 1%;"></i>
        <p style="display:inline">In your network</p><i class="fas fa-circle separcircle" style="margin-right: 1%;"></i><p style="display:inline">Update career interest</p>
      </div>
      <div class="col-md-4">
          <select id="selectbasic" name="selectbasic" class="form-control" <?php /* echo count($data['vacantes']) == 0 ? 'disabled="true"' : '' */ ?>>
            <option value="1">Sort by...</option>
            <option value="2">Newest</option>
            <option value="3">Oldest</option>
          </select>
      </div>
    </div>
    <div class="row">
      <!--<a href="/vacant-details/1">-->
        {{-- @foreach ($data['vacantes'] as $vacante) --}}
            <div class="col-md-4 divact"><a href="/vacant-details/{{-- $vacante->id --}}">
              <p class="letragrande titulojob" ><b>{{-- $vacante->name --}}</b></p>
              <p class="letramedia titulojoblocation"><?php /* if(property_exists($vacante, 'region_info')) */ ?>{{-- $vacante->region_info --}}</p>
              <p class="letrachica"><?php /* if(property_exists($vacante, 'description')) {echo $vacante->description;} */ ?></p>
              <p class="timeago-maketime" style="float: right;clear: both;color:#686868;"><b>{{-- $vacante->date --}}</b></p>
            </a></div>
            {{-- @endforeach --}}
      <!--</a>-->
    </div>
  </section>
@endsection

@section('head')
    @parent

    <style type="text/css">
        /* Override default bootstrap class */
        .container {
            width: 90% !important;
        }
        .borderyseccion {
            height: 720px !important;
        }
    </style>


@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://timeago.yarp.com/jquery.timeago.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery.timeago.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.timeago-maketime').each(function(k, v) {
                $(v).text($.timeago($(v).text()));
            });
        });
    </script>
@endsection