<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('suministros/guardar');?>">
			<input type="hidden" id="cambio" value="<?php echo $dolar->bolivares; ?>">

			<div class="row">
				<div class="col s4 input-field">
					<input id="suministro" name="suministro" type="text" class="validate">
					<label for="suministro">SUMINISTRO</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Insecticida</span>
				</div>
				<div class="input-field col s4">
				    <select name="unidad" id="unidad">
				      <option value="unidad">Unidad</option>
				      <option value="mg">Miligramos (mg)</option>
				      <option value="ml">Mililitros (ml)</option>
				    </select>
				    <label for="unidad">UNIDAD DE MEDIDA</label>
				</div>
				<div class="col s4 input-field">
					<input id="existencia" name="existencia" type="text" class="validate">
					<label for="existencia">EXISTENCIA</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 12</span>
				</div>
				<div class="col s4 input-field">
					<input id="minimo" name="minimo" type="text" class="validate">
					<label for="minimo">STOCK MINIMO</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 3</span>
				</div>
				<div class="col s4 input-field">
					<input id="costo" name="costo" type="text" class="validate" placeholder="0.00">
					<label for="costo">COSTO UNITARIO DOLARES</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">
						<?php echo ''.$dolar->bolivares.'Bs X $'; ?>
					</span>
				</div>
				<div class="col s4 input-field">
					<input id="bolivares" name="bolivares" type="text" class="validate" placeholder="0.00">
					<label for="bolivares">COSTO UNITARIO BOLIVARES</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">
						<?php echo '$ X '.$dolar->bolivares.'Bs'; ?>
					</span>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12 center">
					<button type="submit" class="waves-effect waves-light btn">GUARDAR</button>
				</div>
			</div>
		</form>
	</section>

	<script>
		
		$('#costo').bind('keypress keyup keydown focus blur', function(event) {
			
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
				$('#costo').val(0);
			}else{
				$('#costo').val(totalDolares);		
			}
		
		});

	</script>
		