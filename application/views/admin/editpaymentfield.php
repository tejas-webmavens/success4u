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
<style>
.allcp-form em.state-error {
    color: #de888a;
    display: block !important;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 0.85em;
    font-style: normal;
    line-height: normal;
    margin-top: 6px;
    padding: 0 3px;
}
</style>

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

<!--  Column Left  -->



<!--  /Column Left  -->

<!--  Column Center  -->
<div class="chute chute-center">
    <?php
    //print_r($this->data['fielddata']);
    ?>
    <div class="mw1000 center-block">

        <!--  General Information  -->

         <div class="panel mb35">

        <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
            <div class="panel-heading">
                <span class="panel-title"><?php echo  ucwords($this->data['fielddata']->PaymentName).' - '.ucwords($this->lang->line('pagetitle_paymentedit'));?></span>
                <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/paymentsetting" data-original-title="close"><i class="fa fa-close"></i></a></span>
            </div>
            
            <div class="section row mbn">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php } ?>
                                </div>
       

             <div class="panel-body br-t">
            
                <div class="allcp-form theme-primary">
               
                   <div class="section row mb10">
                        <label for="merchantid" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('merchantid')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-10 ph10">
                            <label for="merchantid" class="field prepend-icon">
                                <input type="text" name="merchantid" id="merchantid" placeholder="<?php echo  ucwords($this->lang->line('merchantid')); ?>"
                                class="gui-input" value="<?php echo set_value('merchantid', isset($this->data['fielddata']->PaymentMerchantId) ? $this->data['fielddata']->PaymentMerchantId : '');?>" >
                                <label for="merchantid" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('merchantid','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="merchantpassword" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('merchantpassword')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="merchantpassword" class="field prepend-icon">
                                <input type="text" name="merchantpassword" id="merchantpassword" placeholder="<?php echo  ucwords($this->lang->line('merchantpassword')); ?>"
                                class="gui-input" value="<?php echo set_value('merchantpassword', isset($this->data['fielddata']->PaymentMerchantPassword) ? $this->data['fielddata']->PaymentMerchantPassword : '');?>" >
                                <label for="merchantpassword" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('merchantpassword','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="merchantapi" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('merchantapi')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="merchantapi" class="field prepend-icon">
                                <input type="text" name="merchantapi" id="merchantapi" placeholder="<?php echo  ucwords($this->lang->line('merchantapi')); ?>"
                                class="gui-input" value="<?php echo set_value('merchantapi', isset($this->data['fielddata']->PaymentMerchantApi) ? $this->data['fielddata']->PaymentMerchantApi : '');?>" >
                                <label for="merchantapi" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('merchantapi','<em class="state-error">','</em>');?>
                        </div>
                    </div>
                      <div class="section row mb10">
                        <label for="merchantaddress" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('merchantaddress')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="merchantaddress" class="field prepend-icon">
                                <input type="text" name="merchantaddress" id="merchantaddress" placeholder="<?php echo  ucwords($this->lang->line('merchantaddress')); ?>"
                                class="gui-input" value="<?php echo  set_value('merchantaddress', isset($this->data['fielddata']->PaymentField1) ? $this->data['fielddata']->PaymentField1: '');?>" >
                                <label for="merchantaddress" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('merchantaddress','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="merchantkey" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('merchantkey')); ?></label>

                        <div class="col-sm-10 ph10">
                            <label for="merchantkey" class="field prepend-icon">
                                <input type="text" name="merchantkey" id="merchantkey" placeholder="<?php echo  ucwords($this->lang->line('merchantkey')); ?>"
                                class="gui-input" value="<?php echo set_value('merchantkey', isset($this->data['fielddata']->PaymentMerchantKey) ? $this->data['fielddata']->PaymentMerchantKey : '');?>" >
                                <label for="merchantkey" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('merchantkey','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="paymentstatus"
                        class="field-label col-sm-2 ph10 text-left"><?php echo  ucwords($this->lang->line('paymentstatus')); ?></label>

                        <div class="col-sm-10 ph10">
                        
                        
                             <?php //echo $this->data['allowpicture'];?>
                             <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" value='1' <?php if(1 == $this->data['fielddata']->PaymentStatus) {echo "checked='checked'";} ?> name="paymentstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('enable'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" value='0' <?php if(0 == $this->data['fielddata']->PaymentStatus) {echo "checked='checked'";} ?> name="paymentstatus">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('disable'))?>
                        </label>
                        </div>
                                <label for="paymentstatus" class="field-icon">
                                   
                                </label>
                            <?php echo form_error('paymentstatus','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                    <div class="section row mb10">
                        <label for="paymentmode"
                        class="field-label col-sm-2 ph10 text-left"><?php echo  ucwords($this->lang->line('paymentmode')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-10 ph10">

                    <div class="option-group field">
                        <label class="col-md-3 block mt15 option option-primary">
                                   
                                    <input type="radio" value='1' <?php if(1 == $this->data['fielddata']->PaymentMode) {echo "checked='checked'";} ?> name="paymentmode">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('live'))?>
                                        </label>

                                    <label class="col-md-3 block mt15 option option-primary">
                                    <input type="radio" value='0' <?php if(0 == $this->data['fielddata']->PaymentMode) {echo "checked='checked'";} ?> name="paymentmode">
                                    <span class="radio"></span>
                                        <?php echo  ucwords($this->lang->line('test'))?>
                        </label>
                        </div>
                                <label for="paymentmode" class="field-icon">
                                   
                                </label>
                            <?php echo form_error('paymentmode','<em class="state-error">','</em>');?>
                        </div>
                    </div>


                    <div class="section row mb10">
                        <label for="position" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('paymentposition')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-10 ph10">
                            <label for="position" class="field prepend-icon">
                                <input type="text" name="position" id="position" placeholder="<?php echo  ucwords($this->lang->line('paymentposition')); ?>"
                                class="gui-input" value="<?php echo set_value('paymentposition', isset($this->data['fielddata']->Position) ? $this->data['fielddata']->Position : '');?>" >
                                <label for="position" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('position','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                     <div class="section row mb10">
                        <label for="paymentliveurl" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('paymentliveurl')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-10 ph10">
                            <label for="paymentliveurl" class="field prepend-icon">
                                <input type="text" name="paymentliveurl" id="paymentliveurl" placeholder="<?php echo  ucwords($this->lang->line('paymentliveurl')); ?>"
                                class="gui-input" value="<?php echo set_value('paymentliveurl', isset($this->data['fielddata']->PaymentLiveUrl) ? $this->data['fielddata']->PaymentLiveUrl : '');?>" >
                                <label for="paymentliveurl" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('paymentliveurl','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                     <div class="section row mb10">
                        <label for="paymenttesturl" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('paymenttesturl')); ?><sup><em class="state-error"><?php echo  ucwords($this->lang->line('star')); ?></em></sup></label>

                        <div class="col-sm-10 ph10">
                            <label for="paymenttesturl" class="field prepend-icon">
                                <input type="text" name="paymenttesturl" id="paymenttesturl" placeholder="<?php echo  ucwords($this->lang->line('paymenttesturl')); ?>"
                                class="gui-input" value="<?php echo set_value('paymenttesturl', isset($this->data['fielddata']->PaymentTestUrl) ? $this->data['fielddata']->PaymentTestUrl : '');?>" >
                                <label for="paymenttesturl" class="field-icon">
                                    <i class="fa fa-info"></i>
                                </label>
                            </label>
                             <?php echo form_error('paymenttesturl','<em class="state-error">','</em>');?>
                        </div>
                    </div>

                    <h6 class="mb15"><?php echo  ucwords($this->lang->line('paymentLogo')); ?></h6>

                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail mb20">
                            <img src="<?php echo base_url();echo $this->data['fielddata']->PaymentLogo;?>" alt="paymentlogo">
                        </div>
                        <span class="btn btn-primary light btn-file btn-block ph5">
                            <span class="fileupload-new"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <span class="fileupload-exists"><?php echo  ucwords($this->lang->line('uploadimage')); ?></span>
                            <input type="file"  name="paymentlogo" value="<?php echo $this->data['fielddata']->PaymentLogo;?>">
                        </span>
                    </div>


                     <div class="panel-footer text-right">
                                <input type="hidden" name="paymentname" value="<?php echo $this->data['fielddata']->PaymentName; ?>">
                                <button type="submit" class="btn btn-bordered btn-primary"><?php echo  ucwords($this->lang->line('submit')); ?></button>
<!--                                 <button type="reset" class="btn btn-bordered mb5"><?php echo  ucwords($this->lang->line('cancel')); ?></button>
 -->                            </div>


</div>
</div>

 </form>
 </div> <!-- panel md35 ends-->
        <div class="panel mf35 mb35">
       <div class=""><label for="paymenttesturl" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('ipnnote')); ?></label></div>
       <div class="panel-body br-t">
        <div class="section row mb15">
                        <label for="paymenttesturl" class="field-label col-sm-2 ph10  text-left"><?php echo  ucwords($this->lang->line('ipnpath')); ?></label>

                        <div class="col-sm-15 ph10">
                            <label for="paymenttesturl" class="field prepend-icon"><?php echo base_url().'user/ipn/'.strtolower($this->data['fielddata']->PaymentName);?> 
                            </label>
                            </div>
                    </div>

        </div>

</div>
</div>
<!--  /Column Center  -->

</section>
<!--  /Content  -->

</section>

<!--  Sidebar Right  -->
<?php $this->load->view('admin/sidebar_right');?>



<?php $this->load->view('admin/footer');?>

<!--  FileUpload JS  -->

<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
 
<script type="text/javascript">
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
                merchantid: {
                    required: true
                },
                // merchantpassword: {
                //     required: true,
                // },
                // merchantapi: {
                //     required: true
                // },
                // merchantkey: {
                //     required: true
                // },
                paymentstatus: {
                    required: true
                },
                paymentmode: {
                    required: true
                },
                position: {
                    required: true,
                    number: true
                },
                paymentliveurl: {
                    required: true,
                    url: true
                },
                paymenttesturl: {
                    required: true,
                    url: true
                },
                 paymentlogo: {
                    extension: "jpg|png|gif|jpeg"
                }
            },

            // error message
            messages: {
                merchantid: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
               /* merchantpassword: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'                    
                },
                merchantapi: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                merchantkey: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },*/
                paymentstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                paymentmode: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },  
                position: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                 paymentliveurl: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    url: '<?php echo ucwords($this->lang->line('errorurl')); ?>'
                },
                 paymenttesturl: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                    url: '<?php echo ucwords($this->lang->line('errorurl')); ?>'
                },
                paymentlogo: {
                    extension: '<?php echo ucwords($this->lang->line('errorextension')); ?>'
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
