<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitesetting extends CI_Controller {


	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Generalsetting_model');
		$this->lang->load('generalsetting');
		
		}  else {
	    	redirect('admin/login');
	    }

	} //function ends

	public function index()
	{
			
				$this->data['sitename']= $this->Generalsetting_model->Getsite('sitename');
				$this->data['siteurl']= $this->Generalsetting_model->Getsite('siteurl');
				$this->data['adminmailid']= $this->Generalsetting_model->Getsite('adminmailid');
				$this->data['sitemetatitle']= $this->Generalsetting_model->Getsite('sitemetatitle');
				$this->data['sitemetakeyword']= $this->Generalsetting_model->Getsite('sitemetakeyword');
				$this->data['sitemetadescription']= $this->Generalsetting_model->Getsite('sitemetadescription');
				
				$this->data['sitestatus']= $this->Generalsetting_model->Getsite('sitestatus');
				$this->data['sitegooglecode']= $this->Generalsetting_model->Getsite('sitegooglecode');
				$this->data['sitelogo']= $this->Generalsetting_model->Getsite('sitelogo');
			    // echo $this->data['sitelogo'];


				$this->data['allowpicture']= $this->Generalsetting_model->Getsite('allowpicture');
				$this->data['emailapproval']= $this->Generalsetting_model->Getsite('emailapproval');
				$this->data['mobileapproval']= $this->Generalsetting_model->Getsite('mobileapproval');
				$this->data['usecaptcha']= $this->Generalsetting_model->Getsite('usecaptcha');
				$this->data['allowregistration']= $this->Generalsetting_model->Getsite('allowregistration');
				$this->data['allowlogin']= $this->Generalsetting_model->Getsite('allowlogin');
				$this->data['uniqueip']= $this->Generalsetting_model->Getsite('uniqueip');
				$this->data['uniquemobile']= $this->Generalsetting_model->Getsite('uniquemobile');
				$this->data['allowusers']= $this->Generalsetting_model->Getsite('allowusers');
				$this->data['defaultsponsors']= $this->Generalsetting_model->Getsite('defaultsponsors');
				$this->data['sponsorslist']= $this->Generalsetting_model->Getsponsormember();
				$this->data['footercontent']= $this->Generalsetting_model->Getsite('footercontent');
				$this->data['address']= $this->Generalsetting_model->Getsite('address');
				$this->data['referrallink']= $this->Generalsetting_model->Getsite('referrallink');
			
				$this->load->view('admin/generalsetting',$this->data);
 		

	}//function ends


	public function settings(){
		if($this->input->post())
			{
				
			
				$this->form_validation->set_rules('sitename', 'sitename', 'trim|required|alpha_numeric');
				$this->form_validation->set_rules('siteurl', 'siteurl', 'trim|required');
				$this->form_validation->set_rules('adminmailid', 'adminmailid', 'trim|required|valid_email');
 			
 				
					
					
 				if($this->form_validation->run() == true)	
 				{


					$data = array(
						'sitename'=>$this->input->post('sitename'),
						'siteurl'=>$this->input->post('siteurl'),
						'adminmailid'=>$this->input->post('adminmailid'),
						'sitemetatitle'=>$this->input->post('sitemetatitle'),
						'sitemetakeyword'=>$this->input->post('sitemetakeyword'),
						'sitemetadescription'=>$this->input->post('sitemetadescription'),
						'sitestatus'=>$this->input->post('sitestatus'),
						'sitegooglecode'=>$this->input->post('sitegooglecode'),
						'allowpicture'=>($this->input->post('allowpicture')),
						'emailapproval'=>($this->input->post('emailapproval')),
						'mobileapproval'=>($this->input->post('mobileapproval')),
						'usecaptcha'=>($this->input->post('usecaptcha')),
						'allowregistration'=>($this->input->post('allowregistration')),
						'allowlogin'=>($this->input->post('allowlogin')),
						'uniqueip'=>($this->input->post('uniqueip')),
						'uniquemobile'=>($this->input->post('uniquemobile')),
						'allowusers'=>($this->input->post('allowusers')),
						'footercontent'=>($this->input->post('footercontent')),
						'address'=>($this->input->post('address')),
						'defaultsponsors'=>($this->input->post('defaultsponsors')),
						'referrallink'=>($this->input->post('referrallink')),
						// 'sitelogo'=>$sitelogo
						// 'sitelogo'=>$config['upload_path'].$upload_files1
					);

					if(isset($_FILES['sitelogo']['name'])!='')
					{
						$config['upload_path'] = 'uploads/admin/site/';
						$config['allowed_types'] = '*';
						$config['encrypt_name'] = TRUE;

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('sitelogo')) {
							
							//$this->session->set_flashdata('error_message', $this->upload->display_errors());
						$data['sitelogo']=$this->Generalsetting_model->Getsite('sitelogo');

							
						} else {
						
						$upload_files1 = $this->upload->data('file_name');
						$data['sitelogo'] = 'uploads/admin/site/'.$upload_files1;

							
						}
				
					}
					

					$result = $this->Generalsetting_model->sitechange($data);
					// exit;
				}

				else
				{
					$result =0;
				}

				if($result)
				{
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/Sitesetting');

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					redirect('admin/Sitesetting');
				}
				
			
			}
			// redirect('admin/Sitesetting');
	// }
		}

} 
//class ends


