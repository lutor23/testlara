@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Edit Dashboard {{ $dashboard->id }}</h1>

    {!! Form::model($dashboard, [
        'method' => 'PATCH',
        'url' => ['/dashboard', $dashboard->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

        @include('dashboard._form', ['submitButton'=>'Update'])

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