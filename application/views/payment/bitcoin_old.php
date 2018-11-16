<div id="confirm-content" class="panel-collapse">
<!-- <form method="post" action="<?php echo base_url();?>payment/bitcoin/confirmbitcoin"> -->
<?php
    if(isset($carts)) {
?>
<div class="panel-body row">
<?php //print_r($bitcoin);?>
  <!-- <form method="post" action="<?php echo base_url();?>payment/bitcoin/bitcoincart"> -->
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
   <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>payment/bitcoin/confirmbitcoin">
    <div class="checkout-total-block">
      <ul>
        <li>
          <em><?php echo $this->lang->line('sub_total'); ?></em>
          <strong class="price"><?php echo currency().$this->cart->format_number($this->cart->total()); ?></strong>
        </li>
        <li>
          <em><?php echo $this->lang->line('shipping'); ?></em>
          <strong class="price"><?php echo currency().number_format($shipping,2); ?></strong>
        </li>
        <li>
          <em><?php echo $this->lang->line('dicsount'); ?></em>
          <strong class="price"><?php echo currency().number_format($dicount,2);?></strong>
        </li>
        <li>
          <em><?php echo $this->lang->line('vat'); ?> (17.5%)</em>
          <strong class="price"><?php echo currency().number_format($vat,2); ?></strong>
        </li>
        <li class="checkout-total-price">
          <em><?php echo $this->lang->line('total'); ?></em>
          <strong class="price"><?php echo currency().number_format($grand_total1,2); ?></strong>
        </li>
      </ul>
    </div>
    <input type="hidden" value="cart" name="label">
    <input type="hidden" name="amount" value="<?php echo str_replace(',', '', number_format($amount,2));?>"/>
    
    <!-- <button type="submit" class="btn btn-default pull-right margin-right-20">Cancel</button> -->
  </div>
  <!-- </form> -->
  </div>
    
    <div class="buttons">
        <div class="pull-right">
          <button class="btn btn-primary pull-right" type="button" id="button-confirm"><?php echo $this->lang->line('confirm_order'); ?></button>
          <!-- <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('confirm_order'); ?>"> -->
        </div>
      </div>
      </form>
  <?php
  }
    if(isset($epins)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('epin_count'); ?> : <strong><span><?php echo $epincount;?></span></strong></h3>
    <h3>Total amount  : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $orderid;?>" name="user"/>
    <input type="hidden" value="epin" name="label">
    <input type="hidden" value="<?php echo str_replace(',', '', number_format($amount,2));?>" name="amount">
    <div class="buttons">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('pay'); ?>">
      </div>
    </div>
  <?php
    }
    if(isset($register)) {
  ?>
  <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>user/register/checkbitcoin/<?php echo $Memberid;?>">
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $orderid;?>" name="user"/>
    <input type="hidden" value="register" name="label">
    <input type="hidden" value="<?php echo str_replace(',', '', number_format($amount,2));?>" name="amount">
    <div class="buttons">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('pay'); ?>">
      </div>
    </div>
    </form>
  <?php
    }if(isset($subscription)) {
  ?>
  <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>user/register/checkbitcoin/<?php echo $Memberid;?>">
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $orderid;?>" name="user"/>
    <input type="hidden" value="subscription" name="label">
    <input type="hidden" value="<?php echo str_replace(',', '', number_format($amount,2));?>" name="amount">
    <div class="buttons">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('pay'); ?>">
      </div>
    </div>
    </form>
  <?php
    }
    if(isset($upgrade)) {
  ?>
  <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>user/upgrade/checkbitcoin/<?php echo $packageid;?>">
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $orderid;?>" name="user"/>
    <input type="hidden" value="upgrade" name="label">
    <input type="hidden" value="<?php echo str_replace(',', '', number_format($amount,2));?>" name="amount">
    <div class="buttons">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('pay'); ?>">
      </div>
    </div>
    </form>
  <?php
    }
  ?>
  
<!-- </form> -->
</div>
