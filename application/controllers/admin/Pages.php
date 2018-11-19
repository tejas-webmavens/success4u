<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')) {
			
			$this->load->model('page_model');
			$this->lang->load('cms');
			$this->load->helper('url');
			$this->load->helper('file');
		} else {
			redirect('admin/login');
		}
	}
	
	// default language's content list 
	public function index()
	{
		$lang_condition = "IsDelete='0'";
		$this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");
		
		$this->data['pages'] = $this->page_model->GetPage($this->config->item('language'));
		// $this->data['pages'] = $this->page_model->GetPage('tam');
		$this->load->view('admin/cms/pages', $this->data);
	}

	// selected language's content list
	public function filter() {

		if($this->input->post()) {

			$LanguageId = $this->input->post('languagename');
			$lang_condition = "IsDelete='0' AND LanguageId='".$LanguageId."'";
			$this->data['pages'] = $this->common_model->GetResults($lang_condition,'arm_cms_page','');
			
			$lang_condition = "IsDelete='0'";
			$this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");
			$this->load->view('admin/cms/pages', $this->data);

		} else {
			redirect('admin/pages');	
		}
	}
	
	public function addPage()
	{
		$lang_condition = "IsDelete='0'";
		$this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");
		$this->load->view('admin/cms/addpage',$this->data);
	}

	
	public function confirm()
	{
		
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		// $this->form_validation->set_rules('pageURL', 'page URL', 'trim|alpha_dash|required');
		$this->form_validation->set_rules('pageTitle', 'page title', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required|alpha_numeric');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->addPage();
		}  else  {
			//Validation passed
			//Add the page
			$this->load->library('Sioen');

			if ($this->input->post('content') != ""){
		        $sirTrevorInput = $this->input->post('content');
		        /*$converter = new Converter();
		        $HTMLContent = $converter->toHtml($sirTrevorInput);*/
		        // echo $HTMLContent;exit;

		    } else {
				$HTMLContent = "";	
			}

			$contentdata = array(
                'pageTitle' => $this->input->post('pageTitle'),
        		'pageUrl' => $this->input->post('navTitle'),
        		'navTitle' => $this->input->post('navTitle'),
        		'LanguageId' => $this->input->post('languagename'),
                'pageContent' => urlencode($this->input->post('content')),
                'pageContentHTML' => urlencode($this->input->post('content')),
                'pageKeywords' => ($this->input->post('pageKeywords')) ? $this->input->post('pageKeywords') : '',
                'pageDescription' => ($this->input->post('pageDescription')) ? $this->input->post('pageDescription') : ''
            );
			// $status = $this->common_model->SaveRecords($ticketdata, 'arm_ticket_list');
            $status = $this->db->insert('arm_cms_page', $contentdata);

			if($status){
				$this->session->set_flashdata('success_message', 'Success! CMS PAGE Updated');
				redirect('admin/pages');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! CMS not Updated');
				$this->load->view('admin/pages/addPage');
			}

			// $this->Hoosk_model->createPage();
			//Return to page list
			redirect('/admin/pages', 'refresh');
	  	}
	}

	public function publish($pageID) {
		$condition = "pageID =" . "'" . $pageID . "'";

		$data = array(
			'Status' => '1'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_cms_page');

		if($status){
			$this->session->set_flashdata('success_message', 'Success! Page is published');
			echo 1;
			//redirect('admin/pages');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Page Not published');
			echo 0;
			//redirect('admin/pages');
		}
	}

	public function unpublish($pageID) {
		$condition = "pageID =" . "'" . $pageID . "'";

		$data = array(
			'Status' => '0'
		);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_cms_page');

		if($status){
			$this->session->set_flashdata('success_message', 'Success! Page is unpublished');
			echo 1;
			//redirect('admin/pages');
		} else {
			$this->session->set_flashdata('error_message', 'Failed! Page not unpublished');
			echo 0;
			//redirect('admin/pages');
		}
	}

	public function DeleteAll() {
		if($this->input->post('page')) {
			foreach ($this->input->post('page') as $key => $value) {
				$condition = "pageID =" . "'" . $value . "'";
				$status = $this->db->delete('arm_cms_page', $condition);
			}
			if($status) {
				$this->session->set_flashdata('success_message', 'Success! Selected page removed');
				redirect('admin/pages');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! Selected page not removed');
				redirect('admin/pages');
			}
		} else {
			redirect('admin/pages');
		}
	}
	
	public function editPage()
	{
		//Load the form helper
		$this->load->helper('form');

		$lang_condition = "IsDelete='0'";
		$this->data['languages'] = $this->common_model->GetResults($lang_condition,"arm_language");

		$pageID = $this->uri->segment(4);
		$condition = "pageID =" . "'" . $pageID . "'";
		$this->data['pages'] = $this->common_model->GetRow($condition, 'arm_cms_page',''); 

		//Load the view
		$this->load->view('admin/cms/editpage', $this->data);
	}

	public function editconfirm()
	{
		
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		// $this->form_validation->set_rules('pageURL', 'page URL', 'trim|alpha_dash|required');
		$this->form_validation->set_rules('pageTitle', 'page title', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required|alpha_numeric');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editPage();
		}  else  {
			//Validation passed
			//Add the page
			$this->load->library('Sioen');

			if ($this->input->post('content') != ""){
		        $sirTrevorInput = $this->input->post('content');
		        /*$converter = new Converter();
		        $HTMLContent = $converter->toHtml($sirTrevorInput);*/
		        // echo $HTMLContent;exit;
		    } else {
				$HTMLContent = "";	
			}

			$contentdata = array(
                'pageTitle' => $this->input->post('pageTitle'),
        		'pageUrl' => $this->input->post('navTitle'),
        		'navTitle' => $this->input->post('navTitle'),
        		'LanguageId' => $this->input->post('languagename'),
                'pageContent' => urlencode($this->input->post('content')),
                'pageContentHTML' => urlencode($this->input->post('content')),
                'pageKeywords' => ($this->input->post('pageKeywords')) ? $this->input->post('pageKeywords') : '',
                'pageDescription' => ($this->input->post('pageDescription')) ? $this->input->post('pageDescription') : ''
            );
			// $status = $this->common_model->SaveRecords($ticketdata, 'arm_ticket_list');
			
        	/*$this->db->update('arm_cms_page', $contentdata);
        	$this->db->where("pageID", $this->input->post('pageID'));*/
            $status = $this->common_model->UpdateRecord($contentdata,"pageID='".$this->input->post('pageID')."'",'arm_cms_page');
           
			if($status){
				$this->session->set_flashdata('success_message', 'Success! CMS page Updated');
				redirect('admin/pages');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! CMS page not Updated');
				$this->load->view('admin/pages/addPage');
			}

			// $this->Hoosk_model->createPage();
			//Return to page list
			redirect('/admin/pages', 'refresh');
	  	}
	}
	
	
	public function delete()
	{
		
		//Delete the page account
		// $this->Hoosk_model->removePage($this->uri->segment(4));
		$this->db->delete('arm_cms_page', array('pageID' => $this->uri->segment(4)));
		//Return to page list
		redirect('/admin/pages', 'refresh');
	}
	
	
	
}
