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
        <?php $this->load->view('admin/toper');?>
        <!--  /Topbar Menu Wrapper  -->

        <!--  Topbar  -->
        <?php $this->load->view('admin/topmenu');?>
        <!--  /Topbar  -->

            <!--  Content  -->
            <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center pt30">
                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-visible" id="spy6">
                            <div class="panel-heading">
                                <span class="panel-title"><?php echo $this->lang->line('page_title'); ?></span>
                                <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/orders" data-original-title="<?php echo $this->lang->line('label_back'); ?>"><i class="fa fa-reply"></i></a></span>
                            </div>
                            <div class="panel-body br-t">
                                <form method="post" action="" id="form-add-order" enctype="multipart/form-data">
                                    <div class="tab-content pn br-n allcp-form theme-primary">

                                            <div class="section row mb20">
                                                <div class="col-md-4">
                                                    <label class="field"><?php echo $this->lang->line('label_user'); ?></label>
                                                </div>
                                                <div class="col-md-8 ph10">
                                                    <label for="order_user" class="field select">
                                                        <select id="order_user" name="order_user">
                                                            <option value="0" selected="selected"><?php echo $this->lang->line('label_user'); ?></option>
                                                            <?php 

                                                                $users = $this->data['users'];
                                                              
                                                                foreach($users as $row) { ?>
                                                                <option value="<?php echo $row->MemberId;?>" <?php echo set_select('order_user', $row->MemberId, TRUE); ?>><?php echo $row->UserName;?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <i class="arrow double"></i>
                                                    </label>
                                                    <?php echo form_error('order_user'); ?>
                                                </div>
                                            </div>


                                            <div class="section row mb20">
                                                <div class="col-md-4">
                                                    <label class="field"><?php echo $this->lang->line('label_product'); ?></label>
                                                </div>

                                                <div class="col-md-8 ph10">
                                                    <div class="section">
                                                        <label class="field select-multiple">
                                                            <select name="order_product[]" id="order_product" class="order_product" multiple="multiple" size="4">
                                                                <option value="0"><?php echo $this->lang->line('label_product'); ?></option>
                                                                <?php 
                                                                    $products = $this->data['product'];
                                                                
                                                                foreach($products as $row) { ?> 
                                                                <option value="<?php echo $row->ProductId;?>" <?php echo set_select('order_product', $row->ProductId, TRUE); ?>><?php echo $row->ProductName;?></option>
                                                            <?php } ?>
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <?php echo form_error('order_product'); ?>
                                                </div>

                                            </div>

                                            <!--  /Section  -->

                                            <div class="section row">
                                                <div class="col-md-4">
                                                    <label class="field"><?php echo $this->lang->line('label_product_quantity'); ?></label>
                                                </div>
                                                <div class="col-md-8 ph10">
                                                    <label for="product_quantity" class="field prepend-icon">
                                                        <input type="text" name="product_quantity" id="product_quantity"
                                                               class="gui-input"
                                                               placeholder="Quantity">
                                                        <label for="product_quantity" class="field-icon">
                                                            <i class="fa fa-sort-amount-desc"></i>
                                                        </label>
                                                    </label>
                                                    <?php echo form_error('product_quantity'); ?>
                                                </div>

                                            </div>
                                            <input type="hidden" name="OrderId" value="">
                                            <!--  /Section  -->

                                            <hr class="short alt">

                                            <div class="section mbn text-right">
                                                <p class="text-right">
                                                    <button class="btn btn-bordered btn-primary" type="submit"><?php echo $this->lang->line('btn_add_order'); ?></button>
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
            <!--  /Column Center  -->

        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right'); ?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->
<?php $this->load->view('admin/footer'); ?>


<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<!--  Tagmanager JS  -->


<script src="<?php echo base_url();?>assets/js/pages/sales-stats-products.js"></script>
<!--  /Scripts  -->

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#form-add-product").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                product_name: {
                    required: true
                },
                product_desc: {
                    required: true
                },
                product_category: {
                    required: true
                },
                product_status: {
                    required: true
                },
                product_quantity: {
                    required: true
                },
                product_price: {
                    required: true
                },
                product_vendor: {
                    required: true
                },
                product_sku: {
                    required: true
                }
                
            },

            // error message
            messages: {
                product_name: {
                    required: 'Please enter Product name'
                },
                product_desc: {
                    required: 'Please enter product description'
                },
                product_category: {
                    required: 'Please select product category'
                },
                product_status: {
                    required: 'Please select product status'
                },
                product_quantity: {
                    required: 'Please enter product quantity'
                },
                product_price: {
                    required: 'Please enter product price'
                },
                product_vendor: {
                    required: 'Please enter product ventor'
                },
                product_sku: {
                    required: 'Please enter product SKU'
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

</body>

</html>
