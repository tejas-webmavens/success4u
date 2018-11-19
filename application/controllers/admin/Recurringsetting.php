<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recurringsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Recurringsetting_model');
		
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index()
	{

		$this->lang->load('recurringsetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
					//print_r($this->input->post());
				
				$this->form_validation->set_rules('weekstartday', $this->lang->line('weekstartday'), 'trim|required');
				$this->form_validation->set_rules('monthstartdate', $this->lang->line('monthstartdate'), 'trim|required');
				 			

 				if($this->form_validation->run()== true)
 				{

 					$data = array(
					'weekstartday'=>$this->input->post('weekstartday'),
					'monthstartdate'=>$this->input->post('monthstartdate'));

				$result = $this->Recurringsetting_model->Update($data);

				$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));

				}
				else
				{
					
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}


				
				$this->data['weekstartday']= $this->Recurringsetting_model->Getdata('weekstartday');
				$this->data['monthstartdate']= $this->Recurringsetting_model->Getdata('monthstartdate');
				
				$this->load->view('admin/recurringsetting',$this->data);
			}
			else
			{
				$this->data['weekstartday']= $this->Recurringsetting_model->Getdata('weekstartday');
				$this->data['monthstartdate']= $this->Recurringsetting_model->Getdata('monthstartdate');

				$this->load->view('admin/recurringsetting',$this->data);
			}

				
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends



	} //class ends


