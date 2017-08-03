@yield('receta')

<script>
    var date = new Date();
    var fecha 		= date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    var epi_id    = $("#epi_id").val();
    $(".eliminarReceta").click(function(){
        var rec_id = this.id;

        $.ajax({
            url:   '/eliminarReceta?rec_id='+rec_id,
            type:  'post',
            success:  function (data) {
                console.log(data);
                $("#listReceta").load('listReceta?fecha='+fecha+'&epi_id='+epi_id);

            }
        });

    });
</script>




