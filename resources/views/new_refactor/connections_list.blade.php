@extends('new_refactor.two_square_box')

@section('title', 'Skauting find ideal Persons')

@section('page_title', 'Connections')

@section('left_box')
    <section id="connections_list"></section>
    <input id="is_recruiter_connection_page" type="hidden" value="true"/>
@endsection

@section('right_box')
    <h2 style="font-size: 1.9rem;padding-left:4%;padding-right:4%;">Talents/Recruiters you might like to connect with</h2>
    <section id="suggestions_list"></section>
@endsection

@section('scripts')
	@parent
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection

@section('head')
	@parent
@endsection