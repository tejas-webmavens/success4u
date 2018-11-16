<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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

				<div class="bskt">
					<?php if($this->session->flashdata('success_message')) { ?>
						<div class="alert alert-success alert-dismissable">
		                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		                    <i class="icon fa fa-check"></i> 
		                    <?php echo $this->session->flashdata('success_message');?>
	                  	</div>
	                <?php } ?>
	                  	
                  	<?php if($this->session->flashdata('error_message')) { ?>
	                  	<div class="alert alert-warning alert-dismissable">
                    		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    		<i class="icon fa fa-warning"></i> 
		                    <?php echo $this->session->flashdata('error_message');?>
	                  	</div>
                  	<?php } ?>
                </div>
				
				<div class="row">
					
					<div class="col-md-12">
					<form action="<?php echo base_url();?>user/testimonials/create" method="post" enctype="multipart/form-data">
		              <div class="box box-primary">
		                <div class="box-header with-border">
		                  <h3 class="box-title">Testimonials</h3>
						  <div class="box-tools">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                  </div>
		                </div><!-- /.box-header -->
		                <div class="box-body">
		                  
		                    <table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Subject</th>
										<th>Image</th>
										<th>Description</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								
									if($testimonial) { 

										foreach ($testimonial as $row) {
											if($row->Status==1 || $row->Status==3) 
												$status = 'UnPublish';
											else
												$status = 'Published';
								?>
									<tr>
										<td><?php echo $row->Subject;?></td>
										<td><img style="height: 50px; width: 80px;" src="<?php echo base_url().''.$row->UserLogo;?>" alt="user testimonial"/></td>
										<td><?php echo urldecode($row->Message);?></td>
										<td><?php echo $status;?></td>
										<td><a href="<?php echo base_url().'user/testimonials/create/'.$row->TestimonialId;?>"><i class="fa fa-edit"></i></a>  <a href="<?php echo base_url().'user/testimonials/delete/'.$row->TestimonialId;?>"><i class="fa fa-remove"></i></a></td>
									</tr>
								<?php 
										}
									} else {
								?>
									<tr>
										<td colspan="5">No Records Found</td>
									</tr>

								<?php 
									}
								?>
										
								</tbody>
								
						  	</table>
		                  
		                </div>
		                
		              </div><!-- /. box -->
		            </form>
		            </div>
				</div>
              </div><!-- /. box -->
            </div>
						</div>
						
						
				</section>
				<div class="control-sidebar-bg"></div>
		</div>
</div>

<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>
<script>
      $(function () {
        $("#example1").DataTable();
        
      });
    </script>

</body>
</html>
