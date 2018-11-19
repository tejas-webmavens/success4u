<?php

Class Sales_model extends CI_Model {

	public function GetTransactions($condition='') {
		
		$this->db->select('*');
		$this->db->from('arm_history h');
		$this->db->join('arm_transaction_type t', 't.TypeId = h.TypeId');
		$this->db->join('arm_members m', 'm.MemberId = h.MemberId AND h.TypeId=14');
		
		if($condition)
			$this->db->where($condition);
		
		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

}

?>