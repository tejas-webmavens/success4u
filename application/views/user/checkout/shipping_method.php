<div id="shipping-method-content" class="panel-collapse collapse in">
	<div class="panel-body row">
	<div class="col-md-12">
	  <p><?php echo $this->lang->line('label_shipping_page');?></p>
	  <h4><?php echo $this->lang->line('flat_rate');?></h4>
	  <div class="radio-list">
	    <label>
	      <input type="radio" name="FlatShippingRate" value="FlatShippingRate"> <?php echo $this->lang->line('label_flat_shipping_rate');?>
	    </label>
	  </div>
	  <div class="form-group">
	    <label for="delivery-comments"><?php echo $this->lang->line('label_shipping_comments');?></label>
	    <textarea id="delivery-comments" rows="8" class="form-control"></textarea>
	  </div>
	  <button class="btn btn-primary  pull-right" type="submit" id="button-shipping-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-method-content">Continue</button>
	</div>
	</div>
</div>