<?php

Class Shop_model extends CI_Model {

	Public function GetNewProducts(){
		
		$condition = "isDelete ='0' and DisplyShop ='1' and status = '1'";
		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->order_by('Price', 'ASC');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}
	
	Public function GetProducts($id){
		
		$condition = "isDelete ='0' AND CatId='".$id."'";
		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->where($condition);
		$this->db->order_by('ProductId', 'DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}
	Public function GetProductsTotal($id){
		
		$condition = "isDelete ='0' AND CatId='".$id."'";
		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->where($condition);
		$this->db->order_by('ProductId', 'DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->num_rows();
		} else {
			return false;
		}	
	}

	Public function GetCategory(){
		// echo $this->db->dbprefix('coupon');
		// echo $table_name = $this->table->prefix.'coupon';
		$condition = "isDelete ='0' AND Status='1'";
		$this->db->select('*');
		$this->db->from('arm_category');
		$this->db->where($condition);
		$this->db->order_by('ParentId', 'ASC');
		// $this->db->order_by('SortOrder', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}



	Public function Getproduct($id){
		// echo $this->db->dbprefix('coupon');
		// echo $table_name = $this->table->prefix.'coupon';
		// $condition = "isDelete ='0' AND Status='1'";
		$condition = "isDelete ='0' AND CatId='".$id."'";

		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->where($condition);
		$this->db->order_by('ProductId', 'ASC');
		// $this->db->order_by('SortOrder', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}
	Public function GetCategoryMenu(){
		// $condition = "isDelete ='0' AND Status='1' AND ParentId='0'";
		
		$condition = "isDelete ='0' AND Status='1'";
		$this->db->select('*');
		$this->db->from('arm_category');
		$this->db->where($condition);
		$this->db->order_by('ParentId', 'ASC');
		// $this->db->order_by('SortOrder', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}
	
	Public function getCoupon($coupon) {
		//AND ((StartDate = '0000-00-00' OR StartDate < NOW()) AND (EndDate = '0000-00-00' OR EndDate > NOW()))
		$condition = "CouponCode='".$coupon."' AND isDelete ='0' AND Status='1' AND ((StartDate = '0000-00-00' OR StartDate < NOW()) AND (EndDate = '0000-00-00' OR EndDate > NOW()))";
		$this->db->select('*');
		$this->db->from('arm_coupon');
		$this->db->where($condition);
		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}
	public function getCateimage($id) {
		$this->db->select('Image');
		$this->db->from('arm_category');
		$this->db->where('CategoryId',$id);
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}	
	}

	public function CateCount($condition='', $tableName) {
		
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

	public function GetCategoryName($CategoryId) {
		
		$this->db->select('Category');
		$this->db->from('arm_category');
		
		$this->db->where('CategoryId',$CategoryId);

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->row();
		} else {
			return false;
		}
	}
	public function GetSubcategory($CategoryId) {
		
		$this->db->select('*');
		$this->db->from('arm_category');
		
		$this->db->where('ParentId',$CategoryId);

		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}
	}

	Public function GetSearchProducts($value){
		
		// $condition = "isDelete ='0' and DisplyShop ='1' and status = '1'";
	 $condition="ProductName='".$value."' ORDER BY Price ASC";

		$this->db->select('*');
		$this->db->from('arm_product');
		$this->db->like('ProductName',$value);
		//$this->db->where($condition);
		
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return $query->result();
		} else {
			return false;
		}	
	}


	// public function GetResults() {
		
	// 	$condition = "UserName =" . "'" . $data['username'] . "' AND " . "Password =" . "'" . $data['password'] . "'";
		
	// 	$this->db->select('*');

	// 	$this->db->from($tableName);

	// 	if($condition)
	// 		$this->db->where($condition);

	// 	$query = $this->db->get();

	// 	if ($query->num_rows()>0) {
	// 		$row = $query->result();
	// 		return $row;
	// 	} else {
	// 		return false;
	// 	}
	// }

}

?>