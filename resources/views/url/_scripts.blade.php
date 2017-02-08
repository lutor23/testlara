@section('scripts')
@parent


<script type="text/javascript" >

	$(document).ready(function() {
			$(".select-picker").select2({ 
				placeholder: "Select..", 
				tags: true
			});

	});

</script>	

@endsection