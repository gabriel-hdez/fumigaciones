(function($){
    $(function(){

        $('#clave').bind('keyup keydown blur focus', function (event) {
            var clave         = $(this).val();
            var envio         = $('#myform');
            var indicator     = '';
            var validation    = '';
            var security      = 0;
            var minimo        = 0;
            var mayusculas    = 0;
            var minusculas    = 0;
            var numeros       = 0;
            var especial      = 0;
            var upperCase     = new RegExp('[A-Z]');
            var lowerCase     = new RegExp('[a-z]');
            var numbers       = new RegExp('[0-9]');
            var specialchars  = new RegExp('([!,%,&,@,#,$,*,?])');

            if(clave.length >= 8)
            { 
                minimo++;
                if(clave.match(upperCase))
                { 
                    mayusculas++;
                    if(clave.match(lowerCase))
                    { 
                        minusculas++;
                        if(clave.match(numbers))
                        { 
                            numeros++;
                            if(clave.match(specialchars))
                            { 
                                especial++; 
                                validation = null; 
                            }
                            else
                            { 
                                especial=0; 
                                validation = 'La contraseña debe contener al menos un caracter especial [!,%,&,@,#,$,*,?]'; 
                            } 
                        }
                        else
                        { 
                            numeros=0; 
                            validation = 'La contraseña debe contener al menos un numero'; 
                        } 
                    }
                    else
                    { 
                        minusculas=0; 
                        validation = 'La contraseña debe contener al menos una letra minuscula'; 
                    }
                }
                else
                { 
                    mayusculas=0; 
                    validation = 'La contraseña debe contener al menos una letra mayuscula'; 
                }
            }
            else
            { 
                minimo=0;
                validation = 'La contraseña debe ser de al menos 8 caracteres de longitud'; 
            }

            function GetPercentage(a, b) { return ((b / a) * 100);}

            security = minimo + mayusculas + minusculas + numeros + especial;
            var porcentaje = GetPercentage(5, security).toFixed(0);
            
            indicator = 'security-'+security;

            console.log(porcentaje);

            if (validation == null) 
            {
                $('#clave').removeClass('invalid').siblings('.helper-text').attr('data-error', "");
                $('#clave').addClass('valid').siblings('.helper-text').attr('data-success', '¡La contraseña se ve bien!');
                //$('#repetir').removeAttr('disabled','disabled');
                //$('#btnSeguridad').removeAttr('disabled','disabled');
            } 
            else 
            {
                $(envio).submit(function (event){ event.preventDefault(); });
                $('#clave').addClass('invalid').siblings('.helper-text').attr('data-error', validation);
                //$('#repetir').attr('disabled','disabled');
                //$('#btnSeguridad').attr('disabled','disabled');
            }           
        });

        $('.password').click(function () {
            var visibility = $(this).attr('data-visibility');

            if (visibility == 'off') 
            {
                $(this).attr('data-visibility','true');
                $(this).html('visibility_off');
                $(this).siblings('.validate').attr('type','text');
            }
            else 
            {
                $(this).attr('data-visibility','off');
                $(this).html('visibility');
                $(this).siblings('.validate').attr('type','password');
            }
        });

        // $('#acepto').click(function () {
        //     var acepto = $(this).attr('data-confirm');
        //     var repetir = $('#repetir').val();

        //     if (repetir != '') {
        //         if (acepto == 'on') {
        //             $(this).attr('data-confirm','off');
        //             $('#listo').removeAttr('disabled','disabled');
        //         }else{
        //             $(this).attr('data-confirm','on');
        //             $('#listo').attr('disabled','disabled');
        //         }
        //     } else{
        //         if (acepto == 'on') {
        //             $(this).attr('data-confirm','off');
        //             $('#listo').attr('disabled','disabled');
        //         }else{
        //             $(this).attr('data-confirm','on');
        //             $('#listo').attr('disabled','disabled');
        //         }                
        //     }
        // });
	});
})(jQuery);