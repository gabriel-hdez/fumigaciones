<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	$this->load->view('template/cabecera');
	
	// if (isset($navbar)) 
	// {
	// 	$this->load->view($navbar);
	// } 
	// else
	// {
	// 	$this->load->view('app/main/main');
	// }
	$this->load->view('template/menu');
	
	$this->load->view($contenido);
	
	$this->load->view('template/boton');
	$this->load->view('template/pie');
