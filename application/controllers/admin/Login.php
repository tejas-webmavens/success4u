<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

		// $this->load->helper('url');
		// // Load form helper library
		// $this->load->helper('form');

		// // Load form validation library
		// $this->load->library('form_validation');

		// // Load session library
		// $this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('captcha');

		// Load database
		
		
	}

	

	public function index()
	{


		if($this->input->post())
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$captchaset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='usecaptcha'", "arm_setting");
			 	if($captchaset->ContentValue=="On") {
				 	$this->form_validation->set_rules('g-recaptcha-response', 'captcha', 'trim|required|xss_clean|callback_captcha_check');
			 	}


			if ($this->form_validation->run() == FALSE) {

				$this->load->view('admin/login');

			} else {
				$data = array(
					'username' => $this->input->post('username'),
					// 'password' => hash_hmac("sha256", $this->input->post('password'), "secret", true)
					'password' => SHA1(SHA1($this->input->post('password')))
					// 'password' => SHA1($this->input->post('password'))
				);

				$result = $this->common_model->login($data);

				if ($result) {

					// $array = array(
					// 	"logged_in" => TRUE,
					// 	"full_name" => $result->FirstName.' '.$result->MiddleName.''.$result->LastName,
					// 	"MemberID" => $result->MemberId,
					// 	"Email" => $result->Email,
					// 	"UserLevel" => $result->UserType
					// );

					if($result->UserType==1 || $result->UserType==2) {
						$array = array(
							"logged_in" => TRUE,
							"full_name" => $result->FirstName.' '.$result->MiddleName.''.$result->LastName,
							"MemberID" => $result->MemberId,
							"Email" => $result->Email,
							"UserLevel" => $result->UserType,
							"admin_login" => TRUE,
							"user_login" => FALSE

						);
					}
					// else {
					// 	$array = array(
					// 		"logged_in" => TRUE,
					// 		"full_name" => $result->FirstName.' '.$result->MiddleName.''.$result->LastName,
					// 		"MemberID" => $result->MemberId,
					// 		"Email" => $result->Email,
					// 		"subadmin_login" => FALSE,
					// 		"user_login" => FALSE

					// 	);
					// }

					if($this->input->post('remember')) {

						$this->session->set_userdata('remember_me', true);

						$cookie = array(
						    'name'   => 'remember_me',
						    'value'  => '1212',
						    'expire' => '1209600',  // Two weeks
						    'domain' => base_url(),
						    'path'   => base_url().'admin'
						);

						setcookie("remember_me", md5($result->MemberId.''.$result->UserName), time() + (60 * 2), '/');

						if(isset($_COOKIE['remember_me'])) {
							
							$array['cookiee'] = $_COOKIE['remember_me'];
							$condition="cookiee=". "'".md5($result->MemberId.''.$result->UserName)."'";
							
						}

						
					}

					$this->session->set_userdata($array);
					$this->session->set_flashdata('success_message', 'Login Successfully');
					redirect('admin');
					
					
				} else {
				
					$this->session->set_flashdata('error_message', 'Invalid Username or Password');
					$this->load->view('admin/login');
				}
			}
		}
		else {
			
			if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		       redirect('admin');
			} 
			else {
				
				// if(isset($_COOKIE)) {
				// 	$condition='';
				// 	$result = $this->common_model->GetResults($condition,'test');
					
				// 	$array = array(
				// 		"logged_in" => $result[0]->logged_in,
				// 		"full_name" => $result[0]->full_name,
				// 		"MemberID" => $result[0]->MemberId
				// 	);
				// 	$this->session->set_userdata($array);
		  //       	$this->load->view('admin/dashboard'); 
		  //       } 
		  //       else {
				// $Randomword =rand('111111','999999');
				// $this->session->unset_userdata('captchaword');
				// $this->session->set_userdata('captchaword', $Randomword);
			
				// $vals = array(
				// 'word' => $Randomword,
		  //       'img_path' => './captcha/',
		  //       'img_url' => base_url().'captcha/',
		  //       'img_width' => '120',
		  //   	'img_height' => '40',
		  //   	'expiration' => 7200
		  //       );


				// $captcha = create_captcha($vals);

				// $this->data['captcha'] = $captcha;
				// print_r($this->data);exit;
				$this->load->view('admin/login');	
				//}
		    }
			

		}
		
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('admin/login');
	}

	public function username_check($str)
	{
		
		$condition = "UserName =" . "'" . $str . "'";
		$UserName = $str;
		$this->db->select('UserName');
		$this->db->from('arm_members');
		$this->db->where($condition);

		$query = $this->db->get();
		if ($query->num_rows()>0) 
			return true;
		else{
			$this->form_validation->set_message('username_check', '<p><em class="state-error1">This invalid details of %s</em></p>');
			return false;
		}
		
	}

	public function captcha_check($str)
	{
		$this->load->library('recaptcha');
		$response = $this->recaptcha->verifyResponse($str);
		if (isset($response['success']) and $response['success'] === true) {
			return true;  
		}
		else
		{	
			$this->form_validation->set_message('captcha_check', ucwords($this->lang->line('errorcaptcha')));
			return false;
		}

	}

	// public function password_check($str)
	// {
		
	// 	$condition = "UserName =" . "'" . $str . "'";
	// 	$UserName = $str;
	// 	$this->db->select('UserName');
	// 	$this->db->from('arm_members');
	// 	$this->db->where($condition);

	// 	$query = $this->db->get();
	// 	if ($query->num_rows()>0) 
	// 		return true;
	// 	else{
	// 		$this->form_validation->set_message('username_check', '<p><em class="state-error1">This invalid details of %s</em><p>');
	// 		return false;
	// 	}
		
	// }
	
}
