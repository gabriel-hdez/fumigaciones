<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($_SESSION['login']['check'] == FALSE) { redirect(base_url()); }
	}

	public function index()
	{
		$config['js'] = array('datatables');
		$this->resources->initialize($config);
		// se consultan los clientes
		$data['data'] = array(
		 	'select' => 'id_bitacora, bitacora, fecha, tabla, id_tabla, estado, usuario, id_usuario, nombre, apellido', 
		 	'table'  => 'bitacora', 
		 	'order'  => 'fecha DESC',
		 	'join'   => array('usuarios' => 'bitacora.usuario = usuarios.id_usuario'), 
		 	'return' => 'result', 
		);
		$data['bitacora'] = $this->crud->read($data['data']);

		$data['breadcrumbs'] = array('Bitacora' => 'bitacora' );
		$data['contenido'] = 'opciones/bitacora';
		$this->load->view('render', $data);
	}
}
