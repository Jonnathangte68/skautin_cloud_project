@extends('templates.base_vacant')

@section('title', 'Skauting discover')

@section('content')

    <h2 class="letraextragrande left-header"><b>New Job</b></h2>
    <div class="container borderyseccion">
        <section class="results">

            <div class="errors" style="padding: 2%;"></div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p style="color:red;font-weight:bold;">{{ $error }}</p>
                @endforeach
            @endif

        	{!! Form::open(['action' => 'VacantController@store', 'files' => true]) !!}

            @include('vacant.form_fields')

            {!! Form::close() !!}


        </section>
    </div>
@endsection

@section('scripts')
    @parent
    {!! Html::script('js/createjob.js') !!}
@endsection
