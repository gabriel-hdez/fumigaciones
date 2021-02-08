<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height">
		
		<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
			<thead>
            	<tr>
                	<th class="center">CODIGO</th>
                    <th class="center">SERVICIO</th>
                	<th class="center">PRECIO</th>
                	<th class="center">ACCIONES</th>
              	</tr>
            </thead>
            <tbody>
                <?php foreach ($servicios as $servicio) : ?>
            	<tr>
            		<td class="center"><?php echo 'S0'.$servicio->id_servicio; ?></td>
                    <td class="center"><?php echo $servicio->servicio; ?></td>
            		<td class="center">
                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($servicio->precio * $dolar->bolivares,2,',','.').' BS';?>" >
                            <?php echo number_format($servicio->precio,2,',','.').' $';?>
                        </button>      
                    </td>
            		<td class="center">
                       <a href="<?php echo base_url('servicios/editar/').$servicio->id_servicio; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        <?php if($servicio->estado == "1"){ ?>
                            <a href="<?php echo base_url('servicios/estado/').$servicio->id_servicio; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Eliminar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('servicios/estado/').$servicio->id_servicio; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Restaurar">
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