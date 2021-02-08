<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('servicios/actualizar');?>">
			<input type="hidden" name="token" value="eliminar">
			<input type="hidden" name="id" value="<?php echo $servicio->id_servicio; ?>">
			<input type="hidden" id="cambio" value="<?php echo $dolar->bolivares; ?>">

			<div class="row">
				<div class="input-field col s4 tooltipped" data-position="top" data-tooltip="<?php echo number_format($this->cart->total() * $dolar->bolivares,2,',','.').' BS';?>">
					<input id="total" name="total" type="text" class="validate" value="<?php echo number_format($this->cart->total(),2,',','.').' $';?>" disabled>
					<label for="total">COSTO TOTAL DE SUMINISTROS</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
				</div>
				<div class="col s4 input-field">
					<input id="servicio" name="servicio" type="text" class="validate" value="<?php echo $servicio->servicio?>" disabled>
					<label for="servicio">NOMBRE DEL SERVICIO</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
				</div>
				<div class="col s4 input-field">
					<input id="precio" name="precio" type="text" class="validate" placeholder="0.00" value="<?php echo $servicio->precio;?>" disabled>
					<label for="precio">PRECIO DEL SERVICIO</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
				</div>
			</div>

			
			<div class="row">
				<div class="col s12 center">
					<?php if($servicio->estado == '1'){ ?>
						<button type="submit" class="waves-effect waves-light btn">ELIMINAR</button>
					<?php }else{ ?>
						<button type="submit" class="waves-effect waves-light btn">RESTAURAR</button>
					<?php } ?>
				</div>
			</div>
		</form>
		
		<!-- 	OPCIONES		-->
		<div class="col s12">
	      	<ul class="tabs">
		        <li class="tab col s6">
		        	<a href="#tab1">
		        		<span>Suministros agregados</span> 
		        	</a>
		    	</li>
	      	</ul>
	    </div>
	    <!-- 	PREVISUALIZACION CARRITO		-->
		<div class="" id="tab1" style="padding: 2rem;">
			<table class="display highlight" cellspacing="0" width="100%" id="suministros" >
				<thead>
	            	<tr>
	                	<th class="center" width="25%">SUMINISTRO</th>
	                	<th class="center" width="30%">COSTO UNITARIO</th>
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
		<!-- 	FIN CARRITO		-->
	</section>

	<script>		
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
		