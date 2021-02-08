(function($){
    $(function(){
        
        // intercambiar avatares
        $('.avatars').click(function() {
            var avatar          = $(this).attr('data-avatar');      
            var newAvatar       = $(this).attr('src');      
            var uploadAvatar    = $(this).attr('data-uploadAvatar');
            var dataAvatar      = $('#preview').attr('data-avatar');      
            var oldAvatar       = $('#preview').attr('src');
            var newUploadAvatar = $('#uploadAvatar').val();      
            
            $(this).attr('data-uploadAvatar', newUploadAvatar);
            $('#uploadAvatar').val(uploadAvatar);
            $(this).attr('src', oldAvatar);
            $('#preview').attr('src', newAvatar);
            $(this).attr('data-avatar', dataAvatar);
            $('#preview').attr('data-avatar', avatar);
            $('#avatar').val(avatar);
            
            console.log('avatar:'+avatar);
            console.log('newAvatar:'+newAvatar);
            console.log('uploadAvatar:'+uploadAvatar);
            console.log('dataAvatar:'+dataAvatar);
            console.log('oldAvatar:'+oldAvatar);
            console.log('newUploadAvatar:'+newUploadAvatar);
            $('#perfil').submit();


            // M.toast({
            //     html: 'Verificacion de imagen de perfil exitosa' , 
            //     displayLength:2500,
            //     completeCallback: function(){
            //         M.toast({html: 'Asegura bien tus datos' , displayLength:2500});
            //         $('.tabs').tabs('select', 'seguridad');
            //     }
            // });
        });

        $('#imgAvatar').change(function() {
            $('#uploadAvatar').val('1');                    
            $('#perfil').submit();
        });

    });
})(jQuery);