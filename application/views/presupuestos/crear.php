<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($this->cart->total_items() == 0){ $estado='disabled'; }else{ $estado=''; }
?>
<div class="fixed-action-btn">
  <a class="btn-floating btn-large red tooltipped bicolor modal-trigger" data-position="left" data-tooltip="Listo" href="#modal" <?php echo $estado;?>>
    <i class="large material-icons ">check</i>
  </a>
  <!--<ul>
     <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> 
  </ul>-->
</div>

<div id="modal" class="modal" style="overflow-y: visible !important; min-height: 80%;">
	<div class="modal-content" style="height: 100%;">
		<h4 class="center"><span style="font-weight: 300;">Fumigaciones JG</h4>
	    <h4 class="modal-close close-icon material-icons">clear</h4>

	    <!-- 	TABS 	-->
	    <div class="row">
	      	<ul class="tabs">
		        <li class="tab col s6 active">
		        	<a href="#datos_presupuesto" >
		        		<i class="material-icons hide-on-med-and-up">account_circle</i>
		        		<span class="hide-on-small-only">Datos del presupuesto</span> 
		        	</a>
		    	</li>
		        <li class="tab col s6 ">
		        	<a href="#datos_cliente">
		        		<i class="material-icons hide-on-med-and-up">account_circle</i>
		        		<span class="hide-on-small-only">Datos del cliente</span> 
		        	</a>
		        </li>
	      	</ul>
	    </div>

    	<form id="form" enctype="multipart/form-data" method="POST" action="<?php echo base_url('presupuestos/guardar');?>">
			<input type="hidden" id="cambio" name="cambio" value="<?php echo $dolar->bolivares; ?>">
			<input type="hidden" id="id_cliente" name="id_cliente" >

    		<div id="datos_presupuesto">
				<div class="row">
					<!-- <div class="input-field col s4">
						<input id="control" name="control" type="text" class="validate " value="<?php //echo $control;?>" readonly>
						<label for="control">NRO DE CONTROL</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div> -->
					<div class="input-field col s4">
						<input id="vencimiento" name="vencimiento" type="text" class="validate datepicker" >
						<label for="vencimiento">FECHA DE VENCIMIENTO</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
					<div class="input-field col s4">
						<select name="estado" id="estado">
					      <option value="1">Urgente</option>
					      <option value="2">Pendiente</option>
					    </select>
					    <label for="estado">ESTADO</label>
					</div>
					<div class="input-field col s4">
						<select name="area" id="area">
					      <option value="1">Empresa</option>
					      <option value="2">Institucion</option>
					      <option value="3">Almacen</option>
					      <option value="4">Granja</option>
					      <option value="5">Oficina</option>
					      <option value="6">Comercio</option>
					      <option value="7">Casa</option>
					      <option value="8">Apartamento</option>
					    </select>
					    <label for="area">AREA</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="direccion" name="direccion" type="text" class="validate " >
						<label for="direccion">DIRECCION</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 tooltipped" data-position="top" data-tooltip="<?php echo number_format($this->cart->total() * $dolar->bolivares,2,',','.').' BS';?>">
						<input id="total" name="total" type="text" class="validate valid" value="<?php echo number_format($this->cart->total(),2,',','.').' $';?>" readonly>
						<label for="total">COSTO TOTAL DE SERVICIOS</label>
						<span class="helper-text" data-error="" data-success=""></span>
					</div>
					<div class="input-field col s6" >
						<input id="total_presupuesto" name="total_presupuesto" type="text" class="validate valid" value="<?php echo $this->cart->total().'.0';?>">
						<label for="total_presupuesto">TOTAL PRESUPUESTADO</label>
						<span class="helper-text" data-error="" data-success="Monto expresado en divisas"></span>
					</div>
				</div>
				<div class="row">
					<div class="col s12 center">
						<a class="waves-effect waves-light btn" onclick="$('.tabs').tabs('select', 'datos_cliente')" >SIGUIENTE</a>
					</div>
				</div>
    		</div>
		
			<div id="datos_cliente">
				<div class="row">
					<div class="col s6 input-field">
						<i class="material-icons prefix">search</i>
						<input id="cedula" name="cedula" type="text" class="validate searchbar" data-url="<?php echo base_url('presupuestos/buscar_cliente');?>" placeholder="Buscar cliente por cedula" autocomplete="off">
						<label for="cedula">CEDULA DEL CLIENTE</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 1234556</span>
					</div>
					<div class="col s6 input-field">
						<input id="correo" name="correo" type="text" class="validate">
						<label for="correo">CORREO</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
				</div>
				<div class="row">
					<div class="col s4 input-field">
						<input id="nombre" name="nombre" type="text" class="validate">
						<label for="nombre">NOMBRE</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
					<div class="col s4 input-field">
						<input id="apellido" name="apellido" type="text" class="validate">
						<label for="apellido">APELLIDO</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
					<div class="col s4 input-field">
						<input id="tlf" name="tlf" type="text" class="validate">
						<label for="tlf">TELEFONO</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
				</div>
				<div class="row">
					<div class="col s12 input-field">
						<input id="alergias" name="alergias" type="text" class="validate">
						<label for="alergias">ALERGIAS</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
					</div>
				</div>
				<div class="row">
					<div class="col s12 center">
						<a class="waves-effect waves-light btn-flat" onclick="$('.tabs').tabs('select', 'datos_presupuesto')" >ANTERIOR</a>
						<button type="submit" class="waves-effect waves-light btn" <?php echo $estado;?> >GUARDAR</button>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<!-- 	OPCIONES		-->
		<div class="col s12">
	      	<ul class="tabs">
		        <li class="tab col s6">
		        	<a href="#tab1">
		        		<span>Servicios agregados</span> 
		        	</a>
		    	</li>
		        <li class="tab col s6">
		        	<a href="#tab2" >
		        		<span>Listado de servicios</span> 
		        	</a>
		        </li>
	      	</ul>
	    </div>
	    <!-- 	PREVISUALIZACION CARRITO		-->
		<div class="" id="tab1" style="padding: 2rem;">
			<table class="display highlight" cellspacing="0" width="100%" >
				<thead>
	            	<tr>
	                	<th class="center" width="25%">SERVICIO</th>
	                	<th class="center" width="30%">PRECIO</th>
	                    <th class="center" width="15%">CANTIDAD</th>
	                	<th class="center" width="15%">COSTO SUBTOTAL</th>
	                    <th class="center" width="15%">ACCIONES</th>
	              	</tr>
	            </thead>
	            <tbody>
	                <?php 
	                	$i = 1;
	                	foreach($this->cart->contents() as $items): 
	                ?>
	            	<tr>
	                    <td class="center" width="25%"><?php echo $items['name']; ?></td>
	                    <td class="center" width="30%">
	                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($items['price'] * $dolar->bolivares,2,',','.').' BS';?>" >
	                            <?php echo number_format($items['price'] ,2,',','.').' $';?>
	                        </button>
	                    </td>
	                    <td class="center" width="15%"><?php echo $items['qty']; ?></td>
	                    <td class="center" width="30%">
		                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($items['subtotal'] * $dolar->bolivares,2,',','.').' BS';?>" >
		                            <?php echo number_format($items['subtotal'] ,2,',','.').' $';?>
		                        </button>
	                    </td>
	                    <td class="center" width="15%">
        					<form method="POST" action="<?php echo base_url('presupuestos/carrito_eliminar'); ?>">
	                			<input type="hidden" name="rowid" value="<?php echo $items['rowid']; ?>" >
	                			<input type="hidden" name="id" value="<?php echo $items['id']; ?>" >
		                        <button type="submit" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Quitar item">
		                            <i class="material-icons">close</i>
		                        </button>
        					</form>
	                    </td>
	            	</tr>
	                <?php
	                	$i++;
	                	endforeach; 
	                ?>
	            </tbody>
			</table>
			<div class="row">
				<div class="input-field col s4 tooltipped" data-position="top" data-tooltip="<?php echo number_format($this->cart->total() * $dolar->bolivares,2,',','.').' BS';?>">
					<input id="total" name="total" type="text" class="validate" value="<?php echo number_format($this->cart->total(),2,',','.').' $';?>" readonly>
					<label for="total">COSTO TOTAL DE SERVICIOS</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
				</div>
				<a href="<?php echo base_url('presupuestos/carrito_destruir');?>" <?php echo $estado; ?> class="btn-flat right waves-effect waves-light" >QUITAR TODOS LOS ITEMS</a>
			</div>
		</div>
		<!-- 	LISTADO DE SERVICIOS		-->
		<div class="" id="tab2" style="padding: 2rem;">
			<table class="display highlight" cellspacing="0" width="100%" >
				<thead>
	            	<tr>
	                	<th class="center" width="25%">SERVICIO</th>
	                    <th class="center" width="15%">PRECIO</th>
	                	<th class="center" width="15%">CANTIDAD</th>
	                    <th class="center" width="15%">ACCIONES</th>
	              	</tr>
	            </thead>
	            <tbody>
	                <?php $j = 1; foreach($servicios as $servicio): ?>
		            <tr>
		                <form method="POST" action="<?php echo base_url('presupuestos/carrito_agregar'); ?>">
		                	<input type="hidden" name="id" value="<?php echo $servicio->id_servicio; ?>" >
		                	<input type="hidden" name="name" value="<?php echo $servicio->servicio; ?>" >
		                	<input type="hidden" name="price" value="<?php echo $servicio->precio; ?>" >
		                	<input type="hidden" name="existencia" value="<?php echo '0';?>" >

		                    <td class="center" width="25%">
		                    	<!-- <a class="btn-flat detalle" data-urlDetalle="<?php //echo base_url('servicios/detalle')?>" data-detalle="<?php //echo $servicio->id_servicio; ?>">
		                    		<?php //echo $servicio->servicio; ?>
		                    	</a> -->
		                    	<?php echo $servicio->servicio; ?>
		                    </td>
		                    <td class="center" width="30%">
		                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($servicio->precio * $dolar->bolivares,2,',','.').' BS';?>" >
		                            <?php echo number_format($servicio->precio,2,',','.').' $';?>
		                        </button>
		                    </td>
		                    <td class="center" width="15%">
		                    	<div class="input-field">
									<input  name="qty" type="text" class="validate" value="1">
									<label >CANTIDAD</label>
									<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
								</div>
		                    </td>
		                    <td class="center" width="15%">
		                        <button type="submit" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Agregar item">
		                            <i class="material-icons">add</i>
		                        </button>
		                    </td>
	            		</form>
		            </tr>
	                <?php $j++; endforeach; ?>
	            </tbody>
			</table>
		</div>
		<!-- 	FIN CARRITO		-->
	</section>


	<div id="detalle" class="modal">
		<div class="modal-content" style="height: 100%;">
			<h4 class="center"><span style="font-weight: 300;">Fumigaciones JG</h4>
		    <h4 class="modal-close close-icon material-icons">clear</h4>


		</div>
	</div>


	<script>		
		/*$('.detalle').click( function (event) {
			//event.preventDefault();
			
			var url_detalle = $(this).attr("data-urlDetalle");
			var item = $(this).attr("data-detalle");
			
			$.ajax({
                url:url_detalle,
                type: 'POST',
                //dataType: 'json',
                data: { detalle : item },
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function(){ 
                    $('.progress').removeClass('hide');
                }
            })
            .done(function(respuesta){
            	var json = $.parseJSON(respuesta); 


            })
            .fail(function(respuesta) {
                M.toast({html: 'Ha ocurrido un error fatal, contacte al soporte técnico', displayLength:2500});
                $('.validate').addClass('invalid');
            })
            .always(function(respuesta) {
                $('.progress').addClass('hide');    
                console.log(respuesta);
            });


			$('#detalle').modal("open");
            
        });*/

		$('#precio').bind('keypress keyup keydown focus blur', function(event) {
			
			var cambio         = $('#cambio').val();
			var dolar          = $(this).val();
			var totalBolivares = 0;
			
			totalBolivares = (dolar * cambio);

			if(totalBolivares == null || totalBolivares == NaN){
				$('#bolivares').val(0);
			}else{
				$('#bolivares').val(totalBolivares);		
			}
		
		});

		$('#bolivares').bind('keypress keyup keydown focus blur', function(event) {
			
			var cambio         = $('#cambio').val();
			var bolivares      = $(this).val();
			var totalDolares   = 0;
			
			totalDolares = (bolivares / cambio);

			if(totalDolares == null || totalDolares == NaN){
				$('#precio').val(0);
			}else{
				$('#precio').val(totalDolares);		
			}
		
		});


		(function($){
    		$(function(){

				$('#vencimiento').datepicker({
			        format: 'dd-mm-yyyy',
			        formatSubmit: 'yyyy-mm-dd',
			        //maxYear: 2018,
			        //maxDate: new Date(),
			        minDate: new Date(),
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
			    });

			});
		})(jQuery);

	</script>
	<?php if (isset($alert)): ?>
	<script>
		(function($){
	    	$(function(){
	    		M.toast({html: '<?php echo $alert;?>', displayLength:2000});
	    	});
		})(jQuery);
	</script>
	<?php endif;?>
	<?php $this->load->view('template/datatables'); ?>
		