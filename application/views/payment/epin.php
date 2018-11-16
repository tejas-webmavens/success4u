<div id="confirm-content" class="panel-collapse">
<?php

    if(isset($register)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
        <form method="post" action="<?php echo base_url()?>user/register/checkepin/<?php echo $MemberId;?>" >
        <div class="buttons">
        <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="confirm">
        </div>
        </div>
        </form>
  <?php
  }
    if(isset($board)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
        <form method="post" action="<?php echo base_url()?>user/board/process/<?php echo $MemberId;?>" >
        <input type="text" name="epincode" required >
        <div class="buttons">
        <div class="pull-right">
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
        <form method="post" action="<?php echo base_url()?>user/register/subepin/<?php echo $MemberId;?>" >
        <div class="buttons">
        <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="confirm">
        </div>
        </div>
        </form>
  <?php
    }
    if(isset($upgrade)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
     <!--  <form method="post" action="<?php echo base_url()?>user/register/checkepin/<?php echo $MemberId;?>" >
        <div class="buttons">
        <div class="pull-right">
          <input type="submit" class="btn btn-primary" value="confirm">
        </div>
      </div>
      </form> -->
       <div style="float: left;">
          <form action="<?php echo base_url()?>user/upgrade/checkepin/<?php echo $MemberId;?>" id="form-register" name="registerform" class="form" method="post">
             <div class="dshfrom">
             <h3>Enter epin code <sup><em class="state-error1">*</em></sup></h3>
           <input type="text" name="epincode" required >
           <input type="hidden" name="check" value="check">
           <input type="hidden" name="package" value="<?php echo $PackageId?>">
          <input type="submit" value="<?php echo  ucwords('upgradenow'); ?>"/>
           </div>
            </form>
       </div>
  <?php
    }?>
    


</form>
</div>
</div>