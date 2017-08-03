<style>
    .tt-dropdown-menu{
        height:300px;
        width: 600px;
        overflow: auto;
        font-size: 10px;
    }
</style>
<div class="row">
    <div class="col-xs-8">
        <span>Prestación</span><br>
        <input type="text" class="typeahead" style="font-size: 16px;webkit-border-radius: 0px;border-radius: 0px;moz-border-radius: 0px; text-transform: uppercase;" id='prestacion' name="prestacion">
        <input type="hidden" id='pre_id'/>
    </div>
    <div class="col-xs-2">
        <span>Cantidad</span>
        <input type="text" class="form-control" id='cantidad'>
    </div>
    <div class="col-xs-2">
        <span></span>
        <button type="button" class="btn btn-success" id='agregarPrestacion'style="margin-top:19px;">Agregar</button>
    </div>
</div>

@yield('tabla_prestaciones')

<script>

    var esb_id = $("#establecimiento").val();


    var prestaciones = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace('descripcion'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: "/prestaciones?esb_id="+esb_id+"&descripcion=%QUERY",
            wildcard: '%QUERY'
        },
        limit: 10
    });

    prestaciones.initialize();


    $('#prestacion').typeahead({
            hint: true,
            highlight: true,
            minLength: 2,
            order: "asc"
        },
        {
            source: prestaciones.ttAdapter(),
            displayKey: function(prestaciones) {
                return prestaciones.denominacion;
            }
        }).bind("typeahead:selected", function(obj, datum, name) {
        console.log(datum.id);
        $("#pre_id").val(datum.id);
    });




    $(".eliminarPrestacion").click(function(){
        var pre_id 		  = this.id;
        var epi_id    = $("#epi_id").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var $_token = $("#_token").val();

        $.ajax({
            url:   '/eliminarPrestacionEpi?epi_id='+epi_id+'&pre_id='+pre_id+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiPrestaciones?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });
    });

    $("#agregarPrestacion").click(function(){
        var pre_id = $("#pre_id").val();
        var cantidad = $("#cantidad").val();
        var pcp_id 	  = $("#pcp_id").val();
        var esb_id 	  = $("#establecimiento").val();
        var epi_id  = $("#epi_id").val();
        var usu_id  = $("#session_usu_id").val();
        var $_token = $("#_token").val();


        $.ajax({
            url:   '/agregarPrestacionEpi?epi_id='+epi_id+'&usu_id='+usu_id+'&pre_id='+pre_id+'&cantidad='+cantidad+'&_token='+$_token,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#con_episodio").load('epiPrestaciones?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

            }
        });
    });
</script>