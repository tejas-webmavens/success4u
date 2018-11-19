<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	 <?php $this->load->view('user/meta');?>
		<link href="<?php echo base_url();?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> -->
		<link href="<?php echo base_url();?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/animations.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/simplePagination.css" type="text/css">

		<style type="text/css">
			#sub
			{
				-moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    /*background: #fff none repeat scroll 0 0;*/
    border-color: #dbdbdb -moz-use-text-color #dbdbdb #dbdbdb;
    border-image: none;
    border-radius: 3px;
    border-style: solid none solid solid;
    border-width: 1px 0 1px 1px;
    box-shadow: 0 0 1px #fff;
    box-sizing: border-box;
    color: #27252a;
    display: inline-block;
    float: left;
    height: 30px;
    line-height: 30px;
    padding: 0 13px;
    text-shadow: 1px 1px 1px #fff;
			}
		#sea
		{
			background: #fff none repeat scroll 0 0;
    border: 1px solid #dbdbdb;
    border-radius: 3px;
    /*box-shadow: 0 0 1px #fff;*/
    /*box-sizing: border-box;*/
    color: #27252a;
    float: left;
    height: 30px;
    text-indent: 5px;
    text-shadow: 1px 1px 1px #fff;
    width: 156px;
		}

		</style>
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
			<div class="prodcts">
				<div class="row">
					<div class="col-lg-12">
						<div class="bskt">
						<?php  if($this->session->flashdata('error_message')){?>
					<div class="alert alert-danger alert-dismissable">
					<button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>

					<?php echo ucwords($this->session->flashdata('error_message'));?></div>
				    <?php unset($_SESSION['error_message']); } ?>
				     <?php if($this->session->flashdata('success_message')) { ?>    
				     <div class="alert alert-success alert-dismissable">
					<button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>

										                                        
				     <?php echo ucwords($this->session->flashdata('success_message'));?></div>
										                                     
				     <?php unset($_SESSION['success_message']); } ?>
							<div class="flashmessage">
							</div>
							<div class="">
								<div class="col-lg-3">
									<div class="side-nav-categories">
										<div class="block-title">Categories</div>
										<div class="box-content box-category">
											<h2>category</h2>

										
										
														<div id="left">
												<!-- <?php 
												$checkcate=$this->common_model->GetRow('CategoryId='.$key->ParentId.'',"arm_category");
												// echo $this->db->last_query();
												?>

												<h2><?php echo $checkcate->Category;?></h2> -->


												<ul id="menu-group-1" class="nav menu"> 
												<?php 
													// print_r($category);
													if($category) {
														foreach ($category as $key) {

															// print_r($category);

															
															$item_count = $this->shop_model->GetProductsTotal($key->CategoryId);
															// echo "<br>".$this->db->last_query();
															if($item_count>0) {


												             ?>


												  <li class="item-1 deeper parent active">
									                    <a class="" href="<?php echo base_url().'user/shop/category/'.$key->CategoryId;?>">
									                        <span data-toggle="collapse"  href="#sub-item-<?php echo $key->CategoryId;?>" class="sign"><i class="fa fa-plus"></i></span>
									                        <span class="lbl"><?php echo $key->Category.' ('.$item_count.')';?></span>                      
									                    </a>
                                 			  <ul class="children nav-child unstyled small collapse" id="sub-item-<?php echo $key->CategoryId;?>">

												<?php
									                // }
															$condition="Status=1";
															$countproduct=$this->common_model->GetRowCount($condition,"arm_product");
															// for ($i=1; $i <=$countproduct ; $i++) { 
															// $i=$i;
															// }
									                    	$subcategory1 = $this->shop_model->Getproduct($key->CategoryId);
									                    	// echo "<br>".$this->db->last_query();
									                    	if($subcategory1) {
									                    	foreach ($subcategory1 as $sub_cat1) {


									                    ?>								                    
									                        <li class="item-2 deeper parent">
									                           
									                            <a class="" href="<?php echo base_url().'user/shop/getproduct/'.$sub_cat1->ProductId;?>">

									                                <span data-toggle="collapse"  href="#sub-item-<?php echo $sub_cat1->ProductId;?>" class="sign">
									                            <!--     <?php
									                                $checkproductid=$this->common_model->GetRow("")
									                                ?> -->
									                                <i class="fa fa-plus"></i></span>
									                                <span class="lbl"><?php echo $sub_cat1->ProductName;?></span> 
									                            </a>
									                            <ul class="children nav-child unstyled small collapse" id="sub-item-<?php echo $sub_cat1->CatId;?>">
									                            <?php
											                    	$subcategory2 = $this->shop_model->Getproduct($sub_cat1->CatId);
											                    	if($subcategory2) {
											                    	foreach ($subcategory2 as $sub_cat2) {
											                    ?>
									                                <li class="item-3 current">
									                                    <a class="" href="<?php echo base_url().'user/shop/getproduct/'.$sub_cat2->ProductId;?>">
									                                        <span class="sign"><i class="fa fa-play "></i></span>
									                                         <?php echo $sub_cat2->ProductName;?>
									                                    </a>
									                                </li>
									                            <?php }  } ?>
									                            </ul>
									                        </li>
									                    <?php }  } ?>
									                    </ul>
									                </li>
									                <?php 
															}

														}
													}
												// }
													?>
									            </ul>

									        </div>

											<!-- <ul>
											<?php 
											
											if($category) {
												foreach ($category as $key => $value) {
													$cat_name = $this->shop_model->GetCategoryName($key);
													$categoryname = $cat_name->Category;
													$item_count = $this->shop_model->GetProductsTotal($key);
													if($item_count>0) {
											?>
													<li><a href="<?php echo base_url();?>user/shop/category/<?php echo $key;?>"><i class="fa fa-check"></i> <?php echo $cat_name->Category.' ('.$item_count.')';?></a></li>
											<?php 
													}

												}
											}
											?>
											</ul> -->
											
											
										</div>
									</div>
								</div>
								<div class="col-lg-9 text-center">
								
							

									<?php if(isset($category_image)) { ?>
							    	<img style="width: 700px; height: 150px;" src="<?php echo $category_image;?>">
							    	<?php } ?>  		

							    	
							    	<div class="pagnatn clearfix">

										<div class="row">
											<div class="col-lg-4">
											 <!-- <form action="#"  method="post">  -->
												<input type="text" placeholder="search" class="" id="sea"/><input type="button" id="sub" value="" class="search" name="search"  />
												<!-- </form> -->
											
											</div>
										</div>
							    		<div id="result">


										<div class="dt"></div>
										<div class="holder"> </div>
										<?php //print_r($products);?>
										<ul id="itemContainer">
										<?php 
											if($products) {
											foreach ($products as $row) {
												if($row->Image) {
													$product_image = explode(',', $row->Image);
													// print_r($product_image);
													
													$pimage1 = base_url().'uploads/admin/product/'.$product_image[0];
													if(isset($product_image[1])!="")
														$pimage2 = base_url().'uploads/admin/product/'.$product_image[1];
													else
														$pimage2 = base_url().'uploads/admin/product/'.$product_image[0];
													
													//$pimage2 = base_url().'uploads/admin/product/'.($product_image[1]) ? $product_image[1] : '' ;
												} else {
													$pimage1 = base_url().'uploads/noimage.png';
													$pimage2 = base_url().'uploads/noimage.png';
													$pimage3 = base_url().'uploads/noimage.png';
												}

										?>
										
											<li>
												<div class="col-lg-4">
													<div class="prdtlst clearfix">
														<div class="col-lg-12 text-center">
															<div class="row"><img class="img-responsive" style="width: 254px; height: 174px;" src="<?php echo $pimage1;?>" class="img-responsive" />
																<div class="mask">
																	<a href="" class="" data-toggle="modal" data-target="#myModal_<?php echo $row->ProductId;?>"><i class="fa fa-search"></i></a>
																</div>
																<div id="myModal_<?php echo $row->ProductId;?>" class="modal fade" role="dialog">
																	<div class="modal-dialog modal-sm"> 
																		<img src="<?php echo $pimage2;?>" class="img-responsive"/> 
																	</div>
																</div>
															</div>
														</div>
														<a href="javascript:void(0)" onClick="addtocart(<?php echo $row->ProductId;?>)" class="col-xs-6 cart"> Add to cart <br />
															<img src="<?php echo base_url();?>assets/user/img/cart.png" class="mn"/> 
														</a> 
															  <?php
															     $userid=$this->session->ReferralName;
															     if($userid)
															     {
															     	$referal=$userid;
															     	// echo $referal;

															     	?>

															     	<a href="<?php echo base_url();?>user/shop/views/<?php echo $row->ProductId;?>/<?php echo $referal;?>" class="col-xs-6 cart"> view <br />
															<img src="<?php echo base_url();?>assets/user/img/viewcart.png" class="shke"/> 
														</a>
															     <?}
															     else
															     {?>
															     	<a href="<?php echo base_url();?>user/shop/view/<?php echo $row->ProductId;?>" class="col-xs-6 cart"> view <br />
															<img src="<?php echo base_url();?>assets/user/img/viewcart.png" class="shke"/> 
														</a>

															    <? }

				    										 ?>
														<h2 class="text-center">
															<span><?php echo currency().number_format($row->Price,2);?></span>
														</h2>
													</div>
												</div>
											</li>
										

										<?php		
											}
										} else {
										?>
											<li>
												<div class="col-lg-4">
													<div class="prdtlst clearfix">
														<div class="col-lg-12 text-center">
															<div class="row">
																<p> No products available</p>
															</div>
														</div>
													</div>
												</div>
											</li>
										<?php } ?>
										</ul>
										<div class="clearfix"></div>
										<div class="holder"> </div>
										<div class="dt"></div>
										</div>

									</div>
							  	</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div id="testing_content">
			</div>
			<div class="clearfix"></div>
			<?php $this->load->view('user/footer');?>
		</div>
	</body>
	<script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/user/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/user/js/css3-animate-it.js"></script>
	
	<script src="<?php echo base_url();?>assets/user/js/jPages.js"></script>
	<script type="text/javascript">
		jQuery('.carousel').carousel({
			interval: 7000
		})
		
		$(window).load(function() {
			$(".se-pre-con").fadeOut("slow");;
		});
		

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
	    // $(".popup_carts").load("<?php echo base_url();?>user/shop/info");
	});
	// function addtocart(id) {

	//   	$.ajax({
	// 		url: '<?php echo base_url();?>user/shop/addcart',
	// 		type: 'post',
	// 		data: 'ProductId=' + id,
	// 		beforeSend: function() {
	// 			$('#button-coupo1n').button('loading');
	// 		},
	// 		complete: function() {
	// 			$('#button-coupo1n').button('reset');
	// 		},
	// 		success: function(json) {

	// 			if(json['success']) {

	// 				$('.cart_item_count').html('cart('+json['totalitems']+')');
	// 				$(".popup_carts").load("<?php echo base_url();?>user/shop/info");

	// 				$('.flashmessage').html('<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');

	// 				$('html, body').animate({ scrollTop: 0 }, 'slow');
	// 			}

	// 			if (json['error']) {
	// 				$('.flashmessage').html('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' + json['error'] + '</div>');

	// 				$('html, body').animate({ scrollTop: 0 }, 'slow');
	// 			}
	// 			// $('html, body').animate({ scrollTop: 0 }, 'slow');
				
	// 		}
	// 	});

	//  }

	</script>

	<?php $this->load->view('user/common_script');?>

		<script>
	// function search()
	// {
		// alert('hi');
		$(document).ready(function(){
		$("input").keypress(function(){
				
			var search=$('#sub').val();

	       	var item = $("input").val();
	       	if(item!="")
	       	{
	       	var url ='<?php echo base_url();?>user/shop/searchproduct/' +item;

	       	}
	       	else
	       	{
	       	var url ='<?php echo base_url();?>user/shop/search';

	       	}
	      
	        $.ajax({
	            url: url,
	            type: 'post',
	            dataType: 'html', 
	             success: function(html) {
	             	$('#result').html(html);
	            	// var returnurl='<?php echo base_url();?>user/shop';
	              
	            }
	           
	        });
		});

  		
       
    });

	// }

</script>
</html>
