<div class="allcp-form theme-primary">
    <span class="allcp-form pull-right"><?php echo  ucwords($this->lang->line('cleardbnote')); ?> </span>

    <div class="section row mb10">
        <label for="matrixstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('cleardb')); ?></label>

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

    <?php if(isset($matrixdetails->MatchingPair)) {  $data = explode(':', $matrixdetails->MatchingPair); } ?>

    <div class="section row mb10">
        <label for="matrixstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('matrixstatus')); ?></label>

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
            <?php echo form_error('matrixstatus'); ?>
        </div>
    </div>

    <div class="section row mb10">
        <label for="matrixposition" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('matrixposition')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->Position)){if($matrixdetails->Position=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="position">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('on'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->Position)){if($matrixdetails->Position=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="position">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('off'))?>
                </label>
            </div>
            <label for="matrixstatus" class="field-icon"> </label>
            <?php echo form_error('matrixposition'); ?>

        </div>
    </div>

    <div class="section row mb10">
        <label for="matrixposition" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('matrixupline')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->MatrixUpline)){if($matrixdetails->MatrixUpline=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="MatrixUpline">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('on'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->MatrixUpline)){if($matrixdetails->MatrixUpline=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="MatrixUpline">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('off'))?>
                </label>
            </div>
            <label for="matrixstatus" class="field-icon">
            </label>
            <?php echo form_error('matrixposition'); ?>
        </div>
    </div>

    <div class="section row mb10">
        <label for="carryforward" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('carryforward')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->CarryForward)){if($matrixdetails->CarryForward=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="carryforward">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('on'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->CarryForward)){if($matrixdetails->CarryForward=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="carryforward">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('off'))?>
                </label>
            </div>
            <label for="carryforward" class="field-icon"> </label>
            <?php echo form_error('carryforward'); ?>
        </div>
    </div>

    <div class="section row mb10">
        <label for="commissionprocess" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('commissionprocess')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->CarryForward)){if($matrixdetails->CarryForward=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="commissionprocess">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('day'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->CarryForward)){if($matrixdetails->CarryForward=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="commissionprocess">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('immediate'))?>
                </label>
            </div>
            <label for="commissionprocess" class="field-icon">
            </label>
            <?php echo form_error('commissionprocess'); ?>
        </div>
    </div>

    <div class="section row mb10">
        <label for="matrixwidth" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('matrixwidth')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

        <div class="col-sm-5 ph10">
            <label for="matrixwidth" class="field prepend-icon">
                <input type="text" name="matrixwidth" id="matrixwidth" placeholder="<?php echo  ucwords($this->lang->line('matrixwidth')); ?>"
                class="gui-input" readonly value="<?php echo set_value('matrixwidth', isset($matrixdetails->MatrixWidth) ? $matrixdetails->MatrixWidth : '');?>" >
                <label for="matrixwidth" class="field-icon">
                    <i class="fa fa-money"></i>
                </label>
            </label>
            <?php echo form_error('matrixwidth'); ?>
        </div>
    </div>
    <div class="section row mb10">
        <label for="matrixdepth" class="field-label col-sm-3 ph10 text-left"> <?php echo  ucwords($this->lang->line('matrixdepth')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

        <div class="col-sm-5 ph10">
            <label for="matrixdepth" class="field prepend-icon">
                <input type="text" name="matrixdepth" id="matrixdepth" class="gui-input"  placeholder="<?php echo  ucwords($this->lang->line('matrixdepth')); ?>" value="<?php echo set_value('matrixdepth', isset($matrixdetails->MatrixDepth) ? $matrixdetails->MatrixDepth : '');?>">
                <label for="matrixdepth" class="field-icon">
                    <i class="fa fa-money"></i>
                </label>
            </label>
            <?php echo form_error('matrixdepth'); ?>
        </div>
    </div>

    <div class="section row mb10">
        <label for="changedirect" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('changedirect')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->ChangeDirect)=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="changedirect">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('on'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if($matrixdetails->ChangeDirect=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="changedirect">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('off'))?>
                </label>
            </div>
            <label for="changedirect" class="field-icon">

            </label>
            <?php echo form_error('changedirect'); ?>
        </div>
    </div>

    <div class="section row mb10">
        <label for="freemember" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('freemember')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">

                    <input type="radio" <?php if(isset($matrixdetails->FreeMember)){if($matrixdetails->FreeMember=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="freemember">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('on'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->FreeMember)){if($matrixdetails->FreeMember=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="freemember">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('off'))?>
                </label>
            </div>
            <label for="freemember" class="field-icon">

            </label>
            <?php print_r(form_error());
            echo form_error('freemember'); ?>

        </div>
    </div>

    <div class="section row mb10">
    <label for="rankstatus"
    class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('rankstatus')); ?></label>

    <div class="col-sm-9 ph10">

       <div class="option-group field">
        <label class="col-md-4 block mt15 option option-primary">

            <input type="radio" <?php if(isset($matrixdetails->RankStatus)){if($matrixdetails->RankStatus=='1'){ echo "checked='checked'";}else {echo'';}}?> value='1' name="rankstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('on'))?>
        </label>

        <label class="col-md-4 block mt15 option option-primary">
            <input type="radio" <?php if(isset($matrixdetails->RankStatus)){if($matrixdetails->RankStatus=='0'){ echo "checked='checked'"; } else {echo'';}}?> value='0' name="rankstatus">
            <span class="radio"></span>
            <?php echo  ucwords($this->lang->line('off'))?>
        </label>
    </div>
    <label for="rankstatus" class="field-icon">

    </label>
    <?php print_r(form_error());
    echo form_error('rankstatus'); ?>

</div>
</div>


    <div class="section row mb10">
        <label for="earncommisionstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('earncommisionstatus')); ?></label>

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
        <label for="levelcommissionstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('levelcommissionstatus')); ?></label>

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
        <label for="levelcommissiontype" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('levelcommissiontype')); ?></label>

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
        <label for="directcommissionstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('directcommissionstatus')); ?></label>

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
        <label for="directcommissiontype" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('directcommissiontype')); ?></label>

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
        <label for="owncommissionstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('owncommissionstatus')); ?></label>

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
        <label for="owncommissiontype" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('owncommissiontype')); ?></label>

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
        <label for="matrixcommission" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('matrixcommission')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if(isset($matrixdetails->MatrixCommission)=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="matrixcommission">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('levelcompletedcommission'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if($matrixdetails->MatrixCommission=='2') { echo "checked='checked'"; } else {echo'';}?> value='2' name="matrixcommission">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('matrixcompletedcommission'))?>
                </label>
            </div>
            <label for="matrixcommission" class="field-icon">

            </label>
            <?php echo form_error('matrixcommission'); ?>

        </div>
    </div>

    <div class="section row mb10">
        <label for="repeatcommissionstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('repeatcommissionstatus')); ?></label>

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

    <div class="section row mb10">
        <label for="spilloversystem" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('spilloversystem')); ?></label>

        <div class="col-sm-9 ph10">

            <div class="option-group field">
                <label class="col-md-4 block mt15 option option-primary">

                    <input type="radio" <?php if(isset($matrixdetails->SpilloverSystem)=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="spilloversystem">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('spreadevenly'))?>
                </label>

                <label class="col-md-4 block mt15 option option-primary">
                    <input type="radio" <?php if($matrixdetails->SpilloverSystem=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="spilloversystem">
                    <span class="radio"></span>
                    <?php echo  ucwords($this->lang->line('fifo'))?>
                </label>
            </div>
            <label for="spilloversystem" class="field-icon">

            </label>
            <?php echo form_error('spilloversystem'); ?>

        </div>
    </div>

    <div class="section row mb10">
        <label for="recyclestatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('recyclestatus')); ?></label>

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
            <?php echo form_error('recyclestatus'); ?>

        </div>
    </div>

    <div class="section row mb10">
        <label for="pair" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('pair')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

        <div class="col-sm-7 ph10">
            <div class="col-sm-3 ph10">
                <label for="lpair" class="field prepend-icon">
                    <input type="text" name="lpair" id="lpair" placeholder="<?php echo  ucwords($this->lang->line('leftpair')); ?>"
                    class="gui-input" value="<?php echo set_value('lpair', isset($data[0]) ? $data[0] : '');?>" >
                    <label for="lpair" class="field-icon">
                        <i class="fa fa-money"></i>
                    </label>
                </label>
                <?php echo form_error('lpair');?>
            </div>
            <div class="col-sm-3 ph10">
                <label for="rpair" class="field prepend-icon">
                    <input type="text" name="rpair" id="rpair" placeholder="<?php echo  ucwords($this->lang->line('rightpair')); ?>"
                    class="gui-input" value="<?php echo set_value('rpair', isset($data[1]) ? $data[1] : '');?>" >
                    <label for="rpair" class="field-icon">
                        <i class="fa fa-money"></i>
                    </label>
                </label>
                <?php echo form_error('rpair');?>
            </div>
            <?php echo form_error('pair');?>
        </div>
    </div>

    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
    </div>

</div>