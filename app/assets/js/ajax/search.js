(function($){
    $(function(){

    	$('.searchbar').bind('change keyup paste click', function (event) {

            var valor = $(this).val();

            $.ajax({
                url:$(this).attr('data-url'),
                type:'POST',
                //dataType: 'json',
                data: { buscar : valor },
                beforeSend:function(){ 
                    $('.progress').removeClass('hide');
                }
            })
           .done(function(respuesta){
               var json = $.parseJSON(respuesta);
                
               if ( json.inexistente == null ) 
               {
                    console.log('si existe el cliente');

                    for( var inputs in json)
                    {
                        var ids = "#"+inputs;
                        $('.searchbar').removeClass('invalid').siblings('.helper-text').attr('data-error', '');
                        $(ids).addClass('valid active').siblings('.helper-text').attr('data-success', '');
            
                        $(ids).val(json[inputs]);
                        M.updateTextFields();
                    }
               }
               else
               {
                    console.log('no existe el cliente');

                    for( var inputs in json)
                    {
                        var ids = "#"+inputs;
                        $('.searchbar').addClass('invalid').siblings('.helper-text').attr('data-error', json.inexistente);
                        $(ids).removeClass('valid active').siblings('.helper-text').attr('data-success', '');
                       
                        $(ids).val('');
                        M.updateTextFields();
                    }
               }

              
            })
            .fail(function(respuesta) {
                M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
            })
            .always(function(respuesta) {
                $('.progress').addClass('hide'); 
                console.log(respuesta);
            });
        });

    });
})(jQuery);