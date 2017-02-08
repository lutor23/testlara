@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Edit Datasource {{ $datasource->id }}</h1>

    {!! Form::model($datasource, [
        'method' => 'PATCH',
        'url' => ['/datasources', $datasource->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

    @include('datasources._form', ['submitButton'=>'Update'])

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