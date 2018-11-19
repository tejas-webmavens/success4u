<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');
// error_reporting(E_ALL);

?>
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
									<?php
										$matrixid = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');


									?>
										<tr>
											<th><?php echo  ucwords($this->lang->line('label_sno'));?></th>
											<th><?php echo  ucwords($this->lang->line('label_username'));?></th>
											<th><?php echo  ucwords($this->lang->line('label_sponsorname'));?></th>
											<th><?php echo  ucwords($this->lang->line('label_level'));?></th>
											<?php
											if($matrixid->Id==5)
											{?>
											<th>Package</th>


											<?}
										
											?>

											<th><?php echo  ucwords($this->lang->line('label_email'));?></th>
											<th><?php echo  ucwords($this->lang->line('label_date'));?></th>
										</tr>
									</thead>
									<tbody>
										<?php 	

										if($matrixid->Id==5)
										{
											
										if($mydowns) {
											$j=1;
											foreach($mydowns as $key => $value)
                    						{
												$val = trim($value,',');
                            					$explode = explode(',',$val);
                            					$count = count($explode);
                            					


										  		for($i=0;$i<$count;$i++)
                       						 	{
													// $matrixid = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
													
													$ucondition = "BoardMemberId ='".$explode[$i]."'";
                           						 	$userdetails = $this->common_model->GetRow($ucondition,"arm_boardmatrix");

                           						 	
                           						 	// $sponsor = $this->common_model->GetRow($ucondition,"arm_forcedmatrix");
                           						 	
                           						 	
                           						 	// if($userdetails!=""){
													$scondition = "MemberId='".$userdetails->MemberId."'";

                           						 	$sponsordetail = $this->common_model->GetRowCount($scondition,"arm_boardmatrix");
                           						 	// echo $this->db->last_query();
                           						 	// echo $sponsordetail;


													 for($k=1; $k<=$sponsordetail; $k++) { 
													 	 // echo $k;

													 	// if($k==1)
													 	// {
                //            						 		$sponsors = $this->common_model->GetRow($scondition,"arm_boardmatrix");

													 		// $packname=$sponsors->BoardId;
													 		$checkpackname=$this->common_model->GetRow('PackageId='.$k.'',"arm_boardplan");
														$name=$checkpackname->PackageName;
													 	// }
													 	// else {
                           						 	// $sponsors = $this->common_model->GetRow($scondition,"arm_boardmatrix");

													 		// $packname=$sponsors->BoardId;
													 // 		$checkpackname=$this->common_model->GetRow('PackageId='.$k.'',"arm_boardplan");
														// $name=$checkpackname->PackageName;
													 	// }

                           						 	// echo $this->db->last_query();
                           						 	// $packname=$sponsors->BoardId;


                           						 	$sponsordetails = $this->common_model->GetRow($scondition,"arm_members");

                           						 	$directid=$sponsordetails->DirectId;

                           						 	$condition = "MemberId='".$sponsordetails->DirectId."'";

                           						 	$sponsor = $this->common_model->GetRow($condition,"arm_members");
													
													 ?>

														<tr>

														<td><?php echo  $j;?></td>

														<td><?php echo  $sponsordetails->UserName?></td>

														
														<td><?php echo  $sponsor->UserName?></td>

														
														<td><?php echo  "LEVEL".$key

														?></td>
													<!-- <?php 

														// $board=$userdetails->BoardId;
														// $checkpackname=$this->common_model->GetRow('PackageId='.$packname.'',"arm_boardplan");
														// $name=$checkpackname->PackageName;
												

														?> -->

														<td><?php echo $name;?></td>
														<td><?php echo  $sponsordetails->Email?></td>
														<td><?php echo  date($sponsordetails->DateAdded); ?></td>
													</tr>	
												
														

												
										<?php 
											}

										$j++;	
									}

								
								 }
										} else {
										?>
											<tr><td colspan="6" class="text-center">No Downlines</td></tr>
										<?php
										}
										
									}
										else{

											if($mydowns) {
											$j=1;
											foreach($mydowns as $key => $value)
                    						{
												$val = trim($value,',');
                            					$explode = explode(',',$val);
                            					$count = count($explode);
                            					


										  		for($i=0;$i<$count;$i++)
                       						 	{
													$matrixid = $this->common_model->GetRow("MatrixStatus='1'", 'arm_matrixsetting');
													
													
													$ucondition = "MemberId='".$explode[$i]."'";
                           						 	$userdetails = $this->common_model->GetRow($ucondition,"arm_members");

                           						 	
                           						 	// $sponsor = $this->common_model->GetRow($ucondition,"arm_forcedmatrix");
                           						 	$scondition = "MemberId='".$userdetails->DirectId."'";

                           						 	$sponsordetails = $this->common_model->GetRow($scondition,"arm_members");
													// }

                           						 	
                           						 	// if($userdetails!=""){?>
								
													<tr>

														<td><?php echo  $j;?></td>
													
													
														<td><?php echo  $userdetails->UserName?></td>

														


													
														<td><?php echo  $sponsordetails->UserName?></td>
														
														

														<td><?php echo  "LEVEL".$key

														?></td>
														<!-- <?php 

														$board=$userdetails->PackageId;
														$checkpackname=$this->common_model->GetRow('PackageId='.$board.'',"arm_boardplan");
														$name=$checkpackname->PackageName;
												

														?>
														<td><?php echo $name;?></td> -->
														<td><?php echo  $sponsordetails->Email?></td>
														<td><?php echo  date($sponsordetails->DateAdded); ?></td>
													</tr>	
												
										<?php $j++;	}

											// }
											 }
										} else {
										?>
											<tr><td colspan="6" class="text-center">No Downlines</td></tr>
										<?php
										}  
										
										}  
										?>	
												
									</tbody>
								</table>
							</div>
						</div>

						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo  ucwords($this->lang->line('pagetitle'));?></h3>
								<div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="box-body">
								<link rel="stylesheet" href="<?php echo base_url();?>assets/user/dist/css/bootstrap.min.css">
								<link href="<?php echo base_url();?>assets/user/dist/css/file-tree.min.css" rel="stylesheet">
								<div id="fixed-tree" class="file-tree">

								</div>

								<?php
									$j=1;
									$Parent='';
									foreach($mydowns as $key => $value)
            						{
										$val = trim($value,',');
                    					$explode = explode(',',$val);
                    					$count = count($explode);

									  	for($i=0;$i<$count;$i++) {
                   						 	
                   						 	$childs = $controller->child($explode[$i]);

                   						 	$ucondition = "BoardMemberId='".$explode[$i]."'";
                   						 	$userdetails = $this->common_model->GetRow($ucondition,"arm_boardmatrix");
                   						 	$scondition = "MemberId='".$userdetails->MemberId."'";

                           					$sponsordetails = $this->common_model->GetRow($scondition,"arm_members");
                           					// echo $this->db->last_query();


                   						 	
                   						 		$name = '<span style=color:#ED8A03;font-style:italic;>'.$sponsordetails->UserName.'</span> - <span style=color:#0094FF;font-style:italic;>'.date($sponsordetails->DateAdded).'</span>';
											$Parent.= "{id: 'dir-1',name: '<strong>".$name."</strong>',type: 'dir',children: [".$childs."] }".',';
                   						 	
                   						 	
								  	 	}

										$tree = trim($Parent,',');
										$umcondition = "MemberId='".$this->session->MemberID."'";
               						 	$GetHeadUserdet = $this->common_model->GetRow($umcondition,"arm_members");
               						 	$GetHeadUser = $GetHeadUserdet->UserName;
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
            name: '<?php echo '<strong style=color:#0094FF>'.$GetHeadUser;'</strong>'?>',
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
