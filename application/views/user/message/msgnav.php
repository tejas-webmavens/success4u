<div class="col-md-3">
    <a href="<?php echo base_url();?>user/message/create" class="btn btn-primary btn-block margin-bottom bg-red no-border">Compose</a>
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Folders</h3>
          <div class="box-tools">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
          <?php $usermsgin = $this->db->query("SELECT count(*) as cnt FROM arm_mailbox WHERE MemberId='".$this->session->MemberID."' AND isDelete='0'");?>
          <?php $usermsgout = $this->db->query("SELECT count(*) as cnt FROM arm_mailbox WHERE SenderId='".$this->session->MemberID."' AND isDelete='0'");?>
          <?php $usermsgtrash = $this->db->query("SELECT count(*) as cnt FROM arm_mailbox WHERE isDelete='1' AND (SenderId='".$this->session->MemberID."' OR MemberId='".$this->session->MemberID."')");?>
            <?php 
              if(isset($this->uri->segments[3])){
                switch ($this->uri->segments[3]) {
                  case 'sent':
                    $sent='active'; 
                    $tic='';   
                    $trash = '';
                    break;
                  case 'trash':
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
            <li class="<?php echo  $tic;?>"><a href="<?php echo base_url();?>user/message"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right"><?php echo  $usermsgin->row()->cnt;?></span></a></li>
            <li class="<?php echo  $sent;?>"><a href="<?php echo base_url();?>user/message/sent"><i class="fa fa-envelope-o"></i> Sent <span class="label label-primary pull-right"><?php echo  $usermsgout->row()->cnt;?></span></a></li>
            <!-- <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
            <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li> -->
            <li class="<?php echo  $trash;?>"><a href="<?php echo base_url();?>user/message/trash"><i class="fa fa-trash-o"></i> Trash <span class="label label-primary pull-right"><?php echo  $usermsgtrash->row()->cnt;?></span></a></li>
          </ul>
        </div>
    </div>
</div>