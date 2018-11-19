<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fundsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Fundsetting_model');
		
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index()
	{

		$this->lang->load('fundsetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
					//print_r($this->input->post());
				
				$this->form_validation->set_rules('transferstatus', $this->lang->line('transferstatus'), 'trim|required');
				$this->form_validation->set_rules('minfund', $this->lang->line('minamount'), 'trim|required|numeric|callback_min_check');
				$this->form_validation->set_rules('maxfund', $this->lang->line('maxamount'), 'trim|required|numeric|callback_max_check');
				$this->form_validation->set_rules('adminfee', $this->lang->line('adminfee'), 'trim|required|numeric');
				$this->form_validation->set_rules('transferfeetype', $this->lang->line('transferfeetype'), 'trim|required');
				//$this->form_validation->set_rules('minfund', $this->lang->line('minamount'), 'trim|required');
 			

 				if($this->form_validation->run()== true)
 				{

 					$data = array(
					'transferstatus'=>$this->input->post('transferstatus'),
					'minfund'=>$this->input->post('minfund'),
					'maxfund'=>$this->input->post('maxfund'),
					'adminfee'=>$this->input->post('adminfee'),
					'adminfeetype'=>$this->input->post('adminfeetype'),
					'transferfeetype'=>$this->input->post('transferfeetype'));

				$result = $this->Fundsetting_model->Update($data);

				}
				else
				{
					$result =0;
				}


				if($result)
				{
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}

				$this->data['transferstatus']= $this->Fundsetting_model->Getdata('transferstatus');
				$this->data['minfund']= $this->Fundsetting_model->Getdata('minfund');
				$this->data['maxfund']= $this->Fundsetting_model->Getdata('maxfund');
				$this->data['adminfee']= $this->Fundsetting_model->Getdata('adminfee');
				$this->data['adminfeetype']= $this->Fundsetting_model->Getdata('adminfeetype');
				$this->data['transferfeetype']= $this->Fundsetting_model->Getdata('transferfeetype');
				


				$this->load->view('admin/fundsetting',$this->data);
			}
			else
			{
				$this->data['transferstatus']= $this->Fundsetting_model->Getdata('transferstatus');
				$this->data['minfund']= $this->Fundsetting_model->Getdata('minfund');
				$this->data['maxfund']= $this->Fundsetting_model->Getdata('maxfund');
				$this->data['adminfee']= $this->Fundsetting_model->Getdata('adminfee');
				$this->data['adminfeetype']= $this->Fundsetting_model->Getdata('adminfeetype');
				$this->data['transferfeetype']= $this->Fundsetting_model->Getdata('transferfeetype');
				
				$this->load->view('admin/fundsetting',$this->data);
			}

				
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends


	public function min_check()
	{

		//echo $str,'<'.$max;
		if($this->input->post('maxfund') >= $this->input->post('minfund')) 
			{
				return true; 
			}
		else{
				
			$this->form_validation->set_message('min_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('minfund')).' field values less than or equal to '.ucwords($this->lang->line('maxfund')).'</em></p>');
			return false;
		}
	}

	public function max_check()
	{
		//echo $str.'>'.$min;
		

		if($this->input->post('maxfund') >= $this->input->post('minfund')) 
			{
				return true; 
			}
		else{
			//echo'<p><em class="state-error1">The given '.ucwords($this->lang->line('maxwithdraw')).' field values greater than or equal to '.ucwords($this->lang->line('minwithdraw')).'</em></p>';
			$this->form_validation->set_message('max_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('maxfund')).' field values greater than or equal to '.ucwords($this->lang->line('minfund')).'</em></p>');
			return false;
		}
	}

} //class ends


