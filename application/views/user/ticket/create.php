<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
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
				<?php //print_r($users);?>
				<div class="section row mb20">
          <?php if($this->session->flashdata('error_message')) { ?>    
              <div class="col-md-12 bg-danger pt10 pb10 ">
                  <span class=""><?php echo $this->session->flashdata('error_message');?></span>
              </div>
          <?php } ?>
          
          <?php if($this->session->flashdata('success_message')) { ?>    
              <div class="col-md-12 bg-success pt10 pb10 ">
                  <span class=""><?php echo $this->session->flashdata('success_message');?></span>
              </div>
          <?php } ?>
        </div>
				<div class="row">
					<?php $this->load->view('user/ticket/msgnav');?>
					<div class="col-md-9">
            <form action="<?php echo base_url();?>user/ticket/create" method="post" enctype="multipart/form-data">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose New Message</h3>
				          <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <!-- <div class="form-group">
	                  <select name="users" class="form-control input-sm">
	                  <option value=""> -- Select -- </option>
	                  <?php
	                  	foreach ($users as $row) { ?>
	                  		<option <?php echo set_select('users');?> value="<?php echo $row->MemberId;?>"><?php echo $row->Email;?></option>
	                  		
	                  <?php }
	                  ?>
	                  </select>
	                    <?php echo form_error('users');?>
                  </div> -->
                  <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="ticket_subject" <?php echo set_value('ticket_subject');?>>
                    <?php echo form_error('ticket_subject');?>
                  </div>
                  <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="description">
                      <?php echo set_value('description');?>
                    </textarea>
                    <?php echo form_error('description');?>
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Attachment
                      <input type="file" name="attachment">
                    </div>
                    <p class="help-block">Max. 2MB</p>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                  <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
		        </form>
		      </div>
				</div>
			</section>

    </div>
		<div class="control-sidebar-bg"></div>
	</div>

<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

<script src="<?php echo base_url();?>assets/user/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
</body>
</html>
