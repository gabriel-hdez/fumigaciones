<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suministros extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		$config['js'] = array('datatables');
		$this->resources->initialize($config);

		$data = array(
			'btnAction'  => base_url('suministros/crear'), 
			'btnTooltip' => 'Crear suministro', 
			'btnIcon' 	 => 'add', 
			//'btnClass' 	 => 'modal-trigger', 
			//'btnAttr' 	 => 'data-target="modal"', 
		);
		// se consultan los suministraos
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'suministros', 
		 	'order'  => 'fecha DESC',
		 	'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'),
		 	'where'  => 'bitacora.id_tabla = suministros.id_suministro',  
		 	'return' => 'result', 
		);
		$data['suministros'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de suministros' => 'suministros' );
		$data['contenido'] = 'suministros/listado';
		$this->load->view('render', $data);
	}

	public function crear()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de suministros' => 'suministros', 'Nuevo suministro' => 'suministros/crear' );
		$data['contenido'] = 'suministros/crear';
		$this->load->view('render', $data);
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

			if ($this->form_validation->run('suministros') == TRUE) 
			{
				if ($existencia >= $minimo) 
				{
					$data['data'] = array(
		 				'suministro'    => $suministro, 
		 				'unidad'    	=> $unidad, 
		 				'existencia'    => $existencia, 
		 				'minimo'    	=> $minimo, 
		 				'costo'    		=> $costo, 
		 			);
		 			$data['table'] = 'suministros';

		 			if ($this->crud->create($data) == TRUE) 
		 			{
		 				$data = array(
							'select' => 'id_suministro, suministro', 
							'table'  => 'suministros', 
							'where'  => 'suministros.suministro = "'.$suministro.'"', 
							'return' => 'row'
						);
						$suministro = $this->crud->read($data);

						$data['data'] = array(
							'usuario'     => $_SESSION['login']['id'],
							'id_tabla'    => $suministro->id_suministro,
							'tabla'       => 'suministros', 
							'bitacora'    => 'Suministro creado', 
							'estado'      => '1', 
						);
						$data['table'] = 'bitacora';
						if ($this->crud->create($data) == TRUE) 
						{
							$json = array(
			            		'status'      => 'alert', 
			            		'info'        => '¡'.$suministro->suministro.', creado exitosamente!',  
			            		//'clearInputs'  => 'on',
			            		'redirect'  => base_url('suministros') 
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
			            	'info'        => 'Ops! Error al crear el suministro' 
			            );
			            echo json_encode($json);
		 			}
				} 
				else 
				{
					$json = array(
	            		'status'      => 'alert',  
	            		'info'        => 'El stock minimo no puede superar la cantidad existencial' 
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

	public function editar($id)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'suministros', 
			'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'), 
			'where'  => 'suministros.id_suministro = bitacora.id_tabla AND suministros.id_suministro='.$id, 
			'return' => 'row', 
		);
		$data['suministro'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de suministros' => 'suministros', 'Editar suministro' => 'suministros/editar/'.$id );
		$data['contenido'] = 'suministros/editar';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA CARGAR VISTA PARA EDITAR USUARIO
	public function estado($id)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'suministros', 
			'join'   => array('bitacora' => 'bitacora.tabla = "suministros"'), 
			'where'  => 'suministros.id_suministro = bitacora.id_tabla AND suministros.id_suministro='.$id, 
			'return' => 'row', 
		);
		$suministro = $data['suministro'] = $this->crud->read($data['data']);

		if ($suministro->estado == '1') 
		{
			$estado = 'Eliminar';
		} 
		else 
		{
			$estado = 'Restaurar';
		}
		
		$data['breadcrumbs'] = array('Listado de suministros' => 'suministros', $estado.' suministro' => 'suministros/editar/'.$id );
		$data['contenido'] = 'suministros/estado';
		$this->load->view('render', $data);
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			if ($token == 'estado') 
 			{
 				if ($estado == '1') 
 				{
 					$data = array(
	            		'table' => 'bitacora', 
	            		'where' => 'bitacora.tabla = "suministros" AND bitacora.id_tabla = '.$id, 
	            	);
	            	$data['set'] = array(
	            		'usuario'   => $_SESSION['login']['id'],
	            		'bitacora'  => 'Suministro eliminado',
	            		'estado'    => '0'
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
					{
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => 'Suministro eliminado exitosamente',  
		            		'redirect'  => base_url('suministros')
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
	            		'where' => 'bitacora.tabla = "suministros" AND bitacora.id_tabla = '.$id, 
	            	);
	            	$data['set'] = array(
	            		'usuario'   => $_SESSION['login']['id'],
	            		'bitacora'  => 'Suministro restaurado',
	            		'estado'    => '1'
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
					{
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => 'Suministro restaurado exitosamente',  
		            		'redirect'  => base_url('suministros')
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
 				if ($this->form_validation->run('suministros_editar') == TRUE) 
 				{
 					$data = array(
			    		'select' => '*', 
			    		'table'  => 'suministros', 
			    		'where'  => 'suministros.suministro ="'.$suministro.'" AND suministros.id_suministro <> "'.$id.'"',
			    		'return'  => 'check'
			    	);
			    	if ($this->crud->read($data) == TRUE) 
			    	{
			    		$json = array('suministro' => 'El suministro ya existe');
	            		echo json_encode($json);
			    	} 
			    	else 
			    	{
			    		$data = array(
		            		'table' => 'suministros', 
		            		'where' => 'suministros.id_suministro = '.$id, 
		            	);
		            	$data['set'] = array(
		            		'suministro'    => $suministro, 
			 				'unidad'    	=> $unidad, 
			 				'existencia'    => $existencia, 
			 				'minimo'    	=> $minimo, 
			 				'costo'    		=> $costo, 
		            	);
		            	if ($this->crud->edit($data) == TRUE) 
		            	{
		            		$data = array(
			            		'table' => 'bitacora', 
			            		'where' => 'bitacora.tabla = "suministros" AND bitacora.id_tabla = '.$id, 
			            	);
			            	$data['set'] = array(
			            		'usuario'   => $_SESSION['login']['id'],
			            		'bitacora'  => 'Suministro editado',
			            		//'estado'       => 1
			            	);
			            	if ($this->crud->edit($data) == TRUE) 
							{
								$json = array(
				            		'status' 	=> 'alert',
			            			'info'      => 'Suministro actualizado exitosamente',  
				            		'redirect'  => base_url('suministros')
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
			            		'info'        => 'Ops! Error al actualizar el suministro' 
			            	);
			            	echo json_encode($json);
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