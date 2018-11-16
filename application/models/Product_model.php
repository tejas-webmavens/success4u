<?php

Class Product_model extends CI_Model {
	

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

	Public function GetProductRow($condition, $tableName){
		$this->db->select('*');
		$this->db->from($tableName);
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}	

	// get tables
	public function GetProducts() {

		// $condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . md5($data['password']) . "'";
		$this->db->select('*');
		$this->db->from('arm_product');
		// $this->db->where($condition);
		 // $this->db->limit(5);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

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
	
	public function GetProductReview($ProductId) {

		$condition = "ProductId =" . "'" . $ProductId . "' AND Status=1";
		$this->db->select('*');
		$this->db->from('arm_review');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function SumProductReview($ProductId) {

		$condition = "ProductId =" . "'" . $ProductId . "' AND Status=1";
		$this->db->select_sum('rating');
		$this->db->from('arm_review');
		$this->db->where($condition);
		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function GetLatestProduct() {

		$condition = "isDelete ='0' and DisplyShop ='1' and status = '1'";
		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->where($condition);
		$this->db->order_by('ProductId','DESC');
		$this->db->limit(4);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function EditProduct($ProductId)
	{
		$this->db->select('*');
		$this->db->from('arm_product');
		// $this->db->join('arm_productimage', 'arm_productimage.ProductId = arm_product.ProductId');
		$this->db->where('ProductId',$ProductId);
		// $this->db->where('Price > 0.0000');
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
		
	}

	public function getavail($ProductId, $qty) {
		$this->db->select('*');
		$this->db->from('arm_product');
		$condition = "ProductId = '" . $ProductId . "' AND Quantity > '" . $qty . "'";
		$this->db->where($condition);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}

}

?>