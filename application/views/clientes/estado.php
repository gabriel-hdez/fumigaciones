<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('clientes/actualizar/'.$cliente->cedula);?>">
			<input type="hidden" name="token" value="estado">
			<input type="hidden" name="id" value="<?php echo $cliente->id_cliente; ?>">
			<input type="hidden" name="estado" value="<?php echo $cliente->estado; ?>">
		<div class="row">
			<div class="col s4 input-field">
				<input id="nombre" name="nombre" type="text" class="validate" value="<?php echo $cliente->nombre; ?>" disabled="disabled">
				<label for="nombre">NOMBRE</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="apellido" name="apellido" type="text" class="validate" value="<?php echo $cliente->apellido; ?>" disabled="disabled">
				<label for="apellido">APELLIDO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="cedula" name="cedula" type="text" class="validate" value="<?php echo $cliente->cedula; ?>" disabled="disabled">
				<label for="cedula">CEDULA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="correo" name="correo" type="text" class="validate" value="<?php echo $cliente->correo; ?>" disabled="disabled">
				<label for="correo">CORREO ELECTRONICO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="tlf" name="tlf" type="text" class="validate" value="<?php echo $cliente->tlf; ?>" disabled="disabled">
				<label for="tlf">TELEFONO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="alergias" name="alergias" type="text" class="validate" value="<?php echo $cliente->alergias; ?>" disabled="disabled">
				<label for="alergias">ALERGIAS</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
	
			<div class="row">
				<div class="col s12 center">
					<?php if($cliente->estado == '1'){ ?>
						<button type="submit" class="waves-effect waves-light btn">ELIMINAR</button>
					<?php }else{ ?>
						<button type="submit" class="waves-effect waves-light btn">RESTAURAR</button>
					<?php } ?>
				</div>
			</div>
		</form>
	</section>
		