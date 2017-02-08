@extends('layouts.app')

@section('htmlheader')
	@parent
    {!! Charts::assets() !!}        
@endsection

@section('main-content')
<div class="container">

	<h1><center>Create New Widget</center></h1>
	<hr/>

	{!! Form::open(['url' => '/widgets', 
					'class' => 'form-horizontal', 
					'files' => true]) !!}

		@include('widgets._form', ['submitButton'=>'Create'])
	

	{!! Form::close() !!}


	@include('errors.list')

</div>

@endsection

@include('widgets._scripts')