<?php

class Generalsetting_model extends CI_Model {

	public function sitechange($data) {
		//print_r($data);
		
		$this->db->query("DELETE FROM arm_setting WHERE Page='sitesetting'");
		//echo $this->db->last_query();

		foreach ($data as $key => $value) 
		{

			if($key!='')
			{
				$sd=date('Y-m-d H:i:s');

				$status=$this->db->query("INSERT INTO arm_setting SET
					StoreId = '001', 
					Page = 'sitesetting',
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

	public function Getsite($KeyValue='') {

		$condition = "Page =" . "'sitesetting'";
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

	public function Getmember() {

		$condition = "MemberStatus = 'Active' AND UserType='3'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('MemberId,UserName');
		$this->db->from('arm_members');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			$st = $query->result();
			return $st;
		} else {
			return false;
		}
	}

	public function Getsponsormember() {


		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				if($mlsetting->Id==1) 		{	$table = "arm_forcedmatrix"; 	}
				else if($mlsetting->Id==2) 	{	$table = "arm_unilevelmatrix"; 	}
				else if($mlsetting->Id==3) 	{	$table = "arm_monolinematrix"; 	}
				else if($mlsetting->Id==4) 	{	$table = "arm_binarymatrix"; 	}
				else if($mlsetting->Id==5) 	{	$table = "arm_boardmatrix"; 	} 
				else if($mlsetting->Id==6) 	{	$table = "arm_xupmatrix"; 		}
				else if($mlsetting->Id==7) 	{	$table = "arm_oddevenmatrix"; 	}
				else if($mlsetting->Id==8) 	{	$table = "arm_boardmatrix1"; 	}
				else if($mlsetting->Id==9) 	{	$table = "arm_binaryhyip"; 	}

		$condition = "a.MemberStatus = 'Active' AND a.UserType='3' AND b.MemberId=a.MemberId";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select("a.MemberId,a.UserName");
		$this->db->from('arm_members a');
		$this->db->join($table.' b', 'b.MemberId=a.MemberId', 'left');
		$this->db->where($condition);
		$this->db->group_by('b.MemberId');
		// $this->db->limit(1);
		$query = $this->db->get();
		 // echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			$st = $query->result();
			return $st;
		} else {
			return false;
		}
	}

/*
	public function addCustmer($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', newsletter = '" . (int)$data['newsletter'] . "', salt = '" . $this->db->escape($salt = token(9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', status = '" . (int)$data['status'] . "', approved = '" . (int)$data['approved'] . "', safe = '" . (int)$data['safe'] . "', date_added = NOW()");

		$customer_id = $this->db->getLastId();

		if (isset($data['address'])) {
			foreach ($data['address'] as $address) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($address['firstname']) . "', lastname = '" . $this->db->escape($address['lastname']) . "', company = '" . $this->db->escape($address['company']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "', custom_field = '" . $this->db->escape(isset($address['custom_field']) ? json_encode($address['custom_field']) : '') . "'");

				if (isset($address['default'])) {
					$address_id = $this->db->getLastId();

					$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
				}
			}
		}
	}



*/
}
?>