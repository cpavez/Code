@yield('prestaciones')

<script>
    $(".agregarEvolucion").click(function(){
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();
        var id        = $(this).attr('id');

        var tratamiento  = $("#tratamiento_"+id).val();
        var evolucion    = $("#evolucion_"+id).val();
        var indicaciones = $("#indicaciones_"+id).val();


        $.ajax({
            url:   '/agregarEvolucionKine?epi_id='+epi_id+'&usu_id='+usu_id+'&evolucion='+evolucion+'&tratamiento='+tratamiento+'&indicaciones='+indicaciones+'&prestacion='+id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiEvolucionKine?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });

    });

</script>