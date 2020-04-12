@extends('new_refactor.two_square_box')

@section('title', 'Skauting find ideal Persons')

@section('page_title', 'Talents')

@section('left_box')
    <div class="container-content">
        <div id="headerTalentInfoSection" class="row talent-profile-header"></div>
        <div id="videoPanel" class="video-container">
            <video id="mainVideoProfileTalent" class="profile-video-container" poster="https://cdn.mos.cms.futurecdn.net/CBLAP9KSfyz8QGf33WZMSP-1200-80.jpg" controls="controls"></video>
        </div>
    </div>
@endsection

@section('right_box')
    <div id="right_box_other_videos" class="container-content">
        
    </div>
@endsection

@section('scripts')
    @parent
    <input type="hidden" id="is_preview_talent_profile_page" value="true">
	<script type="text/javascript" src="/js/new_refactor/html_template_functions.js"></script>
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection

@section('head')
	@parent
    {{ Html::style('css/homerec.css') }}
    <style>
        .container-content {
            width: 100%;
            height: 100%;
            min-width: 100%;
            min-height: 100%;
            padding-top: 0.7rem !important;
        }
        .talent-profile-header {
            height: 10%;
        }
        .profile-pic-col {
            padding: 0px !important;
            height: 100%;
            padding-right: 7px !important;
            padding-top: 4px !important;
        }
        .profile-talent-image {
            width: 100%;
            height: 100%;
        }
        .talent-name-col {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .list-meta-info-hrz {
            padding: 0px !important;
            list-style: none;
        }
        .list-meta-info-hrz li {
            display: inline-block;
            /* You can also add some margins here to make it look prettier */
            zoom:1;
            *display:inline;
            /* this fix is needed for IE7- */
            margin: 1rem;
            margin-top: 0.2rem !important;
        }
        .list-meta-info-hrz li > span {
            text-align: center;
        }
        .centered {
            text-align: center;
        }
        .right-spaced {
            text-align: right;
        }
        .top-space-header {
            padding-top: 6%;
        }
        .profile-video-container {
            object-fit: contain;
            width: 100%;
            height: 100%;
            min-height: 100%;
        }
        .video-container {
            height: 90%;
            min-height: 90%;
            padding-top: 14px;
            padding-bottom: 10px;
            background-color: black;
        }
        .no-more-videos {
            font-style: italic;
        }
        .other-talent-videos-preview {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection