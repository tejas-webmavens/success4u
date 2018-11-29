<?php

class Levelconfig_model extends CI_Model {

	public function Getlevelsetup($id) {
		$condition = "id=".$id;
		$this->db->select('*');
		$this->db->from('arm_levelconfig');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			$set ='Nill';
			return $set;
		}
	}

	public function GetAllLevelSetup(){
		$this->db->select('*');
		$this->db->from('arm_levelconfig');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			$set ='Nill';
			return $set;
		}	
	}
}
?>