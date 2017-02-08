@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Rule</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/rules', 'class' => 'form-horizontal', 'files' => true]) !!}

                                    <div class="form-group {{ $errors->has('widget_id') ? 'has-error' : ''}}">
                {!! Form::label('widget_id', 'Widget Id', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::number('widget_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('widget_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('keyvalue') ? 'has-error' : ''}}">
                {!! Form::label('keyvalue', 'Keyvalue', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('keyvalue', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('keyvalue', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('operator') ? 'has-error' : ''}}">
                {!! Form::label('operator', 'Operator', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::select('operator', ['>'=>'>', '<'=>'<', '='=>'='], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('operator', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('threshold') ? 'has-error' : ''}}">
                {!! Form::label('threshold', 'Threshold', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('threshold', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('threshold', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('warnlevel') ? 'has-error' : ''}}">
                {!! Form::label('warnlevel', 'Warnlevel', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::select('warnlevel', ['info'=>'info', 'warning'=>'warning', 'critical'=>'critical'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('warnlevel', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection