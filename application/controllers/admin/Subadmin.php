<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subadmin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('admin_login')) {
		// if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			// Load database
			
			$this->load->model('admin/Smtpsetting_model');
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('subadmin');
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
		$this->data['subadmin'] = $this->common_model->GetSubadmin();
		$this->load->view('admin/subadmin', $this->data['subadmin']);
	}

	public function add($MemberId='')
	{

		if($this->input->post()) {

			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|xss_clean');
			if($this->input->post('memberid')=='') {
				$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[arm_members.Email]|xss_clean');
				$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[arm_members.UserName]|min_length[5]|max_length[16]|xss_clean');
			}
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean|min_length[10]|max_length[13]');
			
			if ($this->form_validation->run() == TRUE) {

				if($this->input->post('memberid')) {
					
					$data = array(
						
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'phone' => $this->input->post('phone')
					);
					$condition = "MemberId =" . "'" . $this->input->post('memberid') . "'";
					$status = $this->common_model->UpdateRecord($data, $condition, 'arm_members');

					if($status) {
						$list = json_encode($this->input->post('permission'));
						$access_condition = "UserId =" . "'" . $this->input->post('memberid') . "'";

						$access_data = array(
							'access_list' => $list
						);
						$status1 = $this->common_model->UpdateRecord($access_data, $access_condition, 'arm_user_permission');

					}

				}  else {

					$data = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'password' => SHA1(SHA1($this->input->post('password'))),
						'phone' => $this->input->post('phone'),
						'UserType' => '2',
						'DateAdded' =>  date('Y-m-d h:i:s')
					);

					$status = $this->common_model->SaveRecords($data, 'arm_members');
					if($status) {
						$per=$this->input->post('permission');
						
						if($per=='')
						{
							$per1=["Customers","Mtapay"];
							$list = json_encode($per1);

						}
						else
						{
							$per=$this->input->post('permission');
							$list = json_encode($per);
						}
						
						$userId = $this->db->insert_id();
						
						$access_data = array(
							'UserId'	=>	$userId,
							'UserLevel'	=>	'2',
							'access_list' => $list
						);
						$status1 = $this->common_model->SaveRecords($access_data, 'arm_user_permission');
					
					}

				}

				if($status1){
					$this->session->set_flashdata('success_message', 'Success! Sub admin details Updated');
					redirect('admin/subadmin');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! Sub admin details not Updated');
					$this->load->view('admin/addsubadmin');		
				}
				
			} else {
				$cus = array('dashboard');
				$data['pages'] = $cus;
				$this->load->view('admin/addsubadmin', $data);
			}
		} else {
			if($MemberId) {
				$data['member'] = $this->common_model->GetCustomer($MemberId);
				$access_list_data = $this->common_model->Subadminaccess($MemberId,'2');
				
				if($access_list_data->access_list!='null') {
					$data['pages'] = json_decode($access_list_data->access_list);
				}
				else {
					$cus = array('dashboard');
					$data['pages'] = $cus;
				}
				
				$this->load->view('admin/addsubadmin', $data);
			} else {
				$cus = array('dashboard');
				$data['pages'] = $cus;
				$this->load->view('admin/addsubadmin', $data);
			}
		}
	   
	}

	public function profile($MemberId='') {
		
		if($MemberId){
			$data['profile'] = $this->common_model->GetCustomer($MemberId);
			$user_profile = $data['profile'];
			if($user_profile->UserType==2) {
				$data['subadmin'] = 1;
			} else {
				$data['subadmin'] = 0;
			}
		}
		else {
			$data['profile'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			$data['subadmin'] = 0;
		}
		

		$this->load->view('admin/profile', $data);
	    
	}

	public function delete($MemberId) {
		$status = $this->common_model->DeleteCustomer($MemberId);
		if($status) {
			$condition = "UserId='".$MemberId."'";
			$this->common_model->DeleteRecord($condition, 'arm_user_permission');
			redirect('admin/subadmin');
		}
		
	}
	public function Passwordreset($MemberId)
	{
		if($this->input->post()) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]|matches[confirmPassword]|xss_clean');
			$this->form_validation->set_rules('confirmPassword', 'confirmPassword', 'trim|required|min_length[6]|max_length[16]|xss_clean');
			if ($this->form_validation->run() == TRUE) {

				$data = array(
					'password' => SHA1(SHA1($this->input->post('password')))
				);
				
				$status = $this->common_model->UpdateRecord($data, $MemberId);
				if($status) {
					redirect('admin/subadmin');
				}

			}
		} else {
			
			$data['restpassword'] = $this->common_model->GetCustomer($MemberId);
			$this->load->view('admin/resetpassword', $data);
			
		}
	}

	public function active($MemberId) {
		$condition = "MemberId =" . "'" . $MemberId . "'";

		$data = array(
			'MemberStatus' => 'Active'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_members');
		if($status) {
			redirect('admin/subadmin');
		}
	}

	public function inactive($MemberId) {
		$condition = "MemberId =" . "'" . $MemberId . "'";

		$data = array(
			'MemberStatus' => 'Inactive'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_members');
		if($status) {
			redirect('admin/subadmin');
		}
	}

	public function reset($id)
	{
		$user = $this->common_model->GetCustomer($id);
		// $user->Email;
		$string = "ACDEFGHJKMNPQRTZXYW123456789";
		$count = strlen($string);
		$randomstring='';
		for($x=1;$x<=7;$x++)
		{ 
			$pos = rand(0,$count);
        	$randomstring.= substr($string,$pos,1); 

		}
			
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
	    // $config['protocol']         = "smtp";
	    $config['smtp_host']        = $smtphost;
	    $config['smtp_port']        = $smtpport;
	    $config['mailtype'] 		= 'html';
	    $config['charset']  		= 'utf-8';
	    $config['newline']  		= "\r\n";
	    $config['wordwrap'] 		= TRUE;
		// $this->email->initialize($config);
		$this->email->clear(TRUE);


		$message = $this->common_model->GetRow("Page='passwordreset'","arm_emailtemplate");
		$site = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'","arm_setting");
   	
	   	$emailcont = urldecode($message->EmailContent);
	   		
	   	$logo = '<img src="'.base_url().$site->ContentValue.'">';
	   	$emailcont = str_replace('[LOGO]', $logo, $emailcont);
	   	$emailcont = str_replace('[DATE]', date("d M Y H:i:s A"), $emailcont);
	   	$emailcont = str_replace('[FIRSTNAME]', $user->UserName, $emailcont);
	   	$emailcont = str_replace('[USERNAME]', $user->UserName, $emailcont);
	   	$emailcont = str_replace('[PASSWORD]', $randomstring, $emailcont);
	   	$emailcont = str_replace('[URL]', base_url(), $emailcont);      
	    //print_r($message);exit;
	   		// echo "<br> time => <br>".$emailcont ;

	    // $this->email->mailtype('html');
	    $this->email->from($smtpmail, $sitename->ContentValue);
	    $this->email->to($user->Email); 

	    $this->email->subject($message->EmailSubject);
    	$body ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
					<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
					'.$emailcont.'
					</body>
					</html>';
					// echo "<br>2 nd time ==><br>".$body; exit;
		$this->email->message($body);
   		$Mail_status = $this->email->send();
    				
    	if($Mail_status) {
    		$data = array(
				'password' => SHA1(SHA1($randomstring))
			);
			$mupdate = $this->common_model->UpdateRecord($data,"MemberId='".$id."'","arm_members");
    	
    		$this->session->set_flashdata('success_message', 'Success! selected user password Reseted');
			redirect('admin/subadmin');
	    } else {
			$error_mail = $this->email->print_debugger();
	    	$this->session->set_flashdata('error_message', $error_mail);
			redirect('admin/subadmin');
	    }
	    
	}
	public function DeleteAll() {
		if($this->input->post('subadmin')) {
			foreach ($this->input->post('subadmin') as $key => $mvalue) {
				if($mvalue) {
					$status = $this->db->query("DELETE FROM arm_members WHERE MemberId='".$mvalue."' ");
				}
			}
			if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected subadmin removed');
				redirect('admin/subadmin');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected subadmin not removed. '.$ermsg );
				redirect('admin/subadmin');
			}
			
		} 
		else {
			redirect('admin/subadmin');
		}
	}
}
