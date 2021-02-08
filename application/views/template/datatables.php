<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
// inicializacion datatables
$(document).ready(function() {
    $('table.display').DataTable({
      "language": {
                    "lengthMenu": '<div class="input-field col s1" style="width:8rem; top:4rem;">'+
                    '<label class="active">Mostrar</label>'+
                    '<select class="dt-select" style="margin-top:0.5rem;">'+
                    '<option value="5">5 registros</option>'+
                    '<option value="10">10 registros</option>'+
                    '<option value="15">15 registros</option>'+
                    '<option value="20">20 registros</option>'+
                    '<option value="-1">Todos los registros</option>'+
                   '</select></div>',
                   "sSearchPlaceholder": "Buscar...",
                    //"sLengthMenu":     "Mostrar _MENU_ registros",
                    "sProcessing":     "<p class='center teal-text'>Procesando...</p>",
                    "sLoadingRecords": "<p class='center teal-text'>Cargando...</p>",
                    "sZeroRecords":    "<p class='center red-text'>No se encontraron resultados</p>",
                    "sEmptyTable":     "<p class='center red-text'>Ningún dato disponible para mostrar</p>",
                    "sInfo":           "<p class='center grey-text'>Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros</p>",
                    "sInfoEmpty":      "<p class='center grey-text'>Mostrando registros del 0 al 0 de un total de 0 registros</p>",
                    "sInfoFiltered":   "<p class='center grey-text'>(filtrado de un total de _MAX_ registros)</p>",
                    "sInfoPostFix":    "",
                    "sSearch":         "",
                    "sUrl":            "",
                    "sInfoThousands":  ".",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                },
          
        "pageLength": 5,
        "order": []
    });
     
  $('.dt-select').addClass("browser-default").val('5');
} );
</script>