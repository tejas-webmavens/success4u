<div id="confirm-content" class="panel-collapse collapse">

  <div class="panel-body row">
  <form method="post" action="<?php echo base_url();?>payment/cod/codcart">
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
    <button class="btn btn-primary pull-right" type="button" id="button-confirm">Confirm Order</button>
    <!-- <button type="button" class="btn btn-default pull-right margin-right-20">Cancel</button> -->
  </div>
  </form>
  </div>
</div>