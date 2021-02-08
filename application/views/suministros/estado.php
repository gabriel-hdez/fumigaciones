<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('suministros/actualizar');?>">
			<input type="hidden" name="token" value="estado">
			<input type="hidden" name="id" value="<?php echo $suministro->id_suministro; ?>">
			<input type="hidden" name="estado" value="<?php echo $suministro->estado; ?>">
			<input type="hidden" id="cambio" value="<?php echo $dolar->bolivares; ?>">

			<div class="row">
				<div class="col s4 input-field">
					<input id="suministro" name="suministro" type="text" class="validate" value="<?php echo $suministro->suministro; ?>" disabled="disabled" >
					<label for="suministro">SUMINISTRO</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Insecticida</span>
				</div>
				<div class="input-field col s4">
				    <select name="unidad" id="unidad" disabled="disabled">
				    	<?php if ($suministro->unidad == 'unidad'){ ?>
						    	<option value="unidad">Unidad</option>
						      	<option value="mg">Miligramos (mg)</option>
						      	<option value="ml">Mililitros (ml)</option>
				    	<?php }elseif($suministro->unidad == 'mg'){ ?>
						      	<option value="mg">Miligramos (mg)</option>
						    	<option value="unidad">Unidad</option>
						      	<option value="ml">Mililitros (ml)</option>
				    	<?php }else{ ?>
						      	<option value="ml">Mililitros (ml)</option>
						    	<option value="unidad">Unidad</option>
								<option value="mg">Miligramos (mg)</option>
				    	<?php } ?>
				     
				    </select>
				    <label for="unidad">UNIDAD DE MEDIDA</label>
				</div>
				<div class="col s4 input-field">
					<input id="existencia" name="existencia" type="text" class="validate" value="<?php echo $suministro->existencia; ?>" disabled="disabled">
					<label for="existencia">EXISTENCIA</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 12</span>
				</div>
				<div class="col s4 input-field">
					<input id="minimo" name="minimo" type="text" class="validate" value="<?php echo $suministro->minimo; ?>" disabled="disabled">
					<label for="minimo">STOCK MINIMO</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 3</span>
				</div>
				<div class="col s4 input-field">
					<input id="costo" name="costo" type="text" class="calcular validate" value="<?php echo $suministro->costo; ?>" disabled="disabled">
					<label for="costo">COSTO UNITARIO DOLARES</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">
						<?php echo ''.$dolar->bolivares.'Bs X $'; ?>
					</span>
				</div>
				<div class="col s4 input-field">
					<input id="bolivares" name="bolivares" type="text" class="calcular validate" disabled="disabled">
					<label for="bolivares">COSTO UNITARIO BOLIVARES</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">
						<?php echo '$ X '.$dolar->bolivares.'Bs'; ?>
					</span>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12 center">
					<?php if($suministro->estado == '1'){ ?>
						<button type="submit" class="waves-effect waves-light btn">ELIMINAR</button>
					<?php }else{ ?>
						<button type="submit" class="waves-effect waves-light btn">RESTAURAR</button>
					<?php } ?>
				</div>
			</div>
		</form>
	</section>

	<script>

		var cambio         = $('#cambio').val();
		var dolar          = $('#costo').val();
		var totalBolivares = 0;
		totalBolivares = (dolar * cambio);
		$('#bolivares').val(totalBolivares);

		
	</script>
		