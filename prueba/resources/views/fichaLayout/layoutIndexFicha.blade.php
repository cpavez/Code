<style>
    .nav-header{
        background-color: #00aea4 !important;
    }

    @media (min-width: 1200px){
        .conenedor_mod {
            width: 82% !important;
        }
    }

    .panel-heading {
        background-color: #19a1d7 !important;
        border-color: #19a1d7 !important;
        color: #fff !important;
    }

    .nav>li.active>a{
        background: #19a1d7 !important;
        border-color: #19a1d7 !important;
    }

</style>
@yield('menu')

<input type="hidden" id='pcp_id' value="{{$pcpID}}" />
<div class="col-lg-10 contenedor conenedor_mod">
    <div id='contenido' class="bs_timeline_rigth" style="margin-top: 0px;border: 1px solid #D6D6D6;position: absolute;right: 0;left: 0;top: 0;bottom: 0;">
    </div>
</div>
<script>
    $("#menu_paciente > li").click(function(){
        var pcp_id = $("#pcp_id").val();
        var esb_id = $("#establecimiento").val();
        var especialidad_id = $("#session_especialidad_id").val();
        if(this.id){

            $("#menu_paciente > li").removeClass("active");
            $(this).addClass("active");
            $("#contenido").load(this.id+'?pcp_id='+pcp_id+'&esb_id='+esb_id+'&esp_id='+especialidad_id);

        }
    });
</script>