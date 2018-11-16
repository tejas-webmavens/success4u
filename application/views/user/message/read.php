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

<div class="wrapper">
		<?php $this->load->view('user/user_header');?>
    <?php $this->load->view('user/user_aside');?>
		
		<div class="content-wrapper">
			<section class="content">
					
				<?php $this->load->view('user/pagelink');?>
				
				
				<div class="row">
					<?php $this->load->view('user/message/msgnav');?>
				    <div class="col-md-9">
	              <div class="box box-primary">
	                <div class="box-header with-border">
	                  <h3 class="box-title">Read Message</h3>
	                  <div class="box-tools pull-right">
	                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
	                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
	                  </div>
	                </div><!-- /.box-header -->
	                <div class="box-body no-padding">
                  <?php 
                  // print_r($messages);
                      foreach ($messages as $message) {
                        // if($message->SenderId==$this->session->MemberID || $message->MemberId==$this->session->MemberID)

                        $receiver = $this->common_model->GetCustomer($message->MemberId);
                        $sender = $this->common_model->GetCustomer($message->SenderId);

                        if($message->SenderId==$this->session->MemberID) {
                          $to_email = $receiver->Email;
                          $to_name = $receiver->FirstName;
                        } else {
                          $from_email = $sender->Email;
                          $from_name = $sender->FirstName;
                        }
                    ?>
    	                  <div class="mailbox-read-info">
    	                    <h3><?php echo $message->Subject; ?></h3>
                          <?php if($message->SenderId==$this->session->MemberID) { ?>
    	                     <h5>To: <?php echo $to_email;?> <span class="mailbox-read-time pull-right"><?php echo date('Y-m-d H:i:s',strtotime($message->DateAdded));?></span></h5>
                          <?php } else { ?>
                            <h5>From: <?php echo $from_email;?> <span class="mailbox-read-time pull-right"><?php echo date('Y-m-d H:i:s',strtotime($message->DateAdded));?></span></h5>                          
                          <?php } ?> 

    	                  </div><!-- /.mailbox-read-info -->
	                  
                    
    	                  <div class="mailbox-read-message">
                        <?php if($message->SenderId!=$this->session->MemberID) {?>
                          <p><?php echo "Hello ".$this->session->userdata('full_name');?>,</p>
                        <?php } ?>

    	                    <?php echo $message->Message; ?>
    	                  </div><!-- /.mailbox-read-message -->
	                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <?php if($message->Attatchement) { ?>
                    <ul class="mailbox-attachments clearfix">
                      <li>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <div class="mailbox-attachment-info">
                          <a target="_blank" href="<?php echo base_url().'uploads/message/'.$message->Attatchement;?>" download ><i class="fa fa-download"></i> Download</a>
                         
                          <span class="mailbox-attachment-size">
                            1,245 KB
                            <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                          </span>
                        </div>
                      </li>
                      <?php } ?>
                      
                    </ul>
                  </div>
                <?php
                      }
                        
                    ?>
                
              </div>
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
