<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!-- 	SECTION		-->
	<section class="container height">

        <div class="row center">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4>TASA CAMBIARIA DOLAR</h4>
                        <div id="dolar"></div>             
                    </div>
                </div>
            </div>
        </div>
		
		<table class="display highlight" cellspacing="0" width="100%" id="usuarios" >
			<thead>
            	<tr>
                	<th class="center">FECHA</th>
                	<th class="center">PRECIO</th>
                	<th class="center">ACCIONES</th>
              	</tr>
            </thead>
            <tbody>
                <?php 
                	foreach ($cambio as $data):
                ?>
            	<tr>
            		<td class="center"><?php echo $data->fecha_dolar; ?></td>
            		<td class="center"><?php echo number_format($data->bolivares ,2,',','.').' Bs'?></td>
            		<td class="center">
                  <a href="<?php echo base_url('cambio/editar/').$data->id_dolar; ?>" class="center btn-floating waves-effect waves-light grey darken-2 tooltipped" data-position="top" data-tooltip="Editar">
                      <i class="material-icons">mode_edit</i>
                  </a>  
                </td>
            	</tr>
                <?php endforeach; ?>
            </tbody>
		</table>
		
	</section>
    <?php $this->load->view('template/datatables'); ?>

    <script type="text/javascript" src="<?php echo base_url('app/assets/js/main/highcharts.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/assets/js/main/highcharts-3d.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/assets/js/main/modules/export-data.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('app/assets/js/main/modules/exporting.js');?>"></script>
    
    <script>
     Highcharts.theme = {
      colors: ['#058DC7', '#dc3545', '#6f42c1', '#6AF9C4', '#64E572', '#DDDF00', '#24CBE5', 
               '#FF9655', '#FFF263', ],
      chart: { },
      title: {
          style: {
              color: '#000'
          }
      },
      subtitle: {
          style: {
              color: '#666666',
              font: 'bold 14px "Trebuchet MS", Verdana, sans-serif'
          }
      },
      
      yAxis: {
        title: false,
        labels: {
          style: {
              color: '#666666'
          }
        }
      },

      xAxis: {
        labels: {
          style: {
              color: '#666666'
          }
        }
      },

      plotOptions: {
        pie: {
          dataLabels: {
            color: 'black'
          }
        }
      },
  
      legend: {
          itemStyle: {
              font: '12pt Trebuchet MS, Verdana, sans-serif',
              color: 'black'
          },
          itemHoverStyle:{
              color: 'gray'
          }   
      },
      exporting: {
        buttons: {
          contextButton: {
            menuItems: [
              'printChart',
              // 'separator',
              // 'downloadPNG',
              // 'downloadJPEG',
              // 'downloadPDF',
              // 'downloadSVG',
              // 'separator',
              // 'downloadCSV',
              // 'downloadXLS',
              // 'viewData'
            ]
          }
        }
      },
  };
  Highcharts.setOptions(Highcharts.theme);
    </script>

    <?php $this->load->helper('date'); ?>

    <script type="text/javascript">
Highcharts.chart('dolar', {
    chart: {
        type: 'column'
    },
    title: {
        text: '1 Dolar = <?php echo number_format($today->bolivares ,2,',','.');?> Bolivares',
    },
    subtitle: {
        text: 'Historico de precios'
    },
    xAxis: {
        categories: [
            <?php foreach ($dolares as $dolar): ?>

                <?php echo nice_date($dolar->fecha_dolar, '" Y-m-d "').','; ?>
               
            <?php endforeach; ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 430,
        title: {
            text: 'Precio ( Bs )'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Bs</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Dolar',
        data: [

        <?php foreach ($dolares as $dolar): ?>

            <?php echo number_format($dolar->bolivares ,0,'','').', '; ?>
           
        <?php endforeach; ?>
       ]

    /*}, {
        name: 'New York',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

    }, {
        name: 'London',
        data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

    }, {
        name: 'Berlin',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]*/

    }]
});
        </script>