<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>  <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"> -->
<link href="<?php echo base_url();?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/animations.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/simplePagination.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/components.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/style-shop.css" type="text/css">
</head>
<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
<!--<div class="se-pre-con"></div>-->
<div id="wrapper">
	<?php $this->load->view('user/header');?>
		<div class="clearfix"></div>
		<div class="shtbnr clearfix">
				<div class="col-lg-12">
						<div class="row">
								<div class="bskt">
										<h1>Product Page</h1>
										
								</div>
						</div>
				</div>
		</div>
		<div class="clearfix"></div>
		<div class="checkout">
			<div class="row">
				<div class="col-lg-12">
					<div class="bskt">
						<div class="col-md-12 col-sm-12">
            <h2> CHECK OUT <i class="fa fa-bank text-gray" style="font-size:1em"></i></h2>
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">
              <?php
        echo "<pre>";
        print_r($this->cart->contents());
        print_r($this->session->userdata('cart_discount'));
        ?>
              <!-- BEGIN CHECKOUT -->
              <div id="checkout" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content" class="accordion-toggle">
                      <i class="fa fa-bank"></i> Checkout Options
                    </a>
                  </h2>
                </div>
                <div id="checkout-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>New Customer</h3>
                      <p>Checkout Options:</p>
                      <div class="radio-list">
                        <label>
                          <input type="radio" name="account"  value="register"> Register Account
                        </label>
                        <label>
                          <input type="radio" name="account"  value="guest"> Guest Checkout
                        </label> 
                      </div>
                      <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                      <button class="btn btn-primary" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content">Continue</button>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Returning Customer</h3>
                      <p>I am a returning customer.</p>
                      <form role="form" action="#">
                        <div class="form-group">
                          <label for="email-login">E-Mail</label>
                          <input type="text" id="email-login" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password-login">Password</label>
                          <input type="password" id="password-login" class="form-control">
                        </div>
                        <a href="#">Forgotten Password?</a>
                        <div class="padding-top-20">                  
                          <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                        <hr>
                        <div class="login-socio">
                          <p class="text-muted">or login using:</p>
                          <ul class="social-icons">
                            <li><a href="#" data-original-title="facebook" class="facebook" title="facebook"></a></li>
                            <li><a href="#" data-original-title="Twitter" class="twitter" title="Twitter"></a></li>
                            <li><a href="#" data-original-title="Google Plus" class="googleplus" title="Google Plus"></a></li>
                            <li><a href="#" data-original-title="Linkedin" class="linkedin" title="LinkedIn"></a></li>
                          </ul>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CHECKOUT -->

              <!-- BEGIN PAYMENT ADDRESS -->
              <div id="payment-address" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                      <i class="fa fa-print"></i> Account &amp; Billing Details
                    </a>
                  </h2>
                </div>
                <div id="payment-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Personal Details</h3>
                      <div class="form-group">
                        <label for="firstname">First Name <span class="require">*</span></label>
                        <input type="text" id="firstname" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="lastname">Last Name <span class="require">*</span></label>
                        <input type="text" id="lastname" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email">E-Mail <span class="require">*</span></label>
                        <input type="text" id="email" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="telephone">Telephone <span class="require">*</span></label>
                        <input type="text" id="telephone" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="fax">Fax</label>
                        <input type="text" id="fax" class="form-control">
                      </div>

                      <h3>Your Password</h3>
                      <div class="form-group">
                        <label for="password">Password <span class="require">*</span></label>
                        <input type="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-confirm">Password Confirm <span class="require">*</span></label>
                        <input type="text" id="password-confirm" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Address</h3>
                      <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="address1">Address 1</label>
                        <input type="text" id="address1" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="address2">Address 2</label>
                        <input type="text" id="address2" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="city">City <span class="require">*</span></label>
                        <input type="text" id="city" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="post-code">Post Code <span class="require">*</span></label>
                        <input type="text" id="post-code" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="country">Country <span class="require">*</span></label>
                        <select class="form-control input-sm" id="country">
                          <option value=""> --- Please Select --- </option>
                          <option value="244">Aaland Islands</option>
                          <option value="1">Afghanistan</option>
                          <option value="2">Albania</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="region-state">Region/State <span class="require">*</span></label>
                        <select class="form-control input-sm" id="region-state">
                          <option value=""> --- Please Select --- </option><option value="3513">Aberdeen</option><option value="3514">Aberdeenshire</option><option value="3515">Anglesey</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-12">                      
                    <div class="col-md-12">    <div class="checkbox">
                        <label>
                          <input type="checkbox"> I wish to subscribe to the OXY newsletter. 
                        </label>
                      </div>
					  <div class="checkbox">
                        <label>
                          <input type="checkbox" checked="checked"> My delivery and billing addresses are the same.
                        </label>
                      </div>
					  </div>
                      
                      <button class="btn btn-primary  pull-right" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#shipping-address-content" id="button-payment-address">Continue</button>
                      <div class="checkbox pull-right">
                        <label>
                          <input type="checkbox"> I have read and agree to the <a title="Privacy Policy" href="#">Privacy Policy</a> &nbsp;&nbsp;&nbsp; 
                        </label>
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT ADDRESS -->

              <!-- BEGIN SHIPPING ADDRESS -->
              <div id="shipping-address" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content" class="accordion-toggle">
                     <i class="fa fa-code "></i> Delivery Details
                    </a>
                  </h2>
                </div>
                <div id="shipping-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label for="firstname-dd">First Name <span class="require">*</span></label>
                        <input type="text" id="firstname-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="lastname-dd">Last Name <span class="require">*</span></label>
                        <input type="text" id="lastname-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email-dd">E-Mail <span class="require">*</span></label>
                        <input type="text" id="email-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="telephone-dd">Telephone <span class="require">*</span></label>
                        <input type="text" id="telephone-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="fax-dd">Fax</label>
                        <input type="text" id="fax-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="company-dd">Company</label>
                        <input type="text" id="company-dd" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label for="address1-dd">Address 1</label>
                        <input type="text" id="address1-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="address2-dd">Address 2</label>
                        <input type="text" id="address2-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="city-dd">City <span class="require">*</span></label>
                        <input type="text" id="city-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="post-code-dd">Post Code <span class="require">*</span></label>
                        <input type="text" id="post-code-dd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="country-dd">Country <span class="require">*</span></label>
                        <select class="form-control input-sm" id="country-dd">
                          <option value=""> --- Please Select --- </option>
                          <option value="244">Aaland Islands</option>
                          <option value="1">Afghanistan</option>
                          <option value="2">Albania</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="region-state-dd">Region/State <span class="require">*</span></label>
                        <select class="form-control input-sm" id="region-state-dd">
                          <option value=""> --- Please Select --- </option><option value="3513">Aberdeen</option><option value="3514">Aberdeenshire</option><option value="3515">Anglesey</option><option value="3516">Angus</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-primary  pull-right" type="submit" id="button-shipping-address" data-toggle="collapse" data-parent="#checkout-page" data-target="#shipping-method-content">Continue</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END SHIPPING ADDRESS -->

              <!-- BEGIN SHIPPING METHOD -->
              <div id="shipping-method" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-method-content" class="accordion-toggle">
                       <i class="fa fa-truck"></i> Delivery Method
                    </a>
                  </h2>
                </div>
                <div id="shipping-method-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12">
                      <p>Please select the preferred shipping method to use on this order.</p>
                      <h4>Flat Rate</h4>
                      <div class="radio-list">
                        <label>
                          <input type="radio" name="FlatShippingRate" value="FlatShippingRate"> Flat Shipping Rate
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="delivery-comments">Add Comments About Your Order</label>
                        <textarea id="delivery-comments" rows="8" class="form-control"></textarea>
                      </div>
                      <button class="btn btn-primary  pull-right" type="submit" id="button-shipping-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-method-content">Continue</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END SHIPPING METHOD -->

              <!-- BEGIN PAYMENT METHOD -->
              <div id="payment-method" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-method-content" class="accordion-toggle">
                       <i class="fa fa-dollar"></i> Payment Method
                    </a>
                  </h2>
                </div>
                <div id="payment-method-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12">
                      <p>Please select the preferred payment method to use on this order.</p>
                      <div class="radio-list">
                        <label>
                          <input type="radio" name="CashOnDelivery" value="CashOnDelivery"> Cash On Delivery
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="delivery-payment-method">Add Comments About Your Order</label>
                        <textarea id="delivery-payment-method" rows="8" class="form-control"></textarea>
                      </div>
                      <button class="btn btn-primary  pull-right" type="submit" id="button-payment-method" data-toggle="collapse" data-parent="#checkout-page" data-target="#confirm-content">Continue</button>
                      <div class="checkbox pull-right">
                        <label>
                          <input type="checkbox"> I have read and agree to the <a title="Terms & Conditions" href="#">Terms & Conditions </a> &nbsp;&nbsp;&nbsp; 
                        </label>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT METHOD -->

              <!-- BEGIN CONFIRM -->
              <div id="confirm" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
                       <i class="fa fa-gavel"></i> Confirm Order
                    </a>
                  </h2>
                </div>
                <div id="confirm-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-12 clearfix">
                      <div class="table-wrapper-responsive">
                      <table>
                        <tr>
                          <th class="checkout-image">Image</th>
                          <th class="checkout-description">Description</th>
                          <th class="checkout-model">Model</th>
                          <th class="checkout-quantity">Quantity</th>
                          <th class="checkout-price">Price</th>
                          <th class="checkout-total">Total</th>
                        </tr>
                        <tr>
                          <td class="checkout-image">
                            <a href="#"><img src="<?php echo base_url();?>assets/user/img/p03.jpg" alt=""></a>
                          </td>
                          <td class="checkout-description">
                            <h3><a href="#">Cool green dress with red bell</a></h3>
                            <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                            <em>More info is here</em>
                          </td>
                          <td class="checkout-model">RES.193</td>
                          <td class="checkout-quantity">1</td>
                          <td class="checkout-price"><strong><span>$</span>47.00</strong></td>
                          <td class="checkout-total"><strong><span>$</span>47.00</strong></td>
                        </tr>
                        <tr>
                          <td class="checkout-image">
                            <a href="#"><img src="<?php echo base_url();?>assets/user/img/p02.jpg" alt=""></a>
                          </td>
                          <td class="checkout-description">
                            <h3><a href="#">Cool green dress with red bell</a></h3>
                            <p><strong>Item 1</strong> - Color: Green; Size: S</p>
                            <em>More info is here</em>
                          </td>
                          <td class="checkout-model">RES.193</td>
                          <td class="checkout-quantity">1</td>
                          <td class="checkout-price"><strong><span>$</span>47.00</strong></td>
                          <td class="checkout-total"><strong><span>$</span>47.00</strong></td>
                        </tr>
                      </table>
                      </div>
                      <div class="checkout-total-block">
                        <ul>
                          <li>
                            <em>Sub total</em>
                            <strong class="price"><span>$</span>47.00</strong>
                          </li>
                          <li>
                            <em>Shipping cost</em>
                            <strong class="price"><span>$</span>3.00</strong>
                          </li>
                          <li>
                            <em>Eco Tax (-2.00)</em>
                            <strong class="price"><span>$</span>3.00</strong>
                          </li>
                          <li>
                            <em>VAT (17.5%)</em>
                            <strong class="price"><span>$</span>3.00</strong>
                          </li>
                          <li class="checkout-total-price">
                            <em>Total</em>
                            <strong class="price"><span>$</span>56.00</strong>
                          </li>
                        </ul>
                      </div>
                      <div class="clearfix"></div>
                      <button class="btn btn-primary pull-right" type="submit" id="button-confirm">Confirm Order</button>
                      <button type="button" class="btn btn-default pull-right margin-right-20">Cancel</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CONFIRM -->
            </div>
            <!-- END CHECKOUT PAGE -->
          </div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php $this->load->view('user/footer');?>
</div>

<script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>-->
<script src="<?php echo base_url();?>assets/user/js/bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/user/js/css3-animate-it.js"></script>
<script src="<?php echo base_url();?>assets/user/js/jquery.simplePagination.js"></script>
<script src="<?php echo base_url();?>assets/user/js/jPages.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!--<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/user/js/jquery.dropdown.js"></script>-->
<script type="text/javascript">


$("html,body").animate({scrollTop: 0}, 1000);
	
	/*$(document).ready(function()
{
     $("html,body").animate({scrollTop: 0}, 1000);
}
*/

/*$(window).load(function()
{
     $("html,body").animate({scrollTop: 0}, 1000);
}
*/
	jQuery('.carousel').carousel({
		interval: 7000
	})
	
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");;
	});
	
/*	$(function() {
    $(selector).pagination({
        items: 10,
        itemsOnPage: 10,
        cssStyle: 'light-theme'
    });
});

$(function() {
    $(selector).pagination('prevPage');
});*/

/* when document is ready */
  $(function(){
    /* initiate the plugin */
    $("div.holder").jPages({
        containerID  : "itemContainer",
        perPage      : 9,
        startPage    : 1,
        startRange   : 1,
        midRange     : 5,
        endRange     : 1
    });
});


!function ($) {
    
    // Le left-menu sign
    /* for older jquery version
    $('#left ul.nav li.parent > a > span.sign').click(function () {
        $(this).find('i:first').toggleClass("icon-minus");
    }); */
    
    $(document).on("click","#left ul.nav li.parent > a > span.sign", function(){          
        $(this).find('i:first').toggleClass("fa-minus");      
    }); 
    
    // Open Le current menu
    $("#left ul.nav li.parent.active > a > span.sign").find('i:first').addClass("fa-minus");
    $("#left ul.nav li.current").parents('ul.children').addClass("in");

}(window.jQuery);
</script>
</body>
</html>
