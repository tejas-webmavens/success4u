<div id="confirm-content" class="panel-collapse collapse">

  <div class="panel-body row">
  <div class="col-md-12 clearfix">
    <div class="table-wrapper-responsive">
    <table>
      <tr>
        <th class="checkout-image"><?php echo $this->lang->line('label_image'); ?></th>
        <th class="checkout-description"><?php echo $this->lang->line('label_description'); ?></th>
        <th class="checkout-model"><?php echo $this->lang->line('label_model'); ?></th>
        <th class="checkout-quantity"><?php echo $this->lang->line('label_quantity'); ?></th>
        <th class="checkout-price"><?php echo $this->lang->line('label_price'); ?></th>
        <th class="checkout-total"><?php echo $this->lang->line('label_total'); ?></th>
      </tr>
      <tr>
      <?php 
      $i = 1;
      foreach ($carts as $items) {
        $id = str_replace('CIP_', '', $items['id']);
        $product = $this->product_model->GetProduct($id);
        if($product->Image) {
          $product_image = explode(',', $product->Image);
          $pimage1 = base_url().'uploads/admin/product/'.$product_image[0];
          
        } else {
          $pimage1 = base_url().'uploads/noimage.png';
          
        }
    ?>
        <td class="checkout-image">
          <a href="#"><img src="<?php echo $pimage1;?>" alt=""></a>
        </td>
        <td class="checkout-description">
          <h3><?php echo $items['name']; ?></h3>
          <p><strong>Item 1</strong> - Color: Green; Size: S</p>
          <em>More info is here</em>
        </td>
        <td class="checkout-model"><?php echo $items['id'];?></td>
        <td class="checkout-quantity"><?php echo $items['qty'];?></td>
        <td class="checkout-price"><strong><?php echo currency().' '.$this->cart->format_number($items['price']); ?></strong></td>
        <td class="checkout-total"><strong><?php echo currency().' '.$this->cart->format_number($items['subtotal']); ?></strong></td>
      </tr>
      <?php
      $i++;
      }
    ?>
      
    </table>
    </div>
    <?php
    $shipping_rates = $this->session->userdata('shipping');
    $shipping = $shipping_rates['shipping_rates'];
    
    if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0) {
      $cart_discount_data = $this->session->userdata('cart_discount');
      $dicount = $cart_discount_data['discount'];

      // $shipping = '1.00';

      $grand_total = $this->cart->total() - $dicount + $shipping;
      $vat = $grand_total * (17.5 / 100 );
      $grand_total1 = $grand_total + $vat;

      $coupon_code = $cart_discount_data['discount'];

    } else {
      $dicount = '0.00';
      // $shipping = '2.00';
      $grand_total = $this->cart->total() - $dicount + $shipping;
      $vat = $grand_total * (17.5 / 100 );
      $grand_total1 = $grand_total + $vat;
      
    }
    
  ?>
    <div class="checkout-total-block">
      <ul>
        <li>
          <em><?php echo $this->lang->line('sub_total'); ?></em>
          <strong class="price"><?php echo currency().' '.$this->cart->format_number($this->cart->total()); ?></strong>
        </li>
        <li>
          <em><?php echo $this->lang->line('shipping'); ?></em>
          <strong class="price"><?php echo currency().' '.$shipping; ?></strong>
        </li>
        <li>
          <em><?php echo $this->lang->line('dicsount'); ?></em>
          <strong class="price"><?php echo currency().' '.$dicount;?></strong>
        </li>
        <li>
          <em><?php echo $this->lang->line('vat'); ?> (17.5%)</em>
          <strong class="price"><?php echo currency().' '.$vat; ?></strong>
        </li>
        <li class="checkout-total-price">
          <em><?php echo $this->lang->line('total'); ?></em>
          <strong class="price"><?php echo currency().' '.$grand_total1; ?></strong>
        </li>
      </ul>
    </div>
    <div class="clearfix"></div>
   <!--  <button class="btn btn-primary pull-right" type="submit" id="button-confirm">Confirm Order</button>
    <button type="button" class="btn btn-default pull-right margin-right-20">Cancel</button> -->
  </div>
  </div>


  <div class="panel-body row">
<?php
    // echo "<pre>";
    // print_r($user);
    // print_r($this->session->userdata('cart_discount'));
    //$products = $this->cart->contents();
    $discount_cart = $this->session->userdata('cart_discount');
    // print_r($discount_cart);
    $discount_amount_cart = $discount_cart['discount'];
?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart" />
  <input type="hidden" name="upload" value="1" />
  <input type="hidden" name="business" value="priya-facilitator@arminfotech.com" />

  <?php 

    $i = 1; 
    foreach ($carts as $product) { 

  ?>
  <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $product['name']; ?>" />
  <input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $product['id']; ?>" />
  <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $product['price']; ?>" />
  <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $product['qty']; ?>" />
  
    <?php 
    if($product['options']) {
      $j = 0; 
      foreach ($product['options'] as $key => $value) {
        // echo "<br/>".$key.":".$value;
    

    ?>
      <input type="hidden" name="on<?php echo $j; ?>_<?php echo $i; ?>" value="<?php echo $key; ?>" />
      <input type="hidden" name="os<?php echo $j; ?>_<?php echo $i; ?>" value="<?php echo $value; ?>" />

    <?php 

      $j++; 
     } 

    $i++; 
    } 
  }
  ?>

  <?php if ($discount_amount_cart) { ?>
    <input type="hidden" name="discount_amount_cart" value="<?php echo $discount_amount_cart; ?>" />
  <?php } ?>
  <?php if($this->session->userdata('MemberID')) { ?>
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="first_name" value="<?php echo $user->FirstName; ?>" />
    <input type="hidden" name="last_name" value="<?php echo $user->LastName; ?>" />
    <input type="hidden" name="address1" value="<?php echo $user->Address; ?>" />
    
    <input type="hidden" name="city" value="<?php echo $user->City; ?>" />
    <input type="hidden" name="zip" value="<?php echo $user->Zip; ?>" />
    <input type="hidden" name="country" value="<?php echo $user->Country; ?>" />
    <input type="hidden" name="address_override" value="0" />
    <input type="hidden" name="email" value="<?php echo $user->Email; ?>" />
    <input type="hidden" name="rm" value="2" />
    <input type="hidden" name="amount" value="<?php echo $grand_total1;?>" />
    <input type="hidden" name="tax" value="<?php echo $vat;?>">
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="shipping" value="<?php echo $shipping;?>">
    <input type="hidden" name="charset" value="utf-8" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>" />
    <input type="hidden" name="paymentaction" value="sale" />
    <input type="hidden" name="custom" value="<?php echo $this->session->userdata('MemberID');?>" />
  <?php } else { ?>
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="first_name" value="<?php echo $user['FirstName']; ?>" />
    <input type="hidden" name="last_name" value="<?php echo $user['LastName'] ?>" />
    <input type="hidden" name="address1" value="<?php echo $user['Address']; ?>" />
    <input type="hidden" name="city" value="<?php echo $user['City']; ?>" />
    <input type="hidden" name="zip" value="<?php echo $user['Zip']; ?>" />
    <input type="hidden" name="country" value="<?php echo $user['Country']; ?>" />
    <input type="hidden" name="address_override" value="0" />
    <input type="hidden" name="email" value="<?php echo $user['Email']; ?>" />
    <input type="hidden" name="rm" value="2" />
    <input type="hidden" name="amount" value="<?php echo $grand_total1;?>" />
    <input type="hidden" name="tax" value="<?php echo $vat;?>">
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="shipping" value="<?php echo $shipping;?>">
    <input type="hidden" name="charset" value="utf-8" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" />
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>" />
    <input type="hidden" name="paymentaction" value="sale" />
    
  <?php } ?>
 
  <!-- <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $this->lang->line('pay'); ?>" class="btn btn-primary" />

    </div>
  </div> -->
  <button class="btn btn-primary pull-right" type="button" id="button-confirm">Confirm Order</button>
    <!-- <button type="button" class="btn btn-default pull-right margin-right-20">Cancel</button> -->
</form>
</div>
</div>