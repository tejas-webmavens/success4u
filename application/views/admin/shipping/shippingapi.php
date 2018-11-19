<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  Datatables CSS  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/media/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/extensions/Editor/css/dataTables.editor.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">

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
    
<style>
input, select {
    width: 120px;
}
</style>
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
        <?php $this->load->view('admin/toper');?>
        <!--  /Topbar Menu Wrapper  -->

        <!--  Topbar  -->
        <?php $this->load->view('admin/topmenu');?>
        <!--  /Topbar  -->

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">
        <div class="chute chute-center pt30">
        <!-- <form name="" method="post" action="<?php echo base_url();?>admin/shipping" id="form-add-shipping"> -->
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            <div class="section row mb20">
                                <?php if($this->session->flashdata('error_message')) { ?>    
                                    <div class="col-md-12 bg-danger pt10 pb10 ">
                                        <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                    </div>
                                <?php } ?>
                                
                                <?php if($this->session->flashdata('success_message')) { ?>    
                                    <div class="col-md-12 bg-success pt10 pb10 ">
                                        <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="panel-title hidden-xs">
                                <?php echo $this->lang->line('easypost_apititle'); ?>
                                <!-- <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/shipping/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span> -->
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                                
                            </div>
                        </div>
                        <div class="panel-body pn">
                            <div class="table-responsive" id="shipping_api_method" class="allcp-form theme-primary tab-pane">
                                <form name="" method="post" action="<?php echo base_url();?>admin/shipping/shippingapi" id="shipping_api_form">
                                <div class="tab-content pn br-n allcp-form theme-primary">

                                    <div class="section row mbn">
                                        
                                        <div class="col-md-12 ph10">


                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_api_id'); ?> <sup class="state-error1">*</sup></label>
                                                <input type="text" placeholder="API ID" class="gui-input" id="api_id" name="api_id" value="<?php echo set_value('api_id',isset($api_id) ? $api_id : ''); ?>">
                                                <?php echo form_error('api_id'); ?>
                                            </div>

                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_company'); ?> <sup class="state-error1">*</sup></label>
                                                <input type="text" placeholder="company" class="gui-input" id="company" name="company" value="<?php echo set_value('company',isset($company) ? $company : ''); ?>">
                                                <?php echo form_error('company'); ?>
                                            </div>

                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_address'); ?> <sup class="state-error1">*</sup></label>
                                                
                                                    <input type="text" placeholder="Address" class="gui-input" id="address" name="address" value="<?php echo set_value('address',isset($address) ? $address : ''); ?>">
                                                
                                                <?php echo form_error('address'); ?>
                                            </div>

                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_city'); ?> <sup class="state-error1">*</sup></label>
                                                
                                                    <input type="text" placeholder="City" class="gui-input" id="city" name="city" value="<?php echo set_value('city',isset($city) ? $city : ''); ?>">
                                                
                                                
                                                <?php echo form_error('city'); ?>
                                            </div>

                                            <div class="section">
                                                <label class="field-label" for="zip_code"><?php echo $this->lang->line('label_zip_code'); ?> <sup class="state-error1">*</sup></label>
                                                
                                                    <input type="text" placeholder="sender zip code" class="gui-input" id="zip_code" name="zip_code" value="<?php echo set_value('zip_code',isset($zip_code) ? $zip_code : ''); ?>">
                                                  
                                                <?php echo form_error('zip_code'); ?>
                                            </div>

                                            <div class="section">
                                                <label class="field-label" for="phone"><?php echo $this->lang->line('label_phone'); ?> <sup class="state-error1">*</sup></label>
                                                <input type="text" placeholder="Phone Number" class="gui-input" id="phone" name="phone" value="<?php if(isset($phone)) echo $phone;?>">
                                                
                                                <?php echo form_error('phone'); ?>
                                            </div>
                                            <?php 
                                                if(isset($shipping_size)) {
                                                    if($shipping_size=='REGULAR') {
                                                        $size_select = 'regular';
                                                    } else {
                                                        $size_select = 'large';
                                                    }
                                                } else {
                                                    $size_select ='';
                                                }
                                            ?>
                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_shipping_size'); ?></label>
                                                <label for="" class="field select">
                                                    <select id="filter-type" name="shipping_size" class="">
                                                        <option value="" selected="selected"><?php echo $this->lang->line('select_shipping_size'); ?></option>
                                                        <option <?php if($size_select=='regular') echo 'selected'; ?> value="REGULAR" <?php echo set_select('shipping_size'); ?>><?php echo $this->lang->line('option_size_reqular'); ?></option>
                                                        <option <?php if($size_select=='large') echo 'selected'; ?> value="LARGE" <?php echo set_select('shipping_size'); ?>><?php echo $this->lang->line('option_size_large'); ?></option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('shipping_size'); ?>
                                            </div>
                                            <?php 
                                                if(isset($shipping_container)) {
                                                    switch ($shipping_container) {
                                                        case 'RECTANGULAR':
                                                            $container_select = 'rectangular';
                                                            break;
                                                        case 'NONRECTANGULAR':
                                                            $container_select = 'nonrectangular';
                                                            break;
                                                        case 'VARIABLE':
                                                            $container_select = 'variable';
                                                            break;
                                                    }
                                                    
                                                } else {
                                                    $container_select ='';
                                                }
                                            ?>
                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_container'); ?></label>
                                                <label for="" class="field select">
                                                    <select id="filter-type" name="shipping_container" class="">
                                                        <option value="" selected="selected"><?php echo $this->lang->line('select_shipping_container'); ?></option>
                                                        <option <?php if($container_select=='rectangular') echo 'selected'; ?> value="RECTANGULAR" <?php echo set_select('shipping_container'); ?>><?php echo $this->lang->line('option_rectangular'); ?></option>
                                                        <option <?php if($container_select=='nonrectangular') echo 'selected'; ?> value="NONRECTANGULAR" <?php echo set_select('shipping_container'); ?>><?php echo $this->lang->line('option_non_rectangular'); ?></option>
                                                        <option <?php if($container_select=='variable') echo 'selected'; ?> value="VARIABLE" <?php echo set_select('shipping_container'); ?>><?php echo $this->lang->line('option_size_variable'); ?></option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('shipping_container'); ?>
                                            </div>

                                            <div class="section">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="field-label" for="zip_code"><?php echo $this->lang->line('label_dimension'); ?></label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Length" class="gui-input" id="shipping_length" name="shipping_length" value="<?php if(isset($shipping_length)) echo $shipping_length;?>">
                                                            
                                                        <?php echo form_error('shipping_length'); ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" placeholder="Width" class="gui-input" id="shipping_width" name="shipping_width" value="<?php if(isset($shipping_width)) echo $shipping_width;?>">
                                                            
                                                        <?php echo form_error('shipping_width'); ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        
                                                        <input type="text" placeholder="Height" class="gui-input" id="shipping_height" name="shipping_height" value="<?php if(isset($shipping_height)) echo $shipping_height;?>">
                                                          
                                                        <?php echo form_error('shipping_height'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                                if(isset($shipping_weight)) {
                                                    switch ($shipping_weight) {
                                                        case 'kilogram':
                                                            $weight_select = 'kilogram';
                                                            break;
                                                        case 'gram':
                                                            $weight_select = 'gram';
                                                            break;
                                                        case 'pound':
                                                            $weight_select = 'pound';
                                                            break;
                                                        case 'ounce':
                                                            $weight_select = 'ounce';
                                                            break;
                                                    }
                                                    
                                                } else {
                                                    $weight_select ='';
                                                }
                                            ?>
                                            <div class="section">
                                                <label class="field-label" for=""><?php echo $this->lang->line('label_weight'); ?></label>
                                                <label for="" class="field select">
                                                    <select id="filter-type" name="shipping_weight" class="">
                                                       
                                                        <option value=""><?php echo $this->lang->line('select_shipping_weight'); ?></option>
                                                        <option <?php if($weight_select=='kilogram') echo 'selected'; ?> value="kilogram" <?php echo set_select('shipping_weight'); ?>><?php echo $this->lang->line('option_kilogram'); ?></option>
                                                        <option <?php if($weight_select=='gram') echo 'selected'; ?> value="gram" <?php echo set_select('shipping_weight'); ?>><?php echo $this->lang->line('option_gram'); ?></option>
                                                        <option <?php if($weight_select=='pound') echo 'selected'; ?> value="pound" <?php echo set_select('shipping_weight'); ?>><?php echo $this->lang->line('option_pound'); ?></option>
                                                        <option <?php if($weight_select=='ounce') echo 'selected'; ?> value="ounce" <?php echo set_select('shipping_weight'); ?>><?php echo $this->lang->line('option_ounce'); ?></option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('shipping_weight'); ?>
                                            </div>
                                            <input type="hidden" name="easypost_status" id="api_method" value="<?php if(isset($easypost_status)==1) echo '1'; else echo '0';?>"/>

                                        </div>
                                    </div>

                                    <hr class="short alt">

                                    <div class="section mbn text-right">
                                        <p class="text-right">
                                            <button class="btn btn-bordered btn-primary" type="button" onclick="validateFunc()"><?php if(isset($coupon->CouponId)) echo $this->lang->line('btn_update_api'); else echo $this->lang->line('btn_add_api'); ?></button>
                                        </p>
                                    </div>
                                    <!--  /section  -->

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
            
        </div>
        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->


<!--  Scripts  -->

<!--  jQuery  -->
<?php $this->load->view('admin/footer');?>

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>

<script type="text/javascript">
function validateFunc() {
	console.log('click');
    if ($('#shipping_api_form').valid()) {
    	$('#shipping_api_form').submit();
    }
}	
</script>  
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        $("#shipping_api_form").validate({

            // States

            errorClass: "state-error1",
            validClass: "state-success",
           

            // Rules

            rules: {
                api_id: {
                    required: true
                },
                company: {
                    required: true
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 13
                },
                zip_code: {
                    required: true,
                    number: true
                },
                shipping_length: {
                  required: true,
                  number: true  
                },
                shipping_width: {
                  required: true,
                  number: true  
                },
                shipping_height: {
                  required: true,
                  number: true  
                }
                
                
            },

            // error message
            messages: {
                api_id: {
                    required: 'Please enter easypost APPID'
                },
                company: {
                    required: 'Please enter sender company name'
                },
                address: {
                    required: 'Please enter sender address'
                },
                city: {
                    required: 'Please enter sender city'
                },
                phone: {
                    required: 'Please enter Phone Number',
                    number: 'Please enter only numeric characters',
                    minlength: 'Please enter phone number is minimum 10 digit',
                    maxlength: 'Please enter phone number is maximum 13 digit'
                },
                zip_code: {
                    required: 'Please enter sender zipcode',
                    number: 'Please enter Number only'
                },
                shipping_length: {
                  required: 'Please enter parcel length',
                  number: 'Please enter Number only' 
                },
                shipping_width: {
                  required: 'Please enter parcel width',
                  number: 'Please enter Number only'
                },
                shipping_height: {
                  required: 'Please enter parcel height',
                  number: 'Please enter Number only'  
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
</script>                          
