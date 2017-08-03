
@yield('agregar_sv')


<div class="page-header" style="margin: 25px 0 20px;">

</div>

@yield('tabla_sv')


<script>
    $('#presionArterial').inputmask({
        mask: '999/999'
    });
    $("#guardarSignosVitales").click(function(){
        var presionArterial 	    = $("#presionArterial").val();
        var frecuenciaCardiaca 	    = $("#frecuenciaCardiaca").val();
        var frecuenciaRespiratoria 	= $("#frecuenciaRespiratoria").val();
        var temperaturaBocal 	    = $("#temperaturaBocal").val();
        var talla 	                = $("#talla").val();
        var peso 	                = $("#peso").val();
        var saturacionOxigeno 	    = $("#saturacionOxigeno").val();

        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var $_token = $("#_token").val();

        var url = '?epi_id='+epi_id;
        url += '&_token='+$_token;
        url += '&presionArterial='+presionArterial;
        url += '&frecuenciaCardiaca='+frecuenciaCardiaca;
        url += '&frecuenciaRespiratoria='+frecuenciaRespiratoria;
        url += '&temperaturaBocal='+temperaturaBocal;
        url += '&talla='+talla;
        url += '&peso='+peso;
        url += '&saturacionOxigeno='+saturacionOxigeno;

        $.ajax({
            url:   '/agregarSignosVitales'+url,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiSignosVitales?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });

    });

</script>