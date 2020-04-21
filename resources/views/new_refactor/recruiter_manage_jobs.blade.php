@extends('new_refactor.single_square_box')

@section('page_title', 'Jobs posted')

@section('center_box')
    <section class="results hmatch-large">
        <div class="row searchrow">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <select id="selectbasic" name="selectbasic" class="form-control controlly-notbrak">
                <option value="1">Sort by...</option>
                <option value="2">Newest</option>
                <option value="3">Oldest</option>
            </select>
        </div>
        </div>
        <div id="listed_jobs" class="row"></div>
        <a href="{{route('create_new_job')}}" style="position: absolute; bottom: 15px; right: 5%;">Add (+) new vacant...</a>
        <input id="is_recruiter_jobs_information_page" type="hidden" value="true">
    </section>
@endsection

@section('head')
    @parent
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="/js/new_refactor/html_template_functions.js"></script>
	<script type="text/javascript" src="/js/new_refactor/recruiter.js"></script>
@endsection
