<!DOCTYPE html>
<html lang="es">
<head>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/sweet-alert.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/gsdk-base.css') }}" rel="stylesheet" media="screen">
    <title>SaludClink</title>
</head>
<body>
<input type="hidden" id="_token" value="{{ csrf_token() }}" />
<div class="image-container set-full-height" style="    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    position: absolute;
    background-image: url({{ asset('img/login.jpg') }});
}">
    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2" style="min-height: 100vh; display: flex; align-items: center;">

                <!--      Wizard container        -->
                <div class="wizard-container">
                    <form action="" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="card wizard-card ct-wizard-orange" id="wizard">
                            <div class="wizard-header">
                                <h3>
                                    <b>SALUDCLINK</b> <br>
                                    <small>Dedicado a la Calidad.</small>
                                </h3>
                            </div>
                            <ul>
                                <li><a href="#about" data-toggle="tab">Cuenta Usuario</a></li>
                                <li><a href="#account" data-toggle="tab">Establecimiento</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="about">
                                    <div class="row">
                                        <h4 class="info-text"> Complete los campos para iniciar sesion</h4>
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="{{ asset('img/default-avatar.png') }}" class="picture-src" id="wizardPicturePreview" title=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre de Usuario</label>
                                                <input type="text" class="form-control" id="usuario" placeholder="Usuario...">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Contraseña</label>
                                                <input type="password" class="form-control" id="clave" placeholder="Contraseña...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="account">

                                </div>
                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' id='next' name='next' value='Siguente' />
                                    <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' id='finish' value='Entrar' />

                                </div>
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Atrás' />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div> <!-- wizard container -->
            </div>
        </div><!-- end row -->
    </div> <!--  big container -->


</div>

<script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jquery.bootstrap.wizard.js') }}"></script>
<script type="text/javascript" src="{{asset('js/wizard.js') }}"></script>
<script type="text/javascript" src="{{asset('js/sweet-alert.js') }}"></script>

</body>
</html>