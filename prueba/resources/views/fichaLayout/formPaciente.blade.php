<style>
    .sel_con{
        float: left;
        width:85%;
    }
    .modal-backdrop {
        z-index: 0 !important;
    }
</style>
@yield('formulario')

@yield('modal')

<script>
    var rut = $("#rut_bd").val();
    var rut_format = $.formatRut(rut);
    $("#rut").val(rut_format);

    $('#rut').Rut({
        on_error: function(){ swal("Error", "Se ingresado un Rut erroneo", "error"); },
        format_on: 'keyup'
    });

    $("#modificar").click(function(){
        var nombres 		= $('#nombres').val();
        var apePaterno 		= $('#apellidoPaterno').val();
        var apeMaterno 		= $('#apellidoMaterno').val();
        var rut_ 			= $('#rut').val();
        var rut_simple 		= $.Rut.quitarFormato(rut_);
        var rut             = rut_simple.slice(0,-1);
        var dv              = rut_simple.slice(-1);
        var fNacimiento 	= $('#fNacimiento').val();
        var email 			= $('#email').val();
        var observaciones 	= $('#observaciones').val();
        var convenio 		= $('#convenio').val();
        var sexo 			= $('#sexo').val();
        var ciudad 			= $('#ciudad').val();
        var tFijo 			= $('#telefonoFijo').val();
        var tMovil 			= $('#telefonoMovil').val();
        var direccion 		= $('#direccion').val();
        var pcp_id 			= $("#pcp_id").val();
        var token           = $("#_token").val();



        var arr =  'nombres='+nombres;
        arr += '&apePaterno='+apePaterno;
        arr += '&apeMaterno='+apeMaterno;
        arr += '&rut='+rut;
        arr += '&dv='+dv;
        arr += '&fNacimiento='+fNacimiento;
        arr += '&email='+email;
        arr += '&observaciones='+observaciones;
        arr += '&convenio='+convenio;
        arr += '&sexo='+sexo;
        arr += '&ciudad='+ciudad;
        arr += '&tFijo='+tFijo;
        arr += '&tMovil='+tMovil;
        arr += '&direccion='+direccion;
        arr += '&pcp_id='+pcp_id;
        arr += '&_token='+token;


        $.ajax({
            url:   '/pacienteModificarAll?'+arr,
            type:  'post',
            success:  function (data) {
                console.log(data);
                swal("Modificado!", "Se acaba de modificar correctamente", "success");
            }
        });
    });

    $("#agreagrConvenio").click(function(){
        var convenio   = $("#conConvenio").val();
        var porcentaje = $("#conPorcentaje").val();
        var pcp_id     = $("#pcp_id").val();
        var esb_id     = $("#establecimiento").val();
        var token    = $("#_token").val();

        var arr =  'convenio='+convenio;
        arr += '&porcentaje='+porcentaje;
        arr += '&esb_id='+esb_id;
        arr += '&_token='+token;

        $.ajax({
            url:   '/pacienteAgregarConvenio?'+arr,
            type:  'post',
            success:  function (data) {
                console.log(data);
                swal("Agregado!", "Se acaba de agregar correctamente", "success");
                $('#modConvenio').modal('hide');
                $("#contenido").load('formPaciente?pcp_id='+pcp_id+'&esb_id='+esb_id);
            }
        });

    });
</script>





