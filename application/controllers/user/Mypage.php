<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		
		// $this->load->helper('url');
		// // Load form helper library
		// $this->load->helper('form');

		// // Load form validation library
		// $this->load->library('form_validation');

		// // Load session library
		// $this->load->library('session');
		$this->load->helper('cookie');

		// Load database
		
		$this->load->model('user/fund_model');
		$this->lang->load('mypage',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		}  else {
	    	redirect('login');
	    }
	}

	

	public function index()
	{
		
		if($this->session->userdata('logged_in')) 
		{

			if($this->input->post())
			{
				
					$this->form_validation->set_rules('referralname', 'referralname', 'trim|required|alpha_numeric|callback_referralname_check');
				//print_r($this->input->post());

				if($this->form_validation->run() == true)
				{
					$data = array(
						'ReferralName'=>$this->input->post('referralname')

						);
					$condition = "MemberId='".$this->session->MemberID."'";

					$result = $this->common_model->UpdateRecord($data, $condition,'arm_members');
					if($result)
					$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));

				}
				else 
				{
				$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
				
				}
				$this->data['member'] = $this->common_model->GetCustomer($this->session->MemberID);
				$this->load->view('user/mypage',$this->data);
				
			}
			else{
				$this->data['member'] = $this->common_model->GetCustomer($this->session->MemberID);
				$this->load->view('user/mypage',$this->data);
			    }

		}
		else 
		{
		$this->load->view('login');
		}
		
	}

	

	public function referralname_check($str) 
	{
		$condition = "ReferralName =" . "'" . $str . "' AND MemberId!='".$this->session->MemberID."'";

		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		if (!$query->num_rows()>0) 
		{
			return true; 
		}
		else{

			$this->form_validation->set_message('referralname_check', ucwords($this->lang->line('errorreferralname')));
			return false;
		}

	}
	
}
