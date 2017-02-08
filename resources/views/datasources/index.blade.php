@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Datasources <a href="{{ url('/datasources/create') }}" class="btn btn-primary btn-xs" title="Add New Datasource"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>

    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Name </th><th> type </th><th>ConnId</th><th> Refresh cycle (mins)</th><th>Last refresh</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datasources as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->ds_type }}</td>
                    <td>
                        @if (!empty($item->connection_id)) 
                            {{ $item->connection->name }}
                        @endif
                    </td>
                    <td>{{ $item->refresh }}</td>
                    <td>{{ $item->last_refresh }}</td>
                    <td>
                        <a href="{{ url('/datasources/' . $item->id) }}" class="btn btn-success btn-xs" title="View Datasource"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/datasources/' . $item->id . '/sync') }}" class="btn btn-primary btn-xs" title="sync now"><span class="glyphicon glyphicon-repeat" aria-hidden="true"/></a>
                        <a href="{{ url('/datasources/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Datasource"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/datasources', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Datasource" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Datasource',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $datasources->render() !!} </div>
    </div>

</div>
@endsection
