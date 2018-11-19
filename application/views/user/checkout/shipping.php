<div id="shipping-method-content" class="panel-collapse collapse">
  <div class="panel-body row">
    <div class="col-md-12">
      <p><?php echo $this->lang->line('label_shipping_page');?></p>
      <h4><?php echo $this->lang->line('label_flate_rate');?></h4>
      
    
      <?php   
        if(isset($shipping))  {
          foreach ($shipping as $key => $value) {
            
          
      ?>
       <div class="radio-list">
            <label>
              <input type="radio" name="shipping_rates" value="<?php echo $value;?>"> <?php echo $key.' '.$value;?>
            </label>
          </div>
        
      <?php
        } }  else { 
         
      ?>
       <div class="radio-list">
            <label>
              <input type="radio" name="shipping_rates" value="0.00"> Free shipping
            </label>
          </div>
      <?php } ?>
      
      <button class="btn btn-primary  pull-right" type="submit" id="button-shipping-method" class="btn-shipping-md" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-method-content">Continue</button>
    </div>
  </div>
</div>