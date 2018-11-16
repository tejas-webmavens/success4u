<?php

Class Income_model extends CI_Model {

	public function GetTransactions($condition='') {
		
		$this->db->select('*');
		$this->db->from('arm_history h');
		$this->db->join('arm_transaction_type t', 't.TypeId = h.TypeId');
		$this->db->join('arm_members m', 'm.MemberId = h.MemberId AND h.TypeId IN(10,11)');
		
		if($condition)
			$this->db->where($condition);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

}

?>