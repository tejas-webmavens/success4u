<?php

class Emailtemplate_model extends CI_Model {

	
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

	public function Getfields() {

		$condition = "IsDelete =" . "'0'";
		$this->db->select('*');
		$this->db->from('arm_emailtemplate');
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

		$condition = "EmailTemplateId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_emailtemplate');
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