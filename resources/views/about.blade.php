@extends('templates.base')

@section('title', 'El titulo')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset($css_file)}}">
@endsection

@section('content')
    {!! $html !!}
@endsection