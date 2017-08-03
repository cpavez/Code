<style>
    #slider {
        margin-left: 32px;
        width: 330px;
        margin-bottom: 0px;
    }
</style>
@yield('eva')

@yield('zona')
@yield('modalAgregarDescuento')
@yield('modalAgregarAngulo')
@yield('modalAgregarPerimetro')
@yield('modalAgregarFuerzaMuscular')


@if($episidioID == '')
    <button type="button" id="guardar" class="btn btn-primary" style="float: right !important;">Guardar</button>
@endif
<script>
    var especialidad_id = $("#session_especialidad_id").val();
    $("#evaDinamico option").each(function(){
        if($(this).attr('value') == $('#evaSeleccionadoDinamico').val()){
            $(this).attr('selected','selected');
        }
    });
    $("#evaDinamico").change(function() {
        var valor = $(this).val();
        $("#id_progreso_eva_dinamico").css('width',valor+'%')
    });

    $("#evaEstatico option").each(function(){
        if($(this).attr('value') == $('#evaSeleccionadoEstatico').val()){
            $(this).attr('selected','selected');
        }
    });
    $("#evaEstatico").change(function() {
        var valor = $(this).val();
        $("#id_progreso_eva_estatico").css('width',valor+'%')
    });

    $("#agregarFuerzaMuscular").on('click',function(){
       var extremidad = $("#modFuerzaMuscularExtremidad").val();
       var derecha = $("#modFuerzaMuscularDerecha").val();
       var izquierda = $("#modFuerzaMuscularIzquierda").val();
       var $_token = $("#_token").val();
       var episidio = $("#epi_id").val();

       var msj = '';
       var error = false;

       if(extremidad == ''){
           msj = "Debe Completar la Extremidad";
           error = true;
       }else if(derecha == '' && izquierda == ''){
           msj = "Debe Completar Derecha o Izquierda";
           error = true;
       }

       if(error == true){
           swal("Ups! hay un error!",msj, "error");
       }else{
           $.ajax({
               url:   '/guardarFuerzaMotora',
               data: { episidio:episidio ,
                       extremidad:extremidad ,
                       derecha:derecha,
                       izquierda:izquierda,
                       _token:$_token},
               type:  'post',
               success:  function (data) {
                   console.log(data);
                   $("#modFuerzaMuscularExtremidad").val('');
                   $("#modFuerzaMuscularDerecha").val('');
                   $("#modFuerzaMuscularIzquierda").val('');
                    $("#modAgregarFuerzaMuscular").hide();
               }
           });
       }


    });

    $("#agregarPerimetro").on('click',function(){
        var extremidad = $("#modPerimetroExtremidad").val();
        var derecha = $("#modPerimetroDerecha").val();
        var izquierda = $("#modPerimetroIzquierda").val();
        var $_token = $("#_token").val();
        var episidio = $("#epi_id").val();

        var msj = '';
        var error = false;

        if(extremidad == ''){
            msj = "Debe Completar la Extremidad";
            error = true;
        }else if(derecha == '' && izquierda == ''){
            msj = "Debe Completar Derecha o Izquierda";
            error = true;
        }

        if(error == true){
            swal("Ups! hay un error!",msj, "error");
        }else{
            $.ajax({
                url:   '/guardarPerimetro',
                data: { episidio:episidio ,
                    extremidad:extremidad ,
                    derecha:derecha,
                    izquierda:izquierda,
                    _token:$_token},
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#modPerimetroExtremidad").val('');
                    $("#modPerimetroDerecha").val('');
                    $("#modPerimetroIzquierda").val('');
                    $("#modAgregarPerimetro").hide();
                }
            });
        }


    });

    $("#agregarAngulo").on('click',function(){
        var extremidad = $("#modAnguloExtremidad").val();
        var derecha = $("#modAnguloDerecha").val();
        var izquierda = $("#modAnguloIzquierda").val();
        var $_token = $("#_token").val();
        var episidio = $("#epi_id").val();

        var msj = '';
        var error = false;

        if(extremidad == ''){
            msj = "Debe Completar la Extremidad";
            error = true;
        }else if(derecha == '' && izquierda == ''){
            msj = "Debe Completar Derecha o Izquierda";
            error = true;
        }

        if(error == true){
            swal("Ups! hay un error!",msj, "error");
        }else{
            $.ajax({
                url:   '/guardarAngulo',
                data: { episidio:episidio ,
                    extremidad:extremidad ,
                    derecha:derecha,
                    izquierda:izquierda,
                    _token:$_token},
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#modAnguloExtremidad").val('');
                    $("#modAnguloDerecha").val('');
                    $("#modAnguloIzquierda").val('');
                    $("#modAgregarAngulo").hide();
                }
            });
        }


    });

    $("#agregarGoniometria").on('click',function(){
        var articulacion = $("#modGoniometriaArticulacion").val();
        var movilidad = $("#modGoniometriaMovimiento").val();
        var derecha = $("#modGoniometriaDerecha").val();
        var izquierda = $("#modGoniometriaIzquierda").val();
        var $_token = $("#_token").val();
        var episidio = $("#epi_id").val();

        var msj = '';
        var error = false;

        if(articulacion == ''){
            msj = "Debe Completar la Articulacion";
            error = true;
        }else if(movilidad == ''){
            msj = "Debe Completar la Movilidad";
            error = true;
        }else if(derecha == '' && izquierda == ''){
            msj = "Debe Completar Derecha o Izquierda";
            error = true;
        }

        if(error == true){
            swal("Ups! hay un error!",msj, "error");
        }else{
            $.ajax({
                url:   '/guardarGoniometria',
                data: { episidio:episidio ,
                    articulacion:articulacion ,
                    movilidad:movilidad ,
                    derecha:derecha,
                    izquierda:izquierda,
                    _token:$_token},
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#modGoniometriaArticulacion").val('');
                    $("#modGoniometriaMovimiento").val('');
                    $("#modGoniometriaDerecha").val('');
                    $("#modGoniometriaIzquierda").val('');
                    $("#modAgregarGoniometria").hide();
                }
            });
        }


    });

    $("#guardar").on('click',function(){
        var $_token = $("#_token").val();
        var episidio = $("#epi_id").val();
        var evaEstatico = $("#evaEstatico").val();
        var evaDinamico = $("#evaDinamico").val();
        var frecuencia = $("#frecuencia").val();
        var zona = $("#zona").val();
        var anamnesisActual = $("#anamnesisActual").val();
        var anamnesisRemota = $("#anamnesisRemota").val();
        var examenes = $("#examenes").val();
        var inspeccion = $("#inspeccion").val();
        var palpacion = $("#palpacion").val();
        var sensibilidad = $("#sensibilidad").val();
        var movilizacion = $("#movilizacion").val();

        var motivoConsulta = $("#motivoConsulta").val();
        var especialidad = $("#session_especialidad_id").val();


        $.ajax({
            url:   '/guardarFoto',
            data: { nombre_imagen:episidio ,
                evaEstatico:evaEstatico ,
                evaDinamico:evaDinamico ,
                frecuencia:frecuencia,
                zona:zona,
                anamnesisActual:anamnesisActual,
                anamnesisRemota:anamnesisRemota,
                examenes:examenes,
                inspeccion:inspeccion,
                palpacion:palpacion,
                sensibilidad:sensibilidad,
                movilizacion:movilizacion,
                motivoConsulta:motivoConsulta,
                img : canvas.toDataURL(),
                _token:$_token},
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiAnamnesisKine?esb_id='+esb_id+'&epi_id='+episidio+'&especialidad_id='+especialidad);

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