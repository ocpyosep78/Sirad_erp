<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detcompramat_model extends CI_Model {

	
	function __construct() {
		parent::__construct();
	}
	
	public function insert_batch($data){

		$this->db->insert_batch('log_detcompra_mat',$data);
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


	/*public function get_DetOrdCompra($nOrdenCom_id)
	{
		$query = $this->db->query("SELECT * FROM log_ordcomdetalle_all  where nOrdenCom_id =" .$nOrdenCom_id);
		return $query->result_array();
	}

	public function get_OrdCompra()
	{
		$query = $this->db->query("SELECT * FROM log_ordcomdetalle_all");
		return $query->result_array();
	}*/

}