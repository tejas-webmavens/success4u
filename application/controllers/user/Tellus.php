<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tellus extends CI_Controller {

	public function __construct() {

		parent::__construct();

		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		
			// Load database
			
			
			$this->load->model('admin/Smtpsetting_model');
			$this->load->library('pagination');

			// load language
			// load language
			$this->lang->load('user/ticket',$this->session->userdata('language'));
			$this->lang->load('user/common',$this->session->userdata('language'));
		} else {
			redirect('user');
		}		

	}

	public function index() {
		$invitation_limit = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='invitationlimit'","arm_setting");
		$condition = "isDelete ='0'";
		$this->data['tellus'] = $this->common_model->GetRow($condition, 'arm_tellus');
		$this->data['member'] = $this->common_model->GetCustomer($this->session->MemberID);
		$this->load->view('user/tellusfriend',$this->data);
	}

	public function add() {

		if($this->input->post()) {

			
			$user = $this->common_model->GetCustomer($this->session->userdata('MemberID'));

			$smtpstatus = $this->Smtpsetting_model->Getdata('smtpstatus');
			$smtpmail = $this->Smtpsetting_model->Getdata('smtpmail');
			$smtppassword = $this->Smtpsetting_model->Getdata('smtppassword');
			$smtpport = $this->Smtpsetting_model->Getdata('smtpport');
			$smtphost = $this->Smtpsetting_model->Getdata('smtphost');
			$maillimit = $this->Smtpsetting_model->Getdata('mail_limit');

			if($smtpstatus) {

				if($maillimit < 6) {

					$config = array();
					$config['protocol'] 		= "sendmail";
				    $config['useragent']        = "CodeIgniter";
				    $config['mailpath']         = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
				    $config['protocol']         = "smtp";
				    $config['smtp_host']        = $smtphost;
				    $config['smtp_port']        = $smtpport;
				    $config['mailtype'] 		= 'html';
				    $config['charset']  		= 'utf-8';
				    $config['newline']  		= "\r\n";
				    $config['wordwrap'] 		= TRUE;
					$this->email->clear(TRUE);

					$mydata = $this->input->post('message');
					
					// $mydata = array('message' => 'Please register account');
			

				    $message = $this->common_model->GetRow("Page='tellafriend'","arm_emailtemplate");
				    $site = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'","arm_setting");
						$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");
                    
                    $emailcont = urldecode($message->EmailContent);
					   		 // echo "<br>1 time => <br>".$emailcont ;
					   $logo = '<img src="'.base_url().$site->ContentValue.'">';
					   	$emailcont = str_replace('[LOGO]', $logo, $emailcont);
					   	$emailcont = str_replace('[DATE]', date("d M Y H:i:s A"), $emailcont);
					   	$emailcont = str_replace('[SITENAME]', $sitename->ContentValue, $emailcont);
					   	$emailcont = str_replace('[MESSAGE]', $mydata, $emailcont);      
					   	$emailcont = str_replace('[URL]', base_url().'user/register/?ref='.$user->ReferralName, $emailcont);      
					   // print_r($message);exit;
					   		// echo "<br> time => <br>".$emailcont ;
					   	 
					   	$this->email->from($smtpmail, $sitename->ContentValue);
					  // print_r($this->input->post('email'));	
					if(sizeof($this->input->post('email'))>1)
					{
				    	foreach ($this->input->post('email') as $key => $value) {
				    		
				    			
				    			$to_mailid = $value;
				    			$this->email->to($value);
				    			
				    		
				    		//print_r($this->email->to($value));
				    	
				    			
						}
						
						//print_r($this->email->to($value));
				    			//exit();
						
						$cc_mail_list = str_replace($to_mailid, '', json_encode($this->input->post('email')));

						$cc_mail_lists = array_filter(json_decode($cc_mail_list));
						$this->email->cc($cc_mail_lists);
				        }
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
								<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
								'.$emailcont.'
								</body>
								</html>';
						// echo "<br>2 nd time ==><br>".$body; exit;
								
				    	$this->email->message($body); 
				    $this->email->set_mailtype("html");
				    // $this->email->mailtype('html');
				    
			
				    $Mail_status = $this->email->send();
				    if($Mail_status) {
				    	$this->session->set_flashdata('success_message', 'Success! Your message sent to your friend');
						redirect('user/tellus');
				    } else {
						$error_mail = $this->email->print_debugger();
						
				    	$this->session->set_flashdata('error_message', $error_mail);

						redirect('user/tellus');
				    }
				} else {
					$this->session->set_flashdata('error_message', 'You reached day mail limits');
					redirect('user/tellus');
				}
			} else {
				$this->session->set_flashdata('error_message', 'Mail setting not enabled');
				redirect('user/tellus');
			}

			
		} else {
			redirect('user/tellus');
		}
		
	}
	
}

?>