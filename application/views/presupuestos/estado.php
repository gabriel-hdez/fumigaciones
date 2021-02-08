<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ($this->cart->total_items() == 0){ $estado='disabled'; }else{ $estado=''; }
?>

	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<!-- 	OPCIONES		-->
		<div class="col s12">
	      	<ul class="tabs">
		        <li class="tab col s6">
		        	<a href="#tab1">
		        		<span>Datos del presupuesto</span> 
		        	</a>
		    	</li>
		       <li class="tab col s6">
		        	<a href="#tab2">
		        		<span>Datos del cliente</span> 
		        	</a>
		    	</li>
		    	<li class="tab col s6">
		        	<a href="#tab3">
		        		<span>Servicios agregados</span> 
		        	</a>
		    	</li>
	      	</ul>
	    </div>
	    <div id="tab1">
	    	<div class="row">
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
					<input id="total" name="total" type="text" class="validate" value="<?php echo number_format($this->cart->total(),2,',','.').' $';?>" disabled>
					<label for="total">COSTO TOTAL DE SERVICIOS</label>
					<span class="helper-text" data-error="" data-success=""></span>
				</div>
				<div class="input-field col s6 tooltipped" data-position="top" data-tooltip="<?php echo number_format($presupuesto->total * $dolar->bolivares,2,',','.').' BS';?>">
					<input id="total_presupuesto" name="total_presupuesto" type="text" class="validate" value="<?php echo number_format($presupuesto->total,2,',','.').' $';?>" disabled>
					<label for="total_presupuesto">TOTAL PRESUPUESTADO</label>
					<span class="helper-text" data-error="" data-success="Monto expresado en divisas"></span>
				</div>
			</div>
	    </div>
	    <div id="tab2">
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
	    </div>
	    <!-- 	PREVISUALIZACION CARRITO		-->
		<div id="tab3" style="padding: 2rem;">
			<table class="display highlight" cellspacing="0" width="100%" >
				<thead>
	            	<tr>
	                	<th class="center" width="25%">SERVICIO</th>
	                	<th class="center" width="30%">PRECIO</th>
	                    <th class="center" width="15%">CANTIDAD</th>
	                	<th class="center" width="15%">COSTO SUBTOTAL</th>
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
	            	</tr>
	                <?php
	                	$i++;
	                	endforeach; 
	                ?>
	            </tbody>
			</table>
		</div>
		<div class="row">
			<div class="col s12 center">
				<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('servicios/actualizar');?>">
					<input type="hidden" name="token" value="eliminar">
					<input type="hidden" name="id" value="<?php echo $presupuesto->id_presupuesto; ?>">
					<input type="hidden" id="cambio" value="<?php echo $dolar->bolivares; ?>">
					<?php if($presupuesto->estado == '1'){ ?>
						<button type="submit" class="waves-effect waves-light btn">ELIMINAR PRESUPUESTO</button>
					<?php }else{ ?>
						<button type="submit" class="waves-effect waves-light btn">RESTAURAR PRESUPUESTO</button>
					<?php } ?>
				</form>
			</div>
		</div>
	</section>

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
		