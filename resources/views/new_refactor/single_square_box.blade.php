@extends('new_refactor.base')

@section('title', 'Skauting find ideal Persons xx')


@section('content')
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="height: 70vh;">
            <h3 style="float:left;clear:both;font-size: 2.3rem;width:100%;">
                @yield('page_title')
            </h3>
            <div class="col-sm-12 scrollbar-without-scroll" style="border: 1px solid #E6E6E6;min-height:100%;max-height: 100%;background-color: #FFFFFF;padding-left: 5%;padding-right: 5%;padding-top: 2%;padding-bottom: 2%;">
                @yield('center_box')
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
@endsection