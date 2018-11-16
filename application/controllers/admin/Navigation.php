<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigation extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')) {
			$this->load->model('Hoosk_model');
			
			$this->load->helper('url');
			
			$this->lang->load('cms');
			// $this->load->helper('admincontrol');
			
			//Define what page we are on for nav
			$this->data['current'] = $this->uri->segment(2);
		} else {
			redirect('admin/login');
		}
		
	}
	
	public function index()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$this->load->library('pagination');

        $result_per_page =15;  // the number of result per page

        $config['base_url'] = BASE_URL(). '/admin/navigation/';
        $config['total_rows'] = $this->Hoosk_model->countNavigation();
        $config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

		//Get pages from database
		$this->data['nav'] = $this->Hoosk_model->getAllNav($result_per_page, $this->uri->segment(3)); 
		$this->load->helper('form');
		//Load the view
		
		$this->load->view('admin/cms/navigation', $this->data);
	}
	
	public function newNav()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Get pages from database
		$this->data['pages'] = $this->Hoosk_model->getPagesAll(); 
		$this->load->helper('form');
		//Load the view
		
		$this->load->view('admin/cms/newnav', $this->data);
	}
	
	public function editNav()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Get pages from database
		$this->data['pages'] = $this->Hoosk_model->getPagesAll();
		//Get navigation from database
		$this->data['nav'] = $this->Hoosk_model->getNav($this->uri->segment(4)); 
		// print_r($this->data['nav']);
		// $this->load->helper('form');
		//Load the view
		
		$this->load->view('admin/cms/editnav', $this->data);
	}
	
	public function navAdd()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Get navigation from database
		$this->data['page'] = $this->Hoosk_model->getPageNav($this->uri->segment(4)); 
		//Load the view
		$this->load->view('admin/cms/navadd', $this->data);
	}

	public function insert()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('navSlug', 'nav slug', 'trim|alpha_dash|required|max_length[10]|is_unique[arm_navigation.navSlug]');
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->newNav();
		}  else  {
			//Validation passed
			$this->Hoosk_model->insertNav();
			//Return to navigation list
			redirect('/admin/navigation', 'refresh');
	  	}
		
	}
	
	
	public function update()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editNav();
		}  else  {
			//Validation passed
			$this->Hoosk_model->updateNav($this->uri->segment(4));
			//Return to navigation list
			redirect('/admin/navigation', 'refresh');
	  	}
	}
	
	public function deleteNav()
	{
		// Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Delete the nav
		$this->Hoosk_model->removeNav($this->uri->segment(4));
		//Return to user list
		redirect('/admin/navigation', 'refresh');
	}
	
}
