<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicios extends CI_Controller {

	
	function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function getProductos_minstock(){
			$this->load->model('mensajes/minstock_model','prod');
			$result = $this->prod->get_produtomin();
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('aaData' => $result)));		
	}
}