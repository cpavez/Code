@yield('examen')

<script>
    var date = new Date();
    var fecha 		= date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    var epi_id    = $("#epi_id").val();
    $(".eliminarExamen").click(function(){
        var exa_id = this.id;

        $.ajax({
            url:   '/eliminarExamen?exa_id='+exa_id,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#listExamen").load('listExamen?fecha='+fecha+'&epi_id='+epi_id);

            }
        });

    });
</script>




