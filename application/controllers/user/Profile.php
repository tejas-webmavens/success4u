<?php
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
		
		//$this->load->helper('url');
		
		$this->lang->load('userprofile',$this->session->userdata('language'));
		$this->lang->load('user/common',$this->session->userdata('language'));
		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		
		}  else {
	    	redirect('login');
	    }

	}

	public function index($id='')
	{
		$this->edit($id);
	}



	public function edit()
	{
	
		$id=$this->session->userdata('MemberID');
		if($this->input->post('reg')!='') 
		{
			
			//print_r($this->input->post());
			$rcondition = " ReuireFieldStatus ='1' AND FieldEnableStatus ='1'  order by FieldPosition ASC";
			$rtableName = 'arm_requirefields';

			$rccondition = " FieldEnableStatus ='1' AND ReuireFieldName NOT IN ('UserName','Password','Phone','Email')";

			$requirefields = $this->common_model->GetResults($rccondition, $rtableName);

		
			foreach ($requirefields as $reqrows) {
				
				$this->form_validation->set_rules(str_replace(' ', '_', $reqrows->ReuireFieldName), $reqrows->ReuireFieldName, 'trim|required');
			 
				if($reqrows->ReuireFieldName =='FirstName' ||$reqrows->ReuireFieldName =='LastName'|| $reqrows->ReuireFieldName =='City'|| $reqrows->ReuireFieldName =='Gender' )
				{
			 		$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|alpha');
				}
				
				elseif($reqrows->ReuireFieldName =='Zip-no' || $reqrows->ReuireFieldName =='Phone')
				{
			 		$this->form_validation->set_rules($reqrows->ReuireFieldName, $reqrows->ReuireFieldName, 'trim|required|integer');
				}	
			} 
			

		 	///$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|xss_clean|callback_username_check');
		 	$this->form_validation->set_rules('Phone', 'Phone', 'trim|required|integer|xss_clean|min_length[10]|max_length[12]');
		 	//$this->form_validation->set_rules('RepeatPassword', 'RepeatPassword', 'trim|required|xss_clean|min_length[6]');
		 	//$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
		 	$propassstaus = $this->common_model->GetRow("Page='usersetting' AND KeyValue='profilepassordstatus'", "arm_setting");
			if($propassstaus->ContentValue == 1) 
		 		$this->form_validation->set_rules('tPassword', 'transaction Password', 'trim|required|xss_clean|min_length[6]|callback_tranpassword_check');
		 		
		 	$this->form_validation->set_rules('Password', 'Password', 'trim|required|xss_clean|min_length[6]|callback_matchpassword_check');

		 	if($_FILES['profileimage']['tmp_name']!='')
			{ 
				$fileflag=0;
				if($_FILES['profileimage']['type']=='image/jpeg' ||$_FILES['profileimage']['type']=='image/png'||$_FILES['profileimage']['type']=='image/gif' || $_FILES['profileimage']['type']=='image/jpg')
				{
					$fileflag=1;
				}
				else{
					$this->session->set_flashdata('error_message',$this->lang->line('errorextension'));
					$fileflag=0;
					redirect('user/profile/edit');
				}
			}
			else
			{
				$fileflag=1;
			}
			
			if($this->form_validation->run() == TRUE && $fileflag==1 )
			{	

				$memberfields = $this->db->list_fields('arm_members');
				$ccondition = " Page ='register' AND Status='1'";
				$ctableName = 'arm_customfields';
				$cfields = 'CustomName';
				$customfields = $this->common_model->GetResults($ccondition, $ctableName,$cfields);
				
				$data = array();
				$data1 = array();
				$fields = $this->input->post();

				foreach ($fields as $key => $value) 
				{
					//echo $key;
					if(in_array($key, $memberfields))
					{	
						if($key!='Password' && $key!='UserName' && $key!='Email' && $key!='Password' )
						{
							$data[$key]=$value;
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
				

				if($_FILES['profileimage']['tmp_name']!='')
				{ 
					$pftyp = explode(".", $_FILES['profileimage']['name']);
					$member = $this->common_model->GetCustomer($id);
					
					if(file_exists($member->ProfileImage))
					unlink($member->ProfileImage);
					
					$profile_img = 'uploads/UserProfileImage/'.$id.'.'.$pftyp[1];
					move_uploaded_file($_FILES['profileimage']['tmp_name'], $profile_img);
					$data = array('ProfileImage'=>$profile_img);
				}
			
				$data['CustomFields']= json_encode($data1);
				$condition = "MemberId='".$id."' AND Password='".sha1(sha1($this->input->post('Password')))."' ";
			
				$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
				
				if($result)
				{
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}

				$rcondition = " Page ='register'  order by FieldPosition ASC";
				$rtableName = 'arm_requirefields';

				$this->data['requirefields'] = $this->common_model->GetResults($rcondition, $rtableName);
				$this->data['country'] = $this->common_model->GetCountry();
				$this->data['member'] = $this->common_model->GetCustomer($id);
				$this->load->view('user/profile',$this->data);

			}
			else
			{
				$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				$rcondition = " Page ='register'  order by FieldPosition ASC";
				$rtableName = 'arm_requirefields';

				$this->data['requirefields'] = $this->common_model->GetResults($rcondition, $rtableName);
				$this->data['member'] = $this->common_model->GetCustomer($id);	
			
				$this->data['country'] = $this->common_model->GetCountry();
		
				$this->load->view('user/profile',$this->data);
			}
		}
		else 
		{
			$rcondition = " Page ='register'  order by FieldPosition ASC";
			$rtableName = 'arm_requirefields';
			$this->data['requirefields'] = $this->common_model->GetResults($rcondition, $rtableName);
			$this->data['member'] = $this->common_model->GetCustomer($id);
			$this->data['country'] = $this->common_model->GetCountry();
			$this->load->view('user/profile',$this->data);
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
		//echo $this->db->last_query();
		

		if (!$query->num_rows()>0) 
			{
				return true; 
			}
		else{
			
			$this->form_validation->set_message('username_check',ucwords($this->lang->line('errorusername')));
			return false;
		}
		
	}

	public function sponsorname_check($str)
	{
		
		$condition = "UserName =" . "'" . $str . "'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		//echo $this->db->last_query();
		

		if ($query->num_rows()>0) 
			{
				return true; 
			}
		else{
			$this->form_validation->set_message('sponsorname_check', ucwords($this->lang->line('errorsponsorname')));
			return false;
			
			}
		
	}

	public function captcha_check($str)
	{
		
		if( strcmp(strtoupper($this->input->post('captcha')),strtoupper($this->session->captchaword))==0)
		{
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

	public function matchpassword_check($str)
	{
		$condition = "UserName =" . "'" . $this->input->post('UserName') . "' AND Password='".sha1(sha1($str))."'";
		
			
		// $UserName = $str;
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return true; 
		}
		else
		{	
			$this->form_validation->set_message('matchpassword_check',ucwords($this->lang->line('errorpassword')));
			return false;
		}

	}

	public function tranpassword_check()
	{
		$condition = "MemberId =" . "'" . $this->session->userdata('MemberID'). "' AND TransactionPassword =" . "'" . sha1(sha1($this->input->post('tPassword'))). "' AND UserType='3'";

			$this->db->select('*');
			$this->db->from('arm_members');
			$this->db->where($condition);
			$query = $this->db->get();
			if ($query->num_rows()>0) 
			{
				return true; 
			}
			else
			{

				$this->form_validation->set_message('tranpassword_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errortpassword')).'</em></p>');
				return false;
			}


	}


	public function payment($id='')
	{

		$this->data['userdeails'] = $this->common_model->GetCustomer($id);


		$this->load->view('user/regpayment',$this->data['userdeails']);
	}

	public function passmatch_check()
	{
		if($this->input->post('newpassword') == $this->input->post('repeatpassword'))
		{

			return true; 
		}
		else{

			$this->form_validation->set_message('passmatch_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorpasswordmatch')).'</em></p>');
			return false;
			}
	}

	public function passprematch_check()
	{
		if($this->input->post('newpassword') == $this->input->post('currentpassword'))
		{
			$this->form_validation->set_message('passprematch_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorpasswordprematch')).'</em></p>');
			return false;
		}
		else
		{
			return true; 
		}
	}


	public function changepassword_check()
	{
		$condition = "MemberId =" . "'" . $this->session->userdata('MemberID'). "' AND Password =" . "'" . sha1(sha1($this->input->post('currentpassword'))). "' AND UserType='3'";

			$this->db->select('*');
			$this->db->from('arm_members');
			$this->db->where($condition);
			$query = $this->db->get();
			if ($query->num_rows()>0) 
			{
				return true; 
			}
			else
			{

				$this->form_validation->set_message('changepassword_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorcgpassword')).'</em></p>');
				return false;
			}


	}

	public function change()
	{
		
		if($this->session->userdata('logged_in') && $this->session->userdata('MemberID')) 
		{
			
			if($this->input->post())
			{				
				$minst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='minuserpasswordlength'","arm_setting");
			 	$maxst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='maxuserpasswordlength'","arm_setting");
				
				$this->form_validation->set_rules('newpassword', 'newpassword', 'trim|required|min_length[6]|max_length[12]|callback_passmatch_check|callback_passprematch_check');
				$this->form_validation->set_rules('currentpassword', 'currentpassword', 'trim|required|callback_changepassword_check');

				
				if($this->form_validation->run() == true )
 				{
 						$data = array('Password'=>SHA1(SHA1($this->input->post('newpassword'))));
						$condition= "MemberId='".$this->session->userdata('MemberID')."' AND UserType='3' ";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
						
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagepass'));
					redirect('user/profile/change');
 				}

				else
				{
				
				$this->session->set_flashdata('error_message',$this->lang->line('errormessagepass'));
						
				$this->load->view('user/updatepassword');
				}

				
			}
			else
			{
				
				$this->load->view('user/updatepassword');
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		} 		
	}

	public function changetransaction()
	{
		
		if($this->session->userdata('logged_in') && $this->session->userdata('MemberID')) 
		{
			
			if($this->input->post())
			{				
				$minst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='minuserpasswordlength'","arm_setting");
			 	$maxst = $this->common_model->GetRow("Page='usersetting' AND KeyValue='maxuserpasswordlength'","arm_setting");
				
				$this->form_validation->set_rules('newpassword', 'newpassword', 'trim|required|min_length[6]|max_length[12]|callback_passmatch_check|callback_passprematch_check');
				$this->form_validation->set_rules('currentpassword', 'currentpassword', 'trim|required|callback_changepassword_check');

				
				if($this->form_validation->run() == true )
 				{
 						$data = array('TransactionPassword'=>SHA1(SHA1($this->input->post('newpassword'))));
						$condition= "MemberId='".$this->session->userdata('MemberID')."' AND UserType='3' ";
						$result = $this->common_model->UpdateRecord($data,$condition,'arm_members');
						
					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagepass'));
					redirect('user/profile/changetransaction');
 				}

				else
				{
				
				$this->session->set_flashdata('error_message',$this->lang->line('errormessagepass'));
						
				$this->load->view('user/updatetranspassword');
				}

				
			}
			else
			{
				
				$this->load->view('user/updatetranspassword');
				// $this->load->view('admin/generalsetting');
			} 
		}
		else
		{
			redirect('admin/login');

					
		} 		
	}

}
?>