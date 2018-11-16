<?php

class Category_model extends CI_Model {

	public function GetCategory($condition='', $tableName, $SelectColumn='') {
		
		if($SelectColumn)
			$this->db->select($SelectColumn);
		else 
			$this->db->select('*');

		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			$row = $query->result();
			return $row;
		} else {
			return false;
		}
	}

	public function GetCategoryName($condition='', $tableName, $SelectColumn='') {
		
		if($SelectColumn)
			$this->db->select($SelectColumn);
		else 
			$this->db->select('*');

		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$data = array();
    	$this->db->group_by('ParentId,categoryId');

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $row = $query->row();
			
		} else {
			return false;
		}
	}

	Public function GetCategoryRow($condition, $tableName){
		$this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}
	
}
?>