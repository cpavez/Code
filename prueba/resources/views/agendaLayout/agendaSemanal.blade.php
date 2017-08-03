<style>
    #contenido_agenda{
        overflow-x: hidden !important;
    }
    html{
        background: #fff !important;
    }
    #modificadoPorAgenda{
        height: 1024px !important;
    }
</style>

<div  id='div_cont' style="position:absolute;top:10px;left:0px;right:0px;bottom:0;">
    <div id='calendar'></div>
</div>
@yield('modAgregar')
@yield('modModificar')
@yield('paciente')
<script>

    $("#pagina").val('agendaSemanal');

    $("#medico").show();
    $(document).ready(function() {
        var establecimiento = $("#establecimiento").val();
        var medico	= $("#medico").val();
        var $_token = $("#_token").val();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: new Date(),
            hiddenDays: [0],
            defaultView: 'agendaWeek',
            selectable: true,
            minTime: '08:00:00',
            maxTime: '21:00:00',
            scrollTime: '08:00:00',
            select: function(start, end, allDay) {
                $("#mostrarFecha").html(start.format('DD MMM YYYY H:mm'));
                $('#modAgendar').modal('show');
                $("#mod_fecha").val(allDay);
                $("#mod_fini").val(start);
                $("#mod_ffin").val(end);
                limpiar();
                $('#element option[value="1"]').attr("selected", "selected");


                $('#calendar').fullCalendar('unselect');
            },
            editable: true,
            eventResize: function(event, delta, revertFunc) {
                swal({
                        title: "Usted esta seguro?",
                        text: "Usted esta modificando la Hora de la cita!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Si, cambiar!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url:   'agendaModificarFecha?id='+event.id+'&start='+event.start.format()+'&end='+event.end.format()+'&_token='+$_token,
                                type:  'post',
                                success:  function (data) {
                                    console.log(data);
                                    swal("Modificado!", "Se acaba de modificar la hora de la Cita", "success");
                                    var ip = document.domain;
                                    if (location.protocol != 'https:'){
                                        var socket = io.connect("http://"+ip+":3002");
                                    }else{
                                        var socket = io.connect("https://"+ip+":3001", {secure: true});
                                    }
                                    socket.emit('insertAgendaDia', { 'establecimiento': establecimiento });
                                }
                            });
                        } else {
                            swal("Cancelado", "Se volvio al horario origen :)", "error");
                            revertFunc();
                        }
                    });

            },
            eventClick: function(event, element) {
                event.loading = true;
                event.site = "internal";

                $('#modModificar').modal('show');
                $("#mostrarFechaMod").html(moment(event.start).format("DD MMM YYYY H:mm"));
                $("#evento_id").val(event.id);
                $("#paciente_mod").val(event.title);
                $("#paciente_mod_id").val(event.pcp_id);
                $("#comentario_mod").val(event.comentario);
                console.log(event.estado);
                $('#estado_mod option[value="'+event.estado+'"]').attr("selected", "selected");
                //$("#estado_mod option:eq('"+event.estado+"')").prop('selected', true);
                $("#evento").val(event);
            },
            eventDrop: function(event, delta, revertFunc) {
                swal({
                        title: "Usted esta seguro?",
                        text: "Usted esta moviendo una cita hacia otra Hora o Día!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "Si, mover!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url:   'agendaModificarUbicacion?id='+event.id+'&start='+event.start.format()+'&end='+event.end.format()+'&_token='+$_token,
                                type:  'post',
                                success:  function (data) {
                                    console.log(data);
                                    swal("Modificado!", "Se acaba de mover el Evento", "success");
                                    var ip = document.domain;
                                    if (location.protocol != 'https:'){
                                        var socket = io.connect("http://"+ip+":3002");
                                    }else{
                                        var socket = io.connect("https://"+ip+":3001", {secure: true});
                                    }
                                    socket.emit('insertAgendaDia', { 'establecimiento': establecimiento });
                                }
                            });
                        } else {
                            swal("Cancelado", "Se volvio a la ubicación de origen :)", "error");
                            revertFunc();
                        }
                    });
            },
            eventLimit: true,
            events: {
                url: 'eventos?esb_id='+establecimiento+'&fun_id='+medico,
                error: function(e) {
                    console.log(e);
                    swal("Error!", "Problemas al leer los eventos", "error");
                }
            }
        });





        $('#fNacimiento').datetimepicker({
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

        $('#rut').Rut({
            on_error: function(){ swal("Error", "Se ingresado un Rut erroneo", "error"); },
            format_on: 'keyup'
        });

        $('#rut').blur(function(){
            var rut = $("#rut").val();
            var rut_ = $.Rut.quitarFormato(rut);
            var rut_simple = rut_.slice(0,-1);
            if(rut_.length > 2){
                $.ajax({
                    url:   'pacienteBuscar?rut='+rut_simple+'&_token='+$_token,
                    type:  'post',
                    success:  function (data) {
                        console.log(data);
                        if(data.codigo == 0){
                            $("#pcp_text_id").val(data.pcp_id);
                            $("#nombres").val(data.pcp_nombres);
                            $("#apePaterno").val(data.pcp_ape_paterno);
                            $("#apeMaterno").val(data.pcp_ape_materno);
                            $("#fNacimiento").val(data.pcp_fecha_nacimiento);
                            $("#email").val(data.pcp_email);
                            $('#ciudad option[value="'+data.pcp_ciu_id+'"]').attr("selected", "selected");
                            $('#convenio option[value="'+data.pcp_con_id+'"]').attr("selected", "selected");
                            $('#sexo option[value="'+data.pcp_sex_id+'"]').attr("selected", "selected");
                            $("#telefonoFijo").val(data.pcp_telefono_fijo);
                            $("#direccion").val(data.pcp_direccion);
                            $("#telefonoMovil").val(data.pcp_telefono_movil);

                            $("#guardarPaciente").hide();
                            $("#modificarPaciente").show();
                        }
                    }
                });
            }
        });

        $("#guardarPaciente").click(function(){

            var rut = $("#rut").val();
            var rut_simple = $.Rut.quitarFormato(rut);
            var rut_       = rut_simple.slice(0,-1);
            var dv         = rut_simple.slice(-1);
            var nombres = $("#nombres").val();
            var apePaterno = $("#apePaterno").val();
            var apeMaterno = $("#apeMaterno").val();
            var fNacimiento = $("#fNacimiento").val();
            var email = $("#email").val();
            var convenio = $("#convenio").val();
            var sexo = $("#sexo").val();
            var tFijo = $("#telefonoFijo").val();
            var tMovil = $("#telefonoMovil").val();
            var ciudad = $("#ciudad").val();
            var direccion = $("#direccion").val();
            var $_token = $("#_token").val();

            var valida = true;
            var mensaje = '';

            if(rut == ''){
                valida = false;
                mensaje = 'Favor de Ingresar el Rut';
            }else if(nombres == ''){
                valida  = false;
                mensaje = 'Favor de Ingresar el Nombre';
            }else if(apePaterno == ''){
                valida  = false;
                mensaje = 'Favor de Ingresar el Apellido Paterno';
            }else if(apeMaterno == ''){
                valida  = false;
                mensaje = 'Favor de Ingresar el Apellido Materno';
            }else if(tFijo == '' && tMovil == ''){
                valida  = false;
                mensaje = 'Favor de Ingresar al menos un telefono';
            }else if(sexo == ''){
                valida  = false;
                mensaje = 'Favor de Ingresar el Genero';
            }else if(ciudad == ''){
                valida  = false;
                mensaje = 'Favor de Ingresar la Ciudad de Recidencia';
            }else if(convenio == ''){
                valida  = false;
                mensaje = 'Favor de Seleccionar un Convenio';
            }

            if(valida == true){
                var arr =  "rut="+rut_;
                arr += "&dv="+dv;
                arr += "&nombres="+nombres;
                arr += "&apePaterno="+apePaterno;
                arr += "&apeMaterno="+apeMaterno;
                arr += "&fNacimiento="+fNacimiento;
                arr += "&email="+email;
                arr += "&convenio="+convenio;
                arr += "&sexo="+sexo;
                arr += "&tFijo="+tFijo;
                arr += "&tMovil="+tMovil;
                arr += "&ciudad="+ciudad;
                arr += "&direccion="+direccion;
                arr += "&_token="+$_token;

                $.ajax({
                    url:   'pacienteAgregar?'+arr,
                    type:  'post',
                    success:  function (data) {
                        console.log(data);
                        $("#paciente_id").val(data.pcp_id);
                        $("#paciente").val(data.pcp_nombres);
                        $('#modPaciente').modal('hide');
                    }
                });
            }else{
                swal("Problemas", mensaje, "error");
            }

        });



        $("#modificarPaciente").click(function(){

            var rut = $("#rut").val();
            var rut_simple = $.Rut.quitarFormato(rut);
            var rut_       = rut_simple.slice(0,-1);
            var dv         = rut_simple.slice(-1);
            var nombres = $("#nombres").val();
            var apePaterno = $("#apePaterno").val();
            var apeMaterno = $("#apeMaterno").val();
            var fNacimiento = $("#fNacimiento").val();
            var email = $("#email").val();
            var convenio = $("#convenio").val();
            var sexo = $("#sexo").val();
            var tFijo = $("#telefonoFijo").val();
            var tMovil = $("#telefonoMovil").val();
            var pcp_id = $("#pcp_text_id").val();
            var ciudad = $("#ciudad").val();
            var direccion = $("#direccion").val();
            var $_token = $("#_token").val();

            var arr =  "rut="+rut_;
            arr += "&nombres="+nombres;
            arr += "&dv="+dv;
            arr += "&apePaterno="+apePaterno;
            arr += "&apeMaterno="+apeMaterno;
            arr += "&fNacimiento="+fNacimiento;
            arr += "&email="+email;
            arr += "&convenio="+convenio;
            arr += "&sexo="+sexo;
            arr += "&tFijo="+tFijo;
            arr += "&tMovil="+tMovil;
            arr += "&pcp_id="+pcp_id;
            arr += "&ciudad="+ciudad;
            arr += "&direccion="+direccion;
            arr += "&_token="+$_token;



            $.ajax({
                url:   'pacienteModificar?'+arr,
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $("#paciente_id").val(data.pcp_id);
                    $("#paciente").val(data.pcp_nombres);
                    $('#modPaciente').modal('hide');
                    /*var ip = document.domain;
                    var socket = io("http://"+ip+":3002");
                    socket.emit('insertAgendaDia', { 'establecimiento': establecimiento });*/
                }
            });
        });


        //autocomplite
        var pacientes = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('nombre'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: "/pacientes?nombre=%QUERY",
                wildcard: '%QUERY'
            }
        });

        pacientes.initialize();

        $('#paciente').typeahead({
                hint: true,
                highlight: true,
                minLength: 1,
                order: "asc"
            },
            {
                source: pacientes.ttAdapter(),
                name: 'list_pacientes',
                displayKey: function(pacientes) {
                    return pacientes.pcp_nombre;
                }
            }).bind("typeahead:selected", function(obj, datum, name) {
            console.log(datum.id);
            $("#paciente_id").val(datum.pcp_id);
        });

        $('#paciente_mod').typeahead({
                hint: true,
                highlight: true,
                minLength: 1,
                order: "asc"
            },
            {
                source: pacientes.ttAdapter(),
                name: 'list_pacientes',
                displayKey: function(pacientes) {
                    return pacientes.pcp_nombre;
                }
            }).bind("typeahead:selected", function(obj, datum, name) {
            console.log(datum.pcp_id);
            $("#paciente_mod_id").val(datum.pcp_id);
        });



        //Agenda

        $("#btn_siguiente").click(function(){
            $('#calendar').fullCalendar('next');
        });

        $("#btn_anterior").click(function(){
            $('#calendar').fullCalendar('prev');
        });

        $("#btn_hoy").click(function(){
            $('#calendar').fullCalendar('today');
        });



        $("#eliminar").click(function(){
            var evento  = $("#evento_id").val();
            var $_token = $("#_token").val();
            $.ajax({
                url:   'agendaEliminar?id='+evento+'&_token='+$_token,
                type:  'post',
                success:  function (data) {
                    console.log(data);
                    $('#calendar').fullCalendar('removeEvents', evento);
                    $('#modModificar').modal('hide');
                    var ip = document.domain;
                    if (location.protocol != 'https:'){
                        var socket = io.connect("http://"+ip+":3002");
                    }else{
                        var socket = io.connect("https://"+ip+":3001", {secure: true});
                    }
                    socket.emit('insertAgendaDia', { 'establecimiento': establecimiento });
                }
            });

        });

        $('#modificar').click(function(){
            var evento  = $("#evento_id").val();
            var paciente = $("#paciente_mod").val();
            var pcp_id = $("#paciente_mod_id").val();
            var comentario = $("#comentario_mod").val();
            var estado = $("#estado_mod").val();
            var event = $('#calendar').fullCalendar('clientEvents', evento);
            var $_token = $("#_token").val();
            event = event[0];

            if(evento != ''){
                event.title = paciente;
                event.comentario = comentario.toUpperCase();
                event.estado = estado;
                event.pcp_id = pcp_id;

                if(estado == 1){
                    event.color = '#FF5D55';
                }
                if(estado == 2){
                    event.color = '#E9F29B';
                }
                if(estado == 3){
                    event.color = '#FEF8A0';
                }
                if(estado == 4){
                    event.color = '#C9F1FD';
                }
                if(estado == 5){
                    event.color = '#AEDD94';
                }
                if(estado == 6){
                    evento.color = '#FFA382';
                }


                $.ajax({
                    url:   'agendaModificar?paciente='+event.pcp_id+'&comentario='+event.comentario+'&estado='+event.estado+'&id='+event.id+'&_token='+$_token,
                    type:  'post',
                    success:  function (data) {
                        console.log(data);
                        $('#calendar').fullCalendar('updateEvent',event);
                        $('#modModificar').modal('hide');
                        var ip = document.domain;
                        if (location.protocol != 'https:'){
                            var socket = io.connect("http://"+ip+":3002");
                        }else{
                            var socket = io.connect("https://"+ip+":3001", {secure: true});
                        }
                        socket.emit('insertAgendaDia', { 'establecimiento': establecimiento });
                    }
                });



            }else{
                swal("Ups! hay un error!",'Contactece con el Administrador.', "error");
            }
        });

        $('#guardar').click(function(){
            var start      = new Date($("#mod_fini").val());
            var end        = new Date($("#mod_ffin").val());

            start	= start.toISOString();
            end		= end.toISOString();

            var paciente   = $("#paciente").val();
            var pcp_id 	   = $("#paciente_id").val();
            var comentario = $("#comentario").val();
            var estado     = $("#estado").val();
            var color 	   = '';
            var medico	   = $("#medico").val();
            var $_token = $("#_token").val();


            if(estado == 1){
                color = '#FF5D55';
            }
            if(estado == 2){
                color = '#E9F29B';
            }
            if(estado == 3){
                color = '#FEF8A0';
            }
            if(estado == 4){
                color = '#C9F1FD';
            }
            if(estado == 5){
                color = '#AEDD94';
            }
            if(estado == 6){
                color = '#FFA382';
            }

            if(paciente != '' && comentario != ''){
                $.ajax({
                    url:   'agendaAgregar?paciente='+pcp_id+'&comentario='+comentario+'&estado='+estado+'&start='+start+'&end='+end+'&medico='+medico+'&esb_id='+establecimiento+'&_token='+$_token,
                    type:  'post',
                    success:  function (data) {
                        console.log(data);
                        $('#calendar').fullCalendar('renderEvent',
                            {
                                id: data.insertId,
                                title: paciente,
                                pcp_id: pcp_id,
                                start: start,
                                end: end,
                                startEditable: false,
                                rendering: false,
                                comentario: comentario.toUpperCase(),
                                estado: estado,
                                color: color,
                                editable: true,
                                startEditable: true,
                                rendering: true
                            },true);
                        $('#modAgendar').modal('hide');
                        var ip = document.domain;
                        if (location.protocol != 'https:'){
                            var socket = io.connect("http://"+ip+":3002");
                        }else{
                            var socket = io.connect("https://"+ip+":3001", {secure: true});
                        }
                        socket.emit('insertAgendaDia', { 'establecimiento': establecimiento });
                    }
                });

            }else{
                swal("Ups! hay un error!",'Debe completar los campos.', "error");
            }
        });


        $('#bloquear').click(function(){
            var start      = new Date($("#mod_fini").val());
            var end        = new Date($("#mod_ffin").val());
            var medico	   = $("#medico").val();
            var pcp_id 	   = 1;
            var establecimiento = $("#establecimiento").val();
            var $_token = $("#_token").val();

            start	= start.toISOString();
            end		= end.toISOString();

            $.ajax({
                url:   'agendaBloquear?start='+start+'&end='+end+'&medico='+medico+'&pcp_id='+pcp_id+'&esb_id='+establecimiento+'&_token='+$_token,
                type:  'post',
                success:  function (data) {
                    $('#calendar').fullCalendar('renderEvent',
                        {
                            id: data.insertId,
                            title: 'Bloqueado!',
                            start: start,
                            end: end,
                            color: '#7D7E7A',
                            editable: false,
                            startEditable: false,
                            rendering: false
                        },true);
                    $('#modAgendar').modal('hide');
                }
            });



        });





    });


    $(".fc-left").append('<button id="AE_btn_pdf" type="button" class="fc-next-button fc-button fc-state-default fc-corner-left fc-corner-right">PDF</button>');

    $("#AE_btn_pdf").click(function () {
        //#AEFC is my div for FullCalendar
        html2canvas($('.fc-view-container'), {
            background: "#ffffff",
            logging: true,
            useCORS: true,
            quality: 1.0,
            onrendered: function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg",1);

                var imgWidth = 295;
                var pageHeight = 295;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;

                var doc = new jsPDF('landscape', 'mm');
                var position = 0;

                doc.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'JPEG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                doc.save('Calendario.pdf');﻿

            }
        }) ;
    });

    function limpiar(){
        $("#paciente").val('');
        $("#paciente_id").val('');
        $("#comentario").val('');
        $("#rut").val('');
        $("#pcp_text_id").val('');
        $("#nombres").val('');
        $("#apePaterno").val('');
        $("#apeMaterno").val('');
        $("#fNacimiento").val('');
        $("#email").val('');
        $('#convenio option[value="1"]').attr("selected", "selected");
        $('#sexo option[value="1"]').attr("selected", "selected");
        $("#telefonoFijo").val('');
        $("#telefonoMovil").val('');
        $("#direccion").val('');
    }




</script>