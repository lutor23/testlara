@extends('layouts.app')



@section('main-content')
<div class="container">

    <h1>Url {{ $url->id }}
        <a href="{{ url('url/' . $url->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Url"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['url', $url->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Url',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $url->id }}</td>
                </tr>
                <tr><th> Url </th><td> {{ $url->url }} </td></tr><tr><th> Team Id </th><td> </td></tr><tr><th> Description </th><td> {{ $url->description }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
