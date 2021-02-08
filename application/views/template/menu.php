<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- 	MENU		-->
		<div class="main-wrapper">
		
			<!-- Dropdown usuarios-->
			<ul id="avatarDropdown" class="dropdown-content">
				<li>
					<a class="waves-effect waves-block waves-light avatar-option center" href="<?php echo base_url('usuario')?>">
						<img src="<?php echo base_url('app/assets/img/avatars/usuario.png')?>" class="preview circle">
						<span style="display: block; width: 100%; font-size: 0.8rem;">
							<?php echo strtoupper($_SESSION['login']['nivel']);?>
						</span>
						<span class="updateData"><?php echo $_SESSION['login']['usuario'];?></span>
					</a>
				</li>
				<!-- <li>
					<a class="waves-effect waves-block waves-light" href="<?php //echo base_url('notifications');?>">
						<i class="material-icons left">notifications</i> Notificaciones
						<?php //if($_SESSION['user']['notification'] > 0):?>
							<span id="userNotification" class="new badge red" style="position: absolute; right: 1rem;" data-badge-caption="<?php //echo $_SESSION['user']['notification'];?>"></span>
						<?php //endif;?>
					</a>
				</li> -->
				<div class="divider"></div>
				<li>
					<a class="waves-effect waves-block waves-light" href="<?php echo base_url('inicio/logout');?>">
						<i class="material-icons left">power_settings_new</i> Cerrar sesión
					</a>
				</li>
			</ul>

			<!-- Dropdown registros-->
			<ul id="registros" class="dropdown-content submenu">
				<li>
					<a href="<?php echo base_url('servicios');?>">Servicios</a>
				</li>
				<li>
					<a href="<?php echo base_url('suministros');?>">Suministros</a>
				</li>
				<li>
					<a href="<?php echo base_url('clientes');?>">Clientes</a>
				</li>
				<?php if( $_SESSION['login']['nivel'] == 'administrador' ):?>
					<li>
						<a href="<?php echo base_url('usuarios');?>">Usuarios</a>
					</li>
				<?php endif; ?>
			</ul>

			<!-- Dropdown solicitudes-->
			<ul id="solicitudes" class="dropdown-content submenu">
				<li>
					<a href="<?php echo base_url('presupuestos');?>">Presupuestos</a>
				</li>
				<li>
					<a href="<?php echo base_url('fumigaciones');?>">Fumigaciones</a>
				</li>
				<li>
					<a href="<?php echo base_url('garantias');?>">Garantias</a>
				</li>
			</ul>

			<!-- Dropdown inventario-->
			<!-- <ul id="inventario" class="dropdown-content submenu">
				<li>
					<a href="<?php //echo base_url('reabastecimientos');?>">Reabastecimientos</a>
				</li>
				<?php //if( $_SESSION['login']['nivel'] == 'administrador' ):?>
					<li>
						<a href="<?php //echo base_url('suministros');?>">Suministros</a>
					</li>
				<?php //endif; ?>
			</ul> -->

			<!-- Dropdown opciones-->
			<ul id="opciones" class="dropdown-content submenu">
				<?php if( $_SESSION['login']['nivel'] == 'administrador' ):?>
					<li>
						<a href="<?php echo base_url('cambio');?>">Tasa cambiaria</a>
					</li>
				<?php endif; ?>
				<li>
					<a href="<?php echo base_url('bitacora');?>">Bitacora</a>
				</li>
				<?php if( $_SESSION['login']['nivel'] == 'administrador' ):?>
					<li>
						<a href="<?php echo base_url('respaldo');?>">Respaldo</a>
					</li>
					<li>
						<a href="<?php echo base_url('restauracion');?>">Restauracion</a>
					</li>
				<?php endif; ?>
				<li>
					<a href="<?php echo base_url('ayuda');?>">Ayuda</a>
				</li>
			</ul>
			<!-- Navbar -->
			<div class="navbar-fixed">
				<nav class="blue-grey darken-4 z-depth-0" >
					<div class="nav-wrapper">
						<div class="left col s9" style="margin-left: 5rem;">
							<a class="breadcrumb" href="<?php echo base_url('inicio/bienvenido');?>" >
								<span style="font-weight: 300;">Inicio</span>
							</a>
							<?php if(isset($breadcrumbs) && $breadcrumbs != NULL) foreach ($breadcrumbs as $key => $value): ?>
								<a href="<?php echo base_url($value);?>" class="breadcrumb updateData"><?php echo $key;?></a>
							<?php endforeach;?>
						</div>
						<ul class="right">   
							<li>
								<a class="dropdown-trigger avatar-dropdown" href="#!" data-target="avatarDropdown">
									<span class="avatar-navbar">
										<img src="<?php echo base_url('app/assets/img/avatars/usuario.png')?>" class="preview circle z-depth-3">
										<?php //if($_SESSION['user']['alert'] > 0):?>
											<!-- <span id="userAlert" class="new badge red" style="position: absolute; right: 1rem; min-width: 1rem; height: 1rem; border-radius: 50%;" data-badge-caption=""></span> -->
										<?php //endif;?>
									</span>
								</a>
							</li>
						</ul>
					</div> 
				</nav>
			</div>

			<div class="navbar" style="margin-top: 64px;">
				<nav class="white z-depth-0" >
					<div class="nav-wrapper container">
						<ul>   
							<li>
								<a class="dropdown-trigger grey-text" data-target="registros">
									Registros<i class="material-icons right">arrow_drop_down</i>
								</a>
							</li>
							<li>
								<a class="dropdown-trigger grey-text" data-target="solicitudes">
									Solicitudes<i class="material-icons right">arrow_drop_down</i>
								</a>
							</li>
							<!-- <li>
								<a class="dropdown-trigger grey-text" data-target="inventario">
									Inventario<i class="material-icons right">arrow_drop_down</i>
								</a>
							</li> -->
							<li>
								<a class="dropdown-trigger grey-text" data-target="opciones">
									Opciones<i class="material-icons right">arrow_drop_down</i>
								</a>
							</li>
						</ul>	
					</div>
				</nav>
			</div>
		</div>