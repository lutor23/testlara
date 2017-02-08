
@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

    <!-- Content Wrapper. Contains page content -->
    <div>
        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@section('scripts')
    @include('layouts.partials.scripts')
    
@show