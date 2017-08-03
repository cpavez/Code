@extends('notes')
@section('contenido')
<style>
    .center{
        text-align: center;
    }
    .no_border{
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
        border: 1px solid #414141;
        border-left: 0;
        border-right: 0;
    }
    .oaerror {
        margin: 0 auto; /* Centering Stuff */
        background-color: #FFFFFF; /* Default background */
        padding: 3px;
        border-left: 1px solid #eee;
        border-left-width: 5px;
        margin: 2px auto;
    }
    .line_1 {
        border-left-color: #FF5D55;
    }
    .line_2{
        border-left-color: #E9F29B;
    }
    .line_3{
        border-left-color: #FEF8A0;
    }
    .line_4{
        border-left-color: #C9F1FD;
    }
    .line_5{
        border-left-color: #AEDD94;
    }
    .line_6{
        border-left-color: #FFA382;
    }


    .est_1 {
        background-color: #FF5D55;
        border-right: 1px solid #414141;
        border-left: 1px solid #414141;
        border-top: 0px solid #ddd !important;
        border-bottom: 1px solid #414141 !important;
        color: #fff;
    }
    .est_2{
        background-color: #E9F29B;
        border-right: 1px solid #414141;
        border-left: 1px solid #414141;
        border-top: 0px solid #ddd !important;
        border-bottom: 1px solid #414141 !important;
    }
    .est_3{
        background-color: #FEF8A0;
        border-right: 1px solid #414141;
        border-left: 1px solid #414141;
        border-top: 0px solid #ddd !important;
        border-bottom: 1px solid #414141 !important;
    }
    .est_4{
        background-color: #C9F1FD;
        border-right: 1px solid #414141;
        border-left: 1px solid #414141;
        border-top: 0px solid #ddd !important;
        border-bottom: 1px solid #414141 !important;
    }
    .est_5{
        background-color: #AEDD94;
        border-right: 1px solid #414141;
        border-left: 1px solid #414141;
        border-top: 0px solid #ddd !important;
        border-bottom: 1px solid #414141 !important;
    }
    .est_6{
        background-color: #FFA382;
        border-right: 1px solid #414141;
        border-left: 1px solid #414141;
        border-top: 0px solid #ddd !important;
        border-bottom: 1px solid #414141 !important;
    }
    .borde_right{
        border-right: 1px solid #414141;
    }
    #contenedor{
        position: absolute !important;
        bottom: 0 !important;
        left: 0px !important;
        right: 0px !important;
        top: 0 !important;
    }
    .btn-primary {
        color: #fff !important;
        background-color: #337ab7 !important;
        border-color: #2e6da4 !important;
    }
</style>
<input type="hidden" id="pagina" value="">
<div class="col-lg-12 label-primary" style="position: absolute;
    top: 0px;
    bottom: 0;
    height: 37px;
    left: 0px;
    right: 0;
    background: #60baec !important;
    border-color: #60baec !important;
    border-bottom: 0;">
    <div class="col-sm-5" style='margin-top: 6px;'>
        <a class="btn btn-default btn-xs" href="#" role="button" id='agendaDia'>
            <span class="glyphicon glyphicon-time"></span> Agenda del Día
        </a>
        <a class="btn btn-default btn-xs" href="#" role="button" id='agendaSemanal'>
            <span class="glyphicon glyphicon-calendar"></span> Agregar Paciente
        </a>
        <a class="btn btn-default btn-xs" href="#" role="button" id='agendaGlobal'>
            <span class="glyphicon glyphicon-search"></span> Buscar Paciente
        </a>
    </div>
    <div class="col-sm-4">
        &nbsp;
    </div>
    @yield('medico')
</div>

<div class="col-lg-12" id='contenido_agenda' style="position: absolute;
    top: 36px;
    bottom: 0;
    padding-right: 0px;
    left: 0px;
    right: 0;
    /* border: 1px solid #B0ADA9; */
    padding-left: 0px;">

</div>



<script>

    var establecimiento = $("#establecimiento").val();


    var fun_id = $("#medico").val();
    $("#agendaGlobal").removeClass("btn-primary").addClass("btn-default");
    $("#agendaDia").removeClass("btn-primary").addClass("btn-default");
    $("#agendaSemanal").removeClass("btn-default").addClass("btn-primary");
    $("#contenido_agenda").load('agendaSemanal?esb_id='+establecimiento+'&fun_id='+fun_id);


    $("#agendaDia").click(function(){
        var fun_id = $("#medico").val();
        $("#agendaSemanal").removeClass("btn-primary").addClass("btn-default");
        $("#agendaGlobal").removeClass("btn-primary").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-primary");
        $("#contenido_agenda").load(this.id+'?esb_id='+establecimiento+'&fun_id='+fun_id);
    });
    $("#agendaSemanal").click(function(){
        $("#agendaDia").removeClass("btn-primary").addClass("btn-default");
        $("#agendaGlobal").removeClass("btn-primary").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-primary");
        $("#contenido_agenda").load(this.id+'?esb_id='+establecimiento);
    });
    $("#agendaGlobal").click(function(){
        var fun_id = $("#medico").val();
        $("#agendaSemanal").removeClass("btn-primary").addClass("btn-default");
        $("#agendaDia").removeClass("btn-primary").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-primary");
        $("#contenido_agenda").load(this.id+'?esb_id='+establecimiento+'&fun_id='+fun_id);
    });

    $("#medico").change(function(){
        var fun_id = this.value;
        var objeto = $(".btn-primary");

        var id = objeto[0].id;

        if(id == 'agendaSemanal'){
            $("#contenido_agenda").load('agendaSemanal');
        }else if(id == 'agendaDia'){
            $("#contenido_agenda").load('agendaDia?esb_id='+establecimiento+'&fun_id='+fun_id);
        }else{
            alert("Debe seleccionar una vista");
        }

    });

</script>
@stop