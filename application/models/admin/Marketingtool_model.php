<?php

class Marketingtool_model extends CI_Model {

	
	public function Getcusomfield() {

		$condition = "Page =" . "'register'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('CustomName');
		$this->db->from('arm_customfields');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			return $query->result();
			
		} else {
			return false;
		}
	}


	public function Getproductdetail() {

		//condition = "Page =" . "'register'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('*');
		$this->db->from('arm_product');
		//$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		if ($query->num_rows()>0) {
			return $query->result();
			
		} else {
			return false;
		}
	}

	public function getregister() {

		//$condition = "Page =" . "'registersetting'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('MemberId,FirstName,
							MiddleName,LastName,
							Email,UserName,MemberStatus,
							Password,Gender,BirthDate,
							Phone,Fax,SubscriptionsStatus,
							DirectId,SpilloverId,Address,
							City,State,Country,Zip,EnrollerId');
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

		public function getlastid() 
		{
		//$condition = " order by MarketingId DESC";
		$this->db->select('*');
		$this->db->from('arm_marketingtool');
		$this->db->order_by('MarketingId','DESC');
		 $this->db->limit(0,1);
		 
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->row()->MarketingId;
		} else {
			return false;
		}

		}


	public function Getfields() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_marketingtool');
		// $this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function Getsearchfields($type) {

		$condition = "MarketingType =" . "'" . $type . "'";
		$this->db->select('*');
		$this->db->from('arm_marketingtool');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	
	public function Getfielddata($id) {

		$condition = "MarketingId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_marketingtool');
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