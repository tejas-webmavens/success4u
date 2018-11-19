<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewardsetting extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Rewardsetting_model');
		
		
		}  else {
	    	redirect('admin/login');
	    }
	} //function ends

	public function index()
	{
		$this->lang->load('rewardsetting');

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{
				
				//set empty value 	
				$dailyref_check=$dailyReferral=$weeklyref_check=$weeklyReferral=$monthlyref_check=$monthlyReferral="";


					foreach ($this->input->post('dailyReferralcount') as $key => $value) 
					{
						$dailyref_check.=$this->input->post('dailyReferralcount')[$key].$this->input->post('dailyReferralcommission')[$key].",";

						if($this->input->post('dailyReferralcommission')[$key]!="" && $this->input->post('dailyReferralcount')[$key]!="")
						{
							
							$dailyReferral.=$this->input->post('dailyReferralcount')[$key]."-".$this->input->post('dailyReferralcommission')[$key].",";
						}
						
						
					}

					foreach ($this->input->post('weeklyReferralcount') as $key => $value) 
					{
						$weeklyref_check.=$this->input->post('weeklyReferralcount')[$key].$this->input->post('weeklyReferralcommission')[$key].",";

						if($this->input->post('weeklyReferralcommission')[$key]!="" && $this->input->post('weeklyReferralcount')[$key]!="")
						{
							
							$weeklyReferral.=$this->input->post('weeklyReferralcount')[$key]."-".$this->input->post('weeklyReferralcommission')[$key].",";
						}
						
						
					}
					foreach ($this->input->post('monthlyReferralcount') as $key => $value) 
					{
						$monthlyref_check.=$this->input->post('monthlyReferralcount')[$key].$this->input->post('monthlyReferralcommission')[$key].",";

						if($this->input->post('monthlyReferralcount')[$key]!="" && $this->input->post('monthlyReferralcommission')[$key]!="")
						{
							
							$monthlyReferral.=$this->input->post('monthlyReferralcount')[$key]."-".$this->input->post('monthlyReferralcommission')[$key].",";
						}
						
						
					}
					
					//$findailyref=trim($dailyReferral,",");
						
			
				
					$this->form_validation->set_rules('dailyReferral', 'dailyReferral', 'trim|xss_clean|callback_dailyref_check['.$dailyref_check.']');
					$this->form_validation->set_rules('weeklyReferral', 'weeklyReferral', 'trim|xss_clean|callback_weeklyref_check['.$weeklyref_check.']');
					$this->form_validation->set_rules('monthlyReferral', 'monthlyReferral', 'trim|xss_clean|callback_monthlyref_check['.$monthlyref_check.']');
					
					$this->form_validation->set_rules('dailyrewardstatus', 'dailyrewardstatus', 'trim|required');
					$this->form_validation->set_rules('weeklyrewardstatus', 'weeklyrewardstatus', 'trim|required');
					$this->form_validation->set_rules('monthlyrewardstatus', 'monthlyrewardstatus', 'trim|required');
	 				
				/*	$this->form_validation->set_rules('dailyrewardcommissiontype', 'dailyrewardcommissiontype', 'trim|required');
					$this->form_validation->set_rules('weeklyrewardcommissiontype', 'weeklyrewardcommissiontype', 'trim|required');
					$this->form_validation->set_rules('monthlyrewardcommissiontype', 'monthlyrewardcommissiontype', 'trim|required');
					*/
					 // echo $this->form_validation->run();
					 /*print_r($this->input->post());
					exit;
*/
 				if($this->form_validation->run() == true)
 				{
 					$data = array(
					'dailyReferral'=>trim($dailyReferral,","),
					'weeklyReferral'=>trim($weeklyReferral,","),
					'monthlyReferral'=>trim($monthlyReferral,","),
					'dailyrewardstatus'=>$this->input->post('dailyrewardstatus'),
					'weeklyrewardstatus'=>$this->input->post('weeklyrewardstatus'),
					'monthlyrewardstatus'=>$this->input->post('monthlyrewardstatus'));
					/*'dailyrewardcommissiontype'=>$this->input->post('dailyrewardcommissiontype'),
					'weeklyrewardcommissiontype'=>$this->input->post('weeklyrewardcommissiontype'),
					'monthlyrewardcommissiontype'=>$this->input->post('monthlyrewardcommissiontype'));*/

					$result = $this->Rewardsetting_model->Update($data);

					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
					redirect('admin/rewardsetting');
 				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
				}

				$this->data['dailyReferral']= $this->Rewardsetting_model->Getdata('dailyReferral');
				$this->data['weeklyReferral']= $this->Rewardsetting_model->Getdata('weeklyReferral');
				$this->data['monthlyReferral']= $this->Rewardsetting_model->Getdata('monthlyReferral');
				$this->data['dailyrewardstatus']= $this->Rewardsetting_model->Getdata('dailyrewardstatus');
				$this->data['weeklyrewardstatus']= $this->Rewardsetting_model->Getdata('weeklyrewardstatus');
				$this->data['monthlyrewardstatus']= $this->Rewardsetting_model->Getdata('monthlyrewardstatus');
				$this->data['dailyrewardcommissiontype']= $this->Rewardsetting_model->Getdata('dailyrewardcommissiontype');
				$this->data['weeklyrewardcommissiontype']= $this->Rewardsetting_model->Getdata('weeklyrewardcommissiontype');
				$this->data['monthlyrewardcommissiontype']= $this->Rewardsetting_model->Getdata('monthlyrewardcommissiontype');
			

				$this->load->view('admin/rewardsetting',$this->data);
			}
			else
			{
				$this->data['dailyReferral']= $this->Rewardsetting_model->Getdata('dailyReferral');
				$this->data['weeklyReferral']= $this->Rewardsetting_model->Getdata('weeklyReferral');
				$this->data['monthlyReferral']= $this->Rewardsetting_model->Getdata('monthlyReferral');
				$this->data['dailyrewardstatus']= $this->Rewardsetting_model->Getdata('dailyrewardstatus');
				$this->data['weeklyrewardstatus']= $this->Rewardsetting_model->Getdata('weeklyrewardstatus');
				$this->data['monthlyrewardstatus']= $this->Rewardsetting_model->Getdata('monthlyrewardstatus');
				$this->data['dailyrewardcommissiontype']= $this->Rewardsetting_model->Getdata('dailyrewardcommissiontype');
				$this->data['weeklyrewardcommissiontype']= $this->Rewardsetting_model->Getdata('weeklyrewardcommissiontype');
				$this->data['monthlyrewardcommissiontype']= $this->Rewardsetting_model->Getdata('monthlyrewardcommissiontype');
			
				
				$this->load->view('admin/rewardsetting',$this->data);
			}

				
		}
		else
		{
			redirect('admin/login');

					
		}


 		//header("Refresh:5;url=".base_url()."index.php/welcome");

		}//function ends

		public function dailyref_check($str,$dailyref)
		{
		
		$dat1=str_replace(",","",str_replace("-", "", $dailyref));
		$dat=str_replace(",","",$dat1);
		
		$flag=0;
			if(!is_numeric($dat))
			{
				$flag=1;
			}

		
		

		if ($flag==0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('dailyref_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('dailyReferral')).' field values are  only in numbers</em></p>');
			return false;
		}
		
		}

		public function weeklyref_check($str,$weeklyref)
		{
		
		$dat1=str_replace(",","",str_replace("-", "", $weeklyref));
		$dat=str_replace(",","",$dat1);
		
		$flag=0;
			if(!is_numeric($dat))
			{
				$flag=1;
			}

		
		

		if ($flag==0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('weeklyref_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('weeklyReferral')).' field values are  only in numbers</em></p>');
			return false;
		}
		
		}

		public function monthlyref_check($str,$monthlyref)
		{
		
		$dat1=str_replace(",","",str_replace("-", "", $monthlyref));
		$dat=str_replace(",","",$dat1);
		
		$flag=0;
			if(!is_numeric($dat))
			{
				$flag=1;
			}

		
		

		if ($flag==0) 
			{
				return true; 
				}
		else{
			
			$this->form_validation->set_message('monthlyref_check', '<p><em class="state-error1">The given '.ucwords($this->lang->line('monthlyReferral')).' field values are  only in numbers</em></p>');
			return false;
		}
		
		}



	} //class ends


