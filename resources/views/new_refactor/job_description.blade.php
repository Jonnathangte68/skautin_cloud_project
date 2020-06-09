@extends('new_refactor.two_square_box')

@section('title', 'Skauting find ideal Persons')

@section('page_title', 'Job Details')

@section('left_box')
    <section id="job_description"></section>
    <input id="is_job_description" type="hidden" value="true"/>
@endsection

@section('right_box')
    <h2 style="font-size: 1.9rem;padding-left:4%;padding-right:4%;">Other jobs you might like: </h2>
    <section id="suggestions_list"></section>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="/js/new_refactor/html_template_functions.js"></script>
	<script type="text/javascript" src="/js/new_refactor/talent.js"></script>
@endsection

@section('head')
    @parent
    <style>
        .alert-success {
            margin-bottom: 0px !important;
        }
        .alert-warning {
            margin-bottom: 0px !important;
        }
    </style>
@endsection