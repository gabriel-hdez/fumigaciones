<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE clienteS
	public function index()
	{
		$config['js'] = array('datatables');
		$this->resources->initialize($config);

		$data = array(
			'btnAction'  => base_url('clientes/crear'), 
			'btnTooltip' => 'Crear cliente', 
			'btnIcon' 	 => 'add', 
			//'btnClass' 	 => 'modal-trigger', 
			//'btnAttr' 	 => 'data-target="modal"', 
		);

		// se consultan los clientes
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'clientes', 
		 	'join'   => array('bitacora' => 'bitacora.tabla = "clientes"'), 
		 	'where'  => 'clientes.id_cliente = bitacora.id_tabla', 
		 	'order'  => 'fecha DESC',
		 	'return' => 'result', 
		);
		$data['clientes'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de clientes' => 'clientes' );
		$data['contenido'] = 'clientes/listado';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA CARGAR VISTA DE CREACION DE cliente
	public function crear()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['breadcrumbs'] = array('Listado de clientes' => 'clientes', 'Nuevo cliente' => 'clientes/crear' );
		$data['contenido'] = 'clientes/crear';
		$this->load->view('render', $data);
	}

	//	FUNCION LOGICA PARA CREAR cliente
	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		// VALIDA DATOS DEL cliente
	 		if ($this->form_validation->run('clientes') == TRUE) 
	 		{
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
						$json = array(
		            		'status'      => 'alert', 
		            		'info'        => 'Cliente '.$nombre.' '.$apellido.', creado exitosamente',  
		            		//'clearInputs'  => 'on',
		            		'redirect'  => base_url('clientes') 
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
		            	'info'        => 'Ops! Error al crear el cliente' 
		            );
		            echo json_encode($json);
	 			}
	 		} 
	 		else 
	 		{
	 			echo json_encode($this->form_validation->error_array());
	 		}
		} 
		else 
		{
			show_404();
		}
	}

	//	FUNCION PARA CARGAR VISTA PARA EDITAR cliente
	public function editar($cedula)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'clientes', 
			'join'   => array('bitacora' => 'bitacora.tabla = "clientes"'), 
			'where'  => 'clientes.id_cliente = bitacora.id_tabla AND clientes.cedula='.$cedula, 
			'return' => 'row', 
		);
		$data['cliente'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de clientes' => 'clientes', 'Editar cliente' => 'clientes/editar/'.$cedula );
		$data['contenido'] = 'clientes/editar';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA CARGAR VISTA PARA EDITAR cliente
	public function estado($cedula)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'clientes', 
			'join'   => array('bitacora' => 'bitacora.tabla = "clientes"'), 
			'where'  => 'clientes.id_cliente = bitacora.id_tabla AND clientes.cedula='.$cedula, 
			'return' => 'row', 
		);
		$cliente = $data['cliente'] = $this->crud->read($data['data']);

		if ($cliente->estado == '1') 
		{
			$estado = 'Eliminar';
		} 
		else 
		{
			$estado = 'Restaurar';
		}		

		$data['breadcrumbs'] = array('Listado de clientes' => 'clientes', $estado.' cliente' => 'clientes/editar/'.$cedula );
		$data['contenido'] = 'clientes/estado';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA ACTUALIZAR, ELIMINAR O RESTAURAR DATOS DEL cliente
	public function actualizar($cedula)
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			// verifica token para saber si se va a editar, eliminar o restaurar un cliente...
 			// si el token es estado
 			if ($token == 'estado') 
 			{
 				// si el estado del cliente es 1, esta activo, se debe eliminar
 				if ($estado == '1') {
	 				$data = array(
	            		'table' => 'bitacora', 
	            		'where' => 'bitacora.tabla = "clientes" AND bitacora.id_tabla = '.$id, 
	            	);
	            	$data['set'] = array(
	            		'usuario'   => $_SESSION['login']['id'],
	            		'bitacora'  => 'Cliente eliminado',
	            		'estado'    => '0'
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
					{
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => 'Cliente eliminado exitosamente',  
		            		'redirect'  => base_url('clientes')
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
 				// sino el estado del cliente es 0, esta inactivo, se debe restaurar
 				else 
 				{
 					$data = array(
	            		'table' => 'bitacora', 
	            		'where' => 'bitacora.tabla = "clientes" AND bitacora.id_tabla = '.$id, 
	            	);
	            	$data['set'] = array(
	            		'usuario'   => $_SESSION['login']['id'],
	            		'bitacora'  => 'Cliente restaurado',
	            		'estado'    => '1'
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
					{
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => 'Cliente restaurado exitosamente',  
		            		'redirect'  => base_url('clientes')
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
 			// sino el token es editar
 			else 
 			{
				if ($this->form_validation->run('clientes_editar') == TRUE) 
				{
		 			// se valida que la cedula sea unica pero igual a la existente
		 			$data = array(
			    		'select' => '*', 
			    		'table'  => 'clientes', 
			    		'where'  => 'clientes.cedula ="'.$cedula.'" AND clientes.id_cliente <> "'.$id.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE)
			    	{
			    		$json = array('cedula' => 'La cedula '.$cedula.' ya existe');
	            		echo json_encode($json);
			    	}
			    	else
			    	{
			    		// se valida que el correo sea unico pero igual a la existente
			    		$data = array(
				    		'select' => '*', 
				    		'table'  => 'clientes', 
				    		'where'  => 'clientes.correo ="'.$correo.'" AND clientes.id_cliente <> "'.$id.'"',
				    		'return'  => 'check'
				    	);
			    		if ($this->crud->read($data) == TRUE)
				    	{
				    		$json = array('correo' => 'El correo electronico '.$correo.' ya existe');
		            		echo json_encode($json);
				    	}
				    	else 
				    	{
				    		// se setean los datos para actualizar el cliente
			    			$data = array(
			            		'table' => 'clientes', 
			            		'where' => 'clientes.id_cliente = '.$id, 
			            	);
			            	$data['set'] = array(
			            		'nombre' 	=> $nombre,
			            		'apellido' 	=> $apellido,
			            		'cedula' 	=> $cedula,
			            		'correo' 	=> $correo,
			            		'tlf' 		=> $tlf,
			            		'alergias' 	=> $alergias, 
			            	);
			            	if ($this->crud->edit($data) == TRUE) 
			            	{
			            		// se actualiza la bitacora
			            		$data = array(
				            		'table' => 'bitacora', 
				            		'where' => 'bitacora.tabla = "clientes" AND bitacora.id_tabla = '.$id, 
				            	);
				            	$data['set'] = array(
				            		'usuario'   => $_SESSION['login']['id'],
				            		'bitacora'  => 'cliente editado',
				            		//'estado'       => 1
				            	);
				            	if ($this->crud->edit($data) == TRUE) 
								{
									$json = array(
					            		'status' 	=> 'alert',
				            			'info'      => 'Cliente actualizado exitosamente',  
					            		'redirect'  => base_url('clientes')
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
				} 
				else 
				{
					echo json_encode($this->form_validation->error_array());
				}
 			}
		} 
		else 
		{
			show_404();
		}
		
	}

	
}
