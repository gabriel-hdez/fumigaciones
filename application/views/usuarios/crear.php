<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('usuarios/guardar');?>">
		<div class="row">
			<div class="input-field col s4">
			    <select name="nivel" id="nivel">
			      <option value="usuario">Usuario</option>
			      <option value="administrador">Administrador</option>
			    </select>
			    <label for="nivel">NIVEL DE USUARIO</label>
			</div>
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
				<input id="cedula" name="cedula" type="text" class="validate" placeholder="Ej. 10123123">
				<label for="cedula">CEDULA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Contraseña provisional del usuario</span>
			</div>
			<div class="col s4 input-field">
				<input id="correo" name="correo" type="text" class="validate">
				<label for="correo">CORREO ELECTRONICO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. usuario@correo.com</span>
			</div>
			<div class="col s4 input-field">
				<input id="pregunta" name="pregunta" type="text" class="validate">
				<label for="pregunta">PREGUNTA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Pregunta de seguridad</span>
			</div>
			<div class="col s4 input-field">
				<input id="respuesta" name="respuesta" type="text" class="validate">
				<label for="respuesta">RESPUESTA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Respuesta de seguridad</span>
			</div>
	
			<div class="row">
				<div class="col s12 center">
					<button type="submit" class="waves-effect waves-light btn">GUARDAR</button>
				</div>
			</div>
		</form>
	</section>
		