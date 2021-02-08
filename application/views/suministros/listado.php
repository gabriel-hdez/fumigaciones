<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height">
		
		<table class="display highlight" cellspacing="0" width="100%" id="suministros" >
			<thead>
            	<tr>
                	<th class="center">SUMINISTRO</th>
                	<th class="center">UNIDAD</th>
                    <th class="center">EXISTENCIA</th>
                	<th class="center">COSTO UNITARIO</th>
                    <th class="center">COSTO TOTAL</th>
                    <th class="center">ACCIONES</th>
              	</tr>
            </thead>
            <tbody>
                <?php foreach($suministros as $suministro): ?>
            	<tr>
                    <td class="center"><?php echo $suministro->suministro; ?></td>
                    <td class="center"><?php echo $suministro->unidad; ?></td>
                    <td class="center"><?php echo $suministro->existencia; ?></td>
                    <td class="center">
                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($suministro->costo * $dolar->bolivares,2,',','.').' BS';?>" >
                            <?php echo number_format($suministro->costo,2,',','.').' $';?>
                        </button>
                    </td>
                    <td class="center">
                        <?php $total = $suministro->existencia * $suministro->costo; ?>
                        <button class="btn-flat tooltipped" data-position="top" data-tooltip="<?php echo number_format($total * $dolar->bolivares,2,',','.').' BS';?>" >
                            <?php echo number_format($total ,2,',','.').' $';?>
                        </button>
                    </td>
                    <td class="center">
                        <a href="<?php echo base_url('suministros/editar/').$suministro->id_suministro; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        <?php if($suministro->estado == "1"){ ?>
                            <a href="<?php echo base_url('suministros/estado/').$suministro->id_suministro; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Eliminar">
                                <i class="material-icons">close</i>
                            </a>
                        <?php }else{ ?>
                            <a href="<?php echo base_url('suministros/estado/').$suministro->id_suministro; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Restaurar">
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