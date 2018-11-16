<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

		
		$this->load->model('admin/testimonial_model');
		$this->load->model('product_model');
		$this->load->model('page_model');
		$this->load->model('common_model');
		
		// Load database
		
		// change language
		

		// load language
		
		$this->lang->load('user/common',$this->session->userdata('language'));


	}

	public function index()
	{
		
		$siteset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitestatus'", "arm_setting");
		if($siteset->ContentValue=="Off")
		{
			redirect("offsite");
		}

		//set referral details
		if($this->input->get('ref'))
		{
			$membercheckdet = $this->common_model->GetRow("ReferralName='".$this->input->get('ref')."'","arm_members");
			if($membercheckdet)
			{
				$this->session->unset_userdata('referral_name');
				$this->session->unset_userdata('referral_id');
				$this->session->set_userdata("referral_name",$this->input->get('ref'));
				$this->session->set_userdata("referral_id",$membercheckdet->MemberId);
			}	
		}	

		$this->lang->load('user/common');
		$this->load->model('admin/testimonial_model');
		$this->load->model('product_model');
		$this->load->model('page_model');
		$this->load->model('common_model');


		$pageID = 'membershipwithbenefits';
		$contents = '';
		
		if($this->session->userdata('language')){

        	$contents = $this->page_model->GetpageContent($pageID,$this->session->userdata('language'));

		} else {

			if($contents==''){
	        	$contents = $this->page_model->GetpageContent($pageID,$this->config->item('language'));
	    	}

    	}

    	$page1ID = 'aboutcompany';
		$content1 = '';
		
		if($this->session->userdata('language')){

        	$content1 = $this->page_model->GetpageContent($page1ID,$this->session->userdata('language'));

		} else {

			if($content1==''){
	        	$content1 = $this->page_model->GetpageContent($page1ID,$this->config->item('language'));
	    	}

    	}
    	$belowaboutcomp_page = 'belowaboutcompany';
		$belowaboutcomp_pagecontent = '';
		
		if($this->session->userdata('language')){

        	$belowaboutcomp_pagecontent = $this->page_model->GetpageContent($belowaboutcomp_page,$this->session->userdata('language'));

		} else {

			if($belowaboutcomp_pagecontent==''){
	        	$belowaboutcomp_pagecontent = $this->page_model->GetpageContent($belowaboutcomp_page,$this->config->item('language'));
	    	}

    	}

		
		
		$this->data['testimonial'] = $this->testimonial_model->GetTestimonialall();
		$this->data['latest_product'] = $this->product_model->GetLatestProduct();
		$this->data['contents'] = $contents;
		$this->data['content1'] = $content1;
		$this->data['belowaboutcomp_pagecontent'] = $belowaboutcomp_pagecontent;
		
		$this->load->view('user/user',$this->data);

	}

	public function username_check($str)
	{
		if ($str == 'test')
		{
			$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function signup() {

		$this->load->model('common_model');
		

		if($this->input->post()) {
			$from_error = array();
			if($this->input->post('firstname')=='' || strlen($this->input->post('firstname')) < 3)
				$from_error['firstname'] = 'First name is required and more then 3 characters';
				
			if($this->input->post('lastname')=='' || strlen($this->input->post('lastname')) < 0)
				$from_error['lastname'] = 'Last name is required';
				
			if($this->input->post('email')=='' || strlen($this->input->post('email')) < 0)
				$from_error['email'] = 'Email is required';
			else if(!valid_email($this->input->post('email')))
				$from_error['email'] = 'This is invalid email!';
				

			if($this->input->post('phone')=='' || strlen($this->input->post('phone')) < 10)
				$from_error['phone'] = 'Phone number is required and minimum 10 digit.';
				


			$this->form_validation->set_rules('firstname', 'firstname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'lastname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Email', 'email', 'trim|required|xss_clean');
			$this->form_validation->set_rules('Phone', 'phone', 'trim|required|xss_clean|min_length[10]|max_length[13]');
			
			if ($this->form_validation->run() == FALSE) 
			{

				$condition = "ReferralName =" . "'" . $this->input->post('ReferralName') . "' AND MemberStatus ='Active'";
				$Member = $this->common_model->GetRow($condition, 'arm_members');
				if($Member) {
					$RefId = $Member->MemberId;
				} else {
					$RefId = '1';
				}

				$data = array(
					'RefId' =>	$RefId,
					'FirstName' => $this->input->post('firstname'),
					'LastName' => $this->input->post('lastname'),
					'Email' => $this->input->post('email'),
					'Phone' => $this->input->post('phone'),
					'Status' => '0',
					'StartDate' => date('Y-m-d H:i:s'),
					'Ip' => $this->input->ip_address()
					
				);
				
				$status = $this->common_model->SaveRecords($data, 'arm_lead_member');

				if($status){
					$this->session->set_flashdata('success_message', 'Success! User details Updated');
					redirect('user/Lead');

				} 
			} else {
				redirect($this->input->post('url'));
			}
		}
	}


	public function test()
	{
	  echo "hai";

	  $pageID = 'membershipwithbenefits';
		$contents = '';
		
		if($this->session->userdata('language')){

        	$contents = $this->page_model->GetpageContent($pageID,$this->session->userdata('language'));

		} else {

			if($contents==''){
	        	$contents = $this->page_model->GetpageContent($pageID,$this->config->item('language'));
	    	}

    	}

    	$page1ID = 'aboutcompany';
		$content1 = '';
		
		if($this->session->userdata('language')){

        	$content1 = $this->page_model->GetpageContent($page1ID,$this->session->userdata('language'));

		} else {

			if($content1==''){
	        	$content1 = $this->page_model->GetpageContent($page1ID,$this->config->item('language'));
	    	}

    	}

    	$belowaboutcomp_page = 'belowaboutcompany';
		$belowaboutcomp_pagecontent = '';
		
		if($this->session->userdata('language')){

        	$belowaboutcomp_pagecontent = $this->page_model->GetpageContent($belowaboutcomp_page,$this->session->userdata('language'));

		} else {

			if($belowaboutcomp_pagecontent==''){
	        	$belowaboutcomp_pagecontent = $this->page_model->GetpageContent($belowaboutcomp_page,$this->config->item('language'));
	    	}

    	}
	
		$this->data['latest_product'] = $this->product_model->GetLatestProduct();
		$this->data['testimonial'] = $this->testimonial_model->GetTestimonialall();
		$this->data['contents'] = $contents;
		$this->data['content1'] = $content1;
		$this->data['belowaboutcomp_pagecontent'] = $belowaboutcomp_pagecontent;

		//set referral details
		if($this->input->get('ref'))
		{
			$membercheckdet = $this->common_model->GetRow("ReferralName='".$this->input->get('ref')."'","arm_members");
			if($membercheckdet)
			{
				$this->session->unset_userdata('referral_name');
				$this->session->unset_userdata('referral_id');
				$this->session->set_userdata("referral_name",$this->input->get('ref'));
				$this->session->set_userdata("referral_id",$membercheckdet->MemberId);
			}	
		}	

		$this->load->view('user/user', $this->data);
		// echo "hai";
	}

	public function dummy()
	{
	   $this->load->view('user/dummy');
	}

}
