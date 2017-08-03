<style>
    .panel-heading span{
        font-size: 12px;
    }
</style>
<input type="hidden" id="esb_id" value="{{$esb_id}}">
<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Abonos</div>
<div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
    <div class="row" style="margin:20px 10px;">
        <div class="col-xs-5">
            <span>Fecha Desde</span>
            <input type="text" class="form-control datepicker" id='fechaDesde' data-date-format="dd/mm/yyyy" data-provide="datepicker" value="{{$fechaDesde}}" style="width: 200px;">
        </div>
        <div class="col-xs-5">
            <span>Fecha Hasta</span>
            <input type="text" class="form-control datepicker" id='fechaHasta' data-date-format="dd/mm/yyyy" data-provide="datepicker" value="{{$fechaHasta}}" style="width: 200px;">
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
</div>

<script>
    $('.datepicker').datetimepicker({
        weekStart: 1,
        language:   'es',
        inline: 	true,
        sideBySide: true,
        startView: 2,
        minView: 2,
        forceParse: 0,
        todayHighlight: 1,
        autoclose: true

    }).on('changeDate', function(e) {
        //alert(e.date)
        //setFecha(e.date,1);
    });

    $("#buscarIngresos").click(function(){
        var fechaDesde		= $("#fechaDesde").val();
        var fechaHasta		= $("#fechaHasta").val();
        var esb_id 		= $("#establecimiento").val();

        $("#contenidoCaja").load('repIngresos?esb_id='+esb_id+'&fechaDesde='+fechaDesde+'&fechaHasta='+fechaHasta);
    });
</script>