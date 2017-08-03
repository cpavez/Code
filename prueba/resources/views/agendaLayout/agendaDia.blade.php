<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
        border-bottom: 1px solid #414141;
    }
</style>
<div id="agendaDia">
@yield('citas')
@yield('agendaDia')
</div>
<script>
    $("#pagina").val('agendaDia');
    $("#medico").show();
    var date = new Date();
    setFecha(date);
    var establecimiento = $("#establecimiento").val();

    $(".estado").on('change',function(){
        var obj_tr = $(this).parent().parent();
        var id     = obj_tr[0].id;
        var est_id = this.value;
        var $_token = $("#_token").val();


        $.ajax({
            url:   'estadoAgendaModificar?age_id='+id+'&est_id='+est_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#"+id+" td:nth-child(1)").removeClass().addClass('est_'+est_id);
                var ip = document.domain;
                if (location.protocol != 'https:'){
                    var socket = io.connect("http://"+ip+":3002");
                }else{
                    var socket = io.connect("https://"+ip+":3001", {secure: true});
                }

                var i = 1;
                socket.on("connect", function() {
                    if(i == 1){
                        socket.emit("insertAgendaDia", { 'establecimiento': establecimiento });
                        socket.emit("insertPaciente", { 'establecimiento': establecimiento });
                    }
                    i++;
                });
            }
        });

    });

    function setFecha(var_fecha){

        var meses 		= new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        var diasSemana  = new Array ("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

        var dia 		= var_fecha.getDate();
        var dia_palabta = diasSemana[var_fecha.getDay()]

        var mes 		= var_fecha.getMonth()+1;
        var mes_palabra = meses[var_fecha.getMonth()];

        var ano 		= var_fecha.getFullYear();

        var fecha_completa = dia_palabta+' '+dia+'<br>'+mes_palabra+' '+ano;

        $("#fecha_palabras").html(fecha_completa);

    }

    $(function () {

        var ip = document.domain;
        if (location.protocol != 'https:'){
            var socket = io.connect("http://"+ip+":3002");
        }else{
            var socket = io.connect("https://"+ip+":3001", {secure: true});
        }

        socket.on('updateAgendaDia', function (data) {
            var i = 1;

                console.log(data.establecimiento);

                var establecimiento = $("#establecimiento").val();
                var fun_id = $("#medico").val();
                var pagina = $("#pagina").val();
                var objeto = $(".btn-primary");

                var id = objeto[0].id;


                if(establecimiento == data.establecimiento){
                    if(i < 2){
                        if(id == 'agendaSemanal'){
                            $("#contenido_agenda").load('agendaSemanal?esb_id='+establecimiento);
                        }else if(id == 'agendaDia'){
                            $("#contenido_agenda").load('agendaDia?esb_id='+establecimiento+'&fun_id='+fun_id);
                        }
                    }

                }
            i++;

        });

    })

</script>