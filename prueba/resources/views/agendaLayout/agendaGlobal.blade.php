<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
        border-bottom: 1px solid #414141;
    }
</style>
@yield('citas')
<div style="position:absolute;left:299px;right:0;  overflow-x: initial;bottom: 0;top: 0;" id='cont_busqueda_agenda'>
</div>
<script>
    $("#medico").hide();
    $(document).ready(function() {
        var pacientes = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('pacientes.paciente'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: "pacientes"
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
                name: 'pacientes',
                displayKey: function(pacientes) {
                    return pacientes.pcp_nombre;
                },
                source: pacientes.ttAdapter()
            }).bind("typeahead:selected", function(obj, datum, name) {
            console.log(datum.pcp_id);
            $("#pcp_id").val(datum.pcp_id);
        });

        $("#rut,#paciente").focus(function(){
            $("#pcp_id").val('');
            $("#paciente").val('');
            $("#rut").val('');
        });

        $('#rut').Rut({
            on_success: function(){
                var rut = $("#rut").val();
                var rut_ = $.Rut.quitarFormato(rut);
                var rut_simple = rut_.slice(0,-1);
                var $_token = $("#_token").val();
                if(rut_.length > 2){
                    $.ajax({
                        url:   'pacienteBuscar?rut='+rut_simple+'&_token='+$_token,
                        type:  'post',
                        success:  function (data) {
                            console.log(data);
                            if(data.codigo == 0){
                                $("#pcp_id").val(data.pcp_id);
                            }
                        }
                    });
                }
            },
            on_error: function(){ swal("Error", "Se ingresado un Rut erroneo", "error"); },
            format_on: 'keyup'
        });

        $("#buscar").click(function(){
            var pcp_id = $("#pcp_id").val();
            var esb_id = $("#establecimiento").val();

            if(pcp_id != ''){
                $("#cont_busqueda_agenda").load('busquedaAgenda?pcp_id='+pcp_id+'&esb_id='+esb_id);
            }else{
                swal("Error", "Debe llenar un parametro de busqueda!", "error");
            }

        });

    });
</script>

