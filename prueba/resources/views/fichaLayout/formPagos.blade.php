<style>
    .panel-heading span{
        font-size: 12px;
    }
</style>
<div class="label-primary" style="height: 35px;width: 100%;line-height: 35px;color: #fff;padding-left: 10px;">Pagos Realizados</div>
<div style="position: absolute;top: 35px;bottom: 0;left: 0;right: 0;overflow-y: scroll;">
    <div class="col-sm-12" style="margin-top:20px;">
        <div class="form-group">
            <div class="row">
                @yield('efectivo')
                @yield('bono')
                @yield('cheque')
                @yield('t_bancaria')
            </div>
        </div>
    </div>
</div>
</div>

