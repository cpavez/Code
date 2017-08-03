<div class="row">
    @yield('pdf')
    @yield('evoluciones')
    @yield('indicaciones')
    @yield('eva')
    @yield('zona')
    @yield('tabla_sv')
    @yield('tabla_prestaciones')
    @yield('receta')
    @yield('modRecetaDetalle')
    @yield('examen')
    @yield('modExamenDetalle')
</div>

@yield('modal')


<input type="hidden" value="{{$epi_id}}" id="epi_id">
<script>
    $(".detalleReceta").click(function(){
        $("#modRecetaDetalle").modal('show');
        var fecha = this.id;
        var epi_id		= $("#epi_id").val();
        $("#listRecetaDetalle").load('listRecetaDetalle?fecha='+fecha+'&epi_id='+epi_id);
    });

    $(".detalleExamen").click(function(){
        $("#modExamenDetalle").modal('show');
        var fecha = this.id;
        var epi_id		= $("#epi_id").val();
        $("#listExamenDetalle").load('listExamenDetalle?fecha='+fecha+'&epi_id='+epi_id);
    });

    $("#eva option").each(function(){
        if($(this).attr('value') == $('#evaSeleccionado').val()){
            $(this).attr('selected','selected');
        }
    });
</script>