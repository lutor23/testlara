


       <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
            {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
            {!! Form::label('url', 'Url', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('url', null, ['class' => 'form-control']) !!}
                {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('folders', 'Folder', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('folders[]', $folders, $folder_list, ['class' => 'form-control select-picker', 'multiple'=>'multiple']) !!}
            </div>
        </div>


        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>