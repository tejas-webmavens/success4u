<?php

Class Dashboard_model extends CI_Model {

	// get tables
	public function GetActiveMember() {
		
		$condition = "isDelete='0' AND MemberStatus='Active'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	
	public function DashResults($condition='', $tableName, $limit, $start) {

		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			$row = $query->result();
			return $row;
		} else {
			return false;
		}
	}

	public function DashRow($condition='', $tableName, $limit, $start) {

		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function DashCount($condition='', $tableName) {
		
		$this->db->select('*');
		$this->db->from($tableName);

		if($condition)
			$this->db->where($condition);

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			$row = $query->result();
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
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}
	}

	Public function GetNewMembersTotal($condition){
		
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return 0;
		}	
	}

	Public function GetSums($condition, $table, $column){
		$this->db->select_sum($column);
		// $this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return 0;
		}	
	}

	Public function GetBalance($condition, $table, $column){
		$this->db->select_sum($column);
		// $this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);
		$this->db->order_by('HistoryId', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return 0;
		}	
	}

	// $this->db->select_sum('age');
	// Public function GetNewProducts(){
	// 	$condition = "isDelete =" . "'0'";
	// 	$this->db->select('*');
	// 	$this->db->from('arm_product');
	// 	$this->db->where($condition);
	// 	$query = $this->db->get();

	// 	if ($query->num_rows()>0) {
	// 		return $query->num_rows();
	// 	} else {
	// 		return false;
	// 	}	
	// }
	// Public function GetNewMembers(){
	// 	$condition = "isDelete =" . "'0'";
	// 	$this->db->select('*');
	// 	$this->db->from('arm_members');
	// 	$this->db->where($condition);
	// 	$query = $this->db->get();

	// 	if ($query->num_rows()>0) {
	// 		return $query->num_rows();
	// 	} else {
	// 		return false;
	// 	}	
	// }

	// Public function Getepincount($MemberId){
	// 	$condition = "AllocatedBy =" . "'" . $MemberId . "' AND EpinStatus='1'";
	// 	$this->db->select('*');
	// 	$this->db->from('arm_epin');
	// 	$this->db->where($condition);
	// 	$query = $this->db->get();
	// 	//echo $this->db->last_query();
	// 	if ($query->num_rows()>0) {
	// 		return $query->num_rows();
	// 	} else {
	// 		return 0;
	// 	}	
	// }

	// Public function Getcusomerbalance($MemberId){
	// 	$condition = "MemberId =" . "'" . $MemberId . "'";
	// 	$this->db->select('*');
	// 	$this->db->from('arm_history');
	// 	$this->db->order_by('HistoryId', 'DESC');
		
	// 	$this->db->where($condition);
	// 	$this->db->limit(1);
	// 	$query = $this->db->get();
		
	// 	if ($query->num_rows()>0) {
	// 		return $query->row()->Balance;
	// 	} else {
	// 		return 0.00;
	// 	}	
	// }

	

	
}

?>