@extends('layouts.app')

@section('contentheader_title', $dashboard->title)


@section('htmlheader')
@parent
	    <meta http-equiv="refresh" content="30" />
	    {!! Charts::assets() !!}        

@endsection

@section('main-content')

        @foreach ($dashboard->arranged_widgets as $widget)
			@include('widgets._preview', $widget)
        @endforeach

@endsection



