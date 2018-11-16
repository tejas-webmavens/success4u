
<?php

Class Order_model extends CI_Model {

	public function GetOrders($condition='') {
		
		$this->db->select('*');
		$this->db->from('arm_order o');
		$this->db->join('arm_order_product p', 'p.OrderId = o.OrderId');
		// $this->db->join('arm_members m', 'm.MemberId = h.MemberId');
		$this->db->where('isDelete','0');
		
		if($condition)
			$this->db->where($condition);
		
		$this->db->group_by('o.OrderNumber');
		$query = $this->db->get();
		
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function GetOrdersList($condition) {
		
		$this->db->select('*');
		$this->db->from('arm_order');
		$this->db->where('isDelete','0');
		// $this->db->join('arm_order_product p', 'p.OrderId = o.OrderId');
		// $this->db->join('arm_members m', 'm.MemberId = h.MemberId');
		
		if($condition)
			$this->db->where($condition);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetOrderProducts($OrderId) {
		$this->db->select('*');
		$this->db->from('arm_order_product');
		// $this->db->where('isDelete','0');
		// $this->db->join('arm_members m', 'm.MemberId = h.MemberId');
		$this->db->where('OrderId', $OrderId);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function GetUserOrder($MemberId) {
		$this->db->select('*');
		$this->db->from('arm_order');
		$condition = "MemberId='".$MemberId."' AND Status!='paid'";
		// $this->db->join('arm_members m', 'm.MemberId = h.MemberId');
		$this->db->where($condition); 
		// $this->db->where('Status', '$MemberId');

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

}

?>