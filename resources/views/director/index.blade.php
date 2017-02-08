@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Director <a href="{{ url('/director/create') }}" class="btn btn-primary btn-xs" title="Add New Director"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    
    
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Name </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($director as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="{{ url('/director/' . $item->id) }}" class="btn btn-success btn-xs" title="View Director"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/director/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Director"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/director', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Director" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Director',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $director->render() !!} </div>
    </div>

</div>
@endsection
