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
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('epin_count'); ?> : <strong><span><?php echo $epincount;?></span></strong></h3>
    <h3>Total amount  : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
<?php
    }
    if(isset($register)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <?php
    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
    if($mlsetting->Id==9)
    {?>
    <h3> Min amount: <strong><span><?php echo number_format($amount1,2);?></span></strong></h3>
    <h3> Max Amount : <strong><span><?php echo number_format($amount2,2);?></span></strong></h3>
    <?}
    else
    {?>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>


    <?}


    ?>
  <?php
    }
     if(isset($subscription)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($m_amount,2);?></span></strong></h3>
  <?php
    }
    if(isset($upgrade)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
     <?php
    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
    if($mlsetting->Id==9)
    {?>
    <h3> Min amount: <strong><span><?php echo number_format($amount1,2);?></span></strong></h3>
    <h3> Max Amount : <strong><span><?php echo number_format($amount2,2);?></span></strong></h3>
    <?}
    else
    {?>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>


    <?}?>

  <?php
    }
       $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
  
if($mlsetting->Id==9)
{
    if(isset($deposit))
    {
      $currency_symbol=$this->common_model->GetRow("Status='1'",'arm_currency');?>
    

      <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo $currency_symbol->CurrencySymbol." ".number_format($min_amount). " to " ." ". $currency_symbol->CurrencySymbol .number_format($max_amount);?></span></strong></h3>

  <?php  }
}
?>
  <div class="panel-body row">
    <form method="post" action="<?php echo $bitcoin->PaymentLiveUrl;?>" role="form" id="payment-method-content">


     
     <?php
    if(isset($deposit)){?>
       <h3>Amount: <strong><span><input type="text" name="transactionamount" required placeholder="Enter your Amount" style="width: 350px;" ></span></strong></h3>
      <input type="hidden" name="item_name" value="Deposit">

     <?} else {?>
      <p></p>
      <?php }?>
     <?php
        if(isset($carts)) {
      ?>
        
        <input type="hidden" name="item_name" value="<?php echo $label; ?>">

      <input type="hidden" name="amountf" value="<?php echo $this->data['amount']; ?>">

       <input type="hidden" name="on1" value="1" />

        <input type="hidden" name="ov1" value="1" />

        
      <?php 
      }

      if(isset($epins)) {
      ?>
        <input type="hidden" name="item_name" value="<?php echo $label; ?>">
        <input type="hidden" name="on1" value="<?php echo $package; ?>" />
        <input type="hidden" name="ov1" value="<?php echo $packageid; ?>" />
        <input type="hidden" name="quantity" value="<?php echo $epincount; ?>" />
        <input type="hidden" name="custom" value="<?php echo $packageamount; ?>" />
        
      <?php
        }
        if(isset($register)) {
      ?>
      
        <input type="hidden" name="item_name" value="<?php echo $label; ?>">
        <input type="hidden" name="on1" value="<?php echo $package; ?>" />
      <input type="hidden" name="amountf" value="<?php echo $this->data['amount']; ?>">
        <input type="hidden" name="ov1" value="<?php echo $packageid; ?>" />
       
      <?php
        }
        if(isset($subscription)) {
      ?>
        <input type="hidden" name="item_name" value="<?php echo $label; ?>">
        <input type="hidden" name="on1" value="<?php echo $package; ?>" />
        <input type="hidden" name="ov1" value="<?php echo $packageid; ?>" />
       <input type="hidden" name="amountf" value="<?php echo $this->data['amount']; ?>">
        
        
      <?php
        }
        if(isset($upgrade)) {
      ?>
        <input type="hidden" name="item_name" value="<?php echo $label; ?>">
        <input type="hidden" name="on1" value="<?php echo $package; ?>" />
        <input type="hidden" name="ov1" value="<?php echo $packageid; ?>" />
       <input type="hidden" name="amountf" value="<?php echo $this->data['amount']; ?>">

        
      <?php
        }
      ?>
      
      <!-- <input type="hidden" name="allow_currencies" value="BTC"> -->
     
     <input type="hidden" name="merchant" value="<?php echo $this->data['merchant_id'];?>">
      <input type="hidden" name="currency" value="<?php echo strtoupper($this->data['curr']); ?>">
      <input type="hidden" value="_pay" name="cmd">
      <input type="hidden" value="1" name="reset">
      <input type="hidden" value="BTC" name="allow_currencies">     
      <input type="hidden" name="item_number" value="<?php echo $Memberid;?>">
      <input type="hidden" name="want_shipping" value="0">
      <input type=hidden name="success_url" value="<?php echo $return;?>">
      <input type=hidden name="notify_url" value="<?php echo $notify_url;?>">
      <input type=hidden name="cancel_url" value="<?php echo $cancel_return;?>">

      <div class="buttons">
        <div class="pull-right">
        <?php if(isset($carts)) { ?>
          <input class="btn btn-primary" type="button" id="button-confirm" value="<?php echo $this->lang->line('confirm_order'); ?>">
         <?php } elseif(isset($deposit)) { ?>
            <input type="button" value="<?php echo $this->lang->line('pay'); ?>" class="btn btn-primary" id="btnconform" />
          <? } elseif(isset($register)) { ?>
          <input type="submit" value="<?php echo $this->lang->line('pay'); ?>" class="btn btn-primary" id="button" />
          <?}
          else{ ?>
          <input type="submit" value="<?php echo $this->lang->line('pay'); ?>" class="btn btn-primary" id="button" />
          <?}?>
        </div>
      </div>
      <div class="payment_form">
     </div>

    </form>
    
  </div>
</div>