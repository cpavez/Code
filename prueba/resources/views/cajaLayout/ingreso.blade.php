<style>
    .panel-heading span{
        font-size: 12px;
    }
</style>
<input type="hidden" id="esb_id" value="{{$esb_id}}">
<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Ingresar Abono</div>
    <div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
        <div class="row" style="margin:20px 10px;">
            <div class="col-xs-5">
                <span>Nº Tratamiento</span>
                <input type="text" class="form-control" id='tratamiento'  data-provide="datepicker" value="{{$tratamiento}}" style="width: 200px;">
            </div>
            <div class="col-xs-5">
                <span>Rut Paciente</span>
                <input type="text" class="form-control" id='rut'  data-provide="datepicker" value="{{$rut}}" style="width: 200px;">
                <input type="hidden" id="rut_simple">
            </div>
            <div class="col-xs-2">
                <span></span>
                <button type="button" class="btn btn-success" id='buscarTratamiento' style="margin-top:19px;">Buscar</button>
            </div>
        </div>


        <div class="col-sm-12" style="margin-top:20px;">
            <div class="form-group">
                <div class="row">
                    @yield('tratamientos')

                </div>
            </div>
        </div>
    </div>

</div>
<input type="hidden" id='epi_select'/>
<input type="hidden" id='epi_pagado'/>
<script>
    $('#rut').Rut({
        on_success: function(){
            var rut = $("#rut").val();
            var rut_ = $.Rut.quitarFormato(rut);
            var rut_simple = rut_.slice(0,-1);
            $("#rut_simple").val(rut_simple);

        },
        on_error: function(){ swal("Error", "Se ingresado un Rut erroneo", "error"); },
        format_on: 'keyup'
    });
    $("#buscarTratamiento").click(function(){
        var tratamiento		= $("#tratamiento").val();
        var rut		        = $("#rut_simple").val();
        var rutCompleto		= $("#rut").val();
        var esb_id 		    = $("#establecimiento").val();

        $("#contenidoCaja").load('ingreso?esb_id='+esb_id+'&tratamiento='+tratamiento+'&rut='+rut+'&rutCompleto='+rutCompleto);
    });

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
            $("#contenidoCaja").load('indexAbono?epi_id='+episodio+'&esb_id='+esb_id+'&epi_pagado='+epi_pagado+'&contenedor=contenidoCaja');
        }else{
            swal("Ups! hay un error!",'Debe seleccionar un Tratamiento.', "error");
        }
    });


</script>