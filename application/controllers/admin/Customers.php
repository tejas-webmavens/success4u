<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/transaction_model');
		$this->load->model('MemberCommission_model');
		$this->load->model('Memberboardprocess_model');
		$this->load->model('admin/Smtpsetting_model');
		$this->load->helper('sms');
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		$this->lang->load('customers');

		// check subadmin
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
			
		if($this->input->post('inputname')) {
			
			foreach ($this->input->post('inputname') as $customer_id) {
				$status = $this->common_model->DeleteCustomer($customer_id);
			}
			
			if($status) {
				redirect('admin/customers');
			}
			
		} else {
			$this->data['customers'] = $this->common_model->GetCustomers();
			$this->load->view('admin/customers', $this->data);
		}
 		
	}

	public function search() {
		
		if($this->input->post()) 
		{
			//print_r($this->input->post());

			$condition = "isDelete= '0'";

			if($this->input->post('firstname'))
				//$url .= '&FirstName=' . $this->input->post('firstname');
				$condition .= " AND FirstName LIKE" . "'%" . $this->input->post('firstname') . "%'";

			if($this->input->post('username'))
				//$url .= '&UserName=' . $this->input->post('username');
				 $condition .= " AND UserName LIKE" . "'%" . $this->input->post('username') . "%'";

			if($this->input->post('email'))
				$condition .= " AND Email LIKE" . "'%" . $this->input->post('email') . "%'";

			if($this->input->post('status'))
				$condition .= " AND MemberStatus =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
			else if($this->input->post('datepicker1'))
				$condition .= " AND DATE(DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "'";
			else if($this->input->post('datepicker2'))
				$condition .= " AND DATE(DateAdded) <=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['customers'] = $this->common_model->GetResults($condition, 'arm_members');
			
			$this->load->view('admin/customers', $this->data['customers']);
			
		} else {
			//$this->session->set_flashdata('error_message', 'Enter field value to search');
			redirect('admin/customers');
		}
	}

	public function add($MemberId='')
	{
		if($this->session->userdata('logged_in')) 
		{
			$rtableName 	= 'arm_requirefields';
			$rcondition 	= " FieldEnableStatus ='1'  order by FieldPosition ASC";
			$rccondition 	= " ReuireFieldStatus ='1' AND FieldEnableStatus ='1' AND ReuireFieldName NOT IN ('UserName','Password','Phone','Email')";
			$enablefields 	= $this->common_model->GetResults($rcondition, $rtableName);

			$requirefields 	= $this->common_model->GetResults($rccondition, $rtableName);

			$ccondition = " Page ='register' AND Status='1'";
			$ctableName = 'arm_customfields';
			$cfields = 'CustomName';
			$cusfields = $this->common_model->GetResults($ccondition, $ctableName,$cfields);	

			
			$reqfields = array();
			$enbfields = array();
			$customfields = array();
			if($cusfields) {
				for($i=0;$i<count($cusfields);$i++) 
				{	
					array_push($customfields, $cusfields[$i]->CustomName);
				}
			}
			

			foreach ($enablefields as $key => $value) 
			{	
				if($value->FieldEnableStatus==1)
				{
					array_push($enbfields, $value->ReuireFieldName);
				}
			}

			foreach ($requirefields as $key => $value) 
			{
				if( $value->FieldEnableStatus==1 && $value->ReuireFieldStatus==1)
				{
					array_push($reqfields, $value->ReuireFieldName);
				}
			}
			
			if($this->input->post()) {
					
				//if ($this->form_validation->run() == TRUE) {

				if($this->input->post('memberid')) {
				
				
					$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|xss_clean');
					//$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|xss_clean');
					// $this->form_validation->set_rules('Address', 'Address', 'trim|required|xss_clean');
					// $this->form_validation->set_rules('City', 'City', 'trim|required|xss_clean');
					$this->form_validation->set_rules('Phone', 'Phone', 'trim|required|xss_clean|min_length[10]|max_length[13]');
					$this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');
					
					if ($this->form_validation->run() == TRUE) {
						$memberfields = $this->db->list_fields('arm_members');
						$fields = $this->input->post();
                        
                        foreach ($fields as $key => $value) 
						{
							
							if(in_array(ucwords($key), $memberfields))
							{	
								if($key=='Password')
								{
									$data[ucwords($key)]=SHA1(SHA1($value));
								}
								else
								{
									$data[ucwords($key)]=$value;
								}
								
							}
						}
					

						// $data = array(
							
						// 	'FirstName' => $this->input->post('FirstName'),
						// 	'Address' => $this->input->post('Address'),
						// 	'City' => $this->input->post('City'),
						// 	'Country' => $this->input->post('Country'),
						// 	'Phone' => $this->input->post('Phone'),
						// 	'Ip' => $this->input->ip_address()
							
						// );
						$upload_files = 1;
						if($_FILES['profileimage']['tmp_name']!='')
						{ 
							$config['upload_path'] = './uploads/UserProfileImage/';
							$config['allowed_types'] = '*';
							$config['encrypt_name'] = TRUE;

							$this->load->library('upload', $config);

							if ( ! $this->upload->do_upload('profileimage')) {
								$upload_files = 0;
								$this->session->set_flashdata('error_message', 'profile image extension invalid. '.$this->upload->display_errors());
								
							} else {
								$data = array('ProfileImage'=> 'uploads/UserProfileImage/'.$this->upload->data('file_name'));
								$upload_files = 1;
							}
						}
						
						if($upload_files) {
							$cusdata1 = array();
							if($cusfields) {
							for($i=0;$i<count($cusfields);$i++) 
							{
								$cusdata1[$cusfields[$i]->CustomName] = $this->input->post($cusfields[$i]->CustomName);
							}
							}
							$cusdata = json_encode($cusdata1);
								$data['CustomFields'] = $cusdata;

								
							$condition = "MemberId =" . "'" . $this->input->post('memberid') . "'";
							
							$status = $this->common_model->UpdateRecord($data, $condition, 'arm_members');
							
							if($status){
								$this->session->set_flashdata('success_message', 'Success! User details Updated');
								redirect('admin/customers');
							} else {
								$this->session->set_flashdata('error_message', 'Failed! User details not Updated');
								$data['reqfields'] = $reqfields;
								$data['enbfields'] = $enbfields;
								$data['enablefields'] = $enablefields;
								$data['customfields'] = $customfields;

								$this->load->view('admin/editcustomer');		
							}
						} else {
							$data['country'] = $this->common_model->GetCountry();
							$query = $this->db->query("SELECT * FROM `arm_members` ORDER BY `MemberId` DESC LIMIT 1 ");
				
							$this->data['username'] = $query->row()->UserName;
							$data['member'] = $this->common_model->GetCustomer($MemberId);
							$data['reqfields'] = $reqfields;
							$data['enbfields'] = $enbfields;
							$data['enablefields'] = $enablefields;
							$data['customfields'] = $customfields;
							$this->load->view('admin/editcustomer',$data);
						}
					}
					else {
						$this->session->set_flashdata('error_message', 'Failed! User details not Updated');
						$data['country'] = $this->common_model->GetCountry();
						$query = $this->db->query("SELECT * FROM `arm_members` ORDER BY `MemberId` DESC LIMIT 1 ");
				
					$this->data['username'] = $query->row()->UserName;
						$data['member'] = $this->common_model->GetCustomer($MemberId);
						$data['reqfields'] = $reqfields;
						$data['enbfields'] = $enbfields;
						$data['enablefields'] = $enablefields;
						$data['customfields'] = $customfields;							

						$this->load->view('admin/editcustomer', $data);
					}

				}  
				else 
				{

					if(valid_email($this->input->post('SponsorName')))
						$this->form_validation->set_rules('SponsorName', 'SponsorName', 'trim|required|xss_clean|callback_username_check');
					else	
						$this->form_validation->set_rules('SponsorName', 'SponsorName', 'trim|required|xss_clean|callback_username_check');

						$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					 	if($mlsetting->Id==4 && $mlsetting->Position==1)
					 	{
					 	 $this->form_validation->set_rules('position', 'Select Position', 'trim|required|callback_position_check');
					 	}

						foreach ($requirefields as $reqrows) 
						{

							// if($reqrows->ReuireFieldName=='FirstName' || $reqrows->ReuireFieldName=='LastName' || $reqrows->ReuireFieldName =='MiddleName' )  {
							// 	$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|alpha');
							// }
							 if($reqrows->ReuireFieldName =='Zip' || $reqrows->ReuireFieldName =='Phone' || $reqrows->ReuireFieldName == 'Fax') {
						 		$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|integer');
							} elseif($reqrows->ReuireFieldName =='Gender') {
								$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required');
							} elseif($reqrows->ReuireFieldName=='City' || $reqrows->ReuireFieldName =='bankwirename' ) {
								$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|callback_customAlpha');
							} else {
								$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required');
							}
											
						} 

						$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email|is_unique[arm_members.Email]|xss_clean');
						$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|is_unique[arm_members.UserName]|min_length[5]|max_length[16]|callback_usernamer_check|xss_clean');
						$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[16]|matches[ConfirmPassword]|xss_clean');
						$this->form_validation->set_rules('ConfirmPassword', 'ConfirmPassword', 'trim|required|min_length[6]|max_length[16]|xss_clean');
						$this->form_validation->set_rules('Phone', 'Phone', 'trim|required|integer|xss_clean|min_length[10]|max_length[13]');
						// $this->form_validation->set_rules('Country', 'Country', 'trim|required|xss_clean');

						
						
					if ($this->form_validation->run() == TRUE) {

						if(valid_email($this->input->post('SponsorName')))
							$condition = "Email =" . "'" . $this->input->post('SponsorName') . "'";
						else
							$condition = "UserName =" . "'" . $this->input->post('SponsorName') . "'";

						$sponsor = $this->common_model->GetSponsor($this->input->post('SponsorName'), $condition);
						
						$memberfields = $this->db->list_fields('arm_members');
						//print_r($memberfields);
						$ccondition = " Page ='register' AND Status='1'";
						$ctableName = 'arm_customfields';
						$cfields = 'CustomName';
						$customfields = $this->common_model->GetResults($ccondition, $ctableName,$cfields);	

						$data = array(
							'UserType' => '3',
							'SubscriptionsStatus' => 'Active',
							'MemberStatus' => 'Active',
							'DateAdded' =>  date('Y-m-d h:i:s'),
							'Ip' => $this->input->ip_address(),
							'DirectId' => $sponsor->MemberId
						);

						$data1 = array();
						$fields = $this->input->post();
						

						foreach ($fields as $key => $value) 
						{
							
							if(in_array(ucwords($key), $memberfields))
							{	
								if($key=='Password')
								{
									$data[ucwords($key)]=SHA1(SHA1($value));
								}
								else
								{
									$data[ucwords($key)]=$value;
								}
								
							}
							
							if($customfields) {
								for($i=0; $i<count($customfields); $i++)
								{
									if($key == $customfields[$i]->CustomName)
									{	
										
										$data1[$key]=$value;
									}

								}
							}

						}

						$data['CustomFields'] = json_encode($data1);
						$data['ReferralName'] = $this->input->post('UserName');
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
							

						$status = $this->common_model->SaveRecords($data, 'arm_members');
						
						$memberid = $this->db->insert_id();
						if($status){

							$this->Sendmail_func($this->input->post());

							//commission process
							$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
												
							$field = "MemberId";
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
								$this->Memberboardprocess_model->Totaldowncount($table);
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

							
							$this->session->set_flashdata('success_message', 'Success! User details Updated');
							$url = 'admin/customers';
						    echo'<script> window.location.href = "'.base_url().'index.php?/'.$url.'"; </script> ';
							
						} 
						else 
						{
							$this->session->set_flashdata('error_message', 'Failed! User details not Updated');
							$data['reqfields'] = $reqfields;
							$data['enbfields'] = $enbfields;
							$data['enablefields'] = $enablefields;
							$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
									
							if($mlsetting->Id==4)
							{
								$table = "arm_pv";
							}
							elseif($mlsetting->Id==5 || $mlsetting->Id==8) {

								$table ="arm_boardplan";

							}
							else
							{
								$table='arm_package';
							}
							$data['package'] = $this->common_model->GetResults(" Status ='1'  order by PackageId ASC",$table);
							
							$this->load->view('admin/addcustomer');		
						}
					}
					else 
					{
						
						$data['country'] = $this->common_model->GetCountry();
						$data['reqfields'] = $reqfields;
						$data['enbfields'] = $enbfields;
						$data['enablefields'] = $enablefields;
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
						
						$data['package'] = $this->common_model->GetResults(" Status ='1'  order by PackageId ASC", $table);
						$this->load->view('admin/addcustomer', $data);
					}

				}
					
				
			} 
			else 
			{

				if($MemberId) 
				{
					$data['country'] = $this->common_model->GetCountry();
					$query = $this->db->query("SELECT * FROM `arm_members` ORDER BY `MemberId` DESC LIMIT 1 ");
				
					$data['username'] = $query->row()->UserName;
					$data['member'] = $this->common_model->GetCustomer($MemberId);
					$data['reqfields'] = $reqfields;
					$data['enbfields'] = $enbfields;
					$data['enablefields'] = $enablefields;
					$data['customfields'] = $customfields;

					$this->load->view('admin/editcustomer', $data);
				} 
				else 
				{
					$data['country'] = $this->common_model->GetCountry();
					$defuser = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='defaultsponsors'", "arm_setting");
					$drdetails = $this->common_model->GetRow(" MemberId='".$defuser->ContentValue."'","arm_members");	
					// $refname = $drdetails->UserName;
					$query = $this->db->query("SELECT * FROM `arm_members` ORDER BY `MemberId` DESC LIMIT 1 ");
				
					$data['username'] = $query->row()->UserName;
					$data['member'] = $drdetails->UserName;
					$data['reqfields'] = $reqfields;
					$data['enbfields'] = $enbfields;
					$data['enablefields'] = $enablefields;
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
					$data['package'] = $this->common_model->GetResults(" Status ='1'  order by PackageId ASC", $table);
					
					// print_r($data['country']);
					$this->load->view('admin/addcustomer', $data);
				}
			}
	    } else {
	    	$this->load->view('admin/login');
	    }
	}
	

	function Sendmail_func($post_data) 
	{
		if($post_data) {
			
			$qry_data = $this->common_model->GetSiteSettings('smtpsetting');
			
			foreach ($qry_data as $key) {
				$smtp_data[$key->KeyValue] = $key->ContentValue;
			}

			$config = array();
			$config['protocol'] 		= "sendmail";
		    $config['useragent']        = "CodeIgniter";
		    $config['mailpath']         = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
		    $config['protocol']         = "smtp";
		    $config['smtp_host']        = $smtp_data['smtphost'];
		    $config['smtp_port']        = $smtp_data['smtpport'];
		    $config['mailtype'] 		= 'html';
		    $config['charset']  		= 'utf-8';
		    $config['newline']  		= "\r\n";
		    $config['wordwrap'] 		= TRUE;
			// $this->email->initialize($config);
			$this->email->clear(TRUE);

			//email 
			$message = $this->common_model->GetRow("Page='register'","arm_emailtemplate");
			$site = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'","arm_setting");
			$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");
	   	    
		   	$emailcont = urldecode($message->EmailContent);
		   	
		   	$logo = '<img src="'.base_url().$site->ContentValue.'">';
			$emailcont = str_replace('[LOGO]', $logo, $emailcont);
		   	$emailcont = str_replace('[FIRSTNAME]', $post_data['UserName'], $emailcont);
		   	$emailcont = str_replace('[USERNAME]', $post_data['UserName'], $emailcont);
		   	$emailcont = str_replace('[PASSWORD]', $post_data['Password'], $emailcont);
		   	$emailcont = str_replace('[URL]', base_url(), $emailcont);

		   	
		  	$adminid = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='adminmailid'","arm_setting");
		   	$this->email->from($smtp_data['smtpmail'], $sitename->ContentValue);
		   	$this->email->to($post_data['Email']);
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

	    	$this->email->message($body);    
		    $this->email->set_mailtype("html");
	    	$Mail_status = $this->email->send();
			$smscontent = $this->common_model->GetRow("Page='register'","arm_smstemplate");
			$smscont = urldecode($message->EmailContent);
			$smscont = str_replace('[FIRSTNAME]', $post_data['UserName'], $smscont);
		   	$smscont = str_replace('[USERNAME]', $post_data['UserName'], $smscont);
		   	$smscont = str_replace('[PASSWORD]', $post_data['Password'], $smscont);
		   	
	    	//send sms by bulksms
			$smsresult = sendbulksms($this->input->post('Phone'),$smscont);
		}
	}

	public function profile($Id='') {

		if($this->session->userdata('logged_in')) {
			$MemberId = ($Id) ? $Id : $this->session->userdata('MemberID');
			if($MemberId) {
				$data['profile'] = $this->common_model->GetCustomer($MemberId);
				$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
				if($mlsetting->Id==4) {
					$table = "arm_pv";
				} elseif($mlsetting->Id==5 || $mlsetting->Id==8) {
					$table = "arm_boardplan";
				} else {
					$table='arm_package';
				}

				$condition="PackageId='".$data['profile']->PackageId."'";
				$data['packagedetails'] = $this->common_model->GetRow($condition,$table);

				$epin_condition="UserId='".$MemberId."'";
				$data['epins'] = $this->common_model->GetResults($epin_condition,'arm_requestepin');

				// $ref_condition="RefId='".$MemberId."' Order by LeadId DESC";
				

				$ref_condition="DirectId='".$MemberId."'";
				$data['referals'] = $this->common_model->GetResults($ref_condition,'arm_members');
				
				$trans_condition="h.MemberId='".$MemberId."' AND m.MemberId='".$MemberId."'";
				$data['transactions'] = $this->transaction_model->GetTransactions($trans_condition);

				$total_eraring_query = $this->db->query("SELECT sum(Credit) as credit FROM arm_history WHERE MemberId='".$MemberId."' AND TypeId IN('4','5','15','18')");
				$data['total_eraring'] = $total_eraring_query->row()->credit;

				$total_withdraw_query = $this->db->query("SELECT sum(Debit) as debit FROM arm_history WHERE MemberId='".$MemberId."' AND TypeId NOT IN('4','5','15','18')");
				$data['total_withdraw'] = $total_withdraw_query->row()->debit;

				// echo "SELECT Balance FROM arm_history WHERE MemberId='".$MemberId."'";
				$balance_query = $this->db->query("SELECT Balance FROM arm_history WHERE MemberId='".$MemberId."' ORDER BY HistoryId DESC LIMIT 1");
				if($balance_query->row())
					$data['balance'] = $balance_query->row()->Balance;
				else
					$data['balance'] = 0;

				$order_query = $this->db->query("SELECT sum(OrderTotal) as Total FROM arm_order WHERE MemberId='".$MemberId."' AND Status='Paid' AND isDelete='0'");
				$data['orders_total'] = $order_query->row()->Total;
				$data['subadmin'] = 0;
				// $data['referals'] = $this->common_model->GetCustomer($MemberId);
				// $data['transactions'] = $this->common_model->GetCustomer($MemberId);
			} else {
				redirect('admin');
			}
			

			$this->load->view('admin/profile', $data);
	    } else {
	    	$this->load->view('admin/login');
	    }
	}
	
	public function delete($MemberId) {

				  /*$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
					$field = "MemberId";
		if($mlsetting->Id==1) {$table = "arm_forcedmatrix"; }
		else if($mlsetting->Id==2) {$table = "arm_unilevelmatrix"; }
		else if($mlsetting->Id==3) {$table = "arm_monolinematrix"; $field = "MonoLineId"; }
		else if($mlsetting->Id==4) {$table = "arm_binarymatrix"; } 
		else if($mlsetting->Id==5) {$table = "arm_boardmatrix"; $field = "BoardMemberId"; } 
		else if($mlsetting->Id==6) {$table = "arm_xupmatrix"; } 
		else if($mlsetting->Id==7) {$table = "arm_oddevenmatrix"; }*/
		$matrixtable = array("arm_unilevelmatrix","arm_monolinematrix","arm_binarymatrix","arm_boardmatrix","arm_xupmatrix","arm_oddevenmatrix");
		$delteflag =1;
		$condition = "MemberId =" . "'" . $MemberId . "'";
		foreach ($matrixtable as $key => $value) 
		{
			$matdet = $this->common_model->GetRow($condition,$value);
			if($matdet)
			{
				if($value=="arm_boardmatrix"){$field = "BoardMemberId"; }
				elseif($value=="arm_monolinematrix") { $field = "MonoLineId"; }
				else{$field = "MemberId"; }
					$matid = $matdet->$field;
				
				$memdet = $this->common_model->GetRowCount("SpilloverId='".$matid."'",$value);
				{
					$delteflag =0;
				}

			}
		}		
				

		if($delteflag ==1)
		{
			$status = $this->db->query("DELETE FROM arm_members WHERE MemberId='".$MemberId."' ");
		}
		else{
			$status=0;
			$ermsg = " This Member Have Downlines ";
		}

		if($status){
			$this->session->set_flashdata('success_message', 'Success! User are Removed');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! User Not are Removed.'.$ermsg);
		}
		
		redirect('admin/customers');

		
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
					redirect('admin/customers');
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

		if($status){
			$this->session->set_flashdata('success_message', 'Success! User is Actived');
			echo 1;
			//redirect('admin/customers');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! User Not Activated');
			echo 0;
			//redirect('admin/customers');
		}
	}

	public function inactive($MemberId) {
		$condition = "MemberId =" . "'" . $MemberId . "'";

		$data = array(
			'MemberStatus' => 'Inactive'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_members');

		if($status){
			$this->session->set_flashdata('success_message', 'Success! User is Deactived');
			echo 1;
			//redirect('admin/customers');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! User Not Deactived');
			echo 0;
			//redirect('admin/customers');
		}
	}

	public function DeleteAll() {
		if($this->input->post('customer')) {
			foreach ($this->input->post('customer') as $key => $mvalue) {
				/*$condition = "MemberId =" . "'" . $value . "'";

				$data = array(
					'isDelete' => '1'
				);

				$status = $this->common_model->UpdateRecord($data, $condition, 'arm_members');
				*/
				$matrixtable = array("arm_unilevelmatrix","arm_monolinematrix","arm_binarymatrix","arm_boardmatrix","arm_xupmatrix","arm_oddevenmatrix");
				$delteflag =1;
				$condition = "MemberId =" . "'" . $mvalue . "'";
				foreach ($matrixtable as $key => $value) 
				{
					$matdet = $this->common_model->GetRow($condition,$value);
					if($matdet)
					{
						if($value=="arm_boardmatrix"){$field = "BoardMemberId"; }
						elseif($value=="arm_monolinematrix") { $field = "MonoLineId"; }
						else{$field = "MemberId"; }
							$matid = $matdet->$field;
						
						$memdet = $this->common_model->GetRowCount("SpilloverId='".$matid."'",$value);
						{
							$delteflag =0;
						}

					}
					// echo"<br>in =>". $value."  flag=>".$delteflag;

				}			
				

		if($delteflag ==1)
		{
			/*echo "DELETE FROM arm_members WHERE MemberId='".$mvalue."' ";
			 exit;*/
		$status = $this->db->query("DELETE FROM arm_members WHERE MemberId='".$mvalue."' ");
		}
		else{
			$status=0;
			$ermsg = " This Member Have Downlines ";
		}

		if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected customer removed');
				redirect('admin/customers');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected customer not removed. '.$ermsg );
				redirect('admin/customers');
			}

			}
			
		} 
		else {
			redirect('admin/customers');
		}
	}

	public function view()
	{
		$this->load->view('admin/product');
	}

	public function username_check($str)
	{
		if(valid_email($str))
			$condition = "Email =" . "'" . $str . "'";
		else
			$condition = "UserName =" . "'" . $str . "'";
		// $UserName = $str;
		$this->db->select('*');
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

	public function usernamer_check($str)
	{
		
		$condition = "UserName =" . "'" . $str . "' OR ReferralName =" . "'" . $str . "'";
			
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();

		if (!$query->num_rows()>0) {
			return true; 
		} else {
			$this->form_validation->set_message('usernamer_check','<p><em class="state-error1">Username already exists</em></p>');
			return false;
		}
		
	}

	public function position_check()
	{
		$directid = $this->common_model->getreferralname($this->input->post('SponsorName'));
		$ckip = $this->common_model->GetRowCount("".$this->input->post('position')."Id!='0' AND MemberId='".$directid."'","arm_binarymatrix");
		
		if($ckip>0)
		{
			$this->form_validation->set_message('position_check',ucwords($this->lang->line('errorposition')));
			
			return false;
		}
		else
		{
			
			return true;
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
	    //print_r($message);exit;
	   		// echo "<br> time => <br>".$emailcont ;

	    // $this->email->mailtype('html');
						$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");

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
						<body>
						'.$emailcont.'
						</body>
						</html>';
						// echo "<br>2 nd time ==><br>".$body; exit;
		$this->email->message($body);
			$this->email->set_mailtype("html");
				
	   

	    $Mail_status = $this->email->send();
	    				$smscontent = $this->common_model->GetRow("Page='passwordreset'","arm_smstemplate");
						$smscont = urldecode($message->EmailContent);
						$smscont = str_replace('[FIRSTNAME]', $this->input->post('UserName'), $smscont);
					   	$smscont = str_replace('[USERNAME]', $this->input->post('UserName'), $smscont);
					   	$smscont = str_replace('[PASSWORD]', $this->input->post('Password'), $smscont);
					   	
				    	//send sms by bulksms
						$smsresult = sendbulksms($user->Phone,$smscont);
	    if($Mail_status) {
	    		$data = array(
					'password' => SHA1(SHA1($randomstring))
				);
			$mupdate = $this->common_model->UpdateRecord($data,"MemberId='".$id."'","arm_members");


	    	// echo "<br>mail sent";
	    	$this->session->set_flashdata('success_message', 'Success! selected user password Reseted');
			redirect('admin/customers');
	    } else {
			$error_mail = $this->email->print_debugger();
	    	$this->session->set_flashdata('error_message', $error_mail);
			redirect('admin/customers');
	    }
	    // print_r($this->session->flashdata); exit;
	}
	public function customAlpha($str) 
	{
	    if ( !preg_match('/^[a-z \-]+$/i',$str) )
	    {
	    	$this->form_validation->set_message('customAlpha','Error! This field only support for characters.');
	        return false;
	    }
	}

	public function sendMail($id) {

		$user = $this->common_model->GetCustomer($id);
		if($user) {

			if($this->input->post()) {

				$this->form_validation->set_rules('mailsubject', 'Subject', 'trim|required|xss_clean|min_length[4]|alpha_numeric');
				$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean|min_length[15]');

				if ($this->form_validation->run() == TRUE) {
					
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
						$this->email->clear(TRUE);
						//$this->load->view('admin/sendmail');

						$mydata = $this->input->post('message');
						$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");
						
					
				    	$message = html_entity_decode($this->load->view('email/invite', $mydata, true));
				    	$this->email->set_mailtype("html");
				    	if($smtpmail) {
				    		$this->email->from($smtpmail, $sitename->ContentValue);
				    	} else {
				    		$this->email->from('admin@armcip.biz', $sitename->ContentValue);
				    	}
				    	$this->email->to($user->Email);

				    	$this->email->subject($this->input->post('mailsubject'),$user->FirstName);
					    $this->email->message($message);    
					    
					    $Mail_status = $this->email->send();
					    if($Mail_status) {
					    	$this->session->set_flashdata('success_message', 'Success! Your message sent to '.$user->Email);
							redirect('admin/customers');
					    } else {
							$error_mail = $this->email->print_debugger();
					    	$this->session->set_flashdata('error_message', $error_mail);
							redirect('admin/customers');
					    }
					
				}  else {
					$this->load->view('admin/sendmail');
				}
			} else {
				$this->load->view('admin/sendmail');
			}
		} else {
			redirect('admin/customers');
		}
	}

	public function checkmember($username) {

		$condition = 'UserName = "'.$username.'"';
		$userdetails = $this->common_model->GetRow($condition, 'arm_members');
		if($userdetails) {
			echo $userdetails->FirstName.' '.$userdetails->LastName;
		} else {
			echo "IN VALID";
		}
			 
	}
	public function check($value='')
	{

		$field = "MemberId";
		$table = "arm_boardmatrix";
	$this->Memberboardprocess_model->setboardmatrix($value,$table);

	$this->MemberCommission_model->process($value,$table,$field);


	}
	
}
