@extends('new_refactor.base')

@section('title', 'Skauting find ideal Persons xx')

@section('content')
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="height: 70vh;">
            <h3 style="float:left;clear:both;font-size: 2.3rem;width:100%;">
                @yield('page_title')
            </h3>
            <div class="col-sm-8 scrollbar-without-scroll" style="border: 1px solid #E6E6E6;min-height:100%;max-height: 100%;background-color: #FFFFFF;padding-left: 2%;padding-right: 2%;">
                @yield('left_box')
            </div>
            <div class="col-sm-4" style="padding-left: 0%;min-height:100%;height:100%;">
                <div class="scrollbar-without-scroll" style="border: 1px solid #E6E6E6;min-height:100%;max-height: 100%;background-color: #FFFFFF;padding-left: 2%;padding-right: 2%;border-left-style:none!important;">
                @yield('right_box')
                </div>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
@endsection

@section('scripts')
	@parent
@endsection

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="/css/new_refactor/modals.css" />
@endsection