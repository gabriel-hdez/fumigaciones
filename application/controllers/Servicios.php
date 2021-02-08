<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
		$this->load->library('cart');
		//$this->load->library('pdf');
		$_SESSION['alert'] = NULL;
	}

	public function index()
	{
		$this->cart->destroy();
		$config['js'] = array('datatables');
		$this->resources->initialize($config);

		$data = array(
			'btnAction'  => base_url('servicios/crear'), 
			'btnTooltip' => 'Crear servicio', 
			'btnIcon' 	 => 'add', 
			//'btnClass' 	 => 'modal-trigger', 
			//'btnAttr' 	 => 'data-target="modal"', 
		);
		// se consultan los suministraos
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'servicios', 
		 	'order'  => 'fecha DESC',
		 	'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'),
		 	'where'  => 'bitacora.id_tabla = servicios.id_servicio',  
		 	'return' => 'result', 
		);
		$data['servicios'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		/*switch ( $_SESSION['alert'] ) 
		{
			case 'success':
				$data['alert'] ='Servicio creado exitosamente';
			break;
			default:
				//$data['alert'] ='Ha ocurrido un error';
			break;
		}*/

		$data['breadcrumbs'] = array('Listado de servicios' => 'servicios' );
		$data['contenido'] = 'servicios/listado';
		$this->load->view('render', $data);
	}

	public function crear()
	{

		$config['js'] = array('forms','datatables');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		// se consultan los suministraos
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'suministros', 
		 	'order'  => 'fecha DESC',
		 	'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'),
		 	'where'  => 'bitacora.id_tabla = suministros.id_suministro AND bitacora.estado = "1"',  
		 	'return' => 'result', 
		);
		$data['suministros'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de servicios' => 'servicios', 'Nuevo servicio' => 'servicios/crear' );
		$data['contenido'] = 'servicios/crear';

		switch ( $_SESSION['alert'] ) 
		{
			case 'add':
				$data['alert'] ='Item agregado exitosamente';
			break;
			case 'update':
				$data['alert'] ='Item actualizado exitosamente';
			break;
			case 'remove':
				$data['alert'] ='Item eliminado exitosamente';
			break;
			case 'delete':
				$data['alert'] ='Todos los items eliminados exitosamente';
			break;
			case 'valid_number':
				$data['alert'] ='Cantidad debe ser mayor que cero';
			break;
			case 'valid_stock':
				$data['alert'] ='Cantidad debe ser menor o igual a la existencial';
			break;
			default:
				//$data['alert'] ='Ha ocurrido un error';
			break;
		}

		$this->load->view('render', $data);
	}

	public function carrito_agregar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 		if ($existencia > $qty) 
 		{
 			if ($qty <= 0) 
 			{
 				$_SESSION['alert'] = 'valid_number';
		 		redirect('servicios/crear');
 			} 
 			else 
 			{
				$data = array(
			        'id'      => $id,
			        'qty'     => $qty,
			        'price'   => $price,
			        'name'    => $name,
			 	);
			 	$this->cart->insert($data);

			 	if($token == 'editar')
			 	{
			 		$_SESSION['alert'] = 'add';
				 	redirect('servicios/editar/'.$id);
			 	}else
			 	{
				 	$_SESSION['alert'] = 'add';
				 	redirect('servicios/crear');
			 	}
 			}
 		} 
 		else 
 		{
 			$_SESSION['alert'] = 'valid_stock';
		 	redirect('servicios/crear');
 		} 		
	}

	public function carrito_eliminar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
 		
		$data = array(
	        'rowid'   => $rowid,
	        'qty'     => 0,
	 	);
	 	$this->cart->update($data);

	 	if($token == 'editar')
	 	{
	 		$_SESSION['alert'] = 'remove';
		 	redirect('servicios/editar/'.$id);
	 	}else
	 	{
		 	$_SESSION['alert'] = 'remove';
		 	redirect('servicios/crear');
	 	}
	}

	public function carrito_destruir()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

		$this->cart->destroy();
	 	if($token == 'editar')
	 	{
	 		$_SESSION['alert'] = 'delete';
		 	redirect('servicios/editar/'.$id);
	 	}else
	 	{
		 	$_SESSION['alert'] = 'delete';
		 	redirect('servicios/crear');
	 	}
	}

	public function guardar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

		if ($this->form_validation->run('servicios') == TRUE) 
		{
			if ($this->cart->total_items() > 0) 
			{
				/*if ($this->cart->total() < $precio ) 
				{*/
					$data['data'] = array(
		 				'servicio'  => $servicio, 
		 				'precio'    => $precio, 
		 			);
		 			$data['table'] = 'servicios';

		 			if ($this->crud->create($data) == TRUE) 
		 			{
		 				$data = array(
							'select' => 'id_servicio, servicio', 
							'table'  => 'servicios', 
							'where'  => 'servicios.servicio = "'.$servicio.'"', 
							'return' => 'row'
						);
						$servicio = $this->crud->read($data);

						foreach ($this->cart->contents() as $items) 
						{
							$data['data'] = array(
				 				'id_servicio'  	=> $servicio->id_servicio, 
				 				'id_suministro' => $items['id'], 
				 				'requerido'    	=> $items['qty'], 
				 			);
				 			$data['table'] = 'serv_sum';
				 			$this->crud->create($data);
				 		}

		 				$data['data'] = array(
							'usuario'     => $_SESSION['login']['id'],
							'id_tabla'    => $servicio->id_servicio,
							'tabla'       => 'servicios', 
							'bitacora'    => 'Servicio creado', 
							'estado'      => '1', 
						);
						$data['table'] = 'bitacora';
						
						if ($this->crud->create($data) == TRUE) 
						{
							$this->cart->destroy();
			 				$json = array(
			            		'status'      => 'alert', 
			            		'info'        => 'Servicio creado existosamente',  
			            		'redirect'  => base_url('servicios') 
			            	);
			            	echo json_encode($json);
						} 
						else 
						{
							$json = array(
			            		'status'      => 'alert', 
			            		'info'        => 'Ha ocurrido un error al registrar la bitacora',  
			            	);
			            	echo json_encode($json);
						}				 
		 			} 
		 			else 
		 			{
		 				$json = array(
		            		'status'      => 'alert', 
		            		'info'        => 'Ha ocurrido un error al crear servicio',
		            	);
		            	echo json_encode($json);
		 			}
				/*} 
				else 
				{
					$json = array(
		        		'status'      => 'alert', 
		        		'info'        => 'El precio del servicio debe superar al costo total de suministros',
		        	);
		        	echo json_encode($json);
				}*/		 			
			} 
			else 
			{
				$json = array(
	        		'status'      => 'alert', 
	        		'info'        => 'Debe agregar algun suministro al servicio',
	        	);
	        	echo json_encode($json);
			}			
		} 
		else 
		{
			echo json_encode($this->form_validation->error_array());
		}
	}

	public function estado($id)
	{
		//$this->cart->destroy();
		$config['js'] = array('forms','datatables');
		$this->resources->initialize($config);
		// se consultan los suministros agregados al servicio
		// para previsualizar funciona... pero al agregar otro suministro duplica los existentes

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'suministros', 
			'join'   => array(
				'bitacora' => 'bitacora.tabla = "suministros"',
				'serv_sum' => 'serv_sum.id_servicio = '.$id,
			), 
			'where'  => 'serv_sum.id_suministro = suministros.id_suministro AND suministros.id_suministro = bitacora.id_tabla AND bitacora.estado = "1"', 
			'return' => 'result', 
		);
		$carrito = $data['carrito'] = $this->crud->read($data['data']);

		foreach ($carrito as $items) 
		{
			$data = array(
		        'id'      => $items->id_suministro,
		        'qty'     => $items->requerido,
		        'price'   => $items->costo,
		        'name'    => $items->suministro,
		 	);
		 	$this->cart->insert($data);
		}

		// se consulta el dolar
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);
		// se consulta el servicio
		$data['data'] = array(
			'select' => '*', 
			'table'  => 'servicios', 
			'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'), 
			'where'  => 'servicios.id_servicio = bitacora.id_tabla AND servicios.id_servicio ='.$id, 
			'return' => 'row', 
		);
		$data['servicio'] = $this->crud->read($data['data']);
		// se consultan los suministros
		/*$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'suministros', 
		 	'order'  => 'fecha DESC',
		 	'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'),
		 	'where'  => 'bitacora.id_tabla = suministros.id_suministro AND bitacora.estado = "1"',  
		 	'return' => 'result', 
		);
		$data['suministros'] = $this->crud->read($data['data']);*/
		$data['data'] = array(
			'select' => '*', 
			'table'  => 'servicios', 
			'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'), 
			'where'  => 'servicios.id_servicio = bitacora.id_tabla AND servicios.id_servicio='.$id, 
			'return' => 'row', 
		);
		$servicio = $data['servicio'] = $this->crud->read($data['data']);

		if ($servicio->estado == '1') 
		{
			$estado = 'Eliminar';
		} 
		else 
		{
			$estado = 'Restaurar';
		}

		$data['breadcrumbs'] = array('Listado de servicios' => 'servicios', $estado.' servicio' => 'servicios/estado/'.$id );
		$data['contenido'] = 'servicios/estado';
		$this->load->view('render', $data);
		$this->cart->destroy();
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			$data['data'] = array(
				'select' => '*', 
				'table'  => 'servicios', 
				'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'), 
				'where'  => 'servicios.id_servicio = bitacora.id_tabla AND servicios.id_servicio = "'.$id.'"', 
				'return' => 'row', 
			);
			$servicio = $data['servicio'] = $this->crud->read($data['data']);

			if ($servicio->estado == '1') 
			{
				$data = array(
            		'table' => 'bitacora', 
            		'where' => 'bitacora.tabla = "servicios" AND bitacora.id_tabla = '.$id, 
            	);
            	$data['set'] = array(
            		'usuario'   => $_SESSION['login']['id'],
            		'bitacora'  => 'Servicio eliminado',
            		'estado'    => '0'
            	);
            	if ($this->crud->edit($data) == TRUE) 
				{
					$json = array(
	            		'status' 	=> 'alert',
            			'info'      => 'Servicio eliminado exitosamente',  
	            		'redirect'  => base_url('servicios')
	            	);
	            	echo json_encode($json);
				} 
				else 
				{
					$json = array(
	            		'status'      => 'alert',  
	            		'info'        => 'Ops! Error al actualizar la bitácora' 
	            	);
	            	echo json_encode($json);
				}
			} 
			else 
			{
				$data = array(
            		'table' => 'bitacora', 
            		'where' => 'bitacora.tabla = "servicios" AND bitacora.id_tabla = '.$id, 
            	);
            	$data['set'] = array(
            		'usuario'   => $_SESSION['login']['id'],
            		'bitacora'  => 'Servicio restaurado',
            		'estado'    => '1'
            	);
            	if ($this->crud->edit($data) == TRUE) 
				{
					$json = array(
	            		'status' 	=> 'alert',
            			'info'      => 'Servicio restaurado exitosamente',  
	            		'redirect'  => base_url('servicios')
	            	);
	            	echo json_encode($json);
				} 
				else 
				{
					$json = array(
	            		'status'      => 'alert',  
	            		'info'        => 'Ops! Error al actualizar la bitácora' 
	            	);
	            	echo json_encode($json);
				}
			}
		} 
		else 
		{
			show_404();
		}
	}

	public function editar($id)
	{
		$this->cart->destroy();
		$config['js'] = array('forms','datatables');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'servicios', 
		 	//'order'  => 'fecha DESC',
		 	//'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'),
		 	'where'  => 'servicios.id_servicio = '.$id,  
		 	'return' => 'row', 
		);
		$data['servicio'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de servicios' => 'servicios', 'Nuevo servicio' => 'servicios/crear' );
		$data['contenido'] = 'servicios/editar';

		switch ( $_SESSION['alert'] ) 
		{
			case 'add':
				$data['alert'] ='Item agregado exitosamente';
			break;
			case 'update':
				$data['alert'] ='Item actualizado exitosamente';
			break;
			case 'remove':
				$data['alert'] ='Item eliminado exitosamente';
			break;
			case 'delete':
				$data['alert'] ='Todos los items eliminados exitosamente';
			break;
			case 'valid_number':
				$data['alert'] ='Cantidad debe ser mayor que cero';
			break;
			case 'valid_stock':
				$data['alert'] ='Cantidad debe ser menor o igual a la existencial';
			break;
			case 'error':
				$data['alert'] ='Ha ocurrido un error';
			break;
			default:
				//$data['alert'] ='Ha ocurrido un error';
			break;
		}

		$this->load->view('render', $data);
	}

	public function editar_carrito_eliminar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
 		
 		$data['data'] = array(
		 	'table'  => 'serv_sum', 
		 	'where'  => 'serv_sum.id_suministro = '.$id_suministro.' AND serv_sum.id_servicio = '.$id_servicio,   
		);
		
		if ($this->crud->erase($data['data']) == TRUE) 
		{
		 	$_SESSION['alert'] = 'remove';
		}
		else
		{
			$_SESSION['alert'] = 'error';
		}

		$data = array(
    		'table' => 'bitacora', 
    		'where' => 'bitacora.tabla = "servicios" AND bitacora.id_tabla = '.$id_servicio, 
    	);
    	$data['set'] = array(
    		'usuario'   => $_SESSION['login']['id'],
    		'bitacora'  => 'Servicio editado',
    	);
    	$this->crud->edit($data);

		redirect('servicios/editar/'.$id_servicio);
	}

	public function editar_carrito_agregar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 		if ($existencia > $qty) 
 		{
 			if ($qty <= 0) 
 			{
 				$_SESSION['alert'] = 'valid_number';
		 		redirect('servicios/editar/'.$id_servicio);
 			} 
 			else 
 			{
				// buscar si el suministro existe en el servicio
				$data = array(
		    		'select' => '*', 
		    		'table'  => 'serv_sum', 
		    		'where'  => 'serv_sum.id_suministro = '.$id_suministro.' AND serv_sum.id_servicio = '.$id_servicio,
		    		'return'  => 'check'
		    	);
				// editar en caso que exista
		    	if ($this->crud->read($data) == TRUE)
		    	{
		    		$data = array(
	            		'table'  => 'serv_sum', 
		    			'where'  => 'serv_sum.id_suministro = '.$id_suministro.' AND serv_sum.id_servicio = '.$id_servicio,
	            	);
	            	$data['set'] = array(
	            		'requerido' 	=> $qty,
	            	);
	            	$this->crud->edit($data);
		    	}
				// crear en caso que no exista
		    	else
		    	{
		    		$data['data'] = array(
		 				'id_servicio'  		=> $id_servicio, 
		 				'id_suministro'    	=> $id_suministro, 
		 				'requerido'  		=> $qty, 
		 			);
		 			$data['table'] = 'serv_sum';
		 			$this->crud->create($data);
		    	}

            	$data = array(
            		'table' => 'bitacora', 
            		'where' => 'bitacora.tabla = "servicios" AND bitacora.id_tabla = '.$id_servicio, 
            	);
            	$data['set'] = array(
            		'usuario'   => $_SESSION['login']['id'],
            		'bitacora'  => 'Servicio editado',
            	);
            	$this->crud->edit($data);

			 	$_SESSION['alert'] = 'add';
			 	redirect('servicios/editar/'.$id_servicio);
 			}
 		} 
 		else 
 		{
 			$_SESSION['alert'] = 'valid_stock';
		 	redirect('servicios/editar/'.$id_servicio);
 		} 		
	}

	public function editar_guardar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

		if ($this->form_validation->run('servicios_editar') == TRUE) 
		{
			if ($this->cart->total_items() > 0) 
			{
				/*if ($this->cart->total() < $precio ) 
				{*/
				$data = array(
		    		'select' => '*', 
		    		'table'  => 'servicios', 
		    		'where'  => 'servicios.servicio ="'.$servicio.'" AND servicios.id_servicio <> "'.$id_servicio.'"',
		    		'return'  => 'check'
		    	);
		    	if ($this->crud->read($data) == TRUE)
		    	{
		    		$json = array('servicio' => 'El servicio '.$servicio.' ya existe');
            		echo json_encode($json);
		    	}
		    	else
		    	{
		    		$data = array(
	            		'table' => 'servicios', 
	            		'where' => 'servicios.id_servicio = '.$id_servicio, 
	            	);
	            	$data['set'] = array(
	            		'servicio' 	=> $servicio,
	            		'precio' 	=> $precio,
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
	            	{
	            		// se actualiza la bitacora
	            		$data = array(
		            		'table' => 'bitacora', 
		            		'where' => 'bitacora.tabla = "servicios" AND bitacora.id_tabla = '.$id_servicio, 
		            	);
		            	$data['set'] = array(
		            		'usuario'   => $_SESSION['login']['id'],
		            		'bitacora'  => 'Servicio editado',
		            		//'estado'       => 1
		            	);
		            	if ($this->crud->edit($data) == TRUE) 
						{
							$json = array(
			            		'status' 	=> 'alert',
		            			'info'      => 'Servicio actualizado exitosamente',  
			            		'redirect'  => base_url('servicios')
			            	);
			            	echo json_encode($json);
						} 
						else 
						{
							$json = array(
			            		'status'      => 'alert',  
			            		'info'        => 'Ops! Error al actualizar la bitácora' 
			            	);
			            	echo json_encode($json);
						}	
	            	} 
	            	else 
	            	{
	            		$json = array(
		            		'status'      => 'alert',  
		            		'info'        => 'Ops! Error al actualizar el cliente' 
		            	);
		            	echo json_encode($json);
	            	}
		    	}	 			
			} 
			else 
			{
				$json = array(
	        		'status'      => 'alert', 
	        		'info'        => 'Debe agregar algun suministro al servicio',
	        	);
	        	echo json_encode($json);
			}			
		} 
		else 
		{
			echo json_encode($this->form_validation->error_array());
		}
	}

	public function detalle()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

		var_dump($_POST);
		die();
			
 		$data = array(
    		'select' => '*', 
    		'table'  => 'servicios', 
    		'join'   => array(
    			'serv_sum' => 'serv_sum.id_servicio = servicios.id_servicio',
    			'suministros' => 'serv_sum.id_suministro = suministros.id_suministro',
    			'bitacora' => 'bitacora.tabla = "suministros"'
    		), 
    		'where'  => 'servicios.id_servicio = "'.$detalle.'" AND bitacora.estado = 1',
    		'return'  => 'result'
    	);
		$servicio = $this->crud->read($data);


		echo json_encode($servicio);
	}

	public function reporte_listado_servicios()
	{
		// instancia libreria FPDF
		require_once APPPATH.'third_party/fpdf/fpdf.php';
		$pdf = new FPDF();

		// consultan los servicios
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'servicios', 
		 	'order'  => 'servicio ASC',
		 	'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'),
		 	'where'  => 'bitacora.id_tabla = servicios.id_servicio',  
		 	'return' => 'result', 
		);
		$servicios = $this->crud->read($data['data']);
		
        // membrete
		$pdf->AddPage('P','letter',0);
		$pdf->Image(base_url('app/assets/img/fumigacion/titulo.png') ,55,2,100,0,'PNG');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(350,-10,'RIF: V-08684384-2',0,1,'C');
    	$pdf->SetFont('Arial','I',8);
    	$pdf->Cell(10,10,'Pagina '.$pdf->PageNo(),0,1,'C');
    	$pdf->SetFont('Arial','',10);
    	$pdf->Ln();
    	$pdf->Cell(200,7,'Calle Bermudez C/C Negro Primero, Edificio Molino, Piso 4 Apto 46C',0,1,'C');
    	$pdf->Cell(200,7,'Conjunto Residencial Costa del Sol, Turmero, Estado Aragua',0,1,'C');
    	$pdf->SetFont('Arial','B',10);
    	$pdf->Cell(200,7,'CONFORMIDAD SANITARIA N D.S.A 278-F.D.C.I. ',0,1,'C');

    	// titulo
    	$pdf->SetFont('Arial','B',16);
    	$pdf->Ln();
    	$pdf->Cell(200,7,'Listado de Servicios',0,1,'C');
    	$pdf->Ln();
    	// cabecera
    	$pdf->SetFont('Arial','B',12);
    	$pdf->Cell(10,7,'#',1,0,'C');
    	$pdf->Cell(25,7,'CODIGO',1,0,'C');
    	$pdf->Cell(95,7,'SERVICIO',1,0,'C');
    	$pdf->Cell(50,7,'PRECIO',1,0,'C');
    	$pdf->Cell(20,7,'ESTADO',1,1,'C');
    	// contenido
    	$pdf->SetFont('Arial','',12);
    	$i=0;
    	foreach ($servicios as $servicio) 
    	{
    		if ($servicio->estado == 1) {
    			$estatus = 'Activo';
    		} else {
    			$estatus = 'Inactivo';
    		}    		

	    	$pdf->Cell(10,7, $i++ ,1,0,'C');
	    	$pdf->Cell(25,7, 'S0'.$servicio->id_servicio ,1,0,'C');
	    	$pdf->Cell(95,7, $servicio->servicio ,1,0,'C');
	    	$pdf->Cell(50,7, number_format($servicio->precio,2,',','.').' $' ,1,0,'C');
	    	$pdf->Cell(20,7, $estatus ,1,1,'C');
    	}

		$pdf->Output('reporte_listado_servicios.pdf' , 'I' );

	}

	public function reporte_detalles_servicio($id)
	{
		// instancia libreria FPDF
		require_once APPPATH.'third_party/fpdf/fpdf.php';
		$pdf = new FPDF();

		// consultan los servicios
		$data['servicio'] = array(
		 	'select' => '*', 
		 	'table'  => 'servicios', 
		 	//'order'  => 'servicio ASC',
		 	//'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'),
		 	'where'  => 'servicios.id_servicio = '.$id,  
		 	'return' => 'row', 
		);
		$servicio = $this->crud->read($data['servicio']);
		
        // membrete
		$pdf->AddPage('P','letter',0);
		$pdf->Image(base_url('app/assets/img/fumigacion/titulo.png') ,55,5,100,0,'PNG');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(350,-10,'RIF: J-00000000',0,1,'C');
    	$pdf->SetFont('Arial','I',8);
    	$pdf->Cell(10,10,'Pagina '.$pdf->PageNo(),0,1,'C');
    	// titulo
    	$pdf->SetFont('Arial','B',16);
    	$pdf->Ln();
    	$pdf->Ln();
    	$pdf->Cell(200,7,'Listado de Suministros',0,1,'C');
    	$pdf->Ln();
    	// cabecera
    	$pdf->SetFont('Arial','B',12);
    	$pdf->Cell(10,7,'#',1,0,'C');
    	$pdf->Cell(50,7,'SUMINISTRO',1,0,'C');
    	$pdf->Cell(20,7,'CANT',1,0,'C');
    	$pdf->Cell(50,7,'COSTO',1,0,'C');
    	$pdf->Cell(70,7,'SUBTOTAL',1,1,'C');
    	// contenido
    	$pdf->SetFont('Arial','',12);
    	/*$i=0;
    	foreach ($servicios as $servicio) 
    	{
    		if ($servicio->estado == 1) {
    			$estatus = 'Activo';
    		} else {
    			$estatus = 'Inactivo';
    		}    		

	    	$pdf->Cell(10,7, $i++ ,1,0,'C');
	    	$pdf->Cell(50,7, $servicio->servicio ,1,0,'C');
	    	$pdf->Cell(50,7, number_format($servicio->precio,2,',','.').' $' ,1,0,'C');
	    	$pdf->Cell(20,7, $estatus ,1,1,'C');
    	}*/

		$pdf->Output('reporte_detalles_servicio.pdf' , 'I' );

	}

}