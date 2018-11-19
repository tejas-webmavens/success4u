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
		// $this->load->helper('cookie');

		// Load database
		$this->lang->load('user/login',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		
		$this->load->model('admin/testimonial_model');
		$this->load->model('admin/Smtpsetting_model');
		$this->load->helper('sms');
		$this->load->helper('subscription');
		$banned = $this->common_model->CheckIP();
		if($banned) {
			$this->session->set_flashdata('error_message', $this->lang->line('errorbanned'));
			redirect('user');
		}

		$siteset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitestatus'", "arm_setting");
		if($siteset->ContentValue=="Off")
		{
			redirect("offsite"); exit;
		}
		
		$regset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='allowlogin'", "arm_setting");
			
		if($regset->ContentValue=="Off")
		{
			redirect("user");
			exit;
		}
		
	}

	

	public function index()
	{
		$siteset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitestatus'", "arm_setting");
		if($siteset->ContentValue=="Off")
		{
			redirect("offsite"); exit;
		}
		
	   $subset = $this->common_model->GetRow("Page='usersetting' AND KeyValue='subscriptionstatus'", "arm_setting");
	   if($subset->ContentValue==1)
	   {
			checksubscription();

	   }
		

		$regset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='allowlogin'", "arm_setting");
			
		if($regset->ContentValue=="Off")
		{
			redirect("user");
			exit;
		}
		
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_password_check');
			$captchaset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='usecaptcha'", "arm_setting");
		 	if($captchaset->ContentValue=="On") {
			 	$this->form_validation->set_rules('g-recaptcha-response', 'captcha', 'trim|required|xss_clean|callback_captcha_check');
		 	}

			if ($this->form_validation->run() == FALSE) {
				$error = str_replace('<p><em class="state-error1">','',validation_errors());
				$error = str_replace('</em></p>','<br/>',$error);
				$this->session->set_flashdata('error_message',$error);
				
				$this->load->view('user/login');
			} else {
				$data = array(
					'username' => $this->input->post('username'),
					/* 'password' => hash_hmac("sha256", $this->input->post('password'), "secret", true) */
					'password' => SHA1(SHA1($this->input->post('password')))
				);

				$result = $this->common_model->login($data);
				
				if ($result) {

					if(strtolower($result->SubscriptionsStatus)=='free')
					{
						$unpaid = array(
							"free_mem_id" => $result->MemberId
						);
						$this->session->set_userdata($unpaid);
						redirect("user/register/payment/".$result->MemberId);
						exit;

					}  else {

						if($subset->ContentValue=="1") {


						 	 // checksubscription();
		

							if($result->MemberId!='2') {

								$substs=checkmembersubscription($result->MemberId);
								
								if($substs)
								{
									$unpaid = array(
										"sub_mem_id" => $result->MemberId
									);
									$this->session->set_userdata($unpaid);

									echo "Pay status : ".$substs;
									
									redirect("user/register/subscription/".$result->MemberId);
									exit;
								}
							}
						}

						if($result->LoggedIn=='0') {
							$this->session->set_userdata('first_login',TRUE);
						}
					}

					$userarray = array(
						"UserId" => $result->MemberId,
						"LoginDate" => date('Y-m-d H:i:s'),
						"LoggedIn" => '1'
					);
					
					$array = array(
						"logged_in" => TRUE,
						"full_name" => $result->FirstName.' '.$result->MiddleName.''.$result->LastName,
						"MemberID" => $result->MemberId,
						"ReferralName"=>$result->ReferralName,

						"Email" => $result->Email
					);

					switch ($result->UserType) {
						case '1':
							if($result->MemberId=='0')
							{
								$array['admin_login'] = TRUE;
								$array['user_login'] = FALSE;
							}
							else
							{
								$array['admin_login'] = TRUE;
								$array['user_login'] = FALSE;
							}
							
							break;
						case '2':
							$array['subadmin_login'] = TRUE;
							break;
						case '3':
							$array['user_login'] = TRUE;
							$array['admin_login'] = FALSE;
							$this->db->insert('arm_member_activity', $userarray);

							break;
						case '4':
							$array['guest_login'] = TRUE;
							break;
					}

					$this->session->set_userdata($array);
					if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
						if($result->LoggedIn=='0') {
							$this->db->where("MemberId", $result->MemberId);
							
        					$this->db->update('arm_members', array('LoggedIn' => '1'));
							
							$this->load->view('user/welcome');
						} else{
							redirect('user/dashboard');
						}
					} else {
						echo 'not login'; exit;
						redirect('user/login');
					}

				} else {
					$this->session->set_flashdata('error_message', 'Invalid Username or Password');
					$this->load->view('user/login');
				}
			}
		}
		else {
			
			if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
				$this->data['testimonial'] = $this->testimonial_model->GetTestimonialall();
		        $this->load->view('user/dashboard',$this->data);
			} 
			else {
				$this->load->view('user/login');
		    }

		}
		
	}

	public function logout() {
		$this->db->delete('arm_member_activity', array('UserId' => $this->session->userdata('MemberID')));
		$this->session->sess_destroy();
		redirect('');
	}

	public function forgot()
	{
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('usermail', 'usermail', 'trim|required|valid_email|callback_useremail_check');
			if ($this->form_validation->run() == FALSE) 
			{

				$smtpstatus = $this->Smtpsetting_model->Getdata('smtpstatus');
				$smtpmail = $this->Smtpsetting_model->Getdata('smtpmail');
				$smtppassword = $this->Smtpsetting_model->Getdata('smtppassword');
				$smtpport = $this->Smtpsetting_model->Getdata('smtpport');
				$smtphost = $this->Smtpsetting_model->Getdata('smtphost');
				$maillimit = $this->Smtpsetting_model->Getdata('mail_limit');

				$config = array();
						$config['protocol'] 		= "sendmail";
					    $config['useragent']        = "CodeIgniter";
					    $config['mailpath']         = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
					    $config['smtp_host']        = $smtphost;
					    $config['smtp_port']        = $smtpport;
					    $config['mailtype'] 		= 'html';
					    $config['charset']  		= 'utf-8';
					    $config['newline']  		= "\r\n";
					    $config['wordwrap'] 		= TRUE;
						// $this->email->initialize($config);
						$this->email->clear(TRUE);
						$user = $this->common_model->GetRow("Email='".$this->input->post('useremail')."' AND MemberStatus='Active'","arm_members");

						if($user)
						{

						$string = "ACDEFGHJKMNPQRTZXYW123456789";
						$count = strlen($string);
						$randomstring='';
						for($x=1;$x<=7;$x++)
						{ 
							$pos = rand(0,$count);
				        	$randomstring.= substr($string,$pos,1); 

						}

							$data = array(
									'password' => SHA1(SHA1($randomstring))
								);
						$mupdate = $this->common_model->UpdateRecord($data,"MemberId='".$user->MemberId."'","arm_members");

						$message = $this->common_model->GetRow("Page='forgotpassword'","arm_emailtemplate");
						$site = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'","arm_setting");
						$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");
				   		

					   	$emailcont = urldecode($message->EmailContent);
					   		 // echo "<br>1 time => <br>".$emailcont ;
					   	$logo = '<img src="'.base_url().$site->ContentValue.'">';
					   	$emailcont = str_replace('[LOGO]', $logo, $emailcont);
					   	$emailcont = str_replace('[DATE]', date("d M Y H:i:s A"), $emailcont);
					   	$emailcont = str_replace('[FIRSTNAME]', $user->UserName, $emailcont);
					   	$emailcont = str_replace('[USERNAME]', $user->UserName, $emailcont);
					   	$emailcont = str_replace('[PASSWORD]', $randomstring, $emailcont);
					   	$emailcont = str_replace('[URL]', base_url(), $emailcont);     
					   	// print_r($emailcont);
					   	// exit; 

					    //print_r($message);exit;
					   		// echo "<br> time => <br>".$emailcont ;
					   	 
					   	$this->email->from($smtpmail, $sitename->ContentValue);
					   	$this->email->to($this->input->post('useremail'));
						$this->email->subject($message->EmailSubject);
						$body =
								'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html xmlns="http://www.w3.org/1999/xhtml">
								<head>
								    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
								    <title>Register Member Details</title>
								    <style type="text/css">
								        body {
								            font-family: Arial, Verdana, Helvetica, sans-serif;
								            font-size: 16px;
								        }
								    </style>
								</head>
								<body>
								'.$emailcont.'
								</body>
								</html>';
						// echo "<br>2 nd time ==><br>".$body; exit;
				    	$this->email->message($body); 
					$this->email->set_mailtype("html");

				    	// print_r($this->email);exit;
				    	$Mail_status = $this->email->send();
				    	$smscontent = $this->common_model->GetRow("Page='forgotpassword'","arm_smstemplate");
						$smscont = urldecode($message->EmailContent);
						$smscont = str_replace('[FIRSTNAME]', $this->input->post('UserName'), $smscont);
					   	$smscont = str_replace('[USERNAME]', $this->input->post('UserName'), $smscont);
					   	$smscont = str_replace('[PASSWORD]', $this->input->post('Password'), $smscont);
					   	
				    	//send sms by bulksms
						// $smsresult = sendbulksms($user->Phone,$smsconts);
				    	if($Mail_status) {
					    	// echo "<br>mail sent";
					    	$this->session->set_flashdata('success_message', $this->lang->line('successforgot'));
						$this->load->view('user/forgotpassword');

							// redirect('admin/customers');
					    } else {
							$error_mail = $this->email->print_debugger();
					    	$this->session->set_flashdata('error_message', $error_mail);
							// redirect('admin/customers');
						$this->load->view('user/forgotpassword');


					    }
					}
					else{
						$this->session->set_flashdata('error_message', $this->lang->line('errorforgot'));
						$this->load->view('user/forgotpassword');
					}
			}
			else
			{
				$this->session->set_flashdata('error_message', $this->lang->line('errorforgot'));
				$this->load->view('user/forgotpassword');
			}
			// exit;

		}
		else
		{
				$this->load->view('user/forgotpassword');

		}
	}


	public function useremail_check($str)
	{
		
		$condition = "Email =" . "'" . $str . "' AND  MemberStatus='Active'";
		
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);

		$query = $this->db->get();
		
		if ($query->num_rows()>0) 
			return true;
		else{
			$this->form_validation->set_message('useremail_check', $this->lang->line('errorforgot'));
			return false;
		}
		
	}
	public function username_check($str)
	{
		if(valid_email($str))
			$condition = "Email =" . "'" . $str . "'";
		else
			$condition = "UserName =" . "'" . $str . "'";

		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);

		$query = $this->db->get();
		
		if ($query->num_rows()>0) 
			return true;
		else{
			$this->form_validation->set_message('username_check', 'This invalid details of %s');
			return false;
		}
		
	}
	public function password_check($str)
	{
		
		if(valid_email($str))
			$condition = "Email =" . "'" . $this->input->post('username'). "'" AND "Password='" .sha1(sha1($this->input->post('password'))). "'";
		else
			$condition = "UserName =" . "'" . $this->input->post('username'). "'" AND "Password='" .sha1(sha1($this->input->post('password'))). "'";
		
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);

		$query = $this->db->get();
		
		if ($query->num_rows()>0) 
			return true;
		else{
			$this->form_validation->set_message('password_check', '<p><em class="text-danger">This invalid details of %s</em></p>');
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
		// if( strcmp(strtoupper($this->input->post('captcha')),strtoupper($this->session->captchaword))==0)
		// {
		// 	return true; 
		// }
		else
		{	
			$this->form_validation->set_message('captcha_check', ucwords($this->lang->line('errorcaptcha')));
			return false;
		}

	}
	
	
}
