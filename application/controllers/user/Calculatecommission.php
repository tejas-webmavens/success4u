<?php
//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculatecommission extends CI_Controller {

	public function __construct() {
		parent::__construct();

		//$this->load->helper('url');
		//
		//$this->lang->load('commission');
		// Load form helper library
		//$this->load->helper('form');
		
		// Load database
		
		// change language
		//$this->config->set_item('language', 'spanish');

		// load language
		

	}

	public function index($name='')
	{
		echo $this->uri->segment(3);

		//$this->process($name);

	}

	public function display()
	{
		echo "start working within calculcom";

	}



	public function owncommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'OCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
					'MemberId'=>$userid,
					'Credit'=>$commission,
					'Balance'=>$userbal-$commission,
					'Description'=>'Own Commission for new member register payment',
					'TransactionId'=>$trnid,
					'DateAdded'=>$date
						 );
		

		$userdetails = $this->common_model->SaveRecords($data,'arm_history');



	}

	public function directcommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'DCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
					'MemberId'=>$userid,
					'Credit'=>$commission,
					'Balance'=>$userbal-$commission,
					'Description'=>'Own Commission for new member register payment',
					'TransactionId'=>$trnid,
					'DateAdded'=>$date
						 );
		

		$userdetails = $this->common_model->SaveRecords($data,'arm_history');



	}

	public function levelcommission($userid,$commission)
	{
		$userbal = $this->common_model->Getcusomerbalance($userid);
		$trnid = 'LCOM'.rand(1111111,9999999);
		$date = date('y-m-d h:i:s');
		$data = array(
					'MemberId'=>$userid,
					'Credit'=>$commission,
					'Balance'=>$userbal-$commission,
					'Description'=>'Level Commission for new member register payment',
					'TransactionId'=>$trnid,
					'DateAdded'=>$date
						 );
		
		$userdetails = $this->common_model->SaveRecords($data,'arm_history');



	}



}
?>