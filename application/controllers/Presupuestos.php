<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuestos extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
		$this->load->library('cart');
		$_SESSION['alert'] = NULL;
	}

	public function index()
	{
		$this->cart->destroy();
		$config['js'] = array('datatables');
		$this->resources->initialize($config);

		$data = array(
			'btnAction'  => base_url('presupuestos/crear'), 
			'btnTooltip' => 'Crear presupuesto', 
			'btnIcon' 	 => 'add', 
			//'btnClass' 	 => 'modal-trigger', 
			//'btnAttr' 	 => 'data-target="modal"', 
		);
		
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'presupuestos', 
		 	'join'   => array(
		 		'bitacora' => 'bitacora.tabla = "presupuestos"',
		 		'clientes' => 'clientes.id_cliente = presupuestos.id_cliente'
		 	),
		 	'where'  => 'bitacora.id_tabla = presupuestos.id_presupuesto',  
		 	'order'  => 'fecha DESC',
		 	'return' => 'result', 
		);
		$data['presupuestos'] = $this->crud->read($data['data']);

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

		$data['breadcrumbs'] = array('Listado de presupuestos' => 'presupuestos' );
		$data['contenido'] = 'presupuestos/listado';
		$this->load->view('render', $data);
	}

	public function buscar_cliente()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'clientes', 
		 	'where'  => 'clientes.cedula = "'.$buscar.'"',  
		 	'return' => 'row', 
		);
		$cliente = $this->crud->read($data['data']);

		if ($cliente != NULL) 
		{
			$json = array(
	    		'id_cliente'  => $cliente->id_cliente, 
	    		'correo'      => $cliente->correo, 
	    		'nombre'      => $cliente->nombre, 
	    		'apellido'    => $cliente->apellido, 
	    		'tlf'         => $cliente->tlf, 
	    		'alergias'    => $cliente->alergias, 
	    	);
		}
		else
		{
			$json = array(
	    		'id_cliente'  => '', 
	    		'correo'      => '', 
	    		'nombre'      => '', 
	    		'apellido'    => '', 
	    		'tlf'         => '', 
	    		'alergias'    => '', 
	    		'inexistente'  => 'Puedes registrar este cliente', 
	    	); 
		}

    	echo json_encode($json);

	}

	public function crear()
	{

		$config['js'] = array('forms','datatables','search');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		// se consultan los suministros
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'servicios', 
		 	'order'  => 'fecha DESC',
		 	'join'   => array('bitacora' => 'bitacora.tabla = "servicios"'),
		 	'where'  => 'bitacora.id_tabla = servicios.id_servicio AND bitacora.estado = "1"',  
		 	'return' => 'result', 
		);
		$data['servicios'] = $this->crud->read($data['data']);

		//$data['control'] = $this->crud->count_max('presupuestos');

		$data['breadcrumbs'] = array('Listado de presupuestos' => 'presupuestos', 'Nuevo presupuesto' => 'presupuestos/crear' );
		$data['contenido'] = 'presupuestos/crear';

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

 		
			if ($qty <= 0) 
			{
				$_SESSION['alert'] = 'valid_number';
	 		redirect('presupuestos/crear');
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
			 	redirect('presupuestos/editar/'.$id);
		 	}
		 	else
		 	{
			 	$_SESSION['alert'] = 'add';
			 	redirect('presupuestos/crear');
		 	}
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
		 	redirect('presupuestos/editar/'.$id);
	 	}else
	 	{
		 	$_SESSION['alert'] = 'remove';
		 	redirect('presupuestos/crear');
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
		 	redirect('presupuestos/editar/'.$id);
	 	}else
	 	{
		 	$_SESSION['alert'] = 'delete';
		 	redirect('presupuestos/crear');
	 	}
	}

	public function guardar()
	{
		$keys_post = array_keys($this->input->post());
 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

		$fecha_vencimiento = date("Y-m-d", strtotime($vencimiento));
		if ($this->form_validation->run('presupuestos') == TRUE) 
		{
			if ($this->cart->total_items() > 0) 
			{
				// se valida que la cedula sea unica pero igual a la existente
	 			$data = array(
		    		'select' => '*', 
		    		'table'  => 'clientes', 
		    		'where'  => 'clientes.cedula ="'.$cedula.'"',
		    		'return'  => 'check'
		    	);
				#	si cedula del cliente existe
				if ($this->crud->read($data) == TRUE)
				{
					#	se guarda presupuesto
					$data['data'] = array(
		 				'id_cliente'    => $id_cliente, 
		 				'vencimiento'   => $fecha_vencimiento, 
		 				'area'    		=> $area, 
		 				'direccion'  	=> $direccion, 
		 				'total'    		=> $total_presupuesto, 
		 				'estado'  		=> $estado
		 			);
		 			$data['table'] = 'presupuestos';
		 			if ($this->crud->create($data) == TRUE) 
		 			{
		 				$data = array(
							'select' => '*', 
							'table'  => 'presupuestos', 
							'where'  => 'presupuestos.id_cliente = "'.$id_cliente.'" AND presupuestos.vencimiento = "'.$fecha_vencimiento.'" AND presupuestos.total = "'.$total_presupuesto.'" AND presupuestos.direccion = "'.$direccion.'"', 
							'return' => 'row'
						);
						$presupuesto = $this->crud->read($data);

		 				$data['data'] = array(
							'usuario'     => $_SESSION['login']['id'], 
							'id_tabla'    => $presupuesto->id_presupuesto,
							'tabla'       => 'presupuestos', 
							'bitacora'    => 'Presupuesto creado', 
							'estado'      => '1', 
						);
						$data['table'] = 'bitacora';
						if ($this->crud->create($data) == TRUE) 
						{
							#	agregan servicios al presupuesto
							foreach ($this->cart->contents() as $items) 
							{
								$data['data'] = array(
					 				'id_servicios' 		=> $items['id'], 
					 				'id_presupuesto'  	=> $presupuesto->id_presupuesto, 
					 			);
					 			$data['table'] = 'pre_serv';
					 			$this->crud->create($data);
					 		}

							$json = array(
			            		'status'      => 'alert', 
			            		'info'        => 'Presupuesto creado exitosamente',  
			            		//'clearInputs'  => 'on',
			            		'redirect'  => base_url('presupuestos') 
			            	);
			            	echo json_encode($json);
						}
						else
						{
							$json = array(
			            		'status'      => 'alert',  
			            		'info'        => 'Ops! Error al registrar la bitácora' 
			            	);
			            	echo json_encode($json);
						}
		 			} 
		 			else 
		 			{
		 				$json = array(
			            	'status'      => 'alert',  
			            	'info'        => 'Ops! Error al crear el presupuesto' 
			            );
			            echo json_encode($json);
		 			}
				}
				#	si cedula del cliente NO existe
				else
				{
					$data = array(
			    		'select' => '*', 
			    		'table'  => 'clientes', 
			    		'where'  => 'clientes.correo ="'.$correo.'"',
			    		'return'  => 'check'
			    	);
					#	se valida correo del cliente
					if ($this->crud->read($data) == TRUE) 
					{
						#	si el correo del cliente existe
						$json = array('correo' => 'El correo electronico ya existe');
	            		echo json_encode($json);
					} 
					else 
					{
						#	si el correo del cliente NO existe, se guarda el cliente
						$data['data'] = array(
			 				'cedula'    => $cedula, 
			 				'nombre'    => $nombre, 
			 				'apellido'  => $apellido, 
			 				'correo'    => $correo, 
			 				'tlf'     	=> $tlf, 
			 				'alergias'  => $alergias
			 			);
			 			$data['table'] = 'clientes';

			 			if ($this->crud->create($data) == TRUE) 
			 			{
			 				$data = array(
								'select' => 'id_cliente, correo', 
								'table'  => 'clientes', 
								'where'  => 'clientes.correo = "'.$correo.'"', 
								'return' => 'row'
							);
							$cliente = $this->crud->read($data);

							$data['data'] = array(
								'usuario'     => $_SESSION['login']['id'], 
								'id_tabla'    => $cliente->id_cliente,
								'tabla'       => 'clientes', 
								'bitacora'    => 'Cliente creado', 
								'estado'      => '1', 
							);
							$data['table'] = 'bitacora';
							if ($this->crud->create($data) == TRUE) 
							{
								#	se guarda presupuesto
								$data['data'] = array(
					 				'id_cliente'    => $cliente->id_cliente, 
					 				'vencimiento'   => $fecha_vencimiento, 
					 				'area'    		=> $area, 
					 				'direccion'  	=> $direccion, 
					 				'total'    		=> $total_presupuesto, 
					 				'estado'  		=> $estado
					 			);
					 			$data['table'] = 'presupuestos';
					 			if ($this->crud->create($data) == TRUE) 
					 			{
					 				$data = array(
										'select' => '*', 
										'table'  => 'presupuestos', 
										'where'  => 'presupuestos.id_cliente = "'.$cliente->$id_cliente.'" AND presupuestos.vencimiento = "'.$fecha_vencimiento.'" AND presupuestos.total = "'.$total_presupuesto.'" AND presupuestos.direccion = "'.$direccion.'"', 
										'return' => 'row'
									);
									$presupuesto = $this->crud->read($data);

					 				$data['data'] = array(
										'usuario'     => $_SESSION['login']['id'], 
										'id_tabla'    => $presupuesto->id_presupuesto,
										'tabla'       => 'presupuestos', 
										'bitacora'    => 'Presupuesto creado', 
										'estado'      => '1', 
									);
									$data['table'] = 'bitacora';
									if ($this->crud->create($data) == TRUE) 
									{
										#	agregan servicios al presupuesto
										foreach ($this->cart->contents() as $items) 
										{
											$data['data'] = array(
								 				'id_servicios' 		=> $items['id'], 
								 				'id_presupuesto'   	=> $presupuesto->id_presupuesto, 
								 			);
								 			$data['table'] = 'pre_serv';
								 			$this->crud->create($data);
								 		}

										$json = array(
						            		'status'      => 'alert', 
						            		'info'        => 'Presupuesto creado exitosamente',  
						            		//'clearInputs'  => 'on',
						            		'redirect'  => base_url('presupuestos') 
						            	);
						            	echo json_encode($json);
									}
									else
									{
										$json = array(
						            		'status'      => 'alert',  
						            		'info'        => 'Ops! Error al registrar la bitácora' 
						            	);
						            	echo json_encode($json);
									}
					 			} 
					 			else 
					 			{
					 				$json = array(
						            	'status'      => 'alert',  
						            	'info'        => 'Ops! Error al crear el presupuesto' 
						            );
						            echo json_encode($json);
					 			}
								
							}
							else
							{
								$json = array(
				            		'status'      => 'alert',  
				            		'info'        => 'Ops! Error al registrar la bitácora' 
				            	);
				            	echo json_encode($json);
							}
			 			} 
			 			else 
			 			{
							$json = array(
				            	'status'      => 'alert',  
				            	'info'        => 'Ops! Error al crear el cliente' 
				            );
				            echo json_encode($json);
			 			}
					}
				}				
			} 
			else 
			{
				$json = array(
	        		'status'      => 'alert', 
	        		'info'        => 'Debe agregar algun servicio al presupuesto',
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
		$config['js'] = array('forms','datatables');
		$this->resources->initialize($config);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'servicios', 
			'join'   => array(
				'bitacora' => 'bitacora.tabla = "servicios"',
				'pre_serv' => 'pre_serv.id_presupuesto = '.$id,
			), 
			'where'  => 'pre_serv.id_servicios = servicios.id_servicio AND servicios.id_servicio = bitacora.id_tabla AND bitacora.estado = "1"', 
			'return' => 'result', 
		);
		$carrito = $data['carrito'] = $this->crud->read($data['data']);

		foreach ($carrito as $items) 
		{
			$data = array(
		        'id'      => $items->id_servicio,
		        'qty'     => 1,
		        'price'   => $items->precio,
		        'name'    => $items->servicio,
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
		
		// se consulta el presupuesto
		$data['data'] = array(
			'select' => '*', 
			'table'  => 'presupuestos', 
			'join'   => array('bitacora' => 'bitacora.tabla = "presupuestos"'), 
			'where'  => 'presupuestos.id_presupuesto = bitacora.id_tabla AND presupuestos.id_presupuesto ='.$id, 
			'return' => 'row', 
		);
		$presupuesto = $data['presupuesto'] = $this->crud->read($data['data']);

		if ($presupuesto->estado == '1') 
		{
			$estado = 'Eliminar';
		} 
		else 
		{
			$estado = 'Restaurar';
		}

		$data['breadcrumbs'] = array('Listado de presupuestos' => 'presupuestos', $estado.' presupuesto' => 'presupuestos/estado/'.$id );
		$data['contenido'] = 'presupuestos/estado';
		$this->load->view('render', $data);
		$this->cart->destroy();


	}

}