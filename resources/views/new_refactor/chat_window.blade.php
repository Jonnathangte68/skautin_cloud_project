@extends('new_refactor.two_joined_square_boxes')

@section('title', 'Skauting find ideal Persons')

@section('page_title', 'Chats')

@section('left_box')
	<div class="box-messages container">
		<table id="container-for-messages"></table>
	</div>
	<div id="chat-option-dropdown" style="display:none !important;position:absolute;width: 18%;top: 13%;right: 2%;border: 1px solid #E6E6E6;text-align:center;padding-top: 5px; padding-bottom: 5px;cursor: pointer;">
		<ul style="list-style:none;padding-left:1%;">
			<li style="display:inline;">perfil de contacto<li>
			<li style="display:inline;">eliminar chat<li>
		</ul>
	</div>
	<!-- Send message input box -->
	<div class="row" style="position:absolute;bottom:2px;width:100%;padding-bottom:2%;">
		<div class="col-md-10">
			<textarea class="span6 form-control" rows="2" placeholder="..." style="width:100%;resize: none !important;"></textarea>
		</div>
		<div class="col-md-2">
			<button class="btn btn-link">Send</button>
		</div>
	</div>
@endsection

@section('right_box')
    <div class="row">
		<div class="col-md-12" style="padding-top: 2%; padding-left: 5%; padding-right: 5%;">
			<input type="text" placeholder="Buscar contacto" class="form-control" style="width:100%;">
			<br>
			<div id="conversation-threads" class="container-fluid"></div>
		</div>
	</div>
@endsection

@section('scripts')
	@parent
	<input id="is_recruiter_conversations_page" type="hidden" value="true"/>
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection

@section('head')
	@parent
	<style>
		.box-messages {
			position: absolute;
			top: 15%;
			width: 95%;
			height: 46vh;
			overflow-y: auto;
		}
		#container-for-messages {
			width: 100%;
			height: 100%;
			border-collapse:separate; 
            border-spacing:0 15px;
		}
		.message-content-container-sender {
			padding: 2%;
			border-radius: 15px;
			background-color: #004878;
			color: #FFF;
			font-weight: bold;
		}
		.message-content-container-receiver {
			padding: 2%;
			border-radius: 15px;
			background-color: #18A8D8;
			color: #FFF;
		}
	</style>
@endsection