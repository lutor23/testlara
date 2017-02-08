@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Team {{ $team->id }}
        <a href="{{ url('team/' . $team->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Team"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['team', $team->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Team',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $team->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $team->name }} </td></tr><tr><th> Director Id </th><td> {{ $team->director->name }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
