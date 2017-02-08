@extends('layouts.app')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Rule {{ $rule->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('rules/' . $rule->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Rule"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['rules', $rule->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Rule',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $rule->id }}</td>
                                    </tr>
                                    <tr><th> Widget Id </th><td> {{ $rule->widget_id }} </td></tr><tr><th> Keyvalue </th><td> {{ $rule->keyvalue }} </td></tr><tr><th> Operator </th><td> {{ $rule->operator }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection