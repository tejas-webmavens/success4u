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
            <div class="row">
            <!--  Column search  -->
                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <?php echo $this->lang->line('label_filter_title'); ?>
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="allcp-form theme-primary">
                            <form method="post" action="<?php echo base_url().'admin/product/search';?>" name="search_form">

                                <div class="section row mb20">
                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_name'); ?></h6>
                                        <label for="productname" class="field prepend-icon">
                                            <input type="text" name="productname" id="productname" class="gui-input" placeholder="Product Name" value="<?php echo set_value('productname');?>">
                                            <label for="productname" class="field-icon">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                    </div>

                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_type'); ?></h6>
                                        <label for="product_type" class="field select">
                                            <select id="filter-type" name="product_type" class="">
                                                <option value="0" selected="selected">Filter by Type</option> 
                                                <option value="1" <?php echo set_select('product_type', '1'); ?>><?php echo $this->lang->line('option_category_type1'); ?></option>
                                                <option value="2" <?php echo set_select('product_type', '2'); ?>><?php echo $this->lang->line('option_category_type2'); ?></option>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>

                                    
                                    <!-- <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by price</h6>
                                        <label for="price" class="field prepend-icon mb5">
                                            <input type="text" name="price" id="price" class="gui-input" placeholder="Price" value="<?php echo set_value('username');?>">
                                            <label for="price" class="field-icon">
                                                <i class="fa fa-sign"></i>
                                            </label>
                                        </label>
                                    </div> -->

                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_category'); ?></h6>
                                        <label for="product_category" class="field select">
                                            <select id="filter-category" name="product_category" class="">
                                               <option value="0" selected="selected"><?php echo $this->lang->line('label_filter_category'); ?></option> 
                                               <?php 
                                               // print_r($this->data);
                                                    $category = $this->data['category'];
                                                    // print_r($category);exit;
                                                    foreach($category as $row) { ?>
                                                    <option value="<?php echo $row->CategoryId;?>" <?php echo set_select('product_category'); ?>><?php echo $row->Category;?></option>
                                                <?php } ?>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10 mt40">
                                        <a data-original-title="Clear Filter" href="<?php echo base_url().'admin/product';?>" data-toggle="tooltip" title="" class="btn btn-danger pull-right"><i class="fa fa-eraser"></i></a>
                                    </div>

                                </div>

                                <div class="section row mb20">
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_status'); ?></h6>
                                        <label class="field select">
                                            <select id="filter-status" name="status">
                                                <option value="" selected="selected"><?php echo $this->lang->line('label_filter_status'); ?></option>
                                                <option value="active" <?php echo set_select('product_category', 'Active'); ?> ><?php echo $this->lang->line('label_filter_active'); ?></option>
                                                <option value="inactive" <?php echo set_select('product_category', 'Inactive'); ?> ><?php echo $this->lang->line('label_filter_inactive'); ?></option>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_fromdate'); ?></h6>
                                        <label for="datepicker1" class="field prepend-icon mb5">
                                            <input type="text" id="datepicker1" name="datepicker1" class="gui-input fs13" placeholder="From" value="<?php echo set_value('datepicker1');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo $this->lang->line('label_filter_todate'); ?></h6>
                                        <label for="datepicker2" class="field prepend-icon">
                                            <input type="text" id="datepicker2" name="datepicker2" class="gui-input fs13" placeholder="To" value="<?php echo set_value('datepicker2');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10 mt40">
                                        <button class="btn btn-primary pull-right ph30" type="submit" name="search"><?php echo $this->lang->line('btn_filter_search'); ?></button>
                                    </div>
                                </div>

                                
                               </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!--  /Column Search  -->
            </div>
                <!--  Column Center  -->
           

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
                                <div class="row">
                                    <div class="col-md-9">
                                        <?php echo $this->lang->line('page_title'); ?>
                                    </div>
                                    <div class="col-md-1">
                                        <button onclick="inStock('in')" class="btn btn-primary" title="" data-toggle="tooltip" type="button" data-original-title="In Stock"><i class="fa fa-stack-overflow"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-1">
                                        <button onclick="inStock('out')" class="btn btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Out of Stock"><i class="fa fa-stack-overflow"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                    <div class="col-md-1">
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/product/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span>
                                    </div>
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive">
                            <form name="form-product" id="form-product" method="post" action="<?php echo base_url();?>/admin/product/instock">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="option block mn">
                                                <input type="checkbox" name="selectall" value="" id="selectall">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </th>
                                        <th class="va-m"><?php echo $this->lang->line('label_image'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_name'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_quantity'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_price'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_stock'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_status'); ?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_action'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // print_r($this->data);
                                        $products = $this->data['products'];
                                        
                                        if($products) {
                                        foreach ($products as $row) {

                                            if($row->Image) {
                                                $product_image = explode(',', $row->Image);
                                                $pimage1 = base_url().'uploads/admin/product/'.$product_image[0];
                                            } else {
                                                $pimage1 = base_url().'uploads/noimage.png';
                                                
                                            }
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <label class="option block mn">
                                                <input type="checkbox" name="products[]" value="<?php echo $row->ProductId;?>" class="case">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </td>
                                        <td class="w100">
                                            <?php if($row->Image) { ?>
                                                <img class="img-responsive mw40 ib mr10" title="user" src="<?php echo $pimage1;?>"/>
                                            <?php } else { ?>
                                                <img class="img-responsive mw40 ib mr10" title="user" src="<?php echo $pimage1;?>"/>
                                            <?php } ?>
                                        </td>
                                        <!-- <td class=""><?php echo $row->Image;?></td> -->
                                        <td class=""><?php echo $row->ProductName;?></td>
                                        <td class="text-right"><?php echo $row->Quantity;?></td>
                                        <td class="text-right"><?php echo currency().sprintf('%0.2f', $row->Price);?></td>
                                        <?php if($row->StockStatusId) {?>
                                            <td class=""><?php echo 'In Stock';?></td>
                                        <?php } else { ?>
                                            <td class="text-danger"><?php echo 'out of Stock';?></td>
                                        <?php } ?>
                                        <!-- <td class=""><?php echo ($row->Status) ? 'Disabled' : 'Enabled' ;?></td> -->
                                        <td class="allcp-form">
                                            <label class="block mt15 switch switch-primary">
                                                <input type="checkbox" <?php if($row->Status=='1') echo 'checked'; ?> id="t<?php echo $row->ProductId;?>" name="status" class="status" value="<?php echo $row->ProductId;?>">
                                                <label data-off="OFF" data-on="ON" for="t<?php echo $row->ProductId;?>"></label>
                                                <span><?php //echo $row->MemberStatus;?></span>
                                            </label>
                                        </td>
                                        <td class="">
                                        
                                            <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo $this->lang->line('label_action'); ?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/product/add/'.$row->ProductId;?>"><?php echo $this->lang->line('label_edit'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/product/delete/'.$row->ProductId;?>"><?php echo $this->lang->line('label_delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                            }
                                        } else {   
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="8"><?php echo $this->lang->line('label_no_records'); ?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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

<?php $this->load->view('admin/footer');?>

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>


<!--  /Scripts  -->
<script type="text/javascript">
$("#selectall").on('click',function(){
    var chk=$('#selectall:checked').length ? true : false;
    if(chk){
        $('.case').prop('checked',true);
    } else {
        $('.case').prop('checked',false);
    }
});

function inStock(keys){
    if($('.case:checked').length) {
        var input = $("<input>")
            .attr("type", "hidden")
            .attr("name", "stock")
            .val(keys);
        $('#form-product').append($(input));
        confirm('Select Product is '+keys+' stock?') ? $('#form-product').submit() : false;
    }
}
// function outStock(){
//     if($('.case:checked').length) {
//      confirm('Select Product is Out of stock?') ? $('#form-product').submit() : false;
//     }
// }

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/product/inactive/'+id,
                    success : function()
                    {
                        console.log('sc');
                    }
                });
                // return confirm("Are you sure?");
            } else {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/product/active/'+id,
                    success : function(){
                        console.log('fail');
                    }
                });
            }
        });
    });

 })(jQuery);
 $(document).ready(function() {
    $('#datatable2').DataTable();
} );

</script>
</body>

</html>
