@extends('new_refactor.two_square_box')

@section('title', 'Skauting find ideal Persons')

@section('page_title', 'Talents')

@section('left_box')
	<p style="margin-top: 15px;font-family:'Calibri';font-weight: bold;font-size:1.2em;margin-left:15px;"><span id="replace_results_talents"></span> New Prospects for you</p><br>
	<div class="inner-content-videos">
		<div id="main_video_list_content" class="row">
		</div>
	</div>
@endsection

@section('right_box')
	<div class="row" style="margin-top: 10px;">
		<div class="col-md-4"></div>
		<div class="col-md-1"><div id="following-indicatorx" style="margin-left:5px;border:1px solid black;width: 12px;height:12px;border-radius: 50%;border-color:#E6E6E6;"></div></div>
		<div class="col-md-1"><div id="views-indicatorx" style="margin-left:5px;border:1px solid black;width: 12px;height:12px;border-radius: 50%;border-color:#E6E6E6;"></div></div>
		<div class="col-md-1"><div id="followers-indicatorx" style="margin-left:5px;border:1px solid black;width: 12px;height:12px;border-radius: 50%;border-color:#E6E6E6;"></div></div>
		<div class="col-md-1"><div id="favourites-indicatorx" style="margin-left:5px;border:1px solid black;width: 12px;height:12px;border-radius: 50%;border-color:#E6E6E6;"></div></div>
		<div class="col-md-4"></div>
	</div>
	<div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 94%;min-height:94%;">
	<div class="carousel-inner" style="height: 94%;">
		<div class="item active">
			<h2 id="following-indicator">
				&nbsp;&nbsp;&nbsp;
				Following (<span id="following-count"></span>)
			</h2>
			<br>
			<div id="following-bar-content">
			</div>
		</div>

		<div class="item">
			<h2 id="views-indicator">
				&nbsp;&nbsp;&nbsp;
				Views (<span id="views-count"></span>)
			</h2>
			<br>
			<div id="views-bar-content">
			</div>
		</div>

		<div class="item">
			<h2 id="followers-indicator">
				&nbsp;&nbsp;&nbsp;
				Followers (<span id="followers-count"></span>)
			</h2>
			<br>
			<div id="followers-bar-content">
			</div>
		</div>

		<div class="item">
			<h2 id="favourites-indicator">
				&nbsp;&nbsp;&nbsp;
				Favourites (<span id="favourites-count"></span>)
			</h2>
			<br>
			<div id="favourites-bar-content">
			</div>
		</div>

		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

@endsection

@section('scripts')
	@parent
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection

@section('head')
	@parent
	{{ Html::style('css/homerec.css') }}
	<style>
		.inner-content-videos {
			width: 100%;
			height: 350px;
			padding-left: 1.5em;
			padding-right: 1.5em;
		}
		.no-padding-trail {
			padding-left:0px !important;
			padding-right:0px !important;
		}
		.vid-container {
			width: 100%;
			height: 100%;
			min-width: 100%;
			min-height: 100%;
			object-fit: cover;
		}
		.no-padding {
			padding-left: 0px !important;
			padding-top: 0px !important;
			padding-right: 0px !important;
			padding-bottom: 0px !important;
		}
		.carousel-control {
			color:black;
		}
		.carousel-control.left {
			background-image: none !important;
		}
		.carousel-control.right {
			background-image: none !important;
		}
		.active-indicator {
			background-color:blue !important;
			border-color:royalblue !important;
		}
		.rounded-profile-image {
			width: 100%;
			padding-top: 10%;
			padding-bottom: 10%;
			border-radius: 50%;
		}
	</style>
	<style>
		/* The Overlay (background) */
		.overlay {
		/* Height & width depends on how you want to reveal the overlay (see JS below) */   
		height: 100%;
		width: 0;
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		left: 0;
		top: 0;
		background-color: rgb(0,0,0); /* Black fallback color */
		background-color: rgba(0,0,0, 0.9); /* Black w/opacity */
		overflow-x: hidden; /* Disable horizontal scroll */
		transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
		}

		/* Position the content inside the overlay */
		.overlay-content {
		position: relative;
		top: 25%; /* 25% from the top */
		width: 100%; /* 100% width */
		text-align: center; /* Centered text/links */
		margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
		}
		/* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
		@media screen and (max-height: 450px) {
		.overlay a {font-size: 20px}
		.overlay .closebtn {
			font-size: 40px;
			top: 15px;
			right: 35px;
		}
		}
	</style>
@endsection