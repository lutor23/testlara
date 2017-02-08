
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('dbtype') ? 'has-error' : ''}}">
                {!! Form::label('dbtype', 'DB driver', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::select('dbtype', ['pgsql'=>'postgres', 'mysql'=>'mysql', 'oracle'=>'oracle'], null, ['class' => 'form-control']) !!}
                    {!! $errors->first('dbtype', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            
            <div class="form-group {{ $errors->has('host') ? 'has-error' : ''}}">
                {!! Form::label('host', 'Host', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('host', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('host', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('dbname') ? 'has-error' : ''}}">
                {!! Form::label('dbname', 'DB name', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('dbname', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('dbname', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                {!! Form::label('username', 'Username', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('username', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-4 col-md-6">
                    {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!}
                </div>
            </div>


