@yield('agregar_informe')



<div class="page-header" style="margin: 25px 0 20px;">

</div>
@yield('listarInforme')

<script>
    $("#agregarInforme").click(function(){
        var informe = $("#informe").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();


        $.ajax({
            url:   '/agregarInforme?epi_id='+epi_id+'&usu_id='+usu_id+'&informe='+informe+'&_token='+$_token,
            type:  'POST',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiInforme?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });

    });


</script>