@extends('layouts.app')

@section('contentheader_title', $director->name)


@section('htmlheader')
@parent
	    <meta http-equiv="refresh" content="30" />
@endsection

@section('main-content')


        @foreach ($director->arranged_widgets as $widget)
			@include('widgets._preview', $widget)
        @endforeach

@endsection



