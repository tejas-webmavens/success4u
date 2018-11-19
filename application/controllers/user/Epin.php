<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends CI_Controller {

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
		if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {

		// $this->load->helper('url');
		// // Load form helper library
		// $this->load->helper('form');

		// // Load form validation library
		// $this->load->library('form_validation');

		// // Load session library
		// $this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('epin_helper');


		// Load database
		
		$this->load->model('user/epin_model');
		$this->lang->load('userepin',$this->session->userdata('language'));
        $this->lang->load('user/common',$this->session->userdata('language'));
		$this->data['matrixsetting']=$this->common_model->GetRow('MatrixStatus=1',"arm_matrixsetting");

		
		}  else {
	    	redirect('login');
	    }
	}

	public function index()
	{
		if($this->session->userdata('logged_in')) 
		{
			
			$this->data['field'] = $this->epin_model->Getfields($this->session->userdata('MemberID'));
			if($this->data['field'])
				$this->load->view('user/epinlist', $this->data['field']);
			else
				$this->load->view('user/epinlist');
				
		} 
		else 
		{
		   redirect('user/login');
		    	
		}
	 		


	}
	
	public function requestlist()
		{
			if($this->session->userdata('logged_in')) {
				
					$this->data['field'] = $this->epin_model->Getrequestlist($this->session->MemberID);
					$this->load->view('user/epinrequestlist', $this->data['field']);
				
		    } else {
		    	redirect('user/login');
		    	// $this->load->view('user/login');
		    }
	 		
		}


	public function buy()
		{
			if($this->session->userdata('logged_in')) 
			{
				if($this->input->post())
				{	
					$this->form_validation->set_rules('totalamount', 'totalamount', 'trim|required|numeric');
				 	$this->form_validation->set_rules('packageid', 'packageid', 'trim|required');
				 	$this->form_validation->set_rules('paythrough', 'paythrough', 'trim|required');
				 	$this->form_validation->set_rules('epincount', 'epincount', 'trim|required|numeric|integer');
					 	
					if($this->form_validation->run() == true )
	 				{
	 					$epindetails = array();
	 					$epindetails = $this->input->post();	

	 					if(strtolower($this->input->post('paythrough'))=='ewallet')
	 					{
	 						
	 						
	 						$bal =  $this->common_model->Getcusomerbalance($this->session->MemberID);
	 						 
	 						if($epindetails['totalamount']<=$bal)
	 						{	
	 							$date = date("Y-m-d");
								$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
								$expirydate = date("Y-m-d",$date);
	 								 					
	 							 						for($i=1;$i<=$epindetails['epincount'];$i++)
	 									 				{
	 									 						 $randpin = $this->randompins();
	 						
	 														$data = array(
	 														'EpinPackageId'=>$this->input->post('packageid'),
	 														'EpinAmount'=>$epindetails['packageamount'],
	 														'EpinTransactionId'=>$randpin,
	 														'AllocatedBy'=>$this->session->MemberID,
	 														'ExpiryDay'=>$expirydate,
	 														'DateAdded'=>date("Y-m-d H:i:s"),
	 														'EpinCount'=>'1',
	 														'EpinStatus'=>'1');
	 						
	 													//print_r($data);
	 														$result = $this->common_model->SaveRecords($data,'arm_epin');
	 														
	 													}
	 													//print_r($epindetails);

	 													if($result)
	 														{
	 															$pdata = array(
	 																'MemberId'=>$this->session->MemberID,
	 																'Debit'=>$epindetails['totalamount'],
	 																'Balance'=>$bal-$epindetails['totalamount'],
	 																'Description'=>'buy '.$epindetails['epincount'].' epins ',
	 																'TypeId'=>'13',
	 																);
	 															
	 															$result1 = $this->common_model->SaveRecords($pdata,'arm_history');
	 														}
	 														
							$this->session->set_flashdata('success_message',$this->lang->line('successmessagewallet'));
	 												
	 						}
	 						else
			 				{


							$this->session->set_flashdata('error_message',$this->lang->line('errormessagewallet').$bal);
								
							$this->data['packagedetail']= $this->epin_model->Getpackagedetail();
							$this->load->view('user/buyepin', $this->data['field']);

			 				}

			 				redirect('user/epin/buy');

		 					}

		 					elseif(strtolower($this->input->post('paythrough'))=='paypal')
		 					{	
		 						$this->data['epindetails'] = $epindetails;

		 						$this->data['epindetails']['package'] = $this->epin_model->Getfielddata($epindetails['packageid']);
		 						$this->data['userdetails'] = $this->common_model->GetCustomer($this->session->MemberID);

								$this->data['paymentdetails'] = $this->common_model->GetRow("PaymentStatus='1'AND PaymentName='paypal'", 'arm_paymentsetting');
			
		 						$this->load->view('user/epinpayment',$this->data);

		 						//redirect('user/', $epindetails);
		 						
		 						
		 					}

		 					else
		 					{
								$this->session->set_flashdata('error_message',$this->lang->line('errormessagelet'));

		 					}
							//print_r($epindetails);
			 				//$this->data['packagedetail']= $this->epin_model->Getpackagedetail();
							//$this->load->view('user/buyepin', $this->data);

		 				}
		 				else
		 				{

							$this->session->set_flashdata('error_message',$this->lang->line('errormessagebuy'));
								
							$this->data['packagedetail']= $this->epin_model->Getpackagedetail();
							$this->load->view('user/buyepin', $this->data['field']);

		 				}

					}
				else
				{
					$condition = "PaymentStatus='1' AND PaymentId NOT IN('1','14')";
					// $condition = "PaymentStatus='1'";
					$this->data['payments'] = $this->common_model->GetResults($condition,'arm_paymentsetting');					
					$this->data['packagedetail']= $this->epin_model->Getpackagedetail();
					$this->load->view('user/buyepin', $this->data);
				}
		    } 
		    else 
		    {
		    	redirect('user/login');
		    	// $this->load->view('user/login');
		    }
	 		
		}


	public function request()
		{
			

			if($this->session->userdata('logged_in')) 
			{
				
				if($this->input->post())
				{

					 	
					 	$this->form_validation->set_rules('totalamount', 'totalamount', 'trim|required|numeric');
					 	$this->form_validation->set_rules('amount', 'totalamount', 'trim|required|numeric');
					 	$this->form_validation->set_rules('packageid', 'packageid', 'trim|required');
					 	$this->form_validation->set_rules('epincount', 'epincount', 'trim|required|numeric|integer');
					 	$this->form_validation->set_rules('paythrough', 'paythrough', 'trim|required');
					 	
					 	if($this->input->post('paythrough')=='bankwire' || $this->input->post('paythrough')=='cheque')
					 	{
					 		
					 	$this->form_validation->set_rules('paymentreference', $this->lang->line('paymentreference'), 'trim|required');

					 	}

					 	if($this->input->post('balanceamount'))
					 	{
					 		$this->form_validation->set_rules('balanceamount','balanceamount','trim|required|callback_balance_check');
					 	}

	 				if($this->form_validation->run() == true )
	 				{
	 					if($this->input->post('paythrough')=='Accountbalance')
	 					{


							$packagename=$this->input->post('packageid');


							$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
								if($mlsetting->Id==4)
								{
									$table = "arm_pv";
								}
								else if($mlsetting->Id==5 || $mlsetting->Id==8)
								{
									$table = "arm_boardplan";
								}
								else 
								{
									$table = "arm_package";

								}
									$pack=$this->common_model->GetRow('PackageId='.$packagename.'',$table);
									$tot=$this->input->post('totalamount');
									
									$userid=$this->session->MemberID;
									

									$count=$this->input->post('epincount');
									

									 $date = date("Y-m-d");
									 $date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
									 $expirydate = date("Y-m-d",$date);
												
												
									  for($i=1;$i<=$count;$i++) 
									  {
												
										$randpin = RandomEpins();

										$data = array(
											'EpinPackageId'=>$this->input->post('packageid'),
											'EpinAmount'=>$this->input->post('packageamount'),
											'EpinTransactionId'=>$randpin,
											'AllocatedBy'=>$userid,
											'ExpiryDay'=>$expirydate,
											'DateAdded'=>date("Y-m-d H:i:s"),
											'EpinCount'=>'1',
											'EpinStatus'=>'1'
													);
														
								      $result = $this->common_model->SaveRecords($data,'arm_epin');

								    }

								      // exit;

								     if($result)
								     {

								     	$balanceamount=$this->input->post('balanceamount');
								     	$debit=$balanceamount-$tot;

										$trnid = 'EPA'.rand(1111111,9999999);
										$date = date('y-m-d h:i:s');
								  //	 $data['Description']="Member Deposit ".$packagename." using Account Balance";
											$data1= array(
											'MemberId'=>$userid,
											// 'credit'=>$tot,
								    		'debit'=>$tot,
								    		'Balance'=>$debit,
										
										    'Description'=>"Member Purchase Epin ".$pack->PackageName." using Account Balance",
										    'TransactionId'=>$trnid,
										    'TypeId'=>'25',
										    'DateAdded'=>$date
										  );

								       $userdetails = $this->common_model->SaveRecords($data1,'arm_history');
								       $his_id=$this->db->insert_id();
								       if($his_id)
								       {
								       	//  $balanceamount=$this->input->post('balanceamount');
								       	// // $bal = $this->common_model->Getcusomerbalance($userid);
		       
		       						 //       	// echo $balanceamount;
		       						 //       	$debit=$balanceamount-$tot;
		       						       
		       						 //       	// echo $debit;
		       
		       
		       					  //          	$trnid = 'EPAD'.rand(1111111,9999999);
		       						 //       	$date = date('y-m-d h:i:s');
		       						 //       	$data = array(
		       						 //       	'MemberId'=>$userid,
		       						 //       	'credit'=>'0.00',
		       						 //       	'Debit'=>$tot,
		       						       	
		       						 //       	'Description'=>'Debit Balance For  Epin Purchase '.$pack->PackageName.'',
		       						 //       	'TransactionId'=>$trnid,
		       						 //       	'TypeId'=>'26',
		       						 //       	'Balance'=>$debit,
		       						 //       	'DateAdded'=>$date
		       						 //       	);
		       
		       						 //       	$userhis = $this->common_model->SaveRecords($data,'arm_history');
		       						 //       	if($userhis)
		       						 //       	{
		       						       		$this->session->set_flashdata('success_message','Epin Is Created Successfully');
												redirect('user/epin/request');
		       						       	// }
		       
								       }
		                          }

	 					
	 					}
	 					else
	 					{
		 					$data = array(
							'PackageId'=>$this->input->post('packageid'),

							'UserId'=>$this->session->MemberID,
							'EpinCount'=>$this->input->post('epincount'),
							'PaymentAmount'=>$this->input->post('totalamount'),
							'PayThrough'=>$this->input->post('paythrough'),
							'DateAdded'=>date("Y-m-d H:i:s"),
							'ModifiedDate'=>date("Y-m-d H:i:s"),
							'RequestStatus'=>'0');

							if( $this->input->post('paythrough')=='bankwire' ||$this->input->post('paythrough')=='cheque')
						 	{
						 		
						 	$data['PaymentReference']= $this->input->post('paymentreference');

						 	}

							$result = $this->common_model->SaveRecords($data,'arm_requestepin');
							if($result)
							{
								$this->session->set_flashdata('success_message',$this->lang->line('successmessage'));
								redirect('user/epin/request');
							}

	 					}
						
						// if($this->input->post('AccountBalance'))
						// {
							

					// }
					
				
						
	 				}

					else
					{

						 $this->session->set_flashdata('error_message',$this->lang->line('errormessage'));
						
						$this->data['packagedetail']= $this->epin_model->Getpackagedetail();

						//redirect('admin/packagesetting/addfield');
						$this->load->view('user/requestepin');
					}

					
				}
				else
				{
					$this->data['packagedetail']= $this->epin_model->Getpackagedetail();

					$this->load->view('user/requestepin',$this->data);
					// $this->load->view('admin/generalsetting');
				} 
			}
			else
			{
				redirect('user/login');

						
			}


	 		//header("Refresh:5;url=".base_url()."index.php/welcome");

			}//function ends

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

	public function paymentsuccess()
	{
		

		$checkdata = explode(",",$this->input->post('custom'));

		$packagedetails =$this->epin_model->Getfielddata($this->input->post('item_number'));
		
		if(strtolower($checkdata[0])=='epin' && strtolower($checkdata[1])== 'paypal' && strtolower($checkdata[2])!='' )
		{
			$date = date("Y-m-d");
			$date = strtotime(date("Y-m-d", strtotime($date)) . " +6 month");
			$expirydate = date("Y-m-d",$date);
			$totalamount = $packagedetails->PackageFee * $checkdata[2];
			if($this->input->post('mc_gross')>= $totalamount)
			{

				for($i=1;$i<=$epindetails['epincount'];$i++)
				{
						 $randpin = $this->randompins();

				$data = array(
				'EpinPackageId'=>$packagedetails->PackageId,
				'EpinAmount'=>$packagedetails->PackageFee,
				'EpinTransactionId'=>$randpin,
				'AllocatedBy'=>$this->session->MemberID,
				'ExpiryDay'=>$expirydate,
				'DateAdded'=>date("Y-m-d H:i:s"),
				'EpinCount'=>'1',
				'EpinStatus'=>'1');

					//print_r($data);
				$result = $this->common_model->SaveRecords($data,'arm_epin');
				
				}
				$this->session->set_flashdata('success_message', $this->lang->line('successmessagewallet'));
			}
			else
			{
			$this->session->set_flashdata('error_message', $this->lang->line('errormessagepayment'));
			}

			

		}

		
		redirect('user/epin');

				
	}

	function getuserbalance($id)
		{
			// echo $id;
			// echo "<br>";
			// echo $amount;
			$gtbal 	= $this->common_model->Getcusomerbalance($id);
			// echo $this->db->last_query();
			
			$a = $gtbal;
			if($a)
			
			echo $a;

			
	        else
			
				echo "0.00";
		
			
		}

		public function balance_check($str)
		{
			 
			 
			$totalamount=$this->input->post('totalamount');
			// echo $totalamount;
			// echo $str > $totalamount;
			if($str >= $totalamount)
			{
				// echo 'succ';
				return true;
			}
			else
			{
			$this->form_validation->set_message('balance_check',ucwords($this->lang->line('errorbalance')));
			return false;

			}
			
		}
	
}
