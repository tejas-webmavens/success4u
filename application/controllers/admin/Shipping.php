<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {
			//$this->load->helper('url');

			// Load form helper library
			//$this->load->helper('form');
			
			// Load database
			
			$this->load->model('Shipping_model');
			$this->load->model('product_model');
			
			
			// change language
			//$this->config->set_item('language', 'spanish');

			// load language
			$this->lang->load('shipping');
		} else {
			redirect('admin/login');
		}

	}

	public function index()
	{
 		//if($this->session->userdata('logged_in') && $this->session->userdata('admin_login')) {

 			if($this->input->post()) {

				if($this->input->post('easypost_status')==1) {

					$this->form_validation->set_rules('api_id', 'api_id', 'trim|required|min_length[10]|xss_clean');
					// $this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[3]|xss_clean');
					// $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|xss_clean');
					// $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
					// $this->form_validation->set_rules('zip_code', 'zip_code', 'trim|required|numeric|xss_clean');
					// $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|numeric|xss_clean');
					// $this->form_validation->set_rules('shipping_length', 'shipping_length', 'trim|required|numeric|xss_clean');
					// $this->form_validation->set_rules('shipping_width', 'shipping_width', 'trim|required|numeric||xss_clean');
					// $this->form_validation->set_rules('shipping_height', 'shipping_height', 'trim|required|numeric|xss_clean');

					if ($this->form_validation->run() == TRUE) {

						$data['api_id'] = $this->input->post('api_id');
						$data['company'] = $this->input->post('company');
						$data['address'] = $this->input->post('address');
						$data['city'] = $this->input->post('city');
						$data['zip_code'] = $this->input->post('zip_code');
						$data['phone'] = $this->input->post('phone');
						$data['shipping_size'] = $this->input->post('shipping_size');
						$data['shipping_container'] = $this->input->post('shipping_container');
						$data['shipping_length'] = $this->input->post('shipping_length');
						$data['shipping_width'] = $this->input->post('shipping_width');
						$data['shipping_height'] = $this->input->post('shipping_height');
						$data['shipping_weight'] = $this->input->post('shipping_weight');
						$data['easypost_status'] = $this->input->post('easypost_status');

						//print_r($data);exit;
						
						$status = $this->Shipping_model->SaveSettings($data,'easypost');

						if($status) {
							$this->session->set_flashdata('success_message', 'Success! shipping Updated');
							redirect('admin/shipping');
						} else {
							$this->session->set_flashdata('error_message', 'Failed! shipping Not Updated');
							redirect('admin/shipping');
						}
					} else {
						$this->load->view('admin/shipping');
					}
					
				} else {
					$size =  sizeof($this->input->post('country'));

					$remove_status = $this->Shipping_model->DeleteShipping();

					for ($i=0; $i < $size; $i++) { 

						$country = $this->input->post('country');
						$min = $this->input->post('min');
						$max = $this->input->post('max');
						$rates = $this->input->post('rates');
						$fast = $this->input->post('fast');
						$data['FastDelivery'] = $fast[$i];
						$data['Country'] = $country[$i];
						$data['MinValue'] = $min[$i];
						$data['MaxValue'] = $max[$i];
						$data['Rates'] = $rates[$i];
						
						$status = $this->common_model->SaveRecords($data, 'arm_shipping');
					}

					if($status) {
						$this->session->set_flashdata('success_message', 'Success! shipping Updated');
						redirect('admin/shipping');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! shipping Not Updated');
						redirect('admin/shipping');
					}
				}

			} 
			else {
				
				$this->data['shippings'] = $this->common_model->GetResults('','arm_shipping','*');

				$condition = "Page LIKE '%easypost%'";
				$this->data['api_id'] = $this->Shipping_model->GetSettings('api_id');
				$this->data['company'] = $this->Shipping_model->GetSettings('company');
				$this->data['address'] = $this->Shipping_model->GetSettings('address');
				$this->data['city'] = $this->Shipping_model->GetSettings('city');
				$this->data['phone'] = $this->Shipping_model->GetSettings('phone');
				$this->data['zip_code'] = $this->Shipping_model->GetSettings('zip_code');
				$this->data['shipping_size'] = $this->Shipping_model->GetSettings('shipping_size');
				$this->data['shipping_container'] = $this->Shipping_model->GetSettings('shipping_container');
				$this->data['shipping_length'] = $this->Shipping_model->GetSettings('shipping_length');
				$this->data['shipping_width'] = $this->Shipping_model->GetSettings('shipping_width');
				$this->data['shipping_height'] = $this->Shipping_model->GetSettings('shipping_height');
				
				$this->data['country'] = $this->common_model->GetCountry();
				$this->load->view('admin/shipping',$this->data);
			}
	    // } else {
	    // 	redirect('admin/login');
	    // }	
	}

	public function shippingtotal() {
		if($this->input->post()) {
			$size =  sizeof($this->input->post('country'));

			$remove_status = $this->Shipping_model->DeleteShipping();

			for ($i=0; $i < $size; $i++) { 

				$country = $this->input->post('country');
				$min = $this->input->post('min');
				$max = $this->input->post('max');
				$rates = $this->input->post('rates');
				$fast = $this->input->post('fast');
				$data['FastDelivery'] = $fast[$i];
				$data['Country'] = $country[$i];
				$data['MinValue'] = $min[$i];
				$data['MaxValue'] = $max[$i];
				$data['Rates'] = $rates[$i];
				
				$status = $this->common_model->SaveRecords($data, 'arm_shipping');
			}

			if($status) {
				$this->session->set_flashdata('success_message', 'Success! shipping Updated');
				redirect('admin/shipping/shippingtotal');
			} else {
				$this->session->set_flashdata('error_message', 'Failed! shipping Not Updated');
				redirect('admin/shipping/shippingtotal');
			}
		} else {
			$this->data['shippings'] = $this->common_model->GetResults('','arm_shipping','*');
				
			$this->data['country'] = $this->common_model->GetCountry();
			$this->load->view('admin/shipping/shippingtotal',$this->data);
			
		}
	}

	public function shippingapi() {

		if($this->input->post()) {
			// print_r($this->input->post());exit;

			$this->form_validation->set_rules('api_id', 'api_id', 'trim|required|min_length[10]|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zip_code', 'zip_code', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|numeric|xss_clean');
			$this->form_validation->set_rules('shipping_length', 'shipping_length', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('shipping_width', 'shipping_width', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('shipping_height', 'shipping_height', 'trim|required|numeric|xss_clean');

			if ($this->form_validation->run() == TRUE) {

				$data['api_id'] = $this->input->post('api_id');
				$data['company'] = $this->input->post('company');
				$data['address'] = $this->input->post('address');
				$data['city'] = $this->input->post('city');
				$data['zip_code'] = $this->input->post('zip_code');
				$data['phone'] = $this->input->post('phone');
				$data['shipping_size'] = $this->input->post('shipping_size');
				$data['shipping_container'] = $this->input->post('shipping_container');
				$data['shipping_length'] = $this->input->post('shipping_length');
				$data['shipping_width'] = $this->input->post('shipping_width');
				$data['shipping_height'] = $this->input->post('shipping_height');
				$data['shipping_weight'] = $this->input->post('shipping_weight');
				$data['easypost_status'] = $this->input->post('easypost_status');

				// print_r($data);exit;
				
				$status = $this->Shipping_model->SaveSettings($data,'easypost');

				if($status) {
					$this->session->set_flashdata('success_message', 'Success! shipping Updated');
					redirect('admin/shipping/shippingapi');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! shipping Not Updated');
					redirect('admin/shipping/shippingapi');
				}
			} else {
				$condition = "Page LIKE '%easypost%'";
				$this->data['api_id'] = $this->Shipping_model->GetSettings('api_id');
				$this->data['company'] = $this->Shipping_model->GetSettings('company');
				$this->data['address'] = $this->Shipping_model->GetSettings('address');
				$this->data['city'] = $this->Shipping_model->GetSettings('city');
				$this->data['phone'] = $this->Shipping_model->GetSettings('phone');
				$this->data['zip_code'] = $this->Shipping_model->GetSettings('zip_code');
				$this->data['shipping_size'] = $this->Shipping_model->GetSettings('shipping_size');
				$this->data['shipping_container'] = $this->Shipping_model->GetSettings('shipping_container');
				$this->data['shipping_length'] = $this->Shipping_model->GetSettings('shipping_length');
				$this->data['shipping_width'] = $this->Shipping_model->GetSettings('shipping_width');
				$this->data['shipping_height'] = $this->Shipping_model->GetSettings('shipping_height');
				$this->data['shipping_weight'] = $this->Shipping_model->GetSettings('shipping_weight');

				$this->load->view('admin/shipping/shippingapi',$this->data);
				// $this->load->view('admin/shipping/shippingapi');
			}
		} else {
			$condition = "Page LIKE '%easypost%'";
			$this->data['api_id'] = $this->Shipping_model->GetSettings('api_id');
			$this->data['company'] = $this->Shipping_model->GetSettings('company');
			$this->data['address'] = $this->Shipping_model->GetSettings('address');
			$this->data['city'] = $this->Shipping_model->GetSettings('city');
			$this->data['phone'] = $this->Shipping_model->GetSettings('phone');
			$this->data['zip_code'] = $this->Shipping_model->GetSettings('zip_code');
			$this->data['shipping_size'] = $this->Shipping_model->GetSettings('shipping_size');
			$this->data['shipping_container'] = $this->Shipping_model->GetSettings('shipping_container');
			$this->data['shipping_length'] = $this->Shipping_model->GetSettings('shipping_length');
			$this->data['shipping_width'] = $this->Shipping_model->GetSettings('shipping_width');
			$this->data['shipping_height'] = $this->Shipping_model->GetSettings('shipping_height');
			$this->data['shipping_weight'] = $this->Shipping_model->GetSettings('shipping_weight');
			$this->load->view('admin/shipping/shippingapi',$this->data);
		}
	}
	public function apiview(){
		$condition = "Page LIKE '%easypost%'";
		$this->data['api_id'] = $this->Shipping_model->GetSettings('api_id');
		$this->data['company'] = $this->Shipping_model->GetSettings('company');
		$this->data['address'] = $this->Shipping_model->GetSettings('address');
		$this->data['city'] = $this->Shipping_model->GetSettings('city');
		$this->data['phone'] = $this->Shipping_model->GetSettings('phone');
		$this->data['zip_code'] = $this->Shipping_model->GetSettings('zip_code');
		$this->data['shipping_size'] = $this->Shipping_model->GetSettings('shipping_size');
		$this->data['shipping_container'] = $this->Shipping_model->GetSettings('shipping_container');
		$this->data['shipping_length'] = $this->Shipping_model->GetSettings('shipping_length');
		$this->data['shipping_width'] = $this->Shipping_model->GetSettings('shipping_width');
		$this->data['shipping_height'] = $this->Shipping_model->GetSettings('shipping_height');

		$this->load->view('admin/shipping/shippingapi',$this->data);
	}

	public function view(){
		$this->data['shippings'] = $this->common_model->GetResults('','arm_shipping','*');
		$this->data['country'] = $this->common_model->GetCountry();
		$this->load->view('admin/shipping/shippingtotal',$this->data);	
	}

	/*public function add($shippingId='') {

		if($this->input->post()) {

			if($this->input->post('easypost_status')==1) {

				$this->form_validation->set_rules('api_id', 'ApiId', 'trim|required|min_length[10]|xss_clean');
				$this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
				$this->form_validation->set_rules('zip_code', 'Zip_code', 'trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|numeric|xss_clean');
				$this->form_validation->set_rules('shipping_length', 'Length', 'trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('shipping_width', 'Width', 'trim|required|numeric||xss_clean');
				$this->form_validation->set_rules('shipping_height', 'Height', 'trim|required|numeric|xss_clean');

				if ($this->form_validation->run() == TRUE) {

					$data['api_id'] = $this->input->post('api_id');
					$data['company'] = $this->input->post('company');
					$data['address'] = $this->input->post('address');
					$data['city'] = $this->input->post('city');
					$data['zip_code'] = $this->input->post('zip_code');
					$data['phone'] = $this->input->post('phone');
					$data['shipping_size'] = $this->input->post('shipping_size');
					$data['shipping_container'] = $this->input->post('shipping_container');
					$data['shipping_length'] = $this->input->post('shipping_length');
					$data['shipping_width'] = $this->input->post('shipping_width');
					$data['shipping_height'] = $this->input->post('shipping_height');
					$data['shipping_weight'] = $this->input->post('shipping_weight');
					$data['easypost_status'] = $this->input->post('easypost_status');

					print_r($data);exit;
					
					$status = $this->Shipping_model->SaveSettings($data,'easypost');

					if($status) {
						$this->session->set_flashdata('success_message', 'Success! shipping Updated');
						redirect('admin/shipping');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! shipping Not Updated');
						redirect('admin/shipping');
					}
				} else {
					$this->load->view('admin/shipping');
				}
				
			} else {
				$size =  sizeof($this->input->post('country'));

				$remove_status = $this->Shipping_model->DeleteShipping();

				for ($i=0; $i < $size; $i++) { 

					$country = $this->input->post('country');
					$min = $this->input->post('min');
					$max = $this->input->post('max');
					$rates = $this->input->post('rates');
					$fast = $this->input->post('fast');
					$data['FastDelivery'] = $fast[$i];
					$data['Country'] = $country[$i];
					$data['MinValue'] = $min[$i];
					$data['MaxValue'] = $max[$i];
					$data['Rates'] = $rates[$i];
					
					$status = $this->common_model->SaveRecords($data, 'arm_shipping');
				}

				if($status) {
					$this->session->set_flashdata('success_message', 'Success! shipping Updated');
					redirect('admin/shipping');
				} else {
					$this->session->set_flashdata('error_message', 'Failed! shipping Not Updated');
					redirect('admin/shipping');
				}
			}

		} else {
			redirect('admin/shipping');
		}
		
	}  */

	public function Calc() {

		
// Require this file if you're not using composer's vendor/autoload

// Required PHP extensions
if (!function_exists('curl_init')) {
  throw new Exception('EasyPost needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('EasyPost needs the JSON PHP extension.');
}

$app_path = str_replace('controllers\admin', '', dirname(__FILE__));
// Config and Utilities
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\EasyPost.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Util.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Error.php');

// Guts
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Object.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Resource.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Requestor.php');

// API Resources
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Address.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Batch.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\CarrierAccount.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Container.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\CustomsInfo.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\CustomsItem.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Event.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Fee.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Item.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Order.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Parcel.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Pickup.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\PostageLabel.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Rate.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Refund.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\ScanForm.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Shipment.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\Tracker.php');
require('F:\xampp\htdocs\saravanan\ARMCIP\application\third_party\easy\EasyPost\User.php');

		//$this->load->library('EasyPost');
		
			// $weight = $this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->config->get('easypost_weight_class_id'));
			
			// \EasyPost\EasyPost::setApiKey('vglmzgFOjumHDVh8X26iSw');
			\EasyPost\EasyPost::setApiKey('cueqNZUb3ldeWTNX7MU3Mel8UXtaAMUi');

			// $shipment = \EasyPost\Shipment::create(array(
			//   'to_address' => array(
			//     "name"    => "jhon",
			//     "street1" => "118 2nd Street",
			//     "street2" => "4th Floor",
			//     "city"    => "San Francisco",
			//     "state"   => "CA",
			//     "zip"     => "94105",
			//     "phone"   => "415-456-7890"
			//   ),
			//   'from_address' => array(
			//     "company" => "EasyPost",
			//     "street1" => "118 2nd Street",
			//     "street2" => "4th Floor",
			//     "city"    => "San Francisco",
			//     "state"   => "CA",
			//     "zip"     => "94105",
			//     "phone"   => "415-456-7890"
			//   ),
			//   'parcel' => array(
			//     'length' => "10",
			//     'width' => "50",
			//     'height' => "45",
			//     'weight' => "50"
			//   )
			// ));

			$to_address = \EasyPost\Address::create(
			    array(
			        "name"    => "Dr. Steve Brule",
			        "street1" => "179 N Harbor Dr",
			        "city"    => "Redondo Beach",
			        "state"   => "CA",
			        "zip"     => "90277",
			        "phone"   => "310-808-5243"
			    )
			);
			$from_address = \EasyPost\Address::create(
			    array(
			        "company" => "EasyPost",
			        "street1" => "118 2nd Street",
			        "street2" => "4th Floor",
			        "city"    => "San Francisco",
			        "state"   => "CA",
			        "zip"     => "94105",
			        "phone"   => "415-456-7890"
			    )
			);
			$parcel = \EasyPost\Parcel::create(
			    array(
			        "predefined_package" => "LargeFlatRateBox",
			        "weight" => 76.9
			    )
			);
			$shipment = \EasyPost\Shipment::create(
			    array(
			        "to_address"   => $to_address,
			        "from_address" => $from_address,
			        "parcel"       => $parcel
			    )
			);

			$shipment->buy($shipment->lowest_rate());

			$shipment->insure(array('amount' => 100));

			$this->data['easypost_label'] = $shipment->postage_label->label_url;

			$this->load->view('admin/easypost_label',$this->data);

			//$data = json_decode($shipment);
			//echo "<pre>";
			//print_r($data);exit;

		// 	$method_data = array();
		// 	$i = 1;
		// 	foreach($data->rates as $row) {
		// 		$quote_data[$i] = array(
		// 			'code'         => 'easypost.'.$i,
		// 			'title'        => $row->service,
		// 			'cost'         => $this->currency->convert($row->rate, 'USD', $this->config->get('config_currency')),
		// 			'tax_class_id' => $this->config->get('easypost_tax_class_id'),
		// 			'text'         => $this->currency->format($this->tax->calculate($this->currency->convert($row->rate, 'USD', $this->currency->getCode()), $this->config->get('easypost_tax_class_id'), $this->config->get('config_tax')), $this->currency->getCode(), 1.0000000)
		// 		);
		// 		$i++;
		// 	}

		// 	$method_data = array(
		// 		'code'       => "easypost",
		// 		'title'      => $row->service,
		// 		'quote'      => $quote_data,
		// 		'sort_order' => 1,
		// 		'error'      => false
		// 	);
		// }
		// print_r($method_data);
		// // return $method_data;
		// echo "check:";
	}

}
