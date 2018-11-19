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

											<form method="post" action="" class="form" id="form-register" autocomplete="off" enctype="multipart/form-data">
												<div class="dshfrom"><br>
													<div class="fileupload fileupload-new" data-provides="fileupload">
									                    <h3><?php echo ucwords($this->lang->line('profileimage'));?></h3>	
									                    <label class="col-md-7 ph10 block mt15 option option-primary">
									                        <div class="fileupload-preview thumbnail mb20">
									                            
									                            <img src="<?php echo base_url(); if(isset($member->ProfileImage)){echo $member->ProfileImage; }?>" alt="<?php echo ucwords($this->lang->line('profileimage'));?>">
									                        </div>
									                        <span class="btn btn-primary light btn-file btn-block ph5">
									                            <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
									                            <input type="file"  name="profileimage" value="<?php if(isset($member->ProfileImage)){echo $member->ProfileImage; }?>">
									                        </span>
								                        	<?php echo form_error('profileimage'); ?>
								                        </label>
													</div>
																						
													<div class="col-md-12">
														<?php 
															$customfield = array(); 
															$customdata = json_decode($member->CustomFields);
							                              	foreach ($customdata as $key => $value) {
							                               		array_push($customfield, $key);
							                              	}
							                           
							                            	foreach ($requirefields as $row) {
							                              		$fname = $row->ReuireFieldName;

								                                if($row->FieldEnableStatus==1 && $row->ReuireFieldName!='Password' && $row->ReuireFieldName!='Email' && $row->ReuireFieldName!='Country'&& $row->ReuireFieldName!='UserName')
								                                { 
								                                    if(in_array($row->ReuireFieldName,$customfield)){ 
								                                	?>

									                                                                            <h3><?php echo  ucwords(($this->lang->line('lbl_'.$row->ReuireFieldName)) ? $this->lang->line('lbl_'.$row->ReuireFieldName) : $row->ReuireFieldName); ?><?php if($row->ReuireFieldStatus=='1') {$st = 'required';?> <sup> <em class="state-error">*</em> </sup><?php } else{$st="";}?></h3>

									                                    <?php if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";}?>
									                                    <input type="text" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input " placeholder="<?php echo  $this->lang->line('place_'.$row->ReuireFieldName); ?>" value="<?php echo set_value($fname,isset($customdata->$fname) ? $customdata->$fname : ''); ?>" <?php echo  $st;?> >
									                                   
									                                   <h4> <?php echo form_error($row->ReuireFieldName); ?> </h4><?php
									                                    $st='';    
									                                }
									                                else
									                                {
								                            			?>
									                                    <h3><?php echo  ucwords($row->ReuireFieldName); ?><sup> <em class="state-error">*</em> </sup></h3>
									                                    <?php if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";}?>
									                                    <input type="text" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input " placeholder="<?php echo  $row->ReuireFieldName; ?>" value="<?php echo set_value($fname,isset($member->$fname) ? $member->$fname : ''); ?>" <?php echo  $st;?> >
									                                   	<h4> <?php echo form_error($row->ReuireFieldName); ?></h4><?php
									                                    $st='';
							                                		}
							                              		}
							                                	elseif ($row->ReuireFieldName=='UserName') {   ?>
							                                		<?php if($row->ReuireFieldStatus=='1') {$st = 'required';}else{$st="";}?>
							                                		<h3><?php echo  ucwords($this->lang->line('lbl_'.$row->ReuireFieldName)); ?><sup> <em class="state-error">*</em> </sup></h3>
							                                		<input type="text" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input" placeholder="<?php echo  $this->lang->line('place_'.$row->ReuireFieldName); ?>" readonly value="<?php echo set_value($fname,isset($member->$fname) ? $member->$fname : ''); ?>" <?php echo  $st;?> readonly>
							                             			<h4><?php echo form_error($row->ReuireFieldName); ?></h4>

							                                		<?php
							                                		$st=''; 
							                                	}
							                                	elseif ($row->ReuireFieldName=='Email') {   ?>
							                                		<?php if($row->ReuireFieldStatus=='1') {$st = 'email required';}else{$st="";}?>
							                                		<h3><?php echo  ucwords($this->lang->line('lbl_'.$row->ReuireFieldName)); ?><sup> <em class="state-error">*</em> </sup></h3>
							                                		<input type="text" name="<?php echo  $row->ReuireFieldName; ?>" id="<?php echo  $row->ReuireFieldName; ?>" class="gui-input" placeholder="<?php echo  $this->lang->line('place_'.$row->ReuireFieldName); ?>" value="<?php echo set_value($fname,isset($member->$fname) ? $member->$fname : ''); ?>" <?php echo  $st;?> readonly>
							                               			<h4> <?php echo form_error($row->ReuireFieldName); ?> </h4>
							                                		<?php 
							                                		$st=''; 
							                                	}
							                                	elseif($row->ReuireFieldName=='Country')
							                                    { 
							                                    	if($row->ReuireFieldStatus=='1') {
							                                        	$st = 'required';
							                                        } 
							                                        else {
							                                        	$st="";
							                                        } 
							                                        ?>
							                                		<h3><?php echo  ucwords($this->lang->line('lbl_'.$row->ReuireFieldName)); ?><sup> <em class="state-error">*</em> </sup></h3>
							                                		<select id="Country" name="Country" class="form-control" <?php echo  $st;?> >
									                                    <option value="" selected="selected"><?php ?>-- Select Country -- </option>
									                                    <?php
									                                    foreach($country as $crows) { ?>
									                                    	<option value="<?php echo $crows->country_id;?>" <?php if($crows->country_id == $member->Country) { echo"selected";}?> ><?php echo $crows->name;?></option>
									                                    <?php 
									                                	} 
									                                	?>
							                            			</select>
							                           				<h4> <?php echo form_error('Country'); ?></h4>
							                           				<?php
							                        			}

							                    			}
							                     			?>
							             					<?php	
							             					$propassstaus = $this->common_model->GetRow("Page='usersetting' AND KeyValue='profilepassordstatus'", "arm_setting");
															if($propassstaus->ContentValue == 1) 	 
															{ ?>
							                                   	<h3><?php echo ucwords($this->lang->line('transactionpassword')); ?></h3>
							                                    <input type="password" name="tPassword" placeholder="Enter <?php echo ucwords($this->lang->line('transactionpassword')); ?> " required />
							                                    <h4><?php echo form_error('tPassword'); ?></h4>
							                                    <?php 
							                                }
							                                ?>
							                                <h3><?php echo ucwords($this->lang->line('loginpassword')); ?></h3>
							                                <input type="password" name="Password" placeholder="Enter <?php echo ucwords($this->lang->line('loginpassword')); ?> " required />
							                                <h4><?php echo form_error('Password'); ?></h4>
							                                <input type="submit" name="reg" value="<?php echo ucwords($this->lang->line('update')); ?>"/> 
													</div>
												</div>
											</form>
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
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

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
