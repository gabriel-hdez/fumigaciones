<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);
		$this->load->view('inicio/login');
	}

	//	INICIAR SESION
	public function login()
	{

		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

	 		if ($this->form_validation->run('login') == TRUE)
	        {
	        	$data = array('correo' => $correo);
	        	
        		$login = $this->crud->login($data);

        		if($login == TRUE)
        		{
	        		if ($clave == $this->encryption->decrypt($login->clave)) 
	        		{
	        			$_SESSION['login']['check']   = TRUE ;
	        			$_SESSION['login']['nivel']   = $login->nivel ;
	        			$_SESSION['login']['usuario'] = $login->nombre.' '.$login->apellido ;
	        			$_SESSION['login']['correo']  = $login->correo ;
	        			$_SESSION['login']['id']      = $login->id_usuario ;
	        			//$_SESSION['login']['avatar']  = $login->id_usuario ;
	        			$json = array(
				    		'status' 	=> 'alert',
				    		'info' 		=> 'Bienvenido '.$_SESSION['login']['nivel'].', '.$_SESSION['login']['usuario'],
				    		'redirect'  => base_url('inicio/bienvenido')
				    	);
				    	echo json_encode($json);
	        		} 
	        		else 
	        		{
	        			$json = array(
				    		'status' 	=> 'alert',
				    		'info' 		=> 'Verifique sus credenciales'
				    	);
				    	echo json_encode($json);
	        		}        	
        		}
        		else
        		{
        			$json = array(
			    		'status' 	=> 'alert',
			    		'info' 		=> 'Usuario deshabilitado, contacte un administrador'
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

	//	CARGA BIENVENIDA AL SISTEMA
	public function bienvenido()
	{
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
		 	//'limit'  => array('5' => '0'),
		 	'order'  => 'fecha_dolar DESC',
		 	'return' => 'row', 
		);
		$data['today'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array();
		$data['contenido'] = 'inicio/bienvenido';
		$this->load->view('render', $data);
	}

	//	CERRAR SESION
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());	
	}
}
