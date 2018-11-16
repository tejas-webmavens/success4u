<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generalsetting extends CI_Controller {


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


				$this->data['allowpicture']= $this->Generalsetting_model->Getsite('allowpicture');
				$this->data['emailapproval']= $this->Generalsetting_model->Getsite('emailapproval');
				$this->data['mobileapproval']= $this->Generalsetting_model->Getsite('mobileapproval');
				$this->data['usecaptcha']= $this->Generalsetting_model->Getsite('usecaptcha');
				$this->data['allowregistration']= $this->Generalsetting_model->Getsite('allowregistration');
				$this->data['allowlogin']= $this->Generalsetting_model->Getsite('allowlogin');
				$this->data['uniqueip']= $this->Generalsetting_model->Getsite('uniqueip');
				// $this->data['uniqueemailid']= $this->Generalsetting_model->Getsite('uniqueemailid');
				$this->data['uniquemobile']= $this->Generalsetting_model->Getsite('uniquemobile');
				$this->data['allowusers']= $this->Generalsetting_model->Getsite('allowusers');
				$this->data['defaultsponsors']= $this->Generalsetting_model->Getsite('defaultsponsors');
				$this->data['sponsorslist']= $this->Generalsetting_model->Getsponsormember();
				$this->data['footercontent']= $this->Generalsetting_model->Getsite('footercontent');
				$this->data['address']= $this->Generalsetting_model->Getsite('address');
				$this->data['content']= $this->Generalsetting_model->Getsite('bottomcontent');

				$this->data['referrallink']= $this->Generalsetting_model->Getsite('referrallink');
				//$this->data['sitebanner']= $this->Generalsetting_model->Getsite('sitebanner');
			
				$this->load->view('admin/generalsetting',$this->data);
				
		
		
 		

	}//function ends


	public function settings(){
		if($this->input->post())
			{
				
			
				$this->form_validation->set_rules('sitename', 'sitename', 'trim|required');
				$this->form_validation->set_rules('siteurl', 'siteurl', 'trim|required');
				$this->form_validation->set_rules('adminmailid', 'adminmailid', 'trim|required|valid_email');
 			
 				$site_img = 'uploads/admin/site/sitelogo.jpg';
					
 				if($this->form_validation->run() == true)	
 				{

	 				if($_FILES['sitelogo']['tmp_name']!='')
					{
						unlink($site_img);
						move_uploaded_file($_FILES['sitelogo']['tmp_name'], $site_img);
					}

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
						/*'uniqueemailid'=>($this->input->post('uniqueemailid')),*/
						'uniquemobile'=>($this->input->post('uniquemobile')),
						'allowusers'=>($this->input->post('allowusers')),
						'footercontent'=>($this->input->post('footercontent')),
						'address'=>($this->input->post('address')),
						'bottomcontent'=>($this->input->post('content')),
						'defaultsponsors'=>($this->input->post('defaultsponsors')),
						'referrallink'=>($this->input->post('referrallink')),
						'sitelogo'=>$site_img
					);

					$result = $this->Generalsetting_model->sitechange($data);

				}
				else
				{
					$result =0;
				}

				if($result)
				{
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/generalsetting');

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					redirect('admin/generalsetting');
				}
				
			
			}
			redirect('admin/Generalsetting');
	}

} //class ends


