<input type="hidden" id="_token" value="{{ csrf_token() }}" />
<div class="label-primary" style=" background-color: #00bca4 !important; border-color: #00bca4 !important; height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Tratamientos</div>

<div style="background-color: #FEFAC0;border: 1px solid #FEF67F;width: 230px;margin: 20px 0px 0px 20px;padding: 5px;height: 30px;font-size: 12px;line-height: 20px;float: left;">
    <span>Listado de los tratamientos activos</span>
</div>
<a class="btn btn-success" href="#modNuevoEpisodio" role="button" data-toggle="modal" style="float: left;margin: 18px 0px 0px 20px;">Agregar nuevo Tratamiento</a>

<div style="padding: 20px;">
    @yield('episodios')
</div>
@yield('modal')
</div>

<script>
    $("#episodios > tbody > tr").click(function(){
        var pcp_id = $("#pcp_id").val();
        var esb_id = $("#establecimiento").val();
        var usu_id = $("#session_usu_id").val();
        var perfil_id = $("#session_perfil_id").val();
        var especialidad_id = $("#session_especialidad_id").val();
        var epi_id = this.id;
        var tipoTratamiento = $("#tipo_episodio_id").val();
        $("#contenido").load('indexEpisodio?epi_id='+this.id+'&pcp_id='+pcp_id+'&esb_id='+esb_id+'&perfil_id='+perfil_id+'&especialidad_id='+especialidad_id+'&tipo_episodio_id='+tipoTratamiento);
    });
    $("#crearNuevoEpisodio").click(function(){
        var pcp_id  = $("#pcp_id").val();
        var esb_id  = $("#establecimiento").val();
        var usu_id  = $("#session_usu_id").val();
        var perfil_id = $("#session_perfil_id").val();
        var especialidad_id = $("#session_especialidad_id").val();
        var tipoTratamiento = $("#tipoTratamiento").val();
        var $_token = $("#_token").val();

        if(tipoTratamiento != 0){
            $.ajax({
                url:   '/agregarEpisodio?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&especialidad_id='+especialidad_id+'&tipo_tratamiento_id='+tipoTratamiento+'&_token='+$_token,
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#contenido").load('indexEpisodio?epi_id='+data.epi_id+'&pcp_id='+pcp_id+'&esb_id='+esb_id+'&perfil_id='+perfil_id+'&especialidad_id='+especialidad_id+'&tipo_episodio_id='+tipoTratamiento);
                }
            });
        }else{
            swal("Ups! hay un error!",'Debe indicar el Tipo Tratamiento.', "error");
        }



    });
</script>