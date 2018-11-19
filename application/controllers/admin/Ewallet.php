<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ewallet extends CI_Controller {



	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
		
		// Load database
		$this->load->model('admin/Ewallet_model');
		$this->lang->load('ewallet');
		
		
		}  else {
	    	redirect('admin/login');
	    }
		
	} //function ends

	public function index()
	{
		$this->balance();
	}

	public function checkmember($username)
	{

		echo $username = $this->Ewallet_model->getmember($username);
			 
	}

	public function balance()
	{

		if($this->session->userdata('logged_in')) 
		{
			
			if($this->input->post())
			{									
				$this->form_validation->set_rules('username', $this->lang->line('username'),'trim|required|xss_clean|callback_member_check');
				if($this->form_validation->run()== true)
 				{
					
 				$this->data['username'] = $this->input->post('username');
 				$memberid = $this->Ewallet_model->getmemberid($this->input->post('username'));
				$this->data['balance'] = $this->Ewallet_model->checkmemberbalance($memberid);

 				$this->session->set_flashdata('success_message',$this->lang->line('successbalance'));
				$this->load->view('admin/ewallet',$this->data);

				}
				else
				{
					$this->session->set_flashdata('error_message',$this->lang->line('errorbalance'),33);
					$this->load->view('admin/ewallet');
				}
			}
			else
			{
				$this->load->view('admin/ewallet');
			}
				
		}
		else
		{
			redirect('admin/login');
		}
 		//header("Refresh:5;url=".base_url()."index.php/welcome");

	}//function ends


	public function addewallet()
	{

		if($this->session->userdata('logged_in')) 
		{
			if($this->input->post())
			{
						
				$this->form_validation->set_rules('username', $this->lang->line('username'),'trim|required|xss_clean|callback_member_check');
				$this->form_validation->set_rules('nameverify', $this->lang->line('nameverify'),'trim|required');
				$this->form_validation->set_rules('ewallettype', $this->lang->line('ewallettype'),'trim|required');
				$this->form_validation->set_rules('ewalletamount', $this->lang->line('ewalletamount'),'trim|required|numeric');
				$this->form_validation->set_rules('description', $this->lang->line('description'),'trim|required');
		
 				if($this->form_validation->run()== true)
 				{

 					
 				$this->data['username'] = $this->input->post('username');
 				$memberid = $this->Ewallet_model->getmemberid($this->input->post('username'));
 				$mem_details = $this->Ewallet_model->checkmemberrow($memberid);
 				// print_r($mem_details);
 				$Balance =0;
 				if($mem_details)
 				$Balance = $mem_details->Balance;

 				//echo $Balance; exit;
 				$tableName='arm_history';

 				if($memberid!='' && $this->input->post('ewallettype')==6 && $Balance>=$this->input->post('ewalletamount'))
 				{
 					$tnid="PEN".rand(111111111,999999999);
 					$data = array(
					'MemberId'=>$memberid,
					'TypeId'=>$this->input->post('ewallettype'),
					'Credit'=>'0',
					'Debit'=>$this->input->post('ewalletamount'),
					'Balance'=>$Balance - $this->input->post('ewalletamount'),
					'Description'=>$this->input->post('description'),
					'paythrough'=>"Ewallet",
					"TransactionId"=>$tnid,
					'Status'=>'1',
					'DateAdded'=>date('Y-m-d H:i:s'));

					$result = $this->Ewallet_model->SaveRecords($data, $tableName);

 					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
 				}
 				elseif($memberid!='' && $this->input->post('ewallettype')==5)
 				{
 					$txnid="BON".rand(111111111,999999999);
 					$data = array(
					'MemberId'=>$memberid,
					'TypeId'=>$this->input->post('ewallettype'),
					'Credit'=>$this->input->post('ewalletamount'),
					'Debit'=>'0',
					'Balance'=>$Balance + $this->input->post('ewalletamount'),
					'Description'=>$this->input->post('description'),
					'paythrough'=>"Ewallet",
					"TransactionId"=>$txnid,
					'Status'=>'1',
					'DateAdded'=>date('Y-m-d H:i:s'));

					$result = $this->Ewallet_model->SaveRecords($data, $tableName);

 					$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
 				}
 				else
 				{
 					$this->session->set_flashdata('error_message',ucwords($this->lang->line('errorinsufficient')).$Balance);
 				}
				
				
				

				}
				else
				{
					
					$this->session->set_flashdata('error_message',$this->lang->line('erroraddwallet'));
					
				}
				$this->load->view('admin/addewallet');
	
			}
			else
			{
				$this->load->view('admin/addewallet');
			}
		
		}
		else
		{
			redirect('admin/login');
		}
			//header("Refresh:5;url=".base_url()."index.php/welcome");

	}//function ends


	public function member_check($str)
	{
		
		
		$condition = "UserName =" . "'" . $str . "'";
		$this->db->select('*');
		$this->db->from('arm_members');
		$this->db->where($condition);
				
		$query = $this->db->get();
		if ($query->num_rows()>0) 
			{
				/*$mem_details = $query->row();
				
				if($mem_details->MemberStatus=='Active')
				{
					return true; 
				}
				else{
			
			$this->form_validation->set_message('member_check', '<p><em class="state-error1">'.ucwords($this->lang->line('memberinactive')).'</em></p>');
			return false;
					}*/
			return true;
			}
		else{
			
			$this->form_validation->set_message('member_check', '<p><em class="state-error1">'.ucwords($this->lang->line('membernomatch')).'</em></p>');
			return false;
		}


	}

	


	} //class ends


