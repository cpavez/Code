<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Seleccione Tratamiento para Abonar</div>

<div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
    <div class="col-sm-12" style="margin-top:20px;">
        <div class="form-group">
            <div class="row">
                <div id='alert_error' class="alert alert-info alert-dismissible" role="alert" style="margin:0px 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Cuidado!</strong> Debe seleccionar un Tratamiento.
                </div>
                <div class="col-sm-12">
                    @yield('tablaRecaudacion')
                    <div class="form-group" style="margin-bottom:10px;">
                        <div class="col-xs-offset-5 col-xs-7">
                            <button type="button" class="btn btn-success" id='abonar_seleccion'>Abonar Selección</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<input type="hidden" id='epi_select'/>
<input type="hidden" id='epi_pagado'/>

<script type="text/javascript">

    $(".tabla_epi_pagar tr").click(function(){
        var episodio = this.id;
        var pagado = $(this).attr('rel');

        var epi_val = $("#epi_select").val();
        if(epi_val != episodio && epi_val != ''){
            $("#"+epi_val+" input[type=radio]").removeAttr("checked");
        }
        $("#"+episodio+" input[type=radio]").attr("checked",true);
        $("#epi_select").val(episodio);
        $("#epi_pagado").val(pagado);
        $(".alert").alert('close');
    });
    $("#abonar_seleccion").click(function(){
        var episodio = $("#epi_select").val();
        var epi_pagado = $("#epi_pagado").val();
        var esb_id	 = $("#establecimiento").val();
        if(episodio != ''){
            $("#contenido").load('indexAbono?epi_id='+episodio+'&esb_id='+esb_id+'&epi_pagado='+epi_pagado+'&contenedor=contenido');
        }else{
            swal("Ups! hay un error!",'Debe seleccionar un Tratamiento.', "error");
        }
    });
</script>