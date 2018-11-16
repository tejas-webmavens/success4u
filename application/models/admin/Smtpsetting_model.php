<?php

class Smtpsetting_model extends CI_Model {

	public function Update($data) {
		//print_r($data);
		
		$this->db->query("DELETE FROM arm_setting WHERE Page='smtpsetting'");
		//echo $this->db->last_query();

		foreach ($data as $key => $value) 
		{

			if($key!='')
			{
				$sd=date('Y-m-d H:i:s');

				$status=$this->db->query("INSERT INTO arm_setting SET
					StoreId = '003', 
					Page = 'smtpsetting',
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

		$condition = "Page =" . "'smtpsetting'";
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

		$condition = "MemberStatus = 'Active'";
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