<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.css">

    <!--  CSS - theme  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/skin/default_skin/css/theme.css">

    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">

    <!--  IE8 HTML5 support   -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

    <!--  Customizer  -->
    <?php $this->load->view('admin/customizer');?>
    <!--  /Customizer  -->

    <!--  Body Wrap   -->
    <div id="main">

        <!--  Header   -->
        <?php $this->load->view('admin/topnav');?>
        <!--  /Header   -->

        <!--  Sidebar   -->
        <?php $this->load->view('admin/sidebar');?>

<!--  Main Wrapper  -->
<section id="content_wrapper">

    <!--  Topbar Menu Wrapper  -->
    <?php $this->load->view('admin/toper'); ?>

    <?php $this->load->view('admin/topmenu');?>
    <!--  Content  -->

        <section id="content" class="table-layout animated fadeIn">

                <!--  Column Center  -->
            <div class="chute chute-center">
     
                <div class="mw1000 center-block">

            <!--  General Information  -->
            <div class="panel mb35">
            <form method="post" action="<?php echo base_url();?>admin/withdrawsetting/updatewithdraw" id="allcp-form" enctype="multipart/form-data">
            <!-- <form method="post" action="" id="allcp-form" enctype="multipart/form-data"> -->
                <div class="panel-heading">
                    <span class="panel-title"><?php echo  ucwords($this->lang->line('pagetitle_withdraw')); ?></span>
                </div>
                
                <div class="section row mbn">
                    <?php if($this->session->flashdata('error_message')) { ?>    
                        <div class="col-md-12 bg-danger pt10 pb10 mt10">
                            <span class=""><?php echo ucwords($this->session->flashdata('error_message'));?></span>
                        </div>
                    <?php  unset($_SESSION['error_message']);} ?>
                    
                    <?php if($this->session->flashdata('success_message')) { ?>    
                        <div class="col-md-12 bg-success pt10 pb10 mt10">
                            <span class=""><?php echo ucwords($this->session->flashdata('success_message'));?></span>
                        </div>
                    <?php unset($_SESSION['success_message']);} ?>
                </div>
                <div class="panel-body br-t">
                
                    <div class="allcp-form theme-primary">

                        <div class="section row mb10">
                            <label for="withdrawstatus" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('withdrawstatus')); ?></label>

                            <div class="col-sm-8 ph10">
                                <div class="option-group field">
                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" <?php if(isset($this->data['withdrawstatus'])=='1'){ echo "checked='checked'";}else {echo'';}?> value='1' name="withdrawstatus">
                                        <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('on'))?>
                                    </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" <?php if($this->data['withdrawstatus']=='0') { echo "checked='checked'"; } else {echo'';}?> value='0' name="withdrawstatus">
                                        <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('off'))?>
                                    </label>
                                </div>

                                <label for="withdrawstatus" class="field-icon"> </label>
                                <?php echo form_error('withdrawstatus'); ?>
                                
                            </div>
                        </div>

                        <div class="section row mb10">
                            <label for="withdrawtype" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('withdrawtype')); ?></label>

                            <div class="col-sm-8 ph10">
                                <div class="option-group field">
                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" <?php if(isset($this->data['withdrawtype'])=='weekly'){ echo "checked='checked'";}else {echo'';}?> value='weekly' name="withdrawtype" onclick="changeweeklytype()">
                                        <span class="radio"></span> <?php echo  ucwords($this->lang->line('weekly'))?>
                                    </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" <?php if($this->data['withdrawtype']=='monthly') { echo "checked='checked'"; } else {echo'';}?> value='monthly' name="withdrawtype" onclick="changemonthlytype()">
                                        <span class="radio"></span>
                                            <?php echo  ucwords($this->lang->line('monthly'))?>
                                    </label>
                                </div>
                                <label for="withdrawtype" class="field-icon"> </label>
                                <?php echo form_error('withdrawtype'); ?>
                            </div>
                        </div>
                        
                        <?php 
                            if($this->data['withdrawtype']=='weekly') {
                        ?>
                        <div class="section row mb10" id="weekly" style="display: block;">
                        <?php }else { ?> 
                            <div class="section row mb10" id="weekly" style="display: none;">
                       <?php }?>
                            <label for="withdrawdate1" class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('withdrawdate')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                           
                            <div class="col-sm-8 ph10">
                            <label for="withdrawdate1" class="field select">
                                <select id="withdrawdate1" name="withdrawdate1">
                                <?php 
                                $weekdays = array(1=>'sunday',2=>'monday',3=>'tuesday',4=>'wednesday',5=>'thursday',6=>'friday',7=>'saturday');
                                ?> 
                                <option value=""><?php echo  ucwords($this->lang->line('choose')); ?></option>
                                <?php  for($i=1;$i<=count($weekdays);$i++)
                                {                  $day=""; $day='weekday'.$i; ?>
                                <option value="<?php echo $weekdays[$i];?>" <?php if($this->data['withdrawdate'] == $weekdays[$i]) { echo "selected='selected'";} ?> ><?php echo  ucwords($this->lang->line($day));?></option>

                                <?php
                                 }
                                ?>
                                                      

                                </select> <i class="arrow double"></i> 
                            </label>

                            <label for="withdrawdate1" class="field-icon">
                                <i class="fa "></i>
                            </label>
                            <?php echo form_error('withdrawdate1'); ?>
                            </div>
                        </div>


                        <?php if($this->data['withdrawtype']=='monthly'){?>
                        <div class="section row mb10" id="monthly" style="display: block;">
                        <?php } else { ?> 
                            <div class="section row mb10" id="monthly" style="display: none;">
                       <?php }?>
                            <label for="withdrawdate2"
                            class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('withdrawdate')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>
                           
                            <div class="col-sm-8 ph10">
                            <label for="withdrawdate2" class="field select">
                                <select id="withdrawdate2" name="withdrawdate2">
                                <option value=""><?php echo  ucwords($this->lang->line('choose')); ?></option>
                                <?php

                               for($i=1; $i<29; $i++) 
                            { ?>
                                

                                <option value="<?php echo $i;?>" <?php if($i == $this->data['withdrawdate']) { echo "selected='selected'";} ?> ><?php echo  ucwords($i)?></option>
                           <?php } ?>
                                 

                                ?>
                                </select>
                                <i class="arrow double"></i>
                            </label>

                            <label for="withdrawdate2" class="field-icon">
                                <i class="fa "></i>
                            </label>
                            <?php echo form_error('withdrawdate2'); ?>
                            </div>
                        </div>
                        

                        <div class="section row mb10">
                            <label for="minwithdraw" class="field-label col-sm-3 ph10  text-left"><?php echo  ucwords($this->lang->line('minamount')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                            <div class="col-sm-8 ph10">
                                <label for="minwithdraw" class="field prepend-icon">
                                    <input type="text" name="minwithdraw" id="minwithdraw" placeholder="<?php echo  ucwords($this->lang->line('minwithdraw')); ?>"
                                    class="gui-input" value="<?php echo set_value('minwithdraw', isset($this->data['minwithdraw']) ? $this->data['minwithdraw'] : '');?>" >
                                    <label for="minwithdraw" class="field-icon">
                                        <i class="fa fa-money"></i>
                                    </label>
                                </label>
                                 <?php echo form_error('minwithdraw'); ?>
                            </div>
                        </div>
                        <div class="section row mb10">
                            <label for="maxwithdraw"
                            class="field-label col-sm-3 ph10 text-left"> <?php echo  ucwords($this->lang->line('maxamount')); ?></label>

                            <div class="col-sm-8 ph10">
                                <label for="maxwithdraw" class="field prepend-icon">
                                    <input type="text" name="maxwithdraw" id="maxwithdraw"
                                    class="gui-input"  placeholder="<?php echo  ucwords($this->lang->line('maxwithdraw')); ?>"
                                    value="<?php echo set_value('maxwithdraw', isset($this->data['maxwithdraw']) ? $this->data['maxwithdraw'] : '');?>">
                                    <label for="maxwithdraw" class="field-icon">
                                        <i class="fa fa-money"></i>
                                    </label>
                                </label>
                                <?php echo form_error('maxwithdraw'); ?>
                            </div>
                        </div>
                        <div class="section row mb10">
                            <label for="adminwithdrawfee"
                            class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('adminwithdrawfee')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                            <div class="col-sm-8 ph10">
                                <label for="adminwithdrawfee" class="field prepend-icon">
                                    <input type="text" name="adminwithdrawfee" id="adminwithdrawfee"
                                    class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('adminwithdrawfee')); ?>"
                                    value="<?php echo set_value('adminwithdrawfee', isset($this->data['adminwithdrawfee']) ? $this->data['adminwithdrawfee'] : '');?>">
                                    <label for="adminwithdrawfee" class="field-icon">
                                        <i class="fa fa-money"></i>
                                    </label>
                                </label>
                                 <?php echo form_error('adminwithdrawfee'); ?>
                            </div>
                        </div>


                        <div class="section row mb10">
                            <label for="adminwithdrawfeetype"
                            class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('adminwithdrawfeetype')); ?></label>

                            <div class="col-sm-8 ph10">
                                                    
                                 <div class="option-group field">
                            <label class="col-md-3 block mt15 option option-primary">
                                       
                                        <input type="radio" <?php if(isset($this->data['adminwithdrawfeetype'])=='flat'){ echo "checked='checked'";}else {echo'';}?> value='flat' name="adminwithdrawfeetype">
                                        <span class="radio"></span>
                                            <?php echo  ucwords($this->lang->line('amount'))?>
                                            </label>

                                        <label class="col-md-3 block mt15 option option-primary">
                                        <input type="radio" <?php if($this->data['adminwithdrawfeetype']=='percentage') { echo "checked='checked'"; } else {echo'';}?> value='percentage' name="adminwithdrawfeetype">
                                        <span class="radio"></span>
                                            <?php echo  ucwords($this->lang->line('percentage'))?>
                            </label>
                            </div>
                                    <label for="adminwithdrawfeetype" class="field-icon">
                                       
                                    </label>
                                    <?php echo form_error('adminwithdrawfeetype'); ?>
                                
                            </div>
                        </div>

                         <div class="section row mb10">
                            <label for="withdrawdaylimit"
                            class="field-label col-sm-3 ph10 text-left"><?php echo  ucwords($this->lang->line('withdrawlimit')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                            <div class="col-sm-8 ph10">
                                <label for="withdrawdaylimit" class="field prepend-icon">
                                    <input type="text" name="withdrawdaylimit" id="withdrawdaylimit"
                                    class="gui-input" placeholder="<?php echo  ucwords($this->lang->line('withdrawdaylimit')); ?>"
                                    value="<?php echo set_value('withdrawdaylimit', isset($this->data['withdrawdaylimit']) ? $this->data['withdrawdaylimit'] : '');?>">
                                    <label for="withdrawdaylimit" class="field-icon">
                                        <i class="fa fa-money"></i>
                                    </label>
                                </label>
                                 <?php echo form_error('withdrawdaylimit'); ?>
                            </div>
                        </div>
                        


                         <div class="panel-footer text-right">
                                    <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
                    </div>


                        </div>
                        </div>

                        </form>
                    </div> <!-- panel md35 ends-->


                    </div>
                </div>
                <!--  /Column Center  -->

            </section>
                <!--  /Content  -->

        </section>


    <?php $this->load->view('admin/sidebar_right');?>


</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->
<?php $this->load->view('admin/footer');?>

<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
 
<script type="text/javascript">
function changeweeklytype()
{
        var div1 = document.getElementById("weekly");
        var div2 = document.getElementById("monthly");
        div2.style.display = "none";
        div1.style.display = "block";
}

function changemonthlytype()
{
     var div1 = document.getElementById("weekly");
     var div2 = document.getElementById("monthly");
     div1.style.display = "none";
     div2.style.display = "block";


}
              
(function($) {

    $(document).ready(function() {

        // "use strict";
        // // Init Theme Core
        // Core.init();

        // // Init Demo JS
        // Demo.init();

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#allcp-form").validate({

            // States
          

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                withdrawstatus: {
                    required: true
                },
                minwithdraw: {
                    required: true,
                    number: true
                },
                maxwithdraw: {
                    required: true,
                    number: true
                },
                adminwithdrawfee: {
                    required: true,
                    number: true
                },
                adminwithdrawfeetype: {
                    required: true
                },
                withdrawdaylimit: {
                    required: true,
                    number: true
                }
               
               /* sitebanner: {
                    extension: "jpg|png|gif|jpeg"
                }
                
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                }*/
            },

            // error message
            messages: {
                withdrawstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                minwithdraw: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                maxwithdraw: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                adminwithdrawfee: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                adminwithdrawfeetype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                withdrawdaylimit: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                }
                
            },

            /* @validation highlighting + error placement
             ---------------------------------------------------- */

            highlight: function(element, errorClass, validClass) {
                $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                if (element.is(":radio") || element.is(":checkbox")) {
                    element.closest('.option-group').after(error);
                } else {
                    error.insertAfter(element.parent());
                }
            }
        });

    });

})(jQuery);
</script>                                                                                                                                                                                                                       <!--  /Scripts  -->

</body>

</html>
