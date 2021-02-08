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
<!-- 		<script type="text/javascript" src="<?php //echo base_url('app/assets/js/main/datatables.js');?>"></script> -->
		<?php echo $this->resources->js();?>
		<script type="text/javascript" src="<?php echo base_url('app/assets/js/main/init.js');?>"></script>
		<!-- 	TITLE		-->
		<link rel="icon" href="<?php echo base_url('app/assets/img/fumigacion/logo.jpg');?>" sizes="40x40">
		<title><?php echo APP_NAME;?></title>
	</head>
	<body>
		<!-- 	PRELOADERS		-->
		<div id="loader-wrapper" style="z-index: 999999;">
			<div id="loader"></div>
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
		</div>
		<div id="indeterminate" class="progress teal hide">
			<div class="indeterminate teal darken-3"></div>
		</div>