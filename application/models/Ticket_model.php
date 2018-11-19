<?php

Class Ticket_model extends CI_Model {
	
	public function GetAllTickets() {
		
		$this->db->select('*');
		$this->db->from('arm_ticket');
		// $this->db->join('arm_transaction_type t', 't.TypeId = h.TypeId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		
		$this->db->where('isDelete','0');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	// public function GetTickets($memberId) {
		
	// 	$this->db->select('*');
	// 	$this->db->from('arm_ticket t');
	// 	$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
	// 	// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
	// 	$this->db->group_by('tl.TicketId');
		
	// 	$this->db->where('tl.SenderId',$memberId);
		
	// 	$query = $this->db->get();

	// 	if ($query->num_rows()>0) {
	// 		return $query->result();
	// 	} else {
	// 		return false;
	// 	}
	// }

	Public function GetTicketRows($id){
		$this->db->select('*');
		$this->db->from('arm_ticket_list');
		// $this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		$this->db->where('TicketId',$id);
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}
	Public function GetTicketinfo($id){
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		$this->db->where('t.TicketId',$id);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}

    public function GetTicketsCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		$this->db->where("tl.SenderId='".$memberId."'  OR tl.MemberId='".$memberId."'");
		// $this->db->where('tl.SenderId',$memberId);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

    public function GetTickets($memberId, $limit, $start) {
    	
		// $this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		$this->db->where("tl.SenderId='".$memberId."'  OR tl.MemberId='".$memberId."'");
		// $this->db->where('tl.SenderId',$memberId);
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetsentTicketsCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('tl.SenderId',$memberId);
		$this->db->where('t.isDelete','0');
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}


	public function GetsentTickets($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('tl.SenderId',$memberId);
		$this->db->where('t.isDelete','0');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetreopenTicketsCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('t.Status="2" AND (tl.SenderId = "'.$memberId.'" OR MemberId="'.$memberId.'") ');
		// $this->db->where('t.Status','2');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function GetreopenTickets($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('t.Status="2" AND (tl.SenderId = "'.$memberId.'" OR MemberId="'.$memberId.'") ');
		// $this->db->where('tl.SenderId',$memberId);
		// $this->db->where('t.Status','2');
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetclosedTickets($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('t.Status="0" AND t.isDelete="0" AND (tl.SenderId = "'.$memberId.'" OR MemberId="'.$memberId.'") ');
		// $this->db->where('tl.SenderId',$memberId);
		// $this->db->where('t.Status','2');
		
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetclosedTicketsCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('t.Status="0" AND t.isDelete="0" AND (tl.SenderId = "'.$memberId.'" OR MemberId="'.$memberId.'") ');
		// $this->db->where('t.Status','2');
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	

	public function GetfromTicketsCount($memberId) {
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('tl.MemberId',$memberId);
		$this->db->where('t.isDelete','0');
		
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	public function GetfromTickets($memberId, $limit, $start) {
    	
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('arm_ticket t');
		$this->db->join('arm_ticket_list tl', 'tl.TicketId = t.TicketId');
		// $this->db->join('arm_members m', 'm.MemberId = t.MemberId');
		$this->db->group_by('tl.TicketId');
		
		$this->db->where('tl.MemberId',$memberId);
		$this->db->where('t.isDelete','0');
		$this->db->order_by('t.TicketId','DESC');

		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

    	

}

?>