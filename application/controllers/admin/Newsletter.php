<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Newsletter_model');
		$this->load->model('admin/Smtpsetting_model');
		$this->lang->load('newsletter');
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends


	public function index()
	{
		

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				$list='';
				$mailcheck = count($this->input->post('usermailid'));
				$smtpstatus = $this->Newsletter_model->Checksmtp('smtpstatus');
				if(count($this->input->post('usermailid'))>0)
 				$list = implode(",",$this->input->post('usermailid'));

 				$subject = $this->input->post('subject');
 				$message = $this->input->post('message');
 				
 				$body =
						'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						    <meta http-equiv="Content-Type" content="text/html; charset='.strtolower(config_item('charset')).'" />
						    <title>'.html_escape($subject).'</title>
						    <style type="text/css">
						        body {
						            font-family: Arial, Verdana, Helvetica, sans-serif;
						            font-size: 16px;
						        }
						    </style>
						</head>
						<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
						'.$message.'
						</body>
						</html>';
 				


				$this->form_validation->set_rules('usermailid', 'usermailid', 'trim|xss_clean|callback_usermail_check['.$mailcheck.']');
				$this->form_validation->set_rules('subject', 'subject', 'trim|required');
				$this->form_validation->set_rules('message', 'message', 'trim|required');

				
				

 				if($this->form_validation->run() == true )
 				{
 					$sender = $this->common_model->GetCustomer('1');

 					if($smtpstatus==1)
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
							    $config['protocol']         = "smtp";
							    $config['smtp_host']        = $smtphost;
							    $config['smtp_port']        = $smtpport;
							    $config['mailtype'] 		= 'html';
							    $config['charset']  		= 'utf-8';
							    $config['newline']  		= "\r\n";
							    $config['wordwrap'] 		= TRUE;
								// $this->email->initialize($config);
						$this->email->clear(TRUE);
						$ci = get_instance();
						$ci->load->library('email');
						$ci->email->from($sender->Email, $sender->UserName);
						$ci->email->to($list);
						$ci->email->reply_to($sender->Email, $sender->UserName);
						$ci->email->subject($subject);
						$ci->email->message($body);
						$status = $ci->email->send();
					   	/*print_r($status);*/

 					}
 					else
 					{
 						$ci = get_instance();
						$ci->load->library('email');
 						$this->email->clear(TRUE);
					    $this->email->mailtype('html');
					    $this->email->from($sender->Email, $sender->UserName);
					   	$this->email->to($list); 
					   	$this->email->reply_to($sender->Email, $sender->UserName);
					    $this->email->subject($subject);
					    $this->email->message($message);    
					   	$Mail_status = $this->email->send();
					   	// print_r($Mail_status);

 					}
 					
								
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/newsletter');
					exit;
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['members'] = $this->common_model->GetCustomers();
					
					$this->load->view('admin/newsletter',$this->data);
				}

				
			}
			else
			{
				
				$this->data['members'] = $this->common_model->GetCustomers();

				$this->load->view('admin/newsletter',$this->data);
				
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends

	public function usermail_check($str,$numbers)
	{
		
		
		$flag=0;
		
		
			if($numbers<=0)
			{
				$flag=1;
			}
			

		if ($flag==0) 
			{
			
				return true; 
				}
		else{
			
			$this->form_validation->set_message('usermail_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('selectuser')).' field values are not selected </em></p>');
			return false;
		}
		
	}


	} //class ends


