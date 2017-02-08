@extends('layouts.app')

@section('contentheader_title', 'Show widget')
@section('contentheader_description', 'Shows the current widget')


@section('main-content')


<div class="container">

    <h1>Widget {{ $widget->id }}
        <a href="{{ url('widgets/' . $widget->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Widget"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        <a href="{{ url('widgets/' . $widget->id . '/preview') }}" class="btn btn-primary btn-xs" title="Preview widget"><span class="glyphicon glyphicon-th-large" aria-hidden="true"/></a>



        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['widgets', $widget->id],
            'style' => 'display:inline'
        ]) !!}


            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Widget',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">


        @include('widgets._preview')


        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $widget->id }}</td>
                </tr>
                <tr><th> Title </th><td> {{ $widget->title }} </td></tr><tr><th> Datasource Id </th><td> {{ $widget->datasource_id }} </td></tr><tr><th> Detail </th><td> {{ $widget->detail }} </td></tr>
            </tbody>
        </table>
    </div>



</div>





@endsection

