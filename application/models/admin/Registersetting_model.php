<?php

class registersetting_model extends CI_Model {

	
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

	public function getregister() {

		//$condition = "Page =" . "'registersetting'";
		//if($KeyValue) $condition.=" AND KeyValue='".$KeyValue."'";
		$this->db->select('FirstName,
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

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_requirefields');
		$this->db->order_by('FieldPosition','ASC');
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

		$condition = "RequireId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_requirefields');
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