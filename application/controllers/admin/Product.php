<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('admin_login')) {

			
			// Load database
			
			$this->load->model('product_model');
			$this->load->model('admin/category_model');
			
			// change language

			// load language
			$this->lang->load('product');
			
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
 		// if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			$condition = '';
			$tableName = 'arm_product';
			$this->data['category'] = $this->product_model->GetCategory();
			$this->data['products'] = $this->common_model->GetResults($condition,$tableName,'*');
			$this->load->view('admin/products/products',$this->data);
	    // } else {
	    // 	redirect('admin/login');
	    // }	
	}

	public function search(){
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "isDelete= '0'";

			if($this->input->post('productname'))
				//$url .= '&FirstName=' . $this->input->post('firstname');
				$condition .= " AND ProductName LIKE" . "'%" . $this->input->post('productname') . "%'";

			if($this->input->post('product_type'))
				//$url .= '&UserName=' . $this->input->post('username');
				 $condition .= " AND ProductType =" . "'" . $this->input->post('product_type') . "'";

			if($this->input->post('product_category'))
				$condition .= " AND CatId =" . "'" . $this->input->post('product_category') . "'";

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

			
			$this->data['category'] = $this->product_model->GetCategory();
			$this->data['products'] = $this->common_model->GetResults($condition, 'arm_product', '*');
			//print_r($this->data['products']);exit;
			$this->load->view('admin/products/products', $this->data);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/product');
		}
	}

	public function add($ProductId=''){


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
			
			

				
				$this->form_validation->set_rules('product_name', 'ProductName', 'trim|required|min_length[5]|xss_clean');
				$this->form_validation->set_rules('product_desc', 'ProductDesc', 'trim|required|xss_clean');
				$this->form_validation->set_rules('product_type', 'ProductType', 'trim|required|xss_clean');
				$this->form_validation->set_rules('product_category', 'ProductCategory', 'trim|required|xss_clean');
				$this->form_validation->set_rules('product_status', 'ProductStatus', 'trim|required|xss_clean');
				$this->form_validation->set_rules('product_quantity', 'ProductQuantity', 'trim|required|is_natural_no_zero|xss_clean');
				$this->form_validation->set_rules('product_price', 'ProductPrice', 'trim|required|numeric|xss_clean');
				if($ProductId) {
					if( ($this->input->post('product_type')==2) && ($this->input->post('digitalfile')=='')) {
						$this->form_validation->set_rules('File', 'File', 'trim|required');
					}
				} else {
					if( ($this->input->post('product_type')==2) && ($_FILES['File']['name']=='')) {
						$this->form_validation->set_rules('File', 'File', 'trim|required');
					}
				}
				
				
				
				if ($this->form_validation->run() == TRUE) {

					if($this->input->post('show_info')) {
						if($this->input->post('field_value')) {
							$custom = array_combine($this->input->post('field_name'), $this->input->post('field_value'));
							$custom_value = json_encode($custom);
						}
					} else {
						$custom_value = '';
					}

					
					$config['upload_path'] = 'uploads/admin/product/';
					$config['allowed_types'] = '*';
					$config['encrypt_name'] = TRUE;

					$this->load->library('upload', $config);

					$field_name1 = 'ProductImage1';
					$field_name2 = 'ProductImage2';
					$field_name3 = 'ProductImage3';
					$field_name4 = 'File';

					
					//print_r($image);

			
					 	if($_FILES[$field_name1]['name']) {

						if ( ! $this->upload->do_upload($field_name1)) {
							
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files1 = $this->upload->data('file_name');
						}
					}

					if($_FILES[$field_name2]['name']) {

						if ( ! $this->upload->do_upload($field_name2)) {
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files2 = $this->upload->data('file_name');
						}
					}

					if($_FILES[$field_name3]['name']) {

						if ( ! $this->upload->do_upload($field_name3)) {
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files3 = $this->upload->data('file_name');
						}
					}

					if($_FILES[$field_name4]['name']) {

						if ( ! $this->upload->do_upload($field_name4)) {
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
							
						} else {
							$upload_files4 = $this->upload->data('file_name');
						}

					}

					if(isset($_FILES['file_upload']))
					{
						foreach($_FILES['file_upload'] as $key=>$val)
				        {
				            $i = 1;
				            foreach($val as $v)
				            {
				                $field_name = "file_".$i;
				                $_FILES[$field_name][$key] = $v;
				                $i++;   
				            }
				        }
					}
					

				        unset($_FILES['file_upload']);
				        unset($_FILES['ProductImage1']);
				        unset($_FILES['ProductImage2']);
				        unset($_FILES['ProductImage3']);
				        unset($_FILES['file']);


				        $error = array();
				        $success = array();
				        

				        
				        foreach($_FILES as $field_name => $file)
				        {
				            if ( ! $this->upload->do_upload($field_name))
				            {
				                $error['upload'][] = $this->upload->display_errors();
				            }
				            else
				            {
				                $success[] = $this->upload->data('file_name');
				            }
				        }
				        $newimage = str_replace('"', '', json_encode($success));
				        $newimage = str_replace('[', '', $newimage);
				        $newimage = str_replace(']', '', $newimage);
				      
				     

					
				


					if($this->input->post('ProductId')) {
						$ProductId = $this->input->post('ProductId');
						$condition = "ProductId =" . "'" . $ProductId . "'"; 
						$product = $this->product_model->EditProduct($ProductId);
						if($product)
                        	$images = explode(',', $product->Image);
					}

					
					
			        
					if($this->input->post('ProductId')) {

						$uploadfiless = '';
					

						if(isset($upload_files1))
								$uploadfiless.= $upload_files1.',';
						else

							$uploadfiless.= $images[0].',';

						if(isset($upload_files2))
								$uploadfiless.= $upload_files2.',';
						else
							$uploadfiless.= $images[1].',';

						if(isset($upload_files3))
								$uploadfiless.= $upload_files3;
						else
							$uploadfiless.= $images[2].',';
						if(isset($upload_files4))
								$uploadfiless.= $upload_files3;
						else
							$uploadfiless.= $product->Image.',';

					         // $uploadfiless.= $images[3];
					         $multiimage=$product->Image;
					         // print_r($multiimage);
					         $images = explode(',', $product->Image);
					     

					        
					      $filterimage=array_filter($images);
					     

					         			
					         		if(!in_array($newimage, $filterimage))
					         		{	
					         			 if($newimage)
					        		 	{

					         			 	$uploadfiless.=",".$newimage;

					         			}

					         		}
					         		
					          
					         
				         $uploadimages=explode(',', $uploadfiless);

				         $uploadimagesfilter=array_unique($uploadimages);
				         $uploadfiless=implode(',', $uploadimagesfilter);

						 $data = array(
						'ProductName' => $this->input->post('product_name'),
						// 'Image' => $images,
						'ProductType' => $this->input->post('product_type'),
						// 'Description' => htmlentities($this->input->post('product_desc')),
						'Description' => $this->input->post('product_desc'),
						'CatId' => $this->input->post('product_category'),
						'Status' => $this->input->post('product_status'),
						'Quantity' => $this->input->post('product_quantity'),
						'Points' => $this->input->post('Points'),
						'Price' => $this->input->post('product_price'),
						'DisplyShop' => $this->input->post('shop'),
						'AutoShip' => $this->input->post('ship'),
						'iSentrole' => $this->input->post('entroll'),
						'Attributes' => ($this->input->post('field_value')) ? $custom_value : '',
						'ModifiedDate' => date('Y-m-d h:i:s')
					);
						
						$data['Image'] = rtrim($uploadfiless,',');

						if($this->input->post('product_type')==2) {
							if(isset($upload_files4))
								$data['File'] = $upload_files4;
						}

						
						
						$condition = "ProductId=".$this->input->post('ProductId');
						$status = $this->common_model->UpdateRecord($data, $condition, 'arm_product');
						// echo $this->db->last_query();


					}  
					else
					 {

						if(isset($_FILES['file_upload']))
						{
								foreach($_FILES['file_upload'] as $key=>$val)
					        {
					            $i = 1;
					            foreach($val as $v)
					            {
					                $field_name = "file_".$i;
					                $_FILES[$field_name][$key] = $v;
					                $i++;   
					            }
					        }

						}		

				        unset($_FILES['file_upload']);
				        unset($_FILES['ProductImage1']);
				        unset($_FILES['ProductImage2']);
				        unset($_FILES['ProductImage3']);
				        unset($_FILES['file']);


				        $error = array();
				        $success = array();
				        
				       // print_r($_FILES);

				        
				        foreach($_FILES as $field_name => $file)
				        {
				            if ( ! $this->upload->do_upload($field_name))
				            {
				                $error['upload'][] = $this->upload->display_errors();
				            }
				            else
				            {
				                $success[] = $this->upload->data('file_name');
				            }
				        }
				        $newimage = str_replace('"', '', json_encode($success));
				        $newimage = str_replace('[', '', $newimage);
				        $newimage = str_replace(']', '', $newimage);


						$uploadfiless = '';

						if(isset($upload_files1))
							$uploadfiless.= $upload_files1.',';

						if(isset($upload_files2))
							$uploadfiless.= $upload_files2.',';

						if(isset($upload_files3))
							$uploadfiless.= $upload_files3;
						 // $uploadfiless.= $newimage;
						
						if($newimage)
 							$uploadfiless.= ','.$newimage;

 						// print_r($uploadfiless);
 						

						if($this->input->post('product_type')==2) {
							if(isset($upload_files4))
								$digital = $upload_files4;
						}

						$data = array(
							'ProductName' => $this->input->post('product_name'),
							// 'Image' => ($images) ? $images : '',
							'ProductType' => $this->input->post('product_type'),
							'File' => (isset($digital)) ? $digital : '',
							'Description' => htmlentities($this->input->post('product_desc')),
							'CatId' => $this->input->post('product_category'),
							'Status' => $this->input->post('product_status'),
							'Quantity' => $this->input->post('product_quantity'),
							'Points' => $this->input->post('Points'),
							'Price' => $this->input->post('product_price'),
							'DisplyShop' => $this->input->post('shop'),
							'AutoShip' => $this->input->post('ship'),
							'iSentrole' => $this->input->post('entroll'),
							'StockStatusId' => '1',
							'Attributes' => ($this->input->post('field_value')) ? $custom_value : '',
							'DateAdded' =>  date('Y-m-d h:i:s')
						);
						$data['Image'] = trim($uploadfiless);
						// print_r($data);exit;
						$status = $this->common_model->SaveRecords($data, 'arm_product');


					}

					if($status){
						$this->session->set_flashdata('success_message', 'Success! Products Updated');
						redirect('admin/product');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! products not Updated');
						$this->load->view('admin/products/addproduct');		
					}
					
					
				} else {

					if($this->input->post('ProductId')) {
						$condition = "ProductId =" . "'" . $this->input->post('ProductId') . "'";
						$this->data['product'] = $this->product_model->EditProduct($this->input->post('ProductId'));
						$this->load->view('admin/products/addproduct', $this->data);
						// redirect('admin/product/add/'.$this->input->post('ProductId'));
					} else {
						$this->load->view('admin/products/addproduct');
					}
				}
		} else {
			if($ProductId) {
				$condition = "ProductId =" . "'" . $ProductId . "'";

				// $this->data['product'] = $this->product_model->GetProductRow($condition,'arm_product');
				$this->data['product'] = $this->product_model->EditProduct($ProductId);
				
				// echo $this->db->last_query();exit;
				//$this->data['category'] = $this->product_model->GetCategory();

				$this->load->view('admin/products/addproduct', $this->data);
			} else {
				//$this->data['category'] = $this->product_model->GetCategory();
				// print_r($this->data);
				$this->load->view('admin/products/addproduct',$this->data);
			}
			
		}
		// $this->load->view('admin/products/addproduct');
	}

	public function delete($ProductId) {
		$condition = "ProductId =" . "'" . $ProductId . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_product');

		if($status) {
			$this->session->set_flashdata('success_message', 'Success! Product Removed');
			redirect('admin/product');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Product Not Removed');
			redirect('admin/product');
		}
		
	}
	public function instock() {
		$stock = $this->input->post('stock');
		
		if($this->input->post('products')) {
			foreach ($this->input->post('products') as $key => $value) {
				$condition = "ProductId =" . "'" . $value . "'";

				if($stock=='in') {
					$data = array(
						'StockStatusId' => '1'
					);
				} else {
					$data = array(
						'StockStatusId' => '0'
					);
				}

				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_product');
			}
			if($status) {
				redirect('admin/product');
			}
		} else {
			redirect('admin/product');
		}
	}

	public function active($ProductId) {
		$condition = "ProductId =" . "'" . $ProductId . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_product');
		if($status) {
			redirect('admin/product');
		}
	}

	public function inactive($ProductId) {
		$condition = "ProductId =" . "'" . $ProductId . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_product');
		if($status) {
			redirect('admin/product');
		}
	}


}
