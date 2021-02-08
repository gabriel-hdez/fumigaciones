<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recuperar extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE USUARIOS
	public function index()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);
		$this->load->view('inicio/buscar');
	}

	public function buscar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			if ($this->form_validation->run('recuperar') == TRUE) 
 			{
 				$data['data'] = array(
					'select' => '*', 
					'table'  => 'usuarios', 
					'join'   => array('bitacora' => 'bitacora.tabla = "usuarios"'),
					'where'  => 'bitacora.id_tabla = usuarios.id_usuario AND usuarios.correo = "'.$correo.'"', 
					'return' => 'row', 
				);
				$usuario = $data['usuario'] = $this->crud->read($data['data']);

				if ($usuario != NULL) 
				{
					if ($usuario->estado == '1') 
					{
						$_SESSION['recuperar'] = $usuario->id_usuario;
						
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => '¡'.$usuario->nombre.' '.$usuario->apellido.' confirmanos que eres tu!',   
		            		'redirect'  => base_url('recuperar/confirmar')
		            	);
		            	echo json_encode($json);
					} 
					else 
					{
						$json = array('correo' => 'Usuario bloqueado, contacte un administrador del sistema');
            			echo json_encode($json);
					}
				} 
				else 
				{
					$json = array('correo' => 'Correo electronico disponible');
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

	public function confirmar()
	{
		if (isset($_SESSION['recuperar']) ) 
		{
			$config['js'] = array('forms');
			$this->resources->initialize($config);

			$data['data'] = array(
				'select' => '*', 
				'table'  => 'usuarios',
				'where'  => 'usuarios.id_usuario = "'.$_SESSION['recuperar'].'"', 
				'return' => 'row', 
			);
			$data['usuario'] = $this->crud->read($data['data']);

			$this->load->view('inicio/confirmar', $data);
		} 
		else 
		{
			redirect(base_url()); 
		}
		
	}

	public function verificar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			if ($this->form_validation->run('confirmar') == TRUE) 
 			{
 				$data['data'] = array(
					'select' => '*', 
					'table'  => 'usuarios',
					'where'  => 'usuarios.id_usuario = "'.$_SESSION['recuperar'].'"', 
					'return' => 'row', 
				);
				$usuario = $data['usuario'] = $this->crud->read($data['data']);

				if ($respuesta == $this->encryption->decrypt($usuario->respuesta)) 
				{		
					$_SESSION['verificar'] = TRUE;											
					$json = array(
	            		'status' 	=> 'alert',
            			'info'      => $usuario->nombre.' '.$usuario->apellido.' ya puedes cambiar tu contraseña',   
	            		'redirect'  => base_url('recuperar/clave')
	            	);
	            	echo json_encode($json);
				} 
				else 
				{
					$json = array('respuesta' => 'Verifique su respuesta');
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

	public function clave()
	{
		if (isset($_SESSION['recuperar']) && $_SESSION['verificar'] == TRUE) 
		{
			$config['js'] = array('forms');
			$this->resources->initialize($config);
			$this->load->view('inicio/clave');
		} 
		else 
		{
			redirect(base_url('recuperar/confirmar')); 
		}	
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			if ($this->form_validation->run('clave') == TRUE) 
 			{
 				$data = array(
            		'table' => 'usuarios', 
            		'where' => 'usuarios.id_usuario = '.$_SESSION['recuperar'], 
            	);
            	$data['set'] = array(
					'clave' => $this->encryption->encrypt($clave), 
            	);

            	if ($this->crud->edit($data) == TRUE) 
            	{
            		$json = array(
	            		'status' 	=> 'alert',
            			'info'      => 'Contraseña actualizada exitosamente',  
            			'msj'       => 'Ya puedes iniciar sesión',  
	            		'redirect'  => base_url('inicio/logout')
	            	);
	            	echo json_encode($json);
            	} 
            	else 
            	{
            		$json = array(
	            		'status' 	=> 'alert',
            			'info'      => 'Ops! Error al actualizar tus datos', 
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
