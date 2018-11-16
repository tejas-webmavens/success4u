<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('admin_login')) {
			//$this->load->helper('url');

			// Load form helper library
			//$this->load->helper('form');
			
			// Load database
			
			$this->load->model('coupon_model');
			$this->load->model('product_model');
			$this->load->model('admin/category_model');
			
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('coupon');
			$this->IsAdmin();
		}  else {
	    	redirect('admin/login');
	    }

	}

	protected function IsAdmin() {
		
		$userid = $this->session->userdata('MemberID');
		$userlevel = $this->session->userdata('UserLevel');
		if($userlevel==2) {
			$controller = $this->router->fetch_class();
			$access_list_data = $this->common_model->Subadminaccess($userid,$userlevel);
			
			$pages = json_decode($access_list_data->access_list);
			
			if(!in_array(ucfirst($controller), $pages)) {
				redirect('admin');		
			} 
		}
	}

	public function index()
	{
 		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			
			$condition = '';
			$tableName = 'arm_coupon';
			$this->data['category'] = $this->coupon_model->GetCategory();
			// $this->data['product'] = $this->product_model->GetProducts();
			$this->data['coupons'] = $this->common_model->GetResults($condition,$tableName,'*');
			
			$this->load->view('admin/products/coupons',$this->data);
	    } else {
	    	redirect('admin/login');

	    }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "isDelete= '0'";

			if($this->input->post('couponname'))
				//$url .= '&FirstName=' . $this->input->post('firstname');
				$condition .= " AND CouponName LIKE" . "'%" . $this->input->post('couponname') . "%'";

			if($this->input->post('coupon_type'))
				//$url .= '&UserName=' . $this->input->post('username');
				 $condition .= " AND couponType =" . "'" . $this->input->post('coupon_type') . "'";

			if($this->input->post('coupon_category'))
				$condition .= " AND CatId =" . "'" . $this->input->post('coupon_category') . "'";

			if($this->input->post('status'))
				$condition .= " AND Status =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";
			
			$this->data['category'] = $this->coupon_model->GetCategory();
			$this->data['product'] = $this->product_model->GetProducts();
			$this->data['coupons'] = $this->common_model->GetResults($condition, 'arm_coupon', '*');
			
			$this->load->view('admin/products/coupons', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/coupon');
		}
	}

	public function add($couponId=''){

		$this->data['product'] = $this->product_model->GetProducts();
		$this->data['categories'] = $this->coupon_model->GetCategory();

		if($this->data['categories']) {
			foreach($this->data['categories'] as $row) {

				if($row->ParentId)
					$condition = "CategoryId='".$row->ParentId."'";
				else
					$condition = "CategoryId='".$row->CategoryId."'";

				$parent_category = $this->category_model->GetCategoryName($condition,'arm_category','*');
				if($parent_category) {
					if($parent_category->Category != $row->Category){
						if($parent_category->Category)
							$this->data['category'][$row->CategoryId] = $parent_category->Category.' > '.$row->Category;
						else
							$this->data['category'][$row->CategoryId] = $row->Category;
					}
					else
						$this->data['category'][$row->CategoryId] = $row->Category;
				}
			}
		}

		if($this->input->post()) {
				
			$this->form_validation->set_rules('coupon_name', 'couponName', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('coupon_type', 'couponType', 'trim|required|xss_clean');
			$this->form_validation->set_rules('discount_price', 'DiscountPrice', 'trim|required|xss_clean');
			$this->form_validation->set_rules('per_user', 'PerUser', 'trim|required|is_natural_no_zero|xss_clean');
			$this->form_validation->set_rules('coupon_status', 'couponStatus', 'trim|required|xss_clean');
			$this->form_validation->set_rules('datepicker1', 'StartDate', 'trim|required|xss_clean');
			$this->form_validation->set_rules('datepicker2', 'EndDate', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == TRUE) {

				// print_r($this->input->post());exit;
				if($this->input->post('CouponId')) {
					
					$data = array(
						'couponName' => $this->input->post('coupon_name'),
						'couponType' => $this->input->post('coupon_type'),
						'Total' => $this->input->post('discount_price'),
						'UsedTotal' => $this->input->post('per_user'),
						'StartDate' => date('Y-m-d h:i:s', strtotime($this->input->post('datepicker1'))),
						'EndDate' => date('Y-m-d h:i:s', strtotime($this->input->post('datepicker2'))),
						// 'CatId' => $this->input->post('coupon_category'),
						'Status' => $this->input->post('coupon_status')
						// 'ModifiedDate' => date('Y-m-d h:i:s')
					);
					
					$condition = "CouponId=".$this->input->post('CouponId');
					$status = $this->common_model->UpdateRecord($data, $condition, 'arm_coupon');

					$category_delete = $this->common_model->DeleteRecord($condition, 'arm_coupon_category');
					if($this->input->post('coupon_category')){
						$category_data = array(
							'CouponId' => $this->input->post('CouponId'),
							'CategoryId' => $this->input->post('coupon_category')
						);
						$category_status = $this->common_model->SaveRecords($category_data, 'arm_coupon_category');
					}

					$product_delete = $this->common_model->DeleteRecord($condition, 'arm_coupon_product');
					if($this->input->post('productname')) {
						$products = $this->input->post('productname');
						foreach($products as $product) {
							$product_data = array(
								'CouponId' => $this->input->post('CouponId'),
								'ProductId' => $product,
							);
							$product_status = $this->common_model->SaveRecords($product_data, 'arm_coupon_product');	
						}
					}
					

				}  else {
					
					$data = array(
						'CouponName' => $this->input->post('coupon_name'),
						'CouponCode' => strtoupper(random_string('alnum', 16)),
						'CouponType' => $this->input->post('coupon_type'),
						'Total' => $this->input->post('discount_price'),
						'UsedTotal' => $this->input->post('per_user'),
						'StartDate' => date('Y-m-d h:i:s',strtotime($this->input->post('datepicker1'))),
						'EndDate' => date('Y-m-d h:i:s', strtotime($this->input->post('datepicker2'))),
						// 'CatId' => $this->input->post('coupon_category'),
						'Status' => $this->input->post('coupon_status'),
						'DateAdded' =>  date('Y-m-d h:i:s')
					);

					$status = $this->common_model->SaveRecords($data, 'arm_coupon');

					$CouponId = $this->db->insert_id();
					
					if($this->input->post('coupon_category')){
						$category_data = array(
							'CouponId' => $CouponId,
							'CategoryId' => $this->input->post('coupon_category')
						);
						$category_status = $this->common_model->SaveRecords($category_data, 'arm_coupon_category');
					}

					if($this->input->post('productname')) {
						$products = $this->input->post('productname');
						foreach($products as $product) {
							$product_data = array(
								'CouponId' => $CouponId,
								'ProductId' => $product,
							);
							$product_status = $this->common_model->SaveRecords($product_data, 'arm_coupon_product');	
						}
					}

				}

				if($status){
					$this->session->set_flashdata('success_message', 'Success! coupons Updated');
					redirect('admin/coupon');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! coupons not Updated');
					$this->load->view('admin/products/addcoupon');		
				}
				
				
			} else {
				if($this->input->post('CouponId')) {
					
					$condition = "couponId =" . "'" . $couponId . "'";
					$this->data['coupon'] = $this->coupon_model->GetCouponRow($condition,'arm_coupon');
					$this->load->view('admin/products/addcoupon', $this->data);
				} else {
					$this->load->view('admin/products/addcoupon');
				}
			}
		} else {
			if($couponId) {
				$this->data['coupon'] = $this->coupon_model->GetCouponRow($couponId);

				$this->load->view('admin/products/addcoupon', $this->data);
			} else {
				$this->load->view('admin/products/addcoupon',$this->data);
			}
			
		}
	}
	
	public function delete($couponId) {
		$condition = "couponId =" . "'" . $couponId . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_coupon');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! coupon Removed');
			redirect('admin/coupon');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! coupon Not Removed');
			redirect('admin/coupon');
		}
		
	}

	public function active($couponId) {
		$condition = "couponId =" . "'" . $couponId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_coupon');
		if($status) {
			redirect('admin/coupon');
		}
	}

	public function inactive($couponId) {
		$condition = "couponId =" . "'" . $couponId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_coupon');
		if($status) {
			redirect('admin/coupon');
		}
	}

	public function GetProduct($CatId) {
		$condition = "CatId =" . "'" . $CatId . "'";
		$status = $this->common_model->GetResults($condition, 'arm_product', '*');
		//print_r($status);
		if($status) {
			//print_r($status);
			 $json_data = array();
			foreach($status as $row) {
				// $json_data['id'] = $row->ProductId;
				$json_data[$row->ProductId] = $row->ProductName;
			}
			//print_r($status);

			header('Content-Type: application/x-json; charset=utf-8');
	 		echo(json_encode($json_data));
	 	}
		
	}

	
	
	


}
