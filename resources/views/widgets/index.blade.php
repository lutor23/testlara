@extends('layouts.app')

@section('main-content')
<div class="container">





<a href="/widgets/preview" class="btn  btn-xs pull-right" title="Preview"><span class="glyphicon glyphicon-th-large" aria-hidden="true"/></a>
<a href="/widgets" class="btn btn-xs pull-right" title="List view"><span class="glyphicon glyphicon-th-list" aria-hidden="true"/></a>


    <h1>Widgets <a href="{{ url('/widgets/create') }}" class="btn btn-primary btn-xs" title="Add New Widget"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    
    <div class="table">
        <table class="table table-bordered table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th>Id</th><th>Type</th><th>Widget</th> <th> Title </th><th> Datasource </th> <th>dashboards</th> <th> Created by</th> <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($widgets as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td> 
                    @if ($item->infobox_type=='tablewidget') 
                        <span class="fa fa-table">
                    @elseif ($item->infobox_type=='chart')
                        <span class="fa fa-bar-chart"
                    @else 
                        <span class="glyphicon glyphicon-th-large">
                    @endif 
                    </td>
                    <td> {{$item->infobox_type}} </td>
                    <td>{{ $item->title }}</td><td>{{ $item->datasource->name }}</td> <td>{{ $item->dashboards->pluck('title')->implode(',') }}</td>
                    <td>{{ $item->user->name }} </td>
                    <td>
                        <a href="{{ url('/widgets/' . $item->id) }}" class="btn btn-success btn-xs" title="View Widget"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/widgets/' . $item->id . '/preview') }}" class="btn btn-primary btn-xs" title="Preview widget"><span class="glyphicon glyphicon-th-large" aria-hidden="true"/></a>
                        <a href="{{ url('/widgets/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Widget"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/widgets', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Widget" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs delete-btn',
                                    'title' => 'Delete Widget',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection


