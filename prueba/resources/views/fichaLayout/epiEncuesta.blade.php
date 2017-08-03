<style>
    /* Make the well behave for the demo */
    .popover-demo {
        margin-top: 5em
    }
    /* Popover styles */
    .popover .close {
        position: absolute;
        top: 8px;
        right: 10px;
    }
    .popover-title {
        padding-right: 30px;
    }
    .tt-dropdown-menu{
        height:300px;
        width: 600px;
        overflow: auto;
        font-size: 10px;
    }
</style>
<div id="conOdonto">
    @yield('odontograma')
</div>
<script>
    var arrayPuente = [];
    var fractura = [];
    var restauracion = [];
    var extraidos = [];
    var extraer = [];
    var puente = [];
    var procedimiento = [];
    window.URL = window.URL || window.webkitURL;
    function replaceAll(find, replace, str) {
        return str.replace(new RegExp(find, 'g'), replace);
    }

    function createOdontogram() {
        var htmlLecheLeft = "",
            htmlLecheRight = "",
            htmlLeft = "",
            htmlRight = "",
            a = 1;
        for (var i = 9 - 1; i >= 1; i--) {
            //Dientes Definitivos Cuandrante Derecho (Superior/Inferior)
            htmlRight += '<div data-name="value" id="dienteindex' + i + '" class="diente">' +
                '<span style="margin-left: -45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-info">index' + i + '</span>' +
                '<div id="tindex' + i + '" class="cuadro click" data-toggle="popover" data-placement="right" >' +
                '</div>' +
                '<div id="lindex' + i + '" class="cuadro izquierdo click" data-toggle="popover" data-placement="right">' +
                '</div>' +
                '<div id="bindex' + i + '" class="cuadro debajo click" data-toggle="popover" data-placement="right" >' +
                '</div>' +
                '<div id="rindex' + i + '" class="cuadro derecha click click" data-toggle="popover" data-placement="right" >' +
                '</div>' +
                '<div id="cindex' + i + '" class="centro click" data-toggle="popover" data-placement="right" >' +
                '</div>' +
                '</div>';
            //Dientes Definitivos Cuandrante Izquierdo (Superior/Inferior)
            htmlLeft += '<div id="dienteindex' + a + '" class="diente">' +
                '<span style="margin-left: -45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-info">index' + a + '</span>' +
                '<div id="tindex' + a + '" class="cuadro click" data-toggle="popover" data-placement="right">' +
                '</div>' +
                '<div id="lindex' + a + '" class="cuadro izquierdo click" data-toggle="popover" data-placement="right">' +
                '</div>' +
                '<div id="bindex' + a + '" class="cuadro debajo click" data-toggle="popover" data-placement="right">' +
                '</div>' +
                '<div id="rindex' + a + '" class="cuadro derecha click click" data-toggle="popover" data-placement="right">' +
                '</div>' +
                '<div id="cindex' + a + '" class="centro click" data-toggle="popover" data-placement="right">' +
                '</div>' +
                '</div>';
            if (i <= 5) {
                //Dientes Temporales Cuandrante Derecho (Superior/Inferior)
                htmlLecheRight += '<div id="dienteLindex' + i + '" style="left: -25%;" class="diente-leche">' +
                    '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-primary">index' + i + '</span>' +
                    '<div id="tlecheindex' + i + '" class="cuadro-leche top-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="llecheindex' + i + '" class="cuadro-leche izquierdo-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="blecheindex' + i + '" class="cuadro-leche debajo-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="rlecheindex' + i + '" class="cuadro-leche derecha-leche click click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="clecheindex' + i + '" class="centro-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '</div>';
            }
            if (a < 6) {
                //Dientes Temporales Cuandrante Izquierdo (Superior/Inferior)
                htmlLecheLeft += '<div id="dienteLindex' + a + '" class="diente-leche">' +
                    '<span style="margin-left: 45px; margin-bottom:5px; display: inline-block !important; border-radius: 10px !important;" class="label label-primary">index' + a + '</span>' +
                    '<div id="tlecheindex' + a + '" class="cuadro-leche top-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="llecheindex' + a + '" class="cuadro-leche izquierdo-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="blecheindex' + a + '" class="cuadro-leche debajo-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="rlecheindex' + a + '" class="cuadro-leche derecha-leche click click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '<div id="clecheindex' + a + '" class="centro-leche click" data-toggle="popover" data-placement="right">' +
                    '</div>' +
                    '</div>';
            }
            a++;
        }
        $("#tr").append(replaceAll('index', '1', htmlRight));
        $("#tl").append(replaceAll('index', '2', htmlLeft));
        $("#tlr").append(replaceAll('index', '5', htmlLecheRight));
        $("#tll").append(replaceAll('index', '6', htmlLecheLeft));


        $("#bl").append(replaceAll('index', '3', htmlLeft));
        $("#br").append(replaceAll('index', '4', htmlRight));
        $("#bll").append(replaceAll('index', '7', htmlLecheLeft));
        $("#blr").append(replaceAll('index', '8', htmlLecheRight));

    }

    function listarOdontograma(){
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();


        $.ajax({
            url:   '/listarOdontograma?epi_id='+epi_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                var fracturas = (data.fracturas ? data.fracturas : '');
                var obsturacion = (data.obsturacion ? data.obsturacion : '');
                var extraccion = (data.extraccion ? data.extraccion : '');
                var por_extraccion = (data.por_extraccion ? data.por_extraccion : '');

                if(fracturas != ''){
                    $.each(fracturas, function( index, value ) {
                        $('#'+value).addClass('click-red');
                        fractura.push(value);
                    });
                }

                if(obsturacion != ''){
                    $.each(obsturacion, function( index, value ) {
                        $('#'+value).addClass('click-blue');
                        restauracion.push(value);
                    });
                }

                if(extraccion != ''){
                    $.each(extraccion, function( index, value ) {
                        $('div[id*='+value+'][class*=click]').addClass('click-delete');
                        extraidos.push(value);
                    });
                }

                if(por_extraccion != ''){
                    $.each(por_extraccion, function( index, value ) {
                        $('div[id*='+value+'][class*=click]').addClass('click-delete-red');
                        extraer.push(value);
                    });
                }


            }
        });
    }

    $(document).ready(function() {
        createOdontogram();
        listarOdontograma();

        $(function () {
            $('[data-toggle="popover"]').popover({trigger:"manual",html:true,placement:'bottom'});
        })
        $(".click").click(function(event) {
            var control = $("#controls").children().find('.active').attr('id');
            var cuadro = $(this).find("input[name=cuadro]:hidden").val();
            var piesa = $(this).attr('id');
            var noDiente = $(this).parent().children().first().text();
            var cuadrante = $(this).parent().parent().attr('id');
            //console.log($(this).attr('id'));
            //console.log(control);
            var $element = $(this);
            $element.attr('data-content',$('#content').html())
                    .attr('data-original-title',noDiente)
                    .popover('show')
                    .addClass('pop');


            switch (control) {
                case "fractura":
                    var noDiente = $(this).parent().children().first().text();
                    var cuadrante = $(this).parent().parent().attr('id');
                    var piesaEspecifica = $(this).attr('id');
                    if ($(this).hasClass("click-blue")) {
                        $(this).removeClass('click-blue');
                        $(this).addClass('click-red');
                        fractura.push(piesaEspecifica);
                    } else {
                        if ($(this).hasClass("click-red")) {
                            $(this).removeClass('click-red');
                            var indice = fractura.indexOf(piesaEspecifica);
                            fractura.splice(indice, 1);
                            $element.popover('hide');
                        } else {
                            $(this).addClass('click-red');
                            fractura.push(piesaEspecifica);
                        }

                    }
                    $element.attr('data-content',$('#content').html())
                        .attr('data-original-title',noDiente)
                        .popover('show')
                        .addClass('pop');

                    btnCerrar($element,null);
                    break;
                case "restauracion":
                    var noDiente = $(this).parent().children().first().text();
                    var cuadrante = $(this).parent().parent().attr('id');
                    var piesaEspecifica = $(this).attr('id');
                    if ($(this).hasClass("click-red")) {
                        $(this).removeClass('click-red');
                        $(this).addClass('click-blue');
                        restauracion.push(piesaEspecifica);
                    } else {
                        if ($(this).hasClass("click-blue")) {
                            $(this).removeClass('click-blue');
                            var indice = restauracion.indexOf(piesaEspecifica);
                            restauracion.splice(indice, 1);
                            $element.popover('hide');
                        } else {
                            $(this).addClass('click-blue');
                            restauracion.push(piesaEspecifica);
                        }
                    }
                    $element.attr('data-content',$('#content').html())
                        .attr('data-original-title',noDiente)
                        .popover('show')
                        .addClass('pop');

                    btnCerrar($element,null);
                    break;
                case "extraccion":
                    $element.popover('hide')
                        .removeClass('pop');
                    var dientePosition = $(this).position();
                    var eliminar = 0;
                    var agregar = 0;
                    $(this).parent().children().each(function(index, el) {
                        if ($(el).hasClass("click")) {
                            if($(el).hasClass("click-delete")){
                                $(el).removeClass('click-delete');
                                eliminar = 1;
                            }else{
                                $(el).addClass('click-delete');
                                agregar = 1;

                            }
                        }
                    });
                    if(eliminar == 1){
                        var indice = extraidos.indexOf(noDiente);
                        extraidos.splice(indice, 1);
                    }else if(agregar == 1){
                        extraidos.push(noDiente);
                    }


                    break;
                case "extraer":
                    var dientePosition = $(this).position();
                    var eliminar = 0;
                    var agregar = 0;
                    $(this).parent().children().each(function(index, el) {
                        if ($(el).hasClass("click")) {
                            if($(el).hasClass("click-delete-red")){
                                $(el).removeClass('click-delete-red');
                                eliminar = 1;
                                $element.popover('hide');
                            }else{
                                $(el).addClass('click-delete-red');
                                agregar = 1;
                                btnCerrar($element,el);

                            }
                        }
                    });
                    if(eliminar == 1){
                        var indice = extraer.indexOf(noDiente);
                        extraer.splice(indice, 1);
                    }else if(agregar == 1){
                        extraer.push(noDiente);
                    }
                    $element.attr('data-content',$('#contentExtraer').html())
                        .attr('data-original-title',noDiente)
                        .popover('show')
                        .addClass('pop');
                    break;
                case "puente":
                    $element.popover('hide')
                        .removeClass('pop');
                    var dientePosition = $(this).offset(), leftPX;
                    //console.log($(this)[0].offsetLeft)
                    var noDiente = $(this).parent().children().first().text();
                    var cuadrante = $(this).parent().parent().attr('id');
                    var left = 0,
                        width = 0,
                        top = 0;

                    //console.log(event.offsetX);
                    if (arrayPuente.length < 1) {
                        $(this).parent().children('.cuadro').css('border-color', 'red');
                        arrayPuente.push({
                            diente: noDiente,
                            cuadrante: cuadrante,
                            left: $(this)[0].offsetLeft,
                            //left: event.offsetX,
                            father: null
                        });
                    } else {
                        $(this).parent().children('.cuadro').css('border-color', 'red');
                        arrayPuente.push({
                            diente: noDiente,
                            cuadrante: cuadrante,
                            left: $(this)[0].offsetLeft,
                            //left: event.offsetX,
                            father: arrayPuente[0].diente
                        });
                        //agrega el otro diente para el puente
                        var diferencia = Math.abs((parseInt(arrayPuente[1].diente) - parseInt(arrayPuente[1].father)));
                        if (diferencia == 1){
                            width = diferencia * 60;
                        }else{
                            width = diferencia * 50;
                        }

                        if(arrayPuente[0].cuadrante == arrayPuente[1].cuadrante) {
                            if(arrayPuente[0].cuadrante == 'tr' || arrayPuente[0].cuadrante == 'tlr' || arrayPuente[0].cuadrante == 'br' || arrayPuente[0].cuadrante == 'blr') {
                                if (arrayPuente[0].diente > arrayPuente[1].diente) {
                                    if(arrayPuente[0].diente > 50 && arrayPuente[0].diente < 56){
                                        if(diferencia == 1){
                                            top = "65px";
                                            leftPX = "0px";
                                        }else{
                                            top = "65px";
                                            leftPX = "-45px";
                                        }
                                    }else{
                                        if(arrayPuente[0].diente > 80 && arrayPuente[0].diente < 86){
                                            if(diferencia == 1){
                                                top = "65px";
                                                leftPX = "0px";
                                            }else{
                                                top = "65px";
                                                leftPX = "-45px";
                                            }
                                        }else{
                                            leftPX = (parseInt(arrayPuente[0].left)+15)+"px";
                                            top = "80px";
                                        }
                                    }

                                }else {
                                    if(arrayPuente[1].diente > 50 && arrayPuente[1].diente < 56){
                                        if(diferencia == 1){
                                            top = "65px";
                                            leftPX = "50px";
                                        }else{
                                            top = "65px";
                                            leftPX = "55px";
                                        }
                                    }else{
                                        if(arrayPuente[1].diente > 80 && arrayPuente[1].diente < 86){
                                            if(diferencia == 1){
                                                top = "65px";
                                                leftPX = "45px";
                                            }else{
                                                top = "65px";
                                                leftPX = "55px";
                                            }
                                        }else{
                                            leftPX = (parseInt(arrayPuente[1].left)+10)+"px";
                                            top = "80px";
                                        }
                                    }

                                }
                            }else {
                                if (arrayPuente[0].diente < arrayPuente[1].diente) {
                                    if(arrayPuente[0].diente > 20 && arrayPuente[0].diente < 39){
                                        if(diferencia == 1){
                                            top = "80px";
                                            leftPX = (parseInt(arrayPuente[0].left)+10)+"px";
                                        }else{
                                            top = "80px";
                                            leftPX = (parseInt(arrayPuente[0].left)+18)+"px";
                                        }
                                    }else{
                                        if(diferencia == 1){
                                            leftPX = "0px";
                                            top = "65px";
                                        }else if(diferencia == 2){
                                            leftPX = "-45px";
                                            top = "65px";
                                            console.log("aca1");
                                        }else{
                                            leftPX = "-94px";
                                            top = "65px";
                                        }
                                    }
                                }else {
                                    if(arrayPuente[1].diente > 20 && arrayPuente[1].diente < 39){
                                        if(diferencia == 1){
                                            leftPX = (parseInt(arrayPuente[1].left)+15)+"px";
                                            top = "80px";
                                        }else{
                                            leftPX = (parseInt(arrayPuente[1].left)+15)+"px";
                                            top = "80px";
                                        }
                                    }else{
                                        leftPX = "55px";
                                        top = "65px";
                                    }
                                }
                            }
                        }
                        $(this).parent().append('<div style="z-index: 9999; height: 5px; width:' + width + 'px;" id="puente" class="click-red"></div>');
                        $(this).parent().children().last().css({
                            "position": "absolute",
                            "top": top,
                            "left": leftPX
                        });
                    }

                    break;
                case "borrar":
                    console.log(fractura);
                    console.log(restauracion);
                    console.log(extraidos);
                    console.log(extraer);
                    break;
                default:
                    console.log("borrar case");
            }




            return false;
        });
        return false;
    });

    function btnCerrar($element,$opcion){
        var i = 1;
        $element.on('shown.bs.popover', function () {
            if(i < 2){
                var popover = $element.data('bs.popover');
                if (typeof popover !== "undefined") {

                    var $tip = popover.tip();
                    zindex = $tip.css('z-index');

                    $tip.find('.close').bind('click', function () {
                        if($opcion == null){
                            $element.removeClass('click-blue');
                            $element.removeClass('click-red');
                        }else{
                            $($opcion).removeClass('click-delete-red');
                        }
                        popover.hide();
                    });

                    $tip.mouseover(function () {
                        $tip.css('z-index', function () {
                            return zindex * 100;
                        });
                    })
                        .mouseout(function () {
                            $tip.css('z-index', function () {
                                return zindex;
                            });
                        });

                    $tip.find('.addprocedimiento').bind('click', function () {
                        var control = $("#controls").children().find('.active').attr('id');
                        var cuadro = $element.find("input[name=cuadro]:hidden").val();
                        var piesa = $element.attr('id');
                        var noDiente = $element.parent().children().first().text();
                        var cuadrante = $element.parent().parent().attr('id');
                        var nombrePiesa = pieza(piesa);
                        procedimiento.push(nombrePiesa);
                        var nombreMostrar = '';
                        $.each( procedimiento, function( key, value ) {
                            nombreMostrar += value+';';
                        });
                        if($opcion != null){
                            $(".modal-title").html(noDiente);
                            $("#nombrePiesa").val(noDiente);
                        }else{
                            $(".modal-title").html(noDiente);
                            $("#nombrePiesa").val(nombreMostrar);
                        }

                        $('#modAgregarProcedimiento').modal('show');
                        popover.hide();
                    });

                    $tip.find('.addPieza').bind('click', function () {
                        var cuadro = $element.find("input[name=cuadro]:hidden").val();
                        var piesa = $element.attr('id');
                        var nombrePiesa = pieza(piesa);
                        procedimiento.push(nombrePiesa);
                        popover.hide();
                    });
                }
            }
            i++;
        });
    }

    function pieza(npiesa){
        var lado = npiesa.substr(0,1);
        var piesa = npiesa.substr(-2,2);
        var nombre = '';
        if(piesa < 19 & piesa > 10){
            switch (lado) {
                case 't':
                    nombre = 'VESTIBULAR';
                    break;
                case 'b':
                    nombre = 'LINGUAL';
                    break;
                case 'l':
                    nombre = 'DISTAL';
                    break;
                case 'r':
                    nombre = 'MESIAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 29 & piesa > 20){
            switch (lado) {
                case 't':
                    nombre = 'VESTIBULAR';
                    break;
                case 'b':
                    nombre = 'LINGUAL';
                    break;
                case 'l':
                    nombre = 'MESIAL';
                    break;
                case 'r':
                    nombre = 'DISTAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 49 & piesa > 40){
            switch (lado) {
                case 't':
                    nombre = 'LINGUAL';
                    break;
                case 'b':
                    nombre = 'VESTIBULAR';
                    break;
                case 'l':
                    nombre = 'DISTAL';
                    break;
                case 'r':
                    nombre = 'MESIAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 39 & piesa > 30){
            switch (lado) {
                case 't':
                    nombre = 'LINGUAL';
                    break;
                case 'b':
                    nombre = 'VESTIBULAR';
                    break;
                case 'l':
                    nombre = 'MESIAL';
                    break;
                case 'r':
                    nombre = 'DISTAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 56 & piesa > 51){
            cleche55
            switch (lado) {
                case 't':
                    nombre = 'VESTIBULAR';
                    break;
                case 'b':
                    nombre = 'LINGUAL';
                    break;
                case 'l':
                    nombre = 'DISTAL';
                    break;
                case 'r':
                    nombre = 'MESIAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 66 & piesa > 60){
            switch (lado) {
                case 't':
                    nombre = 'VESTIBULAR';
                    break;
                case 'b':
                    nombre = 'LINGUAL';
                    break;
                case 'l':
                    nombre = 'MESIAL';
                    break;
                case 'r':
                    nombre = 'DISTAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 86 & piesa > 80){
            switch (lado) {
                case 't':
                    nombre = 'LINGUAL';
                    break;
                case 'b':
                    nombre = 'VESTIBULAR';
                    break;
                case 'l':
                    nombre = 'DISTAL';
                    break;
                case 'r':
                    nombre = 'MESIAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }else if(piesa < 76 & piesa > 70){
            switch (lado) {
                case 't':
                    nombre = 'LINGUAL';
                    break;
                case 'b':
                    nombre = 'VESTIBULAR';
                    break;
                case 'l':
                    nombre = 'MESIAL';
                    break;
                case 'r':
                    nombre = 'DISTAL';
                    break;
                default:
                    nombre = 'CENTRAL';
                    break;
            }
        }
        return piesa+' '+nombre;
    }
    var esb_id = $("#establecimiento").val();
    var prestaciones = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace('descripcion'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: "/prestaciones?esb_id="+esb_id+"&descripcion=%QUERY",
            wildcard: '%QUERY'
        },
        limit: 10
    });

    prestaciones.initialize();


    $('#prestacion').typeahead({
            hint: true,
            highlight: true,
            minLength: 2,
            order: "asc"
        },
        {
            source: prestaciones.ttAdapter(),
            displayKey: function(prestaciones) {
                return prestaciones.denominacion;
            }
        }).bind("typeahead:selected", function(obj, datum, name) {
        console.log(datum.id);
        $("#pre_id").val(datum.id);
    });

    $("#agregarProcedimiento").on('click',function(){
        var prestacionID = $("#pre_id").val();
        var episodioID = $("#epi_id").val();
        var piesas = $("#nombrePiesa").val();
        var cantidad = $("#cantidad").val();
        var $_token   = $("#_token").val();

        $.ajax({
            url:   '/agregarPrestacionOdontograma?episodioID='+episodioID+'&prestacionID='+prestacionID+'&piesas='+piesas+'&cantidad='+cantidad+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#pre_id").val('');
                $("#nombrePiesa").val('');
                $("#cantidad").val('');
                $("#prestacion").val('');
                procedimiento = [];
                $("#listadoProcedimientos").load('listarPrestacionOdontograma?epi_id='+episodioID);
                $('#modAgregarProcedimiento').modal('hide');

            }
        });
    });

    $("#guardar").on('click',function(){
        var epi_id	  = $("#epi_id").val();
        var $_token   = $("#_token").val();
        var pcp_id = $("#pcp_id").val();
        var esb_id = $("#establecimiento").val();
        var usu_id = $("#session_usu_id").val();
        var especialidad = $("#session_especialidad_id").val();

        $.ajax({
            url:   '/agregarOdontograma?epi_id='+epi_id+'&fractura='+fractura+'&restauracion='+restauracion+'&extraidos='+extraidos+'&extraer='+extraer+'&usu_id='+usu_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                swal("Guardado!", "Se acaba de guardar el Odontograma", "success");
                $("#con_episodio").load('epiEncuesta?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id+'&especialidad_id='+especialidad);

            }
        });
    });
    var epi_id	  = $("#epi_id").val();
    $("#listadoProcedimientos").load('listarPrestacionOdontograma?epi_id='+epi_id);

    $("#listadoProcedimientos").on('click','.eliminarPrestacion',function(){
        var id = this.id;
        var $_token   = $("#_token").val();
        $.ajax({
            url:   '/eliminarPrestacionOdontograma?pod_id='+id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#listadoProcedimientos").load('listarPrestacionOdontograma?epi_id='+epi_id);

            }
        });

    });

</script>