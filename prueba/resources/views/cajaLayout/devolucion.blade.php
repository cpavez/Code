<style>
    .panel-heading span{
        font-size: 12px;
    }
</style>
<input type="hidden" id="esb_id" value="{{$esb_id}}">
<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Ingresar Devolución</div>
    <div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
        <div class="row" style="margin:20px 10px;">
            <div class="col-xs-5">
                <span>Nº Documento</span>
                <input type="text" class="form-control" id='documento'  data-provide="datepicker" value="{{$documento}}" style="width: 200px;">
            </div>
            <div class="col-xs-5">
                <span>Rut Paciente</span>
                <input type="text" class="form-control" id='rut'  data-provide="datepicker" value="{{$rut}}" style="width: 200px;">
                <input type="hidden" id="rut_simple">
            </div>
            <div class="col-xs-2">
                <span></span>
                <button type="button" class="btn btn-success" id='buscarIngresos' style="margin-top:19px;">Buscar</button>
            </div>
        </div>


        <div class="col-sm-12" style="margin-top:20px;">
            <div class="form-group">
                <div class="row">
                    @yield('ingresos')
                </div>
            </div>
        </div>
    </div>
    <div id="modDevolucion" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" id="abonoID">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Devolución</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nº Documento:</label>
                            <input type="text" class="form-control" id="devolucionDocumento">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Monto:</label>
                            <input type="text" class="form-control" id="devolucionMonto">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Observacion:</label>
                            <textarea rows="3" class="form-control" id="devolucionObservacion"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id='guardarDevolucion' class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
    $("#buscarIngresos").click(function(){
        var documento		= $("#documento").val();
        var rut		        = $("#rut_simple").val();
        var rutCompleto		= $("#rut").val();
        var esb_id 		    = $("#establecimiento").val();

        $("#contenidoCaja").load('devolucion?esb_id='+esb_id+'&documento='+documento+'&rut='+rut+'&rutCompleto='+rutCompleto);
    });

    $('.realizarDevolucion').on('click',function(){
        var id = this.id;
        var monto = $(this).attr('rel');
        $("#abonoID").val(id);
        $("#devolucionMonto").val(monto);
    });

    $("#guardarDevolucion").on('click',function(){
        var abonoID = $("#abonoID").val();
        var numeroDocumento = $("#devolucionDocumento").val();
        var monto = $("#devolucionMonto").val();
        var observacion = $("#devolucionObservacion").val();
        var documento		= $("#documento").val();
        var rut_		        = $("#rut").val();
        var rut_simple 		= $.Rut.quitarFormato(rut_);
        var rut             = rut_simple.slice(0,-1);
        var dv              = rut_simple.slice(-1);
        var rutCompleto		= $("#rut").val();
        var esb_id 		    = $("#establecimiento").val();
        var $_token = $("#_token").val();

        $.ajax({
            url:   'crearDevolucion?abonoID='+abonoID+'&numeroDocumento='+numeroDocumento+'&monto='+monto+'&observacion='+observacion+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#contenidoCaja").load('devolucion?esb_id='+esb_id+'&documento='+documento+'&rut='+rut+'&rutCompleto='+rutCompleto);
            }
        });

    });
</script>