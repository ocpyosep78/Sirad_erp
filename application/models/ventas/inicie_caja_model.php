<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inicie_caja_model extends CI_Model {

	
	function __construct() {
		parent::__construct();
	}

	public function insert($data){
		$this->db->trans_start(true);
		
		$this->db->trans_begin();

		$this->db->insert('caja',$data);
		$id_Caja=$this->db->insert_id();

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return $id_Caja;
		}
	}

	public function cierre_caja($data)
	{

		$this->db->trans_start();
		
		$this->db->trans_begin();

		$fechaActual=date('Y-m-d');

        $this->db->where('dCajaFechaApertura',$fechaActual);
		$this->db->update('caja',$data);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}

	}


	public function get_EstadoCaja()
	{
		$fechaActual=date('Y-m-d');
		$query = $this->db->query("SELECT * FROM ven_consultar_caja_all  where FechaApertura ='".$fechaActual."'");
		return $query->row_array();
	}


	public function get_caja()
	{
		$query = $this ->db->query ('select * from ven_consultar_caja_all;');
		return $query -> result_array();
	
	}

}