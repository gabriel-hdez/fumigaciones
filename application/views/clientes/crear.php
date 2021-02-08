<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('clientes/guardar');?>">
		<div class="row">
			<div class="col s4 input-field">
				<input id="nombre" name="nombre" type="text" class="validate">
				<label for="nombre">NOMBRE</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Maria</span>
			</div>
			<div class="col s4 input-field">
				<input id="apellido" name="apellido" type="text" class="validate">
				<label for="apellido">APELLIDO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Perez</span>
			</div>
			<div class="col s4 input-field">
				<input id="cedula" name="cedula" type="text" class="validate">
				<label for="cedula">CEDULA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 10123123</span>
			</div>
			<div class="col s4 input-field">
				<input id="correo" name="correo" type="text" class="validate">
				<label for="correo">CORREO ELECTRONICO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. usuario@correo.com</span>
			</div>
			<div class="col s4 input-field">
				<input id="tlf" name="tlf" type="text" class="validate">
				<label for="tlf">TELEFONO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 02441234567</span>
			</div>
			<div class="col s4 input-field">
				<input id="alergias" name="alergias" type="text" class="validate">
				<label for="alergias">ALERGIAS</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
	
			<div class="row">
				<div class="col s12 center">
					<button type="submit" class="waves-effect waves-light btn">GUARDAR</button>
				</div>
			</div>
		</form>
	</section>
		