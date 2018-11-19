<div class="col-md-3">
	<a href="<?php echo base_url();?>user/ticket/create" class="btn btn-primary btn-block margin-bottom bg-red no-border">Compose</a>
	<div class="box box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title">Folders</h3>
		  <div class="box-tools">
		    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		  </div>
		</div>
		<div class="box-body no-padding">
		  <ul class="nav nav-pills nav-stacked">
			  <?php $userin = $this->db->query("SELECT count(*) as cnt FROM `arm_ticket` `t` JOIN `arm_ticket_list` `tl` ON `tl`.`TicketId` = `t`.`TicketId` WHERE `tl`.`MemberId` = '".$this->session->MemberID."' AND `t`.`isDelete` = '0'"); ?>
			  <?php $userout = $this->db->query("SELECT count(*) as cnt FROM `arm_ticket` `t` JOIN `arm_ticket_list` `tl` ON `tl`.`TicketId` = `t`.`TicketId` WHERE `tl`.`SenderId` = '".$this->session->MemberID."' AND `t`.`isDelete` = '0' "); ?>
			  <?php $userclosed = $this->db->query("SELECT count(*) as cnt FROM `arm_ticket` `t` JOIN `arm_ticket_list` `tl` ON `tl`.`TicketId` = `t`.`TicketId` WHERE `t`.`Status` ='0' AND (`tl`.`SenderId` = '".$this->session->MemberID."' OR `MemberId` = '".$this->session->MemberID."')"); ?>
		 	<?php 
		 	if(isset($this->uri->segments[3])){
                switch ($this->uri->segments[3]) {
                  case 'sent':
                    $sent='active'; 
                    $tic='';   
                    $trash = '';
                    break;
                  case 'closed':
                    $sent=''; 
                    $tic='';   
                    $trash = 'active';
                    break;
                  default:
                    $tic='active'; 
                    $sent='';
                    $trash = '';
                  break;
                }
              } else {
                $tic='active'; 
                $sent='';
                $trash = '';
              }
		      
		    ?>
		    <li class="<?php echo  $tic;?>"><a href="<?php echo base_url();?>user/ticket"><i class="fa fa-inbox"></i> Inbox <?//print_r($this->uri);?> <span class="label label-primary pull-right"><?php echo  $userin->row()->cnt;?></span></a></li>
		    <li class="<?php echo  $sent;?>"><a href="<?php echo base_url();?>user/ticket/sent"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right"><?php echo  $userout->row()->cnt;?></span></a></li>
		    <li class="<?php echo  $trash;?>"><a href="<?php echo base_url();?>user/ticket/closed"><i class="fa fa-trash-o"></i> Closed <span class="label label-primary pull-right"><?php echo  $userclosed->row()->cnt;?></span></a></li>
		  </ul>
		</div>
	</div>
</div>