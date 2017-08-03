<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('js/checkConsultores.js') }}"></script>

<script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/moment.js') }}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap3-typeahead.min.js') }}"></script>

<script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/datetimepickerDirective.js') }}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{asset('js/locales/bootstrap-datetimepicker.es.js') }}"></script>
<script type="text/javascript" src="{{asset('js/sweet-alert.js') }}"></script>
<script type="text/javascript" src="{{asset('js/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/lang/es.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jquery.Rut.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jquery.rut.js') }}"></script>
<script type="text/javascript" src="{{asset('js/socket.io.js') }}"></script>

<script type="text/javascript" src="{{asset('js/html2canvas.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jspdf.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jspdf.plugin.addimage.js') }}"></script>
<script type="text/javascript" src="{{asset('js/FileSaver.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/jasny-bootstrap.min.js') }}"></script>

<input type="hidden" id="_token" value="{{ csrf_token() }}" />

<div id='botonera'>
    <input id='botonIniciar' type='button' value = 'Iniciar'></input>
    <input id='botonDetener' type='button' value = 'Detener'></input>
    <input id='botonFoto' type='button' value = 'Foto'></input>
    <input id='guardarFoto' type='button' value = 'guardar'></input>
</div>
<div class="contenedor">
    <div class="titulo">Cámara</div>
    <video id="camara" autoplay controls></video>
</div>
<div class="contenedor">
    <div class="titulo">Foto</div>
    <canvas id="foto" ></canvas>
</div>


<script>
    window.URL = window.URL || window.webkitURL;

    var promisifiedOldGUM = function(constraints, successCallback, errorCallback) {

        var getUserMedia = (navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia ||
        navigator.oGetUserMedia);
        if(!getUserMedia) {
            return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
        }

        return new Promise(function(successCallback, errorCallback) {
            getUserMedia.call(navigator, constraints, successCallback, errorCallback);
        });

    }

    if(navigator.mediaDevices === undefined) {
        navigator.mediaDevices = {};
    }

    if(navigator.mediaDevices.getUserMedia === undefined) {
        navigator.mediaDevices.getUserMedia = promisifiedOldGUM;
    }




    window.datosVideo = {
        'StreamVideo': null,
        'url': null
    }


    jQuery('#botonIniciar').on('click', function(e) {


        var constraints = { audio: true, video: { facingMode: "user" } };

        navigator.mediaDevices.getUserMedia(constraints)
            .then(function(streamVideo) {
                datosVideo.StreamVideo = streamVideo;
                datosVideo.url = window.URL.createObjectURL(streamVideo);
                jQuery('#camara').attr('src', datosVideo.url);
            })
            .catch(function(err) {
                console.log(err.name + ": " + err.message);
                alert(err.name + ": " + err.message);
                alert('No fue posible obtener acceso a la cámara.');
            });

    });


    jQuery('#botonDetener').on('click', function(e) {

        if (datosVideo.StreamVideo) {
            datosVideo.StreamVideo.getVideoTracks()[0].stop();
            window.URL.revokeObjectURL(datosVideo.url);
        }

    });

    jQuery('#botonFoto').on('click', function(e) {
        var oCamara, oFoto, oContexto, w, h;

        oCamara = jQuery('#camara');
        oFoto = jQuery('#foto');
        w = oCamara.width();
        h = oCamara.height();
        oFoto.attr({
        'width': w,
        'height': h
        });
        oContexto = oFoto[0].getContext('2d');
        oContexto.drawImage(oCamara[0], 0, 0, w, h);

    });

    $("#guardarFoto").on('click',function(){

        html2canvas($("#foto"), {
            onrendered: function(canvas) {
                var oContexto = canvas.getContext('2d');
                var url = canvas.toDataURL();
                var $_token = $("#_token").val();
                $.ajax({
                    url:   '/guardarFotoPersona',
                    data: {
                        img : canvas.toDataURL(),
                        nombre_imagen : 'prueba',
                        _token:$_token},
                    type:  'post',
                    success:  function (data) {
                        console.log(data);

                    }
                });
            }
        });

    })
</script>