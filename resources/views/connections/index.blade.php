@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                <div class="panel panel-default">
                    <div class="panel-heading">Connections</div>


                    <div class="panel-body">

                        <a href="{{ url('/connections/create') }}" class="btn btn-primary btn-xs" title="Add New Connection"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Name </th><th> Dbtype </th><th> Host </th><th>Name</th><th>User</th><th>created by</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($connections as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->dbtype }}</td><td>{{ $item->host }}</td>
                                        <td>{{ $item->dbname }} </td>
                                        <td> {{ $item->username }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a href="{{ url('/connections/' . $item->id) }}" class="btn btn-success btn-xs" title="View Connection"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/connections/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Connection"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/connections', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Connection" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Connection',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $connections->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection