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
<link href="<?php echo base_url();?>assets/user/fonts/Socialico/stylesheet.css" type="text/css" rel="stylesheet" />
<style type="text/css">
	.prd-ovrvew .social a {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    color: #fc4242;
    float: left;
    font-family: "Socialico";
    font-size: 32px;
    margin: 0 5px;
    padding: 0;
    text-transform: uppercase;
}
.prd-ovrvew a {
    background: #fc4242 none repeat scroll 0 0;
    border-radius: 3px;
    color: #fff;
    float: left;
    font-size: 16px;
    margin: 0 40px 0 0;
    padding: 15px 20px;
    text-align: center;
    text-shadow: 1px 2px 1px rgba(0, 0, 0, 0.17);
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
	<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
		
						
		<div class="content-wrapper">
			<section class="content">
					
				<?php $this->load->view('user/pagelink');?>
				<?php $this->load->view('user/userinfo');?>

				<div class="bskt">
                    <?php if($this->session->flashdata('error_message')) { ?>  
                    	<div class="alert alert-danger alert-dismissable">
                    		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    		<?php echo $this->session->flashdata('error_message');?>
                    	</div>  
                        
                    <?php } ?>
                    
                    <?php if($this->session->flashdata('success_message')) { ?>    
                    	<div class="alert alert-success alert-dismissable">
                    		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    		<?php echo $this->session->flashdata('success_message');?>
                    	</div>
                    <?php } ?>
                </div>
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

										<div class="col-md-7">
										
											<form method="post" action="" class="form" id="form-register" autocomplete="off">
												<div class="dshfrom"><br>

														
						                           	<div class="col-md-12">
							                            <h3><?php echo  ucwords($this->lang->line('referrallink')); ?><sup><em class="text-danger">*</em></sup></h3>
							                            <?php $refurl = base_url().'user/register/?ref='.$member->ReferralName;?>
							                           	<h3><a href="<?php echo base_url().'user/register/?ref='.$member->ReferralName;?>" ><?php echo base_url().'user/register/?ref='.$member->ReferralName;?></a></h3>
							                           	<div class="prd-ovrvew">
															<div class="social share-buttons">
																<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $refurl;?>" target="_blank" title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='<?php echo $refurl;?>'&t=' + encodeURIComponent(document.URL)); return false;" class="rtte">f</a> 
																<a href="https://plus.google.com/share?url=<?php echo $refurl;?>" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;" class="rtte">g</a>
																<a href="https://twitter.com/intent/tweet?source=<?php echo $refurl;?>&text=:%20" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20' + encodeURIComponent(document.URL)); return false;" class="rtte">t</a>
																<a href="http://pinterest.com/pin/create/button/?url=<?php echo $refurl;?>&description=" target="_blank" title="Pin it" onclick="window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(document.URL) + '&description=' +  encodeURIComponent(document.title)); return false;" class="rtte">p</a>
															</div>
														</div>
						                          	</div>
						                          	<div class="col-md-6">
														<h3><?php echo  ucwords($this->lang->line('referralname')); ?><sup><em class="text-danger">*</em></sup></h3>
							                            <input type="text" name="referralname" value="<?php echo set_value('referralname',isset($member->ReferralName)?$member->ReferralName : '');?>" id="referralname" placeholder="<?php echo  ucwords($this->lang->line('enter').$this->lang->line('referralname')); ?>"/>
							                            <h4><?php echo  form_error('referralname');?></h4>
							                            <h3></h3>
							                            <input type="submit" value="<?php echo  ucwords($this->lang->line('updatenow')); ?>"/>
						                           	</div>
							      						
							                            
												</div>
											</form>
											

										</div>
										<div class="col-md-5 text-center">
											<img src="<?php echo base_url();?>assets/user/img/refer.jpg" width= "60%" >
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
