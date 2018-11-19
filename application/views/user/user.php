<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php $this->load->view('user/meta');?>
		<link href="<?php echo base_url(); ?>assets/user/css/main.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/user/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url(); ?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/user/css/animations.css" type="text/css">
	</head>

<body>
	<div class="se-pre-con"></div>
	<?php $this->load->view('user/header');?>
	<div id="wrapper">
	
		<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
				  <img style="width:100%;" src="<?php echo  base_url(); ?>assets/user/img/banner.jpg">
				  <div class="carousel-caption">
				   
					<a href="<?php echo base_url(); ?>user/register" class="join">join us</a>
					<a href="<?php echo base_url(); ?>login" class="login">login</a>
				  </div>
				</div>

				<div class="item">
				  <img style="width:100%;" src="<?php echo  base_url(); ?>assets/user/img/banner.jpg">
				  <div class="carousel-caption">
				    <a href="<?php echo base_url(); ?>user/register" class="join">join us</a>
					<a href="<?php echo base_url(); ?>login" class="login">login</a>
				  </div>
				</div>

				<div class="item">
				  <img style="width:100%;" src="<?php echo  base_url(); ?>assets/user/img/banner.jpg">
				  <div class="carousel-caption">
				  	<a href="<?php echo base_url(); ?>user/register" class="join">join us</a>
					<a href="<?php echo base_url(); ?>login" class="login">login</a>
				  </div>
				</div>

				<div class="item">
				  <img style="width:100%;" src="<?php echo  base_url(); ?>assets/user/img/banner.jpg">
				  <div class="carousel-caption">
				   	<a href="<?php echo base_url(); ?>user/register" class="join">join us</a>
					<a href="<?php echo base_url(); ?>login" class="login">login</a>
				  </div>
				</div>
			</div>
		</div>
		<div class="hmabt">
			<div class="bskt">
				<div class="row">
					<?php 
						indexContent();
					?> 	
				</div>
			</div>
		</div>

	<div class="hmabt">
		<div class="bskt">
		<?php 
								
						if($content1) { 
						
		                 
					?>
<?php echo ($content1->pageContentHTML) ? urldecode($content1->pageContentHTML) : $content1->pageContent; } ?>

		</div>
	</div>
	<div class="bnfts">
				<div class="bskt">
				<?php 
								
						if($belowaboutcomp_pagecontent) { 
						
		                 
					?>
<?php echo ($belowaboutcomp_pagecontent->pageContentHTML) ? urldecode($belowaboutcomp_pagecontent->pageContentHTML) : $belowaboutcomp_pagecontent->pageContent; } ?>
						
				</div>
		</div>

	<div class="lstprdts">
		<div class="row animatedParent">
			<h2>Latest <span> Products</span></h2>
			<div class="bskt">
				<?php
					$userid = $this->session->userdata('MemberID');
					if($latest_product) {
						
						// $i = 0;
						foreach ($latest_product as $product) {

							if($product->Image) {
								$product_image = explode(',', $product->Image);
								$image = base_url().'uploads/admin/product/'.$product_image[0];
							} else {
								$image = base_url().'uploads/noimage.png';
							}
							
				?>
							<div class="col-lg-3 animated bounceInLeft slow">
								<div class="prdcts">
									<a href="<?php echo base_url();?>/user/shop/view/<?php echo $product->ProductId;?>"><img style="width:243px;height:171px;" src="<?php echo $image;?>" /></a>
									<h3><?php echo $product->ProductName;?></h3>

										<?php 
										$ratings = $this->product_model->SumProductReview($product->ProductId);
										// echo $ratings->rating;
										if($ratings->rating > 3)
											$rate_star = round($ratings->rating / 3);
										else
											$rate_star = ($ratings->rating) ? $ratings->rating : '0';
											
								    		for($i=1;$i<=$rate_star;$i++) {
								    	?>
											<i class="fa fa-star <?php echo $i;?>"></i> 
										<?php 
											} 
											for($j=$rate_star;$j<3;$j++) {
										?>
											<i class="fa fa-star-o <?php echo $j;?>"></i> 
										<?php 
											}
										?>
										<!-- <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> -->
										<h4>Price <span> <?php echo currency().number_format($product->Price,2);?> </span></h4>
										<h5><?php echo currency(); ?> <?php echo number_format($product->Price,2);?></h5>
										<?php
											$condition = "MemberId='".$userid."' AND ProductId='".$product->ProductId."'";
											$res = $this->common_model->GetRow($condition, 'arm_member_wishlist','');
											if($res) {
										?>
											<a id="fav_product_<?php echo $product->ProductId;?>" href="javascript:void(0)" onClick="unwishlist(<?php echo $product->ProductId;?>)">
												<i class="fa fa-heart"></i>
											</a>
										<?php
											} else {
										?>
											<a id="fav_product_<?php echo $product->ProductId;?>" href="javascript:void(0)" onClick="wishlist(<?php echo $product->ProductId;?>)">
												<i class="fa fa-heart-o"></i>
											</a> 
										<?php		
											}
										?>
										<!--<a id="fav_product_<?php echo $product->ProductId;?>" href="javascript:void(0)" onClick="wishlist(<?php echo $product->ProductId;?>)">
											<i class="fa fa-heart-o"></i>
										</a>--> 
										<a href="<?php echo base_url();?>user/shop/view/<?php echo $product->ProductId;?>">
											<i class="fa fa-search"></i>
										</a> 
										<a href="javascript:void(0)" onClick="addtocart(<?php echo $product->ProductId;?>)">
											<i class="fa fa-shopping-cart"></i>
										</a>
								</div>
							</div>
				<?php
						}
					}
				?>

			</div>
		</div>
	</div>
	<div class="mmbrshp">
		<div class="row">
			<h2>membership <span> with Benefits</span></h2>
				<div class="carousel slide" data-ride="carousel" id="quote-carousel">
        			<div class="carousel-inner">
        			<?php 
								
						
							$i = 0;
		
				    	?>

						<div class="item <?php if($i==0) echo 'active';?>">
				            <blockquote>
				              <div class="row">
				                <div class="col-lg-12 ">
									<div class="news text-center">
										<!-- <img class="img-circle" width="60" height="60" src="<?php echo $image;?>" alt="<?php echo $row->Subject;?>"/> -->
										<!-- <h2><?php echo $row->Subject;?></h2> -->
										<?php  if($contents) { ?>
										<div style="margin: 60px 120px;"><?php echo ($contents->pageContentHTML) ? substr(urldecode($contents->pageContentHTML),0,153) : substr($contents->pageContent,0,153); ?></div>
										<a href="<?php echo base_url();?>user/cms/membershipwithbenefits">read more</a>
										<?}else
										{?>
										<h2>perfect !!</h2>
										<div style="margin: 30px 56px;"><p>It is easy to work with MLM and it allows my business the flexibility to grow in any direction we would like</p></div>
										<a href="#">read more</a>
										<?}?>
										

									</div>
				                </div>
				              </div>
				            </blockquote>
				        </div>

					<?php 
						
						// }
								
						
					?>
          
		   	 </div>
       
           
		</div>
		</div>
	</div>




	<div class="footer-top clearfix" style="background: #fc4242;">
		<div class="col-lg-12 hr">
			<?php 	$checkname = $this->common_model->getreferralname($this->input->get('ref'));
				if($checkname)
				{
					
				$memberdet = $this->common_model->GetRow("ReferralName='".$this->input->get('ref')."'","arm_members");
				$biography = $this->common_model->GetRow("MemberId='".$memberdet->MemberId."'","arm_user_biography");
				if($biography) {
			?>
				<div class="row">
					<div class="bskt">
						<h2><?php echo ucwords($this->lang->line('biography')); ?></h2>
						<?php if($biography) echo $biography->BiographyContent;?>
					</div>
				</div>
		<?php 
				} 
			}
			?>
		</div>
	</div>

	
		
	<?php $this->load->view('user/footer'); ?>
</div>
</body>

<script src="<?php echo base_url(); ?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/user/js/bootstrap.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="<?php echo  base_url(); ?>assets/user/js/loadImg.js"></script>-->
<script src="<?php echo base_url(); ?>assets/user/js/css3-animate-it.js"></script>

<script type="text/javascript">
	jQuery('.carousel').carousel({
		interval: 7000
	});
	
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");
	});
</script>
<?php $this->load->view('user/common_script');?>

</html>
