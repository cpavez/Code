@extends('notes')
@section('contenido')
    <style>
        .est_1 {
            background-color: #FF5D55;
            border-right: 1px solid #414141;
            border-left: 1px solid #414141;
            border-top: 0px solid #ddd !important;
            color: #fff;
        }
        .est_2{
            background-color: #E9F29B;
            border-right: 1px solid #414141;
            border-left: 1px solid #414141;
            border-top: 0px solid #ddd !important;
        }
        .est_3{
            background-color: #FEF8A0;
            border-right: 1px solid #414141;
            border-left: 1px solid #414141;
            border-top: 0px solid #ddd !important;
        }
        .est_4{
            background-color: #C9F1FD;
            border-right: 1px solid #414141;
            border-left: 1px solid #414141;
            border-top: 0px solid #ddd !important;
        }
        .est_5{
            background-color: #AEDD94;
            border-right: 1px solid #414141;
            border-left: 1px solid #414141;
            border-top: 0px solid #ddd !important;
        }
        .est_6{
            background-color: #FFA382;
            border-right: 1px solid #414141;
            border-left: 1px solid #414141;
            border-top: 0px solid #ddd !important;
        }
    </style>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Pacientes del Día</h3>
        </div>
        <div class="panel-body">
            @yield('buscador')
        </div>
    </div>
    <script>

        buscar(0);
        $('#rut').Rut({
            on_success: function(){
                var rut = $("#rut").val();
                var rut_ = $.Rut.quitarFormato(rut);
                var rut_simple = rut_.slice(0,-1);
                $("#rut_simple").val(rut_simple);

            },
            on_error: function(){ swal("Error", "Se ingresado un Rut erroneo", "error"); },
            format_on: 'keyup'
        });
        $("#buscarPaciente").click(function(){
            buscar(1);

        });

        function buscar(alerta){
            var rut = $("#rut_simple").val();
            var episodio = $("#episodio").val();
            var nombre = $("#nombre").val();
            var apellidoPaterno = $("#apellidoPaterno").val();
            var apellidoMaterno = $("#apellidoMaterno").val();
            var esb_id = $("#establecimiento").val();
            var usu_id = $("#session_usu_id").val();

            if(alerta == 1){
                if(rut != '' || episodio != '' || nombre != '' || apellidoPaterno != '' || apellidoMaterno != ''){
                    $("#listaPacientes").load('pacienteBuscarDiv?rut='+rut+'&episodio='+episodio+'&nombre='+nombre+'&apellidoPaterno='+apellidoPaterno+'&apellidoMaterno='+apellidoMaterno+'&esb_id='+esb_id+'&usu_id='+usu_id);
                }else{
                    swal("Error", "Debe llenar al menos un parametro de busqueda!", "error");
                }
            }else{
                $("#listaPacientes").load('pacienteBuscarDiv?rut='+rut+'&episodio='+episodio+'&nombre='+nombre+'&apellidoPaterno='+apellidoPaterno+'&apellidoMaterno='+apellidoMaterno+'&esb_id='+esb_id+'&usu_id='+usu_id);
            }

        }

        $(function () {
            var ip = document.domain;
            if (location.protocol != 'https:'){
                var socket = io.connect("http://"+ip+":3002");
            }else{
                var socket = io.connect("https://"+ip+":3001", {secure: true,rejectUnauthorized: false,verify: false});
            }

            socket.on('updateBuscaPaciente', function (data) {
                var i = 1;

                console.log(data.establecimiento);

                var rut = $("#rut_simple").val();
                var episodio = $("#episodio").val();
                var nombre = $("#nombre").val();
                var apellidoPaterno = $("#apellidoPaterno").val();
                var apellidoMaterno = $("#apellidoMaterno").val();
                var esb_id = $("#establecimiento").val();
                var usu_id = $("#session_usu_id").val();

                $("#listaPacientes").load('pacienteBuscarDiv?rut='+rut+'&episodio='+episodio+'&nombre='+nombre+'&apellidoPaterno='+apellidoPaterno+'&apellidoMaterno='+apellidoMaterno+'&esb_id='+esb_id+'&usu_id='+usu_id);

            });

        })
    </script>
@stop