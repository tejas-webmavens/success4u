<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		
		$this->load->model('admin/Sms_model');
		$this->lang->load('sms');
		$this->load->helper('sms');
		
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
				// print_r($this->input->post()); 
				$list='';
				$numbercheck = count($this->input->post('usernumbers'));
				$smsstatus = $this->Sms_model->Checksms('smsstatus');
				if(count($this->input->post('usernumbers'))>0)
 				$list = $this->input->post('usernumbers');
 				$message = $this->input->post('message');


				$this->form_validation->set_rules('usernumbers', 'usernumbers', 'trim|xss_clean|callback_usernumber_check['.$numbercheck.']');
				$this->form_validation->set_rules('message', 'message', 'trim|required');

				
				

 				if($this->form_validation->run() == true && $smsstatus==1 )
 				{
 					
 					foreach ($list as $key => $value) {
 						
 						// $this->sendsms($value,$message);
 						$smsresult = sendbulksms($value,$message);

 						
 					}
 					
								
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/sms');
 				}

				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					$this->data['members'] = $this->common_model->GetCustomers();
					
					$this->load->view('admin/sms',$this->data);
				}

				
			}
			else
			{
				
				$this->data['members'] = $this->common_model->GetCustomers();

				$this->load->view('admin/sms',$this->data);
				
			} 
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends


	public function setting()
	{

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
				// print_r($this->input->post()); 
				
				$this->form_validation->set_rules('smsauthuser', 'smsauthuser', 'trim|required');
				$this->form_validation->set_rules('smsstatus', 'smsstatus', 'trim|required');
				$this->form_validation->set_rules('smsauthpassword', 'smsauthpassword', 'trim|required');
				$this->form_validation->set_rules('smsauthurl', 'smsauthurl', 'trim|required|prep_url');
				$this->form_validation->set_rules('senderno', 'senderno', 'trim|required|numeric');
		
 			
 				if($this->form_validation->run()==true)
 				{

 					$data = array(
						'smsstatus'=>$this->input->post('smsstatus'),
						'smsauthuser'=>$this->input->post('smsauthuser'),
						'smsauthpassword'=>$this->input->post('smsauthpassword'),
						'smsauthurl'=>$this->input->post('smsauthurl'),
						'senderno'=>$this->input->post('senderno')
					);

					$result = $this->Sms_model->Update($data);
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage_setting'));

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage_setting'));
				}

				$sms_data = array();
			    $smsdetails = $this->Sms_model->Getdatas();
			    
			    foreach ($smsdetails as $row) {
			      $sms_data[$row->KeyValue] = $row->ContentValue;
			    }

				$this->data['smsauthuser'] = $sms_data['smsauthuser'];
				$this->data['smsstatus'] = $sms_data['smsstatus'];
				$this->data['smsauthpassword'] = $sms_data['smsauthpassword'];
				$this->data['senderno'] = $sms_data['senderno'];
				$this->data['smsauthurl'] = $sms_data['smsauthurl'];
				
				$this->load->view('admin/smssetting',$this->data);
			}
			else
			{
				$sms_data = array();
			    $smsdetails = $this->Sms_model->Getdatas();
			    
			    foreach ($smsdetails as $row) {
			      $sms_data[$row->KeyValue] = $row->ContentValue;
			    }

				$this->data['smsauthuser']= $sms_data['smsauthuser'];
				$this->data['smsstatus']= $sms_data['smsstatus'];
				$this->data['smsauthpassword']= $sms_data['smsauthpassword'];
				$this->data['senderno']= $sms_data['senderno'];
				$this->data['smsauthurl']= $sms_data['smsauthurl'];
		
				$this->load->view('admin/smssetting',$this->data);
			}
				
		}
		else
		{
			redirect('admin/login');
		}

 		//header("Refresh:5;url=".base_url()."index.php/welcome");

	}


	public function sendsms($phno,$message)
    {
        
        $AUTH_ID_DET = $this->Sms_model->Getdata('smsauthid');
        $AUTH_TOKEN_DET =$this->Sms_model->Getdata('smsauthtoken');
        $SRC_DET =$this->Sms_model->Getdata('senderno');
        //$SRC_DET1 =$this->Sms_model->Getdata('smsauthid');

        $AUTH_ID = $AUTH_ID_DET;
        # Plivo AUTH TOKEN
         $AUTH_TOKEN = $AUTH_TOKEN_DET;
        # SMS sender ID.
        $src = $SRC_DET;
        # SMS destination number
        $dst = $phno;
        # SMS text
        $text = $message;
        $url = 'https://api.plivo.com/v1/Account/'.$AUTH_ID.'/Message/';
        $data = array("src" => "$src", "dst" => "$dst", "text" => "$text");
        $data_string = json_encode($data);
        
        
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_USERPWD, $AUTH_ID . ":" . $AUTH_TOKEN);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec( $ch );
        curl_close($ch);
        //print_r($response);
        //exit;
    }

    public function template()
    {
    	if($this->session->userdata('logged_in'))
    	{
    		$this->data['smstemplates'] = $this->common_model->GetResults("SmsStatus='1'","arm_smstemplate");
    		$this->load->view('admin/smstemplatelist',$this->data);
    	}
		else
		{
			redirect('admin/login');
		}
    }

    public function deletesmstemplate($id=''){
    	if($id){
    		$this->db->where('SmsTemplateId',$id);
            $this->db->delete('arm_smstemplate');
            $this->session->set_flashdata('success_message',$this->lang->line('successmessagedeletesmstem'));
			redirect('admin/sms/template');
    	}
    	else{
            $this->session->set_flashdata('error_message',$this->lang->line('errormessagedeletesmstem'));
			redirect('admin/sms/template');
    	}
    }

    public function updatesmstemplate($id='')
    {
    	if($this->session->userdata('logged_in'))
    	{
			if($this->input->post())
			{

				$this->form_validation->set_rules('Page', 'Page', 'trim|required');
				$this->form_validation->set_rules('FromNo', 'FromNo', 'trim|required|numeric|min_length[10]|max_length[13]');
				$this->form_validation->set_rules('FromName', 'FromName', 'trim|required');
				$this->form_validation->set_rules('SmsContent', 'SmsContent', 'trim|required|callback_size_check');
				$this->form_validation->set_rules('SmsStatus', 'SmsStatus', 'trim|required');
			 			
 				if($this->form_validation->run()==true)
 				{

 					$data = array(
						'Page'=> $this->input->post('Page'),
						'FromNo'=> $this->input->post('FromNo'),
						'FromName'=> $this->input->post('FromName'),
						'SmsContent'=> $this->input->post('SmsContent'),
						'SmsStatus'=> $this->input->post('SmsStatus')
					);
 					if($id!='')
 					{
	 					$condition = "SmsTemplateId='".$id."'";
	 					$result = $this->common_model->UpdateRecord($data,$condition,"arm_smstemplate");
 					}
 					else
 					{
	 					$result = $this->common_model->SaveRecords($data,"arm_smstemplate");
 					}
 					
					$this->session->set_flashdata('success_message',$this->lang->line('successmessagesmstem'));
					redirect('admin/sms/template');
				}
				else
				{

					$this->session->set_flashdata('error_message',$this->lang->line('errormessagesmstem'));

					if($id)
 					{
	 					$this->data['smstemplates'] = $this->common_model->GetRow("SmsStatus='1' AND SmsTemplateId='".$id."'","arm_smstemplate");
						$this->load->view('admin/updatesmstemplate',$this->data);
 					}
 					else
 					{
 						$this->load->view('admin/updatesmstemplate');
 					}
				}
			}
			else
			{
				if($id!='')
				{
					$this->data['smstemplates'] = $this->common_model->GetRow("SmsStatus='1' AND SmsTemplateId='".$id."'","arm_smstemplate");
					$this->load->view('admin/updatesmstemplate',$this->data);
				}
				else{
					$this->load->view('admin/updatesmstemplate');
				}
			}
    	}
		else
		{
			redirect('admin/login');
		}
    }


	public function usernumber_check($str,$numbers)
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
		else
		{
			$this->form_validation->set_message('usernumber_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('selectuser')).' field values are not selected </em></p>');
			return false;
		}
		
	}

	public function size_check()
	{
		$scont = strlen($this->input->post('SmsContent'));
		if($scont <=100) 
		{
			return true; 
		}
		else
		{
			$this->form_validation->set_message('size_check', '<p><em class="state-error1">Only 100 characters are allow for this sms content</em></p>');
			return false;
		}
	}


} //class ends


