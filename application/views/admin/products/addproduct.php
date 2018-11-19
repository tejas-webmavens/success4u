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
                            
                            <form method="post" action="<?php echo base_url().'admin/product/add';?>" id="form-add-product" enctype="multipart/form-data">
                            
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
                                                            <div class="col-xs-5 ph10">
                                                                <span class="button btn-primary btn-file btn-block">
                                                                  <span class="fileupload-new">Select</span>
                                                                  <span class="fileupload-exists">Change</span>
                                                                  <input type="file" name="ProductImage1" class="file-input-extensions1" value="<?php echo set_value('ProductImage1'); ?>">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="fileupload fileupload-new allcp-form mb30" data-provides="fileupload">
                                                        <div class="fileupload-preview thumbnail mb20">
                                                        
                                                            <img data-src="holder.js/100%x140" alt="holder"/>
                                                       
                                                           
                                                        </div>
                                                          <div class="row">
                                                            <div class="col-xs-7 pr5 ph10">
                                                               
                                                            </div>
                                                            <div class="col-xs-5 ph10">
                                                                <span class="button btn-primary btn-file btn-block">
                                                                  <span class="fileupload-new">Select</span>
                                                                  <span class="fileupload-exists">Change</span>
                                                                  <input type="file" name="ProductImage2" class="file-input-extensions1" value="<?php echo set_value('ProductImage1'); ?>">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="fileupload fileupload-new allcp-form mb30" data-provides="fileupload">
                                                        <div class="fileupload-preview thumbnail mb20">
                                                        
                                                            <img data-src="holder.js/100%x140" alt="holder"/>
                                                      
                                                           
                                                        </div>
                                                          <div class="row">
                                                            <div class="col-xs-7 pr5 ph10">
                                                               
                                                            </div>
                                                            <div class="col-xs-5 ph10">
                                                                <span class="button btn-primary btn-file btn-block">
                                                                  <span class="fileupload-new">Select</span>
                                                                  <span class="fileupload-exists">Change</span>
                                                                  <input type="file" name="ProductImage3" class="file-input-extensions1" value="<?php echo set_value('ProductImage1'); ?>">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        </div>

                                                      <?php  }
                                                       ?>
                                                     
                                                
                                                           <div class="option_att"></div>
                                                        

                                                         <div class="mt20 mb20">
                                                            <button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addattrs1();" type="button" data-original-title="Add additional field"><i class="fa fa-plus-circle"></i></button>
                                                        </div>


                                                    <!-- </div> -->
                                                    

                                                  

                                                        


                                                  





                                                    <!-- <div class="mt20 mb20">
                                                        <button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addImage();" type="button" data-original-title="Add Image"><i class="fa fa-plus-circle"></i></button>
                                                    </div> -->

                                                </div>
                                                <div class="col-md-8 ph10">
                                                    <div class="section mb10">
                                                        <label for="product_name" class="field prepend-icon">
                                                            <input type="text" name="product_name" id="product_name"
                                                                   class="event-name gui-input br-light light"
                                                                   placeholder="<?php echo $this->lang->line('label_name'); ?>" value="<?php echo set_value('product_name',isset($product->ProductName) ? $product->ProductName : ''); ?>">
                                                            <label for="product_name" class="field-icon">
                                                                <i class="fa fa-tag"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('product_name'); ?>
                                                    </div>

                                                    <div class="section mb10">
                                                        <label for="product_category" class="field select">
                                                            <select id="product_category" name="product_category">
                                                                <option value="" selected="selected" <?php echo set_select('product_category'); ?>><?php echo $this->lang->line('label_category'); ?></option>
                                                                <?php

                                                                    $category = $this->data['category'];
                                                                    foreach($category as $key => $value) {
                                                                ?>
                                                                    <option <?php if(isset($product->CatId)) if($key==$product->CatId) echo "selected";?> value="<?php echo $key;?>" <?php echo set_select('product_category', $key, False); ?>><?php echo trim($value);?></option>
                                                                    
                                                                <?php } ?>
                                                                
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('product_category'); ?>
                                                    </div>

                                                    <div class="section mb10">
                                                        <label for="brand_name" class="field prepend-icon">
                                                            <input type="text" name="brand_name" id="brand_name" class="event-name gui-input br-light light"
                                                                   placeholder="<?php echo $this->lang->line('label_brand_name'); ?>" value="<?php echo set_value('brand_name',isset($product->brand) ? $product->brand : ''); ?>">
                                                            <label for="brand_name" class="field-icon">
                                                                <i class="fa fa-tag"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('brand_name'); ?>
                                                    </div>
                                                    <?php //if(isset($product->Description)) $description = htmlspecialchars_decode($product->Description, ENT_HTML5);?>
                                                    <?php if(isset($product->Description)) $description = html_entity_decode($product->Description);?>
                                                    
                                                    <div class="section mb10">
                                                        <div class="panel-body pn of-h" id="summer-demo">
                                                            <!-- <div class="summernote" style="height: 400px;" name=""><?php echo set_value('product_desc',isset($description) ? $description : ''); ?></div> -->
                                                            <!-- <textarea id="summernote_text" name="product_desc" class="ckeditor gui-input" style="display: none;"><?php echo set_value('product_desc',isset($description) ? $description : ''); ?></textarea> -->
                                                            <textarea id="product_desc" name="product_desc" class="ckeditor gui-input" ><?php echo set_value('product_desc',isset($description) ? $description : ''); ?></textarea>
                                                        </div>

                                                        <!-- <label class="field prepend-icon">
                                                        <textarea style="height: 160px;" class="gui-textarea br-light bg-light" id="product_desc" name="product_desc" placeholder="<?php echo $this->lang->line('label_description'); ?>"><?php echo set_value('product_desc',isset($product->Description) ? $product->Description : ''); ?></textarea> 
                                                        <label for="product_desc" class="field-icon">
                                                                <i class="fa fa-file"></i>
                                                            </label>
                                                        </label> -->
                                                        <?php echo form_error('product_desc'); ?>
                                                    </div>
                                                    
                                                    <div class="section mb10">
                                                    <?php 
                                                        if(isset($product->ProductId)) {
                                                            if($product->Status) {
                                                                $status = 'enabled';
                                                            } else {
                                                                $status = 'disabled';
                                                            }
                                                        } else {
                                                            $status ='';
                                                        }

                                                    ?>
                                                        <label class="field select">
                                                            <select id="product_status" name="product_status" >
                                                                <option value="" selected="selected"><?php echo $this->lang->line('label_status'); ?></option>
                                                                <option <?php if($status=='enabled') echo "selected";?> value="1" <?php echo set_select('product_status','1',false);?>>Enable</option>
                                                                <option <?php if($status=='disabled') echo "selected";?> value="0" <?php echo set_select('product_status','0');?>>Disable</option>
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('product_status'); ?>
                                                    </div>
                                                    <div class="section mb10">
                                                        <label for="product_quantity" class="field prepend-icon">
                                                            <input type="text" name="product_quantity" id="product_quantity"
                                                                   class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_quantity'); ?>" value="<?php echo set_value('product_quantity',isset($product->Quantity) ? $product->Quantity : ''); ?>">
                                                            <label for="product_quantity" class="field-icon">
                                                                <i class="fa fa-sort-amount-desc"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('product_quantity'); ?>
                                                    </div>
                                                    <div class="section mb10">
                                                        <label for="Points" class="field prepend-icon">
                                                            <input type="text" name="Points" id="Points"
                                                                   class="gui-input"
                                                                   placeholder="<?php echo $this->lang->line('label_points'); ?>" value="<?php echo set_value('Points',isset($product->Points) ? $product->Points : ''); ?>">
                                                            <label for="Points" class="field-icon">
                                                                <i class="fa fa-sort"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('product_quantity'); ?>
                                                    </div>
                                                    <div class="section mb10">
                                                        <label for="product_price" class="field prepend-icon">
                                                            <input type="text" name="product_price" id="product_price" class="gui-input" 
                                                                   placeholder="<?php echo $this->lang->line('label_price'); ?>" value="<?php echo set_value('product_price',isset($product->Price) ? sprintf('%0.2f',$product->Price) : ''); ?>">
                                                            <label for="product_price" class="field-icon">
                                                                <i class="fa fa-usd"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('product_price'); ?>
                                                    </div>
                                                    <div class="section mb10">
                                                    <?php $selected = (isset($product->ProductType)) ? $product->ProductType : '';   ?>
                                                        <label for="product_type" class="field select">
                                                            <select id="filter-type" name="product_type" class="" onchange="chageProductType(this.value)">
                                                            <?php 
                                                                if(isset($product->ProductId)) {
                                                                    if($product->ProductType==1) {
                                                                        $ProductType = 'physical';
                                                                    } else {
                                                                        $ProductType = 'digital';
                                                                    }
                                                                } else {
                                                                    $ProductType ='';
                                                                }

                                                            ?>
                                                                <option value="" <?php echo set_select('product_type'); ?> ><?php echo $this->lang->line('label_product_type'); ?></option> 
                                                                <option <?php if($ProductType=='physical') echo "selected";?>  value="1" <?php echo set_select('product_type','1', false); ?>><?php echo $this->lang->line('option_category_type1'); ?></option>
                                                                <option <?php if($ProductType=='digital') echo "selected";?>  value="2" <?php echo set_select('product_type','2'); ?>><?php echo $this->lang->line('option_category_type2'); ?></option>
                                                            </select>
                                                            <i class="arrow double"></i>
                                                        </label>
                                                        <?php echo form_error('product_type'); ?>
                                                    </div>
                                                    <div class="section mb10" id="digital_pro">
                                                        
                                                        <label class="field prepend-icon append-button file">
                                                            <span class="button btn-primary"><?php echo  ucwords($this->lang->line('choosefile')); ?></span>
                                                            <input type="file" onchange="document.getElementById('sourcefilepath').value = this.value;" id="sourcefile" name="File" class="gui-file">
                                                            <input type="text" placeholder="<?php echo  ucwords($this->lang->line('sourcefile')); ?>" id="sourcefilepath" name="sourcefilepath" class="gui-input">
                                                            <label class="field-icon">
                                                                <i class="fa fa-cloud-upload"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('File');?>
                                                          <input type="hidden" name="digitalfile" value="<?php if(isset($product->ProductId)) echo $product->File;?>">     
                                                    </div>
                                                    <!-- <div class="section mb10" id="digital_pro">
                                                        <input type="file" name="file" value="<?php echo set_value('File',isset($File) ? $File : ''); ?>">
                                                    </div> -->
                                                    <?php 
                                                        if(isset($product->ProductId)) {

                                                            if($product->DisplyShop) {
                                                                $DisplyShop = 'on';
                                                            } else {
                                                                $DisplyShop = 'off';
                                                            }
                                                        } else {
                                                            $DisplyShop = 'off';
                                                        }

                                                    ?>

                                                    <div class="section row mb10">
                                                        <label class="field-label col-sm-4 ph10" for="format"><?php echo $this->lang->line('label_disply'); ?></label>

                                                        <div class="col-sm-8 ph10">
                                                            <div class="option-group field ">

                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="radio" name="shop" <?php if($DisplyShop=='on') echo 'checked'; ?> class="" value="1" <?php echo set_radio('shop', $DisplyShop, FALSE);?>>
                                                                    <span class="radio"></span><?php echo $this->lang->line('label_on'); ?></label>

                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="radio" name="shop" <?php if($DisplyShop=='off') echo 'checked'; ?> class="" value="0" <?php echo set_radio('shop', $DisplyShop);?>>
                                                                    <span class="radio"></span><?php echo $this->lang->line('label_off'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        if(isset($product->ProductId)) {

                                                            if($product->AutoShip) {
                                                                $AutoShip = 'on';
                                                            } else {
                                                                $AutoShip = 'off';
                                                            }
                                                        } else {
                                                            $AutoShip = 'off';
                                                        }

                                                    ?>

                                                    <div class="section row mb10">
                                                        <label class="field-label col-sm-4 ph10" for="format"><?php echo $this->lang->line('label_product_ship'); ?></label>

                                                        <div class="col-sm-8 ph10">
                                                            <div class="option-group field ">
                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="radio" name="ship" <?php if($AutoShip=='on') echo 'checked'; ?> class="" value="1" <?php echo set_radio('ship', '1', FALSE);?>>
                                                                    <span class="radio"></span><?php echo $this->lang->line('label_on'); ?></label>

                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="radio" name="ship" <?php if($AutoShip=='off') echo 'checked'; ?> class="" value="0" <?php echo set_radio('ship', '0');?>>
                                                                    <span class="radio"></span><?php echo $this->lang->line('label_off'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        if(isset($product->ProductId)) {
                                                            
                                                            if($product->iSentrole) {
                                                                $iSentrole = 'on';
                                                            } else {
                                                                $iSentrole = 'off';
                                                            }
                                                            
                                                        } else {
                                                            $iSentrole = 'off';
                                                        }

                                                    ?>

                                                    <div class="section row mb10">
                                                        <label class="field-label col-sm-4 ph10" for="format"><?php echo $this->lang->line('label_product_entroll'); ?></label>
                                                        <div class="col-sm-8 ph10">
                                                            <div class="option-group field ">
                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="radio" name="entroll" <?php if($iSentrole=='on') echo 'checked'; ?> class="" value="1" <?php echo set_radio('entroll', $iSentrole, FALSE);?>>
                                                                    <span class="radio"></span><?php echo $this->lang->line('label_on'); ?></label>

                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="radio" name="entroll" <?php if($iSentrole=='off') echo 'checked'; ?> class="" value="0" <?php echo set_radio('entroll', '0');?>>
                                                                    <span class="radio"></span><?php echo $this->lang->line('label_off'); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        if(isset($product->ProductId)) {
                                                            
                                                            if($product->Attributes) {
                                                                $Attributes = 'on';
                                                            } else {
                                                                $Attributes = 'off';
                                                            }
                                                        } else {
                                                            $Attributes = 'off';
                                                        }

                                                    ?>
                                                    <div class="section row mb10">
                                                        <label class="field-label col-sm-4 ph10" for="format"><?php echo $this->lang->line('label_product_additional'); ?></label>

                                                        <div class="col-sm-8 ph10">
                                                            <div class="option-group field">
                                                                <label class="option block col-md-4 block mt15 option option-primary">
                                                                    <input type="checkbox" name="show_info" value="<?php if($Attributes=='on') echo '1'; else echo '0'; ?>" <?php echo set_checkbox('show_info','0',FALSE); if($Attributes=='on') echo 'checked'; ?> id="show_info">
                                                                    <span class="checkbox"></span></label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="additional-option" style="display:<?php if(isset($product->Attributes)) echo 'block'; else echo 'none';?>">
                                                        <div class="option_attr">
                                                        <?php 
                                                        if(isset($product->ProductId)) {
                                                            if($product->Attributes) {
                                                                
                                                                $attriputes = json_decode($product->Attributes);
                                                                $i=1;
                                                                foreach ($attriputes as $key => $value) { $i++; ?>
                                                                
                                                                <div class="row mt20" id="<?php echo $key.'_'.$i;?>">
                                                                    <div class="col-md-4">
                                                                        <label for="field_name" class="field prepend-icon">
                                                                            <input type="text" name="field_name[]" id="field_name" class="gui-input" placeholder="<?php echo $this->lang->line('label_field_name'); ?>" value="<?php echo set_value('shipping_rate',isset($key) ? $key : ''); ?>">
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="field_value" class="field prepend-icon">
                                                                            <input type="text" name="field_value[]" id="field_value" class="gui-input" placeholder="<?php echo $this->lang->line('label_field_value'); ?>" value="<?php echo set_value('shipping_rate',isset($value) ? $value : ''); ?>">
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <button class="btn btn-danger" type="button" onclick="$('<?php echo "#".$key."_".$i;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                                                    </div>
                                                                </div>
                                                            <?php   
                                                                }
                                                            } 
                                                        } else { ?>

                                                            <div class="row mt20" id="addattrs_0">
                                                                <div class="col-md-4">
                                                                    <label for="field_name" class="field prepend-icon">
                                                                        <input type="text" name="field_name[]" id="field_name" class="gui-input" placeholder="<?php echo $this->lang->line('label_field_name'); ?>" value="<?php echo set_value('shipping_rate'); ?>">
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="field_value" class="field prepend-icon">
                                                                        <input type="text" name="field_value[]" id="field_value" class="gui-input" placeholder="<?php echo $this->lang->line('label_field_value'); ?>" value="<?php echo set_value('shipping_rate'); ?>">
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button class="btn btn-danger" type="button" onclick="$('#addattrs_0').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                                                </div>
                                                            </div>

                                                        <?php } ?>

                                                        </div>

                                                        <div class="mt20 mb20">
                                                            <button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addattrs();" type="button" data-original-title="Add additional field"><i class="fa fa-plus-circle"></i></button>
                                                        </div>
                                                      
                                                    </div>
                                            
                                                    <input type="hidden" name="ProductId" value="<?php if(isset($product->ProductId)) echo $product->ProductId;?>"/>

                                                </div>
                                            </div>
                                             

                                            <hr class="short alt">

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
    html1 = '<div class="row mt20" id="addattr_' + add  + '">   <div class="col-md-8">  <input type="file" name="file_upload[]" multiple id="file_upload_' + add  + '"  placeholder="<?php echo $this->lang->line('label_field_value'); ?>" value="" >  </div> <div class="col-md-2"> <button class="btn btn-danger" type="button" onclick="$(\'#addattr_' + add  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i> </button> </div> </div>';
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
