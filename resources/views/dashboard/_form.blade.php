    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
          {!! Form::text('title', null, ['class' => 'form-control']) !!}
          {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
    </div>
     
    <div class="form-group {{ $errors->has('team_id') ? 'has-error' : ''}}">
        {!! Form::label('team_id', 'Team Id', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::select('team_id', $teamList, null, ['class' => 'form-control']) !!}
            {!! $errors->first('team_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>