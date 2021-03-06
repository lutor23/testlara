@extends('layouts.app')

@section('main-content')
<div class="container">



    <h1>Edit Team {{ $team->id }}</h1>

    {!! Form::model($team, [
        'method' => 'PATCH',
        'url' => ['/team', $team->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('director_id') ? 'has-error' : ''}}">
                {!! Form::label('director_id', 'Director Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('director_id', $directorList, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('director_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>



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