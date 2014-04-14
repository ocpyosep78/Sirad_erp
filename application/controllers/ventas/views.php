<?php 
if ( ! defined('BASEPATH')) exit('No se permite acceso directo al script');
/**
* Controler HomePages
*/
class views extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if ($this->ion_auth->logged_in())
		{
			if(!$this->ion_auth->selected_local())
				redirect('auth/select_local', 'refresh');
		}
		else
			redirect('login', 'refresh');
	}

	public function index()
	{
		if($this->ion_auth->in_group_type(1))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Home Pages';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/homepages.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/homepages.js';
			$datafooter['active'] = '';
			$datafooter['dropactive'] = '';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/', 'refresh');
	}


	//Clientes

	public function clientes()
	{
		if($this->ion_auth->in_group("ven_client"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Ventas';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/clientes.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/clientes.js';
			$datafooter['active'] = 'clientes';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	}

	//Cronograna

	public function cronogramas()
	{
		if($this->ion_auth->in_group("ven_crono"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Ventas';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/cronogramas.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/cronograma.js';
			$datafooter['active'] = 'cron_pago';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	}

	public function cronogramas_detalle($nCliente_id)
	{
		if($this->ion_auth->in_group("ven_crono"))
		{
			$this->load->model('ventas/clientes_model','cli');
			$this->load->model('administracion/trabajadores_model','tra');						
			$dataheader['title'] = 'Ventas';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$pagedata = $this->cli->get_clientes($nCliente_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/cronogramas_detalle.php',$pagedata);
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/cronogramas_detalle.js';
			$datafooter['active'] = 'cron_pago';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	}
    //Reporte Zona
	public function reporte_zonas()
	{
		if($this->ion_auth->in_group("ven_rep_clienzon"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Reporte Zonas';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/reporte_zonas.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/reporte_zonas.js';
			$datafooter['active'] = 'clienteszonas_rep';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	}

	public function tarjetascreditos()
	{
		if($this->ion_auth->in_group("ven_tarj_cred"))
		{	
			$this->load->model('administracion/trabajadores_model','tra');			
			$dataheader['title'] = 'Tarjetas de Creditos';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$pagedata["local"] = $this->session->userdata('current_local');
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/tarjetascreditos.php',$pagedata);
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/tarjetascreditos.js';
			$datafooter['active'] = 'tarj_cred';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	}

    
	// Todo de Ventas
	public function cons_ventas()
	{
		if($this->ion_auth->in_group("ven_ven_prod"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
	      	$dataheader['title'] = 'Ventas';	      	
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/ventas.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/consultar.js';
			$datafooter['active'] = 'venta_prod';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	} 

	public function editar_ventas($nVenta_id)
	{
		if($this->ion_auth->in_group("ven_ven_prod"))
		{
			$this->load->model('ventas/venta_model','venm');
			$this->load->model('administracion/trabajadores_model','tra');
			$this->load->model('ventas/detalleventa_model','detvenm');
			$dataheader['title'] = 'Ventas -(editar)';	      	
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$pagedata["venta"] = $this->venm->get_venta($nVenta_id);
			$pagedata["dettale"] = $this->detvenm->get_detalles($nVenta_id);	      	
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/editar_ventas.php',$pagedata);
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/editar_ventas.js';
			$datafooter['active'] = 'venta_prod';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	} 
	
	public function registrar_ventas()
	{
		if($this->ion_auth->in_group("ven_ven_prod"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$this->load->model('ventas/clientes_model','cli');
			$dataheader['title'] = 'Ventas -(registrar)';
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);			
			$pagedata["clianonimo"] = $this->cli->get_anonimo();
			$pagedata["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$pagedata["local"] = $this->session->userdata('current_local');	      	
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/reg_ventas.php',$pagedata);
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/reg_ventas.js';
			$datafooter['active'] = 'venta_prod';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	} 

	public function ver_ventas($nVenta_id)
	{
		if($this->ion_auth->in_group("ven_ven_prod"))
		{
			$this->load->model('ventas/venta_model','venm');
			$this->load->model('administracion/trabajadores_model','tra');
			$this->load->model('ventas/detalleventa_model','detvenm');
			$dataheader['title'] = 'Ventas -(registrar)';
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);			
			$pagedata["venta"] = $this->venm->get_venta($nVenta_id);
			$pagedata["dettale"] = $this->detvenm->get_detalles($nVenta_id);	      	
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/ver_ventas.php',$pagedata);
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/ver_ventas.js';
			$datafooter['active'] = 'venta_prod';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	} 


	public function reporte_ventas()
	{
		if($this->ion_auth->in_group("ven_ven_prod"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
	      	$dataheader['title'] = 'Ventas';	      	
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);	
			$this->load->view('templates/headers.php',$dataheader);
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/reporte_ventas.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/reporte_ventas.js';
			$datafooter['active'] ='ventas_rep';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	} 

	/*******************MOVIMIENTOS*******************/
	public function movimientos()
	{
		if($this->ion_auth->in_group("ven_movi"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Movimientos';
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);			
			$pagedata["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$pagedata["local"] = $this->session->userdata('current_local');
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/movimientos.php',$pagedata);
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/movimientos.js';
			$datafooter['active'] = 'movimientos';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');

	}
	/****************CLIENTES MOROSOS**************************/
	public function clientes_morosos()
	{		
		$this->load->model('administracion/trabajadores_model','tra');
		$dataheader['title'] = 'Clientes-Morosos';		
		$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
		$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
		$this->load->view('templates/headers.php',$dataheader);		
		$this->load->view('templates/menu.php',$data);
		$this->load->view('ventas/clientesmorosos.php');
		$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/clientesmorosos.js';
		$datafooter['active'] = '';
		$datafooter['dropactive'] = 'dropventas';
		$this->load->view('templates/footer.php',$datafooter);
		
	}		
	
	public function reporte_ing_egr()
	{
		if($this->ion_auth->in_group("ven_rep_ing_egr"))
		{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Reporte Ingreso/Egreso';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/reporte_ing_egr.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/reporte_ing_egr.js';
			$datafooter['active'] = 'ingrEgre_rep';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		}
		else
			redirect('/ventas', 'refresh');
	}

	public function inicie_caja()
	{
		//if($this->ion_auth->in_group("ven_inicie_caja"))
		//{
			$this->load->model('administracion/trabajadores_model','tra');
			$dataheader['title'] = 'Inicie/Cierre Caja';			
			$dataheader['trabaja']=$this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$data["trabajador"] = $this->tra->get_trabajadores($this->ion_auth->user()->row()->nPersonal_id);
			$this->load->view('templates/headers.php',$dataheader);		
			$this->load->view('templates/menu.php',$data);
			$this->load->view('ventas/inicie_caja.php');
			$datafooter['jsvista'] = base_url().'assets/js/jsvistas/ventas/reporte_ing_egr.js';
			$datafooter['active'] = 'ven_inicie_caja';
			$datafooter['dropactive'] = 'dropventas';
			$this->load->view('templates/footer.php',$datafooter);
		//}
		//else
			//redirect('/ventas', 'refresh');
	}

}