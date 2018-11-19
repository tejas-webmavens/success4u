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
										<li><a href="#"> <i class="fa fa-dashboard"></i> DASHBOARD</a></li>
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
														<h3 class="box-title"><?php echo  ucwords($this->lang->line('pagetitle_buyepin'));?></h3>
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
																		
																			
																		<span style="float : right;"> <?php echo  ucwords($this->lang->line('buynote')); ?></span>
										                					<?php if($this->session->flashdata('error_message')) { ?>    
										                                        
										                                            <label class="label label-danger col-lg-12"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
										                                    
										                                    <?php unset($_SESSION['error_message']); } ?>
										                                    
										                                    <?php if($this->session->flashdata('success_message')) { ?>    
										                                        
										                                            <label class="label label-success col-lg-12"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
										                                     
										                                    <?php unset($_SESSION['success_message']); } ?>
             															</div>

																		<div class="col-md-6">


																		
																		 <!-- <form method="post" class="form" id="form-register" autocomplete="off"> -->
																				<div class="dshfrom"><br>

																						
																						<h3><?php echo  ucwords($this->lang->line('package')); ?><sup><em class="text-danger">*</em></sup></h3>
																						
																						<select id="packageid" name="packageid" class="form-control">
															                            <option value=""><?php echo  ucwords($this->lang->line('choosefield')); ?></option>
															                            <?php 
															                             if($this->data['packagedetail']!='')
															                            {
															                            for($i=0; $i<count($this->data['packagedetail']); $i++) {      ?>

															                                 <option value="<?php echo $this->data['packagedetail'][$i]->PackageId;?>" ><?php echo  ucwords($this->data['packagedetail'][$i]->PackageName);?></option>
															                           
															                           <?php }}

                           																	 ?></select>
                           																	 
                           																<h4><?php echo  form_error('packageid');?></h4>
                               																
                                             												   

															                            <h3><?php echo  ucwords($this->lang->line('packageamount')); ?></h3>
															                            <input type="text" name="packageamount" id="packageamount" readonly placeholder="<?php echo  ucwords($this->lang->line('enter').$this->lang->line('packageamount')); ?>" value=""/>
															                           
															                            <h4> <?php echo  form_error('packageamount');?></h4>

															                             <h3><?php echo  ucwords($this->lang->line('epincount')); ?><sup><em class="text-danger">*</em></sup></h3>
															                            <input type="text" name="epincount" id="epincount" value="" onkeyup="settotal(this.value)" number required/>
															                             <h4><?php echo  form_error('epincount');?></h4>

															                            <h3><?php echo  ucwords($this->lang->line('totalamount')); ?></h3>
															                            <input type="text" name="totalamount" id="totalamount" value="" readonly/>
															                             <h4><?php echo  form_error('totalamount');?></h4>

															                             <h3><?php echo  ucwords($this->lang->line('paythrough')); ?></h3>
															                            <select id="paythrough" name="paythrough" class="form-control" required>
															                                <option value="" selected="selected"><?php echo ucwords($this->lang->line('choosefield'));?> </option>
															                                <?php
															                                if($payments) {
															                                    foreach($payments as $prows) { 

															                                    	if($prows->PaymentName != 'epin') {
															                                
															                                ?>
															                                    <option value="<?php echo $prows->PaymentName;?>" <?php if($prows->PaymentName == set_value('paythrough')) { echo"selected";} ?> ><?php echo ucwords($prows->PaymentName);?></option>
															                                    <?php 
															                                } } }
															                                ?>
															                            </select> 
															                             <h4><?php echo  form_error('paythrough');?></h4>
															                             
															                            <h3></h3>
															                            <!-- </form> -->
															                            <input type="submit" onClick="BuyEpin()" value="<?php echo  ucwords($this->lang->line('buynow')); ?>"/>
																				  
															                            
																				</div>

																				  <div class="payment_form">
																				  </div>
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

<!--    <script src="js/js/demo.js"></script>-->

<script type="text/javascript">

   $(document).ready(function () {
    $('#packageid').change(function(){
        var valueSelected = this.value;
       if(valueSelected)
       {

        $.ajax({
            url: "<?php echo base_url();?>user/epin/getpackageprice/"+valueSelected,
            type: "post",
            data: {id: $(this).find("option:selected").val()},
            success: function(data){
                if(data) {
                	 
                    document.getElementById('packageamount').value = data ; // <label for="amount" class="field-icon"> <i class="fa fa-money"></i> </label>
                     $('#amount').val(data);
                } else {
                    $('#packageamount').val('0.00');
                     $('#amount').val('0.00');
                    
                }
                //adds the echoed response to our container
                /*if(data==''){var data1 ="0.00";}else{var data1=data;}
                document.getElementById('amount').value = data1;*/
                var count = document.getElementById('epincount').value;
                document.getElementById('totalamount').value = data * count;
            }
        });
}
    });
});

function settotal(cnt)
{

    var packageamount = document.getElementById('packageamount').value ;


    document.getElementById('totalamount').value = packageamount * cnt ;
}



</script>
<script type="text/javascript">
function BuyEpin() {

	if($('#packageid').val()=='') {
		$('#packageid').css('border','1px solid red');
	}
	else if($('#epincount').val()=='') {
		$('#epincount').css('border','1px solid red');
	}
	else if($('#paythrough').val()=='') {
		$('#paythrough').css('border','1px solid red');
	}
	else if( ($('#packageid').val()!='') && ($('#epincount').val()!='') && ($('#paythrough').val()!='') ){
		var payment = $('#paythrough').val();
		// alert(payment);
		var url = '<?php echo base_url();?>payment/'+payment+'/buyepin';
        $.ajax({
            url: url,
            type: 'post',
            data: {"package":$('#packageid').val(),"packageamount":$('#packageamount').val(),"epincount":$('#epincount').val(),"totalamount":$('#totalamount').val()},
            dataType: 'html',
            beforeSend: function() {
                $('.payment_mode').html('loading..');
            },
            success: function(html) {
            	$('.dshfrom').css('display','none');
                $('.payment_form').html(html);
                // $('a[href=\'#confirm-content\']').trigger('click');
            }
        });
	}
}

// function PaymentMethod(payment) {
        
//         var url = '<?php echo base_url();?>payment/'+payment+'/buyepin';
//         $.ajax({
//             url: url,
//             type: 'post',
//             data: {"package":$('#package').val(),"packageamount":$('#packageamount').val(),"epincount":$('#epincount').val(),"totalamount":$('#totalamount').val()},
//             dataType: 'html',
//             beforeSend: function() {
//                 $('.payment_mode').html('loading..');
//             },
//             success: function(html) {
//                 $('.payment_form').html(html);
//                 // $('a[href=\'#confirm-content\']').trigger('click');
//             }
//         });
        
//     }
</script>
    



</body>
</html>
