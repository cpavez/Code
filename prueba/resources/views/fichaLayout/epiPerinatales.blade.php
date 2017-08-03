<style>
    #slider {
        margin-left: 32px;
        width: 330px;
        margin-bottom: 0px;
    }
</style>
@yield('eva')



@if($arr_per == '')
    <button type="button" id="guardar" class="btn btn-primary" style="float: right !important;">Guardar</button>
@endif
<script>
    $("#guardar").on('click',function(){
       var patologiaEmbarazo = $("#patologiaEmbarazo").val();
       var edad = $("#edad").val();
       var talla = $("#talla").val();
       var primer = $("#primer").val();
       var quinto = $("#quinto").val();
       var peso = $("#peso").val();
       var perimetro = $("#perimetro").val();
       var deprimido = $("#deprimido").val();
       var reanimacion = $("#reanimacion").val();
       var patologiaRespiratoria = $("#patologiaRespiratoria").val();
       var hiv = $("#hiv").val();
       var malformaciones = $("#malformaciones").val();
       var ingeccionCongenica = $("#ingeccionCongenica").val();
       var infeccionAdquirida = $("#infeccionAdquirida").val();
       var ictericia = $("#ictericia").val();
       var problemasNeurologicos = $("#problemasNeurologicos").val();
       var $_token = $("#_token").val();
       var pcp_id 	  = $("#pcp_id").val();

        $.ajax({
            url:   '/agregarEpiPerinatales',
            data: {
                patologiaEmbarazo : patologiaEmbarazo,
                edad : edad,
                talla : talla,
                primer : primer,
                quinto : quinto,
                peso : peso,
                perimetro : perimetro,
                deprimido : deprimido,
                reanimacion : reanimacion,
                patologiaRespiratoria : patologiaRespiratoria,
                hiv : hiv,
                malformaciones : malformaciones,
                ingeccionCongenica : ingeccionCongenica,
                infeccionAdquirida : infeccionAdquirida,
                ictericia : ictericia,
                problemasNeurologicos : problemasNeurologicos,
                pcp_id: pcp_id,
                _token:$_token},
            type:  'post',
            success:  function (data) {
                console.log(data);

            }
        });



    });
</script>