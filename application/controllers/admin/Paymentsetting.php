<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		$this->lang->load('paymentsetting');
		// Load database
		
		$this->load->model('admin/paymentsetting_model');
		//$this->load->model('admin/Generalsetting_model');

		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	public function index()
	{
		$this->lang->load('paymentsetting');

		if($this->session->userdata('logged_in')) {
			if($this->input->post('inputname')) {
				if($this->input->post('active'))
				{
					print_r($this->input->post());
					exit;
				} else {
					foreach ($this->input->post('inputname') as $customer_id) {
						print_r($this->input->post());
						//$status = $this->registersetting_model->DeleteCustomer($customer_id);
					}
					
					if($status) {
						redirect('admin/paymentlist');
					}
				}
			} else {
				$this->data['paymentdetails'] = $this->paymentsetting_model->Getpaymentdetails();
				$this->load->view('admin/paymentlist', $this->data['paymentdetails']);
			}
	    } else {
	    	redirect('admin/login');
	    	// $this->load->view('admin/login');
	    }
 		
	}//function ends




		// start here


 	public function editfield($id)
	{
		$this->lang->load('paymentsetting');
		
		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{

				$this->form_validation->set_rules('merchantid', 'merchantid', 'trim|required');
				$this->form_validation->set_rules('merchantpassword', 'merchantpassword', 'trim|required');
				$this->form_validation->set_rules('merchantapi', 'merchantapi', 'trim|required');
				$this->form_validation->set_rules('merchantkey', 'merchantkey', 'trim|required');
				$this->form_validation->set_rules('paymentstatus', 'paymentstatus', 'trim|required');
				$this->form_validation->set_rules('paymentmode', 'paymentmode', 'trim|required');
				$this->form_validation->set_rules('paymentliveurl', 'paymentliveurl', 'trim|required');
				$this->form_validation->set_rules('paymenttesturl', 'paymenttesturl', 'trim|required');
				$this->form_validation->set_rules('position', 'position', 'trim|required|numeric|xss_clean|callback_position_check['.$id.']');
 				
 				$payment_img = 'uploads/payment/'.$this->input->post('paymentname').'.jpg';
 				//print_r($_FILES);
/*
 					$config['upload_path'] = './uploads/payment/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['file_name'] = $this->input->post('paymentname');
					// $config['max_size']	= '120';
					// $config['max_width']  = '100';
					// $config['max_height']  = '30';
					$config['encrypt_name'] = FALSE;
					

					$this->load->library('upload', $config);

					$field_name = "paymentlogo"; 
					//$this->upload->do_upload($field_name);

					if ( ! $this->upload->do_upload($field_name)) {
						
						//$this->session->set_flashdata('error_message', $this->upload->display_errors());
						
					} else {
						$upload_files = $this->upload->data('file_name');
					}

					$aa =  split('/',$_FILES['paymentlogo']['type']);
					echo $aa[1];
					echo"sd$upload_files".$upload_files;
 				exit;*/
				
 				if($_FILES['paymentlogo']['tmp_name']!='')
				{
					if($payment_img)
					unlink($payment_img);
					move_uploaded_file($_FILES['paymentlogo']['tmp_name'], $payment_img);
				}

 				if($this->form_validation->run() == true)
 				{


 						

				$data = array(
					'PaymentStatus'=>$this->input->post('paymentstatus'),
					'PaymentLogo'=>$payment_img,
					'PaymentMode'=>$this->input->post('paymentmode'),
					'PaymentMerchantId'=>$this->input->post('merchantid'),
					'PaymentMerchantPassword'=>$this->input->post('merchantpassword'),
					'PaymentMerchantKey'=>$this->input->post('merchantkey'),
					'PaymentMerchantApi'=>$this->input->post('merchantapi'),
					'PaymentLiveUrl'=>$this->input->post('paymentliveurl'),
					'PaymentTestUrl'=>$this->input->post('paymenttesturl'),
					'Position' => $this->input->post('position'));

						
					$condition= "PaymentId='".$id."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_paymentsetting');
				
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/paymentsetting');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					//$this->data['register']= $this->paymentsetting_model->getregister();
					// $this->data['cusomfield']= $this->paymentsetting_model->Getcusomfield();
					$this->data['fielddata']= $this->paymentsetting_model->Getfielddata($id);
					
					$this->load->view('admin/editpaymentfield',$this->data);
				}

				
				
			}
			else
			{
				$this->data['register']= $this->paymentsetting_model->getregister();
				// $this->data['cusomfield']= $this->paymentsetting_model->Getcusomfield();
				$this->data['fielddata']= $this->paymentsetting_model->Getfielddata($id);
				
				$this->load->view('admin/editpaymentfield',$this->data);
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}


	public function position_check($str,$id)
	{
		
			$condition = "Position =" . "'" . $str . "' AND PaymentId !=" . "'" . $id . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_paymentsetting');
		$this->db->where($condition);
		
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('position_check', '<p><em class="state-error1">This position is unavailable</em></p>');
			return false;
		}
		
	}

	public function enable($PaymentId) {
		$condition = "PaymentId =" . "'" . $PaymentId . "'";

		$data = array(
			'PaymentStatus' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_paymentsetting');
		if($status) {
			redirect('admin/paymentsetting');
		}
	}

	public function disable($PaymentId) {
		$condition = "PaymentId =" . "'" . $PaymentId . "'";

		$data = array(
			'PaymentStatus' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_paymentsetting');
		if($status) {
			redirect('admin/paymentsetting');
		}
	}

	public function active($PaymentId) {
		$condition = "PaymentId =" . "'" . $PaymentId . "'";

		$data = array(
			'PaymentMode' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_paymentsetting');
		if($status) {
			redirect('admin/paymentsetting');
		}
	}

	public function inactive($PaymentId) {
		$condition = "PaymentId =" . "'" . $PaymentId . "'";

		$data = array(
			'PaymentMode' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_paymentsetting');
		if($status) {
			redirect('admin/paymentsetting');
		}
	}



	} //class ends


