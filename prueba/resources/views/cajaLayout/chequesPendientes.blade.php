<style>
    .panel-heading span{
        font-size: 12px;
    }
</style>
<input type="hidden" id="esb_id" value="{{$esb_id}}">
<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Cheques por Cobrar</div>
<div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
    <div class="col-sm-12" style="margin-top:20px;">
        <div class="form-group">
            <div class="row">
                @yield('cheque')
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(".cobrarCheque").on('click',function(){
        var id = this.id;
        var esb_id = $("#esb_id").val();
        var $_token = $("#_token").val();
        swal({
                title: "Usted esta seguro?",
                text: "Usted esta confirmando el Cobro de este Cheque",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Si, confirmado!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url:   'modificarCheque?id='+id+'&_token='+$_token,
                        type:  'post',
                        success:  function (data) {
                            console.log(data);
                            swal("Cobrado!", "Se acaba de confirmar el Cobro", "success");
                            $("#contenidoCaja").load('repChequesPorCobrar?esb_id='+esb_id);
                        }
                    });
                } else {
                    swal("Cancelado", "No se confirma el cobro", "error");
                }
            });
    })
</script>