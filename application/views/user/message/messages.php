<!DOCTYPE html>
<html>
	<head>
	 <?php $this->load->view('user/meta');?>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
					<?php $this->load->view('user/userinfo');?>
				
					<div class="row">
						<?php $this->load->view('user/message/msgnav');?>
						<div class="col-md-9">
			              <div class="box box-primary">
			                <div class="box-header with-border">
			                  <h3 class="box-title"><?php echo $page_title;?></h3>
			                 
							 <div class="box-tools">
			                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			                  </div>
							  <!-- /.box-tools -->
			                </div><!-- /.box-header -->
			                <div class="box-body col-lg-12">
			                  <div class="mailbox-controls">
			                    <!-- Check all button -->
			                    <!-- <label class="option block mn">
	                                <input type="checkbox" name="selectall" value="" id="selectall">
	                                <span class="checkbox mn"></span>
	                            </label> -->
			                    <button onclick="$('.case:checkbox').prop('checked', true);" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
			                    <button onclick="$('.case:checkbox').prop('checked', false);" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square"></i></button>

			                    <?php if($page_title!='trash') { ?>
				                    <div class="btn-group">
				                      <button class="btn btn-default btn-sm" onclick="deleteAll()"><i class="fa fa-trash-o"></i></button>
				                    </div>
			                    <?php } ?>
								
			                    <button class="btn btn-default btn-sm" onclick="refreshPage()"><i class="fa fa-refresh"></i></button>
			                    <div class="pull-right">
								
			                      <!-- 1-50/200 -->
			                      <div class="btn-group">
			                      <?php echo $links;?>
			                        <!-- <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
			                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button> -->
									
			                      </div><!-- /.btn-group -->
			                    </div><!-- /.pull-right -->
			                  </div>
			                  <?php
			                  	// print_r($this->data['messages']);
			                  ?>
			                  <div class="table-responsive mailbox-messages">
			                  <form id="form-message" action="<?php echo base_url();?>user/message/deleteall" method="post">
			                    <table class="table table-hover table-striped">
			                      <tbody>
			                      <?php

			                      	if($messages) {
			                      		foreach ($messages as $row) {
			                      			if($page_title=='inbox') {
			                      				$customer = $this->common_model->GetCustomer($row->SenderId);	
			                      			} else {
			                      				$customer = $this->common_model->GetCustomer($row->MemberId);
			                      			}
			                      			
			                      			if($customer) {
			                      ?>
				                      	<tr>
				                          <td><input name="message[]" class="case" type="checkbox" value="<?php echo $row->MailId;?>"></td>
				                          <td class="mailbox-star"><a href="<?php echo base_url().'user/message/read/'.$row->MailId;?>"><i class="fa fa-star text-yellow"></i></a></td>
				                          <td class="mailbox-name"><a href="<?php echo base_url().'user/message/read/'.$row->MailId;?>"><?php echo ($customer->Email) ? $customer->Email : '';?></a></td>
				                          <td class="mailbox-subject"><?php echo $row->Subject;?></td>
				                          <td class="mailbox-attachment"><?php echo ($row->Attatchement) ? '<i class="fa fa-paperclip"></i>' : '';?></td>
				                          <td class="mailbox-date"><?php echo date('F-d-y H:i:s', strtotime($row->DateAdded));?> </td>
				                          
				                        </tr>
			                      		
			                      <?php 
			                  				}
			                  			}  

			                      	} else { 

			                      ?>
			                      <tr><td colspan="6" class="text-center">No messages found!</td></tr>

			                      <?php } ?>
			                        
			                      </tbody>
			                    </table><!-- /.table -->
			                   </form>
			                  </div><!-- /.mail-box-messages -->
			                </div><!-- /.box-body -->
			                <div class="box-footer ">
			                  <div class="mailbox-controls">
			                    <div class="pull-right">
			                      <!-- 1-50/200 -->
			                      <div class="btn-group">
			                        <?php echo $links;?>
			                      </div><!-- /.btn-group -->
			                    </div><!-- /.pull-right -->
			                  </div>
			                </div>
			              </div><!-- /. box -->
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
		  function refreshPage() {
		  	location.reload();
		  }
		  	$("#selectall").on('click',function(){
			    var chk=$('#selectall:checked').length ? true : false;
			    if(chk){
			        $('.case').prop('checked',true);
			    } else {
			        $('.case').prop('checked',false);
			    }
			});

			function deleteAll(){
			    if($('.case:checked').length) {
			     confirm('Are you sure?') ? $('#form-message').submit() : false;
			    }
			}
		</script>

	</body>
</html>
