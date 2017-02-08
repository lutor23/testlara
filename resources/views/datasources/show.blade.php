@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Datasource {{ $datasource->id }}
        <a href="{{ url('datasources/' . $datasource->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Datasource"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['datasources', $datasource->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Datasource',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $datasource->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $datasource->name }} </td></tr>
                <tr><th> Param </th><td> {{ $datasource->param }} </td></tr>
                <tr><th> Refresh in mins</th><td> {{ $datasource->refresh }} </td></tr>
                <tr><th> Last collect </th><td> {{ $datasource->last_collect }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
