<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cambio extends CI_Controller {

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
			'btnAction'  => base_url('cambio/crear'), 
			'btnTooltip' => 'Nueva tasa cambiaria', 
			'btnIcon' 	 => 'add', 
			//'btnClass' 	 => 'modal-trigger', 
			//'btnAttr' 	 => 'data-target="modal"', 
		);
		
		$data['count'] = 'dolares';
		$rango_max = $this->crud->count_max($data);
		if($rango_max >= 10)
		{
			$rango_min = $rango_max - 10;
			$data['rango'] = array( $rango_max => $rango_min);
		}
		else
		{
			$data['rango'] = array( 10 => 0);
		}

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar ASC',
		 	'limit'  => $data['rango'],
		 	'return' => 'result', 
		);
		$data['dolares'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	//'limit'  => array('10' => '0'),
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'result', 
		);
		$data['cambio'] = $this->crud->read($data['data']);

		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'dolares', 
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['today'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Administrar tasa cambiaria' => 'cambio' );
		$data['contenido'] = 'cambio/listado';
		$this->load->view('render', $data);
	}

	public function crear()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);
		$data['breadcrumbs'] = array('Administrar tasa cambiaria' => 'cambio', 'Nueva tasa cambiaria' => 'cambio/crear' );
		$data['contenido'] = 'cambio/crear';
		$this->load->view('render', $data);
	}

	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('bolivares') == TRUE) 
	 		{
		 		$data['data'] = array(
	 				'bolivares'    => $bolivares, 
	 			);
	 			$data['table'] = 'dolares';

	 			if ($this->crud->create($data) == TRUE) 
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => '¡Nueva tasa cambiaria creada exitosamente!',  
	            		'redirect'  => base_url('cambio') 
	            	);
	            	echo json_encode($json);
	 			} 
	 			else 
	 			{
	 				$json = array(
	            		'status'      => 'alert', 
	            		'info'        => 'Ops! Error al crear tasa cambiaria', 
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
			'where'  => 'dolares.id_dolar='.$id, 
			'return' => 'row', 
		);
		$data['dolar'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Administrar tasa cambiaria' => 'cambio', 'Editar tasa cambiaria' => 'cambio/editar/'.$id );
		$data['contenido'] = 'cambio/editar';
		$this->load->view('render', $data);
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			if ($this->form_validation->run('bolivares') == TRUE) 
 			{
 				$data = array(
	        		'table' => 'dolares', 
	        		'where' => 'dolares.id_dolar = '.$id, 
	        	);
	        	$data['set'] = array(
	        		'bolivares'   => $bolivares,
	        	);
	        	if ($this->crud->edit($data) == TRUE) 
	        	{
	        		$json = array(
	            		'status' 	=> 'alert',
	        			'info'      => 'Tasa cambiaria editada exitosamente',  
	            		'redirect'  => base_url('cambio')
	            	);
	            	echo json_encode($json);
	        	} 
	        	else 
	        	{
	        		$json = array(
	            		'status'      => 'alert',  
	            		'info'        => 'Ops! Error al actualizar la tasa cambiaria' 
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
}
