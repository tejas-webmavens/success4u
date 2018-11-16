<?php

class Testimonial_model extends CI_Model {

	public function Getfields() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_testimonial a');
		$this->db->join('arm_members b', 'b.MemberId=a.MemberId', 'left');
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

		$condition = "a.TestimonialId =" . "'" . $id. "'";
		$this->db->select('*');
		$this->db->from('arm_testimonial a');
		$this->db->join('arm_members b', 'b.MemberId=a.MemberId', 'left');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}


	public function TestimonialCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_testimonial');
		$this->db->where('MemberId',$memberId);
		$this->db->where('Status !=','0');
		
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function GetTestimonial($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_testimonial');
		$this->db->where('MemberId',$memberId);
		$this->db->where('Status !=','0');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
 			return $query->result();
		} else {
			return false;
		}
	}

	public function GetTestimonialall() {
		
		$this->db->select('*');
		$this->db->from('arm_testimonial');
		$this->db->where('Status','2');
		$this->db->order_by('TestimonialId', 'DESC');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
 			return $query->result();
		} else {
			return false;
		}
	}


}
?>