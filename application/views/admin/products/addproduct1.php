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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/summernote/summernote.css">

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
                                <span class="panel-title">
                                    <?php if(isset($product->ProductId)) {
                                        echo $this->lang->line('label_edit_product');
                                    } else {
                                        echo $this->lang->line('label_add_product');
                                    }
                                    ?>
                                </span>
                            </div>
                            
                            <form method="post" action="<?php echo base_url().'admin/product1/ad';?>" id="form-add-product" enctype="multipart/form-data">
                            
                                <div class="panel-body pn">
                                    <div class="tab-content pn br-n allcp-form theme-primary">

                                            <div class="section row mbn">
                                     <div class="col-md-4 ph10" id="product_multi_image">
                                                <?php if(isset($product->Image)) 
                                                {
                                                    $images = explode(',', $product->Image);
                                                    $i=1;
                                                   
                                                    foreach ($images as $row) {
                                                        
                                                            ?>

                                                    <div class="fileupload fileupload-new allcp-form mb30" data-provides="fileupload">
                                                        <div class="fileupload-preview thumbnail mb20">
                                                        <?php if(isset($row)) { ?>
                                                            <img src="<?php echo base_url().'uploads/admin/product/'.$row;?>" alt="<?php echo $product->ProductName;?>">
                                                        <?php } else { ?>
                                                            <img data-src="holder.js/100%x140" alt="holder"/>
                                                        <?php } ?>
                                                           
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7 pr5 ph10">
                                                               
                                                            </div>
                                                            <div class="col-xs-5 ph10">
                                                                <span class="button btn-primary btn-file btn-block">
                                                                  <span class="fileupload-new">Select</span>
                                                                  <span class="fileupload-exists">Change</span>
                                                                  <?php if($i<4)  { ?>
                                                            <input type="file" name="ProductImage<?php echo $i;?>" class="file-input-extensions1" value="">
                                                            
                                                            <?php } else {?>
                                                               <input type="file" name="file_upload[]" class="file-input-extensions1" value="">
                                                           <?php } ?> 
                                                            </span>
                                                             </div>
                                                        </div>
                                                    </div>

                                                   <?php
                                                     $i++;
                                                  }
                                                     }
                                                      
                                                      
                                                       else
                                                        {
                                                         ?>
                                                         <div class="fileupload fileupload-new allcp-form mb30" data-provides="fileupload">
                                                       <div class="fileupload-preview thumbnail mb20">
                                                       
                                                            <img data-src="holder.js/100%x140" alt="holder"/>
                                                      
                                                        </div>
                                                          <div class="row">
                                                            <div class="col-xs-7 pr5 ph10">
                                                               
                                                            </div>
                                                            
                                                        </div>
                                                        </div>
                                                      

                                                      <?php  }
                                                       ?>
                                                     <div class="col-xs-5 ph10">
                                                               
                                                                  <input type="file" name="ProductImage[]" id="files" class="file-input-extensions1" value="<?php echo set_value('ProductImage1'); ?>">

                                                                <div id="selectedFiles"></div>
                                                            </div>
                                                
                                                           <div class="option_att"></div>
                                                        

                                                         <div class="mt20 mb20">
                                                            <button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addattrs1();" type="button" data-original-title="Add additional field"><i class="fa fa-plus-circle"></i></button>
                                                        </div>


                                                    <!-- </div> -->
                                                    

                                                  

                                                        


                                                  





                                                    <!-- <div class="mt20 mb20">
                                                        <button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addImage();" type="button" data-original-title="Add Image"><i class="fa fa-plus-circle"></i></button>
                                                    </div> -->

                                        

                                         

                                            <div class="section mbn text-right">
                                                <p class="text-right">
                                                    <button class="btn btn-bordered btn-primary" type="submit"><?php if(isset($product->ProductId)) echo $this->lang->line('btn_update_product'); else echo $this->lang->line('btn_add_product'); ?></button>
                                                </p>
                                            </div>
                                            <!--  /section  -->

                                    </div>
                                </div>

                            </form>
                
                            
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

<script>
    var selDiv = "";
        
    document.addEventListener("DOMContentLoaded", init, false);
    
    function init() {
        document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }
        
    function handleFileSelect(e) {
        
        if(!e.target.files) return;
        
        selDiv.innerHTML = "";
        
        var files = e.target.files;
        for(var i=0; i<files.length; i++) {
            var f = files[i];
            
            selDiv.innerHTML += f.name + "<br/>";

        }
        
    }
    </script>
<!-- Ckeditor JS -->


<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<!--  Tagmanager JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<!--  /Scripts  -->



<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>


<script src="<?php echo base_url();?>assets/js/plugins/ckeditor/ckeditor.js"></script>


<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        jQuery.validator.addMethod("decimal", function(value, element) {
            return this.optional(element) || /^\d{0,6}(\.\d{0,2})?$/i.test(value);
        }, "You must include two decimal places");

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

                Points: {
                    required: true,
                    number: true
                },
                product_quantity: {
                    required: true,
                    number: true
                },
                product_price: {
                    required: true,
                    decimal: true
                },
                product_type: {
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
                 Points: {
                    required: 'Please enter points',
                    number: 'product points is allowed only number'
                },
                product_quantity: {
                    required: 'Please enter product quantity',
                    number: 'product quantity is allowed only number'
                },
                product_price: {
                    required: 'Please enter product price',
                    decimal: 'product price is allowed only decimal value'
                },
                product_type: {
                    required: 'Please select product type',
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

 

        $('#show_info').click(function() {
           

            if ($(this).is(':checked')) {
                $('#additional-option').css('display', 'block');
                $('#show_info').val('1');
            } else {
                $('#additional-option').css('display', 'none');
                $('#show_info').val('0');
            }
        });

         

        // $('.note-editable').focusout(function() {
        //     var text = $('.note-editable').html();
        //     alert(text);
        // })
        if($('#filter-type').val()=='2') {
            console.log($('#filter-type').val());
            $('#digital_pro').css('display', 'block');
        }
        else {
            console.log($('#filter-type').val());
            $('#digital_pro').css('display', 'none');
        }
    });

})(jQuery);
</script>
<script type="text/javascript">
    var image_row = 1;

function addImage() {
    html = '<div class="fileupload fileupload-new allcp-form mt-20" data-provides="fileupload" id="add_image' + image_row  + '"> <div class="fileupload-preview thumbnail mb20"> <img data-src="holder.js/100%x140" alt="holder"/> </div> <div class="row"> <div class="col-xs-7 pr5 ph10"> <input type="text" name="ProductImage' + image_row + '" id="ProductImage' + image_row + '"class="text-center event-name gui-input br-light bg-light"placeholder="Image tags"> <label for="ProductImage' + image_row + '" class="field-icon"></label> </div> <div class="col-xs-5 ph10"> <span class="button btn-primary btn-file btn-block"> <span class="fileupload-new">Select</span> <span class="fileupload-exists">Change</span> <input type="file" name="ProductImage[]" value="<?php echo set_value('ProductImage + image_row + '); ?>"> </span> </div> </div> <button class="btn btn-danger pull-right mt20" type="button" onclick="$(\'#add_image' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> </div>  ';

    

    $('#product_multi_image').append(html);

    image_row++;
}

var attrs = 1;
function addattrs() {

    // console.log(attrs);
    html1 = '<div class="row mt20" id="addattrs_' + attrs  + '"> <div class="col-md-4"> <label for="field_name_' + attrs  + '" class="field prepend-icon"> <input type="text" name="field_name[]" id="field_name_' + attrs  + '" class="gui-input" placeholder="<?php echo $this->lang->line('label_field_name'); ?>" value=""> </label> </div> <div class="col-md-6"> <label for="field_value_' + attrs  + '" class="field prepend-icon"> <input type="text" name="field_value[]" id="field_value_' + attrs  + '" class="gui-input" placeholder="<?php echo $this->lang->line('label_field_value'); ?>" value=""> </label> </div> <div class="col-md-2"> <button class="btn btn-danger" type="button" onclick="$(\'#addattrs_' + attrs  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i> </button> </div> </div>';
    $('.option_attr').append(html1);

    attrs++;
}

var  add= 1;
function addattrs1() {

    // console.log(attrs);
    html1 = '<div class="row mt20" id="addattr_' + add  + '">   <div class="col-md-8">  <input type="file" name="file_upload[]" id="file_upload_' + add  + '"  placeholder="<?php echo $this->lang->line('label_field_value'); ?>" value="">  </div> <div class="col-md-2"> <button class="btn btn-danger" type="button" onclick="$(\'#addattr_' + add  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i> </button> </div> </div>';
    $('.option_att').append(html1);

    add++;
}
function chageProductType(id) {
    var product_type = id;
    if(product_type=='2'){
        $('#digital_pro').css('display', 'block');
        $("#form-add-product").validate({
             rules: {
                file: {
                    required: true
                }
            }
        });
    } else {
        $('#digital_pro').css('display', 'none');
    }
}
</script>


</body>

</html>
