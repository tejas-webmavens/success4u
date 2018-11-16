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
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID"/>
    <input type="hidden" name="on0" value="<?php echo $packageid; ?>" />
    <input type="hidden" name="on1" value="<?php echo $package; ?>" />
    <input type="hidden" name="os0" value="<?php echo $label; ?>" />
    <!-- <button class="btn btn-primary pull-right" type="submit" id="button-confirm"><?php echo $this->lang->line('confirm_order'); ?></button> -->
<?php
    }
    if(isset($subscription)) {
?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID"/>
    <input type="hidden" name="on0" value="<?php echo $packageid; ?>" />
    <input type="hidden" name="on1" value="<?php echo $package; ?>" />
    <input type="hidden" name="os0" value="<?php echo $label; ?>" />
    <!-- <button class="btn btn-primary pull-right" type="submit" id="button-confirm"><?php echo $this->lang->line('confirm_order'); ?></button> -->
<?php
    }
    if(isset($upgrade)) {
?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
    <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID"/>
    <input type="hidden" name="on0" value="<?php echo $packageid; ?>" />
    <input type="hidden" name="on1" value="<?php echo $package; ?>" />
    <input type="hidden" name="os0" value="<?php echo $label; ?>" />
    <!-- <button class="btn btn-primary pull-right" type="submit" id="button-confirm"><?php echo $this->lang->line('confirm_order'); ?></button> -->
<?php
    }
      $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
  
if($mlsetting->Id==9)
{
    if(isset($deposit)){
       $currency_symbol=$this->common_model->GetRow("Status='1'",'arm_currency');?>
      <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo $currency_symbol->CurrencySymbol." ".number_format($min_amount). " to " ." ". $currency_symbol->CurrencySymbol .number_format($max_amount);?></span></strong></h3>
    <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID"/>
    <input type="hidden" name="on0" value="<?php echo $packageid; ?>" />
    <input type="hidden" name="on1" value="<?php echo $package; ?>" />
    <input type="hidden" name="os0" value="<?php echo $label; ?>" />
   
    <!--  <button class="btn btn-primary pull-right" type="submit" id="btnconform"><?php echo $this->lang->line('confirm_order'); ?></button> -->
  <?php  }
    }
?>
  <div class="panel-body row">
    <form id="payment-method-content" class="payment_class" method="POST" action="<?php echo $perfectmoney->PaymentLiveUrl;?>">

         <?php
    if(isset($deposit)){?>
       <h3>Amount: <strong><span><input type="text" name="transactionamount" required placeholder="Enter your Amount" style="width: 350px;" ></span></strong></h3>
     <?} else {?>
      <p></p>
      <?php }?>
        <input type="hidden" value="<?php echo $payee_account;?>" name="PAYEE_ACCOUNT">
        <input type="hidden" value="ARMCIP" name="PAYEE_NAME">
        <input type="hidden" value="<?php echo $currency;?>" name="PAYMENT_UNITS">

        <?php if(isset($epins)) { ?>
          <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID">
          <input type="hidden" name="ORDER_NUM" value="purchase epins from <?php echo $package; ?>">
          <input type="hidden" name="CUST_NUM0" value="<?php echo $packageid;?>">
          <input type="hidden" name="CUST_NUM1" value="<?php echo $package;?>">
          <input type="hidden" name="MEMO" value="<?php echo $memo;?>">
        <?php } ?>

        <?php if(isset($register)) { ?>
          <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID">
          <input type="hidden" name="ORDER_NUM" value="purchase epins from <?php echo $package; ?>">
          <input type="hidden" name="CUST_NUM" value="<?php echo $packageid;?>">
          <input type="hidden" name="MEMO" value="<?php echo $memo;?>">
        <?php } ?>
        <?php if(isset($subscription)) { ?>
          <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID">
          <input type="hidden" name="ORDER_NUM" value="purchase epins from <?php echo $package; ?>">
          <input type="hidden" name="CUST_NUM" value="<?php echo $packageid;?>">
          <input type="hidden" name="MEMO" value="<?php echo $memo;?>">
        <?php } ?>

        <?php if(isset($upgrade)) { ?>
          <input type="hidden" value="<?php echo $Memberid;?>" name="PAYMENT_ID">
          <input type="hidden" name="ORDER_NUM" value="purchase epins from <?php echo $package; ?>">
          <input type="hidden" name="CUST_NUM0" value="<?php echo $packageid;?>">
          <input type="hidden" name="MEMO" value="<?php echo $memo;?>">
        <?php } ?>
         <?php if(isset($deposit)) { ?>
          <input type="hidden" value="<?php echo $Membecrid;?>" name="PAYMENT_ID">
          
          <input type="hidden" name="ORDER_NUM" value="purchase epins from <?php echo $package; ?>">
          <input type="hidden" name="CUST_NUM0" value="<?php echo $packageid;?>">
          <input type="hidden" name="MEMO" value="<?php echo $memo;?>">
        <?php } ?>

        <input type="hidden" name="STATUS_URL" value="<?php echo $status_url;?>">
        <input type="hidden" name="PAYMENT_URL" value="<?php echo $payment_url;?>">
        <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $nopayment_url;?>">
        <?php
        if(!isset($deposit)) { 

        ?>
        <input type="hidden" value="<?php echo str_replace(',', '', number_format($amount,2));?>" name="PAYMENT_AMOUNT">
        <?}?>
        <div class="buttons">
          <div class="pull-right">
            <input type="submit" value="<?php echo $this->lang->line('pay'); ?>" class="btn btn-primary" id="btnconform" />
          </div>
        </div>
    </form>
  </div>
</div>