<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('admin_login')) {
			// Load database
			
			$this->load->model('product_model');
			$this->load->model('admin/category_model');
			
			// change language

			// load language
			$this->lang->load('category');

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
 		
		$condition = "isDelete='0'";
		$this->data['category'] = $this->category_model->GetCategory($condition,'arm_category','*');
		$this->load->view('admin/products/category', $this->data['category']);
 		
	}

	public function search() {
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "isDelete= '0'";

			if($this->input->post('category'))
				$condition .= " AND Category LIKE" . "'%" . $this->input->post('category') . "%'";

			if($this->input->post('status')){
				if($this->input->post('status')=='active')
					$status = 1;
				else
					$status = 0;
				$condition .= " AND Status =" . "'" . $status . "'";
			}

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['category'] = $this->common_model->GetResults($condition, 'arm_category');
			//echo $this->db->last_query();
			$this->load->view('admin/products/category', $this->data['category']);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/category');
		}
	}

	public function add($CategoryId='')
	{
		if($this->session->userdata('logged_in')) {

			$this->data['categories'] = $this->product_model->GetCategory();

			if($this->data['categories']) {
				foreach($this->data['categories'] as $row) {

					if($row->ParentId)
						$condition = "CategoryId='".$row->ParentId."' AND isDelete='0'";
					else
						$condition = "CategoryId='".$row->CategoryId."' AND isDelete='0'";

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
	
				$this->form_validation->set_rules('category_name', 'Category', 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('ParentId', 'ParentId', 'trim|required|xss_clean');
				$this->form_validation->set_rules('SortOrder', 'SortOrder', 'trim|required|is_natural|xss_clean');
				$this->form_validation->set_rules('Status', 'Status', 'trim|required|xss_clean');
				
				
				if ($this->form_validation->run() == TRUE) {

					$field_name = "catImage"; 

					if($_FILES[$field_name]['name']) {
						
						$config['upload_path'] = './uploads/admin/product/';
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;
						

						$this->load->library('upload', $config);

						
						if ( ! $this->upload->do_upload($field_name)) {
							
							$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files = $this->upload->data('file_name');
						}
					} else {
						$upload_files = '';
					}

					if($this->input->post('CategoryId')) {
						
						$data = array(
							
							'Category' => $this->input->post('category_name'),
							'ParentId' => $this->input->post('ParentId'),
							'SortOrder' => $this->input->post('SortOrder'),
							'Status' => $this->input->post('Status'),
							'DateModified' =>  date('Y-m-d h:i:s')
						);

						if($_FILES[$field_name]['name']) {
							$data['Image'] = $upload_files;
						}

						$condition = "CategoryId =" . "'" . $this->input->post('CategoryId') . "'";
						
						$status = $this->common_model->UpdateRecord($data, $condition, 'arm_category');
						
					}  else {

						$data = array(
							'Category' => $this->input->post('category_name'),
							'Image' => ($upload_files) ? $upload_files : '',
							'ParentId' => $this->input->post('ParentId'),
							'SortOrder' => $this->input->post('SortOrder'),
							'Status' => $this->input->post('Status'),
							'DateAdded' =>  date('Y-m-d h:i:s')
						);

						$status = $this->common_model->SaveRecords($data, 'arm_category');

					}

					if($status){
						$this->session->set_flashdata('success_message', 'Success! Category details Updated');
						redirect('admin/category');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! Category details not Updated'.$this->upload->display_errors());
						
						$this->load->view('admin/products/addcategory');		
					}
					
					
				} else {
					$this->load->view('admin/products/addcategory');
				}
			} else {

				if($CategoryId) {
					$condition = "CategoryId =" . "'" . $CategoryId . "'";
					$this->data['cat'] = $this->category_model->GetCategoryRow($condition, 'arm_category');
					$this->load->view('admin/products/addcategory', $this->data);
				} else {
					$this->load->view('admin/products/addcategory',$this->data);
				}
				
			}
	    } else {
	    	redirect('admin/login');
	    }
	}
	
	public function delete($Id) {
		$condition = "CategoryId =" . "'" . $Id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_category');
		$condition1 = "CatId =" . "'" . $Id . "'";
		$status = $this->common_model->DeleteRecord($condition1, 'arm_product');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! Category Removed');
			redirect('admin/category');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Category Not Removed');
			redirect('admin/category');
		}
		
	}

	public function active($CategoryId) {
		$condition = "CategoryId =" . "'" . $CategoryId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_category');
		if($status) {
			redirect('admin/category');
		}
	}

	public function inactive($CategoryId) {
		$condition = "CategoryId =" . "'" . $CategoryId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_category');
		if($status) {
			redirect('admin/category');
		}
	}

	public function DeleteAll() {
		if($this->input->post('category')) {
			foreach ($this->input->post('category') as $key => $value) {
				$condition = "CategoryId =" . "'" . $value . "'";

				$status = $this->common_model->DeleteRecord($condition, 'arm_category');
				$condition1 = "CatId =" . "'" . $value . "'";
				$status = $this->common_model->DeleteRecord($condition1, 'arm_product');

				// $data = array(
				// 	'isDelete' => '1'
				// );

				// $status = $this->common_model->UpdateRecord($data, $condition, 'arm_category');
			}
			if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected category removed');
				redirect('admin/category');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected category not removed');
				redirect('admin/category');
			}
		} else {
			redirect('admin/category');
		}
	}


}
