<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height">
		
		<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
			<thead>
            	<tr>
                    <!-- <th class="center">CONTROL</th>
                	<th class="center">SOLICITUD</th> -->
                    <th class="center">VENCIMIENTO</th>
                    <th class="center">CLIENTE</th>
                    <th class="center">CONTACTO</th>
                	<th class="center">TOTAL PRESUPUESTADO</th>
                	<th class="center">ACCIONES</th>
              	</tr>
            </thead>
            <tbody>
                <?php foreach ($presupuestos as $presupuesto) : ?>
            	<tr>
            		<!-- <td class="center"><?php// echo $presupuesto->control; ?></td>
                    <td class="center"><?php// echo $presupuesto->fecha_solicitud; ?></td> -->
                    <td class="center"><?php echo $presupuesto->vencimiento; ?></td>
                    <td class="center"><?php echo $presupuesto->nombre.' '.$presupuesto->apellido; ?></td>
                    <td class="center"><?php echo $presupuesto->tlf; ?></td>
            		<td class="center">
                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($presupuesto->total * $dolar->bolivares,2,',','.').' BS';?>" >
                            <?php echo number_format($presupuesto->total,2,',','.').' $';?>
                        </button>      
                    </td>
            		<td class="center">
                       <!--  <a href="<?php// echo base_url('presupuestos/editar/').$presupuesto->id_presupuesto; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                            <i class="material-icons">mode_edit</i>
                        </a> -->
                        <?php if($presupuesto->estado == "1"){ ?>
                            <a href="<?php echo base_url('presupuestos/estado/').$presupuesto->id_presupuesto; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Eliminar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('presupuestos/estado/').$presupuesto->id_presupuesto; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Restaurar">
                                <i class="material-icons">restore</i>
                            </a>    
                        <?php } ?>
                    </td>
            	</tr>
                <?php endforeach; ?>
            </tbody>
		</table>
		
	</section>
    <?php if (isset($alert)): ?>
    <script>
        (function($){
            $(function(){
                M.toast({html: '<?php echo $alert;?>', displayLength:2000});
            });
        })(jQuery);
    </script>
    <?php endif;?>
     <?php $this->load->view('template/datatables'); ?>