<style>
    .dl-horizontal dt {
        float: left;
        width: 100px !important;
        overflow: hidden;
        clear: left;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    @media (max-width: 1024px){
        .dl-horizontal dt {
            float: left;
            width: 70px !important;
            overflow: hidden;
            clear: left;
            text-align: left;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }
</style>
<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Realizar Abono</div>
<input type="hidden" value="{{$contendedor}}" id="divContenedor">
<div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
    <div class="col-sm-12" style="margin-top:20px;">
        <div class="form-group">
            <div class="row">
                @yield('episodio')



                @yield('abono')



            </div>
        </div>
    </div>
</div>
</div>

@yield('modAbono')



<script type="text/javascript">
    $("#guardar").click(function(){
        var valor = $("#valor").val();
        var documento = $("#documento").val();
        var tipoAbono = $("#tipoAbono").val();
        var banco = $("#banco").val();
        var cobrado = $("#cobrado").val();
        var epi_id = $("#epi_id").val();
        var usu_id = $("#session_usu_id").val();
        var $_token = $("#_token").val();
        var esb_id  = $("#establecimiento").val();

        var contenedor = '#'+$("#divContenedor").val();
        var contenedorEnvio = $("#divContenedor").val();

        var arr =  'epi_id=' 		+ epi_id;
        arr += '&usu_id=' 		+ usu_id;
        arr += '&valor='  		+ valor;
        arr += '&documento='  	+ documento;
        arr += '&tipoAbono='  	+ tipoAbono;
        arr += '&banco='  		+ banco;
        arr += '&cobrado='  	+ cobrado;
        arr += '&_token='  	    + $_token;


        $.ajax({
            url:   'agregarAbono?'+arr,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $('#modAbono').modal('hide');
                $(contenedor).load('indexAbono?epi_id='+epi_id+'&esb_id='+esb_id+'&contenedor='+contenedorEnvio);
            }
        });
    });
    $("#tipoAbono").change(function(){
        var valor = this.value;
        if(valor == 3 || valor == 2){
            $("#cont_banco").show();
        }else{
            $("#cont_banco").hide();
        }
    });

    $(".eliminarAbono").click(function(){
        var abo_id = this.id;
        var epi_id = $("#epi_id").val();
        var esb_id  = $("#establecimiento").val();
        var contenedor = '#'+$("#divContenedor").val();
        var contenedorEnvio = $("#divContenedor").val();
        var $_token = $("#_token").val();
        $.ajax({
            url:   'eliminarAbono?abo_id='+abo_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $('#modAbono').modal('hide');
                $(contenedor).load('indexAbono?epi_id='+epi_id+'&esb_id='+esb_id+'&contenedor='+contenedorEnvio);
            }
        });
    })
</script>



