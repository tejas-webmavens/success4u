<?php

class Paymentsetting_model extends CI_Model {

	public function update($data,$page) {
		//print_r($data);
		
		$this->db->query("DELETE FROM arm_setting WHERE StoreCode='".$page."'AND Page = 'PaymentSetting' ");
		//echo $this->db->last_query();

		foreach ($data as $key => $value) 
		{

			if($key!=''&& $key!='Page')
			{
				$sd=date('Y-m-d H:i:s');
				/*echo "<br>INSERT INTO arm_setting SET
					StoreId = '002', 
					Page = '".$page."',
					KeyValue = " . $this->db->escape($key) . ", 
					ContentValue = ".$this->db->escape($data[$key]).", 
					DateAdded = '".$sd."'";
					*/
				$status=$this->db->query("INSERT INTO arm_setting SET
					StoreId = '001', 
					Page = 'PaymentSetting',
					StoreCode = '".$page."',
					KeyValue = " . $this->db->escape($key) . ", 
					ContentValue = ".$this->db->escape($data[$key]).", 
					DateAdded = '".$sd."'");
				//ec //ho $this->db->last_query();
				//echo $customer_id = $this->db->getLastId();
			}
		}
		
		if($status)
			return 1;
		else
			return 0;
	



	}

	public function Getdata($KeyValue='',$StoreCode='') 
	{
		//echo '$KeyValue='.$KeyValue.'$StoreCode='.$StoreCode;

		$condition = "Page =" . "'paymentSetting'";
		if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		if($KeyValue) $condition.=" AND StoreCode='".$StoreCode."'";
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

	public function getregister() {

		//$condition = "Page =" . "'registersetting'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('*');
		$this->db->from('arm_members');
		//$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			
			return $query->row();
		} else {
			return false;
		}
	}

	public function Getpaymentdetails() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_paymentsetting');
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

		$condition = "PaymentId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_paymentsetting');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			
			return $query->row();
		} else {

			return false;
		}
	}

	public function Getpaymentdata($name) {

		$condition = "PaymentName =" . "'" . $name. "'";
		$this->db->select('*');
		$this->db->from('arm_paymentsetting');
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