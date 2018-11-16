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
                <div class="panel panel-visible" id="spy6">

                    <div class="panel-heading">
                        <span class="panel-title">
                            <?php if(isset($product->ProductId)) {
                                echo $this->lang->line('label_edit_product');
                            } else {
                                echo $this->lang->line('label_add_product');
                            }
                            ?>
                        </span>
                    </div>
                   
                    <form method="post" action="<?php echo base_url().'admin/category/add';?>" id="form-add-category" enctype="multipart/form-data">
                    <!--  New Product  -->
                        
                        <div class="panel-body pn">
                            <div class="tab-content pn br-n allcp-form theme-primary">

                                    <div class="section row mbn">
                                        <div class="col-md-4 ph10">
                                            <div class="fileupload fileupload-new allcp-form" data-provides="fileupload">
                                                <div class="fileupload-preview thumbnail mb20">
                                                <?php if(isset($cat->CategoryId)) { ?>
                                                    <img src="<?php echo base_url().'uploads/admin/product/'.$cat->Image;?>" alt="<?php echo $cat->Category;?>">
                                                <?php } else { ?>
                                                    <img data-src="holder.js/100%x140" alt="holder"/>
                                                <?php } ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-7 pr5 ph10">
                                                        <input type="text" name="" id=""
                                                               class="text-center event-name gui-input br-light bg-light"
                                                               placeholder="Image tags">
                                                        <label for="catImage" class="field-icon"></label>
                                                    </div>
                                                    <div class="col-xs-5 ph10">
                                                        <span class="button btn-primary btn-file btn-block">
                                                          <span class="fileupload-new">Select</span>
                                                          <span class="fileupload-exists">Change</span>
                                                          <input type="file" name="catImage" value="<?php echo set_value('catImage',isset($cat->Image) ? $cat->Image : ''); ?>">
                                                        </span>
                                                    </div>
                                                    <?php echo form_error('catImage'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php //print_r($cat = $this->data['cat']); 
                                        //echo $cat->CategoryId;
                                        // echo $cat['Category'];
                                        // echo $cat->Category;
                                        ?>
                                        <div class="col-md-8 ph10">
                                            <div class="section mb10">
                                                <label for="category_name" class="field prepend-icon">
                                                    <input type="text" name="category_name" id="category_name" class="event-name gui-input br-light light" placeholder="Category Name" value="<?php echo set_value('category_name',isset($cat->Category) ? $cat->Category : ''); ?>">
                                                    <label for="category_name" class="field-icon">
                                                        <i class="fa fa-tag"></i>
                                                    </label>
                                                </label>
                                                <?php echo form_error('category_name'); ?>
                                            </div>
                                            <div class="section mb10">
                                               <label for="ParentId" class="field select">
                                                    <select id="ParentId" name="ParentId">
                                                        <option value="0" selected="selected">Parent Category</option>
                                                        <?php 
                                                            $category = $this->data['category'];
                                                            // print_r($category);
                                                            foreach($category as $key => $value) {
                                                                
                                                            ?>
                                                            <option <?php if(isset($cat->CategoryId)==$key) echo "selected";?> value="<?php echo $key;?>" <?php echo set_select('ParentId', $key, False); ?>><?php echo trim($value);?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('ParentId'); ?>
                                            </div>
                                            <div class="section mb10">
                                                <label for="SortOrder" class="field prepend-icon">
                                                    <input type="text" name="SortOrder" id="sortOrder"
                                                           class="gui-input"
                                                           placeholder="Sort Order" value="<?php echo set_value('SortOrder',isset($cat->SortOrder) ? $cat->SortOrder : ''); ?>">
                                                    <label for="SortOrder" class="field-icon">
                                                        <i class="fa fa-sort-amount-desc"></i>
                                                    </label>
                                                </label>
                                                <?php echo form_error('SortOrder'); ?>
                                            </div>
                                            <div class="section mb10">
                                               <label for="Status" class="field select">
                                                    <select id="Status" name="Status">
                                                    <?php 
                                                    if(isset($cat->CategoryId)) {
                                                        if($cat->Status) {
                                                            $status = 'enabled';
                                                        } else {
                                                            $status = 'disabled';
                                                        }
                                                    } else {
                                                        $status ='';
                                                    }

                                                    ?>
                                                        <option value="" selected>-- Select Status --</option>
                                                        <option <?php if($status=='enabled') echo "selected";?> value="1" <?php echo set_select('Status', '1', TRUE); ?> >Enable</option>
                                                        <option <?php if($status=='disabled') echo "selected";?> value="0" <?php echo set_select('Status', '0'); ?> >Disable</option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                                <?php echo form_error('Status'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="short alt">
                                    <input type="hidden" name="CategoryId" value="<?php echo isset($cat->CategoryId) ? $cat->CategoryId : '';?>">
                                    <div class="section mbn text-right">
                                        <p class="text-right">
                                            <button class="btn btn-bordered btn-primary" type="submit"><?php if(isset($cat->CategoryId)) echo $this->lang->line('button_update_category'); else echo $this->lang->line('button_create_category'); ?></button>
                                        </p>
                                    </div>
                                    <!--  /section  -->

                            </div>
                        </div>

                    </form>
                
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
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<!--  /Scripts  -->

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        // $.validator.addMethod("alpha", function(value, element) {
        //     return this.optional(element) || value == value.match(/^[a-z A-Z]+/);
        // });
        $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-z0-9\-\s]+$/i);
        });

        $("#form-add-category").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                category_name: {
                    required: true,
                    alpha : true
                },
                // catImage: {
                //     required: true
                // },
                
                Status: {
                    required: true
                },
                SortOrder: {
                    required: true,
                    number: true
                }
                
            },

            // error message
            messages: {
                category_name: {
                    required: 'Please enter category name',
                    alpha: 'Category name is only allowed alpha numeric characters'
                },
                // catImage: {
                //     required: 'Please upload categpry image'
                // },
                
                Status: {
                    required: 'Please select category status'
                },
                SortOrder: {
                    required: 'Please enter product ventor',
                    number: 'Category sort order is allowed only number'
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
