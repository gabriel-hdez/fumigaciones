/* INICIALIZADOR JS
/* 
/* FOUNDATION */
//$(document).foundation();
/* PRELOADER */
$(window).on('load', function(event) {
  var render = (event.timeStamp/1000).toFixed(2);
  $('#rendered').html(render);
  //$('#rendered').html(event.timeStamp/1000);
  //console.log(render);
  setTimeout(function() {
    $('body').addClass('loaded');
  }, 200);
});

/* MATERIALIZE */
(function($){
    $(function(){

    
    $('.sidenav').sidenav();
    $('.slider').slider({indicators: true});
    $('.modal').modal({'dismissible':false});
    $('.tabs').tabs();
    $('.dropdown-trigger').dropdown({'hover':true});
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    $('select').formSelect();
    $('.tap-target').tapTarget();
    $('.materialboxed').materialbox();
    //$('.parallax').parallax();
    //$('.slider').slider({indicators: true});
    //$('input').attr({autocomplete: 'off'});

    $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: true,
      duration: 200,
      // autoplay: true,
    });
    window.setInterval(function() { $(".carousel").carousel('next') }, 5000);
    //$('input.validate').characterCounter();
    //$('#modal1').modal("open");
    //M.toast({html: 'I am a toast!', displayLength:6000});

    /*$('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        formatSubmit: 'yyyy-mm-dd',
        //maxYear: 2018,
        //maxDate: new Date(),
        i18n: {
          cancel: 'CANCELAR',
          clear: 'LIMPIAR',
          done: 'LISTO',
          previousMonth: '<',
          nextMonth: '>',
          months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          weekdays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
          weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          weekdaysAbbrev: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa']
        }

    });*/

    /* SCROLLBAR PERFECTO 
    $('select').not('.disabled').formSelect();
    var leftnav = $(".page-topbar").height();
    var leftnavHeight = window.innerHeight - leftnav;
    if (!$('#slide-out.leftside-navigation').hasClass('native-scroll')) {
      $('.leftside-navigation').perfectScrollbar({
        suppressScrollX: true
      });
    }
    var righttnav = $("#chat-out").height();
    $('.rightside-navigation').perfectScrollbar({
      suppressScrollX: true
    });
    */

    /* FULL SCREEN */
    function toggleFullScreen() {
      if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
          document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
          document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    }
    $('.toggle-fullscreen').click(function() {
      toggleFullScreen();
    });

    /* DETECTA PANTALLA TACTIL PARA DESABILITAR EL SCROLLBAR */
    function is_touch_device() {
      try {
        document.createEvent("TouchEvent");
        return true;
      } catch (e) {
        return false;
      }
    }
    if (is_touch_device()) {
      $('#nav-mobile').css({
        overflow: 'auto'
      })
    }

     /* SIDENAVS */
    // $('.sidenav-trigger').on('hover', function(event) {
    //   alert('hover');
    // });

    $('.sidebar-collapse').sidenav({
      edge: 'left',
    });
    //Overlay Menu (Full screen menu)
    $('.menu-sidebar-collapse').sidenav({
      menuWidth: 240,
      edge: 'left', 
      menuOut: false 
    });
    //Main Left Sidebar Chat
    $('.chat-collapse').sidenav({
      menuWidth: 300,
      edge: 'right',
    });

    
    });
})(jQuery);