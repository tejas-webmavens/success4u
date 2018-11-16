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
														<h3 class="box-title"><?echo ucwords($this->lang->line('requestepin'));?></h3>
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
																		
																			

										                					<?php if($this->session->flashdata('error_message')) { ?>    
										                                        
										                                            <label class="label label-danger col-lg-12"><?php echo ucwords($this->session->flashdata('error_message'));?></label>
										                                    
										                                    <?php unset($_SESSION['error_message']); } ?>

										                                  <!--   <?php if($this->session->flashdata('errorbalance')) { ?>    
										                                        
										                                            <label class="label label-danger col-lg-12"><?php echo ucwords($this->session->flashdata('errorbalance'));?></label>
										                                    
										                                    <?php unset($_SESSION['errorbalance']); } ?> -->
										                                    
										                                    <?php if($this->session->flashdata('success_message')) { ?>    
										                                        
										                                            <label class="label label-success col-lg-12"><?php echo ucwords($this->session->flashdata('success_message'));?></label>
										                                     
										                                    <?php unset($_SESSION['success_message']); } ?>
             															</div>

																		<div class="col-md-6">

																		
																		 <form method="post" action="" class="form" id="form-register" autocomplete="off">
																		 <!-- <?php echo validation_errors();?> -->
																				<div class="dshfrom"><br>

																						
																						<h3><?echo ucwords($this->lang->line('package')); ?><sup><em class="text-danger">*</em></sup></h3>
																						
																						<select id="packageid" name="packageid" class="form-control">
															                            <option value=""><?echo ucwords($this->lang->line('choosefield')); ?></option>
															                            <?php 
															                             if($this->data['packagedetail']!='')
															                            {
															                            for($i=0; $i<count($this->data['packagedetail']); $i++) {      ?>

															                                 <option value="<? echo $this->data['packagedetail'][$i]->PackageId;?>" ><?echo ucwords($this->data['packagedetail'][$i]->PackageName);?></option>
															                           
															                           <? }}

                           																	 ?></select>
                           																	 
                           																<h4><?echo ucwords(form_error('packageid'));?></h4>
                               																
                                             												   

															                            <h3><?echo ucwords($this->lang->line('packageamount')); ?></h3>
															                            <input type="text" name="packageamount" id="packageamount" placeholder="<?echo ucwords($this->lang->line('enter').$this->lang->line('packageamount')); ?>" value=""/>
															                            <input type="hidden" name="amount" id="amount" value="">
															                            <h4> <?echo ucwords(form_error('packageamount'));?></h4>

															                             <h3><?echo ucwords($this->lang->line('epincount')); ?><sup><em class="text-danger">*</em></sup></h3>
															                            <input type="text" name="epincount" id="epincount" value="" onkeyup="settotal(this.value)" number required/>
															                             <h4><?echo ucwords(form_error('epincount'));?></h4>

															                            <h3><?echo ucwords($this->lang->line('totalamount')); ?></h3>
															                            <input type="text" name="totalamount" id="totalamount" value="" readonly/>
															                             <h4><?echo ucwords(form_error('totalamount'));?></h4>

															                              <h3><?echo ucwords($this->lang->line('paythrough')); ?></h3>
															                            <select id="paythrough" name="paythrough" onchange="showpaydetail(this.value)" class="form-control">
															                            <option value="" ><?echo $this->lang->line('choosefield');?></option>
															                             <option value="cheque" ><?echo ucwords($this->lang->line('cheque'));?></option>
															                            <option value="bankwire" ><?echo ucwords($this->lang->line('bankwire'));?></option>
															                            <option value="Accountbalance" ><?echo ucwords($this->lang->line('balance'));?></option>
															                           
															                            </select>
															                             <h4><?echo form_error('paythrough');?></h4>

															                              <div id="bal">
															                                <h4><?echo form_error('balanceamount');?></h4>

															                            </div>




															                             <div id="payref">
															                            
															                            <h4><?echo ucwords(form_error('paymentreference'));?></h4>
															                            </div>


															                            <h3></h3>
															                            <input type="hidden" value="<?php echo $this->session->MemberID;?>" id="userid">
															                            
															                            <input type="submit" value="<?echo ucwords($this->lang->line('requestnow')); ?>"/>
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
<script src="<?php echo base_url();?>assets/user/js/jquery-2.2.1.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/user/js/bootstrap.js" type="text/javascript"></script>

<!-- 
<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="<?php echo base_url();?>assets/user/js/plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datepicker/bootstrap-datepicker.js"></script> -->

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

    var amount = document.getElementById('amount').value ;


    document.getElementById('totalamount').value = amount * cnt ;
}


function showpaydetail(name)
{
	if(name=='cheque')
	{
		document.getElementById('payref').style.display = 'block';
	}if(name=='bankwire')
	{
		document.getElementById('payref').style.display = 'block';
	}
	if(name=='ewallet')
	{
		document.getElementById('payref').style.display = 'none';
	}


}




</script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script type="text/javascript">
	$(document).ready(function () {
 	// alert(a);
    $('#paythrough').change(function(){
        var payvalue = this.value;
 		var a=$('#userid').val();
 		var b=$('#totalamount').val();

 	if(payvalue=='bankwire' || payvalue=='cheque')
 	{
	    html='<h3>Transaction Id Reference</h3><input type="text" name="paymentreference" id="paymentreference" value="" />';
	    $('#payref').append(html);
 	}
 	else
 	{
 		$('payref').css("display","none");
 	}

      if(payvalue=='Accountbalance')
      {
        // alert(payvalue);
        // alert(a);
       
       $.ajax({
            url: "<?php echo base_url();?>user/epin/getuserbalance/"+a+"/"+b,
            type: "post",
            data: {id: $(this).find("option:selected").val()},
            success: function(data){
                if(data) {
			
                	 html='<h3>Your Account balance</h3><input type="text" name="balanceamount" id="balanceamount" value="" readonly/>';
     				  $('#bal').append(html);
                	 
                    // document.getElementById('balanceamount').value = data ; // <label for="amount" class="field-icon"> <i class="fa fa-money"></i> </label>
                     $('#balanceamount').val(data);
                } else
                 {
                	 html='<h3>Your Account balance</h3><input type="text" name="balanceamount" id="balanceamount" value="" readonly/>';
       				$('#bal').append(html);
       				 // $('#paythrough').append(html)='<input type="text" name="balanceamount" id="balanceamount" value="" readonly/>';

                    // $('#packageamount').val('0.00');
                     $('#balanceamount').val('0.00');
                    
                }
               
            }
        });
}

else
{
	$('#bal').css("display","none");


 }  

  });

});

</script>

    



</body>
</html>
