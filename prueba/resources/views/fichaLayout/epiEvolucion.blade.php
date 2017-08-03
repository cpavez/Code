@yield('agregar_evolucion')


<div class="page-header" style="margin: 25px 0 20px;">

</div>

@yield('evoluciones')
<div class="page-header" style="margin: 25px 0 20px;">

</div>

@yield('agregar_indicacion')


<div class="page-header" style="margin: 25px 0 20px;">

</div>

@yield('indicaciones')

<script>
    $("#agregarEvolucion").click(function(){
        var evolucion = $("#epicrisis").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();


        $.ajax({
            url:   '/agregarEvolucion?epi_id='+epi_id+'&usu_id='+usu_id+'&evolucion='+evolucion+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiEvolucion?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });

    });

    $("#agregarIndicacion").click(function(){
        var indicacion = $("#indicacion").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();


        $.ajax({
            url:   '/agregarIndicaciones?epi_id='+epi_id+'&usu_id='+usu_id+'&indicacion='+indicacion+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiEvolucion?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });

    })
</script>