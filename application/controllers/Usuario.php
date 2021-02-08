<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE USUARIOS
	public function index()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);
		// se consultan los usuarios
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'usuarios', 
		 	'where'  => 'usuarios.id_usuario = '.$_SESSION['login']['id'], 
		 	'return' => 'row', 
		);
		$usuario = $data['usuario'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Editar mis datos' => 'usuario' );
		$data['contenido'] = 'usuario/editar';
		$this->load->view('render', $data);
	}

	public function actualizar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

			if ($this->form_validation->run('usuario') == TRUE) 
			{
	 			// se valida que la cedula sea unica pero igual a la existente
	 			$data = array(
		    		'select' => '*', 
		    		'table'  => 'usuarios', 
		    		'where'  => 'usuarios.cedula ="'.$cedula.'" AND usuarios.id_usuario <> "'.$_SESSION['login']['id'].'"',
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
			    		'table'  => 'usuarios', 
			    		'where'  => 'usuarios.correo ="'.$correo.'" AND usuarios.id_usuario <> "'.$_SESSION['login']['id'].'"',
			    		'return'  => 'check'
			    	);
		    		if ($this->crud->read($data) == TRUE)
			    	{
			    		$json = array('correo' => 'El correo electronico '.$correo.' ya existe');
	            		echo json_encode($json);
			    	}
			    	else 
			    	{
			    		// verifica contraseña actual
			    		$data['data'] = array(
							'select' => '*', 
							'table'  => 'usuarios', 
							'where'  => 'usuarios.id_usuario = '.$_SESSION['login']['id'], 
							'return' => 'row', 
						);
						$usuario = $data['usuario'] = $this->crud->read($data['data']);

			    		if ($verificar == $this->encryption->decrypt($usuario->clave) ) 
			    		{
			    			if ($clave == '') 
			    			{
					    		// se setean los datos para actualizar el usuario
				    			$data = array(
				            		'table' => 'usuarios', 
				            		'where' => 'usuarios.id_usuario = '.$_SESSION['login']['id'], 
				            	);
				            	$data['set'] = array(
				            		'nivel' 	=> $nivel,
				            		'nombre' 	=> $nombre,
				            		'apellido' 	=> $apellido,
				            		'cedula' 	=> $cedula,
				            		'correo' 	=> $correo,
				            		'pregunta'  => $this->encryption->encrypt($pregunta), 
				            		'respuesta'  => $this->encryption->encrypt($respuesta), 
				            	);
			    			} 
			    			else 
			    			{
				    			$data = array(
				            		'table' => 'usuarios', 
				            		'where' => 'usuarios.id_usuario = '.$_SESSION['login']['id'], 
				            	);
				            	$data['set'] = array(
				            		'nivel' 	=> $nivel,
				            		'nombre' 	=> $nombre,
				            		'apellido' 	=> $apellido,
				            		'cedula' 	=> $cedula,
				            		'correo' 	=> $correo,
				            		'pregunta'  => $this->encryption->encrypt($pregunta), 
				            		'respuesta'  => $this->encryption->encrypt($respuesta), 
			 						'clave' 	=> $this->encryption->encrypt($clave), 
				            	);
			    			}
			    			
			            	if ($this->crud->edit($data) == TRUE) 
			            	{
			            		// se actualiza la bitacora
			            		$data = array(
				            		'table' => 'bitacora', 
				            		'where' => 'bitacora.tabla = "usuarios" AND bitacora.id_tabla = '.$id, 
				            	);
				            	$data['set'] = array(
				            		'usuario'   => $_SESSION['login']['id'],
				            		'bitacora'  => 'Usuario editado',
				            		//'estado'       => 1
				            	);
				            	if ($this->crud->edit($data) == TRUE) 
								{
									$json = array(
					            		'status' 	=> 'alert',
				            			'info'      => 'Usuario actualizado exitosamente',  
				            			'msj'       => 'Reiniciando sesión para aplicar los cambios',  
					            		'redirect'  => base_url('inicio/logout')
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
				            		'info'        => 'Ops! Error al actualizar el usuario' 
				            	);
				            	echo json_encode($json);
			            	}
			    		} 
			    		else 
			    		{
			    			$json = array('verificar' => 'Contraseña incorrecta');
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
		else 
		{
			show_404();
		}		
	}
	
}
