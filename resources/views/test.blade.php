@extends('layouts.app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')

        <button type="button" class="btn btn-primary" id="showtoast">Show Toast</button>

@endsection



@section('scripts')
@parent

<script>


    $('#showtoast').click(function() {
       toastr.success('Widget has been added success!')
    });


</script>

@endsection