<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Antecedentes</div>

<div style="margin:10px;">
    <div class="row">
        <div class="col-xs-10">
            <span>Antecedente</span>
            <input type="text" class="form-control" id='antecedente' data-provide="typeahead">
        </div>
        <div class="col-xs-2">
            <span></span>
            <button type="button" class="btn btn-success" id='agregarAntecedente' style="margin-top:19px;">Agregar</button>
        </div>
    </div>

    <div class="row" style="margin:30px 80px 15px 20px;">
        <div class="col-sm-12">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Antecedente</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @yield('tablaAntecedentes')
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

<script>
    $("#agregarAntecedente").click(function(){
        var antecedente = $("#antecedente").val();
        var pcp_id = $("#pcp_id").val();
        var esb_id = $("#establecimiento").val();
        var usu_id = $("#session_usu_id").val();
        var $_token = $("#_token").val();

        $.ajax({
            url:   '/agregarAntecedente?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&antecedente='+antecedente+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#contenido").load('formAlertas?pcp_id='+pcp_id+'&esb_id='+esb_id);

            }
        });
    });

    $(".eliminarAntecedente").click(function(){
        var id = this.id;
        var pcp_id = $("#pcp_id").val();
        var esb_id = $("#establecimiento").val();
        var $_token = $("#_token").val();
        $.ajax({
            url:   '/eliminarAntecedente?ant_id='+id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#contenido").load('formAlertas?pcp_id='+pcp_id+'&esb_id='+esb_id);

            }
        });
    });
</script>