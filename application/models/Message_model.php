<?php

Class Message_model extends CI_Model {
	
	Public function GetMessageRows($MailId){
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		// $this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		$this->db->where('MailId',$MailId);
		$this->db->order_by('MailId', 'ASC');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}
	
	public function GetsentMessagesCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		// $this->db->join('arm_mailbox_list tl', 'tl.MailId = t.MailId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('MailId');
		
		$this->db->where('SenderId',$memberId);
		$this->db->where('isDelete','0');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function GetsentMessages($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		// $this->db->join('arm_mailbox_list tl', 'tl.MailId = t.MailId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('MailId');
		
		$this->db->where('SenderId',$memberId);
		$this->db->where('isDelete','0');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GettrashMessagesCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		$this->db->group_by('MailId');
		$this->db->where('isDelete="1" AND (SenderId="'.$memberId.'" OR MemberId="'.$memberId.'")');
		
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function GettrashMessages($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		$this->db->group_by('MailId');
		
		$this->db->where('isDelete="1" AND (SenderId="'.$memberId.'" OR MemberId="'.$memberId.'")');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetfromMessagesCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		
		$this->db->group_by('MailId');
		
		$this->db->where('MemberId',$memberId);
		$this->db->where('isDelete','0');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function GetfromMessages($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_mailbox');
		// $this->db->join('arm_mailbox_list tl', 'tl.MailId = t.MailId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('MailId');
		
		$this->db->where('MemberId',$memberId);
		$this->db->where('isDelete','0');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

    	

}

?>