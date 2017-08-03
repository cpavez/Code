<style>
    .btn-group-wrap {
        text-align: center;
        height: 34px;
    }

    div.btn-group {
        margin: 0 auto;
        text-align: center;
        width: inherit;
        display: inline-block;
    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-8">
            @yield('foto')
        </div>
        <div class="col-xs-6 col-md-4">
            @yield('listaFotos')
        </div>
    </div>
</div>


<script>
    window.URL = window.URL || window.webkitURL;
    var videoSelect = document.querySelector('select#videoSource');
    var selectors = [videoSelect];

    function gotDevices(deviceInfos) {
        // Handles being called several times to update labels. Preserve values.
        var values = selectors.map(function(select) {
            return select.value;
        });
        selectors.forEach(function(select) {
            while (select.firstChild) {
                select.removeChild(select.firstChild);
            }
        });
        if(deviceInfos.length){
            for (var i = 0; i !== deviceInfos.length; ++i) {
                var deviceInfo = deviceInfos[i];
                var option = document.createElement('option');
                option.value = deviceInfo.deviceId;
                if (deviceInfo.kind === 'videoinput') {
                    option.text = deviceInfo.label || 'camera ' + (videoSelect.length + 1);
                    videoSelect.appendChild(option);
                } else {
                    console.log('Some other kind of source/device: ', deviceInfo);
                }
            }
            selectors.forEach(function(select, selectorIndex) {
                if (Array.prototype.slice.call(select.childNodes).some(function(n) {
                        return n.value === values[selectorIndex];
                    })) {
                    select.value = values[selectorIndex];
                }
            });
        }else{
            alert('No fue posible obtener acceso a la cámara.');
        }

    }

    var getUserMediaIf = (navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia ||
    navigator.oGetUserMedia);

    if(!getUserMediaIf) {
        alert('No se puede Ocupar en este Distoritivo');
    }else{
        navigator.mediaDevices.enumerateDevices().then(gotDevices).catch(handleError);
    }



    function gotStream(stream) {
        window.stream = stream; // make stream available to console
        videoElement.srcObject = stream;
        // Refresh button list in case labels have become available

        return navigator.mediaDevices.enumerateDevices();

    }



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


    $('#botonIniciar').on('click', function(e) {
        //var constraints = { audio: false, video: { facingMode: "user" } };
        var constraints = { deviceId: videoSource ? {exact: videoSource} : undefined, audio: false, video: true };

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


    $('#botonDetener').on('click', function(e) {

        if (datosVideo.StreamVideo) {
            datosVideo.StreamVideo.getVideoTracks()[0].stop();
            window.URL.revokeObjectURL(datosVideo.url);
        }

    });

    $('#botonFoto').on('click', function(e) {

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
                var epi_id = $("#epi_id").val();
                var $_token = $("#_token").val();
                var pcp_id 	  = $("#pcp_id").val();
                var esb_id 	  = $("#establecimiento").val();
                var usu_id 	  = $("#session_usu_id").val();
                $.ajax({
                    url:   '/guardarFotoPersona',
                    data: {
                        img : canvas.toDataURL(),
                        nombre_imagen : 'prueba',
                        epi_id: epi_id,
                        _token:$_token},
                    type:  'post',
                    success:  function (data) {
                        if (datosVideo.StreamVideo) {
                            datosVideo.StreamVideo.getVideoTracks()[0].stop();
                            window.URL.revokeObjectURL(datosVideo.url);
                        }
                        $("#con_episodio").load('epiFotos?pcp_id='+pcp_id+'&esb_id='+esb_id+'&usu_id='+usu_id+'&epi_id='+epi_id);

                    }
                });
            }
        });

    });

    function handleError(error) {
        console.log('navigator.getUserMedia error: ', error);
    }
</script>