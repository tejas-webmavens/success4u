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
														<h3 class="box-title"><?php echo  ucwords($this->lang->line('fund').$this->lang->line('transfers'));?></h3>
														<div class="box-tools pull-right">
																<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
																<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
														</div>
												</div>
												<div class="box-body">
														<div class="row">
																<div class="prfle">

																		<!-- <div class="col-md-6">
																				<div class="col-md-6"> <img src="img/dshusr.png" class="img-responsive" /> </div>
																				<div class="col-md-6">
																						<p class="nme-hdbg">Default Profile Icon</p>
																						<p>Lorem Lipsum dummy texthere liskgps ds Lorem Lipsum dummy texthere liskgps </p>
																						<input type="file" name="file" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
																						<label for="file"><strong>Browse</strong></label>
																				</div>
																				<div class="clearfix"></div>
																				<div class="dshfrom">
																						<h3>Username</h3>
																						<input type="text">
																						<h4>error info here *</h4>
																						<h3>Username</h3>
																						<input type="text">
																						<h4>error info here *</h4>
																				</div>
																		</div> -->
																		<div class="col-lg-12">
																		<table class="table">
																		<th ><?php echo  ucwords($this->lang->line('transferstatus')); ?></th>
																		<th ><?php echo  ucwords($this->lang->line('minfund')); ?></th>
												                        <th ><?php echo  ucwords($this->lang->line('maxfund')); ?></th>
												                        <th ><?php echo  ucwords($this->lang->line('adminfee')); ?></th>
												                        <th ><?php echo  ucwords($this->lang->line('adminfeetype')); ?></th>
												                        <th ><?php echo  ucwords($this->lang->line('feefrom')); ?></th>
												                        <tr>
												                        <td align="center"><?php $transferstatus = $this->fund_model->Getdata('transferstatus'); if($transferstatus==1){echo "On";}else{echo"Off";}?></td>
												                        <td align="center"><?php echo $minfund = $this->fund_model->Getdata('minfund');?></td>
												                        <td align="center"><?php echo $maxfund = $this->fund_model->Getdata('maxfund');?></td>
												                        <td align="center"><?php echo $adminfee = $this->fund_model->Getdata('adminfee');?></td>
												                        <td align="center"><?php $adminfeetype = $this->fund_model->Getdata('adminfeetype'); echo ucwords($adminfeetype); ?></td>
												                        <td align="center"><?php $transferfeetype = $this->fund_model->Getdata('transferfeetype'); echo ucwords($transferfeetype);?></td>
												                        
												                        </tr>

																		</table>
																		<hr>
																			<?php if($transferstatus==0){?>

																			<label class="label label-warning col-lg-12"><?php echo ucwords($this->lang->line('fundwarning'));?></label>
										                                    

																			<?php }?>

										                					<?php if($this->session->flashdata('error_message')) { ?>    
										                                        
										                                            <label class="label label-danger col-lg-12"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
										                                    
										                                    <?php unset($_SESSION['error_message']); } ?>
										                                    
										                                    <?php if($this->session->flashdata('success_message')) { ?>    
										                                        
										                                            <label class="label label-success col-lg-12"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
										                                     
										                                    <?php unset($_SESSION['success_message']); } ?>
             															</div>

																		<div class="col-md-6">

																		
																		 <form method="post" action="" class="form" id="form-register" autocomplete="off">
																				<div class="dshfrom"><br>

																						
																						<h3><?php echo  ucwords($this->lang->line('username')); ?><sup><em class="text-danger">*</em></sup></h3>
															                            <input type="text" name="username" value="<?php echo set_value('username');?>" id="username" placeholder="<?php echo  ucwords($this->lang->line('enter').$this->lang->line('username')); ?>"/>
															                            <h4><?php echo  form_error('username');?></h4>
															                        

															                            
															                            <h3><?php echo  ucwords($this->lang->line('nameverify')); ?></h3>
															                            <input type="text" name="nameverify" id="nameverify" placeholder="<?php echo  ucwords($this->lang->line('enter').$this->lang->line('username')); ?>" readonly/>
															                            <h4> <?php echo  form_error('nameverify');?></h4>

															                             <h3><?php echo  ucwords($this->lang->line('transferamount')); ?><sup><em class="text-danger">*</em></sup></h3>
															                            <input type="text" name="transferamount" id="transferamount" value="" onkeyup="calculatepay(this.value)" onbulr="calculatepay(this.value)" number required/>
															                             <h4><?php echo  form_error('transferamount');?></h4>

															                              <h3><?php echo  ucwords($this->lang->line('adminfee')); ?></h3>
															                            <input type="text" name="adminfee" id="adminfee" value="<?php echo $adminfee;?>" readonly/>
															                             <h4><?php echo  form_error('adminfee');?></h4>

															                            <h3><?php echo  ucwords($this->lang->line('payableamount')); ?></h3>
															                            <input type="text" name="payableamount" id="payableamount" value="" readonly/>
															                             <h4><?php echo  form_error('payableamount');?></h4>


															                           
															                            <input type="hidden" name="fee" id="fee" value="<?php echo  $adminfee?>" readonly/>
															                            <input type="hidden" name="ftype" id="ftype" value="<?php echo  $adminfeetype?>" readonly/>
															                            <input type="hidden" name="mtype" id="mtype" value="<?php echo  $transferfeetype?>" readonly/>

																						<!-- 
															                             <h3><?php echo  ucwords($this->lang->line('ewallettype')); ?><sup><em class="text-danger">*</em></sup></h3>
															                            <input type="text" name="ewallettype" id="ewallettype" readonly />
															                             <h4><?php echo  form_error('ewallettype');?></h4>
																						 -->
															                             <h3><?php echo  ucwords($this->lang->line('description')); ?><sup><em class="text-danger">*</em></sup></h3>
															                            <textarea style="width:100%;" name="description" id="description" class="ckeditor "></textarea>
															                             <h4><?php echo  form_error('description');?></h4> 
															                           
															                            <h3></h3>
															                            
															                            <input type="submit" value="<?php echo  ucwords($this->lang->line('transfernow')); ?>"/>
																				</div>
																				  </form>

																		</div>
																		<div class="col-md-6 text-center"><br><br>
									<img src="<?php echo base_url();?>assets/user/img/transfr.jpg" class="img-responsive" >
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
						<!-- <div class="row">
								<div class="col-md-12">
										<div class="box">
												<div class="box-header with-border">
														<h3 class="box-title"><?php echo  ucwords($this->lang->line('fund').$this->lang->line('transfers'));?></h3>
														<div class="box-tools pull-right">
																<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
																<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
														</div>
												</div>
												<div class="box-body">
														<div class="row">
																<div class="col-md-8">
																		<div class="nav-tabs-custom">
																				<div class="tab-content no-padding">
																						<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
																				</div>
																		</div>
																</div>
																<div class="col-md-4">
																		<div class="progress-group"> <span class="progress-text">Account Info</span> <span class="progress-number">Total Balance 60%</span>
																				<div class="progress sm">
																						<div class="progress-bar progress-bar-red" style="width: 80%"></div>
																				</div>
																		</div>
																		<div class="progress-group"> <span class="progress-text">Account Info</span> <span class="progress-number">Total Balance 60%</span>
																				<div class="progress sm">
																						<div class="progress-bar progress-bar-red" style="width: 80%"></div>
																				</div>
																		</div>
																		<div class="progress-group"> <span class="progress-text">Account Info</span> <span class="progress-number">Total Balance 60%</span>
																				<div class="progress sm">
																						<div class="progress-bar progress-bar-red" style="width: 80%"></div>
																				</div>
																		</div>
																</div>
														</div>
												</div>
												<div class="box-footer">
														<div class="row">
																<div class="col-sm-3 col-xs-6">
																		<div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
																				<h5 class="description-header">$35,210.43</h5>
																				<span class="description-text">TOTAL REVENUE</span> </div>
																</div>
																<div class="col-sm-3 col-xs-6">
																		<div class="description-block border-right"> <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
																				<h5 class="description-header">$10,390.90</h5>
																				<span class="description-text">TOTAL COST</span> </div>
																</div>
																<div class="col-sm-3 col-xs-6">
																		<div class="description-block border-right"> <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
																				<h5 class="description-header">$24,813.53</h5>
																				<span class="description-text">TOTAL PROFIT</span> </div>
																</div>
																<div class="col-sm-3 col-xs-6">
																		<div class="description-block"> <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
																				<h5 class="description-header">1200</h5>
																				<span class="description-text">GOAL COMPLETIONS</span> </div>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div> -->
					
				
						
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

<!--    <script src="js/js/demo.js"></script>-->

    
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        $("#username").keyup(function(e){
            
                var username = $(this).val();
                if(username)
                {
                $.ajax({
                    type    : 'post',
                    url     : '<?php echo base_url();?>user/fund/checkmember/'+username,
                    success : function(msg)
                    {
                        $('#nameverify').val(msg);
                    }
                });
            }
            
            });
        $("#username").focusout(function(e){
            
                var username = $(this).val();
                if(username)
                {
                $.ajax({
                    type    : 'post',
                    url     : '<?php echo base_url();?>user/fund/checkmember/'+username,
                    success : function(msg)
                    {
                        $('#nameverify').val(msg);
                    }
                });
            }
            
            });

         $("#transferamount").click(function(e){
            
                var username = $('#username').val();

                if(username)
                {
                $.ajax({
                    type    : 'post',
                    url     : '<?php echo base_url();?>user/fund/checkmember/'+username,
                    success : function(msg)
                    {
                        $('#nameverify').val(msg);
                    }
                });
            }
            
            });
       });

})(jQuery);
</script>

<script type="text/javascript">

function calculatepay(amount)
{
	
	var adminfee = $('#fee').val();
	var ftype = $('#ftype').val();
	var mtype= $('#mtype').val();
	if(mtype=='receiver')
	{
		var payamount = parseFloat(amount).toFixed(2);
		var fee = parseFloat(adminfee).toFixed(2);
		if(ftype =='percentage')
		{
			var fee = parseFloat(parseFloat(amount) * parseFloat(adminfee / 100)).toFixed(2);
		}
		
	}
	else
	{
		if(ftype =='percentage')
		{
			var fee = parseFloat(parseFloat(amount) * parseFloat(adminfee / 100)).toFixed(2);
			var payamount = parseFloat(parseFloat(fee) + parseFloat(amount)).toFixed(2);
			
		}
		else
		{
			var fee = parseFloat(adminfee).toFixed(2);
			var payamount =  parseFloat(parseFloat(amount) +  parseFloat(adminfee)).toFixed(2) ;
		}
	}
	$('#payableamount').val(payamount);
	$('#adminfee').val(fee);

}
</script>
    



</body>
</html>
