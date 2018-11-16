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
				            <h2> <?php echo $this->lang->line('page_title');?> <i class="fa fa-bank text-gray" style="font-size:1em"></i></h2>
				             
 							<!-- BEGIN CHECKOUT PAGE -->
					            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

					              <!-- BEGIN CHECKOUT -->
					              <div id="checkout" class="panel panel-default">
					                <div class="panel-heading">
					                  <h2 class="panel-title">
					                    <a class="accordion-toggle">
					                      <i class="fa fa-bank"></i> <?php echo $this->lang->line('label_checkout_option');?>
					                    </a>
					                  </h2>
					                </div>
					                
					              </div>
					              <!-- END CHECKOUT -->

					              <!-- BEGIN PAYMENT ADDRESS -->
					              <div id="payment-address" class="panel panel-default">
					                <div class="panel-heading">
					                  <h2 class="panel-title">
					                    <a class="accordion-toggle">
					                      <i class="fa fa-print"></i> <?php echo $this->lang->line('label_checkout_option');?>Account &amp; Billing Details
					                    </a>
					                  </h2>
					                </div>
					                
					              </div>
					              <!-- END PAYMENT ADDRESS -->

					              <!-- BEGIN SHIPPING ADDRESS -->
					              <!-- <div id="shipping-address" class="panel panel-default">
					                <div class="panel-heading">
					                  <h2 class="panel-title">
					                    <a class="accordion-toggle">
					                     <i class="fa fa-code "></i> Delivery Details
					                    </a>
					                  </h2>
					                </div>
					                
					              </div> -->
					              <!-- END SHIPPING ADDRESS -->

					              <!-- BEGIN SHIPPING METHOD -->
					              <div id="shipping-method" class="panel panel-default">
					                <div class="panel-heading">
					                  <h2 class="panel-title">
					                    <a class="accordion-toggle">
					                       <i class="fa fa-truck"></i> <?php echo $this->lang->line('label_shippin_method');?>
					                    </a>
					                  </h2>
					                </div>
					                
					              </div>
					              <!-- END SHIPPING METHOD -->

					              <!-- BEGIN PAYMENT METHOD -->
					              <div id="payment-method" class="panel panel-default">
					                <div class="panel-heading">
					                  <h2 class="panel-title">
					                    <a class="accordion-toggle">
					                       <i class="fa fa-dollar"></i> <?php echo $this->lang->line('label_payment_method');?>
					                    </a>
					                  </h2>
					                </div>
					                
					              </div>
					              <!-- END PAYMENT METHOD -->

					              <!-- BEGIN CONFIRM -->
					              <div id="confirm" class="panel panel-default">
					                <div class="panel-heading">
					                  <h2 class="panel-title">
					                    <a class="accordion-toggle">
					                       <i class="fa fa-gavel"></i> <?php echo $this->lang->line('label_confirm_order');?>
					                    </a>
					                  </h2>
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

<script src="<?php echo base_url();?>assets/user/js/jPages.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript">
<?php  
// if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) {
if($this->session->userdata('logged_in')) { ?>
	$(document).ready(function() {

    $.ajax({
        url: 'checkout/payment_address',
        dataType: 'html',
        success: function(html) {
            $('#payment-address .panel-heading').after(html);

			$('#payment-address-content').parent().find('.panel-heading .panel-title').html('<a href="#payment-address-content" data-toggle="collapse" data-parent="#checkout-page" class="accordion-toggle"> <i class="fa fa-truck"></i> Billing Details </a>');

			$('a[href=\'#payment-address\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
<?php } else { ?>

$(document).ready(function() {
    $.ajax({
        url: 'checkout/login',
        dataType: 'html',
        success: function(html) {

            $('#checkout .panel-heading').after(html);
            $('#checkout-content').parent().find('.panel-heading .panel-title').html('<a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content" class="accordion-toggle"> <i class="fa fa-bank"></i> Checkout Options </a>');
			$('a[href=\'#checkout\']').trigger('click');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

<?php } ?>
</script>
<script src="<?php echo base_url();?>assets/user/js/checkout.js"></script>
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

<?php $this->load->view('user/common_script');?>
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
</body>
</html>
