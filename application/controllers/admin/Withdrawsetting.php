<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Withdrawsetting_model');
		$this->lang->load('withdrawsetting');
		
		} else {
			redirect('admin/login');
		}
	} //function ends

	public function index()
	{
			
 		$this->data['withdrawstatus']= $this->Withdrawsetting_model->Getdata('withdrawstatus');
		$this->data['withdrawtype']= $this->Withdrawsetting_model->Getdata('withdrawtype');
		$this->data['withdrawdate']= $this->Withdrawsetting_model->Getdata('withdrawdate');
		$this->data['minwithdraw']= $this->Withdrawsetting_model->Getdata('minwithdraw');
		$this->data['maxwithdraw']= $this->Withdrawsetting_model->Getdata('maxwithdraw');
		$this->data['adminwithdrawfee']= $this->Withdrawsetting_model->Getdata('adminwithdrawfee');
		$this->data['adminwithdrawfeetype']= $this->Withdrawsetting_model->Getdata('adminwithdrawfeetype');
		$this->data['withdrawdaylimit']= $this->Withdrawsetting_model->Getdata('withdrawdaylimit');
		
		$this->load->view('admin/withdrawsetting',$this->data);

	}
	//function ends

	public function updatewithdraw() {
		

		if($this->input->post())
		{
			
			$this->form_validation->set_rules('withdrawstatus', 'withdrawstatus', 'trim|required');
			$this->form_validation->set_rules('withdrawtype', 'withdrawtype', 'trim|required');
			$this->form_validation->set_rules('adminwithdrawfeetype', 'adminwithdrawfeetype', 'trim|required');
			$this->form_validation->set_rules('withdrawdaylimit', 'withdrawdaylimit', 'trim|required|numeric');
			$this->form_validation->set_rules('minwithdraw', 'minwithdraw', 'trim|required|numeric|callback_check_min');
			$this->form_validation->set_rules('maxwithdraw', 'maxwithdraw', 'trim|required|numeric|callback_check_max');
			$this->form_validation->set_rules('adminwithdrawfee', 'adminwithdrawfee', 'trim|required|numeric|callback_check_fee');
			if($this->input->post('withdrawtype')=='weekly')
			{
				$this->form_validation->set_rules('withdrawdate1', 'withdrawdate', 'trim|required');
				$withdrawdate =$this->input->post('withdrawdate1');
			}
			else
			{
				$this->form_validation->set_rules('withdrawdate2', 'withdrawdate', 'trim|required');
				$withdrawdate =$this->input->post('withdrawdate2');
			}

			if($this->form_validation->run() == TRUE) {

				$data = array(
					'withdrawstatus'=>$this->input->post('withdrawstatus'),
					'withdrawtype'=>$this->input->post('withdrawtype'),
					'withdrawdate'=>$withdrawdate,
					'minwithdraw'=>$this->input->post('minwithdraw'),
					'maxwithdraw'=>$this->input->post('maxwithdraw'),
					'adminwithdrawfee'=>$this->input->post('adminwithdrawfee'),
					'adminwithdrawfeetype'=>$this->input->post('adminwithdrawfeetype'),
					'withdrawdaylimit'=>$this->input->post('withdrawdaylimit')
				);
				

				$result = $this->Withdrawsetting_model->Update($data);

				if($result)
				{
					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/withdrawsetting');
				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
					redirect('admin/withdrawsetting');
				}

				
			} else {
				
				$this->data['withdrawstatus']= $this->Withdrawsetting_model->Getdata('withdrawstatus');
				$this->data['withdrawtype']= $this->Withdrawsetting_model->Getdata('withdrawtype');
				$this->data['withdrawdate']= $this->Withdrawsetting_model->Getdata('withdrawdate');
				$this->data['minwithdraw']= $this->Withdrawsetting_model->Getdata('minwithdraw');
				$this->data['maxwithdraw']= $this->Withdrawsetting_model->Getdata('maxwithdraw');
				$this->data['adminwithdrawfee']= $this->Withdrawsetting_model->Getdata('adminwithdrawfee');
				$this->data['adminwithdrawfeetype']= $this->Withdrawsetting_model->Getdata('adminwithdrawfeetype');
				$this->data['withdrawdaylimit']= $this->Withdrawsetting_model->Getdata('withdrawdaylimit');
				
				$this->load->view('admin/withdrawsetting',$this->data);
			}
		} else {
			redirect('admin/withdrawsetting');
		}


	}
	function check_min() {

		if($this->input->post('maxwithdraw') >= $this->input->post('minwithdraw')) {
			return true; 
		} else{
			$this->form_validation->set_message('check_min', '<p><em class="state-error1">The given '.ucwords($this->lang->line('minwithdraw')).' field values less than or equal to '.ucwords($this->lang->line('maxwithdraw')).'</em></p>');
			return false;
		}
	}

	function check_max() {
		
		if($this->input->post('maxwithdraw') >= $this->input->post('minwithdraw')) {
			return true; 
		} else{
			$this->form_validation->set_message('check_max', '<p><em class="state-error1">The given '.ucwords($this->lang->line('minwithdraw')).' field values less than or equal to '.ucwords($this->lang->line('maxwithdraw')).'</em></p>');
			return false;
		}
	}

	function check_fee($str) {
		
		if($this->input->post('maxwithdraw') >= $str) {
			return true; 
		} else{
			$this->form_validation->set_message('check_fee', '<p><em class="state-error1">The given '.ucwords($this->lang->line('adminwithdrawfee')).' field values not exceed '.ucwords($this->lang->line('maxwithdraw')).'</em></p>');
			return false;
		}
	}

	


} //class ends


