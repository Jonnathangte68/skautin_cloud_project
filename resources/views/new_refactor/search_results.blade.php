@extends('new_refactor.single_square_box')

@section('page_title', 'Search results for ')

@section('center_box')
    <section class="results hmatch-large">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 selectors" style="text-align:center;">
                <span class="selected">Talents</span>
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span>Recruiters</span>
                <i class="fa fa-circle" aria-hidden="true"></i>
                <span>Jobs</span>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
        <div class="container-fluid">
            <div id="search_content" class="row"></div>
        </div>
    </section>
    <input type="hidden" id="search_result_page" value="true" /> 
@endsection

@section('head')
    @parent
    <style type="text/css">
        .selected {
            font-weight: bold;
            text-decoration: underline;
        }
        .selectors {
            font-size: 1.7rem;
        }
        .selectors span {
            cursor: pointer;
        }
        .fa-circle {
            width: 0.6rem !important;
        }
        .hidden-card {
            display: none;
        }
    </style>
@endsection

@section('scripts')
    @parent
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection
