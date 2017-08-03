@yield('receta')

@yield('modReceta')

@yield('examen')

@yield('modExamen')

@yield('modRecetaDetalle')
@yield('modExamenDetalle')


<script>
    var date = new Date();
    var fecha 		= date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    var epi_id    = $("#epi_id").val();

    $("#listReceta").load('listReceta?fecha='+fecha+'&epi_id='+epi_id);
    $("#listExamen").load('listExamen?fecha='+fecha+'&epi_id='+epi_id);

    $("#agregarReceta").click(function(){

        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id    = $("#session_usu_id").val();
        var medicamento = $("#medicamento").val();
        var docis		= $("#docis").val();
        var cantidad    = $("#cantidad").val();
        var $_token = $("#_token").val();

        $.ajax({
            url:   'agregarReceta?epi_id='+epi_id+'&usu_id='+usu_id+'&medicamento='+medicamento+'&docis='+docis+'&cantidad='+cantidad+'&fecha='+fecha+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#medicamento").val('');
                $("#docis").val('');
                $("#cantidad").val('');
                $("#medicamento").focus();


                $("#listReceta").load('listReceta?fecha='+fecha+'&epi_id='+epi_id);

            }
        });
    });

    $("#agregarExamen").click(function(){
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id    = $("#session_usu_id").val();
        var examen	  = $("#examen").val();
        var tpe_id	  = $("#tipoExamen").val();
        var cantidad  = $("#cantidadExamen").val();
        var $_token = $("#_token").val();


        $.ajax({
            url:   'agregarExamen?epi_id='+epi_id+'&usu_id='+usu_id+'&examen='+examen+'&tpe_id='+tpe_id+'&cantidad='+cantidad+'&fecha='+fecha+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#examen").val('');
                $("#cantidadExamen").val('');
                $("#examen").focus();


                $("#listExamen").load('listExamen?fecha='+fecha+'&epi_id='+epi_id);

            }
        });

    });


    $("#cerrarReceta,#cerrarExamen").click(function(){
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var epi_id  = $("#epi_id").val();
        var usu_id  = $("#session_usu_id").val();
        $("#con_episodio").load('epiUnidadApoyo?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);
    });


    $(".detalleReceta").click(function(){
        $("#modRecetaDetalle").modal('show');
        var fecha = this.id;
        $("#listRecetaDetalle").load('listRecetaDetalle?fecha='+fecha+'&epi_id='+epi_id);
    });

    $(".detalleExamen").click(function(){
        $("#modExamenDetalle").modal('show');
        var fecha = this.id;
        $("#listExamenDetalle").load('listExamenDetalle?fecha='+fecha+'&epi_id='+epi_id);
    });

</script>






