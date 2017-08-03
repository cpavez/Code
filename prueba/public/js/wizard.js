searchVisible = 0;
transparent = true;

$(document).ready(function(){
    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();
    
        
    $('#wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',
         onInit : function(tab, navigation,index){
         
           //check number of tabs and fill the entire row
           var $total = navigation.find('li').length;
           $width = 100/$total;
           
           $display_width = $(document).width();
           
           if($display_width < 400 && $total > 3){
               $width = 50;
           }
           navigation.find('li').css('width',$width + '%');
        },
         onTabClick : function(tab, navigation, index){
            // Disable the posibility to click on tabs
            return false;
        }, 
        onNext: function(tab, navigation, index){
        	var usuario = $("#usuario").val();
        	var clave   = $("#clave").val();
            var $_token = $("#_token").val();
        	if(usuario){
	        	if(clave){
	        		var validador = validarUsuario(usuario,clave,$_token);

	        		if(validador.usuId){
	        		    $("#account").load('establecimientoUsuario?usu_id='+validador.usuId);
	        		}else{
	        			swal("Ups! hay un error!",'Usuario y/o Contraseña Erronea.', "error");
		        		return false;
	        		}
		        	
	        	}else{
		        	swal("Ups! hay un error!",'Debe ingresar una contraseña.', "error");
		        	return false;
	        	}
        	}else{
        		swal("Ups! hay un error!",'Debe ingresar un Usuario.', "error");
	        	return false;
        	}
        },
        onFinish: function(tab, navigation, index){
	        alert("final");
        },
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            
            var wizard = navigation.closest('.wizard-card');
            
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $(wizard).find('.btn-next').hide();
                $(wizard).find('.btn-finish').show();
            } else {
                $(wizard).find('.btn-next').show();
                $(wizard).find('.btn-finish').hide();
            }
        }
    });
    
    $('#finish').click(function() {
		var esb_id = $("#esb_id").val();

		var usu_id = $("#usu_id").val();
        var token = $("#_token").val();

		if(esb_id){
            var validador = guardamosVariableSession(usu_id,esb_id,token);
            if(validador.code == 1){
                if(validador.perfil == 1){
                    window.location.href = '/index';
                }else{
                    window.location.href = '/agenda';
                }

            }
		}else{
			swal("Ups! hay un error!",'Debe seleccionar un Establecimiento.', "error");
		}
		
	});

    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });
    
    
    $('[data-toggle="wizard-radio"]').bind('click',function(event){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });
    
    $height = $(document).height();
    $('.set-full-height').css('height',$height);
    
    //functions for demo purpose
    
    
});


 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}



function validarUsuario(usuario,clave,token){
        var validador = $.ajax({
					        url:   'validaUsuario?usuario='+usuario+'&clave='+clave+'&_token='+token,
					        type:  'post',
					        dataType: 'json',
					        async: false
					    });
	
		return validador.responseJSON;
}

function guardamosVariableSession(usu_id,esb_id,token){
    var validador = $.ajax({
        url:   'guardamosVariableSession?usu_id='+usu_id+'&esb_id='+esb_id+'&_token='+token,
        type:  'post',
        dataType: 'json',
        async: false
    });

    return validador.responseJSON;
}
    












