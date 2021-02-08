<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('cambio/guardar');?>">

			<div class="row">
				<div class="col s4 push-s4 input-field">
					<input id="bolivares" name="bolivares" type="text" class="validate" placeholder="0.00">
					<label for="bolivares">PRECIO BOLIVARES</label>
					<span class="helper-text" data-error="" data-success="¡Se ve bien!">1 Dolar al cambio en Bolivares</span>
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
		
		/*$('#costo').bind('keypress keyup keydown focus blur', function(event) {
			
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
		
		});*/

	</script>
		