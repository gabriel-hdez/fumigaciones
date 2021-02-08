(function($){
    $(function(){   
        var form = $('form');

        for (var i = 0; i < form.length; i++) 
        {
            var enviar = '#'+$(form[i]).attr('id');
            $(enviar).submit(function(event)
            {
                event.preventDefault();
                var formData = new FormData($(this)[0])
                
                $.ajax({
                    url:$(this).attr('action'),
                    type:$(this).attr('method'),
                    //dataType: 'json',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function(){ 
                        $('.progress').removeClass('hide');
                    }
                })
                .done(function(respuesta){
                    var json = $.parseJSON(respuesta);
                    if (json.status == "alert")
                    {
                        if(json.info != null)
                        {
                            M.toast({
                                html: json.info , 
                                displayLength:2500, 
                                completeCallback: function(){
                                    if(json.msj != null)
                                    {
                                        M.toast({html: json.msj , displayLength:2500});
                                    }
                                    if(json.redirect != null)
                                    {
                                        window.location.href = json.redirect;
                                    }
                                    if(json.tabSelected != null)
                                    {
                                        // var tabs = $('.tab');
                                        // for (var a = 0; a < tabs.length; a++) {
                                        //     var tab = $(tabs[a]).attr('class');
                                        //     if (tab.match(json.tabSelected))
                                        //     {
                                        //         $('.tab').removeClass('disabled');
                                        //     }
                                        //     else
                                        //     {
                                        //         $('.tab').addClass('disabled');
                                        //     }
                                            $('.tabs').tabs('select', json.tabSelected);
                                        //}
                                    }
                                    if(json.updateData != null)
                                    {
                                        $('.updateData').html(json.updateData);
                                    }  
                                    if(json.updateSource != null)
                                    {
                                        $('.updateSource').attr('src',json.updateSource);
                                    }
                                    if (json.control != null) 
                                    {
                                        var checkbox = $(json.control);
                                        if (checkbox.val() == 'checked') 
                                        {
                                            checkbox.removeAttr('checked','checked');
                                            checkbox.val('');
                                        } 
                                        else
                                        {
                                            checkbox.attr('checked','checked');
                                            checkbox.val('checked');
                                        }
                                    }
                                }});
                        }
                        if(json.modal != null)
                        {
                            if (json.action != null) 
                            {
                                $(json.modal).modal(json.action);
                            } 
                            else
                            {
                                $('.modal').modal("close");
                                $(json.modal).modal("open");
                            }
                        }
                        if(json.unlock != null)
                        {
                            $('#'+json.unlock).removeAttr('disabled');

                        }
                        if(json.preview != null)
                        {
                            $('#preview').attr('src', json.preview);
                            $('.show').addClass('hide');
                        }
                        if(json.clearInputs == "on" )
                        {
                            $('.validate').val("");
                        }
                        if(json.updateInput != null)
                        {
                            var input = json.idInput;
                            var value = json.updateInput;
                            $(input).val(value);
                        }

                        $('.validate').removeClass('invalid').siblings('.helper-text').attr('data-error', "");
                    }
                    else
                    {
                        for( var inputs in json)
                        {
                            if(json.hasOwnProperty(inputs))
                            {
                                var ids = "#"+inputs;
                                $(ids).addClass('invalid').siblings('.helper-text').attr('data-error', json[inputs]);
                            }
                            else
                            {
                                $(ids).removeClass('invalid').siblings('.helper-text').attr('data-error', "");
                            }
                        }
                    }
                })
                .fail(function(respuesta) {
                    M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
                    $('.validate').addClass('invalid');
                })
                .always(function(respuesta) {
                    $('.progress').addClass('hide');    
                    console.log(respuesta);
                });
            });
        }
    });
})(jQuery);