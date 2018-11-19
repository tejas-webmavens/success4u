<div id="confirm-content" class="panel-collapse">
<?php

    if(isset($register)) {
  ?>
  
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo number_format($amount,2);?></span></strong></h3>
        <form method="post" action="<?php echo base_url()?>user/register/checkbankwire/<?php echo $Memberid;?>" >
        <div class="buttons">
        <div class="pull-right">
        <input type="hidden" name="amount" value="<?php echo  $amount;?>">
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
        <input type="hidden" name="amount" value="<?php echo  $amount;?>">
        <input type="submit" class="btn btn-primary" value="confirm">
        </div>
        </div>
        </form>
  <?php
    }
    if(isset($upgrade)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo currency().number_format($amount,2);?></span></strong></h3>
     
      <h2>Payment Details</h2>

      <?php 
    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
       if($mlsetting->Id==8){
        $cusdata = json_decode($paydetail->CustomFields); 
        if(isset($cusdata->bankwireacno)) { if($cusdata->bankwireacno){ $bankwire = $cusdata->bankwireacno;}else{ $bankwire = "NIL";} } else {$bankwire = "NIL";}

       ?>

         <hr class="hrzntl"/>
            <?php echo  "<h3>Pay to: <strong><span>".ucfirst($paydetail->UserName)."</span></strong></h3>
            <h3>Bankwireaccno: <strong><span>".$bankwire."</span></strong></h3>";
            ?>
            <?php } else {?> 
      <hr class="hrzntl"/>
            <?php echo  "<h3>Bankwire MerchantID: <strong><span>".$paydetail->PaymentMerchantId."</span></strong></h3><h3>Merchant Password: <strong><span>".$paydetail->PaymentMerchantPassword."</span></strong></h3><h3>Merchant Key:<strong><span>".$paydetail->PaymentMerchantKey."</span></strong></h3><h3>Merchant Api: <strong><span>".$paydetail->PaymentMerchantApi."</span></strong></h3>";
            ?>
            <?php } ?>
       <form name="bankwirefrm" id="bankwirefrm" action="<?php echo  base_url();?>user/upgrade/checkbankwire/<?php echo  $PackageId;?>" method="post" enctype="multipart/form-data" autocomplete="off" >
           <hr class="hrzntl"/>
           <h3><?php echo  ucwords($this->lang->line('bankwireid'));?>Bankwire Transaction Id <sup><em class="state-error">*</em></sup></h3>
           <input type="text" name="transactionid" required >
           <h4><?php echo  form_error('transactionid');?></h4>
           <h4><?php echo  form_error('memberid');?></h4>
           <h3><?php echo  ucwords($this->lang->line('bankwireref'));?> Bankwire transaction reference <sup><em class="state-error">*</em></sup></h3>
           <input type="file" name="referfile">
           <h4><?php echo  form_error('referfile');?></h4>
           <div class="buttons">
        <div class="pull-right">
             <input type="submit" class="btn btn-primary" value="submit">   
             </div></div>  
             <input  type="hidden" name="checkwire" value="check">
         <!--     <input  type="hidden" name="paymentamount" value="<?php echo  $amount; ?>"> -->
           <input type="hidden" name="paythrough" value="<?php echo $this->input->post('paythrough');?>">
             <input type="hidden" name="memberid" value="<?php echo  $MemberId; ?>">
             <input type="hidden" name="payto" value="<?php if(isset($paydetail->UserName)) { echo ucfirst($paydetail->UserName); } else{ echo ""; } ?>">                           
            
        </form>

  <?php
    }?>

<?php
 $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
  
if($mlsetting->Id==9)
{
   $currency=$this->common_model->GetRow("Status='1'",'arm_currency');
    // $currenysymbol=$currency->CurrencySymbol;
  if(isset($deposit)) {
  ?>
    <h3><?php echo $this->lang->line('package'); ?> : <strong><span><?php echo $package;?></span></strong></h3>
    <!-- <h3> <?php echo $this->lang->line('amount'); ?>: <strong><span><input type="text" name="amount" style="width: 300px;" placeholder="Enter Your Amount"></span></strong></h3> -->
     <h3><?php echo $this->lang->line('amount'); ?> : <strong><span><?php echo $currency->CurrencySymbol." ".number_format($min_amount). " to " ." ". $currency->CurrencySymbol .number_format($max_amount);?></span></strong></h3>
     
      <h2>Payment Details</h2>

      <?php 
    $mlsetting = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting");
       if($mlsetting->Id==8){
        $cusdata = json_decode($paydetail->CustomFields); 
        if(isset($cusdata->bankwireacno)) { if($cusdata->bankwireacno){ $bankwire = $cusdata->bankwireacno;}else{ $bankwire = "NIL";} } else {$bankwire = "NIL";}

       ?>

         <hr class="hrzntl"/>
            <?php echo  "<h3>Pay to: <strong><span>".ucfirst($paydetail->UserName)."</span></strong></h3>
            <h3>Bankwireaccno: <strong><span>".$bankwire."</span></strong></h3>";
            ?>
            <?php } else {?> 
      <hr class="hrzntl"/>
            <?php echo  "<h3>Bankwire MerchantID: <strong><span>".$paydetail->PaymentMerchantId."</span></strong></h3><h3>Merchant Password: <strong><span>".$paydetail->PaymentMerchantPassword."</span></strong></h3><h3>Merchant Key:<strong><span>".$paydetail->PaymentMerchantKey."</span></strong></h3><h3>Merchant Api: <strong><span>".$paydetail->PaymentMerchantApi."</span></strong></h3>";
            ?>
            <?php } ?>
       <form name="bankwirefrm" id="bankwirefrm" action="<?php echo  base_url();?>user/deposit/checkbankwire/<?php echo  $PackageId;?>" method="post" enctype="multipart/form-data" autocomplete="off" >
           <hr class="hrzntl"/>
           <h3><?php echo  ucwords($this->lang->line('bankwireid'));?>Bankwire Transaction Id <sup><em class="state-error">*</em></sup></h3>
           <input type="text" name="transactionid" required >
           <h3><?php echo  ucwords($this->lang->line('bankwireid'));?> Amount <sup><em class="state-error">*</em></sup></h3>
             <input type="text" name="transactionamount" required placeholder="Enter your Amount" >

           <h4><?php echo  form_error('transactionid');?></h4>
           <h4><?php echo  form_error('memberid');?></h4>
           <h3><?php echo  ucwords($this->lang->line('bankwireref'));?> Bankwire transaction reference <sup><em class="state-error">*</em></sup></h3>
           <input type="file" name="referfile">
           <h4><?php echo  form_error('referfile');?></h4>
           <div class="buttons">
        <div class="pull-right">
             <input type="submit" class="btn btn-primary" value="submit">   
             </div></div>  
             <input  type="hidden" name="checkwire" value="check">
           <!--   <input  type="hidden" name="paymentamount" value="<?php echo  $amount; ?>"> -->
             <input type="hidden" name="memberid" value="<?php echo  $MemberId; ?>">
                <input type="hidden" name="package" value="<?php echo  $PackageId; ?>">
             <input type="hidden" name="payto" value="<?php if(isset($paydetail->UserName)) { echo ucfirst($paydetail->UserName); } else{ echo ""; } ?>">                           
            
        </form>

  <?php
    }}?>



</form>
</div>
</div>