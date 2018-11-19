<?php

Class Transaction_model extends CI_Model {

	public function GetTransactions($condition='') {
		
		$this->db->select('h.*, t.*, m.UserName');
		$this->db->from('arm_history h');
		$this->db->join('arm_transaction_type t', 't.TypeId = h.TypeId');
		$this->db->join('arm_members m', 'm.MemberId = h.MemberId');
		
		if($condition)
			$this->db->where($condition);

		// $this->db->order_by('h.HistoryId, h.DateAdded', 'ASC');
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