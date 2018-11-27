<?php

class Levelconfig_model extends CI_Model {

	public function Getlevelsetup($id) {
		$condition = "id=1";
		$this->db->select('increase_per_trans');
		$this->db->from('arm_levelconfig');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row()->increase_per_trans;
		} else {
			$set ='Nill';
			return $set;
		}
	}

}
?>