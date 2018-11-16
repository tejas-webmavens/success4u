<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.css">
<!--
	
	<link rel="stylesheet" href=js/"plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <link rel="stylesheet" href="js/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="js/plugins/daterangepicker/daterangepicker-bs3.css">

    <link rel="stylesheet" href="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
		<?php $this->load->view('user/user_aside');?>
		<div class="content-wrapper">
				<section class="content">
						<?php $this->load->view('user/userinfo');?>
						<div class="row">
								<div class="col-xs-12">
										<div class="box">
												<div class="box-header with-border">
														<h3 class="box-title"><?php echo  ucwords($this->lang->line('pagetitle'));?></h3>
														<div class="box-tools pull-right">
																<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
																<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
														</div>
												</div>
												<div class="box-body">
														<table id="example1" class="table table-bordered table-striped">
																<thead>
																<tr>
																			
																				<th colspan="3" align="center"><?php echo  ucwords($this->lang->line('label_sponsor'));?></th>
																				<th colspan="3"  align="center"><?php echo  ucwords($this->lang->line('label_upline'));?></th>
																</tr>
																
																		<tr>
																			
																				<th><?php echo  ucwords($this->lang->line('label_susername'));?></th>
																				<th><?php echo  ucwords($this->lang->line('label_sfullname'));?></th>
																				<th><?php echo  ucwords($this->lang->line('label_sreferralname'));?></th>

																				<th><?php echo  ucwords($this->lang->line('label_username'));?></th>
																				<th><?php echo  ucwords($this->lang->line('label_fullname'));?></th>
																				<th><?php echo  ucwords($this->lang->line('label_referralname'));?></th>
																				
																				
																		</tr>
																</thead>
																<tbody>
																<?php	
                                               						 $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
                                               						 if($mlsetting->Id==1)
																		{
																			$table = "arm_forcedmatrix";
																		}
																		else if($mlsetting->Id==2)
																		{
																			$table = "arm_unilevelmatrix";
																		}
																		else if($mlsetting->Id==3)
																		{
																			$table = "arm_monolinematrix";
																		}
																		else if($mlsetting->Id==4)
																		{
																			$table = "arm_binarymatrix";
																		}
																		else if($mlsetting->Id==5)
																		{
																			$table = "arm_boardmatrix";
																		}
																		else if($mlsetting->Id==6)
																		{
																			$table = "arm_xupmatrix";
																		}
																		else if($mlsetting->Id==7)
																		{
																			$table = "arm_oddevenmatrix";
																		}
																		else if($mlsetting->Id==8)
																		{
																			$table = "arm_boardmatrix1";
																		}	
																		else if($mlsetting->Id==9)
																		{
																			$table = "arm_binaryhyip";
																		}	
                                               						 	$ucondition = "MemberId='".$this->session->MemberID."'";
                                               						 	$userdetails = $this->common_model->GetRow($ucondition,"arm_members");
                                               						 	$sponsor = $this->common_model->GetRow($ucondition,$table);
                                               						 	$scondition = "MemberId='".$sponsor->DirectId."'";

                                               						 	$sponsordetails = $this->common_model->GetRow($scondition,"arm_members");

                                               						 	$ucondition = "MemberId='".$sponsor->SpilloverId."'";

                                               						 	$uponsordetails = $this->common_model->GetRow($ucondition,"arm_members");
																  	
																  	  ?>
																		<tr>
																				
																				<td><?php echo  $sponsordetails->UserName?></td>
																				<td><?php echo  ucwords($sponsordetails->FirstName."   ".$sponsordetails->LastName)?></td>
																				<td><?php echo  $sponsordetails->ReferralName?></td>
																				
																				<td><?php echo  $uponsordetails->UserName?></td>
																				<td><?php echo  ucwords($uponsordetails->FirstName."   ".$sponsordetails->LastName)?></td>
																				<td><?php echo  $uponsordetails->ReferralName?></td>
																				
																				</tr>
																		
																
																		
																</tbody>
																
														</table>
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
<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/user/dist/js/file-tree.min.js"></script>


<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>
<!--    <script src="js/js/demo.js"></script>-->
<script src="<?php echo base_url();?>assets/user/js/justgage.js"></script>


    <script type="text/javascript">
    $(document).ready(function(){
        var data = [{
            id: 'dir-1',
            name: '<?php echo '<strong style=color:#0094FF>'.$GetHeadUser->UserName.'</strong>';?>',
            type: 'dir',
            children: 
			[  
				<?php echo $tree;?>
			]
        }];

        $('#fixed-tree').fileTree({
            data: data
        });

       


    });
</script>
	<script type="text/javascript" language="javascript" src="js/demo/dataTables.responsive.min.js"></script>


<script type="text/javascript">
	$(document).ready(function(){
    $('#example1').DataTable({

    	 order: [[ 4, 'asc' ]]
    });

});
</script>

</body>
</html>
