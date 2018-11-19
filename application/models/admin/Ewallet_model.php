<?php

class Ewallet_model extends CI_Model {

	public function Update($data) {
		//print_r($data);
		
		$this->db->query("DELETE FROM arm_setting WHERE Page='mlmsetting'");
		//echo $this->db->last_query();

		foreach ($data as $key => $value) 
		{

			if($key!='')
			{
				$sd=date('Y-m-d H:i:s');

				$status=$this->db->query("INSERT INTO arm_setting SET
					StoreId = '005', 
					Page = 'mlmsetting',
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

		$condition = "Page =" . "'mlmsetting'";
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

	Public function getmemberid($username){

		$condition = "UserName =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {

			return $query->row()->MemberId;
		} else {
			return false;
		}	
	}

	Public function getmember($username){

		$condition = "UserName =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {

			return $query->row()->UserName;
		} else {
			return "no matches";
		}	
	}

	public  function SaveRecords($data, $tableName)
	{
		$this->db->set($data);
	    $this->db->insert($tableName);
	
	    return $this->db->insert_id();
	}

	Public function checkmemberbalance($id){
		$condition = "MemberId =" . "'" . $id . "' Order by HistoryId DESC ";
		$this->db->select('*');
		$this->db->from('arm_history');
		$this->db->where($condition);
		$query = $this->db->get();

		/*echo $this->db->last_query();
		echo $query->row()->Balance;
		exit;*/
		if ($query->num_rows()>0) {
			
			return $query->row()->Balance;
		} else {
			return 0.000;
		}	
	}

	Public function checkmemberrow($id){
		$condition = "MemberId =" . "'" . $id . "' Order by HistoryId DESC ";
		$this->db->select('*');
		$this->db->from('arm_history');
		$this->db->where($condition);
		$query = $this->db->get();

		/*echo $this->db->last_query();
		echo $query->row()->Balance;
		exit;*/
		if ($query->num_rows()>0) {
			
			return $query->row();
		} else {
			return false;
		}	
	}

	
}
?>