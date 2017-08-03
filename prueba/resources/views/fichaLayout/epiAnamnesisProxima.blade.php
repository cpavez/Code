<style>
    #slider {
        margin-left: 32px;
        width: 330px;
        margin-bottom: 0px;
    }
</style>
@yield('eva')

@if($especialidad_id == 2)
    @yield('zona')
@endif


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
        var zona = $("#zona").val();
        var motivoConsulta = $("#motivoConsulta").val();
        var especialidad = $("#session_especialidad_id").val();


        $.ajax({
            url:   '/guardarFoto',
            data: { nombre_imagen:episidio ,
                eva:eva ,
                frecuencia:frecuencia,
                zona:zona,
                examenFisico:examenFisico,
                motivoConsulta:motivoConsulta,
                img : canvas.toDataURL(),
                _token:$_token},
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiAnamnesisProxima?esb_id='+esb_id+'&epi_id='+episidio+'&especialidad_id='+especialidad);

            }
        });
    });


    var movimientos = [];
    var pulsado;
    if($("#episodioEvaluda").val() == '' && especialidad_id == 2){
        crearLienzo();
    }
    function crearLienzo() {
        var canvasDiv = document.getElementById('lienzo');
        canvas = document.createElement('canvas');


        canvas.setAttribute('width', 700);
        canvas.setAttribute('height', 436);
        canvas.setAttribute('id', 'canvas');
        canvasDiv.appendChild(canvas);
        if(typeof G_vmlCanvasManager != 'undefined') {
            canvas = G_vmlCanvasManager.initElement(canvas);
        }
        context = canvas.getContext("2d");

        $('#canvas').mousedown(function(e){
            console.log(e.offsetX);
            console.log(e.offsetY);
            pulsado = true;
            /*movimientos.push([e.pageX - 275,
                e.pageY - 300,
                false]);*/
            movimientos.push([e.offsetX,
                e.offsetY,
                false]);
            repinta();
        });

        $('#canvas').mousemove(function(e){
            if(pulsado){
                /*movimientos.push([e.pageX - 275,
                    e.pageY - 300,
                    true]);*/
                movimientos.push([e.offsetX,
                    e.offsetY,
                    true]);
                repinta();
                var dataUrl = canvas.toDataURL();
            }
        });

        $('#canvas').mouseup(function(e){
            pulsado = false;
        });

        $('#canvas').mouseleave(function(e){
            pulsado = false;
        });
        repinta();
    }
    function repinta(){
        canvas.width = canvas.width; // Limpia el lienzo
        context.strokeStyle = "#FA8072";
        context.lineJoin = "round";
        context.lineWidth = 2;

        for(var i=0; i < movimientos.length; i++){
            context.beginPath();
            if(movimientos[i][2] && i){
                context.moveTo(movimientos[i-1][0], movimientos[i-1][1]);
            }else{
                context.moveTo(movimientos[i][0], movimientos[i][1]);
            }
            context.lineTo(movimientos[i][0], movimientos[i][1]);
            context.closePath();
            context.stroke();
        }

    }




</script>