@extends('notes')
@section('contenido')
    <style>
        .nav-header{
            background-color: #00aea4 !important;
        }

        @media (min-width: 1200px){
            .conenedor_mod {
                width: 82% !important;
            }
        }
        .nav>li.active>a{
            background: #19a1d7 !important;
            border-color: #19a1d7 !important;
        }
    </style>
    @yield('menu')
    <div class="col-lg-10 contenedor conenedor_mod">
        <div id='contenidoCaja' class="bs_timeline_rigth" style="margin-top: 0px;border: 1px solid #D6D6D6;position: absolute;right: 0;left: 0;top: 0;bottom: 0;">
        </div>
    </div>

    <script>
        $("#menu_reportes > li").click(function(){
            var esb_id = $("#establecimiento").val();
            var pcp_id = 1;
            if(this.id){
                $("#menu_reportes > li").removeClass("active");

                $(this).addClass("active");

                $("#contenidoCaja").load(this.id+'?esb_id='+esb_id+'&pcp_id='+pcp_id);

            }
        });
    </script>
@stop