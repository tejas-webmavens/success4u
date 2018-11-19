<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
	<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
		
		<div class="content-wrapper">
			<section class="content">
					
				<div class="box">
					<div class="box-body">
						<section class="content-header">
							<ol class="breadcrumb">
								<li><a href="#"> <i class="fa fa-dashboard"></i> DASHBOARD</a></li>
								<li><a href="#"> <i class="fa fa-database"></i> INNER PAGE</a></li>
								<li class="active"> <i class="fa fa-dedent"></i> INNER INNER PAGE</li>
							</ol>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="row">
								<div class="small-box bg-aqua">
									<div class="inner">
										<div class="icon"> <i class="fa fa-bank"></i> </div>
										<h3>6549</h3>
										<p>Balance Info</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="row">
								<div class="small-box bg-aqua">
									<div class="inner">
										<div class="icon"> <i class="fa fa-globe"></i> </div>
										<h3>6549</h3>
										<p>New Orders</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="row">
								<div class="small-box bg-aqua">
									<div class="inner">
										<div class="icon"> <i class="fa fa-group"></i> </div>
										<h3>6549</h3>
										<p>New Orders</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<div class="row">
								<div class="small-box bg-aqua">
									<div class="inner">
										<div class="icon"> <i class="fa fa-plane"></i> </div>
										<h3>6549</h3>
										<p>New Orders</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php //print_r($users);?>
				<div class="section row mb20">
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
                </div>
				<div class="row">
					<div class="col-lg-12">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Testimonials</h3>
								<div class="box-tools pull-right">
									<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
									<button data-widget="remove" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								
								<!-- <div class="user-panel">
									<div class="image"> <img class="img-responsive" src="http://192.168.2.13/saravanan/armcip/assets/user/img/usr.png"> </div>
									<div class="text-center info">
										<p>Angellina <br>
												general</p>
									</div>
								</div> -->
								<?php 
								
									if($testimonial) { 

										foreach ($testimonial as $row) {
								?>
								
								<div class="user-panel">
									<div class="image"> <img class="img-responsive" src="<?php echo base_url().''.$row->UserLogo;?>"> </div>
									<div class="text-center">
										<p class="nme-hdbg"><?php echo $row->Subject;?></p>
										<p><?php echo urldecode($row->Message);?> </p>
										<input type="file" multiple="" data-multiple-caption="{count} files selected" class="inputfile" id="file" name="file">
										<label for="file"><strong>Browse</strong></label>
									</div>
								</div>
								<?php 
										}
											
									}
								?>
							</div>
						</div>
		            </div>
              	</div>
             </section>
		</div>
		<div class="control-sidebar-bg"></div>
	</div>
<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="<?php echo base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">
	function tellusFunc() {
		if ($('#tellus-forms').valid()) {
			if($('#inputName1').val()!=='')
			{
				$('#tellus-forms').submit();
			}
		}
	}
</script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>

<script type="text/javascript">

(function($) {

    $(document).ready(function() {


        $("#tellus-forms").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                inputName: {
                    required: true,
                    email: true
                },
                inputName2: {
                    email: true
                }
                
            },

            // error message
            messages: {
                inputName1: {
                    required: 'Please enter Email',
                    email: 'Enter a VALID email address'
                },
                inputName2: {
                    email: 'Enter a VALID email address'
                }

            },


            highlight: function(element, errorClass, validClass) {
                $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                if (element.is(":radio") || element.is(":checkbox")) {
                    element.closest('.option-group').after(error);
                } else {
                    error.insertAfter(element.parent());
                }
            }
           
        });

    });

})(jQuery);

</script>

</body>
</html>
