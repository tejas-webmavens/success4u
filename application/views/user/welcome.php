<!DOCTYPE html>
<html>
<head>
	 <?php $this->load->view('user/meta');?>
	<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
	<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
						
		<div class="content-wrapper">
			<section class="content">
				<?php $this->load->view('user/pagelink');?>
				<?php $this->load->view('user/userinfo');?>

				<!-- //starts -->

				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo  ucwords($this->lang->line('edit')." ".$this->lang->line('profile'));?></h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="prfle">
										<div class="col-lg-12">

		                					<?php if($this->session->flashdata('error_message')) { ?>    
		                                        
		                                            <label class="label label-danger col-lg-12"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
		                                    
		                                    <?php unset($_SESSION['error_message']); } ?>
		                                    
		                                    <?php if($this->session->flashdata('success_message')) { ?>    
		                                        
		                                            <label class="label label-success col-lg-12"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
		                                     
		                                    <?php unset($_SESSION['success_message']); } ?>
										</div>
										<div class="col-md-7">
											<h2>Welcome!</h2>
											<p><a href="<?php echo base_url();?>user/dashboard">click here</a> to view your dashboard page</p>
										</div>
												
									</div>
								</div>
							</div>
							<div class="box-footer">
								<div class="row">
									<div class="col-md-12">
										<div class="dshfrom text-center">
											<!-- //<input type="button" value="update now" /> -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- //ends here -->
						
			</section>
			<div class="control-sidebar-bg"></div>
		</div>
	</div>

<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="<?php echo base_url();?>assets/user/js/plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--<script src="plugins/fastclick/fastclick.min.js"></script>-->
<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>

</body>
</html>
