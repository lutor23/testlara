@extends('layouts.app')

@section('main-content4')
    <object type="text/html" data="http://validator.w3.org/" style="width:100%; min-height:400px; overflow: hidden;" >
        <p>backup content</p>
    </object>
@endsection



@section('main-content')

   	@include('widgets._preview', $widget)

@endsection


