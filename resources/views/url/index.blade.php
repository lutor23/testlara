@extends('layouts.app')

@section('main-content')
<div class="container">

    <h1>Url <a href="{{ url('/url/create') }}" class="btn btn-primary btn-xs" title="Add New Url"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th>Title</th><th> Url </th><th> Folder </th><th>created by </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($url as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->folders->pluck('name')->implode(',') }} </td>
                    <td>{{ $item->user->name }} </td>
                    <td>
                        <a href="{{ url('/url/' . $item->id) }}" class="btn btn-success btn-xs" title="View Url"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/url/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Url"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/url', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Url" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Url',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $url->render() !!} </div>
    </div>

</div>
@endsection
