<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height" style="padding-top: 2em;">
		<form id="myForm" enctype="multipart/form-data" method="POST" action="<?php echo base_url('usuarios/actualizar/'.$usuario->cedula);?>">
			<input type="hidden" name="token" value="estado">
			<input type="hidden" name="id" value="<?php echo $usuario->id_usuario; ?>">
			<input type="hidden" name="estado" value="<?php echo $usuario->estado; ?>">
		<div class="row">
			<div class="input-field col s4">
			    <select name="nivel" id="nivel" disabled="disabled">
			    	<?php if ($usuario->nivel == 'usuario'){ ?>
					    <option value="usuario">Usuario</option>
					    <option value="administrador">Administrador</option>
			    	<?php }else{ ?>
					    <option value="administrador">Administrador</option>
					    <option value="usuario">Usuario</option>
			    	<?php } ?>
			    </select>
			    <label for="nivel">Nivel del usuario</label>
			</div>
			<div class="col s4 input-field">
				<input id="nombre" name="nombre" type="text" class="validate" value="<?php echo $usuario->nombre; ?>" disabled="disabled">
				<label for="nombre">NOMBRE</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="apellido" name="apellido" type="text" class="validate" value="<?php echo $usuario->apellido; ?>" disabled="disabled">
				<label for="apellido">APELLIDO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="cedula" name="cedula" type="text" class="validate" value="<?php echo $usuario->cedula; ?>" disabled="disabled">
				<label for="cedula">CEDULA</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
			<div class="col s4 input-field">
				<input id="correo" name="correo" type="text" class="validate" value="<?php echo $usuario->correo; ?>" disabled="disabled">
				<label for="correo">CORREO ELECTRONICO</label>
				<span class="helper-text" data-error="" data-success="¡Se ve bien!"></span>
			</div>
	
			<div class="row">
				<div class="col s12 center">
					<?php if($usuario->estado == '1'){ ?>
						<button type="submit" class="waves-effect waves-light btn">ELIMINAR</button>
					<?php }else{ ?>
						<button type="submit" class="waves-effect waves-light btn">RESTAURAR</button>
					<?php } ?>
				</div>
			</div>
		</form>
	</section>
		