@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Dashboard <a href="{{ url('/dashboard/create') }}" class="btn btn-primary btn-xs" title="Add New Dashboard"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>

    

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Title </th><th> Team </th> <th>created by </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($dashboard as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td><td>{{ $item->team->name }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <a href="{{ url('/dashboard/' . $item->id) }}" class="btn btn-success btn-xs" title="View Dashboard"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/dashboard/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Dashboard"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/dashboard', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dashboard" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Dashboard',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $dashboard->render() !!} </div>
    </div>

</div>
@endsection
