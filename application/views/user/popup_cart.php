<?php 
if($this->cart->total_items()) {
	foreach ($this->cart->contents() as $cart_items) {
		$id = str_replace('CIP_', '', $cart_items['id']);
		$cart_product = $this->product_model->GetProduct($id);
		if($cart_product->Image) {
			$cart_product_image = explode(',', $cart_product->Image);
			$cart_image1 = base_url().'uploads/admin/product/'.$cart_product_image[0];
		} else {
			$cart_image1 = base_url().'uploads/noimage.png';
			
		}

?>

	<li>
		<span class="item">
			<span class="item-left">
			    <img src="<?php echo $cart_image1;?>" alt="" width="40" height="40"/>
			    <span class="item-info">
			        <span><?php echo $cart_items['name'];?></span>
			        <span class="text-primary"><strong> <?php echo currency().$this->cart->format_number($cart_items['price']); ?> </strong></span>
			    </span>
			</span>
			<span class="item-right">
			    <a style="margin:0;" class="btn btn-danger" href="javascript:void(0)" onclick="removeCart('<?php echo $cart_items['rowid'];?>')" ><i class="fa fa-close"></i></a>
			</span>
		</span>
	</li>
	<li class="divider"></li>

<?php 
	}
?>
	<li>
		<span class="item">
	    	<span class="item-left">
		        <span class="item-info">
		            <span><strong>TOTAL</strong></span>
		        </span>
			</span>
			<span class="item-right pull-right">
	            <span class="text-success"><?php echo currency().$this->cart->format_number($this->cart->total()); ?></span>
	    	</span>
		</span>
	</li>
	<li>
		<span class="item">
			<span class="item-right pull-right">
	        	<span class="text-success">
	        		<button onclick="viewcart()">VIEW CART</button> 
	        		<button onclick="checkout()">CHECK OUT</button>
	        	</span>
			</span>
		</span>
	</li>
<?php } else { ?>

	<li>
      <p class="text-center">Your cart is empty!</p>
    </li>

<?php } ?>