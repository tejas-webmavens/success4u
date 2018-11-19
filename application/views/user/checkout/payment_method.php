<div id="payment-method-content" class="panel-collapse collapse">
	<div class="panel-body row">
	<div class="col-md-12">
		<div class="flashmessage"></div>
		<p><?php echo $this->lang->line('label_payment_page');?></p>
		<p><?php echo $this->lang->line('label_product');?></p>
	  	<div class="radio-list">
	  		<label>
	            <!-- <input type="radio" checked="checked" value="cod" name="payment_method"> <?php echo $this->lang->line('label_cod');?>       -->
	        </label>
		</div>
		<?php

			if($paymentdetails) {
				foreach ($paymentdetails as $row) 
				{
					if($row->PaymentStatus)
					{ 
						if($row->PaymentName=='epin' || $row->PaymentName=='bankwire') {

						} else { 
							if($row->PaymentName == 'Authorizenetsim'){ ?>

                               <div class="radio-list">
					  		<label>
					            <input type="radio" class="2" value="<?php echo $row->PaymentName;?>" name="payment_method"> Secure Credit Card    
					        </label>
						</div>


					<?php		} else {
		?>
						<div class="radio-list">
					  		<label>
					            <input type="radio" class="1" value="<?php echo $row->PaymentName;?>" name="payment_method"> <?php echo ucfirst($row->PaymentName);?>      
					        </label>

						</div>
						

		<?php }
						}
					}

				}
			$total=$this->cart->total();
			if($this->session->MemberID)
			{
				?>
			<!-- } -->

				
			 <?php $bal=$this->common_model->Getcusomerbalance($this->session->MemberID);?>

				<div class="radio-list">
					  		<label>
					            <input type="radio" class="1" value="AccountBalance" name="payment_method" id="paythrough"> Current Balance-
					        <? echo currency()." ".number_format($bal,2);?></label>
	           <h4><?echo ucwords(form_error('errorbalance'));?></h4>

				</div>
						
				<input type="hidden" name="balanceamount" id="balanceamount" value="<?php echo $bal;?>">
				
				<input type="hidden" name="totalamount" id="totalamount" value="<?php echo $total;?>">
				<input type="hidden" name="userid" id="userid" value="<?php echo $this->session->MemberID;?>">


		<?php
	}
			}

		?>

		<!-- <div class="radio-list">
	  		<label>
	            <input type="radio" value="paypalcart" name="payment_method"> PayPal      
	        </label>
		</div>
	  
	  <div class="form-group">
	    <label for="delivery-payment-method">Add Comments About Your Order</label>
	    <textarea id="delivery-payment-method" rows="8" class="form-control"></textarea>
	  </div> -->
	  <button class="btn btn-primary  pull-right" type="submit" id="button-payment-method"><?php echo $this->lang->line('label_countine');?></button>
	  <div class="checkbox pull-right">
	    <label>
	      <input type="checkbox" name="agree" id="agre"> <a title="Terms & Conditions" href="#"><?php echo $this->lang->line('terms');?> </a> <br>
	      <!-- <input type="checkbox" name="con" id="con"><a href="#"> Not Return amount to Purchase Product</a><br>&nbsp;&nbsp;&nbsp;&nbsp; -->
	      <!-- <p>Not return the amount to purchase product</p> -->
	    </label>
	  </div>  
	</div>
	</div>
</div>

<!-- <script type="text/javascript">
	$(document).ready(function () {
 	// alert(a);
    $('#paythrough').click(function(){
    	alert('hi');

    	var paythrough=$('#paythrough').val();
    	var b=$('#totalamount').val();
        
 	    var a=$('#userid').val();
 	    html='<p id="balanceamount"></p>';
     	$('#bal').append(html);
                    

 	    	

      if(paythrough=='Accountbalance')
      {
      $.ajax({
            url: "<?php echo base_url();?>user/checkout/getcustomerbal/"+a+"/"+b,
            type: "post",
            
            data: {id: $(this).find("option:selected").val()},

            success: function(data){
                if(data) {
			
                 	 $('#balanceamount').val(data);
                } else
                 {
                	  html='<p id="balanceamount"></p>';
     				 $('#bal').append(html);

                     $('#balanceamount').val('0.00');
                    
                }
               
            }
        });
}
    });
});

</script>
 -->
    

