 <?php //print_r($matrixdetails);  ?>
 <div class="allcp-form theme-primary">
<span class="allcp-form pull-right"><?php echo  ucwords($this->lang->line('cleardbnote')); ?> </span>


<div class="section row mb10">
    <label for="matrixstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('cleardb')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio"  value='1' name="cleardb" class="cleardb">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('yes'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" checked value='0' name="cleardb" class="cleardb">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('no'))?>
        </label>
    </div>
    <label for="cleardb" class="field-icon">

    </label>
    

</div>
</div>


<div class="section row mb10">
    <label for="matrixstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('matrixstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->MatrixStatus)){if($matrixdetails->MatrixStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="matrixstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->MatrixStatus)){if($matrixdetails->MatrixStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="matrixstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="matrixstatus" class="field-icon">

    </label>
    <?php print_r(form_error());
    echo form_error('matrixstatus'); ?>

</div>
</div>

    <!-- <div class="section row mb10">
        <label for="matrixwidth" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('matrixwidth')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

        <div class="col-sm-5 ph10">
            <label for="matrixwidth" class="field prepend-icon">
                <input type="text" name="matrixwidth" id="matrixwidth" placeholder="<?php echo  ucwords($this->lang->line('matrixwidth')); ?>"
                class="gui-input" value="<?php echo set_value('matrixwidth', isset($matrixdetails->MatrixWidth) ? $matrixdetails->MatrixWidth : '');?>" >
                <label for="matrixwidth" class="field-icon">
                    <i class="fa fa-money"></i>
                </label>
            </label>
            <?php echo form_error('matrixwidth'); ?>
        </div>
    </div>
    <div class="section row mb10">
        <label for="matrixdepth"
        class="field-label col-sm-3 ph10 text-left"> <?php echo  ucwords($this->lang->line('matrixdepth')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

        <div class="col-sm-5 ph10">
            <label for="matrixdepth" class="field prepend-icon">
                <input type="text" name="matrixdepth" id="matrixdepth"
                class="gui-input"  placeholder="<?php echo  ucwords($this->lang->line('matrixdepth')); ?>"
                value="<?php echo set_value('matrixdepth', isset($matrixdetails->MatrixDepth) ? $matrixdetails->MatrixDepth : '');?>">
                <label for="matrixdepth" class="field-icon">
                    <i class="fa fa-money"></i>
                </label>
            </label>
            <?php echo form_error('matrixdepth'); ?>
        </div>
    </div>
 -->
    

<div class="section row mb10">
    <label for="membertomemberpaystatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('mtompay')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->MTMPayStatus)){if($matrixdetails->MTMPayStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="membertomemberpaystatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->MTMPayStatus)){if($matrixdetails->MTMPayStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="membertomemberpaystatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="freemember" class="field-icon">

    </label>
    <?php print_r(form_error());
    echo form_error('membertomemberpaystatus'); ?>

</div>
</div> 

<div class="section row mb10">
    <label for="earncommisionstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('earncommisionstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->EarnCommisionStatus)) { if($matrixdetails->EarnCommisionStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="earncommisionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('afterupgrade'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->EarnCommisionStatus)) { if($matrixdetails->EarnCommisionStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="earncommisionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('aftersignup'))?>
        </label>
    </div>
    <label for="earncommisionstatus" class="field-icon">

    </label>
    <?php echo form_error('earncommisionstatus'); ?>

</div>
</div>


<div class="section row mb10">
    <label for="levelcommissionstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('levelcommissionstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->LevelCommissionStatus)) {if($matrixdetails->LevelCommissionStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="levelcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->LevelCommissionStatus)) {if($matrixdetails->LevelCommissionStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="levelcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="levelcommissionstatus" class="field-icon">

    </label>
    <?php echo form_error('levelcommissionstatus'); ?>

</div>
</div>


<div class="section row mb10">
    <label for="levelcommissiontype"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('levelcommissiontype')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->LevelCommissionType)){if($matrixdetails->LevelCommissionType=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="levelcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('amount'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->LevelCommissionType)){if($matrixdetails->LevelCommissionType=='2'){ echo "checked='checked'"; } else {echo'';}}?> value='2' name="levelcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('percentage'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->LevelCommissionType)){if($matrixdetails->LevelCommissionType=='3'){ echo "checked='checked'"; } else {echo'';}}?> value='3' name="levelcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('points'))?>
        </label>

    </div>
    <label for="levelcommissiontype" class="field-icon">

    </label>
    <?php echo form_error('levelcommissiontype'); ?>

</div>
</div>


<div class="section row mb10">
    <label for="directcommissionstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('directcommissionstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->DirectCommissionStatus)){if($matrixdetails->DirectCommissionStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="directcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->DirectCommissionStatus)){if($matrixdetails->DirectCommissionStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="directcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="directcommissionstatus" class="field-icon">

    </label>
    <?php echo form_error('directcommissionstatus'); ?>

</div>
</div>

<div class="section row mb10">
    <label for="directcommissiontype"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('directcommissiontype')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->DirectCommissionType)){if($matrixdetails->DirectCommissionType=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="directcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('amount'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->DirectCommissionType)){if($matrixdetails->DirectCommissionType=='2'){  echo "checked='checked'"; } else {echo'';}}?> value='2' name="directcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('percentage'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->DirectCommissionType)){if($matrixdetails->DirectCommissionType=='3'){  echo "checked='checked'"; } else {echo'';}}?> value='3' name="directcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('points'))?>
        </label>

    </div>
    <label for="directcommissiontype" class="field-icon">

    </label>
    <?php echo form_error('directcommissiontype'); ?>

</div>
</div>

<div class="section row mb10">
    <label for="owncommissionstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('owncommissionstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->OwnCommissionStatus)){if($matrixdetails->OwnCommissionStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="owncommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->OwnCommissionStatus)){if($matrixdetails->OwnCommissionStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="owncommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="owncommissionstatus" class="field-icon">

    </label>
    <?php echo form_error('owncommissionstatus'); ?>

</div>
</div>

<div class="section row mb10">
    <label for="owncommissiontype"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('owncommissiontype')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->OwnCommissionType)=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="owncommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('amount'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if($matrixdetails->OwnCommissionType=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="owncommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('percentage'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if($matrixdetails->OwnCommissionType=='3') { echo "checked='checked'"; } else {echo'';}?> value='3' name="owncommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('points'))?>
        </label>

    </div>
    <label for="owncommissiontype" class="field-icon">

    </label>
    <?php echo form_error('owncommissiontype'); ?>

</div>
</div>


<div class="section row mb10">
    <label for="boardcommissionstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('boardcommissionstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->BoardCommissionstatus)){if($matrixdetails->BoardCommissionStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="boardcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->BoardCommissionstatus)){if($matrixdetails->BoardCommissionStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="boardcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="boardcommissionstatus" class="field-icon">

    </label>
    <?php echo form_error('boardcommissionstatus'); ?>

</div>
</div>

<div class="section row mb10">
    <label for="boardcommissiontype"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('boardcommissiontype')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if($matrixdetails->BoardCommissionType=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="boardcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('amount'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if($matrixdetails->BoardCommissionType=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="boardcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('percentage'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if($matrixdetails->BoardCommissionType=='3') { echo "checked='checked'"; } else {echo'';}?> value='3' name="boardcommissiontype">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('points'))?>
        </label>

    </div>
    <label for="boardcommissiontype" class="field-icon">

    </label>
    <?php echo form_error('boardcommissiontype'); ?>

</div>
</div>


<div class="section row mb10">
    <label for="repeatcommissionstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('repeatcommissionstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->RepeatCommissionStatus)=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="repeatcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('creditonce'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if($matrixdetails->RepeatCommissionStatus=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="repeatcommissionstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('creditboth'))?>
        </label>
    </div>
    <label for="repeatcommissionstatus" class="field-icon">

    </label>
    <?php echo form_error('repeatcommissionstatus'); ?>

</div>
</div>


<!-- 
<div class="section row mb10">
    <label for="recyclestatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('recyclestatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if($matrixdetails->RecycleStatus=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="recyclestatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if($matrixdetails->RecycleStatus=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="recyclestatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="recyclestatus" class="field-icon">

    </label>
    <?php print_r(form_error());
    echo form_error('recyclestatus'); ?>

</div>
</div>
 -->



<div class="panel-footer text-right">
    <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
<!--                                 <button type="reset" class="btn btn-bordered mb5"><?php echo  ucwords($this->lang->line('cancel')); ?></button>
-->                            </div>


</div>