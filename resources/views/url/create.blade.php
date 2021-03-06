@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Create New Url</h1>
    <hr/>

    {!! Form::open(['url' => '/url', 'class' => 'form-horizontal', 'files' => true]) !!}

        @include('url._form', ['submitButton'=>'Create'])    

        
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
