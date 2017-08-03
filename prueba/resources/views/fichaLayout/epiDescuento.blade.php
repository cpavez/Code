
@yield('agregar_descuento')


<div class="page-header" style="margin: 25px 0 20px;">

</div>

@yield('tabla_descuento')


<script>
    $("#agregarDescuento").click(function(){
        var des_id 	  = $("#descuento").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var porcentaje = $("#porcentaje").val();
        var $_token = $("#_token").val();

        if(porcentaje != ''){
            $.ajax({
                url:   '/agregarDescuento?epi_id='+epi_id+'&usu_id='+usu_id+'&des_id='+des_id+'&porcentaje='+porcentaje+'&_token='+$_token,
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#con_episodio").load('epiDescuento?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

                }
            });
        }else{
            swal("Ups! hay un error!",'Debe indicar el Porcentaje de Descuento', "error");
        }

    });

    $(".eliminarDescuento").click(function(){
        var epi_id	  = $("#epi_id").val();
        var des_id    = this.id;
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var $_token = $("#_token").val();


        $.ajax({
            url:   '/eliminarDescuento?epi_id='+epi_id+'&des_id='+des_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiDescuento?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);
            }
        });
    });
</script>