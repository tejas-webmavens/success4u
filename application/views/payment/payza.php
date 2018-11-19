<div id="confirm-content" class="panel-collapse">
<?php
    if(isset($carts)) {
?>
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

      $vat = $this->cart->total() * (17.5 / 100 );
      $grand_total = $vat + $shipping - $dicount;
      $grand_total1 = $grand_total + $this->cart->total();

      $coupon_code = $cart_discount_data['discount'];

    } else {
      $dicount = '0.00';
      // $shipping = '2.00';
      $vat = $this->cart->total() * (17.5 / 100 );
      $grand_total = $shipping + $vat - $dicount;
      $grand_total1 = $grand_total + $this->cart->total();
      
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
          <strong class="price"><?php echo currency().' '.number_format($vat,2); ?></strong>
        </li>
        <li class="checkout-total-price">
          <em><?php echo $this->lang->line('total'); ?></em>
          <strong class="price"><?php echo currency().' '.number_format($grand_total1,2); ?></strong>
        </li>
      </ul>
    </div>
    <div class="clearfix"></div>
   
  </div>
  </div>
<?php
    }
    if(isset($epins)) {
?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $ap_itemname;?></span></strong></h3>
    <h3><?php echo $this->lang->line('epin_count'); ?> : <strong><span><?php echo $epincount;?></span></strong></h3>
    <h3>Total amount  : <strong><span><?php echo number_format($ap_amount,2);?></span></strong></h3>
<?php
    }
    if(isset($register)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $ap_itemname;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($ap_amount,2);?></span></strong></h3>
  <?php
    }
    if(isset($subscription)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $ap_itemname;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($ap_amount,2);?></span></strong></h3>
  <?php
    }
    if(isset($upgrade)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $ap_itemname;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($ap_amount,2);?></span></strong></h3>
  <?php
    }
?>

  <div class="panel-body row">
    <form method="post" action="<?php echo $paymentUrl;?>">
      <input type="hidden" value="<?php echo $ap_merchant;?>" name="ap_merchant">
      <input type="hidden" value="<?php echo str_replace(',', '', number_format($ap_amount,2));?>" name="ap_amount">
      <input type="hidden" value="USD" name="ap_currency">
      <input type="hidden" value="1" name="ap_test">
  <?php
      if(isset($carts)) {
  ?>
      <input type="hidden" value="Item" name="ap_purchasetype">
      <input type="hidden" value="carts" name="ap_itemname">
      <input type="hidden" value="<?php echo ($this->session->userdata('MemberID')) ? $this->session->userdata('MemberID') : $this->session->userdata('userid');?>" name="ap_itemcode">
  <?php

    }

      if(isset($epins)) {
  ?>
      <input type="hidden" value="Item" name="ap_purchasetype">
      <input type="hidden" value="epins" name="ap_itemname">
      <input type="hidden" value="<?php echo $ap_cus1;?>" name="ap_itemcode">
      <input type="hidden" name="apc_1" value="<?php echo $ap_itemcode; ?>" />
      <input type="hidden" name="apc_2" value="<?php echo $ap_itemname; ?>" />
      <input type="hidden" name="apc_3" value="<?php echo $epincount; ?>" />
      <input type="hidden" name="apc_4" value="<?php echo $packageamount; ?>" />
  <?php

    }
    if(isset($register)) {

    ?>
      <input type="hidden" value="service" name="ap_purchasetype">
      <input type="hidden" value="register" name="ap_itemname">
      <input type="hidden" value="<?php echo $ap_cus1;?>" name="ap_itemcode">
      <input type="hidden" name="apc_1" value="<?php echo $ap_itemcode; ?>" />
      <input type="hidden" name="apc_2" value="<?php echo $ap_itemname; ?>" />
      
    <?php

      }
      if(isset($subscription)) {

    ?>
      <input type="hidden" value="service" name="ap_purchasetype">
      <input type="hidden" value="subscription" name="ap_itemname">
      <input type="hidden" value="<?php echo $ap_cus1;?>" name="ap_itemcode">
      <input type="hidden" name="apc_1" value="<?php echo $ap_itemcode; ?>" />
      <input type="hidden" name="apc_2" value="<?php echo $ap_itemname; ?>" />
      
    <?php

      }
      if(isset($upgrade)) {

    ?>
      <input type="hidden" value="service" name="ap_purchasetype">
      <input type="hidden" value="upgrade" name="ap_itemname">
      <input type="hidden" value="<?php echo $ap_cus1;?>" name="ap_itemcode">
      <input type="hidden" name="apc_1" value="<?php echo $ap_itemcode; ?>" />
      <input type="hidden" name="apc_2" value="<?php echo $ap_itemname; ?>" />
      
    <?php

      }
    ?>
      <input type="hidden" value="<?php echo $ap_alerturl;?>" name="ap_alerturl">
      <input type="hidden" value="<?php echo $ap_returnurl;?>" name="ap_returnurl">
      <input type="hidden" value="<?php echo $ap_cancelurl;?>" name="ap_cancelurl">
      <div class="buttons">
        <div class="pull-right">
        <?php
          if(isset($carts)) {
        ?>
          <input class="btn btn-primary" type="button" id="button-confirm" value="<?php echo $this->lang->line('confirm_order'); ?>">
        <?php  } else { ?>
          <input class="btn btn-primary" type="submit"  value="<?php echo $this->lang->line('pay'); ?>">
        <?php } ?>
        </div>
      </div>
    </form>
  </div>

</div>