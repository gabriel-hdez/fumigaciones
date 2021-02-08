<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	//	FUNCION PADRE CONSTRUCTURA, CARGA GLOBAL DE LIBRERIAS EN TODAS LAS FUNCIONES
	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	//	FUNCION POR DEFECTO, CARGA LISTADO DE USUARIOS
	public function index()
	{
		$config['js'] = array('datatables');
		$this->resources->initialize($config);

		$data = array(
			'btnAction'  => base_url('usuarios/crear'), 
			'btnTooltip' => 'Crear usuario', 
			'btnIcon' 	 => 'add', 
			//'btnClass' 	 => 'modal-trigger', 
			//'btnAttr' 	 => 'data-target="modal"', 
		);

		// se consultan los usuarios
		$data['data'] = array(
		 	'select' => '*', 
		 	'table'  => 'usuarios', 
		 	'join'   => array('bitacora' => 'bitacora.tabla = "usuarios"'), 
		 	'where'  => 'usuarios.id_usuario = bitacora.id_tabla', 
		 	'order'  => 'fecha DESC',
		 	'return' => 'result', 
		);
		$data['usuarios'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de usuarios' => 'usuarios' );
		$data['contenido'] = 'usuarios/listado';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA CARGAR VISTA DE CREACION DE USUARIO
	public function crear()
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['breadcrumbs'] = array('Listado de usuarios' => 'usuarios', 'Nuevo usuario' => 'usuarios/crear' );
		$data['contenido'] = 'usuarios/crear';
		$this->load->view('render', $data);
	}

	//	FUNCION LOGICA PARA CREAR USUARIO
	public function guardar()
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
	 		foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }
	 		
	 		// VALIDA DATOS DEL USUARIO
	 		if ($this->form_validation->run('usuarios') == TRUE) 
	 		{
	 			$data['data'] = array(
	 				'nivel'    	=> $nivel, 
	 				'nombre'    => $nombre, 
	 				'apellido'  => $apellido, 
	 				'correo'    => $correo, 
	 				'cedula'    => $cedula, 
	 				'clave'     => $this->encryption->encrypt($cedula), 
	 				'pregunta'  => $this->encryption->encrypt($pregunta), 
	 				'respuesta' => $this->encryption->encrypt($respuesta), 
	 			);
	 			$data['table'] = 'usuarios';

	 			if ($this->crud->create($data) == TRUE) 
	 			{
	 				$data = array(
						'select' => 'id_usuario, correo', 
						'table'  => 'usuarios', 
						'where'  => 'usuarios.correo = "'.$correo.'"', 
						'return' => 'row'
					);
					$usuario = $this->crud->read($data);

					$data['data'] = array(
						'usuario'     => $_SESSION['login']['id'],
						'id_tabla'    => $usuario->id_usuario,
						'tabla'       => 'usuarios', 
						'bitacora'    => 'Usuario creado', 
						'estado'      => '1', 
					);
					$data['table'] = 'bitacora';
					if ($this->crud->create($data) == TRUE) 
					{
						$json = array(
		            		'status'      => 'alert', 
		            		'info'        => '¡Usuario '.$nombre.' '.$apellido.', creado exitosamente!',  
		            		//'clearInputs'  => 'on',
		            		'redirect'  => base_url('usuarios') 
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
		            	'info'        => 'Ops! Error al crear el usuario' 
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

	//	FUNCION PARA CARGAR VISTA PARA EDITAR USUARIO
	public function editar($cedula)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'usuarios', 
			'join'   => array('bitacora' => 'bitacora.tabla = "usuarios"'), 
			'where'  => 'usuarios.id_usuario = bitacora.id_tabla AND usuarios.cedula='.$cedula, 
			'return' => 'row', 
		);
		$data['usuario'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Listado de usuarios' => 'usuarios', 'Editar usuario' => 'usuarios/editar/'.$cedula );
		$data['contenido'] = 'usuarios/editar';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA CARGAR VISTA PARA EDITAR USUARIO
	public function estado($cedula)
	{
		$config['js'] = array('forms');
		$this->resources->initialize($config);

		$data['data'] = array(
			'select' => '*', 
			'table'  => 'usuarios', 
			'join'   => array('bitacora' => 'bitacora.tabla = "usuarios"'), 
			'where'  => 'usuarios.id_usuario = bitacora.id_tabla AND usuarios.cedula='.$cedula, 
			'return' => 'row', 
		);
		$usuario = $data['usuario'] = $this->crud->read($data['data']);

		if ($usuario->estado == '1') 
		{
			$estado = 'Eliminar';
		} 
		else 
		{
			$estado = 'Restaurar';
		}
		
		$data['breadcrumbs'] = array('Listado de usuarios' => 'usuarios', $estado.' usuario' => 'usuarios/editar/'.$cedula );
		$data['contenido'] = 'usuarios/estado';
		$this->load->view('render', $data);
	}

	//	FUNCION PARA ACTUALIZAR, ELIMINAR O RESTAURAR DATOS DEL USUARIO
	public function actualizar($cedula)
	{
		if ($this->input->is_ajax_request()) 
		{
			$keys_post = array_keys($this->input->post());
 			foreach ($keys_post as $key_post){ $$key_post = $this->input->post()[$key_post]; }

 			// verifica token para saber si se va a editar, eliminar o restaurar un usuario...
 			// si el token es estado
 			if ($token == 'estado') 
 			{
 				// si el estado del usuario es 1, esta activo, se debe eliminar
 				if ($estado == '1') {
	 				$data = array(
	            		'table' => 'bitacora', 
	            		'where' => 'bitacora.tabla = "usuarios" AND bitacora.id_tabla = '.$id, 
	            	);
	            	$data['set'] = array(
	            		'usuario'   => $_SESSION['login']['id'],
	            		'bitacora'  => 'Usuario eliminado',
	            		'estado'    => '0'
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
					{
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => 'Usuario eliminado exitosamente',  
		            		'redirect'  => base_url('usuarios')
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
 				// sino el estado del usuario es 0, esta inactivo, se debe restaurar
 				else 
 				{
 					$data = array(
	            		'table' => 'bitacora', 
	            		'where' => 'bitacora.tabla = "usuarios" AND bitacora.id_tabla = '.$id, 
	            	);
	            	$data['set'] = array(
	            		'usuario'   => $_SESSION['login']['id'],
	            		'bitacora'  => 'Usuario restaurado',
	            		'estado'    => '1'
	            	);
	            	if ($this->crud->edit($data) == TRUE) 
					{
						$json = array(
		            		'status' 	=> 'alert',
	            			'info'      => 'Usuario restaurado exitosamente',  
		            		'redirect'  => base_url('usuarios')
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
				if ($this->form_validation->run('usuarios_editar') == TRUE) 
				{
		 			// se valida que la cedula sea unica pero igual a la existente
		 			$data = array(
			    		'select' => '*', 
			    		'table'  => 'usuarios', 
			    		'where'  => 'usuarios.cedula ="'.$cedula.'" AND usuarios.id_usuario <> "'.$id.'"',
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
				    		'where'  => 'usuarios.correo ="'.$correo.'" AND usuarios.id_usuario <> "'.$id.'"',
				    		'return'  => 'check'
				    	);
			    		if ($this->crud->read($data) == TRUE)
				    	{
				    		$json = array('correo' => 'El correo electronico '.$correo.' ya existe');
		            		echo json_encode($json);
				    	}
				    	else 
				    	{
				    		// se setean los datos para actualizar el usuario
			    			$data = array(
			            		'table' => 'usuarios', 
			            		'where' => 'usuarios.id_usuario = '.$id, 
			            	);
			            	$data['set'] = array(
			            		'nivel' 	=> $nivel,
			            		'nombre' 	=> $nombre,
			            		'apellido' 	=> $apellido,
			            		'cedula' 	=> $cedula,
			            		'correo' 	=> $correo,
			            		'pregunta'  => $this->encryption->encrypt($pregunta), 
		 						'respuesta' => $this->encryption->encrypt($respuesta), 
			            	);
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
					            		'redirect'  => base_url('usuarios')
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
