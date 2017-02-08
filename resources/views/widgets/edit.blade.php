@extends('layouts.app')

@section('htmlheader')
    @parent
    {!! Charts::assets() !!}        
@endsection

@section('main-content')
<div class="container">

    <h1>Edit Widget {{ $widget->id }}</h1>

    {!! Form::model($widget, [
        'method' => 'PATCH',
        'url' => ['/widgets', $widget->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

        @include('widgets._form', ['submitButton'=>'Update'])    


    {!! Form::close() !!}

    @include('errors.list')

</div>
@endsection


@include('widgets._scripts')

