<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	}
	public function subscribe() {

		if(valid_email($this->input->post('mailid'))) {
			$condition = "MailId='".$this->input->post('mailid')."'";
			$check_subscribe = $this->common_model->GetRow($condition, 'arm_subscribe_list');
			if(!$check_subscribe) {
				// check referal name

				if($this->input->post('ref')!='')
				$checkname = $this->common_model->getreferralname($this->input->post('ref'));

				if($checkname) {
					$memberdet = $this->common_model->GetRow("ReferralName='".$this->input->post('ref')."' ","arm_members");
					$RefereId = $memberdet->MemberId;
				} else {
					$RefereId = 1;
				}

				$data = array(
					'RefereId' => $RefereId,
					'MailId' => $this->input->post('mailid'),
					'Status' => '1',
					'DateAdded' => date('Y-m-d H:i:s')
				);

				$sub_status = $this->db->insert('arm_subscribe_list',$data);

				if($sub_status) {
					$json['success'] = 'Success! Your subscribe.';
				} else {
					$json['error'] = 'Fail! please try again.';
				}
			} else {
				$json['error'] = 'Fail! Already subscribe.';
			}

		} else {
			$json['error'] = 'Fail! Invalid Email.';
		}
		
		echo json_encode($json);
	}
	

}
?>