@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Create New Datasource</h1>
    <hr/>


    {!! Form::open(['url' => '/datasources', 'class' => 'form-horizontal', 'files' => true]) !!}
            {{ csrf_field() }}

        @include('datasources._form', ['submitButton'=>'Create'])

    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection


@include('datasources._scripts')