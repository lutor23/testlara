        


            
            <div class="form-group {{ $errors->has('ds_type') ? 'has-error' : ''}}">
                {!! Form::label('ds_type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('ds_type', ['json'=>'JSON', 'dbconnection'=>'DB connection'], null, ['class' => 'form-control', 'placeholder'=>'Select...']) !!}
                    {!! $errors->first('ds_type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div id="div_connection" class="form-group {{ $errors->has('connection_id') ? 'has-error' : ''}}">
                {!! Form::label('connection_id', 'Connection', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('connection_id', $connectionsList, null, ['class' => 'form-control' , 'placeholder'=>'Select...']) !!}
                    {!! $errors->first('connection_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div id="div_name" class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div id="div_param" class="form-group {{ $errors->has('param') ? 'has-error' : ''}}">
                {!! Form::label('param', 'param', ['class' => 'col-sm-3 control-label', 'id'=>'param_label' ]) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('param', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('param', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div id="div_refresh" class="form-group {{ $errors->has('refresh') ? 'has-error' : ''}}">
                {!! Form::label('refresh', 'Refresh rate (minutes)', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('refresh', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('refresh', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div id="div_timeout" class="form-group {{ $errors->has('timeout') ? 'has-error' : ''}}">
                {!! Form::label('timeout', 'Http timeout (seconds)', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('timeout', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('timeout', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div id="div_email" class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email on error', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>




           <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Test datasource url</h4>
                </div>
                <div class="modal-body">
                  <div id="modalResultInfo" class="alert"></div>
                    <div id="modalBody"  class="pre-scrollable">

                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
          <!-- End of modal -->

          <input type="hidden" name="jsonoutput" id="jsonoutput"/>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                  <button type="button" class="btn btn-primary btn-sm form-control" id="previewBtn">Test</button>
            </div>
            <div class="col-sm-3">
                {!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control disabled']) !!}
            </div>
        </div>