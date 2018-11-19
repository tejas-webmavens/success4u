<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">
<?php
	if($this->input->get('ref'))
	{
		$checkname = $this->common_model->getreferralname($this->input->get('ref'));
		if($checkname)
		{
			$refername=$this->common_model->GetRow("UserName='".$this->input->get('ref')."'","arm_members");
			$referal=$refername->ReferralName;
			$memberdet = $this->common_model->GetRow("ReferralName='".$referal."'","arm_members");
		
			if($memberdet->ProfileImage!="")
			{
				$ProfileImg = $memberdet->ProfileImage;
			}
			else
			{
				$ProfileImg="assets/img/avatars/profile_avatar.jpg";
			}
?>

<?php if($memberdet){ ?>

			<div class="header-top clearfix">
				<div class="col-lg-12">
					<div class="bskt">
						<div class="row">
							<p><i class="fa fa-envelope-o"></i> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $memberdet->Email;?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <i class="fa fa-user"></i> &nbsp;&nbsp;&nbsp; <?php echo $memberdet->UserName;?> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<i class="fa fa-mobile"></i>&nbsp;&nbsp;&nbsp;<?php echo $memberdet->Phone;?></p>
						</div> 
					</div>
				</div>
			</div>
	<?php 		}
		}
	}
			?>
<div class="header">
	<div class="bskt clearfix">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-3">
					<div class="logo">
						<?php 
							$sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting'); 
							if($sitelogo) {
						?>
								<a href="<?php echo base_url();?>"><img style="height:49px;" src="<?php echo base_url().$sitelogo->ContentValue;?>" /></a>
						<?php } else { ?>
								<a href="<?php echo base_url();?>"><img style="height:49px;" src="<?php echo base_url();?>assets/user/img/logo.png" /></a>	
						<?php	
							}
						?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="nav-container">
						<div class="nav navbar navbar-default">
							<div class="row">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
										<span class="sr-only">Toggle navigation</span> 
										<span class="icon-bar"></span> 
										<span class="icon-bar"></span> 
										<span class="icon-bar"></span> 
									</button>
								</div>
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav">
										<?php CMSNav('header');?>
										<li class="dropdown">
											<a class="dropdown-toggle" data-toggle="dropdown" href="#">lang </a>
											<ul class="dropdown-menu">
											<?php 
												$condition= "IsDelete = '0'"; 
												$language_list = $this->common_model->GetResults($condition,'arm_language'); 
												if($language_list) { 
													foreach ($language_list as $row) { 
											?>
													<li>
														<a href="<?php echo base_url(); ?>lang/<?php echo strtolower($row->LanguageName); ?>" class="dropdown-toggle" data-toggle="dropdown-no"> <?php echo ucfirst($row->LanguageName); ?> </a>
													</li>
											<?php	
													} 
												} 
											?>
											</ul>
										</li>
									</ul>
									<!-- <ul class="nav navbar-nav">
										
										<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) { ?>
											<li><a href="<?php echo base_url();?>user/dashboard">Dashboard</a></li>
										<?php } else { ?>
											<li><a href="<?php echo base_url();?>user">home</a></li>
										<?php } ?>
										<li><a href="#">About Us</a></li>
										<li><a href="<?php echo base_url();?>user/shop">shop</a></li>
										<li><a href="#">Opportunity</a></li>
										<li><a href="#">Contact Us</a></li>
										<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_login')) { ?>
												<li><a href="<?php echo base_url();?>login/logout">Logout</a></li>
										<?php } else { ?>
												<li><a href="<?php echo base_url();?>login">Login</a></li>
										<?php } ?>
									</ul> -->
								</div>
								</div>
						</div>
					</div>
				</div>
				<div class="col-lg-1">
				<?php 
				// if(isset($this->cart->total_items()) {
					$cart_items =  ($this->cart->total_items()) ? $this->cart->total_items() :'0';
				// } else {
				// 	$cart_items = '0';
				// }
				?>
					<div class="row update_cart_value">
						<div class="cart"> 
							<a href="<?php echo base_url();?>user/viewcart" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
								<span class="cart_item_count">cart  (<?php echo $cart_items;?>) </span>
								<img src="<?php echo base_url();?>assets/user/img/cart-icon.png"  />
							</a> 
							<div class="popup_cart_window"></div>
							<ul class="dropdown-menu dropdown-cart popup_carts" role="menu">
							
				          	</ul>
				          	
						</div>
					</div>
				</div>
				<div class="col-lg-2">
				
					<div class="socl text-center">
				<?php	if($this->input->get('ref'))
					{					
						if($checkname)
						{
						$sociallinks = json_decode($memberdet->CustomFields);

					// print_r($sociallinks);
						?>
					<img class="center-block img-rounded" width="91" height="91" src="<?php echo  base_url().$ProfileImg;?>"> 
					
					<a href="<?php if(isset($sociallinks->FacebookId)){echo "http://".$sociallinks->FacebookId;}?>">f</a> 
					<a href="<?php if(isset($sociallinks->TiwtterId)){echo"http://".$sociallinks->TiwtterId;}?>">t</a> 
					<a href="<?php if(isset($sociallinks->GoogleId)){echo"http://".$sociallinks->GoogleId;}?>">g</a> 
					<a href="<?php if(isset($sociallinks->YahooId)){echo"http://".$sociallinks->YahooId;}?>">y</a> 
					<?php
						}
					}	?>
					</div>
				
				</div>
			</div>
		</div>
	</div>
</div>