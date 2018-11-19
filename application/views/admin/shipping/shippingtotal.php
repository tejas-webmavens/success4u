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
                                <?php echo $this->lang->line('page_title'); ?>
                                <!-- <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/shipping/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span> -->
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                                
                            </div>
                        </div>
                        <div class="panel-body pn">
                            <div class="table-responsive" id="shipping_total_method" style="display:block;" class="allcp-form theme-primary tab-pane">
                                <form name="" method="post" action="<?php echo base_url();?>admin/shipping/shippingtotal" id="form-add-shipping">
                                    <div class="row"><button class="btn btn-primary pull-right" title="" data-toggle="tooltip" onclick="addrules();" type="button" data-original-title="Add additional field"><i class="fa fa-plus-circle"></i></button></div>
                                    <!-- <hr class="short"> -->
                                    <table class="table table-hover" id="" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <!--<th>
                                                <label class="option block mn">
                                                    <input type="checkbox" name="selectall" value="" id="selectall">
                                                    <span class="checkbox mn"></span>
                                                </label>
                                            </th>-->
                                            <th><?php echo $this->lang->line('label_country'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_min'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_max'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_rate'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_fastdelivery'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_remove'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody id="shipping_rules">
                                        
                                        <?php
                                        if(isset($this->data['shippings'])) {
                                            
                                            $shippings = $this->data['shippings'];
                                            if($shippings) {
                                                foreach ($shippings as $rows) {
                                                    // echo $row;
                                                    //$rows = explode(',', $row->content);  
                                                    ?>

                                                    <tr id="row_<?php echo $rows->ShippingId;?>">
                                                        <td>
                                                            <select name="country[]" class="gui-input" required>
                                                                <option value="" selected="selected">-- Select Country -- </option>
                                                                <?php
                                                                    $country = $this->data['country'];
                                                                    foreach($country as $row) { ?>
                                                                    <option value="<?php echo $row->country_id;?>"  <?php if($row->country_id==$rows->Country) echo "selected";?> ><?php echo $row->name;?></option>
                                                                <?php 
                                                                    } 
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td class=""><input type="text" pattern="\d+(\.\d*)?" name="min[]" class="gui-input min" onChange="CheckMinMax($(this).parent().parent().attr('id'),this.value)" value="<?php echo $rows->MinValue;?>" required/></td>
                                                        <td class=""><input type="text" pattern="\d+(\.\d*)?" name="max[]" class="gui-input max" onChange="CheckMinMax($(this).parent().parent().attr('id'),this.value)" value="<?php echo $rows->MaxValue;?>" required/></td>
                                                        <td class=""><input type="text" pattern="\d+(\.\d*)?" name="rates[]" class="gui-input" value="<?php echo $rows->Rates;?>" required/></td>
                                                        <td class=""><input type="text" pattern="\d+(\.\d*)?" name="fast[]" class="gui-input" value="<?php echo $rows->FastDelivery;?>" required/></td>
                                                        <!-- <td class=""><input type="text" name="min[]" class="gui-input" value=""/></td>
                                                        <td class=""><input type="text" name="max[]" class="gui-input" value=""/></td>
                                                        <td class=""><input type="text" name="rates[]" class="gui-input" value=""/></td> -->
                                                        <td>
                                                            <button class="btn btn-danger" type="button" onclick="$('#row_<?php echo $rows->ShippingId;?>').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                } 
                                            } else { ?>

                                            <tr id="row_0">
                                                <!--<td class="text-center">
                                                    <label class="option block mn">
                                                        <input type="checkbox" name="rules[]" value="" class="case">
                                                        <span class="checkbox mn"></span>
                                                    </label>
                                                </td>-->
                                                <td>
                                                    <select name="country[]" class="gui-input" required>
                                                        <option value="0" selected="selected">-- Select Country -- </option>
                                                        <?php
                                                            $country = $this->data['country'];
                                                            foreach($country as $row) { ?>
                                                            <option value="<?php echo $row->country_id;?>"><?php echo $row->name;?></option>
                                                        <?php 
                                                            } 
                                                        ?>
                                                    </select>
                                                </td>
                                                <td class=""><input type="text" pattern="\d+(\.\d*)?" name="min[]" onChange="CheckMinMax($(this).parent().parent().attr('id'),this.value)" class="gui-input min" value="" required/></td>
                                                <td class=""><input type="text" pattern="\d+(\.\d*)?" name="max[]" onChange="CheckMinMax($(this).parent().parent().attr('id'),this.value)" class="gui-input max" value="" required/></td>
                                                <td class=""><input type="text" pattern="\d+(\.\d*)?" name="rates[]" class="gui-input" value="" required/></td>
                                                <td class=""><input type="text" pattern="\d+(\.\d*)?" name="fast[]" class="gui-input" value="" required/></td>
                                                <td>
                                                    <button class="btn btn-danger" type="button" onclick="$('#row_0').remove();" data-toggle="tooltip" title="" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                                </td>
                                            </tr>

                                            
                                                <?php 
                                            } 
                                        }  

                                        ?>
                                        
                                            
                                        </tbody>
                                    </table>
                                    <div class="row mt20">
                                        <!-- <div class="col-md-6"> -->
                                            
                                            <!-- <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/shipping/add" data-original-title="Add New">
                                                <i class="fa fa-plus"></i>  &nbsp;&nbsp;Add rule
                                            </a> -->
                                        <!-- </div> -->
                                        <!-- <button class="btn btn-bordered btn-primary" type="button" onclick="validateFunc()"><?php if(isset($coupon->CouponId)) echo $this->lang->line('btn_update_api'); else echo $this->lang->line('btn_add_api'); ?></button> -->
                                        <button type="submit" class="btn btn-primary" id="submit_shipping_btn" name="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <!-- </form> -->
            <!--  /Column Center  -->
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
    
    if ($('#form-add-shipping').valid()) {
        $('#form-add-shipping').submit();
    }
}   
</script>  


<script type="text/javascript">

    var attrs = 1;
    function addrules() {


        // html1 = '<tr id="row_' + attrs  + '"> <td> <select name="country[]" class="gui-input"> <option value="0" selected="selected">-- Select Country -- </option> <?php foreach($country as $row) { ?> <option value="<?php echo $row->country_id;?>"><?php echo htmlentities($row->name);?></option> <?php } ?>  </select> </td> <td class=""><input type="text" name="row' + attrs  + '[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="row' + attrs  + '[]" class="gui-input" value=""/></td> <td class=""><input type="text" name="row' + attrs  + '[]" class="gui-input" value=""/></td> <td> <button class="btn btn-danger" type="button" onclick="$(\'#row_' + attrs  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> </td> </tr>';
        html1 = '<tr id="row_' + attrs  + '"> <td> <select name="country[]" class="gui-input" required> <option value="" selected="selected">-- Select Country -- </option> <?php foreach($country as $row) { ?> <option value="<?php echo $row->country_id;?>"><?php echo htmlentities($row->name);?></option> <?php } ?>  </select> </td> <td class=""><input type="text" pattern="[0-9]+$" name="min[]" onChange="CheckMinMax($(this).parent().parent().attr(\'id\'),this.value)" class="gui-input min" value="" required/> </td> <td> <input type="text" name="max[]" onChange="CheckMinMax($(this).parent().parent().attr(\'id\'),this.value)" class="gui-input max" value="" required/></td> <td><input type="text" name="rates[]" class="gui-input" value="" required/></td> <td><input type="text" name="fast[]" class="gui-input" value="" required/></td><td> <button class="btn btn-danger" type="button" onclick="$(\'#row_' + attrs  + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> </td> </tr>';

        $('#shipping_rules').append(html1);
        $("#shipping_rules input").attr("pattern","\\d*\\.?\\d*");

        attrs++;
    }

    function CheckMinMax(id,mina) {
        var min = $('#'+id+' input.min').val();
        var max = $('#'+id+' input.max').val();
        if(parseInt(min) > parseInt(max)) {
            $('.state-error1').remove();
            $('#submit_shipping_btn').attr("disabled",true);
            $('#'+id+'').after('<span class="state-error1">Min value not more then maximum value.</span>');
        } else {
            console.log('no error');
            $('.state-error1').remove();
            $('#submit_shipping_btn').attr("disabled",false);
        }
    }

</script>