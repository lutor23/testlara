
@section('scripts')
	@parent

	<!-- fontIconPicker core CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}" />

	<!-- Bootstrap-Iconpicker Iconset for Glyphicon -->
	<script type="text/javascript" src="{{ asset('plugins/bootstrap-iconpicker/js/iconset/iconset-glyphicon.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>


	<style>

		.modal-wide .modal-dialog 
		{
		  width: 50%; /* or whatever you wish */
		  max-height: 800px;
	      overflow-y: auto;
		}

		#sizeSlider .slider-selection 
		{
			background: #BABABA;
		}	
	</style>

	

	<script type="text/javascript" >

		$(document).ready(function() 
		{
  			$(".select-picker").select2({ 
  				placeholder: "Select.."  			
  			});

			$('#size').slider({
				formatter: function(value) {
					return 'Current value: ' + value;
				}
			});

			displayForm();	

			var indexSeries = 1;

			$("button.btnCloneSeries").on("click", function () {

		        // increment the counter
		        indexSeries++;

		        // now we clone the div with all the element inside 
		        $('#div_multiseries').clone(true).appendTo('#div_series_parent');

		        // now update label's name with the new number of serie 
		        $("#div_series_parent label").last().html('Serie ' + indexSeries + ' :');


		        // else update the place holder of the input
		        $("#div_series_parent input").last().attr('placeholder', 'Serie ' + indexSeries + ' name:');

		        // call the function for validate the select or dropdown input
		        //validateselect();

		        // $('#div_series_parent select').last().attr("Name",'multiseriesField' + indexSeries);
		        //updatenames();
		        
		        //$('#div_series_parent input').last().attr("Name",'multiseriesName' + indexSeries);
    		});


			$("button.btnRemoveSeries").on("click", function () {

	        	// here verify if the quantity of div with its label and input is more than one
		        if (indexSeries > 1) {

		            // if index > 1 then, we can remove it because is not the only
		            $(this).closest("#div_multiseries").remove();

		            // now dicrement the counter 
		            indexSeries--;

		            // I call the function for update the labels
		            // updatelabel();

		            // call the funtion for update the placeholder too.
		            // updateplaceholder();

		            // and finally, validat selects
		            // validateselect();
			       }
		    });

		    
		    $('.chart-names a').on('mouseenter', function(evt){
		        $('.popup').css({left: evt.pageX+30, top: evt.pageY-15}).show();
		        $(this).on('mouseleave', function(){
		            $('.popup').hide();
		        });
		    });


		}); //document.ready()



		$("#infobox_type").on('change', function() 
		{ 
			displayForm();
			$("#datasource_id").change();

		});


		$('input:radio[name=chart_category]').change(function()
		{
			widget_type_chart();  
		
		category=$('input:radio[name=chart_category]:checked').val();	

			if (category=='multicolumn') { 
				$(".divs-charts-column").show();
				$(".divs-charts-row").hide();
			} 
			else if (category=='multirow') { 
				$(".divs-charts-column").hide();
				$(".divs-charts-row").show();
			}else {
				$(".divs-charts-column").hide();
				$(".divs-charts-row").hide();
				$(".divs-charts").show();				
			}
		}); 


		$('#chart_type').change(function()
		{
			widget_library_chart();
		}); 


		$('#chart_library').change(function() 
		{ 
			widget_chart_preview();
		});

		$('#dimension_height').change(function() 
		{
			widget_chart_preview();
		});

		$('#dimension_width').change(function() 
		{
			widget_chart_preview();
		});

		$('#chart_labels').on('change', function() 
		{
			widget_chart_preview();
		});


		$('#chart_values').on('change', function() 
		{
			widget_chart_preview();
		});


		$('#chart_dataset').on('change', function() 
		{
			widget_chart_preview();
		});

		$('#title').keyup(function() 
		{
			previewInfoWidget();
		});


		$('#units').keyup(function()
		{
			previewInfoWidget();
		});

   		$('#size').slider().on('change', function() 
     	{
			$("#infobox").removeClass();
     		$("#infobox").addClass('col-md-'+$(this).val() );
     		$("#infobox_compare").removeClass();
     		$("#infobox_compare").addClass('col-md-'+$(this).val() );
     		$("#infobox_moreinfo").removeClass();
     		$("#infobox_moreinfo").addClass('col-md-'+$(this).val() );     	
     	});    


		$('.iconpicker').on('change', function(e) 
		{ 
			previewInfoWidget();						
		});		


	   $("#previewBtn").click(function()
	   {
	   		get_lastcollect_preview();

	   		$("#myModal").modal();

	   });



	   $("#btnRules").click(function()
	   {
		   	
			$("button.clone").click();


		   	$("#myModalRules").modal({
			      height: 820,
			      width: 520
		   	});
	   });


	   $("#submitRules").click(function(e)
	   {
		   	e.preventDefault();

		   	var data = $('form').serialize();

		   	var form = document.querySelectorAll( 'form' )[0];
		   	var total = 0;
		   	for (var i = 0; i < form.length; i++) 
		   	{
		   		console.log( form[i] );
		   		total += parseInt( form[i].value );
		   	}

		   	$.ajax({
		   		type: "POST",
		   		data: data,
		   		url: "/home2",
		   		success: function(data) { 
		   			alert(data);
		   		}, 
		   		error: function() { 
		   			alert('error');
		   		}
		   	});

	   });



	   $('#datasource_id').on('change', function() 
	   {
		   	var data = $(this).val();
		   	var widgettype=$('#infobox_type').val();
		   	var datareq='widgettype='+widgettype;

		  	$.ajax({
			  	type: "GET",
			  	data: datareq,
			  	url: "/cachedatasource/"+data+'/fieldnames',
			  	success: function(data) {
			  		if (widgettype=='infoboxcounter') { 
			  			if (data==0) { 
			  				$('#div_groupby').hide();
			  				$('#div_warnlevel').hide();
			  				alert('Error: JSON needs to be flat array list. Cannot use this datasource.');

			  			} else {
			  				$('#div_groupby').show();
			  				$('#groupby_field').html('<option value="">(none)</option><option value="all">(*)</option>'+data);
			  			}

			  		} 
			  		else if( widgettype=='chart')
			  		{
			  			$('#chart_labels').html(data);
			  			console.log('chart labesl');
			  			$('#chart_dataset').html(data);

			  			$.ajax({
			  				type: "GET",
			  				url: "/cachedatasource/"+$("#datasource_id").val()+'/sumfields',
			  				success: function(data) {
			  					$('#chart_values').html(data);			  					
			  					widget_chart_preview();	
			  					loadelements();
			  				}, 
			  				error: function() { 
			  					$('#chart_values').html("<option>Error: No numeric fields found</option>");
			  				}
			  			});

			  		}
			  		else 
			  		{
			  			$('#detail').html('<option value="">Please select element...</option>'+data);
			  			$('#additional_detail').html('<option value=""></option>'+data);	
			  		}
			  		$('#div_dashboard').show();

			  	}, 
			  	error: function() { 
			  		$('#detail').html("<option>Error. Could not fetch datasource info</option>");
			  	}
			  });

		  	get_lastcollect_preview();

		});


	   $('#groupby_field').on('change', function() 
	   {
	   		run_aggregation();
	   });


	   $('#groupby_operator').on('change', function() 
	   {
	   		
	   		if ($("#groupby_operator").val()=='sum' || $("#groupby_operator").val()=='avg') 
	   		{
				$("#div_groupby_opfield").show();

				  $.ajax({
					  	type: "GET",
					  	url: "/cachedatasource/"+$("#datasource_id").val()+'/sumfields',
					  	success: function(data) {
							$('#groupby_opfield').html(data);		
					  	}, 
					  	error: function() { 
					  		$('#groupby_opfield').html("<option>Error: No numeric fields found</option>");
					  	}
				  });
			} else {
				$("#div_groupby_opfield").hide();
			}

			run_aggregation();

	   });



	   $("#groupby_opfield").on('change', function()
	   {
	   		run_aggregation();
	   });


		$('#detail').on('change', function() 
		{
			previewInfoWidget();
		});

		$('#additional_detail').on('change', function() 
		{
			var jsonheader=$("#additional_detail").val();
			getJSONvalue(jsonheader, $('#preview_additional_detail') )
		});


		$("#openBtn").click(function() 
		{
		    $('#myModal').on('show', function () {
		        $('iframe').attr("src",'/widgets');
			});
		    $('#myModal').modal({show:true});
		});



		$("#infobox_level").on('change', function() 
		{
			displayForm();
			previewThreshold();
		});


		$("#threshold_operator").on('change', function() 
		{
			previewThreshold();
		});

		$("#threshold_value").keyup(function() 
		{
			previewThreshold();
		});


	/*
	* -------------------------------- Functions --------------------------------
	*/


	/**
	* change datasource and update list for detail and additional_detail
	*/
   function run_aggregation()
   {
   		var datasource=$("#datasource_id").val();
   		var groupby_field=$("#groupby_field").val();
   		var groupby_operator=$("#groupby_operator").val();
   		var groupby_sumfield=$("#groupby_opfield").val();
   		data='datasource_id='+datasource+'&groupby_field='+groupby_field+'&groupby_operator='+groupby_operator+'&groupby_sumfield='+groupby_sumfield;

		$.ajax({
		  	type: "POST",
		  	data: data,
		  	url: "/cachedatasource/aggregate",
		  	success: function(data) { 
		  		console.log('Success'+data);
		  		$("#infobox_counter_val").html(data);
		  	}, 
		  	error: function() { 
		  		$("#infobox_counter_val").html('Error: retrieving summary');
		  	}
		});
   }


	function displayForm() 
	{ 
		var infobox_type=$("#infobox_type").val();

		$(".divs").hide();

		$("#infobox").hide();	
		$("#infobox_compare").hide();
		$("#infobox_moreinfo").hide();
		$("#infobox_counter").hide();
		$("#tablewidget").hide();
		$("#div_rules").hide();

		if (infobox_type=='infobox') {
			$("#infobox").show();	
			$("#div_title").show();			
			$("#div_size").show();			
			$("#div_icon").show();			
			$("#div_datasource").show();
			$("#div_detail").show();
			$("#div_units").show();
			$("#div_warnlevel").show();
			$("#div_dashboard").show();	
			$("#div_moreinfo_url").show();		
		}
		else if (infobox_type=='infobox_moreinfo') {	
			$("#infobox_moreinfo").show();
			$("#div_moreinfo_url").show();	
			$("#div_datasource").show();				
			$("#div_detail").show();				
			$("#div_dashboard").show();
		}
		else if (infobox_type=='infoboxcounter') { 
			$("#infobox_counter").show();
			$("#div_title").show();					
			$("#div_datasource").show();
			$("#div_groupby").show();
			$("#div_dashboard").show();
		}
		else if (infobox_type=='tablewidget') { 
			$("#tablewidget").show();
			$("#size_div").hide();
			$("#icon_div").hide();
			$("#div_warnlevel").hide();
			$("#div_detail").hide();	
			$("#div_title").show();					
			$("#div_datasource").show();
			$("#div_dashboard").show();
		}
		else if (infobox_type=='chart') { 
			$("#chartwidget").show();
			$("#div_title").show();					
			$("#div_datasource").show();
			$("#div_dashboard").show();
			$('.divs-charts').show();
			$('#chart_widget').show();
			$('#div_series_parent').show();
			widget_chart_preview();			
		}		
		else {
			$(".divs").hide();
		}

		if ($("#infobox_level").val()=='info') { 
			$("#div_threshold").hide();
		} else {
			$("#div_threshold").show();
		}

		if ($("#groupby_operator").val()=='sum' || $("#groupby_operator").val()=='avg' ) {
			$("#div_groupby_opfield").show();
		} else {
			$("#div_groupby_opfield").hide();
		}

		if ($('input:radio[name=chart_category]:checked').val()=='multicolumn') 
		{ 
			$(".divs-charts-column").show();
			$(".divs-charts-row").hide();
		} else if ($('input:radio[name=chart_category]:checked').val()=='multirow') 
		{ 
			$(".divs-charts-column").hide();
			$(".divs-charts-row").show();
		} else {
			$("#div_chart_dataset").hide();		
			$(".divs-charts-column").hide();
			$(".divs-charts-row").hide();
		}
	
  		previewInfoWidget();
	}


	function previewThreshold() 
	{ 
		var infolevel=$("#infobox_level").val();
		console.log(infolevel);

		if (infolevel=='warning') {
			if (checkThreshold()) { 
				setInfoBox('yellow');
			} else {
				setInfoBox('green');
			}
		}
		else if (infolevel=='critical') {
			if (checkThreshold()) { 
				setInfoBox('red');
			} else {
				setInfoBox('green');
			}
		} else {
			setInfoBox('aqua');		
		}
	}


	function checkThreshold() 
	{ 
		var value1=$("#preview_detail").text();
		var value2=$("#threshold_value").val();
		var operator=$("#threshold_operator").val();

		if (operator =='=') { 
			return (value1==value2)?true:false;
		}
		else if (operator =='>') { 
			return (value1>value2)?true:false;
		}
		else if (operator =='<') { 
			return (value1<value2)?true:false;
		}
		else { 
			return false;
		}
	}


	function setInfoBox(color) 
	{ 

 		$("#infobox_color").removeClass();
 		$("#infobox_color").addClass('info-box-icon bg-'+color);

		$("#infobox_compare_color").removeClass();
 		$("#infobox_compare_color").addClass('info-box bg-'+color);

		$("#infobox_moreinfo_color").removeClass();
 		$("#infobox_moreinfo_color").addClass('small-box bg-'+color);
	}



	function previewInfoWidget() 
	{ 

		//title
		if ($('#title').val()!='') 	$(".form-widget-title").html($('#title').val());

		//icon
		$("#infobox_icon").removeClass();
		$("#infobox_icon").addClass('glyphicon');
		$("#infobox_icon").addClass($('input[name=icon]').val());
		$("#infobox_compare_icon").removeClass();
		$("#infobox_compare_icon").addClass('glyphicon');
		$("#infobox_compare_icon").addClass($('input[name=icon]').val());
		$("#infobox_moreinfo_icon").removeClass();
		$("#infobox_moreinfo_icon").addClass('glyphicon');
		$("#infobox_moreinfo_icon").addClass($('input[name=icon]').val());
		
		//detail
		var jsonheader=$("#detail").val();
		if (jsonheader!='') getJSONvalue(jsonheader, $('.form-widget-number') );

		//widget color
		previewThreshold();		

		//units
		if ($('#units').val()!='') 	$("#form-widget-unit").html($('#units').val());
		console.log($('#units').val());

		//infobox counter preview
		run_aggregation();
	}


	/**
	 * Helper function to get value of jsonheader using current datasource_id and display value into the element 
	 */
	function getJSONvalue(jsonheader, element) 
	{ 
		var datasource_id=$('#datasource_id').val();
		var url="/cachedatasource/"+datasource_id+"/jsonvalue/"+jsonheader;

		$.ajax({
			type: "GET",
			url: url,
			success: function(data) { 
				element.html(data);
				$(".form-widget-number").html(data);
			}, 
			error: function() { 
				element.html('Error getting data');
			}
		});
	}


	/**
	 * Gets the output of the last collect of the chosen datasource_id and copy it in modal preview div
	 */
	function get_lastcollect_preview()
	{
		var data = $("#datasource_id").val();

		$.ajax({
	  		// call to display raw json in the modal preview
		  	type: "GET",
		  	url: "/cachedatasource/"+data+'/raw',
		  	success: function(data) { 
		  		$('#modalBody').html('<pre>'+JSON.stringify(JSON.parse(data),null,2)+'</pre>');
		  	}, 
		  	error: function() { 
		  		$('#modalBody').html('<pre>'+"Error. Could not fetch datasource info. Check datasource."+'</pre>');
		  	}
	  	});
	}

	/**
	 * Fills out the chart_type option select using selected chart category
	 */
	function widget_type_chart() { 
	   	
	   	category=$('input:radio[name=chart_category]:checked').val();

		data='category='+category;
	   	$.ajax({
	   		type: "GET",
	   		data: data,
	   		url: "/widgets/chartoptions",
	   		success: function(data) { 
	   			$('#chart_type').html(data);
	   			widget_library_chart();
	   		}, 
	   		error: function() { 
	   			alert('error returning chart types');
	   		}
	   	});

	}

	/**
	 * Fills out 
	 * @return {[type]} [description]
	 */
	function widget_library_chart() { 
	   	category=$('input:radio[name=chart_category]:checked').val();
	   	type=$('#chart_type').val();
	   	
	   	if (type=="") type='area';

		data='category='+category+'&type='+type;
	   	$.ajax({
	   		type: "GET",
	   		data: data,
	   		url: "/widgets/chartoptions",
	   		success: function(data) { 
	   			$('#chart_library').html(data);
	   			widget_chart_preview();
	   		}, 
	   		error: function() { 
	   			alert('error returning chart types');
	   		}
	   	});

	}


	function widget_chart_preview() { 
	   	category=$('input:radio[name=chart_category]:checked').val();
	   	type=$('#chart_type').val();
	   	library=$('#chart_library').val();
		  			var getdata=
	   	data='category='+category+'&type='+type+'&library='+library+'&dimensiony='+$('#dimension_height').val()+'&dimensionx='+$('#dimension_width').val()+'&labels='+$("#chart_labels").val()+'&values='+$("#chart_values").val()+'&dataset='+$("#chart_dataset").val()+'&datasource_id='+$("#datasource_id").val()+'&title='+$("#title").val();

	   	$.ajax({
	   		type: "GET",
	   		data: data,
	   		url: "/widgets/chartpreview",
	   		success: function(data) { 
	   			$('#chart_widget').html(data);
	   			$('#chart_widget').show();
	   		}, 
	   		error: function() { 
	   			alert('error returning chart types');
	   		}
	   	});
	}	


	// load elemet from  json input with ajax (jquery);
	function loadelements() {
	    // $select = $('#multiseriesField');
	    $select = $('.multiseriesClass');

	    //request the JSON data and parse into the select element
	    $.ajax({
	        url: "/cachedatasource/"+$("#datasource_id").val()+'/sumfields?format=json',
	        dataType: 'JSON',
	        success: function (data) {
	            //clear the current content of the select
	            $select.html('');
	            // set the place holder of the select !!
	            $select.append('<option>' + 'Select' + '</option>')
	            $.each(data, function (key, val) {
	                 $select.append('<option id="' + val + '">' + val + '</option>');
	            })
	        },
	    });
	}

	// function for validate select;
	function validateselect() {
	    $("select.multiseriesClass").change(function () {
	        $("select.multiseriesClass option").prop("disabled", ""); //enable everything

	        //collect the values from selected;
	        var arr = $.map(
	            $("select.multiseriesClass option:selected"),
	            function (n) {
	                return n.value;
	            }
	        );

	        //disable elements
	        $("select.multiseriesClass option").filter(function () {
	            return $.inArray($(this).val(), arr) > -1; //if value is in the array of selected values
	        }).prop("disabled", "disabled");

	        //re-enable elements
	        $("select.multiseriesClass option").filter(function () {
	            return $.inArray($(this).val(), arr) == -1; //if value is not in the array of selected values
	        }).prop("disabled", "");
	    }).trigger("change")
	}

	function updatelabel() {
	    // we iterate in every element with the class labelup.
	    $('.labelup').each(function (i, obj) {
	        $(obj).html('Serie ' + (i + 1) + ' :');

	    });
	}

	function updateplaceholder() {
	    $('.series-name').each(function (i, obj) {
	        $(obj).attr('placeholder', 'Serie ' + (i + 1) + ' name:');
	    });
	}

	function updatenames()
	
	{
		$('.multiseriesClass').each(function (i,obj)
		{
			$(obj).attr('Id','multiseriesValue'+(i+1));
			$(obj).attr('Name','multiseriesField'+(i+1));
		})
	}	

</script>

@endsection