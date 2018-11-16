<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ARMCIP</title>
		<link href="<?php echo base_url();?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href="fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
		<link href="fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/animations.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/simplePagination.css" type="text/css">
	</head>
	<body><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
		<div class="se-pre-con"></div>
		<div id="wrapper">
			<?php $this->load->view('user/header');?>

			<div class="clearfix"></div>
			<div class="shtbnr clearfix">
				<div class="col-lg-12">
					<div class="row">
						<div class="bskt">
							<h1>Success</h1>
							<p>Your order has been success.</p>
						</div>
					</div>
				</div>						
			</div>

			<div class="clearfix"></div>
			<div class="chckot">
				
				<div class="row">
					<div class="col-lg-12">
						<div class="bskt">
							
							<h2>Order <span>success</span></h2>
							<div class="chkng">
								<div class="row">
									<div class="col-lg-12">
										<?php 
											if(isset($message)) {
										?>
												<div class="table-responsive">
													<p><?php echo $message;?></p>
													<?php 
														if(isset($address)) {
															$qr_url = "https://blockchain.info/qr?data=$address&size=200";
													?>
														<h3><strong><?php echo $address;?></strong></h3>
															<img src="<?php echo $qr_url;?>"/>
													<?php
														}
													?>
													
												</div>
										<?php
											} else {
										?>
												<div class="table-responsive">
													<p>Your Order successfully processed</p>
													<p>continue shopping <a href="<?php echo base_url();?>user/shop">click here</a></p>
												</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
				<?php $this->load->view('user/footer');?>
		</div>
	</body>
	<script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/user/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/user/js/css3-animate-it.js"></script>
	<script type="text/javascript">
		jQuery('.carousel').carousel({
			interval: 7000
		})
		
		$(window).load(function() {
			$(".se-pre-con").fadeOut("slow");;
		});
		
		

		function addCommas(nStr) {
		    nStr += '';
		    x = nStr.split('.');
		    x1 = x[0];
		    x2 = x.length > 1 ? '.' + x[1] : '';
		    var rgx = /(\d+)(\d{3})/;
		    while (rgx.test(x1)) {
		        x1 = x1.replace(rgx, '$1' + ',' + '$2');
		    }
		    return x1 + x2;
		}
		
	</script>
	<?php $this->load->view('user/common_script');?>
	<script type="text/javascript">
	$(function(){
	    $(".cart_item_count").html('cart  (0) ');
	});
	</script>
</html>
