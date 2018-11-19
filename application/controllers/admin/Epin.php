<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Epin extends CI_Controller {



		public function __construct() {
			parent::__construct();
		 $this->data['matrixsetting']=$this->common_model->GetRow('MatrixStatus=1',"arm_matrixsetting");

		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			
			// Load database
			
			$this->load->model('admin/Epin_model');
			$this->load->model('admin/Smtpsetting_model');
			$this->lang->load('epin');

			//$this->load->library('pagination');
			
			}  else {
	    	redirect('admin/login');
	    	}
		} //function ends

		public function index()
		{
			if($this->session->userdata('logged_in')) {
				

					$this->data['field'] = $this->Epin_model->Getfields();
					$this->load->view('admin/epinlist', $this->data['field']);
				
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
		}
		
		public function epins()
		{
				

			if($this->session->userdata('logged_in')) {
				

					$this->data['field'] = $this->Epin_model->Getfields();
					$this->load->view('admin/epinlist', $this->data['field']);
				
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
	 		
		}

		public function expiryepin()
		{
				

			if($this->session->userdata('logged_in')) {
				if($this->input->post('inputname')) {
					if($this->input->post('active'))
					{
						print_r($this->input->post());
						exit;
					} else {
						foreach ($this->input->post('inputname') as $customer_id) {
							print_r($this->input->post());
							//$status = $this->Packagesetting_model->DeletePackage($package_id);
						}
						
						if($status) {
							redirect('admin/epin');
						}
					}
				} else {
					$this->data['field'] = $this->Epin_model->Getexpiryepinfields();
					$this->load->view('admin/expiryepinlist', $this->data['field']);
				}
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
	 		
		}


		public function searchexpiryepin()
		{
		if($this->input->post()) 
		{
			
			$condition = "isDelete= '0' AND Status IN ('0','1') AND ExpiryDay <=" . "'" . date('Y-m-d')."'";
			$packagedetail = $this->Epin_model->Getpackageid(strtolower($this->input->post('package')));
			if($this->input->post('package') && $packagedetail)
				$condition .= " AND EpinPackageId LIKE" . "'%" . $packagedetail[0]->PackageId . "%'";
			$memdetail = $this->common_model->GetRow("UserName='".$this->input->post('username')."'","arm_members");
			// print_r($memdetail); 
			if($this->input->post('username'))
			{
				if(isset($memdetail->MemberId))
				 $condition .= " AND AllocatedBy ='" . $memdetail->MemberId . "' OR UsedBy='" . $memdetail->MemberId . "'";
			}

			if($this->input->post('epin'))
				$condition .= " AND EpinTransactionId LIKE" . "'%" . $this->input->post('epin') . "%'";

			if($this->input->post('status')!='')
				$condition .= " AND EpinStatus =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(ExpiryDay) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(ExpiryDay) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";
		// echo $condition; exit;
			$this->data['field'] = $this->common_model->GetResults($condition, 'arm_epin');

			$this->load->view('admin/expiryepinlist', $this->data['field']);
			
		} else {
			$this->data['field'] = $this->Epin_model->Getexpiryepinfields();
			$this->load->view('admin/expiryepinlist');
		}
	}




		public function searchepin(){
		
		if($this->input->post()) 
		{
			$condition = "isDelete= '0'";

			$packagedetail = $this->Epin_model->Getpackageid(strtolower($this->input->post('package')));
			
			if($this->input->post('package') && $packagedetail)
				$condition .= " AND EpinPackageId LIKE" . "'%" . $packagedetail[0]->PackageId . "%'";


			$memdetail = $this->common_model->GetRow("UserName='".$this->input->post('username')."'","arm_members");
			// print_r($memdetail); 
			if($this->input->post('username'))
			{
				if(isset($memdetail->MemberId))
				 $condition .= " AND AllocatedBy ='" . $memdetail->MemberId . "' OR UsedBy='" . $memdetail->MemberId . "'";
			}
			
			if($this->input->post('epin'))
				$condition .= " AND EpinTransactionId LIKE" . "'%" . $this->input->post('epin') . "%'";

			if($this->input->post('status')!='')
				$condition .= " AND EpinStatus =" . "'" . $this->input->post('status') . "'";

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				 $condition .= " AND DATE(ExpiryDay) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(ExpiryDay) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";

			

			$this->data['field'] = $this->common_model->GetResults($condition, 'arm_epin');
			
			$this->load->view('admin/epinlist', $this->data['field']);
			
		} else {
			$this->data['field'] = $this->Epin_model->Getfields();
			$this->load->view('admin/epinlist');
		}
	}

	public function searchreqepin(){
		
		if($this->input->post()) 
		{

			$condition = "a.RequestStatus= '0'";

			if($this->input->post('package'))
				$condition .= " AND c.PackageName LIKE" . "'%" . $this->input->post('package') . "%'";

			if($this->input->post('username'))
				 $condition .= " AND b.UserName LIKE" . "'%" . $this->input->post('username') . "%'";

			if($this->input->post('paythrough'))
				$condition .= " AND a.PayThrough LIKE" . "'%" . $this->input->post('paythrough') . "%'";
			
			if($this->input->post('paymentreference'))
				$condition .= " AND a.PaymentReference LIKE" . "'%" . $this->input->post('paymentreference') . "%'";

			

			if($this->input->post('datepicker1') && $this->input->post('datepicker2'))
				$condition .= " AND DATE(a.DateAdded) >=" . "'" . date('Y-m-d', strtotime($this->input->post('datepicker1'))) . "' AND DATE(a.DateAdded) <= " . "'" . date('Y-m-d',strtotime($this->input->post('datepicker2'))) . "'";

			$this->data['field'] = $this->Epin_model->Getrequestsearchlist($condition);

			$this->load->view('admin/requestepinlist', $this->data['field']);
			
		} else {
			$this->data['field'] = $this->Epin_model->Getrequestlist();
			$this->load->view('admin/requestepinlist');
		}
	}

		public function request()
		{
				

			if($this->session->userdata('logged_in')) {
		 $this->data['matrixsetting']=$this->common_model->GetRow('MatrixStatus=1',"arm_matrixsetting");

				if($this->input->post('inputname')) {
					if($this->input->post('active'))
					{
						print_r($this->input->post());
						exit;
					} else {
						foreach ($this->input->post('inputname') as $customer_id) {
							print_r($this->input->post());
							//$status = $this->Packagesetting_model->DeletePackage($package_id);
						}
						
						if($status) {
							redirect('admin/epin');
						}
					}
				} else {
				 $this->data['matrixsetting']=$this->common_model->GetRow('MatrixStatus=1',"arm_matrixsetting");

					$this->data['field'] = $this->Epin_model->Getrequestlist();
					$this->load->view('admin/requestepinlist', $this->data['field']);
				}
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
	 		
		}

	public function cancelurequests()
		{
				

			if($this->session->userdata('logged_in')) {
				if($this->input->post('inputname')) {
					if($this->input->post('active'))
					{
						print_r($this->input->post());
						exit;
					} else {
						foreach ($this->input->post('inputname') as $customer_id) {
							print_r($this->input->post());
							//$status = $this->Packagesetting_model->DeletePackage($package_id);
						}
						
						if($status) {
							redirect('admin/epin');
						}
					}
				} else {
					$this->data['field'] = $this->Epin_model->Getcancelrequestlist();
					$this->load->view('admin/cancelurequestlist', $this->data['field']);
				}
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
	 		
		}



		public function allocatepin($id)
		{
				
			if($this->session->userdata('logged_in')) 
			{

				$condition = "RequestId =" . "'" . $id . "'";
				$table ="arm_requestepin";
				$SelectColumn ="*";

				$resultdata = $this->common_model->GetRow($condition,$table);
				
								
				$data = array(
						'EpinStatus'=>'1',
						'AllocatedBy'=>$resultdata->UserId,
						'ModifiedDate'=>date("Y-m-d H:i:s"));

				$condition = "EpinPackageId =" . "'" . $resultdata->PackageId . "' AND EpinStatus='0' order by EpinRecordId ASC";
				$tableName ="arm_epin";

				$epincount =$this->Epin_model->GetRowCount($condition,$tableName);
				$epindetail =$this->common_model->GetResults($condition,$tableName);
					
					
				if($resultdata->EpinCount!='' && $resultdata->EpinCount!="0" && $resultdata->EpinCount<=$epincount) 
				{


				for($i=0; $i<$resultdata->EpinCount;$i++)
				{
					//print_r($data);
					$Ucondition = "EpinRecordId='".$epindetail[$i]->EpinRecordId."'";
					$updatedata = $this->common_model->UpdateRecord($data, $Ucondition, $tableName);
				}
				
				if($updatedata)
				{
					$rdata = array(
						'RequestStatus'=>'1',
						'ModifiedDate'=>date("Y-m-d H:i:s"));

				$rcondition = "RequestId =" . "'" . $resultdata->RequestId . "' AND UserId='" . $resultdata->UserId . "' ";
				$rtableName ="arm_requestepin";

				$updaterequestdata = $this->common_model->UpdateRecord($rdata, $rcondition, $rtableName);

					$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
				}
				else
				{
					$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
				}
				}
				else
				{
				 $this->session->set_flashdata('error_message', $this->lang->line('errorepincount'));
				}
				
				redirect('admin/epin/request');

							
				
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
	 		
		}

		function cancelepin($id)
		{

			if($this->session->userdata('logged_in')) 
			{
				$condition = "RequestId =" . "'" . $id . "'";
				$table ="arm_requestepin";
				$SelectColumn ="*";

				$resultdata = $this->common_model->GetRow($condition,$table);


				$rdata = array('RequestStatus'=>'2',
								'ModifiedDate'=>date("Y-m-d H:i:s"));

				$rcondition = "RequestId =" . "'" . $resultdata->RequestId . "' AND UserId='" . $resultdata->UserId . "' ";
				$rtableName ="arm_requestepin";

				$updaterequestdata = $this->common_model->UpdateRecord($rdata, $rcondition, $rtableName);
				if($updaterequestdata)
				{
					$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
				}
				else
				{
					$this->session->set_flashdata('error_message', $this->lang->line('errormessage'));
				}
				
				redirect('admin/epin/request');
			} else {
				redirect('admin/login');
			}


		}

		public function mailepin($id)
		{
			if($this->session->userdata('logged_in')) 
			{
				$smtpstatus = $this->Smtpsetting_model->Getdata('smtpstatus');
				$smtpmail = $this->Smtpsetting_model->Getdata('smtpmail');
				$smtppassword = $this->Smtpsetting_model->Getdata('smtppassword');
				$smtpport = $this->Smtpsetting_model->Getdata('smtpport');
				$smtphost = $this->Smtpsetting_model->Getdata('smtphost');
				$maillimit = $this->Smtpsetting_model->Getdata('mail_limit');

				$config = array();
					$config['protocol'] 		= "sendmail";
				    $config['useragent']        = "CodeIgniter";
				    $config['mailpath']         = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
				    $config['protocol']         = "smtp";
				    $config['smtp_host']        = $smtphost;
				    $config['smtp_port']        = $smtpport;
				    $config['mailtype'] 		= 'html';
				    $config['charset']  		= 'utf-8';
				    $config['newline']  		= "\r\n";
				    $config['wordwrap'] 		= TRUE;
			
			$this->email->clear(TRUE);

				$condition = "RequestId =" . "'" . $id . "'";
				$table ="arm_requestepin";
				$SelectColumn ="*";

				$resultdata = $this->common_model->GetRow($condition,$table);

			/*	print_r($resultdata);
				exit;*/
				
				$data = array(
						'EpinStatus'=>'1',
						'AllocatedBy'=>$resultdata->UserId,
						'ModifiedDate'=>date("Y-m-d H:i:s"));

				$condition = "EpinPackageId =" . "'" . $resultdata->PackageId . "' AND EpinStatus='0'";
				$tableName ="arm_epin";

				$epincount =$this->Epin_model->GetRowCount($condition,$tableName);

				if($resultdata->EpinCount!='' && $resultdata->EpinCount!="0" && $resultdata->EpinCount<=$epincount)
				{
					$message = $this->common_model->GetRow("Page='register'","arm_emailtemplate");
		   	   		$emailcont = html_entity_decode($message->EmailContent);

		   	   		$user = $this->common_model->GetCustomer($resultdata->UserId);
		   	   		
				for($i=1; $i<=$resultdata->EpinCount;$i++)
				{

					$epindetail = $this->Epin_model->Checkepin($condition, $tableName,'');

					// echo count($epindetail);
					// $mydata = array('message' => $epindetail[0]->EpinTransactionId);
					/*print_r($mydata);
					exit;*/

					$updatedata = $this->common_model->UpdateRecord($data, $condition, $tableName);

					if($updatedata)
					{


					

			   
				    //print_r($message);exit;

				    // $this->email->mailtype('html');
				    str_replace('[FIRSTNAME]', $user->UserName, $emailcont);
			   		str_replace('[EPINID]', $epindetail[0]->EpinTransactionId, $emailcont);
			   		str_replace('[DATE]', date("dMY",strtotime($epindetail[0]->ExpiryDay)), $emailcont);
			   		str_replace('[URL]', base_url(), $emailcont);
						$sitename = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitename'","arm_setting");

			  	
			   		$this->email->from($smtpmail, $sitename->ContentValue);
			   		$this->email->to($this->input->post('Email'));
					$this->email->subject($message->EmailSubject);
		    		$this->email->message($emailcont);    
		   
		    		$Mail_status = $this->email->send();
					}
				}

				if($updatedata)
				{
					$rdata = array(
						'RequestStatus'=>'1',
						'ModifiedDate'=>date("Y-m-d H:i:s"));

				$rcondition = "RequestId =" . "'" . $resultdata->RequestId . "' AND UserId='" . $resultdata->UserId . "' ";
				$rtableName ="arm_requestepin";

				$updaterequestdata = $this->common_model->UpdateRecord($rdata, $rcondition, $rtableName);

				}
				$this->session->set_flashdata('success_message', $this->lang->line('successmessage'));
				}
				else
				{
				 $this->session->set_flashdata('error_message', $this->lang->line('errorepincount'));
				}
				redirect('admin/epin/request');

							
				
		    } else {
		    	redirect('admin/login');
		    	// $this->load->view('admin/login');
		    }
		
	}




		function getpackageprice($id)
		{
			$mlsetting 	= $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
			if($mlsetting->Id==4)
			{
				$table ="arm_pv";
			}
			elseif($mlsetting->Id==5)
			{
				$table ="arm_boardplan";
			}
			else
			{
				$table ="arm_package";

			}
			$condition = "PackageId =" . "'" . $id . "'";
			$SelectColumn ="PackageFee";
			$resultdata = $this->common_model->GetRow($condition,$table);
			$a = $resultdata->PackageFee;
			if($a)
			echo trim($a);
			else
				echo "0.00";
		}


		function randompins()
		{

		//To Pull 7 Unique Random Values Out Of AlphaNumeric
		//removed number 0, capital o, number 1 and small L
		//Total: keys = 32, elements = 33
		$characters = array("A","B","C","D","E","F","G","H","J","K","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9");
		//make an "empty container" or array for our keys
		$keys = array();
		//first count of $keys is empty so "1", remaining count is 1-6 = total 7 times
		while(count($keys) < 16)
		{
			//"0" because we use this to FIND ARRAY KEYS which has a 0 value

			//"-1" because were only concerned of number of keys which is 32 not 33

			//count($characters) = 33
			$x = mt_rand(0, count($characters)-1);
			if(!in_array($x, $keys)) {
			   $keys[] = $x;
			}
		}
		$random_chars='';
		foreach($keys as $key){
		   $random_chars.= $characters[$key];
		}
		$pin = $random_chars;
		
		return $pin;

		}


		public function addpin()
		{
			

			if($this->session->userdata('logged_in')) 
			{
				
				if($this->input->post())
				{

					$pin = $this->randompins();

					 	
					 	$this->form_validation->set_rules('amount', 'amount', 'trim|required|numeric');
					 	$this->form_validation->set_rules('epincount', 'epincount', 'trim|required|numeric|integer');
					 	$this->form_validation->set_rules('packageid', 'packageid', 'trim|required');
					 	$this->form_validation->set_rules('expirydate', 'expirydate', 'trim|required');

	 				if($this->form_validation->run() == true )
	 				{
	 					for($i=1;$i<=$this->input->post('epincount');$i++)
	 					{
	 						 $randpin = $this->randompins();

						$data = array(
						'EpinPackageId'=>$this->input->post('packageid'),
						'EpinAmount'=>$this->input->post('amount'),
						'EpinTransactionId'=>$randpin,
						'ExpiryDay'=>date("Y-m-d", strtotime($this->input->post('expirydate'))),
						'DateAdded'=>date("Y-m-d H:i:s"),
						'EpinCount'=>'1');

						
						$result = $this->common_model->SaveRecords($data,'arm_epin');
					}
				
						
						$this->session->set_flashdata('success_message',$this->lang->line('successmessagecpin'));
						redirect('admin/epin');
	 				}

					else
					{

						$this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
						
						$this->data['packagedetail']= $this->Epin_model->Getpackagedetail();

						//redirect('admin/packagesetting/addfield');
						$this->load->view('admin/addpin');
					}

					
				}
				else
				{
					$this->data['register']= $this->Epin_model->getregister();
					$this->data['packagedetail']= $this->Epin_model->Getpackagedetail();

					$this->load->view('admin/addpin',$this->data);
					// $this->load->view('admin/generalsetting');
				} 
			}
			else
			{
				redirect('admin/login');

						
			}


	 		//header("Refresh:5;url=".base_url()."index.php/welcome");

			}//function ends



	public function adduserrequest()
		{
			

			if($this->session->userdata('logged_in')) 
			{
				
				if($this->input->post())
				{

						//print_r($this->input->post());
						
					 	$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|callback_username_check');
					 	
					 	$this->form_validation->set_rules('totalamount', 'totalamount', 'trim|required|numeric');
					 	$this->form_validation->set_rules('packageid', 'packageid', 'trim|required');
					 	$this->form_validation->set_rules('epincounts', 'epincounts', 'trim|required|numeric|integer');
					 	$this->form_validation->set_rules('paythrough', 'paythrough', 'trim|required');
					 	$this->form_validation->set_rules('paymentreference', $this->lang->line('label_payreference'), 'trim|required');//|alpha_numeric

	 				if($this->form_validation->run() == true )
	 				{
	 					$condition = "UserName =" . "'" . $this->input->post('username') . "'";
	 					$user = $this->common_model->GetRow($condition,'arm_members');

						$data = array(
						'PackageId'=>$this->input->post('packageid'),
						'UserId'=>$user->MemberId,
						'EpinCount'=>$this->input->post('epincounts'),
						'PaymentAmount'=>$this->input->post('totalamount'),
						'PayThrough'=>$this->input->post('paythrough'),
						'DateAdded'=>date("Y-m-d H:i:s"),
						'ModifiedDate'=>date("Y-m-d H:i:s"),
						'PaymentReference'=>$this->input->post('paymentreference'),
						'RequestStatus'=>'0');

						
						$result = $this->common_model->SaveRecords($data,'arm_requestepin');
					
				
						
						$this->session->set_flashdata('success_message',$this->lang->line('successmessageurequest'));
						redirect('admin/epin/request');
	 				}

					else
					{

						$this->session->set_flashdata('error_message',$this->lang->line('errormessageurequest'));
						
						$this->data['packagedetail']= $this->Epin_model->Getpackagedetail();

						//redirect('admin/packagesetting/addfield');
						$this->load->view('admin/adduserrequest');
					}

					
				}
				else
				{
					$this->data['register']= $this->Epin_model->getregister();
					$this->data['packagedetail']= $this->Epin_model->Getpackagedetail();

					$this->load->view('admin/adduserrequest',$this->data);
					// $this->load->view('admin/generalsetting');
				} 
			}
			else
			{
				redirect('admin/login');

						
			}


	 		//header("Refresh:5;url=".base_url()."index.php/welcome");

			}//function ends



	public function delete($id) 
	{
		$condition = "EpinRecordId =" . "'" . $id . "' AND EpinStatus='0'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_epin');
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedelete'));
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessagedelete'));
		}
	
		redirect('admin/epin');

	}
	public function expdelete($id) 
	{
		$condition = "EpinRecordId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_epin');
		
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedelete'));
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessagedelete'));
		}
		redirect('admin/epin/expiryepin');
	

	}

	public function canceldelete($id) 
	{
		$condition = "RequestId =" . "'" . $id . "'";
		$status = $this->common_model->DeleteRecord($condition, 'arm_requestepin');
		
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagedelete'));
		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessagedelete'));
		}
		redirect('admin/epin/cancelurequests');
	

	}


	public function reactive($id) 
	{
		$condition = "EpinRecordId =" . "'" . $id . "' AND EpinStatus IN ('0','1')";
		$date = date("Y-m-d");
		$date = strtotime(date("Y-m-d", strtotime($date)) . " +3 month");
		$expirydate = date("Y-m-d",$date);
		
		$data = array(
				'ExpiryDay' => $expirydate
			);

		$status = $this->common_model->UpdateRecord($data, $condition, 'arm_epin');
		if($status) {
			$this->session->set_flashdata('success_message',$this->lang->line('successmessagereactive'));


		}
		else
		{
			$this->session->set_flashdata('error_message',$this->lang->line('errormessagereactive'));
		}
		redirect('admin/epin/expiryepin');

	}




	public function enable($PackageId) {
			$condition = "PackageId =" . "'" . $PackageId . "'";

			$data = array(
				'Status' => '1'
			);

			$status = $this->common_model->UpdateRecord($data, $condition, 'arm_package');
			if($status) {
				redirect('admin/epin');
			}
		}

		public function disable($PackageId) {
			$condition = "PackageId =" . "'" . $PackageId . "'";

			$data = array(
				'Status' => '0'
			);

			$status = $this->common_model->UpdateRecord($data, $condition, 'arm_package');
			if($status) {
				redirect('admin/epin');
			}
		}
/*
		public function active($RequireId) {
			$condition = "RequireId =" . "'" . $RequireId . "'";

			$data = array(
				'ReuireFieldStatus' => '1'
			);

			$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
			if($status) {
				redirect('admin/epin');
			}
		}

		public function inactive($RequireId) {
			$condition = "RequireId =" . "'" . $RequireId . "'";

			$data = array(
				'ReuireFieldStatus' => '0'
			);

			$status = $this->common_model->UpdateRecord($data, $condition, 'arm_requirefields');
			if($status) {
				redirect('admin/epin');
			}
		}
*/
		public function username_check($str) 
		{
			

			$condition = "UserName =" . "'" . $str . "' AND MemberStatus='Active'";

			$this->db->select('*');
			$this->db->from('arm_members');
			$this->db->where($condition);
			$query = $this->db->get();
			if ($query->num_rows()>0) 
			{
				return true; 
			}
			else{

				$this->form_validation->set_message('username_check', '<p><em class="state-error1">'.ucwords($this->lang->line('errorusername')).'</em></p>');
				return false;
			}

		}

		} //class ends

?>