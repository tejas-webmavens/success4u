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
				<?php $this->load->view('user/pagelink');?>
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
								
								<table>
									<table id="example1" class="table table-bordered table-striped">
										<tr>
											<th><?php echo ucwords($this->lang->line('label_name'));?></th>
											<th><?php echo ucwords($this->lang->line('label_sponser'));?></th>
											<th><?php echo ucwords($this->lang->line('label_email'));?></th>
											<th><?php echo ucwords($this->lang->line('label_phone'));?></th>
											<th><?php echo ucwords($this->lang->line('label_status'));?></th>
											<th><?php echo ucwords($this->lang->line('label_date'));?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $lead->firstname.' '.$lead->lastname; ?></td>
											<td><?php echo $this->session->userdata('full_name'); ?></td>
											<td><?php echo $lead->Email; ?></td>
											<td><?php echo $lead->Phone; ?></td>
											<td><?php echo ($lead->Status) ? 'Active' : 'Pending';?> </td>
											<td><?php echo date('Y-m-d', strtotime($lead->StartDate)); ?></td>
										</tr>
									</tbody>
								</table>
								<form method="post" action="<?php echo base_url().'user/lead/status';?>">
									<div class="form-group">
										<div class="col-md-10" style="margin-bottom: 10px;">
										<select id="lead_status" name="lead_status" class="form-control">
	                                        <option value="" selected="selected"><?php echo $this->lang->line('label_status'); ?></option>
	                                        <option value="0" <?php if($lead->Status==0) echo 'selected';?>>Pending</option>
	                                        <option value="1" <?php if($lead->Status==1) echo 'selected';?>>Active</option>
	                                    </select>
	                                    </div>
	                                </div>
									<br/>

									<div class="form-group">
										<div class="col-sm-offset-10 col-sm-10">
											<button class="btn btn-primary" id="" type="submit">Update</button>
										</div>
									</div>
									<input type="hidden" name="LeadId" value="<?php echo $lead->LeadId;?>"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="control-sidebar-bg"></div>
	</div>
<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/jquery-ui.min.js"></script>

<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
</body>
</html>