<?php

class Ranksetting_model extends CI_Model {

	
public function Getcareer() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_ranksetting');
		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function Getcareerdata($id) {

		$condition = "rank_id =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_ranksetting');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}


}
?>