@extends('new_refactor.single_square_box')

@section('page_title', 'Jobs')

@section('center_box')
  <section class="results">
    <input type="hidden" id="is_talent_home_page" value="true" />
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
    <div id="listed_jobs" class="row"></div>
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
    <script type="text/javascript" src="/js/new_refactor/html_template_functions.js"></script>
    <script type="text/javascript" src="/js/new_refactor/talent.js"></script>
@endsection