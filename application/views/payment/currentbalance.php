<div id="confirm-content" class="panel-collapse">
<?php

    if(isset($register)) {
  ?>
  
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
        <form method="post" action="<?php echo base_url()?>user/register/checkbankwire/<?php echo $Memberid;?>" >
        <div class="buttons">
        <div class="pull-right">
        <input type="hidden" name="amount" value="<?echo $amount;?>">
        <input type="submit" class="btn btn-primary" value="confirm">
        </div>
        </div>
        </form>
  <?php
    }
    if(isset($subscription)) {
  ?>
  
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
        <form method="post" action="<?php echo base_url()?>user/register/subbankwire/<?php echo $Memberid;?>" >
        <div class="buttons">
        <div class="pull-right">
        <input type="hidden" name="amount" value="<?echo $amount;?>">
        <input type="submit" class="btn btn-primary" value="confirm">
        </div>
        </div>
        </form>
  <?php
    }
    if(isset($upgrade)) {
      $MemberId=$this->session->MemberID;
      $bal=$this->common_model->Getcusomerbalance($MemberId);
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo currency().number_format($amount,2);?></span></strong></h3>
     
      <h2>Payment Details</h2>

      <?php 
    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
      ?>
       <form name="bankwirefrm" id="bankwirefrm" action="<?echo base_url();?>user/upgrade/checkbalance/<?echo $MemberId;?>" method="post" enctype="multipart/form-data" autocomplete="off" >
           <hr class="hrzntl"/>

           <h3>Your Current Balance<sup><em class="state-error">*</em></sup></h3>
           <div id="#bal">
           <input type="text" name="current" value="<?php echo $bal;?>" readonly>
           <h4><?echo form_error('current');?></h4>
           </div>
           <div class="buttons">
        <div class="pull-right">
             <input type="submit" class="btn btn-primary" value="submit">   
             </div></div>  
             <input  type="hidden" name="check" value="check">
             <input type="hidden" name="package" value="<?echo $packageid;?>">
             <input  type="hidden" name="paymentamount" value="<?echo $amount; ?>">
             <input type="hidden" name="memberid" value="<?echo $MemberId; ?>">
             <input type="hidden" name="payto" value="<?php if(isset($paydetail->UserName)) { echo ucfirst($paydetail->UserName); } else{ echo ""; } ?>">                           
            
        </form>

  <?php
    }?>



</form>
</div>
</div>