<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height">

		<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
			<thead>
            	<tr>
                	<th class="center">NIVEL</th>
                    <th class="center">CEDULA</th>
                	<th class="center">NOMBRE Y APELLIDO</th>
                	<th class="center">CORREO</th>
                	<th class="center">ACCIONES</th>
              	</tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
            	<tr>
            		<td class="center"><?php echo $usuario->nivel; ?></td>
                    <td class="center"><?php echo $usuario->cedula; ?></td>
            		<td class="center"><?php echo $usuario->nombre.' '.$usuario->apellido; ?></td>
            		<td class="center"><?php echo $usuario->correo; ?></td>
            		<td class="center">
                        <a href="<?php echo base_url('usuarios/editar/').$usuario->cedula; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        <?php if($usuario->estado == "1"){ ?>
                            <a href="<?php echo base_url('usuarios/estado/').$usuario->cedula; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Eliminar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('usuarios/estado/').$usuario->cedula; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Restaurar">
                                <i class="material-icons">restore</i>
                            </a>    
                        <?php } ?>
                    </td>
            	</tr>
                <?php endforeach; ?>
            </tbody>
		</table>
		
	</section>
    <?php $this->load->view('template/datatables'); ?>
		