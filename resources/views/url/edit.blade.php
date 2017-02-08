@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Edit Url {{ $url->id }}</h1>

    {!! Form::model($url, [
        'method' => 'PATCH',
        'url' => ['/url', $url->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

        @include('url._form', ['submitButton'=>'Update'])    


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

@include('url._scripts')