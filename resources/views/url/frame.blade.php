@extends('layouts.app')


@section('contentheader_title', "<a href='$url->url' target='_blank'>$url->title</a>" )
@section('contentheader_description', "<a href='$url->url' target='_blank'>$url->url</a>" )

@section('htmlheader_title')
        Home
@endsection


@section('main-content')
	<object data=" {!! $url->url !!} " width="100%" height="1200"></object><br />

@endsection