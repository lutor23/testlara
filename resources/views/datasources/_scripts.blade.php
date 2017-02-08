
@section('scripts')
    @parent

    <script type="text/javascript" >

        $(document).ready(function() {
            $(".select-picker").select2({ 
              placeholder: "Select.."       
            });

            showfields();
        });

      $("#ds_type").on('change', function() { 
        showfields();
      });

      function showfields()
      {
        var ds_type=$("#ds_type").val();
        
        $("#div_email").hide();

        if (ds_type=='json') { 
          $("#div_connection").hide();
          $("#param_label").html('url');
          $("#div_timeout").show();
        }
        else if (ds_type=='dbconnection') {   
          $("#div_connection").show();
          $("#param_label").html('query');          
          $("#div_timeout").hide();
        }
        else {
          $("#div_name").hide();
          $("#div_connection").hide();
          $("#div_refresh").hide();
          $("#div_param").hide();
          $("#previewBtn").hide();
          $("#div_timeout").hide();
          $("#div_email").hide();
          return 0;
        }

        $("#div_name").show();
        $("#div_refresh").show();
        $("#div_param").show();
        $("#previewBtn").show();

      }

       $("#previewBtn").click(function(){

          $(this).attr('disabled', true);

          $(document.body).css({'cursor' : 'wait'});
          var dataurl="ds_type="+$('#ds_type').val()+"&connection_id="+$("#connection_id").val()+"&param="+$('#param').val()+'&timeout='+$("#timeout").val();
          var dataoutput='';

          // call to display raw json
          $.ajax({
            type: "POST",
            url: "/datasources/validate",
            data: dataurl,
            success: function(data) { 
                dataoutput=JSON.stringify(JSON.parse(data),null,2);
                $('#modalBody').html('<pre>'+dataoutput+'</pre>');
                $('#modalResultInfo').html('JSON is valid');
                $('#modalResultInfo').addClass("alert-success").removeClass('alert-danger');
                $('input[type="submit"]').removeClass('disabled');
            }, 
            error: function(data) { 
                console.log(data);
                // $('#modalBody').html("Error. Could not fetch datasource info. Check datasource.");
                $('#modalBody').html("");
                $('#modalResultInfo').html(data.responseText);
                $('#modalResultInfo').addClass("alert-danger").removeClass('alert-success');
                $('input[type="submit"]').addClass('disabled');
            },
            complete: function(data) { 
                $("#myModal").modal();
                $(document.body).css({'cursor' : 'default'});
                $('input[id=jsonoutput]').val(dataoutput);          
                $("#previewBtn").attr('disabled', false);
            }
          });


        });

    </script>


@endsection