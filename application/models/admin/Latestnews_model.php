<?php

class Latestnews_model extends CI_Model {

	
	

	public function Getfields() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_news');
		//$this->db->join('arm_members b', 'b.MemberId=a.MemberId', 'left');
		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function Getfielddata($id) {

		$condition = "NewsId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_news');
		//$this->db->join('arm_members b', 'b.MemberId=a.MemberId', 'left');
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