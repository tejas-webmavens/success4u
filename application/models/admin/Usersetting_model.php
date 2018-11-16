<?php

class Usersetting_model extends CI_Model {

	public function Update($data) {
		//print_r($data);
		
		$this->db->query("DELETE FROM arm_setting WHERE Page='usersetting'");
		//echo $this->db->last_query();

		foreach ($data as $key => $value) 
		{

			if($key!='')
			{
				$sd=date('Y-m-d H:i:s');

				$status=$this->db->query("INSERT INTO arm_setting SET
					StoreId = '006', 
					Page = 'usersetting',
					KeyValue = " . $this->db->escape($key) . ", 
					ContentValue = ".$this->db->escape($data[$key]).", 
					DateAdded = '".$sd."'");
				//echo $this->db->last_query();
				//echo $customer_id = $this->db->getLastId();
			}
		}
		
		if($status)
			return 1;
		else
			return 0;
	



	}

	public function Getdata($KeyValue='') {

		$condition = "Page =" . "'usersetting'";
		if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('ContentValue');
		$this->db->from('arm_setting');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			$st = $query->row();
			return $st->ContentValue;
		} else {
			return false;
		}
	}

	
}
?>