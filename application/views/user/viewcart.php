<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		 <?php $this->load->view('user/meta');?>
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
							<h1>Success Stories</h1>
							
						</div>
					</div>
				</div>						
			</div>

			<div class="clearfix"></div>
			<div class="chckot">


				<!-- <div class="row">
                    <?php if($this->session->flashdata('error_message')) { ?>    
                        <div class="col-md-12 bg-danger pt10 pb10 ">
                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                        </div>
                    <?php } ?>
                    
                    <?php if($this->session->flashdata('success_message')) { ?>    
                        <div class="col-md-12 bg-success pt10 pb10 ">
                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                        </div>
                    <?php } ?>
                </div> -->
				<div class="row">
					<div class="col-lg-12">
						<div class="bskt">
							<div class="flashmessage"> </div>
							<h2>check<span>out</span></h2>
							<div class="chkng">
								<div class="row">
									<div class="col-lg-12">
										<div class="table-responsive">
										<form method="post" action="<?php echo base_url();?>user/shop/updatecart" class="cart_form">
											<table class="table">
												<thead>
													<tr>
														<th>Product image</th>
														<th>Product Name</th>
														<th>Quantity</th>
														<th>Unit Price</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
												<?php 
													$i = 1;
													foreach ($this->cart->contents() as $items) {
														$id = str_replace('CIP_', '', $items['id']);
														$product = $this->product_model->GetProduct($id);
														$descrip=$product->Description;
														if($product->Image) {
															$product_image = explode(',', $product->Image);
															$pimage1 = base_url().'uploads/admin/product/'.$product_image[0];
															$pimage2 = base_url().'uploads/admin/product/'.$product_image[1];
														} else {
															$pimage1 = base_url().'uploads/noimage.png';
															$pimage2 = base_url().'uploads/noimage.png';
														}
												?>
													<input type="hidden" name="<?php echo $i;?>[rowid]" value="<?php echo $items['rowid'];?>">
													<tr>
														<td><img class="" style="width: 100px; height: 70px;" src="<?php echo $pimage1;?>" /></td>
														<td><?php echo $items['name']; ?></td>
														<td>
															<div class="<?php echo "out_of_stock_".$items['rowid'];?>">
																<?php if($this->session->flashdata("out_of_stock_".$items['rowid'])) { ?>    
											                        <div class="col-md-12 bg-danger pt10 pb10 ">
											                            <span class=""><?php echo $this->session->flashdata("out_of_stock_".$items['rowid']);?></span>
											                        </div>
											                    <?php } ?>
															</div>
															<input type="hidden" class="id" name="<?php echo $i;?>[item]" value="<?php echo $id;?>" />
															<input type="text" class="qty" name="<?php echo $i;?>[qty]" value="<?php echo $items['qty'];?>" />
															<a href="javascript:void(0)" class="update_cart"><img src="<?php echo base_url();?>assets/user/img/refresh.jpg" /></a> 
															<a href="javascript:void(0)" class="remove_cart" onclick="RemoveCart('<?php echo $items['rowid'];?>')"> <img src="<?php echo base_url();?>assets/user/img/del.jpg" /></a> </td>
														<td><?php echo $this->cart->format_number($items['price']); ?></td>
														<td><?php echo currency().$this->cart->format_number($items['subtotal']); ?></td>
													</tr>	
												<?php
													$i++;
													}
												?>
												</tbody>
											</table>
											<?php
												if($this->session->userdata('cart_discount') && $this->cart->total_items() > 0) {
													$cart_discount_data = $this->session->userdata('cart_discount');
													$dicount = $cart_discount_data['discount'];
													$grand_total = $this->cart->total() - $dicount;
													$coupon_code = $cart_discount_data['discount'];
												} else {
													$dicount = '0.00';
													$grand_total = $this->cart->total() - $dicount;
												}
												
											?>
											<input type="hidden" class="cart_totals" value="<?php echo $this->cart->format_number($this->cart->total()); ?>">
											<input type="hidden" class="discount_totals" value="<?php echo $dicount;?>">
											<!-- <input type="hidden" class="tax_totals" value="0.00"> -->
											</form>
										</div>
										<div class="col-lg-9">
										<p><?php 
										echo substr($descrip, 0,118);?></p>
										
										</div>
										<div class="col-lg-3">
											<div class="subttl"> subtotal
												<input style="cursor: context-menu;" type="text" readonly="" value="<?php echo currency().$this->cart->format_number($this->cart->total()); ?>"/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="chkng">
									<div class="prmtncde">
										<h3>promotion code</h3>
										
										<h4>enter your promo code if you have one</h4>
										<input type="text" name="coupon"/>
										<a href="javascript:void(0)" id="button-coupon">apply shopping</a> 
									</div>
								</div>
							</div>
							<!-- <div class="col-lg-4">
								<div class="chkng">
									<div class="prmtncde">
										<h3>promotion code</h3>
										<p>Enter your destination to get a shipping estimate.</p>
										<select>
											<option>1</option>
										</select>
										<select>
											<option>1</option>
										</select>
										<a href="">apply shopping</a> 
									</div>
								</div>
							</div> -->
							<div class="col-lg-6">
								<div class="chkng">
									<div class="prmtncde">
									
										<ul>
											<li>total <span class="cart_total"><?php echo currency().$this->cart->format_number($this->cart->total()); ?></span> </li>
											<li> discount <span class="discount_coupon"> <?php echo currency().$dicount;?> </span> </li>
											<!-- <li> shipping & taxes <span class="shipping_tax">$0.00</span> </li> -->
											<hr class="hrzntl1"/>
											<li> <strong>grand total </strong> <span class="grand_total"><?php echo currency().$this->cart->format_number($grand_total); ?></span> </li>
										</ul>
										<div class="prcess"> check out with multiple address <a href="<?php echo base_url();?>user/checkout"> <i class="fa fa-arrow"></i> proceed to  checkout</a> </div>
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
		$('.update_cart').click(function(){
			$('.cart_form').submit();
		})
		

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

		$('#button-coupon').on('click', function() {
			$.ajax({
				url: '<?php echo base_url();?>user/viewcart/coupon',
				type: 'post',
				data: 'coupon=' + encodeURIComponent($('input[name=\'coupon\']').val()),
				dataType: 'json',
				beforeSend: function() {
					$('#button-coupon').button('loading');
				},
				complete: function() {
					$('#button-coupon').button('reset');
				},
				success: function(json) {

					if (json['Success']) {
						$('.discount_coupon').html('$'+json['Total']);
						$('.discount_totals').val(json['Total']);
						var discount = json['Total'];
						$('.flashmessage').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['Success'] + '</div>');

						$('html, body').animate({ scrollTop: 0 }, 'slow');	
					}

					if (json['error']) {
						$('.discount_totals').val('0.00');
						var discount = '0.00';
						$('.flashmessage').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');
						$('.discount_coupon').html('$0.00');

						$('html, body').animate({ scrollTop: 0 }, 'slow');
					}

					var tax = $('.tax_totals').val();
						
					var subtotal = Number($('.cart_totals').val().replace(/[^0-9\.]+/g,""));
					
					
					var grandtotal1 = parseFloat(subtotal) + parseFloat(tax);
					
					var grandtotal = parseFloat(parseFloat(grandtotal1) - parseFloat(discount)).toFixed(2);

					var grandtotal2 = addCommas(grandtotal);
					
					$('.grand_total').html('$'+grandtotal2);

					$('#button-coupon').button('reset');
					
					// $('html, body').animate({ scrollTop: 0 }, 'slow');
					// if (json['redirect']) {
					// 	location = json['redirect'];
					// }
				}
			});
		});
		
		
	</script>
	<?php $this->load->view('user/common_script');?>
</html>
