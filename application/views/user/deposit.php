
<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
<!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> -->
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
		
						
		<div class="content-wrapper">
				<section class="content">
						<!-- <section class="content-header">
								<ol class="breadcrumb">
										<li><a href="<?php echo  base_url().'user';?>"> <i class="fa fa-dashboard"></i> DASHBOARD</a></li>
										<li><a href="#"> <i class="fa fa-database"></i> INNER PAGE</a></li>
										<li class="active"> <i class="fa fa-dedent"></i> INNER INNER PAGE</li>
								</ol>
						</section> -->
						<?php $this->load->view('user/pagelink');?>
						<?php $this->load->view('user/userinfo');?>

						<!-- //starts -->

						<div class="row">
								<div class="col-md-12">
										<div class="box">
												<div class="box-header with-border">
														<h3 class="box-title"><?php echo  ucwords($this->lang->line('pagetitle'));?></h3>
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
             															<?php 
             															// if(isset($packages)){


             																// if($bwcount>0)
             																// {?>
             																 	<!-- <div class="row text-center mt10">					
                             //   								  							<?php echo ucwords($this->lang->line("pendingupgrademsg"));?><a href="<?php echo  base_url();?>user/dashboard"><?php echo ucwords($this->lang->line("dashboard"));?></a>
                             //  														</div> -->


             																
																		<div class="col-md-6">

																			
																		
																		 <!-- <form method="post" action="" class="form" id="form-register" name="registerform" autocomplete="off"> -->
																				<div class="dshfrom"><br>

															                            <h3><?php echo  ucwords($this->lang->line('selectpackage')); ?></h3>

															                             <select id="package" name="package" class="form-control" required >
															                                    <option value="" selected="selected"><?php //echo $this->lang->line('label_country');?><?php echo  ucwords($this->lang->line('selectpackage'));?> </option>
															                                    <?php

															                                    foreach($packages as $prows) { ?>
															                                    <option value="<?php echo $prows->PackageId;?>" <?if($prows->PackageId == set_value('package')) { echo"selected";} ?> ><?php echo ucwords($prows->PackageName);?></option>
															                                    <?php 
															                                } 
															                                ?>
															                            </select> <h4><?php echo  form_error('package');?></h4>

															                            
															                            <h3><?php echo  ucwords($this->lang->line('paythrough')); ?></h3>

															                             <select id="paythrough" name="paythrough" class="form-control" required onChange="PaymentMethod(this.value)">
															                                    <option value="" selected="selected"><?php //echo $this->lang->line('label_country');?><?php echo  ucwords($this->lang->line('select'));?> </option>
															                                    <?php

															                                    foreach($payments as $prows) { ?>
															                                    <option value="<?php echo $prows->PaymentName;?>" <?if($prows->PaymentId == set_value('paythrough')) { echo"selected";} ?> ><?php echo ucwords($prows->PaymentName);?></option>
															                                    <?php 
															                                } 
															                                ?>
															                                  <option value="DepositAccount">Deposit From account balance</option>
															                            </select> 
															                            <h4><?php echo  form_error('paythrough');?></h4>
															                           <!--  <input type="submit" value="<?php echo  ucwords($this->lang->line('upgradenow')); ?>"/> -->


															                                            
																				</div>
																				<div class="payment_form">
																				</div>
																				  <!-- </form> -->
																				  		
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
				</section>
				<div class="control-sidebar-bg"></div>
		</div>
</div>
<script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/user/js/bootstrap.js" type="text/javascript"></script>

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

<!--    <script src="js/js/demo.js"></script>-->
<script type="text/javascript">

function PaymentMethod(payment) {
	var a =$('#package').val();
	
	if(a && payment){
        payment
    var url = '<?php echo base_url();?>payment/'+payment+'/deposit';
        $.ajax({
            url: url,
            type: 'post',
            data: {"package":$('#package').val()},
            dataType: 'html',
            beforeSend: function() {
                $('.payment_mode').html('loading..');
            },
            success: function(html) {
                $('.payment_form').html(html);
                // $('a[href=\'#confirm-content\']').trigger('click');
            }
        });
        }


        else
        {
        	if(!a){
        	alert("First Select Package");
				}
        	$('.payment_form').empty();
        	// $('.payment_form').html('first Select Package');
        	 
        }
    }

    
</script>


<script type="text/javascript">
	
	$(document).delegate('#btnconform', 'click', function() {
    // address = $('$existing-customer').serialize();
 
    $.ajax({
        url: 'checkout/confirm',
        type: 'post',
        data: $('#payment-method-content input[type=\'text\'],#payment-method-content input[type=\'hidden\'],#paythrough'),
        dataType: 'json',
        beforeSend: function() {
            // $('#confirm-content').button('loading');
            $('#btnconform').html('loading');
        },
        complete: function() {
            // $('#confirm-content').button('rest');
            $('#btnconform').html('continue');
        },
        success: function(json) {
            if(json['field']) {
                $('#payment-method-content').append(json['field']);
            }
            if(json['success']) {
                // $('#confirm-content form').append('<input type="hidden" name="custom" value="'+json['MemberId']+', '+json['orderid']+'"/>');
                // $('#confirm-content').button('loading');
                $('#btnconform').html('loading');
                  $('#payment-method-content').submit();        
            } else {
                $('#btnconform').html('checkout');
            }
            
            // console.log('saved');
        }
    });
});
</script>

<!-- <script type="text/javascript">
	
	$(document).delegate('#paythrough', 'click', function() {
    // address = $('$existing-customer').serialize();
    
    $.ajax({
        url: 'checkout/payment_way',
        type: 'post',
        data: $('#paythrough').val(),
        dataType: 'json',
        beforeSend: function() {
            // $('#confirm-content').button('loading');
            $('#paythrough').html('loading');
        },
        complete: function() {
            // $('#confirm-content').button('rest');
            $('#paythrough').html('continue');
        },
        success: function(json) {
            if(json['field']) {
                $('#payment-method-content form').append(json['field']);
            }
            if(json['success']) {
                // $('#confirm-content form').append('<input type="hidden" name="custom" value="'+json['MemberId']+', '+json['orderid']+'"/>');
                // $('#confirm-content').button('loading');
                $('#paythrough').html('loading');
                // $('#confirm-content form').submit();        
            } else {
                $('#paythrough').html('checkout');
            }
            
            // console.log('saved');
        }
    });
});
</script> -->
</body>
</html>
