<style>
    #contenido_agenda{
        overflow-x: hidden !important;
    }

</style>


<input type="hidden" value="{{$_GET['pcp_id']}}" id='pcp_id'/>

<div  id='div_cont' style="position:absolute;top:10px;left:5px;right:5px;bottom:0;">
    <div id='calendar'></div>
</div>
@yield('modAgregar')
@yield('modModificar')
<script>



    $(document).ready(function() {
        var establecimiento = $("#establecimiento").val();
        var medico	= $("#session_usu_id").val();
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
                                url:   '/agendaModificarFecha?id='+event.id+'&start='+event.start.format()+'&end='+event.end.format()+'&_token='+$_token,
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
                                url:   '/agendaModificarUbicacion?id='+event.id+'&start='+event.start.format()+'&end='+event.end.format()+'&_token='+$_token,
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
                url: '/eventosFicha?esb_id='+establecimiento+'&usu_id='+medico,
                error: function(e) {
                    console.log(e);
                    swal("Error!", "Problemas al leer los eventos", "error");
                }
            }
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
                url:   '/agendaEliminar?id='+evento+'&_token='+$_token,
                type:  'post',
                success:  function (data) {
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
                    url:   '/agendaModificar?paciente='+event.pcp_id+'&comentario='+event.comentario+'&estado='+event.estado+'&id='+event.id+'&_token='+$_token,
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

            var paciente   = $("#paciente_").val();
            var pcp_id 	   = $("#paciente_id_").val();
            var comentario = $("#comentario_").val();
            var estado     = $("#estado_").val();
            var color 	   = '';
            var medico	   = $("#session_usu_id").val();
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
                    url:   '/agendaAgregarFicha?paciente='+pcp_id+'&comentario='+comentario+'&estado='+estado+'&start='+start+'&end='+end+'&medico='+medico+'&esb_id='+establecimiento+'&_token='+$_token,
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
            var establecimiento = $("#establecimiento").val();
            var pcp_id 	   = $("#paciente_id_").val();
            var medico	   = $("#session_usu_id").val();
            var $_token = $("#_token").val();

            start	= start.toISOString();
            end		= end.toISOString();

            $.ajax({
                url:   '/agendaBloquear?start='+start+'&end='+end+'&esb_id='+establecimiento+'&pcp_id='+pcp_id+'&medico='+medico+'&_token='+$_token,
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
        html2canvas($('#calendar'), {
            background: "#fff",
            logging: true,
            useCORS: true,
            onrendered: function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg");
                var doc = new jsPDF();
                doc.addImage(imgData, 'JPEG', 15, 40, 180, 160);
                download(doc.output(), "Calendario.pdf", "text/pdf");
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
    }


    function download(strData, strFileName, strMimeType) {
        var D = document,
            A = arguments,
            a = D.createElement("a"),
            d = A[0],
            n = A[1],
            t = A[2] || "text/plain";

        //build download link:
        a.href = "data:" + strMimeType + "," + escape(strData);

        if (window.MSBlobBuilder) {
            var bb = new MSBlobBuilder();
            bb.append(strData);
            return navigator.msSaveBlob(bb, strFileName);
        } /* end if(window.MSBlobBuilder) */

        if ('download' in a) {
            a.setAttribute("download", n);
            a.innerHTML = "downloading...";
            D.body.appendChild(a);
            setTimeout(function() {
                var e = D.createEvent("MouseEvents");
                e.initMouseEvent("click", true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                a.dispatchEvent(e);
                D.body.removeChild(a);
            }, 66);
            return true;
        } /* end if('download' in a) */

        //do iframe dataURL download:
        var f = D.createElement("iframe");
        D.body.appendChild(f);
        f.src = "data:" + (A[2] ? A[2] : "application/octet-stream") + (window.btoa ? ";base64" : "") + "," + (window.btoa ? window.btoa : escape)(strData);
        setTimeout(function() {
            D.body.removeChild(f);
        }, 333);
        return true;
    } /* end download() */

</script>