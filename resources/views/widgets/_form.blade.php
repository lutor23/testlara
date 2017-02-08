

	<!-- infobox type -->
	<div class="form-group {{ $errors->has('infobox_type') ? 'has-error' : ''}}">
		{!! Form::label('infobox_type', 'Infobox type', ['class' => 'col-sm-3 control-label threshold-class']) !!}
		<div class="col-sm-6">
			{!! Form::select('infobox_type', 
			[	
			 	'infobox'=>'Infobox small', 
			 	'infobox_moreinfo'=>'Infobox large',
				'infoboxcounter'=>'Infobox counter',				
				'tablewidget'=>'Table',
				'chart'=>'Chart'
			], 
			null, ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Select type of widget..']) !!}
			{!! $errors->first('infobox_type', '<p class="help-block">:message</p>') !!}
		</div>
	</div>


	<!-- Title -->
	<div id="div_title" class="divs form-group {{ $errors->has('title') ? 'has-error' : ''}}">
		{!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Enter title...' ]) !!}
			{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- size -->
	<div id="div_size" class="divs form-group {{ $errors->has('size') ? 'has-error' : ''}}">
		{!! Form::label('size', 'Size', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			<input id="size" data-slider-id='sizeSlider' type="text" data-slider-min="2"  data-slider-max="6" data-slider-step="1" data-slider-value="3"/>
		</div>
	</div>

	<!-- icon -->
	<div id="div_icon" class="divs form-group {{ $errors->has('icon') ? 'has-error' : ''}}">
		{!! Form::label('icon', 'Icon', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">

			{!! Form::button('icon', ['class' => 'btn btn-default', 'data-icon'=>"$widgetIcon", 'role'=>'iconpicker' ,'name'=>'icon']  )  !!}
			{!! $errors->first('icon', '<p class="help-block">:message</p>') !!}

		</div>
	</div>



	<!--  chart category -->
	<div id="div_chart_category" class="divs divs-charts form-group {{ $errors->has('chart_category') ? 'has-error' : ''}}">
		{!! Form::label('chart_category', 'Chart category', ['class' => 'col-sm-3 control-label threshold-class']) !!}

		<div class="col-sm-6">
	  		<label class="radio-inline">
	          <input name="chart_category" id="radio1" value="single" type="radio" {{ $categoryL=="single" ? 'CHECKED' : ''}} > 
	          	single series
	        </label>

	        <label class="radio-inline">
	          <input name="chart_category" id="radio2" value="multicolumn" type="radio"{{ $categoryL=="multicolumn" ? 'CHECKED' : ''}}> 
	          	multi series/By column
	        </label>

	        <label class="radio-inline">
	          <input name="chart_category" id="radio3" value="multirow" type="radio"{{ $categoryL=="multirow" ? 'CHECKED' : ''}}> 
	          	multi series/By row
	        </label>

  		</div>

		<div class="chart-names">   
			<a href="#" class="chart-names">[see expected JSON]</a>
		</div>

	</div>

	<div class="form-group">
		{!! Form::label('', '', ['class' => 'col-sm-3 control-label']) !!}

		<div class="col-sm-6">
			<div class="popup" style="display:none;"> <img src="{{asset('/img/samplesjson.png')}}"></div>
		</div>
	</div>

	<!-- chart type  -->
	<div id="div_chart_type" class="divs divs-charts form-group {{ $errors->has('chart_type') ? 'has-error' : ''}}">
		{!! Form::label('chart_type', 'Chart type', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('chart_type', $charttypeList, null, ['class' => 'form-control', 'placeholder'=>'Select...'] ) !!}
			{!! $errors->first('chart_type', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- chart library  -->
	<div id="div_chart_library" class="divs divs-charts form-group {{ $errors->has('chart_library') ? 'has-error' : ''}}">
		{!! Form::label('chart_library', 'Chart library', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('chart_library', $chartlibraryList, null, ['class' => 'form-control', 'placeholder'=>'Select...'] ) !!}
			{!! $errors->first('chart_library', '<p class="help-block">:message</p>') !!}
		</div>
	</div>




	<!-- chart dimensions  -->
	<div id="div_dimensions" class="divs divs-charts form-group {{ $errors->has('dimensions') ? 'has-error' : ''}}">
		{!! Form::label('dimensions', 'Dimensions', ['class' => 'col-sm-3 control-label threshold-class']) !!}
		
		<div class="col-sm-3">
			{!! Form::number('chart_dimensiony', 300, ['class' => 'form-control', 'placeholder'=>'height', 'id'=>'chart_dimensiony' ]) !!}
		</div>

		<div class="col-sm-3">
			{!! Form::number('chart_dimensionx', 600, ['class' => 'form-control', 'placeholder'=>'width', 'id'=>'chart_dimensionx' ]) !!}
		</div>

	</div>


	<!-- datasource and preview  -->
	<div id="div_datasource" class="divs form-group {{ $errors->has('datasource_id') ? 'has-error' : ''}}">
		{!! Form::label('datasource_id', 'Datasource', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('datasource_id', $datasourceList, null, ['class' => 'form-control select-picker', 'placeholder'=>'Select...', 'required' => 'required']) !!}
			{!! $errors->first('datasource_id', '<p class="help-block">:message</p>') !!}
		</div>

		<div>   
			<button type="button" class="btn btn-info btn-sm" id="previewBtn"  data-toggle="modal" data-target="#myModal2">preview</button>
		</div>
	</div>




	<!-- chart labels column  -->
	<div id="div_chart_labels" class="divs divs-charts form-group {{ $errors->has('chart_labels') ? 'has-error' : ''}}">
		{!! Form::label('chart_labels', 'Horizontal X Axis labels', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('chart_labels', $fieldnameList, null, ['class' => 'form-control', 'placeholder'=>'Select...'] ) !!}
			{!! $errors->first('chart_labels', '<p class="help-block">:message</p>') !!}
		</div>
	</div>


	<!-- chart values column  -->
	<div id="div_chart_values" class="divs divs-charts divs-charts-row form-group {{ $errors->has('chart_values') ? 'has-error' : ''}}">
		{!! Form::label('chart_values', 'Y Values', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('chart_values', $fieldnamenumericList, null, ['class' => 'form-control', 'placeholder'=>'Select value field...'] ) !!}
			{!! $errors->first('chart_values', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- chart multiseries by Row  -->
	<div id="div_chart_dataset" class="divs divs-charts-row form-group {{ $errors->has('chart_dataset') ? 'has-error' : ''}}">
		{!! Form::label('chart_dataset', 'Row header', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('chart_dataset', $fieldnameList, null, ['class' => 'form-control', 'placeholder'=>'Select...'] ) !!}
			{!! $errors->first('chart_dataset', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- chart multiseries by Column -->
	<div class="divs divs-charts-column">
		<div id="div_series_parent">

	        <div id="div_multiseries" class="form-group ">

				{!! Form::label('chart_library', 'Series1', ['class' => 'col-sm-3 control-label labelup']) !!}

	            <div class="col-sm-3">
					{!! Form::text('multiseriesName[]', null, ['class' => 'form-control series-name', 'required' => 'required', 'placeholder'=>'Series1 name...' , 'id'=>'multiseriesName']) !!}
	            </div>

	            <div class="col-sm-3">
	                {!! Form::select('multiseriesField[]', [], null, ['id'=>'multiseriesField[]', 'class' => 'form-control multiseriesClass',  'placeholder'=>'Select value field...' ]) !!}
	            </div>

	            <div class="actions">
	                <button type="button" class="btnCloneSeries">Add</button>
	                <button type="button" class="btnRemoveSeries">Remove</button>
	            </div>
	         </div>
	    </div>
	</div>



	<!-- group by   -->
	<div id="div_groupby" class="divs form-group {{ $errors->has('groupby_field') ? 'has-error' : ''}}">

		{!! Form::label('groupby_field', 'Group by', ['class' => 'col-sm-3 control-label']) !!}

		<div class="col-sm-4">
			{!! Form::select('groupby_field', $groupbyfieldList, null, ['class' => 'form-control', 'placeholder'=>'Select..', "id"=>"groupby_field" ] ) !!}
			{!! $errors->first('groupby_field', '<p class="help-block">:message</p>') !!}
		</div>
		
		<div class="col-sm-2">
			{!! Form::select('groupby_operator', ['count'=>'count', 'sum'=>'sum', 'avg'=>'avg'], null, ['class' => 'form-control', 'id'=>'groupby_operator']) !!}
		</div>
		
	</div>


	<!-- group by sumfield  -->
	<div id="div_groupby_opfield" class="divs form-group {{ $errors->has('groupby_opfield') ? 'has-error' : ''}}">

		{!! Form::label('groupby_opfield', 'Group by', ['class' => 'col-sm-3 control-label']) !!}

		<div class="col-sm-6">
			{!! Form::select('groupby_opfield', $groupbysumfieldList, null, ['class' => 'form-control', 'placeholder'=>'Select..', "id"=>"groupby_opfield" ] ) !!}
			{!! $errors->first('groupby_opfield', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- main value  -->
	<div id="div_detail" class="divs form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
		{!! Form::label('detail', 'Data', ['class' => 'col-sm-3 control-label threshold-class']) !!}
		
		<div class="col-sm-6">
			{!! Form::select('detail', $datasourcedotList, null, ['class' => 'select-picker form-control', 'placeholder'=>'Select...']) !!}
			{!! $errors->first('detail', '<p class="help-block">:message</p>') !!}
		</div>
	</div>


	<!-- main value units  -->
	<div id="div_units" class="divs form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
		{!! Form::label('detail', 'Units', ['class' => 'col-sm-3 control-label threshold-class']) !!}
		
		<div class="col-sm-6">
			{!! Form::text('units', null, ['class' => 'form-control', 'placeholder'=>'units', 'id'=>'units' ]) !!}
			{!! $errors->first('units', '<p class="help-block">:message</p>') !!}
		</div>
	</div>


	<!-- warn level -->
	<div id="div_warnlevel" class="divs form-group {{ $errors->has('infobox_level') ? 'has-error' : ''}}">
		{!! Form::label('infobox_level', 'Warning level', ['class' => 'col-sm-3 control-label threshold-class']) !!}
		<div class="col-sm-6">
			{!! Form::select('infobox_level', ['info'=>'info', 'warning'=>'warning', 'critical'=>'critical'], null, ['class' => 'form-control', 'required' => 'required']) !!}
			{!! $errors->first('infobox_level', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	


	<!-- threshold operator and comparision value -->
	<div id="div_threshold" class="divs form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
		{!! Form::label('threshold_operator', 'Warning threshold', ['class' => 'col-sm-3 control-label threshold-class']) !!}
		
		<div class="col-sm-1">
			{!! Form::select('threshold_operator', ['>'=>'>', '<'=>'<', '='=>'='], null, ['class' => 'form-control', 'id'=>'threshold_operator']) !!}
		</div>

		<div class="col-sm-5">
			{!! Form::text('threshold_value', null, ['id'=>'threshold_value', 'class' => 'form-control', 'id'=>'threshold_value',   'placeholder'=>'Enter threshold value...']) !!}
		</div>
	</div>


	<!-- additional detail -->
	<div id="div_additional_detail" class="divs form-group {{ $errors->has('additional_detail') ? 'has-error' : ''}}">
		{!! Form::label('additional_detail', 'Additional Detail', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('additional_detail', $datasourcedotList, null, ['class' => 'form-control select-picker']) !!}
			{!! $errors->first('additional_detail', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- moreinfo_url -->
	<div id="div_moreinfo_url" class="divs form-group {{ $errors->has('moreinfo_url') ? 'has-error' : ''}}">
		{!! Form::label('moreinfo_url', 'moreinfo URL', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::text('moreinfo_url', null, ['class' => 'form-control']) !!}
			{!! $errors->first('moreinfo_url', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<!-- rules button -->
	<div id="div_rules" class="form-group {{ $errors->has('infobox_level') ? 'has-error' : ''}}">
		<div class="col-sm-offset-3 col-sm-2">
			<button type="button"  id="btnRules" class="btn btn-info btn-sm">Manage alert rules</button>
		</div>
	</div>
	

	<!-- (Optional) add into a dashboard select -->
	<div id="div_dashboard" class="divs form-group {{ $errors->has('dashboard_list') ? 'has-error' : ''}}">
		{!! Form::label('dashboard_list', 'Add to dashboard (optional)', ['class' => 'col-sm-3 control-label']) !!}
		<div class="col-sm-6">
			{!! Form::select('dashboard_list[]', $dashboards, null, ['class' => 'form-control select-picker', 'multiple'=>'multiple']) !!}
		</div>
	</div>


	<!-- Modal to manage rules-->
	
	<div class="modal fade" id="myModalRules" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Manage widget alert rules.</h4>
				</div>
				<div class="modal-body" id="rules-modal-body">

					<div id="clonedInput1" class="clonedInput">
					  		<div class="row">
								<select id="rule_keyvalue[]" name="rule_keyvalue[]" class="col-md-3" placeholder="Select..">
									<option value=''>Select..</option>
									<option>(ALL)</option> 
									<option>(OTHERWISE)</option> 						
									<option>SIPPROXY1.IAD</option>
									<option>SIPPROXY1.ORD</option>        
								</select>

								<select id="rule_operator[]" name="rule_operator[]" class="col-md-1" placeholder='Select..'>
									<option value=''>Select..</option>
									<option>></option>
									<option><</option>
									<option>=</option>
								</select>

								<input type="text" class="col-md-3" id="rule_threshold[]" name="rule_threshold[]" placeholder="enter threshold">

								<select id="rule_warnlevel[]" name="rule_warnlevel[]" class="col-md-3" placeholder='Select..'>
									<option value=''>Select..</option>
									<option>info</option>        
									<option>success</option>        
									<option>warning</option>
									<option>critical</option>        
								</select>


							    <div class="actions">
							        <button type="button" class="clone"	>Add</button> 
							        <button type="button" class="remove">Remove</button>
							    </div>
					    	</div>
					</div>


				</div>

				<div class="modal-footer">
					<label class="pull-left">*Rules are order based. Default state if no rule matches is success.</label>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>


	<!-- End of modal -->





	
	<!-- submit button -->
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-3">
			{!! Form::submit($submitButton, ['class' => 'btn btn-primary form-control']) !!}
		</div>
	</div>

	

	<!-- Modal to show preview of datasource-->
	<div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Preview datasource last collected value.</h4>
				</div>
				<div class="modal-body">
					<div id="modalBody" class="pre-scrollable">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>


	<!-- horizontal line -->
	<br><hr style="width: 100%; color: black; height: 1px; background-color:black;" />

	<!-- preview -->
	<div class="form-group">
		<label class="col-sm-3 control-label"> PREVIEW </label>

		@include('widgets._preview_create')

	</div>





@section('htmlheader')
@parent
	<style>
		table {
		    border-collapse: separate;
		    border-spacing: 10px 20px;
		}
	</style>

@endsection



