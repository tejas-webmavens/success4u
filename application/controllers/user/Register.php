<?php
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('user_login')) {
		//$this->load->helper('url');
		
		$this->load->model('admin/Smtpsetting_model');
		$this->lang->load('register');
		$this->load->model('MemberCommission_model');
		$this->load->model('Memberboardprocess_model');
		$this->load->model('admin/paymentsetting_model');
		$this->load->helper('sms');
		$banned = $this->common_model->CheckIP();
		if($banned) {

			redirect('user');
		}
		
		$regset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='allowregistration'", "arm_setting");
			
		if($regset->ContentValue=="Off")
		{
			redirect("user");
			exit;
		}
		
		// load language
		}  elseif($this->input->get('ref')){

			if($this->input->get('ref')) {
	        	$this->session->unset_userdata('user_login');
	           	$this->load->model('admin/Smtpsetting_model');
				$this->lang->load('register');
				$this->load->model('MemberCommission_model');
				$this->load->model('Memberboardprocess_model');
				$this->load->helper('sms');
			}
		
		}	else {

	    	redirect('user/dashboard');
	    	
	    }
		

	}

	/*public function index($name='')
	{
		//echo $this->uri->segment(3);
		if($this->input->get('ref'))
		{
			$name = $this->input->get('ref');
		}
		$this->process($name);
	}*/

	public function index($name='')
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
		   	   

		// $regset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='allowregistration'", "arm_setting");
			
		// if($regset->ContentValue=="Off") {

		// 	redirect("user");
		// 	exit;
		// }

		if($this->input->get('ref')) {

			$name = $this->input->get('ref');
			$uplineid = $this->input->get('ref');

			if($this->input->get('P') == 'L'){
				$position = 'Left';
			}
			else{
				$position = 'Right';
			}
		}
		
		if($name=='') {

			$defuser = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='defaultsponsors'", "arm_setting");
			$rcondition = " MemberId='".$defuser->ContentValue."'";
			$rdetails = $this->common_model->GetRow($rcondition,"arm_members");	
			$name = $rdetails->ReferralName;
			$uplineid = "";
			$position = '';
		}


		
		if($this->input->post('reg')!='') {
			
			$rcondition = " ReuireFieldStatus ='1' AND FieldEnableStatus ='1'  order by FieldPosition ASC";
			$rtableName = 'arm_requirefields';

			$rccondition = " ReuireFieldStatus ='1' AND FieldEnableStatus ='1' AND ReuireFieldName NOT IN ('UserName','Password','Phone','Email')";

			$requirefields = $this->common_model->GetResults($rccondition, $rtableName);

			foreach ($requirefields as $reqrows) {
				
			 	$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required');

				if($reqrows->ReuireFieldName=='FirstName' || $reqrows->ReuireFieldName=='LastName' || $reqrows->ReuireFieldName =='MiddleName' )  {
					$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|callback_alphaspace');
				} elseif($reqrows->ReuireFieldName =='Zip' || $reqrows->ReuireFieldName =='Phone'  || $reqrows->ReuireFieldName == 'Fax') {
			 		$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|integer');
				} elseif($reqrows->ReuireFieldName =='Gender') {
					$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required');
				} elseif($reqrows->ReuireFieldName=='City' || $reqrows->ReuireFieldName =='bankwirename' ) {
					$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|callback_customAlpha');
				}
			} 

	 		$minst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='minuserpasswordlength'","arm_setting");
	 		$maxst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='maxuserpasswordlength'","arm_setting");

		 	$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|xss_clean|min_length[4]|callback_username_check');
		 	$this->form_validation->set_rules('Password', 'Password', 'trim|required|xss_clean|min_length['.$minst->ContentValue.']|max_length['.$maxst->ContentValue.']|callback_password_check');
		 	$this->form_validation->set_rules('Phone', 'Phone', 'trim|required|integer|xss_clean|min_length[10]|max_length[13]');
		 	$phset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='uniquemobile'", "arm_setting");

		 	if($phset->ContentValue=="On")
		 		$this->form_validation->set_rules('Phone', 'Phone', 'trim|required|integer|xss_clean|min_length[10]|max_length[13]|callback_phone_check');

		 	$this->form_validation->set_rules('RepeatPassword', 'RepeatPassword', 'trim|required|xss_clean|min_length['.$minst->ContentValue.']|max_length['.$maxst->ContentValue.']');
		 	// $this->form_validation->set_rules('SponsorName', 'SponsorName', 'trim|required|xss_clean|callback_sponsorname_check');
		 	// $this->form_validation->set_rules('PackageId', 'PackageId', 'trim|required');
		 	$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|callback_email_check');
		 	$this->form_validation->set_rules('terms', 'terms & conditions', 'trim|required');

		 	$captchaset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='usecaptcha'", "arm_setting");
		 	if($captchaset->ContentValue=="On"){
		 		$this->form_validation->set_rules('g-recaptcha-response', 'g-recaptcha-response', 'required|callback_captcha_check');
		 	}
		 	// $this->form_validation->set_rules('captcha', 'captcha', 'trim|required|xss_clean|callback_captcha_check');

			$ipset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='uniqueip'", "arm_setting");
			if($ipset->ContentValue=="On")
				$this->form_validation->set_rules('IP', 'Ip address', 'callback_ip_check');
				//binary matrix position check if on 

			$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
		 	if($mlsetting->Id==4 &&  $mlsetting->Position==1 && $mlsetting->MatrixUpline==1) {
		 		$spliover = $this->input->post('uplineid');
		 		$this->form_validation->set_rules('position', 'Select Position', 'trim|required|callback_position_check['.$spliover.']');
		 	} else {
		 		if($mlsetting->Id==4 && $mlsetting->Position==1) {
		 			$this->form_validation->set_rules('position', 'Select Position', 'trim|required');
		 		}
		 	}

		 	if($mlsetting->Id==9 &&  $mlsetting->Position==1 && $mlsetting->MatrixUpline==1) {
		 		$spliover = $this->input->post('uplineid');
		 		$this->form_validation->set_rules('position', 'Select Position', 'trim|required|callback_position_check['.$spliover.']');
		 	} else {
		 		if($mlsetting->Id==9 && $mlsetting->Position==1) {
		 			$this->form_validation->set_rules('position', 'Select Position', 'trim|required');
		 		}
		 	}
			
			if($this->form_validation->run() == TRUE)
			{	

				$memberfields = $this->db->list_fields('arm_members');
				$ccondition = " Page ='register' AND Status='1'";
				$ctableName = 'arm_customfields';
				$cfields = 'CustomName';
				$customfields = $this->common_model->GetResults($ccondition, $ctableName,$cfields);	

				$directid = $this->common_model->getreferralname($this->input->post('SponsorName'));
				$SpilloverId = $this->common_model->getreferralname($this->input->post('uplineid'));
				$mlmdata= array('DirectId' => $directid);
				if($mlsetting->Id==9)
				{
					$data = array('SubscriptionsStatus' => 'Active','DirectId' => $directid);
				}
				else
				{
					$data = array('SubscriptionsStatus' => 'Free','DirectId' => $directid);
				}
				

				$condition1 = "UserName =" . "'" . $this->input->post('uplineid') . "'";
				$spillover_details = $this->common_model->GetSponsor($this->input->post('uplineid'), $condition1);

				$data1 = array();
				$fields = $this->input->post();
				

				foreach ($fields as $key => $value) {
					
					if(in_array($key, $memberfields)) {
						if($key=='Password') {
							$data[$key]=SHA1(SHA1($value));
						} else {
							$data[$key]=$value;
						}
					}
					if($customfields) {
						for($i=0; $i<count($customfields); $i++) {
							
							if($key == $customfields[$i]->CustomName) {
								$data1[$key]=$value;
							}

						}
					}
				}
				if($spillover_details){
				$data['SpilloverId'] = $spillover_details->MemberId;

				}else{
				$data['SpilloverId'] = '0';

				}
			
				$data['CustomFields']= json_encode($data1);

				$data['ReferralName']= $this->input->post('UserName');
				$data['MemberStatus']= "Active";

				$data['DateAdded']= date('y-m-d H:i:s');

				$subscriptiontype=$this->common_model->GetRow("KeyValue='subscriptiontype' AND Page='usersetting'","arm_setting");
				if($subscriptiontype->ContentValue=='monthly')
				{
					$period=30;
				}
				else
				{
					$period=365;
				}
				$endate = strtotime("+".$period." day", strtotime($data['DateAdded']));
				$data['EndDate']=date('Y-m-d H:i:s ', $endate);
				$data['StartDate'] = date('Y-m-d H:i:s');

				$data['Ip']	= $_SERVER['REMOTE_ADDR'];
				$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
				if($mlsetting->Id==4 && $mlsetting->Position==1)
					$data['Position']=	$this->input->post('position');
				if($mlsetting->Id==9 && $mlsetting->Position==1)
					$data['Position']=	$this->input->post('position');
				$result = $this->common_model->SaveRecords($data,'arm_members');

				if($result) {

					$userid = $this->db->insert_id();
					$mlmdata['MemberId'] = $userid;
					
					$message = $this->common_model->GetRow("Page='register'","arm_emailtemplate");
					$site = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'","arm_setting");
			   	
				   	$emailcont = urldecode($message->EmailContent);
				   	
				   	$logo = '<img src="'.base_url().$site->ContentValue.'" style="height: 100px; width: 150px;">';
		   			$emailcont = str_replace('[LOGO]', $logo, $emailcont);
				   	$emailcont = str_replace('[FIRSTNAME]', $this->input->post('UserName'), $emailcont);
				   	$emailcont = str_replace('[USERNAME]', $this->input->post('UserName'), $emailcont);
				   	$emailcont = str_replace('[PASSWORD]', $this->input->post('Password'), $emailcont);
				   	$emailcont = str_replace('[URL]', base_url().'index.php?'.$this->input->post('UserName'), $emailcont);
				   	$emailcont = str_replace('[URL]', base_url(), $emailcont);
					$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");


				   	
				  	$adminid = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='adminmailid'","arm_setting");
					$this->email->from($smtpmail, $sitename->ContentValue);
				   	$this->email->to($this->input->post('Email'));
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
			    	$this->email->message($body);    
					$this->email->set_mailtype("html");
				
			    	$Mail_status = $this->email->send();

			    	 
					
				}

				// $Randomword =rand('111111','999999');
				// $this->session->unset_userdata('captchaword');
				// $this->session->set_userdata('captchaword', $Randomword);
			
				// $vals = array(
				// 	'word' => $Randomword,
			 	//  'img_path' => './captcha/',
			 	//  'img_url' => base_url().'captcha/',
			 	//  'img_width' => '120',
			 	//  'img_height' => '40',
			 	//  'expiration' => 7200
		  		// );

				// $captcha = create_captcha($vals);

				// $this->data['captcha'] = $captcha;


				$rcondition = " Page ='register'  order by FieldPosition ASC";
				$rtableName = 'arm_requirefields';

				$this->data['requirefields'] = $this->common_model->GetResults($rcondition, $rtableName);

				
				$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

				if($mlsetting->Id==4) {

					$ptableName ="arm_pv";

				} 
				elseif($mlsetting->Id==9) {

					$ptableName ="arm_hyip";

				} 


				elseif($mlsetting->Id==5 || $mlsetting->Id==8) {

					$ptableName ="arm_boardplan";

				} else {

					$ptableName ="arm_package";
				}
				
				$pcondition = " Status ='1'  order by PackageId ASC";
				$this->data['package'] = $this->common_model->GetResults($pcondition, $ptableName);

				
				$this->data['SponsorName']=$name;
				$this->data['uplineid']=$uplineid;
				$this->data['position']=$position;
				$this->data['country'] = $this->common_model->GetCountry();

				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				$memberpaysts = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');



				if($memberpaysts->FreeMember==1) {
					$data = array(
						'MemberStatus'=>"Active",

					);
					if($memberpaysts->Id==6 && $memberpaysts->MTMPayStatus=='1') {

						$mmdata = $this->common_model->GetRow("MemberId='".$userid."'","arm_members");
						$xmdata = $this->common_model->GetRow("MemberId='".$mmdata->DirectId."'","arm_xupmatrix");
						if($xmdata->XupCount< $memberpaysts->Position) {
							$data['SpilloverId'] = $xmdata->SpilloverId;
							// $xddata = $this->common_model->UpdateRecord("SpilloverId='".$xmdata->SpilloverId."'","MemberId='".$userid."'","arm_members");
						}
						else
						{
							$data['SpilloverId'] = $mmdata->DirectId;

						}
					}
					$this->common_model->UpdateRecord($data,"MemberId='".$userid."'","arm_members");


					
					redirect('login');
					exit;
				} else {


					if($memberpaysts->Id==6 && $memberpaysts->MTMPayStatus=='1') {

						$mmdata = $this->common_model->GetRow("MemberId='".$userid."'","arm_members");
						$xmdata = $this->common_model->GetRow("MemberId='".$mmdata->DirectId."'","arm_xupmatrix");
						if($xmdata){
						   if($xmdata->XupCount< $memberpaysts->Position) {
							$data['SpilloverId'] = $xmdata->SpilloverId;
							// $xddata = $this->common_model->UpdateRecord("SpilloverId='".$xmdata->SpilloverId."'","MemberId='".$userid."'","arm_members");
							}	
						}
						
						else
						{
							$data['SpilloverId'] = $mmdata->DirectId;

						}
					}
					
					$this->common_model->UpdateRecord($data,"MemberId='".$userid."'","arm_members");
					
					$unpaid = array(
						"free_mem_id" => $userid
					);
					$this->session->set_userdata($unpaid);
					redirect('user/register/payment/'.$userid);
				}
			


			} else {

				$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				


				$rcondition = " Page ='register'  order by FieldPosition ASC";
				$rtableName = 'arm_requirefields';

				$this->data['requirefields'] = $this->common_model->GetResults($rcondition, $rtableName);
				$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

				if($mlsetting->Id==4) {

					$ptableName ="arm_pv"; 

				}
				elseif($mlsetting->Id==9) {

					$ptableName ="arm_hyip";

				} 



				 elseif($mlsetting->Id==5 || $mlsetting->Id==8) {

					$ptableName ="arm_boardplan";

				} else {

					$ptableName ="arm_package";

				}

				$pcondition = " Status ='1'  order by PackageId ASC";
			
				$this->data['package'] = $this->common_model->GetResults($pcondition, $ptableName);
				
				$this->data['SponsorName'] = $name;
				$this->data['uplineid'] = $uplineid;
				$this->data['position'] = $position;
				$this->data['country'] = $this->common_model->GetCountry();
			
				$this->load->view('user/register',$this->data);
			}

		} else {

			$Randomword =rand('111111','999999');
			$this->session->unset_userdata('captchaword');
			$this->session->set_userdata('captchaword', $Randomword);
			$vals = array(
				'word' => $Randomword,
		        'img_path' => './captcha/',
		        'img_url' => base_url().'captcha/',
		        'img_width' => '120',
		    	'img_height' => '40',
		    	'expiration' => 7200
	        );

			$captcha = create_captcha($vals);
			$this->data['captcha'] = $captcha;

			$rcondition = " Page ='register'  order by FieldPosition ASC";
			$rtableName = 'arm_requirefields';

			$this->data['requirefields'] = $this->common_model->GetResults($rcondition, $rtableName);
			$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==4) {

				$ptableName ="arm_pv";

			} 

			elseif($mlsetting->Id==9) {

					$ptableName ="arm_hyip";

				} 



			elseif($mlsetting->Id==5 || $mlsetting->Id==8) {

				$ptableName ="arm_boardplan";

			} else {

				$ptableName ="arm_package";

			}

			$pcondition = " Status ='1'  order by PackageId ASC";
			$this->data['package'] = $this->common_model->GetResults($pcondition, $ptableName);
			
			$this->data['SponsorName'] = $name;
			$this->data['uplineid'] = $uplineid;
			$this->data['position'] = $position;
			$this->data['country'] = $this->common_model->GetCountry();
			$this->load->view('user/register',$this->data);
		}

	}


	public function username_check($str)
	{
		
		$condition = "UserName =" . "'" . $str . "'";
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		
		

		if (!$query->num_rows()>0) {
			return true; 
		} else {
			$this->form_validation->set_message('username_check',ucwords($this->lang->line('errorusername')));
			return false;
		}
		
	}

	public function phone_check($str)
	{
		
		$condition = "Phone =" . "'" . $str . "'";
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if (!$query->num_rows()>0) {
			return true; 
		} else {
			$this->form_validation->set_message('phone_check',ucwords($this->lang->line('errorphone')));
			return false;
		}
		
	}


	public function email_check($str)
	{
		
		$condition = "Email =" . "'" . $str . "'";
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if (!$query->num_rows()>0) {
			return true; 
		} else{
			$this->form_validation->set_message('email_check',ucwords($this->lang->line('erroremailid')));
			return false;
		}
		
	}



	public function sponsorname_check($str)
	{
		
		$condition = "ReferralName =" . "'" . $str . "' AND SubscriptionsStatus='Active'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows()>0) {
			return true; 

		} else {
			$this->form_validation->set_message('sponsorname_check', ucwords($this->lang->line('errorsponsorname')));
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

	public function password_check()
	{
		
		if( strcmp($this->input->post('Password'),$this->input->post('RepeatPassword'))==0)
		{
			return true; 
		}
		else
		{	
			$this->form_validation->set_message('password_check',ucwords($this->lang->line('errorpassword')));
			return false;
		}

	}

	public function payment($id='') {
		if($this->session->userdata('free_mem_id') OR $this->session->userdata('free_mem_id') OR $this->session->userdata('user_login')) {

			$this->data['userdetails'] = $this->common_model->GetCustomer($id);
			$this->load->model('admin/paymentsetting_model');
			$this->data['paymentdetails'] = $this->paymentsetting_model->Getpaymentdetails();
			
			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
												
			if($mlsetting->Id==4) {
				$table = "arm_pv";

			}

			elseif($mlsetting->Id==9) {
				$table = "arm_hyip";

			}
			 elseif($mlsetting->Id==5 || $mlsetting->Id==8) {
				$table = "arm_boardplan";

			} else {
				$table='arm_package';
			}
			
			$condition="PackageId='".$this->data['userdetails']->PackageId."'";
			$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

			$this->data['id'] =$id;
			$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
			$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;

			if($this->data['userdetails'] && $this->data['paymentdetails'] && $this->data['packagedetails'] && $mlsetting->MTMPayStatus=='0')
			{
				$this->data['bwcount'] = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('free_mem_id')."' AND EntryFor='MTA' AND AdminStatus='0'","arm_memberpayment");
				$this->load->view('user/regpayment',$this->data);
			}
			else if($this->data['userdetails'] && $this->data['paymentdetails'] && $this->data['packagedetails'] && $mlsetting->MTMPayStatus=='1')
			{
				$this->load->view('user/mtmpayment',$this->data);
			}
			else
			{
				redirect('login');
			}

		} 
		else 
		{
			redirect('login');
		}
	}

	public function subscription($id='')
	{
		
		if($id) {
			$this->data['userdetails'] = $this->common_model->GetCustomer($id);
			
		} else {
			$id = $this->session->userdata('sub_mem_id');
			$this->data['userdetails'] = $this->common_model->GetCustomer($id);
		}
		
		$this->load->model('admin/paymentsetting_model');
		$this->data['paymentdetails'] = $this->paymentsetting_model->Getpaymentdetails();
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
		{
			$table = "arm_pv";
		}
		elseif($mlsetting->Id==5 || $mlsetting->Id==8)
		{
			$table = "arm_boardplan";
		}
		else
		{
			$table='arm_package';
		}

		$condition="PackageId='".$this->data['userdetails']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);

		$this->data['id'] =$id;
		$cdetail=$this->common_model->GetRow("Status='1'",'arm_currency');
		$this->data['CurrencySymbol'] =$cdetail->CurrencySymbol;

		if($this->data['userdetails'] && $this->data['paymentdetails'] && $this->data['packagedetails'] && $mlsetting->MTMPayStatus=='0')
		{
			$this->data['bwcount'] = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('sub_mem_id')."' AND EntryFor='MTAS' AND AdminStatus='0'","arm_memberpayment");
			$this->load->view('user/subpayment',$this->data);
		}
		else if($this->data['userdetails'] && $this->data['paymentdetails'] && $this->data['packagedetails'] && $mlsetting->MTMPayStatus=='1')
		{
			$this->load->view('user/mtmpayment',$this->data);
		}
		else
		{
			redirect('login');
		}
	}

	public function paymentsuccess()
	{
		
		if($this->input->post())
		{
			//print_r($this->input->post());
			$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");

			$checkdata = explode(",",$this->input->post('custom'));
			$memberdetails = $this->common_model->GetCustomer($checkdata[2]);

			$condition = "PackageId='".$memberdetails->PackageId."'";
			$packagedetails = $this->common_model->GetRow($condition,'arm_package');

			//print_r($packagedetails);

			if(strtolower($checkdata[0])=='register' && strtolower($checkdata[1])== 'paypal' && strtolower($checkdata[2])!='' && $mlsetting->MTMPayStatus=='0' )
			{

				if($this->input->post('mc_gross')>= $packagedetails->PackageFee)
				{
					$data = array('SubscriptionsStatus'=>'Active','MemberStatus'=>'Active');
					$condition = "MemberId='".$checkdata[2]."'";
					$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
					if($result)
					{
						$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							
						$field = "MemberId";
						$memberid =$memberdetails->MemberId;
													
						if($mlsetting->Id==1)
						{
							$table = "arm_forcedmatrix";
							$this->Memberboardprocess_model->setforcematrix($memberid,$table);
						}
						else if($mlsetting->Id==2)
						{
							$table = "arm_unilevelmatrix";
							$this->Memberboardprocess_model->setunilevelmatrix($memberid,$table);
						}
						else if($mlsetting->Id==3)
						{
							$table = "arm_monolinematrix";
							$field = "MonoLineId";
							$this->Memberboardprocess_model->setmonolinematrix($memberid,$table);
						}
						else if($mlsetting->Id==4)
						{
							$table = "arm_binarymatrix";
							$this->Memberboardprocess_model->binarymatrix($memberid,$table);
							$this->Memberboardprocess_model->Totaldowncount();
						}
						else if($mlsetting->Id==5)
						{
							$table = "arm_boardmatrix";
							$this->Memberboardprocess_model->setboardmatrix($memberid,$table);
						}
						else if($mlsetting->Id==6)
						{
							$table = "arm_xupmatrix";
							$this->Memberboardprocess_model->setxupmatrix($memberid,$table);
						}
						else if($mlsetting->Id==7)
						{
							$table = "arm_oddevenmatrix";
							$this->Memberboardprocess_model->setoddevenmatrix($memberid,$table);
						}
						else if($mlsetting->Id==8)
						{
							$table = "arm_boardmatrix1";
							$this->Memberboardprocess_model->setboardmatrix1($memberid,$table);
						}
	                    
						// $this->Memberboardprocess_model->process($memberid);
						$this->MemberCommission_model->process($memberid,$table,$field);
						
						$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
						$url = 'login'; echo'<script> window.location.href = "'.base_url().'index.php?/'.$url.'"; </script> ';
					    exit();
					}
					
					$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
				}
				else
				{
					$this->session->set_flashdata('error_message', $this->lang->line('errormessagepayment'));
				}
				
				redirect('login');
			}


			if(strtolower($checkdata[0])=='register' && strtolower($checkdata[1])== 'epin' && strtolower($checkdata[2])!='' )
			{

			}

		}
		
		redirect('login');
	}

	public function checkepin($id='')
	{
		if($this->input->post('check')=='check')
		{			
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$pckdetails = $this->common_model->GetRow("EpinTransactionId='".$this->input->post('epincode')."' AND EpinStatus='1' AND ExpiryDay>='".date('Y-m-d')."' ",'arm_epin');
			
			if($mdetails->SubscriptionsStatus=="Free")
			{
				
				if($pckdetails)
				{
					if($mdetails->PackageId==$pckdetails->EpinPackageId)
					{
					
						$date = date('y-m-d h:i:s');
						$Mdata = array(
							'SubscriptionsStatus'=>'Active',
							'MemberStatus'=>'Active',
							'ModifiedDate'=>$date
						);
						$result = $this->common_model->UpdateRecord($Mdata, "MemberId='".$id."'", 'arm_members');
						if($result)
						{
			
							$edata = array(
								'UsedBy'=>$id,
								'EpinStatus'=>'2',
								'ModifiedDate'=>$date
							);
							$epresult = $this->common_model->UpdateRecord($edata, "EpinRecordId='".$pckdetails->EpinRecordId."'", 'arm_epin');
						

							$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
							$field = "MemberId";
							$memberid = $id;
							if($mlsetting->Id==1)
							{
								$table = "arm_forcedmatrix";
								$this->Memberboardprocess_model->setforcematrix($memberid,$table);
							}
							else if($mlsetting->Id==2)
							{
								$table = "arm_unilevelmatrix";
								$this->Memberboardprocess_model->setunilevelmatrix($memberid,$table);
							}
							else if($mlsetting->Id==3)
							{
								$table = "arm_monolinematrix";
								$field = "MonoLineId";
								$this->Memberboardprocess_model->setmonolinematrix($memberid,$table);
							}
							else if($mlsetting->Id==4)
							{
								$table = "arm_binarymatrix";
								$this->Memberboardprocess_model->binarymatrix($memberid,$table);
							}
							else if($mlsetting->Id==5)
							{
								$table = "arm_boardmatrix";
								$this->Memberboardprocess_model->setboardmatrix($memberid,$table);
							}
							else if($mlsetting->Id==6)
							{
								$table = "arm_xupmatrix";
								$this->Memberboardprocess_model->setxupmatrix($memberid,$table);
							}
							else if($mlsetting->Id==7)
							{
								$table = "arm_oddevenmatrix";
								$this->Memberboardprocess_model->setoddevenmatrix($memberid,$table);
							}
							else if($mlsetting->Id==8)
							{
								$table = "arm_boardmatrix1";
								$this->Memberboardprocess_model->setboardmatrix1($memberid,$table);
							}

							// $this->Memberboardprocess_model->process($memberid);
							$this->MemberCommission_model->process($memberid,$table,$field);
							
							$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
							$url = 'login';
						    echo'<script> window.location.href = "'.base_url().'index.php?/'.$url.'"; </script> ';
						   	exit();
						}
					}
				}
				else
				{
					$this->session->set_flashdata('error_message', $this->lang->line('errormessageepin'));
				}
				
			}
			else
			{
				$this->session->set_flashdata('success_message', $this->lang->line('successmessageactive'));
				$url = 'login';
				echo'<script> window.location.href = "'.base_url().'index.php?/'.$url.'"; </script> ';
				exit();
			}
			
			redirect('user/register/checkepin/'.$id);
			exit;
		}
		
		$this->load->view('user/checkepin');
	}
	

	public function subepin($id='')
	{
		if($this->input->post('check')=='check')
		{			
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$pckdetails = $this->common_model->GetRow("EpinTransactionId='".$this->input->post('epincode')."' AND EpinStatus='1' AND ExpiryDay>='".date('Y-m-d')."' ",'arm_epin');
							
			if($pckdetails)
			{
				if($mdetails->PackageId==$pckdetails->EpinPackageId)
				{
					
					$date = date('y-m-d h:i:s');
					$Mdata = array(
						'SubscriptionsStatus'=>'Active',
						'MemberStatus'=>'Active',
						'ModifiedDate'=>$date
					);
					$result = $this->common_model->UpdateRecord($Mdata, "MemberId='".$id."'", 'arm_members');
					if($result)
					{
			
						$edata = array(
							'UsedBy'=>$id,
							'EpinStatus'=>'2',
							'ModifiedDate'=>$date
						);
						$epresult = $this->common_model->UpdateRecord($edata, "EpinRecordId='".$pckdetails->EpinRecordId."'", 'arm_epin');

						$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
						$field = "MemberId";
						$memberid = $id;
						if($mlsetting->Id==1)
						{
							$table = "arm_forcedmatrix";
							$this->Memberboardprocess_model->setforcematrix($memberid,$table);
						}
						else if($mlsetting->Id==2)
						{
							$table = "arm_unilevelmatrix";
							$this->Memberboardprocess_model->setunilevelmatrix($memberid,$table);
						}
						else if($mlsetting->Id==3)
						{
							$table = "arm_monolinematrix";
							$field = "MonoLineId";
							$this->Memberboardprocess_model->setmonolinematrix($memberid,$table);
						}
						else if($mlsetting->Id==4)
						{
							$table = "arm_binarymatrix";
							$this->Memberboardprocess_model->binarymatrix($memberid,$table);
						}
						else if($mlsetting->Id==5)
						{
							$table = "arm_boardmatrix";
							$this->Memberboardprocess_model->setboardmatrix($memberid,$table);
						}
						else if($mlsetting->Id==6)
						{
							$table = "arm_xupmatrix";
							$this->Memberboardprocess_model->setxupmatrix($memberid,$table);
						}
						else if($mlsetting->Id==7)
						{
							$table = "arm_oddevenmatrix";
							$this->Memberboardprocess_model->setoddevenmatrix($memberid,$table);
						}
						else if($mlsetting->Id==8)
						{
							$table = "arm_boardmatrix1";
							$this->Memberboardprocess_model->setboardmatrix1($memberid,$table);
						}

						// $this->Memberboardprocess_model->process($memberid);
						$this->MemberCommission_model->process($memberid,$table,$field);
							
						$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
						$url = 'login';
					    echo'<script> window.location.href = "'.base_url().'index.php?/'.$url.'"; </script> ';
						
					}

				}
				else
				{
					$this->session->set_flashdata('error_message', $this->lang->line('errormessageepin'));
					redirect('user/register/subepin/'.$id);
				}
			}
			
			redirect('user/login');
			exit;
		}
		
		$this->load->view('user/subepin');
	}
	
	public function checkbankwire($id='')
	{	
		if($this->input->post('checkwire')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mta_check');
		
			$this->form_validation->set_rules($_FILES['referfile'],'referfile', 'trim|required|callback_ext_check');
			
			$admin_img = 'uploads/mtmpay/no-photo.jpg';
			if($_FILES['referfile']['tmp_name']!='')
			{
				if($_FILES['referfile']['type']=='image/jpg' || $_FILES['referfile']['type']=='image/jpeg' || $_FILES['referfile']['type']=='image/png'|| $_FILES['referfile']['type']=='image/gif')
				{
					$ext = explode(".", $_FILES['referfile']['name']);
					$admin_img = "uploads/mtmpay/".$this->input->post('memberid')."-admin.".$ext[1];
					move_uploaded_file($_FILES['referfile']['tmp_name'], $admin_img);
					$fileflag=1;
				}
				else
				{
					$fileflag=0;
					$this->session->set_flashdata('error_message',$this->lang->line('errormtafile'));
					redirect("user/register/checkbankwire/".$id);
				}

			}
			else
			{
				$fileflag=1;
			}

			if($this->form_validation->run() == true && $fileflag==1)	
 			{
 				
				$mempack = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'","arm_members");

			 $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			 if($mlsetting->Id==9)
			 {
			 	$paymentamount=$this->input->post('transactionamount');
			 }
			 else if($mlsetting->Id==4)
			 {
			 	$paymentamount=$this->input->post('amount');
			 }
			 else
			 {
			 	$paymentamount=$this->input->post('amount');
			 }


				$data = array(
					'AdminStatus'=>'0',
					'MemberStatus'=>'1',
					'ReceiveBy'=>'1',
					'EntryFor'=>'MTA',
					'PaymentAmount'=>$paymentamount,
					'PackageId'=>$mempack->PackageId,
					'MemberId'=>$this->input->post('memberid'),
					'APaymentAttachemt'=>$admin_img,
					'APaymentReference'=>$this->input->post('transactionid'),
					'DateAdded'=>date('y-m-d H:i:s')
				);
			
				$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
				$this->session->set_flashdata('success_message',$this->lang->line('successmtamsg'));
				redirect('login');
				exit;
			}
			
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormtamsg'));
			}
				
			$this->data['id'] = $id;
			$this->load->view('user/checkbankwire',$this->data);
			exit;
		}
		
		$this->data['id'] = $id;
		$this->data['amount'] = $this->input->post('amount');
		
		$this->load->view('user/checkbankwire',$this->data);

	
		
	}

	public function checkbitcoin($id='')
	{
	
		if($this->input->post('checkwire')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mta_check');
		
			$this->form_validation->set_rules($_FILES['referfile'],'referfile', 'trim|required|callback_ext_check');
			
			$admin_img = '';
			if($_FILES['referfile']['tmp_name']!='')
			{
				if($_FILES['referfile']['type']=='image/jpg' || $_FILES['referfile']['type']=='image/jpeg' || $_FILES['referfile']['type']=='image/png'|| $_FILES['referfile']['type']=='image/gif')
				{
					$ext = explode(".", $_FILES['referfile']['name']);
					$admin_img = "uploads/mtmpay/".$this->input->post('memberid')."-admin.".$ext[1];
					move_uploaded_file($_FILES['referfile']['tmp_name'], $admin_img);
					$fileflag=1;
				}
				else
				{
					$fileflag=0;
					$this->session->set_flashdata('error_message',$this->lang->line('errormtafile'));
					redirect("user/register/checkbitcoin/".$id);
				}

			}
			else
			{
				$fileflag=1;
			}

			if($this->form_validation->run() == true && $fileflag==1)	
 			{
 				
				$mempack = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'","arm_members");

				$data = array(
					'AdminStatus'=>'0',
					'MemberStatus'=>'1',
					'ReceiveBy'=>'1',
					'EntryFor'=>'MTA',
					'PaymentAmount'=>$this->input->post('amount'),
					'PackageId'=>$mempack->PackageId,
					'MemberId'=>$this->input->post('memberid'),
					'APaymentAttachemt'=>$admin_img,
					'APaymentReference'=>$this->input->post('transactionid'),
					'DateAdded'=>date('y-m-d H:i:s')
				);
				$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
				$this->session->set_flashdata('success_message',$this->lang->line('successmsg'));
				$this->data['message'] = 'This is your bitcoin address to final step for payment.';
	            $this->data['bitcoin'] = $this->paymentsetting_model->Getfielddata(5);
				$guid =	$this->data['bitcoin']->PaymentMerchantId;
				$address = $guid;
				
				$this->session->set_flashdata('success_message','Your Bitcoin Details updated Successfully');
				redirect('login');
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormsg'));
			}
				
			$this->data['id'] = $id;
			$this->load->view('user/payment_confirm',$this->data);
			exit;
		}
		
		$this->data['id'] = $id;
		$this->data['amount'] = $this->input->post('amount');
		$this->data['action'] = base_url().'user/register/checkbitcoin/'.$id;
		$this->load->view('user/checkbitcoin',$this->data);
	
	}

	public function subbankwire($id='')
	{	
	
		if($this->input->post('checkwire')=='check')
		{
			
			$mdetails = $this->common_model->GetRow("MemberId='".$id."'",'arm_members');
			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mta_check');
		
			$this->form_validation->set_rules($_FILES['referfile'],'referfile', 'trim|required|callback_ext_check');
			
			$admin_img = 'uploads/mtmpay/no-photo.jpg';
			if($_FILES['referfile']['tmp_name']!='')
			{
				if($_FILES['referfile']['type']=='image/jpg' || $_FILES['referfile']['type']=='image/jpeg' || $_FILES['referfile']['type']=='image/png'|| $_FILES['referfile']['type']=='image/gif')
				{
					$ext = explode(".", $_FILES['referfile']['name']);
					$admin_img = "uploads/mtmpay/".$this->input->post('memberid')."-admin.".$ext[1];
					move_uploaded_file($_FILES['referfile']['tmp_name'], $admin_img);
					$fileflag=1;
				}
				else
				{
					$fileflag=0;
					$this->session->set_flashdata('error_message',$this->lang->line('errormtafile'));
					redirect("user/register/subbankwire/".$id);
				}

			}
			else
			{
				$fileflag=1;
			}

			if($this->form_validation->run() == true && $fileflag==1)	
 			{
 				
				$mempack = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'","arm_members");

				$data = array(
					'AdminStatus'=>'0',
					'MemberStatus'=>'1',
					'ReceiveBy'=>'1',
					'EntryFor'=>'MTAS',
					'PaymentAmount'=>$this->input->post('amount'),
					'PackageId'=>$mempack->PackageId,
					'MemberId'=>$this->input->post('memberid'),
					'APaymentAttachemt'=>$admin_img,
					'APaymentReference'=>$this->input->post('transactionid'),
					'DateAdded'=>date('y-m-d H:i:s')
				);
				$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
				$this->session->set_flashdata('success_message',$this->lang->line('successmtamsg'));
				redirect('login');
				exit;
			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormtamsg'));
			}
				
			$this->data['id'] = $id;
			$this->load->view('user/subbankwire',$this->data);
			exit;
		}
		
		$this->data['id'] = $id;
		$this->data['amount'] = $this->input->post('amount');
		$this->load->view('user/subbankwire',$this->data);
	
	}


	public function mtmpay()
	{
		if($this->input->post())
		{

			$this->form_validation->set_rules('memberid', 'memberid', 'trim|required|callback_mtm_check');
			
			$rec_img = $admin_img = 'uploads/mtmpay/no-photo.jpg';

			if($_FILES['memberfile']['tmp_name']!='')
			{
				if($_FILES['memberfile']['type']=='image/jpg' || $_FILES['memberfile']['type']=='image/jpeg' || $_FILES['memberfile']['type']=='image/png'|| $_FILES['memberfile']['type']=='image/gif')
				{
					$mftype = explode(".", $_FILES['memberfile']['name']);
					$rec_img = "uploads/mtmpay/".$this->input->post('memberid')."-member.".$mftype[1];
					move_uploaded_file($_FILES['memberfile']['tmp_name'], $rec_img);
					$recflag=1;
				}
				else
				{
					$recflag=0;
					$this->session->set_flashdata('error_message',$this->lang->line('errormtmfile'));
					redirect("user/register/payment/".$this->input->post('memberid'));
				}
			}
			else
			{
				$recflag=1;
			}

			if(isset($_FILES['adminfile']['tmp_name'])){

				if($_FILES['adminfile']['tmp_name']!='')
				{
					if($_FILES['adminfile']['type']=='image/jpg' || $_FILES['adminfile']['type']=='image/jpeg' || $_FILES['adminfile']['type']=='image/png'|| $_FILES['adminfile']['type']=='image/gif')
					{
						$aftype = explode(".", $_FILES['adminfile']['name']);
						$admin_img = "uploads/mtmpay/".$this->input->post('memberid')."-admin.".$aftype[1];
						move_uploaded_file($_FILES['adminfile']['tmp_name'], $admin_img);
						$adminflag=1;
					}
					else
					{
						$adminflag=0;
						$this->session->set_flashdata('error_message',$this->lang->line('errormtmfile'));
						redirect("user/register/payment/".$this->input->post('memberid'));
					}
				}
				else
				{
					$adminflag=1;
				}
		    }
		    else
		    {
		    	$adminflag=1;
		    }

			if($adminflag==1 && $recflag==1) {
				$adminsts=0;
				$mempack = $this->common_model->GetRow("MemberId='".$this->input->post('memberid')."'","arm_members");

				$data = array(
					'AdminStatus'=>$adminsts,
					'MemberStatus'=>'0',
					'EntryFor'=>'MTM',
					'PackageId'=>$mempack->PackageId,
					"PaymentAmount"=>$this->input->post('packagefee'),
					'MemberId'=>$this->input->post('memberid'),
					'ReceiveBy'=>$this->input->post('receiveid'),
					'MPaymentAttachemt'=>$rec_img,
					'MPaymentReference'=>$this->input->post('memberpayid'),
					'APaymentAttachemt'=>$admin_img,
					'APaymentReference'=>$this->input->post('memberpayid'),
					'DateAdded'=>date('y-m-d H:i:s')
				);
				$mtmresult = $this->common_model->SaveRecords($data,"arm_memberpayment");
				$this->session->set_flashdata('success_message',$this->lang->line('successmtmsg'));
				redirect("login");
				exit();
			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormtmsg'));
			}

			redirect("user/register/payment/".$this->input->post('memberid'));
		}
		else
		{
			redirect("user");
		}
	}

	public function setspillover($id)
	{
		$query = $this->db->query("SELECT * FROM arm_setting WHERE Page = 'mlmsetting' AND  KeyValue = 'matrixwidth'");
				
		$width = $query->row()->ContentValue;
		$mcondition = "MemberId='".$id."'";
		$mdetails = $this->common_model->GetRow($mcondition,'arm_members');
		$dcondition = "MemberId='".$mdetails->DirectId."'";
		$ddetails = $this->common_model->GetRow($dcondition,'arm_forcedmatrix');
		$dmcount =$ddetails->MemberCount;
		$date = date('y-m-d h:i:s');
		$mecondition = "MemberId='".$id."'";
		$mecount = $this->common_model->GetRowCount($mecondition,'arm_forcedmatrix');
		
		if(!empty($dmcount))
		{
			if($dmcount<$width)
			{
				$Mdata = array(
					'SpilloverId'=>$mdetails->DirectId,
					'DirectId'=>$mdetails->DirectId,
					'MemberId'=>$id,
					'DateAdded'=>$date
				);
				if(!$mecount)
				{
					$Mresult = $this->common_model->SaveRecords($Mdata,"arm_forcedmatrix");
				
					if($Mresult)
					{
						$Ddata=array('MemberCount'=>$dmcount+1);
						$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_forcedmatrix");
					}
				}
			}
			else
			{
				$query = $this->db->query("SELECT * FROM arm_forcedmatrix WHERE SpilloverId = '".$mdetails->DirectId."' AND MemberCount < '".$width."' order by MemberId asc limit 0,1 ");
				$spillid = $query->row()->MemberId;

				$Mdata = array(
					'SpilloverId'=>$spillid,
					'DirectId'=>$mdetails->DirectId,
					'MemberId'=>$id,
					'DateAdded'=>$date
				);
				if(!$mecount)
				{
					$Mresult = $this->common_model->SaveRecords($Mdata,"arm_forcedmatrix");
						
					if($Mresult)
					{
						$spcondition = "MemberId='".$spillid."'";
						$spdetails = $this->common_model->GetRow($spcondition,'arm_forcedmatrix');
						$smcount =$spdetails->MemberCount;
						$Ddata=array('MemberCount'=>$smcount+1);
						$Scondition = "MemberId='".$spillid."'";
						$Dresult = $this->common_model->UpdateRecord($Ddata,$Scondition,"arm_forcedmatrix");
					}
				}

			}
		}
		else
		{
			$Mdata = array(
				'SpilloverId'=>$mdetails->DirectId,
				'DirectId'=>$mdetails->DirectId,
				'MemberId'=>$id,
				'DateAdded'=>$date
			);
			if(!$mecount)
			{
				$Mresult = $this->common_model->SaveRecords($Mdata,"arm_forcedmatrix");
						
				if($Mresult)
				{
					$Ddata=array('MemberCount'=>$dmcount+1);
					$Dresult = $this->common_model->UpdateRecord($Ddata,$dcondition,"arm_forcedmatrix");

				}
			}
		}
	}

	public function mtm_check()
	{
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->input->post('memberid')."' AND AdminStatus NOT IN ('2','1') AND EntryFor='MTM'","arm_memberpayment");
		
		if($ckip>0)
		{
			$this->form_validation->set_message('mtm_check',ucwords($this->lang->line('errormtm')));
			$this->form_validation->set_message('mtm_check',ucwords($this->lang->line('errormta')));
			return false;
		}
		else
		{
			return true;
		}
		exit;

	}

	public function mta_check()
	{
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->input->post('memberid')."' AND AdminStatus NOT IN ('2','1') AND EntryFor='MTA'","arm_memberpayment");
		
		if($ckip>0)
		{
			$this->form_validation->set_message('mta_check',ucwords($this->lang->line('errormta')));
			return false;
		}
		else
		{
			return true;
		}
		exit;
	}

	public function ip_check()
	{
		$ckip = $this->common_model->GetRowCount("Ip='".$_SERVER['REMOTE_ADDR']."'","arm_members");
		
		if($ckip>0)
		{
			$this->form_validation->set_message('ip_check',ucwords($this->lang->line('errorip')));
			return false;
		}
		else
		{
			return true;
		}
		exit;
	}

	public function position_check($position, $Spillover)
	{
		$directid = $this->common_model->getreferralname($Spillover);
		$checkdownline = $this->common_model->GetRow("".$position."Id!='0' AND MemberId='".$directid."'","arm_binarymatrix");
		$pos_id = $position.'Id';
		if($checkdownline) {
			if($checkdownline->$pos_id) {
				$this->form_validation->set_message('position_check',ucwords($this->lang->line('errorposition')));
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	public function ext_check()
	{
		
		if($_FILES['referfile']=='gif' || $_FILES['referfile']=='png' || $_FILES['referfile']=='jpg' || $_FILES['referfile']=='jpeg')
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('ext_check',ucwords($this->lang->line('errorextension')));
			return false;
		}
		exit;
	}

	public function customAlpha($str) 
	{
	    if ( !preg_match('/^[a-z \-]+$/i',$str) )
	    {
	    	$this->form_validation->set_message('customAlpha','Error! This field only support for characters.');
	        return false;
	    }
	}
	public function alphaspace($str){
		if ( !preg_match('/^[a-zA-Z ]*$/i',$str) )
	    {
	    	$this->form_validation->set_message('alphaspace','Error! This field only support for characters and space.');
	        return false;
	    }
	}

	public function test() {
		$field = "MemberId";
		$boardpackage = $this->common_model->GetRow("PackageId='1'","arm_boardplan");
		$usermlmdetail = $this->common_model->GetRow("".$field."='265'",'arm_boardmatrix1');
		$dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
		$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

		$chec_spill = $ddetails->SpilloverId;
	
		if(!$SpilloverId){
			$level++;
		}
	}

	public function testing() {
		phpinfo();
	}

	public function GetSpillover($Downids,$table)
	{
		
		$array = $Downids;
		$count = 0;
		foreach ($Downids as $downid) {

			$spill_res = $this->common_model->GetResults("SpilloverId = '".$downid."' ","arm_binarymatrix");
				
			if($spill_res){
				foreach ($spill_res as $spil) {
					// array_push($array,$spil->MemberId);
					$count +=  $spil->LeftCount;
					$count +=  $spil->RightCount;
				}
				$count = $count+1;
			}
		}
		// return array_unique($array);
		return $count;
	}

	public function GetBoardSpillover($Downids,$boardid,$table)
	{
		
		$array = $Downids;
		
		$Count = count($array)-1;
		
		for($i=0;$i<$Count;$i++) 
		{
			$downid = $array[$i];
			
			$spids = $this->common_model->GetResults("SpilloverId = '".$downid."' AND BoardId='".$boardid."'",$table);
			// print_r($spids);
			$Rows = $this->common_model->GetRowCount("SpilloverId = '".$downid."'AND BoardId='".$boardid."'",$table);
			
			if($Rows > 0)
			{
				
				for($j=0; $j<$Rows; $j++) 
				{
					if(!in_array($spids[$j]->BoardMemberId,$array))
					{
						$Count+=1; 
						array_push($array,$spids[$j]->BoardMemberId);
					}
				}
			}
		}
		
		return $array;
	}
}
?>