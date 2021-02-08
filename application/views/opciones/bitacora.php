<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height">
		
		<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
			<thead>
            	<tr>
                	<th class="center">FECHA</th>
                	<th class="center">BITACORA</th>
                	<th class="center">RESPONSABLE</th>
                	<th class="center">CONDICION</th>
              	</tr>
            </thead>
            <tbody>
                <?php 
                	foreach ($bitacora as $data):

            		if ($data->estado == '1') 
            		{
            			$estado = '<span class="new badge green" data-badge-caption="ACTIVO"></span>';
            		} 
            		else 
            		{
            			$estado = '<span class="new badge red" data-badge-caption="INACTIVO"></span>';
            		}
                		
                ?>
            	<tr>
            		<td class="center"><?php echo $data->fecha; ?></td>
            		<td class="center"><?php echo $data->bitacora; ?></td>
            		<td class="center"><?php echo $data->nombre.' '.$data->apellido; ?></td>
            		<td class="center"><?php echo $estado; ?></td>
            	</tr>
                <?php endforeach; ?>
            </tbody>
		</table>
		
	</section>
    <?php $this->load->view('template/datatables'); ?>