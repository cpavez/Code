<style>
    .nav-tabs > li > a {
        margin-right: 2px;
        line-height: 1.42857143;
        border: 1px solid transparent;
        border-radius: 0px 0px 0 0;
    }
    #contenido{
        background-color: #EBEBEB;
    }
    .nav-tabs{
        border-bottom: 0;
    }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
        border-top: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 0;
        border-left: 0;
        -webkit-transition: all .1s ease-in-out;
        -moz-transition: all .1s ease-in-out;
        -ms-transition: all .1s ease-in-out;
        -o-transition: all .1s ease-in-out;
    }
    .btn-group > .btn-primary{
        background: #00bca4 !important;
        border-color: #00a792 !important;
    }
</style>

<div class="label-primary" style="background-color: #00bca4 !important; border-color: #00bca4 !important;   height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">
    Tratamientos
</div>
<input type="hidden" id='epi_id' value="{{$_GET['epi_id']}}" />
<input type="hidden" id="tipoTratamientoID" value="{{$tipo_episodio_id}}" />
@yield('menu')
<div id="con_episodio" style="  background-color: #fff;position: absolute;top: 74px;overflow-y: scroll;bottom: 0;left: 0;right: 0;">

</div>

<script>
    var pcp_id = $("#pcp_id").val();
    var esb_id = $("#establecimiento").val();
    var usu_id = $("#session_usu_id").val();
    var epi_id = $("#epi_id").val();
    var especialidad = $("#session_especialidad_id").val();


    $("#con_episodio").load('epiEpisodio?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id+'&especialidad_id='+especialidad);
    $("#epiEpisodio").addClass("active");


    $("#menu_episodio > li").click(function(){
        $("#menu_episodio > li").removeClass("active");
        $(this).addClass("active");
        $("#con_episodio").load(this.id+'?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id+'&especialidad_id='+especialidad);
    });
</script>