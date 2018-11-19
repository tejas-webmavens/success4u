<?php

Class Coupon_model extends CI_Model {
	

	// get tables
	public function GetCategory() {

		$condition = "Status = 1";
		$this->db->select('*');
		$this->db->from('arm_category');
		$this->db->where($condition);
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	// Public function GetCouponRow($condition, $tableName){
	// 	$this->db->select('*');
	// 	$this->db->from($tableName);
	// 	$this->db->where($condition);
	// 	$query = $this->db->get();

	// 	if ($query->num_rows()>0) {
	// 		return $query->row();
	// 	} else {
	// 		return false;
	// 	}	
	// }	
	Public function GetCouponRow($couponId){
		$this->db->select('*');
		// $this->db->from('arm_coupon');
		// $this->db->where('CouponId',$couponId);
		$this->db->from('arm_coupon c');
		$this->db->join('arm_coupon_category cc', 'cc.CouponId = c.CouponId', 'left');
		$this->db->join('arm_coupon_product cp', 'cp.CouponId = cc.CouponId', 'left');
		$this->db->where('cp.CouponId',$couponId);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}

	Public function GetCouponProduct($couponId){
		$this->db->select('*');
		$this->db->from('arm_coupon_product cp');
		$this->db->join('arm_product p', 'p.ProductId = cp.ProductId', 'left');
		$this->db->where('cp.CouponId',$couponId);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	// get tables
	// public function GetProducts() {

	// 	// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
	// 	$this->db->select('*');
	// 	$this->db->from('arm_product');
	// 	// $this->db->where($condition);
	// 	// $this->db->limit(1);
	// 	$query = $this->db->get();

	// 	if ($query->num_rows()>0) {
	// 		return $query->result();
	// 	} else {
	// 		return false;
	// 	}
	// }

	public function GetProduct($ProductId) {

		$condition = "ProductId =" . "'" . $ProductId . "'";
		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

	

}

?>