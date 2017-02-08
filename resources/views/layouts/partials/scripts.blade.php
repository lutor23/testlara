<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/adminlte-app.min.js') }}" type="text/javascript"></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->


 <!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css')}}">
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>


<!-- Range slider -->
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap-slider/bootstrap-slider.min.css')}}">
<script src="{{ asset('/plugins/bootstrap-slider/bootstrap-slider.min.js')}}"></script>


<!-- Select2 -->
<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>

<!-- Toastr notifications -->
<link href="{{ asset('/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>


<!-- Sweet alerts -->
<link href="{{ asset('/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('/plugins/sweetalert/sweetalert.min.js') }}"></script>


<script>  
  $(function () {
    $(".dataTable").DataTable();
	   
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "7000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}


	@if(Session::has('flash_message'))
	    var type = "{{ Session::get('alert-type', 'success') }}";
	    switch(type){
	        case 'info':
	            toastr.info("{{ Session::get('flash_message') }}");
	            break;
	        
	        case 'warning':
	            toastr.warning("{{ Session::get('flash_message') }}");
	            break;

	        case 'success':
	            toastr.success("{{ Session::get('flash_message') }}");
	            break;

	        case 'error':
	            toastr.error("{{ Session::get('flash_message') }}");
	            break;

	        default:
	            toastr.success("{{ Session::get('flash_message') }}");
	            break;	        
	    }
	@endif


   });

	//
  	//TESTING.....
  	//
	// $('.delete-btn').on('click', function(){
	// 	  swal({   
	// 		    title: "Are you sure?",
	// 		    text: "You will not be able to recover this lorem ipsum!",         
	// 		    type: "warning",   
	// 		    showCancelButton: true,   
	// 		    confirmButtonColor: "#DD6B55",
	// 		    confirmButtonText: "Yes, delete it!", 
	// 		    closeOnConfirm: false 
	// 	  }, 
	// 	    function(){   
	// 	      $("#myform").submit();
	// 	  });
	// })

 </script>


@include('layouts.partials.algolia')


