@yield('agregar_indicacion')


<div class="page-header" style="margin: 25px 0 20px;">

</div>

@yield('indicaciones')

<script>
    $("#agregar").click(function(){
        var evolucion = $("#epicrisis").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();


        $.ajax({
            url:   '/agregarIndicaciones?epi_id='+epi_id+'&usu_id='+usu_id+'&indicacion='+evolucion+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiIndicaciones?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });

    })
</script>