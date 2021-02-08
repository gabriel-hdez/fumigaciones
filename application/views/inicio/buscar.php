<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- 	METAETIQUETAS		-->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="description" content="<?php echo APP_NAME;?>, Fumigación integral, compra y venta de productos: insecticidas, fetilizantes y roenticidas.">
		<meta name="keywords" content="<?php echo APP_NAME;?>, sistema, soporte, equipos">
		<!-- 	CSS		-->
		<link rel="stylesheet" href="<?php echo base_url('app/assets/css/materialize.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('app/assets/css/custom.css');?>">
		<?php echo $this->resources->css();?>
		<!-- 	JS		-->
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/jquery-3.3.1.min.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/materialize.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/datatables.js');?>"></script>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/init.js');?>"></script>
		<?php echo $this->resources->js();?>
		<!-- 	TITLE		-->
		<link rel="icon" href="<?php echo base_url('app/assets/img/fumigacion/logo.jpg');?>" sizes="40x40">
		<title><?php echo APP_NAME;?></title>
	</head>
	<body>
		<img src="<?php echo base_url('app/assets/img/fumigacion/terminator.jpeg');?>" style="position: absolute; height: 80vh; top: 5rem; left: 2rem;">
		<!-- 	PRELOADERS		-->
		<div id="loader-wrapper" style="z-index: 999999;">
			<div id="loader"></div>
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
		</div>
		<div id="indeterminate" class="progress blue hide">
			<div class="indeterminate blue darken-3"></div>
		</div>
		<!-- 	SECTION		-->
		<section class="container">
			<div class="row">
				<div class="col s8 push-s2">					
					<div class="card">
						<div class="row"> 
							<div class="center">
								<img src="<?php echo base_url('app/assets/img/fumigacion/titulo.png');?>" style="padding: 1rem; width: 40vw;" alt="<?php echo APP_NAME;?>">
							</div>

							<form id="myform" accept-charset="utf-8" enctype="multipart/form-data" method="post" action="<?php echo base_url('recuperar/buscar');?>">
								
								<div class="row">
									<div class="input-field col s12 m6 push-m3">
						              <input id="correo" name="correo" type="text" class="validate">
						              <label for="correo" class="active">CORREO ELECTRONICO</label>
						              <span class="helper-text" data-error="" data-success="¡Se ve bien!">Ej. usuario@correo.com</span>
						            </div>
								</div>
								
								<div class="row center">
									 <button class="waves-effect btn-large waves-light btn" type="submit" >SIGUIENTE</button>
								</div>
							</form>


							<!-- <div class="row center">
								<a href="<?php //echo base_url('inicio/recuperar');?>" class="modal-close waves-effect waves-light btn-flat">RECUPERAR MIS DATOS</a>
							</div> -->
							
							<div class="card-action center">	
								<span class="grey-text"> 
									<p>
										Fumigación integral, compra y venta de productos: insecticidas, fetilizantes y roenticidas.
									</p> 
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</body>
</html>