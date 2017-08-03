<style>
    #slider {
        margin-left: 32px;
        width: 330px;
        margin-bottom: 0px;
    }
</style>
@yield('eva')



@if($episidioID == '')
<button type="button" id="guardar" class="btn btn-primary" style="float: right !important;">Guardar</button>
@endif
<script>
    var especialidad_id = $("#session_especialidad_id").val();
    $("#eva option").each(function(){
        if($(this).attr('value') == $('#evaSeleccionado').val()){
            $(this).attr('selected','selected');
        }
    });
    $("#eva").change(function() {
        var valor = $(this).val();
        $("#id_progreso_eva").css('width',valor+'%')
    });

    $("#guardar").on('click',function(){
        var $_token = $("#_token").val();
        var episidio = $("#epi_id").val();
        var eva = $("#eva").val();
        var frecuencia = $("#frecuencia").val();
        var examenFisico = $("#examenFisico").val();
        var motivoConsulta = $("#motivoConsulta").val();
        var examenOcular = $("#examenOcular").val();
        var examenOido = $("#examenOido").val();
        var examenLenguaje = $("#examenLenguaje").val();
        var examenDental = $("#examenDental").val();
        var zona = $("#zona").val();

        $.ajax({
            url:   '/guardarAnamnesisPediatrica',
            data: { episodioID:episidio ,
                    eva:eva ,
                    zona:zona,
                    frecuencia:frecuencia,
                    examenFisico:examenFisico,
                    motivoConsulta:motivoConsulta,
                    examenOcular:examenOcular,
                    examenOido:examenOido,
                    examenLenguaje:examenLenguaje,
                    examenDental:examenDental,
                    _token:$_token},
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiAnamnesisPediatrica?esb_id='+esb_id+'&epi_id='+episidio+'&especialidad_id='+especialidad);

            }
        });
    });
</script>