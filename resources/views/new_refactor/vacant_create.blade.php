@extends('new_refactor.single_square_box')

@section('page_title', 'Create new job')

@section('center_box')
    <section>
        <div id="form_errors" class="errors_form">
            
        </div>
        @include('new_refactor.forms.new_job')
        <input id="is_recruiter_job_creation_page" type="hidden" value="true"/>
    </section>
@endsection

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/vacants.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/home_talent.css') }}">
	<!-- <style type="text/css">/* Weird search bar style for firefox */#prependedtext{line-height:14px!important}.btn-mobile-navigation{position:absolute;top:20%;right:5%}.btn-mobile-navigation>img{width:13px}.responsive-menu-main{z-index:100;left:0;position:absolute;top:100%;background:#ddd;width:100%;margin:0!important;padding:0!important}.list-menu-responsive{list-style-type:none;padding-left:0!important}.list-menu-responsive>li{padding:4%;color:#000;font-weight:700;border-bottom:1px solid #fff}.list-menu-responsive>li:last-child{border-bottom-style:none}.img_list_item_mobile_menu{display:inline;float:left;clear:both;margin-right:2%;width:8%;color:#000;font-size:21px}.img_list_item_mobile_menu svg{margin-right:12px!important}</style> -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/responsive_styles.css')}}">
    <style>
        .row > .col-md-4 {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .btn-add-new-vacant {
            margin-left: 0%;
            width: 100% !important;
        }
        @media screen and (min-width: 800px) {
            .form-content-new-job {
                height: 60vh !important;
            }
        }
        .errors_form {
            width: 96%;
            margin-left: 2%;
            margin-right: auto;
        }
        .no-boot-padding-col {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .higher-height-field {
            height: 115px !important;
        }
    </style>
@endsection

@section('scripts')
    @parent
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection