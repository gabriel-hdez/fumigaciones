<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('usuario/actualizar');?>">
		<input type="hidden" name="id" value="<?php echo $usuario->id_usuario; ?>">
		<div class="row">
			<div class="input-field col s4">
			    <select name="nivel" id="nivel">
			    	<?php if ($usuario->nivel == 'usuario'){ ?>
					    <option value="usuario">Usuario</option>
					    <option value="administrador">Administrador</option>
			    	<?php }else{ ?>
					    <option value="administrador">Administrador</option>
					    <option value="usuario">Usuario</option>
			    	<?php } ?>
			    </select>
			    <label for="nivel">NIVEL DE USUARIO</label>
			</div>
			<div class="col s4 input-field">
				<input id="nombre" name="nombre" type="text" class="validate" value="<?php echo $usuario->nombre; ?>">
				<label for="nombre">NOMBRE</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Maria</span>
			</div>
			<div class="col s4 input-field">
				<input id="apellido" name="apellido" type="text" class="validate" value="<?php echo $usuario->apellido; ?>">
				<label for="apellido">APELLIDO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. Perez</span>
			</div>
			<div class="col s4 input-field">
				<input id="cedula" name="cedula" type="text" class="validate" value="<?php echo $usuario->cedula; ?>">
				<label for="cedula">CEDULA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. 10123123</span>
			</div>
			<div class="col s4 input-field">
				<input id="correo" name="correo" type="text" class="validate" value="<?php echo $usuario->correo; ?>">
				<label for="correo">CORREO ELECTRONICO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. usuario@correo.com</span>
			</div>
			<div class="col s4 input-field">
				<input id="pregunta" name="pregunta" type="text" class="validate" value="<?php echo $this->encryption->decrypt($usuario->pregunta); ?>">
				<label for="pregunta">PREGUNTA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Pregunta de seguridad</span>
			</div>
			<div class="col s4 input-field">
				<input id="respuesta" name="respuesta" type="text" class="validate" value="<?php echo $this->encryption->decrypt($usuario->respuesta); ?>">
				<label for="respuesta">RESPUESTA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Respuesta de seguridad</span>
			</div>
			<div class="col s4 input-field">
				<input id="clave" name="clave" type="password" class="validate" value="">
				<label for="clave">NUEVA CONTRASEÑA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Requerido si deseas cambiar tu contraseña</span>
			</div>
			<div class="col s4 input-field">
				<input id="verificar" name="verificar" type="password" class="validate" value="">
				<label for="verificar">CONTRASEÑA ACTUAL</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!">Requerida para confirmar los cambios de tus datos</span>
			</div>
	
			<div class="row">
				<div class="col s12 center">
					<button type="submit" class="waves-effect waves-light btn">CONFIRMAR Y ACTUALIZAR</button>
				</div>
			</div>
		</form>
	</section>
		