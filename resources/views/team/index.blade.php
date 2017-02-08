@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Team <a href="{{ url('/team/create') }}" class="btn btn-primary btn-xs" title="Add New Team"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    
    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Name </th><th> Director Id </th> <th>created by </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($team as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->director->name }}</td>
                    <td>{{ $item->user->name }} </td>
                    <td>
                        <a href="{{ url('/team/' . $item->id) }}" class="btn btn-success btn-xs" title="View Team"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/team/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Team"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/team', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Team" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Team',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $team->render() !!} </div>
    </div>

</div>
@endsection
