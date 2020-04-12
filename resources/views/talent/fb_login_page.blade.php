@extends('templates.blank')





@section('content')

@endsection








@section('head')
    @parent


@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        $(document).ready(function() {
            window.location.replace("http://");
        });
    </script>
@endsection