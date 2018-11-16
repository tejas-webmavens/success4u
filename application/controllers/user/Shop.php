<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// if($this->session->userdata('logged_in')) {
		
			// Load database
			$this->load->model('user/shop_model');
			$this->load->model('product_model');
			$this->load->model('admin/category_model');
			
			// $this->load->library('cart');

			// load language
			$this->lang->load('user/shop');
		// } else {
		// 	redirect('user/login');
		// }		

	}

	public function index() 
	{
		$categories = $this->product_model->GetCategory();
		$this->data['products'] = $this->shop_model->GetNewProducts();
		// $this->data['category'] = $this->shop_model->GetCategory();
		$this->data['category'] = $this->shop_model->GetCategoryMenu();
		// $categories = $this->data['category'];

		if($categories) {
			$randomo_number = array_rand(array($categories), 1);
			$id = $categories[$randomo_number]->CategoryId;
			// $id = $category[0]->CategoryId;
			$get_cat_image = $this->shop_model->getCateimage($id);
			if($get_cat_image->Image!='')
				$this->data['category_image'] = base_url().'uploads/admin/product/'.$get_cat_image->Image;
			else
				$this->data['category_image'] = base_url().'uploads/noimage.png';
		}
		if($this->data['products']!="")
			$this->load->view('user/shop',$this->data);
		else
			redirect('user/user');
	}

	// public function userwishlist() 
	// {
	// 	$this->data['latest_product'] = $this->product_model->GetLatestProduct();
	// 	$this->data['products'] = $this->shop_model->GetNewProducts();
	// 	$this->load->view('user/shop',$this->data);
	// }

	public function info() 
	{
		
		$this->load->view('user/popup_cart');
		
	}

	public function category($id) 
	{
		if($id) {
			$this->data['category'] = $this->shop_model->GetCategoryMenu();
			// $this->data['category'] = $this->subCategory();

			$get_cat_image = $this->shop_model->getCateimage($id);
			
			if($get_cat_image->Image!=''){
				$this->data['category_image'] = base_url().'uploads/admin/product/'.$get_cat_image->Image;
			}
			else{
				$this->data['category_image'] = base_url().'uploads/noimage.png';
			}
			
			$this->data['products'] = $this->shop_model->GetProducts($id);
			if($this->data['products']!="")
				$this->load->view('user/shop',$this->data);
			else 
				redirect('user/shop');	
		} else {
			redirect('user/shop');
		}

	}
	public function getproduct($id) 
	{
		if($id) {
			$this->data['category'] = $this->shop_model->GetCategoryMenu();
			// $this->data['category'] = $this->subCategory();

			$get_cat_image = $this->shop_model->getCateimage($id);
			
			if(isset($get_cat_image->Image)!=''){
				$this->data['category_image'] = base_url().'uploads/admin/product/'.$get_cat_image->Image;
			}
			// else{
			// 	$this->data['category_image'] = base_url().'uploads/noimage.png';
			// }
			
			// $this->data['products'] = $this->shop_model->GetProducts($id);
			$this->data['products'] = $this->shop_model->GetProductss($id);

			if($this->data['products']!="")

				$this->load->view('user/shop',$this->data);
			else 
				redirect('user/shop');	
		} else {
			redirect('user/shop');
		}

	}

	public function subCategory() {
		$categories = $this->shop_model->GetCategory();
		foreach ($categories as $cate) {
			$condition="CategoryId='".$cate->CategoryId."' AND isDelete='0' AND ParentId='0'";
            $total_subcategory = $this->shop_model->CateCount($condition, 'arm_category');
            	$data[$cate->CategoryId] = $total_subcategory;
        }
        return $data;
	}

	public function views($id,$ref) 
	{

		$this->data['referal']=$ref;
		$array=array('ReferalId'=>$ref);
		$set=$this->session->set_userdata($array);
		// print_r($set);
		// echo $this->session->ReferalId;
		if($id)
		{
			$checkid=$this->common_model->GetRowCount('ProductId='.$id.'',"arm_product");
			if($checkid!=0)
			{
			$this->data['product'] = $this->product_model->GetProduct($id);
					$image_count=$this->data['product']->Image;
		
					$img=explode(",",$image_count);
					
					//print_r($img);
					$i=count($img);
					
					$this->data['thump_image']=$i;
		
			$this->load->view('user/view_product',$this->data);
			}
			else
			{
				redirect('user/shop');
			}

		}

	}

	public function view($id) 
	{

		if($id)
		{
			$check=$this->common_model->GetRowCount('ProductId='.$id.'',"arm_product");
			if($check!=0)
			{
				$this->data['product'] = $this->product_model->GetProduct($id);
				$image_count=$this->data['product']->Image;
		
				$img=explode(",",$image_count);
						
						//print_r($img);
			     $i=count($img);
						
				$this->data['thump_image']=$i;
		        $this->load->view('user/view_product',$this->data);	
			}
			else
			{
				redirect('user/shop');
			}
		}

		// $this->data['product'] = $this->product_model->GetProduct($id);

	}
	public function wishlist() {

		if($this->input->post()) {
			if($this->session->userdata('MemberID')) {
				$data =  array(
					'ProductId' => $this->input->post('ProductId'),
					'MemberId' => $this->session->userdata('MemberID'),
					'DateAdded' => date('Y-m-d H:i:s'),
				);
			
				$status = $this->common_model->SaveRecords($data, 'arm_member_wishlist');
				if($status) {
					$json['id'] = $this->input->post('ProductId');
					$json['success'] = 'Success! Product add your wishlist.';
				}
			} else {
				$json['fail'] = 'Error! You must login after add wish list.';
			}
			if($json)
				echo json_encode($json);
		}
	}

	public function removewishlist() {

		if($this->input->post()) {
			if($this->session->userdata('MemberID')) {
				$userid = $this->session->userdata('MemberID');
				$productid = $this->input->post('ProductId');
				
				$condition = "MemberId='".$userid."' AND ProductId='".$productid."'";

				$this->db->where($condition);
      			$status = $this->db->delete('arm_member_wishlist');
				
				if($status) {
					$json['id'] = $this->input->post('ProductId');
					$json['success'] = 'Success! Product removed your wishlist.';
				}
			}
			echo json_encode($json);
		}
	}

	// public function review() {
	// 	$json['error'] = '';
	// 	$name = strlen($this->input->post('name'));
	// 	$text = strlen($this->input->post('text'));
		
	// 	if(!$this->input->post('name')) {
	// 		$json['error'] = 'Warring! your name is required for review';
	// 	}
	// 	if(!$this->input->post('text')) {
	// 		$json['error'] = 'Warring! your review content is required.';
	// 	}
	// 	if(!$this->input->post('rating')) {
	// 		$json['error'] = 'Warring! your rating is required for review.';
	// 	}

	// 	if(empty($json['error'])) {

	// 		$data =  array(
	// 			'ProductId' => $this->input->post('ProductId'),
	// 			'MemberId' => ($this->session->MemberID) ? $this->session->MemberID : '',
	// 			'author' => $this->input->post('name'),
	// 			'text' => $this->input->post('text'),
	// 			'rating' => $this->input->post('rating'),
	// 			'status' => '0',
	// 			'DateAdded' => date('Y-m-d H:i:s'),
	// 		);
			
	// 		$status = $this->common_model->SaveRecords($data, 'arm_review');
	// 		if($status) {
	// 			$json['success'] = 'Thank you for your review. It has been submitted.';
	// 		} else {
	// 			$json['fail'] = 'Error! your review. not submitted.';
	// 		}

	// 	}
		
	// 	echo json_encode($json);
	// }
	// hpkvrsb
	// sapmnkp
	public function review() {

		$this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('text', 'text', 'trim|required|min_length[15]|max_length[1000]');
		$this->form_validation->set_rules('rating', 'rating', 'trim|required');

		$captchaset = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='usecaptcha'", "arm_setting");
	 	if($captchaset->ContentValue=="On") {
		 	$this->form_validation->set_rules('g-recaptcha-response', 'g-recaptcha-response', 'trim|required|xss_clean|callback_captcha_check');
	 	}

	 	
		if ($this->form_validation->run() == FALSE) {
			$error = str_replace('<p><em class="state-error1">','',validation_errors());
			$error = str_replace('</em></p>','<br/>',$error);
			$json['error'] = $error;

		} else {

			$data =  array(
				'ProductId' => $this->input->post('ProductId'),
				'MemberId' => ($this->session->MemberID) ? $this->session->MemberID : '',
				'author' => $this->input->post('name'),
				'text' => $this->input->post('text'),
				'rating' => $this->input->post('rating'),
				'status' => '0',
				'DateAdded' => date('Y-m-d H:i:s'),
			);
			
			$status = $this->common_model->SaveRecords($data, 'arm_review');
			if($status) {
				$json['success'] = 'Thank you for your review. It has been submitted.';
			} else {
				$json['fail'] = 'Error! your review. not submitted.';
			}
		}
		
		echo json_encode($json);
	}
	public function captcha_check($str)
	{
		$this->load->library('recaptcha');
		$response = $this->recaptcha->verifyResponse($str);
		if (isset($response['success']) and $response['success'] === true) {
			return true;  
		}
		else
		{	
			$this->form_validation->set_message('captcha_check', ucwords($this->lang->line('errorcaptcha')));
			return false;
		}

	}
	// public function captcha_check($str)
	// {
		
	// 	if( strcmp(strtoupper($this->input->post('captcha')),strtoupper($this->session->captchaword))==0)
	// 	{
	// 		return true; 
	// 	}
	// 	else
	// 	{	
	// 		$json['error'] = 'Warring! captcha code is wrong.';
	// 		$this->form_validation->set_message('captcha_check', $json['error']);
	// 		return false;
	// 	}

	// }
	public function viewreview($ProductId) {

		$this->data['review'] = $this->product_model->GetProductReview($ProductId);
		$total_review = sizeof($this->data['review']);

		if($this->data['review']) {
			
		?>
		<i><span> <?php echo $total_review;?> reviews / Write a review</span></i>
		<?php
		foreach ($this->data['review'] as $rev) {
			
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<h3><strong><?php echo $rev->author;?></strong></h3>
				</div>
				<div class="col-md-6">
					<?php echo date('Y-m-d', strtotime($rev->DateAdded));?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p><?php echo $rev->text;?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr class="hrzntl">
		    	<?php 
		    		for($i=1;$i<=$rev->rating;$i++) {
		    	?>
					<i class="fa fa-star str<?php echo $i;?>"></i> 
				<?php 
					} 
					for($j=$rev->rating;$j<=5;$j++) {
				?>
					<i class="fa fa-star-o str<?php echo $j;?>"></i> 
				<?php 
					}
				?>
			</div>
		</div>
		
		
		<div class="text-right"></div>
	<?php	
			}
		} else {
			echo "No Reviews";
		}
	?>

	<?php
	}

	public function addcart($ProductId='') 
	{
		if($this->input->post('ProductId')) {
			$ProductId = $this->input->post('ProductId');

			$product = $this->product_model->GetProduct($ProductId);
			if($product) {

				$data['id'] = "CIP_".$product->ProductId;
				$data['qty'] = ($this->input->post('qty')) ? $this->input->post('qty') : '1';
				$data['price'] = $product->Price;
				$data['name'] = $product->ProductName;
				$data['options'] = json_decode($product->Attributes);

				$isAvil = $this->product_model->getavail($product->ProductId,$data['qty']);
				if($isAvil){
					$cart_status = $this->cart->insert($data);
				}
				else{
					$cart_status = '';
					$json['error'] = 'Failed! Out of stock';
				}

				// $cart_status = $this->cart->insert($data);
				if($cart_status) {
					$json['totalitems'] = $this->cart->total_items();
					$json['success'] = 'Success! your cart Updated';

				} else {
					$json['error'] = 'Failed! your cart not Updated';
					// echo 0;
				}
				echo json_encode($json);
			} else {
				redirect('user/shop');
			}
			// print_r($json);
		} else {
			if($ProductId) {
				$product = $this->product_model->GetProduct($ProductId);
				if($product) {

					$data['id'] = "CIP_".$product->ProductId;
					$data['qty'] = ($this->input->post('qty')) ? $this->input->post('qty') : '1';
					$data['price'] = $product->Price;
					$data['name'] = $product->ProductName;
					$data['options'] = json_decode($product->Attributes);

					// $cart_status = $this->cart->insert($data);
					
					$isAvil = $this->product_model->getavail($product->ProductId,$data['qty']);
					if($isAvil)
						$cart_status = $this->cart->insert($data);
					else
						$json['error'] = 'Failed! Out of stock';

					if($cart_status) {
						$this->session->set_flashdata('success_message', 'Success! your cart Updated');
						redirect('user/dashboard');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! your cart not Updated');
						redirect('user/dashboard');
					}
				} else {
					$this->session->set_flashdata('error_message', 'Failed! Product is out of stock');
					redirect('user/dashboard');
				}

			} else {
				redirect('user/shop');
			}
		}
	}
	public function updatecart()
	{
		if($this->input->post()) {
			$cart_item = $this->input->post();
			
			foreach ($cart_item as $cart) {
				$rowid = $cart['rowid'];
				$data['rowid'] = $cart['rowid'];
				$data['qty'] = $cart['qty'];
				$ProductId = $cart['item'];
				$isAvil = $this->product_model->getavail($ProductId,$cart['qty']);
				if($isAvil) {
					$cart_status = $this->cart->update($data);
					if($cart_status) {
						$this->session->set_flashdata('success_message', 'Success! your cart Updated');
						redirect('user/viewcart');
					} else {
						$this->session->set_flashdata('error_message', 'Failed! your cart not Updated');
						$this->load->view('user/viewcart');		
					}
				}
				else
					$this->session->set_flashdata('out_of_stock_'.$rowid, 'Failed! Out of Stock');
			}
			
		} else {
			$this->load->view('user/viewcart');	
		}
	}

	public function removecart() {
		
		if($this->input->post()) {
			$rowid = $this->input->post('rowid');
			$data['rowid'] = $rowid;
			$data['qty'] = '0';
			$cart_status = $this->cart->update($data);

			if($cart_status) {
				$json['totalitems'] = $this->cart->total_items();
				$json['success'] = 'Success! your cart Updated';
				//$this->session->set_flashdata('success_message', 'Success! your cart Updated');
				//echo 1;
				// redirect('user/viewcart');
			} else {
				$json['error'] = 'Failed! your cart not Updated';
				//$this->session->set_flashdata('error_message', 'Failed! your cart not Updated');
				//echo 0;
				// $this->load->view('user/viewcart');		
			}
			echo json_encode($json);
		} else {
			$this->load->view('user/viewcart');	
		}
	}

		public function searchproduct($value)
	{
	 // $condition="ProductName='".$value."' ORDER BY Price ASC";
	 $checkproduct=$this->shop_model->GetSearchProducts($value);
	 // echo $this->db->last_query();
	 if($checkproduct!="")
	 {
	 	 $this->data['products']=$checkproduct;
	 	 // print_r($this->data['products']);
	 	 $this->load->view('user/search',$this->data);

	 	// redirect('user/shop');
	 }
	 else
	 {
	 	echo 'sorry! No records Found';
	 }

	}
  public function search()
	{
	 // $condition="ProductName='".$value."' ORDER BY Price ASC";
	 $checkproduct=$this->shop_model->GetNewProducts();
	 if($checkproduct!="")
	 {
	 	 $this->data['products']=$checkproduct;
	 	 // print_r($this->data['products']);
	 	 if($this->data['products']!="")
	 	 {
	 	 $this->load->view('user/search',$this->data);
	 	 	
	 	 }

	 	// redirect('user/shop');
	 }
	 else
	 {
	 	echo 'sorry! No records Found';
	 }

	}


}
?>