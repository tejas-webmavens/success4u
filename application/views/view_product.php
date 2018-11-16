<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		 <?php $this->load->view('user/meta');?>
		<link href="<?php echo base_url();?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url();?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
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
							<h1>Product Page</h1>
							
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="prdtdesc">

				<div class="row">
					<div class="col-lg-12">
						<div class="bskt">
							<div class="flashmessage"> </div>
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-4 col-xs-4">
										<div class="bzoom_wrap">
											<div class="row">
												<div class="col-lg-12">
													<ul id="bzoom">
													<?php
														
														$product_image = explode(',', $product->Image);
														
 														foreach($product_image as $key => $value) {
 															
													?>
														<li>
															<img class="bzoom_thumb_image" src="<?php echo base_url().'uploads/admin/product/'.$value;?>" />
															<img class="bzoom_big_image" src="<?php echo base_url().'uploads/admin/product/'.$value;?>"/>
														</li>
													<?php		
														}
													?>
														
													</ul>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>	
									</div>
									<div class="col-lg-8 col-xs-12">
										<div class="prd-ovrvew">
											<h2><?php echo $product->ProductName;?></h2>
											<hr class="hrzntl" />
											<i class="fa fa-star str1"></i> <i class="fa fa-star str2"></i> <i class="fa fa-star str3"></i> <i class="fa fa-star str4"></i> <i class="fa fa-star str5"></i> <i><span> 0 reviews / Write a review</span></i>
											<hr class="hrzntl" />
											<h3>$ <?php echo $product->Price;?> <i>special price</i></h3>
											<hr class="hrzntl" />
											<p>Ex Tax: $50.00</p>
											<p>Product Code: product code here</p>
											<hr class="hrzntl" />
											<p>qty
												<input type="button" onclick="decrementValue()" value="-" />
												<input type="text" name="quantity" class="quantity" value="1" maxlength="2" max="10" size="1" id="number" />
												<input type="button" onclick="incrementValue()" value="+" />
											</p>
											<hr class="hrzntl" />
											<a href="javascript:void(0)" onClick="addtocart(<?php echo $product->ProductId;?>)">Add to cart</a>
											<div class="social">
												<a href="" class="rtte">f</a> 
												<a href="" class="rtte">g</a> 
												<a href="" class="rtte">h</a> 
												<a href="" class="rtte">t</a> 
												<a href="" class="rtte">y</a> 
												<a href="" class="rtte">p</a>
											</div>
										</div>
									</div>
														
								</div>
							</div>

							<div class="col-lg-12">
								<div class="panel">
									<div class=""> 
										<span class="">
											<!-- Tabs -->
											<ul class="nav panel-tabs">
												<li class="active"><a href="#tab1" data-toggle="tab"> Description</a></li>
												<li><a href="#tab2" data-toggle="tab"> Attributes</a></li>
												<li><a href="#tab3" data-toggle="tab"> Reviews (0)</a></li>
												<!-- <li><a href="#tab4" data-toggle="tab"> Custom Tab </a></li> -->
												<!-- <li><a href="#tab4" data-toggle="tab"> Custom Tab </a></li> -->
											</ul>
										</span> 
									</div>
									<div class="panel-body">
										<div class="tab-content">
											<div class="tab-pane active" id="tab1">
												<h2><?php echo $product->ProductName;?></h2>
												<?php echo html_entity_decode($product->Description);?>
											</div>
											<?php $attributes = json_decode($product->Attributes);?>
											<div class="tab-pane" id="tab2">
												<ul>
												<?php 
													if($attributes) {
														foreach ($attributes as $key => $value) {
												?>
															<li><?php echo "<b>".ucfirst($key).":</b> ".$value;?></li>
												<?php		
														}

													} else {

												?>
														<li class="text-center">No Attributes found</li>
													<?php } ?>
												</ul>
											</div>
											<div class="tab-pane" id="tab3">
												<ul>
													<form id="form-review" class="form-horizontal">
										                <div id="review">
										                	
														</div>
										                <h2>Write a review</h2>
									                    <div class="form-group required">
											                <div class="col-sm-12">
											                    <label for="input-name" class="control-label">Your Name</label>
											                    <input type="text" class="form-control" id="input-name" value="" name="name">
											                </div>
									                	</div>
										                <div class="form-group required">
										                	<div class="col-sm-12">
											                    <label for="input-review" class="control-label">Your Review</label>
											                    <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
											                    <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
										                  	</div>
										                </div>
										                <div class="form-group required">
										                  	<div class="col-sm-12">
											                    <label class="control-label">Rating</label>
											                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
											                    <input type="radio" value="1" name="rating">
											                    &nbsp;
											                    <input type="radio" value="2" name="rating">
											                    &nbsp;
											                    <input type="radio" value="3" name="rating">
											                    &nbsp;
											                    <input type="radio" value="4" name="rating">
											                    &nbsp;
											                    <input type="radio" value="5" name="rating">
											                    &nbsp;Good
											                </div>
										                </div>
										                <input type="hidden" name="ProductId" value="<?php echo $product->ProductId;?>"/>
									                    <div class="buttons clearfix">
										                  	<div class="pull-right">
										                    	<button class="btn btn-primary" data-loading-text="Loading..." id="button-review" type="button">Continue</button>
										                  	</div>
									                	</div>
										            </form>
												</ul>
											</div>
											<!-- <div class="tab-pane" id="tab4"></div> -->
											<!-- <div class="tab-pane" id="tab5"></div> -->
										</div>
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
<script src="<?php echo base_url();?>assets/user/js/jquery.simplePagination.js"></script>
<script src="<?php echo base_url();?>assets/user/js/jPages.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>assets/user/js/jqzoom.js"></script>
<script type="text/javascript">
$("#bzoom").zoom({
	zoom_area_width: 300,
    autoplay_interval :3000,
    small_thumbs : 3,
    autoplay : true
});
</script>

<script type="text/javascript">
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



</script>
<script type="text/javascript">
function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10){
        value++;
            document.getElementById('number').value = value;
    }
}
function decrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1){
        value--;
            document.getElementById('number').value = value;
    }

}
// function addtocart(id) {

// 	  	$.ajax({
// 			url: '<?php echo base_url();?>user/shop/addcart',
// 			type: 'post',
// 			data: 'ProductId=' + id,
// 			dataType: 'json',
// 			beforeSend: function() {
// 				$('#button-coupo1n').button('loading');
// 			},
// 			complete: function() {
// 				$('#button-coupo1n').button('reset');
// 			},
// 			success: function(json) {
// 				$('.alert').remove();

// 				if (json['error']) {
// 					$('.bskt').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

// 					$('html, body').animate({ scrollTop: 0 }, 'slow');
// 				}
// 				$('html, body').animate({ scrollTop: 0 }, 'slow');
// 				if (json['redirect']) {
// 					location = json['redirect'];
// 				}
// 			}
// 		});

// 	 }

$('#review').load('<?php echo base_url();?>user/shop/viewreview/<?php echo $product->ProductId;?>');

$('#button-review').on('click', function() {
	$.ajax({
		url: '<?php echo base_url();?>user/shop/review',
		type: 'post',
		dataType: 'json',
		data: $("#form-review").serialize(),
		beforeSend: function() {
			$('#button-review').button('loading');
		},
		complete: function() {
			$('#button-review').button('reset');
		},
		success: function(json) {
			$('.alert-success, .alert-danger').remove();

			if (json['error']) {
				$('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
			}

			if (json['success']) {
				$('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').prop('checked', false);
			}
		}
	});
});
</script>
<?php $this->load->view('user/common_script');?>
</html>
