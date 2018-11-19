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
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/animations.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
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
							<h1>Testimonials</h1>
							
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="prodcts">
				<div class="row">
					<div class="col-lg-12">
						<div class="bskt">
							<br />
							<ul class="timeline">

							<?php
							
								if($testimonial) { 
									$i = 0;
									foreach ($testimonial as $row) {
										$member = $this->common_model->GetCustomer($row->MemberId);
										//if($member) {
											
											if($row->UserLogo) {

                                                $image = base_url().'uploads/testimonial/'.$row->UserLogo;

                                            } else {

                                                if($row->ProfileImage)
                                                    $image = base_url().'uploads/UserProfileImage/'.$row->ProfileImage;
                                                else 
                                                    $image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';
                                            }
							?>
											<li class="time-label">
							                  <span class="bg-red">
							                  <?php echo date('d M Y', strtotime($row->DateAdded));?>
							                  </span>
							                </li>
							                <li>
							                  	<img class="img-circle" width="60" height="60" src="<?php echo $image;?>"  width="60"/>
							                  	<div class="timeline-item">
							                    	<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('H:i', strtotime($row->DateAdded));?></span>
							                    	<h3 class="timeline-header"><a href="#"><?php echo isset($member->UserName) ? $member->UserName : '';?></a> <?php echo $row->Subject;?></h3>
							                    	<div class="timeline-body">
								                      <?php echo urldecode($row->Message);?>
								                    </div>
								                   
							                  	</div>
							                </li>

							<?php
										//}
									}
								} else {
							?>
				                <li>
				                  <i class="fa fa-clock-o bg-gray"></i>
				                </li>
				                <li>
				                  	<div class="timeline-item">
				                    	<div class="timeline-body text-center">
					                      <?php echo "No Records Found";?>
					                    </div>
					                   
				                  	</div>
				                </li>
				                <?php } ?>
				            </ul>
              				<br />
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

	</script>
	<?php $this->load->view('user/common_script');?>
</html>
