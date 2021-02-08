<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	$data['dolar'] = array(
	 	'select' => '*', 
	 	'table'  => 'dolares', 
	 	'order'  => 'fecha_dolar DESC',
	 	'return' => 'row', 
	);
	$dolar = $this->crud->read($data['dolar']);

	$data['listado'] = array(
	 	'select' => '*', 
	 	'table'  => 'suministros', 
	 	'order'  => 'fecha DESC',
	 	'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'),
	 	'where'  => 'bitacora.id_tabla = suministros.id_suministro AND bitacora.estado = "1"',  
	 	'return' => 'result', 
	);
	$listado = $this->crud->read($data['listado']);

	$data['suministros'] = array(
	 	'select' => '*', 
	 	'table'  => 'suministros', 
	 	'join'   => array(
	 		'serv_sum' => 'serv_sum.id_suministro = suministros.id_suministro'
	 	),
	 	'where'  => 'serv_sum.id_servicio = '.$servicio->id_servicio,  
	 	'return' => 'result', 
	);
	$suministros = $this->crud->read($data['suministros']);

	$total = 0;
	foreach ($suministros as $suministro) 
	{
		
		$total = $total + ($suministro->costo * $suministro->requerido);

		$data = array(
	        'id'      => $suministro->id_suministro,
	        'qty'     => $suministro->requerido,
	        'price'   => $suministro->costo,
	        'name'    => $suministro->suministro,
	 	);
	 	$this->cart->insert($data);
	}

if ($this->cart->total_items() == 0){ $estado='disabled'; }else{ $estado=''; }
?>
<div class="fixed-action-btn">
  <a class="btn-floating btn-large red tooltipped bicolor modal-trigger" data-position="left" data-tooltip="Listo" href="#modal" <?php //echo $estado;?> >
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

		    <form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('servicios/editar_guardar');?>">
				<input type="hidden" id="cambio" value="<?php echo $dolar->bolivares; ?>">
				<input type="hidden" name="id_servicio" value="<?php echo $servicio->id_servicio; ?>">

				<div class="row">
					<div class="col s12 input-field">
						<input id="servicio" name="servicio" type="text" class="validate" value="<?php echo $servicio->servicio;?>">
						<label for="servicio">NOMBRE DEL SERVICIO</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Servicio antivoladores</span>
					</div>
					<div class="input-field col s12 tooltipped" data-position="top" data-tooltip="<?php echo number_format($total * $dolar->bolivares,2,',','.').' BS';?>">
						<input id="total" name="total" type="text" class="validate" value="<?php echo $total;?>" readonly>
						<label for="total">COSTO TOTAL DE SUMINISTROS</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!">Monto en divisas</span>
					</div>
					<div class="col s12 input-field tooltipped" data-position="top" data-tooltip="<?php echo number_format($servicio->precio * $dolar->bolivares,2,',','.').' BS';?>">
						<input id="precio" name="precio" type="text" class="validate" placeholder="0.00" value="<?php echo $servicio->precio;?>">
						<label for="precio">PRECIO DEL SERVICIO</label>
						<span class="helper-text" data-error="" data-success="¡Se ve bien!">Monto en divisas</span>
					</div>
				</div>			
				<div class="row">
					<div class="col s12 center">
						<button type="submit" class="waves-effect waves-light btn" <?php echo $estado;?> >GUARDAR</button>
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
		        		<span>Suministros agregados</span> 
		        	</a>
		    	</li>
		        <li class="tab col s6">
		        	<a href="#tab2" >
		        		<span>Listado de suministros</span> 
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
        					<form method="POST" action="<?php echo base_url('servicios/editar_carrito_eliminar'); ?>">
	                			<input type="hidden" name="rowid" value="<?php echo $items['rowid']; ?>" >
	                			<input type="hidden" name="id_suministro" value="<?php echo $items['id']; ?>" >
	                			<input type="hidden" name="id_servicio" value="<?php echo $servicio->id_servicio; ?>" >
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
					<label for="total">COSTO TOTAL DE SUMINISTROS</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
				</div>
				<a href="<?php echo base_url('servicios/carrito_destruir');?>" <?php echo $estado; ?> class="btn-flat right waves-effect waves-light" >QUITAR TODOS LOS ITEMS</a>
			</div>
		</div>
		<!-- 	LISTADO DE SUMINISTROS		-->
		<div class="" id="tab2" style="padding: 2rem;">
			<table class="display highlight" cellspacing="0" width="100%" id="suministros" >
				<thead>
	            	<tr>
	                	<th class="center" width="25%">SUMINISTRO</th>
	                    <th class="center" width="15%">EXISTENCIA</th>
	                	<th class="center" width="30%">COSTO UNITARIO</th>
	                	<th class="center" width="15%">CANTIDAD</th>
	                    <th class="center" width="15%">ACCIONES</th>
	              	</tr>
	            </thead>
	            <tbody>
	                <?php $j = 1; foreach($listado as $item): ?>
		            <tr>
		                <form method="POST" action="<?php echo base_url('servicios/editar_carrito_agregar'); ?>">
		                	<input type="hidden" name="id_suministro" value="<?php echo $item->id_suministro; ?>" >
		                	<input type="hidden" name="id_servicio" value="<?php echo $servicio->id_servicio; ?>" >
		                	<input type="hidden" name="name" value="<?php echo $item->suministro; ?>" >
		                	<input type="hidden" name="price" value="<?php echo $item->costo; ?>" >
		                	<input type="hidden" name="existencia" value="<?php echo $item->existencia; ?>" >

		                    <td class="center" width="25%"><?php echo $item->suministro; ?></td>
		                    <td class="center" width="15%"><?php echo $item->existencia; ?></td>
		                    <td class="center" width="30%">
		                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($item->costo * $dolar->bolivares,2,',','.').' BS';?>" >
		                            <?php echo number_format($item->costo,2,',','.').' $';?>
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
		