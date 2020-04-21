@extends('new_refactor.two_joined_square_boxes')

@section('title', 'Skauting find ideal Persons')

@section('page_title', 'Chats')

@section('left_box')
    TEST A
@endsection

@section('right_box')
    TEST B
@endsection

@section('scripts')
	@parent
	<script type="text/javascript" src="/js/new_refactor/html_template_functions.js"></script>
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection

@section('head')
	@parent
@endsection