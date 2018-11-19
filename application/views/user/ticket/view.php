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
				
				
				<div class="row">
					  <?php $this->load->view('user/ticket/msgnav');?>
            
				    <div class="col-md-9">
              <?php 
                  foreach ($tickets as $ticket) {
                    $customer = $this->common_model->GetCustomer($ticket->SenderId);
              ?>
                <div class="row">
  	              <div class="box box-primary">
  	                <div class="box-header with-border">
  	                  <h3 class="box-title">View Ticket</h3>
  	                  <div class="box-tools pull-right">
  	                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
  	                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
  	                  </div>
  	                </div><!-- /.box-header -->
  	                <div class="box-body no-padding">
    	                  <div class="mailbox-read-info">
    	                    <h3><?php echo $ticket_info->Subject; ?></h3>
    	                    <h5>From: <?php echo $customer->Email;?> <span class="mailbox-read-time pull-right"><?php echo date('Y-m-d H:i:s',strtotime($ticket->DateAdded));?></span></h5>
    	                  </div>
                      
    	                  <div class="mailbox-read-message">
                          <p><?php echo "Hello";?></p>
    	                    <?php echo $ticket->Description; ?>
    	                  </div>
  	                </div>
                    <div class="box-footer">
                      <?php if($ticket->Attatchement) { ?>
                      <ul class="mailbox-attachments clearfix">
                      <li>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <div class="mailbox-attachment-info">
                          <a target="_blank" href="<?php echo base_url().'uploads/ticket/'.$ticket->Attatchement;?>" download ><i class="fa fa-download"></i> Download</a>
                         
                          <span class="mailbox-attachment-size">
                            1,245 KB
                            <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                          </span>
                        </div>
                      </li>
                      <?php } ?>
                      
                      </ul>
                    </div>
                  
                  </div><!-- /. box -->
                </div>
              <?php
                  }
              ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-9">
              <form action="<?php echo base_url();?>user/ticket/view/<?php echo $ticket_info->TicketId;?>" method="post" enctype="multipart/form-data">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                    <?php if($customer->Email!=$this->session->userdata('Email')) { ?>
                      <h3 class="box-title">Reply to <span><?php echo $customer->Email;?></span></h3>
                    <?php } else { ?>
                      <h3 class="box-title">Reply to <span>admin</span></h3>
                    <?php } ?>
                      <div class="box-tools">
                        <span class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></span>
                      </div>
                    </div>
                    <div class="box-body">
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
                    </div>
                    <div class="box-footer">
                      <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
        </div>
        
			</section>
			<div class="control-sidebar-bg"></div>
		</div>
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
