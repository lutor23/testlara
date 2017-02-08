@extends('layouts.app')

@section('main-content')
<div class="container">

<a href="/widgets/preview" class="btn  btn-xs pull-right" title="Preview"><span class="glyphicon glyphicon-th-large" aria-hidden="true"/></a>
<a href="/widgets" class="btn btn-xs pull-right" title="List view"><span class="glyphicon glyphicon-th-list" aria-hidden="true"/></a>


    <h1>Widgets <a href="{{ url('/widgets/create') }}" class="btn btn-primary btn-xs" title="Add New Widget"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    

    @include('layouts.flash')

    <div class="table">
        <table class="table table-bordered table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th>status</th>
                    <th>preview</th>
                </tr>
            </thead>
            <tbody>
            @foreach($widgets as $widget)
                <tr>
                    <td>
                    {{ $widget->warn_status}}
                    </td>
                    <td>@include('widgets._preview', $widget) 
                    
                        <a href="{{ url('/widgets/' . $widget->id) }}" class="btn btn-success btn-xs" title="View Widget"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/widgets/' . $widget->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Widget"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/widgets', $widget->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Widget" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
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

