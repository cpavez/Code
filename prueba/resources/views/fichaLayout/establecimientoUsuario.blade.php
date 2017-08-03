<h4 class="info-text"> ¿En cual desea trabajar? </h4>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1" id="contEstablecimiento">
        @yield('establecimiento')
    </div>
</div>


<script>
    $('[data-toggle="wizard-radio"]').click(function(event){
        var wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
        selected = $(this).find('[type="radio"]').val();
        $("#esb_id").val(selected);
    });
</script>