
@section('scripts')
    @parent

    <script type="text/javascript" >

       $("#previewBtn").click(function(){

          $(document.body).css({'cursor' : 'wait'});
          var dataurl="url="+$('#url').val();
          // var dataoutput='';

          // call to display raw json
          $.ajax({
            type: "POST",
            url: "/connections/validate",
            data: dataurl,
            // success: function(data) { 
            //     dataoutput=JSON.stringify(JSON.parse(data),null,2);
            //     $('#modalBody').html('<pre>'+dataoutput+'</pre>');
            //     $('#modalResultInfo').html('JSON is valid');
            //     $('#modalResultInfo').addClass("alert-success").removeClass('alert-danger');
            //     $('input[type="submit"]').removeClass('disabled');
            // }, 
            // error: function() { 
            //     $('#modalBody').html("Error. Could not fetch datasource info. Check datasource.");
            //     $('#modalResultInfo').html('JSON is invalid');
            //     $('#modalResultInfo').addClass("alert-danger").removeClass('alert-success');
            //     $('input[type="submit"]').addClass('disabled');
            // },
            complete: function(data) { 
                // $("#myModal").modal();
                // $(document.body).css({'cursor' : 'default'});
                // $('input[id=jsonoutput]').val(dataoutput);
                alert(data);
            }
          });

        });

    </script>
@endsection