@extends('layouts.minimal')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Rules</div>
                    <div class="panel-body">

                        <a href="{{ url('/rules/min/create/'.$id) }}" class="btn btn-primary btn-xs" title="Add New Rule"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> Keyvalue </th>
                                        <th> Operator </th>
                                        <th> Threshold </th>
                                        <th> Warnlevel </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rules as $item)
                                    <tr>
                                        <td>{{ $item->keyvalue }}</td>
                                        <td>{{ $item->operator }}</td>
                                        <td>{{ $item->threshold }} </td>
                                        <td>{{ $item->warnlevel }} </td>

                                        <td>
                                            <a href="{{ url('/rules/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Rule"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/rules', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Rule" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Rule',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $rules->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection