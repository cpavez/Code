<style>
    dd{
        float: right;
        margin-left: 0px !important;
    }
</style>
@yield('pdf')
@yield('alertas')
<div class="row">
    @yield('datos_paciente')
    @yield('resumen_facturacion')
    @yield('tabla_prestaciones')
</div>

@yield('modal')
@yield('modalAgregarDescuento')
@yield('modalListarDescuento')

<input type="hidden" id="tipo_episodio_id" value="{{$tipo_episodio_id}}">
<script>
    $("#guardarCierre").click(function(){
        var diagnostico = $("#diagnostico").val();
        var epicrisis	= $("#epicrisis").val();
        var epi_id		= $("#epi_id").val();
        var pcp_id		= $("#pcp_id").val();
        var esb_id 		= $("#establecimiento").val();
        var especialidad_id = $("#session_especialidad_id").val();
        var $_token = $("#_token").val();

        $.ajax({
            url:   '/finalizarEpisodio?diagnostico='+diagnostico+'&epicrisis='+epicrisis+'&epi_id='+epi_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#contenido").load('formEpisodio?pcp_id='+pcp_id+'&esb_id='+esb_id+'&esp_id='+especialidad_id);
            }
        });
    });

    $("#agregarDescuento").click(function(){
        var des_id 	  = $("#descuento").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var usu_id 	  = $("#session_usu_id").val();
        var epi_id	  = $("#epi_id").val();
        var porcentaje = $("#porcentaje").val();
        var $_token = $("#_token").val();

        var perfil_id = $("#session_perfil_id").val();
        var especialidad_id = $("#session_especialidad_id").val();

        var tipoTratamiento = $("#tipo_episodio_id").val();

        if(porcentaje != ''){
            $.ajax({
                url:   '/agregarDescuento?epi_id='+epi_id+'&usu_id='+usu_id+'&des_id='+des_id+'&porcentaje='+porcentaje+'&_token='+$_token,
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#contenido").load('indexEpisodio?epi_id='+epi_id+'&pcp_id='+pcp_id+'&esb_id='+esb_id+'&perfil_id='+perfil_id+'&especialidad_id='+especialidad_id+'&tipo_episodio_id='+tipoTratamiento);

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
        var perfil_id = $("#session_perfil_id").val();
        var especialidad_id = $("#session_especialidad_id").val();
        var tipoTratamiento = $("#tipo_episodio_id").val();

        $.ajax({
            url:   '/eliminarDescuento?epi_id='+epi_id+'&des_id='+des_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#contenido").load('indexEpisodio?epi_id='+epi_id+'&pcp_id='+pcp_id+'&esb_id='+esb_id+'&perfil_id='+perfil_id+'&especialidad_id='+especialidad_id+'&tipo_episodio_id='+tipoTratamiento);
            }
        });
    });

    $("#eliminarEpisodio").click(function(){
        var epi_id	  = $("#epi_id").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var especialidad_id = $("#session_especialidad_id").val();
        var $_token = $("#_token").val();
        $.ajax({
            url:   '/eliminarEpisodio?epi_id='+epi_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#contenido").load('formEpisodio?pcp_id='+pcp_id+'&esb_id='+esb_id+'&esp_id='+especialidad_id);
            }
        });
    });
</script>