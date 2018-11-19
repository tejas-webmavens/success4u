<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankwire extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// if($this->session->userdata('logged_in')) {
			
			
			$this->lang->load('payment/payment',$this->session->userdata('language'));
			// Load database
			/*$this->load->model('user/shop_model');
			$this->load->model('product_model');
			
			$this->load->model('order_model');
			$this->load->model('admin/paymentsetting_model');
			$this->load->helper('epin_helper');

			$this->data['return'] = base_url().'payment/paypal/success';
			$this->data['notify_url'] = base_url().'payment/paypal/ipn';
			$this->data['cancel_return'] = base_url().'payment/paypal/cancel';

			$this->data['paypal'] = $this->paymentsetting_model->Getfielddata(2);
			$this->data['merchant'] = $this->data['paypal']->PaymentMerchantId;
			if($this->data['paypal']->PaymentMode==1)
				$this->data['paymentUrl'] = $this->data['paypal']->PaymentLiveUrl;
			else
				$this->data['paymentUrl'] = $this->data['paypal']->PaymentTestUrl;
			$this->data['currency'] = 'USD';

			// load language
			$this->lang->load('payment/paypal');*/
		// } else {
		// 	redirect('user/shop');
		// }		

	}

	public function index() {

	echo ucwords("<p> Bankwire transactions unvailable for cart process</p>");
	}
	public function register() {
		
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('free_mem_id')."' AND EntryFor='MTA' AND AdminStatus='0'","arm_memberpayment");
		if($ckip>0)
		{
			echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
	
		}
		else
		{
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['register'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('free_mem_id'));
			
			if($mlsetting->Id==9)
			{
		$condition="PackageId='".$this->data['user']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['user']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['min_amount'] = $this->data['packagedetails']->min_amount;
		$this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['Memberid'] = $this->data['user']->MemberId;
		$this->load->view('payment/bankwire',$this->data);
			}
			else
			{
		$condition="PackageId='".$this->data['user']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['user']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['Memberid'] = $this->data['user']->MemberId;
		$this->load->view('payment/bankwire',$this->data);
			}
		
	
	}
	

	}

	public function subscription() {
		
		$ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('sub_mem_id')."' AND EntryFor='MTAS' AND AdminStatus='0'","arm_memberpayment");
		if($ckip>0)
		{
			echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
	
		}
		else
		{
		
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
		elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['subscription'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('sub_mem_id'));
			
		
		$condition="PackageId='".$this->data['user']->PackageId."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['user']->PackageId;
		$this->data['amount'] = $this->data['packagedetails']->PackageFee;
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['Memberid'] = $this->data['user']->MemberId;
		$this->load->view('payment/bankwire',$this->data);
	}
	

	}
	public function upgrade() {

	$ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('MemberID')."' AND EntryFor='MTAU'  AND AdminStatus='0'","arm_memberpayment");
		if($ckip>0)
		{
			echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
		}
		else
		{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
	    elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['upgrade'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			
		$condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		                    	$this->data['amount'] = $this->data['packagedetails']->PackageFee;

		
		// $this->data['amount'] = $pvlist[1];
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
		if($mlsetting->Id==8){
		$pvlist = explode(",",$this->data['packagedetails']->upgradelevel);


			$memberid = $this->session->userdata('MemberID');
			$spids = $this->common_model->GetRowCount("MemberId = '".$memberid."' AND EntryFor='MTAU'",'arm_memberpayment');
                    $count_spill = $spids;
                  
                    if($count_spill < 4){
                    $field = "MemberId";
					$usermlmdetail = $this->common_model->GetRow("".$field."='".$memberid."'",'arm_boardmatrix1');
					$dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');
                    	if($count_spill == '1'){
                    		$this->data['amount'] = $pvlist[2];
                    		$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$spill = $ddetails->SpilloverId;
					$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
					$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

					$final = $ddetails1->MemberId;


                    	}elseif ($count_spill == '2') {
                    		$this->data['amount'] = $pvlist[3];
                    		$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$spill = $ddetails->SpilloverId;
					$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
					$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

					$spill1 = $ddetails1->SpilloverId;
					$dcondition2 = "BoardMemberId='".$spill1."' order by BoardMemberId limit 0,1";
					$ddetails2 = $this->common_model->GetRow($dcondition2,'arm_boardmatrix1');
                    
					$final = $ddetails2->MemberId;


                    	}elseif ($count_spill == '3') {
                    		$this->data['amount'] = $pvlist[4];
                    		$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$spill = $ddetails->SpilloverId;
					$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
					$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

					$spill1 = $ddetails1->SpilloverId;
					$dcondition2 = "BoardMemberId='".$spill1."' order by BoardMemberId limit 0,1";
					$ddetails2 = $this->common_model->GetRow($dcondition2,'arm_boardmatrix1');
                    
					$spill2 = $ddetails2->MemberId;

					$dcondition3 = "BoardMemberId='".$spill2."' order by BoardMemberId limit 0,1";
					$ddetails3 = $this->common_model->GetRow($dcondition3,'arm_boardmatrix1');
					$final = $ddetails3->MemberId;
					
                    		
                    	}else{
						$this->data['amount'] = $pvlist[1];
						$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$final = $ddetails->MemberId;

                    	}

                    	 
                   $this->data['paydetail'] = $this->common_model->GetRow("MemberId='".$final."'","arm_members");


                    }

                    else{
			$this->data['paydetail'] = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
                  
                    }



		// $field = "MemberId";
		// $boardpackage = $this->common_model->GetRow("PackageId='1'","arm_boardplan");
		// $usermlmdetail = $this->common_model->GetRow("".$field."='".$this->session->userdata('MemberID')."'",'arm_boardmatrix1');
		// $dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
		// $ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

		// $chec_spill = $ddetails->SpilloverId;

  //       $spillid = $this->common_model->GetRow("BoardMemberId='".$chec_spill."'","arm_boardmatrix1");






	    }
        else{
			$this->data['paydetail'] = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
        }
		$this->load->view('payment/bankwire',$this->data);
		}
	}


	public function deposit() {

	$ckip = $this->common_model->GetRowCount("MemberId='".$this->session->userdata('MemberID')."' AND EntryFor='MTAU'  AND AdminStatus='0'","arm_memberpayment");
		if($ckip>0)
		{
			echo ucwords("<br><h2><p> Bankwire details already updated For this member. pls wait untill admin accept / decline.</p></h2>");
		}
		else
		{
		$mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
											
		if($mlsetting->Id==4)
			$table = "arm_pv";
	    elseif($mlsetting->Id==9)
			$table = "arm_hyip";
		elseif($mlsetting->Id==5 || $mlsetting->Id==8) 
			$table = "arm_boardplan";
		else
			$table='arm_package';

		$this->data['deposit'] = '1';
		
		$this->data['user'] = $this->common_model->GetCustomer($this->session->userdata('MemberID'));
			
		$condition="PackageId='".$this->input->post('package')."'";
		$this->data['packagedetails'] = $this->common_model->GetRow($condition,$table);
		$this->data['PackageId'] = $this->data['packagedetails']->PackageId;
		 $this->data['amount'] = $this->data['packagedetails']->PackageFee;
		  $this->data['min_amount'] = $this->data['packagedetails']->min_amount;

		 $this->data['max_amount'] = $this->data['packagedetails']->max_amount;
		// $this->data['amount'] = $pvlist[1];
		$this->data['package'] = $this->data['packagedetails']->PackageName; 
		$this->data['MemberId'] = $this->data['user']->MemberId;
		if($mlsetting->Id==8){
		$pvlist = explode(",",$this->data['packagedetails']->upgradelevel);


			$memberid = $this->session->userdata('MemberID');
			$spids = $this->common_model->GetRowCount("MemberId = '".$memberid."' AND EntryFor='MTAU'",'arm_memberpayment');
                    $count_spill = $spids;
                  
                    if($count_spill < 4){
                    $field = "MemberId";
					$usermlmdetail = $this->common_model->GetRow("".$field."='".$memberid."'",'arm_boardmatrix1');
					$dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');
                    	if($count_spill == '1'){
                    		$this->data['amount'] = $pvlist[2];
                    		$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$spill = $ddetails->SpilloverId;
					$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
					$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

					$final = $ddetails1->MemberId;


                    	}elseif ($count_spill == '2') {
                    		$this->data['amount'] = $pvlist[3];
                    		$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$spill = $ddetails->SpilloverId;
					$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
					$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

					$spill1 = $ddetails1->SpilloverId;
					$dcondition2 = "BoardMemberId='".$spill1."' order by BoardMemberId limit 0,1";
					$ddetails2 = $this->common_model->GetRow($dcondition2,'arm_boardmatrix1');
                    
					$final = $ddetails2->MemberId;


                    	}elseif ($count_spill == '3') {
                    		$this->data['amount'] = $pvlist[4];
                    		$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$spill = $ddetails->SpilloverId;
					$dcondition1 = "BoardMemberId='".$spill."' order by BoardMemberId limit 0,1";
					$ddetails1 = $this->common_model->GetRow($dcondition1,'arm_boardmatrix1');

					$spill1 = $ddetails1->SpilloverId;
					$dcondition2 = "BoardMemberId='".$spill1."' order by BoardMemberId limit 0,1";
					$ddetails2 = $this->common_model->GetRow($dcondition2,'arm_boardmatrix1');
                    
					$spill2 = $ddetails2->MemberId;

					$dcondition3 = "BoardMemberId='".$spill2."' order by BoardMemberId limit 0,1";
					$ddetails3 = $this->common_model->GetRow($dcondition3,'arm_boardmatrix1');
					$final = $ddetails3->MemberId;
					
                    		
                    	}else{
						$this->data['amount'] = $pvlist[1];
						$spilloverid = $ddetails->SpilloverId;

					$dcondition = "BoardMemberId='".$spilloverid."' order by BoardMemberId limit 0,1";
					$ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

					$final = $ddetails->MemberId;

                    	}

                    	 
                   $this->data['paydetail'] = $this->common_model->GetRow("MemberId='".$final."'","arm_members");


                    }

                    else{
			$this->data['paydetail'] = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
                  
                    }



		// $field = "MemberId";
		// $boardpackage = $this->common_model->GetRow("PackageId='1'","arm_boardplan");
		// $usermlmdetail = $this->common_model->GetRow("".$field."='".$this->session->userdata('MemberID')."'",'arm_boardmatrix1');
		// $dcondition = "MemberId='".$usermlmdetail->DirectId."' order by BoardMemberId limit 0,1";
		// $ddetails = $this->common_model->GetRow($dcondition,'arm_boardmatrix1');

		// $chec_spill = $ddetails->SpilloverId;

  //       $spillid = $this->common_model->GetRow("BoardMemberId='".$chec_spill."'","arm_boardmatrix1");






	    }
        else{
			$this->data['paydetail'] = $this->common_model->GetRow("PaymentName='bankwire'","arm_paymentsetting");
        }
		$this->load->view('payment/bankwire',$this->data);
		}
	}

	

	
	public function ipn() {
		echo "ipn";
		print_r($_POST);

	}

	public function cancel() {
		echo "cancel";
		print_r($_POST);

	}




}
?>