

                           <form name="paypalFrm" id="paypalFrm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                               <hr class="hrzntl"/>
                                <input type="hidden" name="cmd" value="_ext-enter">
                                <input type="hidden" name="redirect_cmd" value="_xclick-subscriptions">
                                <input type="hidden" name="return" value="<?php echo base_url();?>">
                                <input type="hidden" name="cancel_return" value="<?php echo base_url();?>">
                                <input type="hidden" name="notify_url" value="<?php echo base_url();?>">
                                <input type="hidden" name="custom" value="<?php echo 'register';?>">
                                <input type="hidden" name="business" value="<?php echo 'merhant';?>">
                                <input type="hidden" name="item_name" value="<?php echo 'ultra';?>">
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="no_note" value="1">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="a3" value="<?php echo '100';?>">  
                                <input type="hidden" name="p3" value="1">  
                                <input type="hidden" name="t3" value="M">   
                                <input type="hidden" name="src" value="1">
                                <input type="hidden" name="sra" value="1">
                                <input type="hidden" name="srt" value="12">
                                <input type="hidden" name="first_name" value="<?php echo 'arun';?>">
                                <input type="hidden" name="lc" value="<?php echo 'india';?>">
                                <input type="hidden" name="email" value="<?php echo 'arun@gmail.com';?>">
                                <button><img src="<?php echo base_url();?>uploads/payment/paypal.jpg"><br></button>
                                
                            </form>
