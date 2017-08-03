@yield('resultadoBusqueda')
<script>
    $("#listaPacientes tbody tr").on('click',function(){
        var id = $(this).attr('id');
        var esb_id = $("#establecimiento").val();
        var usu_id = $("#session_usu_id").val();
        var url_ini = '?3d27c2e24377377bdd907962a53e13eb';
        var onlyUrl = window.location.href.replace(window.location.search,url_ini);
        window.history.pushState('#', "Titulo", url_ini);
        var token = $("#_token").val();
        var validador = guardamosVariableSession(id,token);
        if(validador.code){
            //$("#contenedor").load('indexFicha?pcp='+id);
            //alert("indexFicha?3d27c2e24377377bdd907962a53e13eb=1");
            $("#contenedor").load('indexFicha');
        }

    });

    function guardamosVariableSession(pcp_id,token){
        var validador = $.ajax({
            url:   'guardamosVariableSessionPaciente?pcp_id='+pcp_id+'&_token='+token,
            type:  'post',
            dataType: 'json',
            async: false
        });

        return validador.responseJSON;
    }
</script>