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
                                <form method="post" action="<?php echo base_url().'admin/orders/search';?>" name="search_form">

                                    <div class="section row mb20">
                                        
                                        <div class="col-md-3 ph10">
                                            <h6 class="mb15"> <?php echo $this->lang->line('label_filter_name'); ?></h6>
                                            <label for="username" class="field prepend-icon">
                                                <input type="text" name="username" id="username" class="gui-input" placeholder="<?php echo $this->lang->line('label_filter_name'); ?>" value="<?php echo set_value('username');?>">
                                                <label for="username" class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </label>
                                            </label>
                                        </div>

                                        <div class="col-md-3 ph10">
                                            <h6 class="mb15"> <?php echo $this->lang->line('label_filter_amount'); ?></h6>
                                            <label for="total" class="field prepend-icon">
                                                <input type="text" name="total" id="total" class="gui-input" placeholder="<?php echo $this->lang->line('label_filter_amount'); ?>" value="<?php echo set_value('total');?>">
                                                <label for="total" class="field-icon">
                                                    <i class="fa fa-usd"></i>
                                                </label>
                                            </label>
                                        </div>
                                       
                                        <div class="col-md-3 ph10">
                                            <h6 class="mb15"> <?php echo $this->lang->line('label_filter_status'); ?></h6>
                                            <label class="field select">
                                                <select id="filter-status" name="status" <?php echo set_select('order_status');?>>
                                                    <option value="" selected="selected"><?php echo $this->lang->line('label_status'); ?></option>
                                                    <option value="paid" >Paid</option>
                                                    <option value="unpaid">Un Paid</option>
                                                    <option value="cancelled">Cancelled</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                                <i class="arrow double"></i>
                                            </label>
                                        </div>
                                        <div class="col-md-3 ph10 mt40">
                                            <a data-original-title="Clear Filter" href="<?php echo base_url().'admin/orders';?>" data-toggle="tooltip" title="" class="btn btn-danger pull-right"><i class="fa fa-eraser"></i></a>
                                        </div>

                                    </div>

                                    <div class="section row mb20">

                                        <div class="col-md-3 ph10">
                                            <h6 class="mb15"> <?php echo $this->lang->line('label_filter_payment'); ?></h6>
                                            <label class="field select" for="filter-mode">
                                                <select id="filter-mode" name="payment_mode" <?php echo set_select('payment_mode');?>>
                                                    <option value="" selected="selected"><?php echo $this->lang->line('label_payment_mode'); ?></option>
                                                    <option value="bank"><?php echo $this->lang->line('label_payment_bank'); ?></option>
                                                    <option value="ewallet"><?php echo $this->lang->line('label_payment_ewallet'); ?></option>
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
                                    <div class="col-md-8">
                                        <?php echo $this->lang->line('page_title'); ?>
                                    </div>
                                    <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/orders/add" data-original-title="<?php echo $this->lang->line('label_add_new'); ?>"><i class="fa fa-plus"></i></a></span>
                                    </div>
                                    <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-danger " title="" data-toggle="tooltip" href="javascript:void(0)" onclick="deleteAll()" data-original-title="<?php echo $this->lang->line('label_delete'); ?>"><i class="fa fa-remove"></i></a></span>
                                    </div>
                                </div>

                                <?php //echo $this->lang->line('page_title'); ?>
                                <!-- <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/orders/add" data-original-title="Add New"><i class="fa fa-plus"></i></a></span> -->
                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="table-responsive">
                                <form id="form-orders" method="post" action="<?php echo base_url();?>admin/orders/deleteall">
                                    <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>
                                                <label class="option block mn">
                                                    <input type="checkbox" name="selectall" value="" id="selectall">
                                                    <span class="checkbox mn"></span>
                                                </label>
                                            </th>
                                            <th class="va-m"><?php echo $this->lang->line('label_order_number'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_user_name'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_payment_mode'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_amount'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_payment_date'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_status'); ?></th>
                                            <th class="va-m"><?php echo $this->lang->line('label_action'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        // print_r($this->data);
                                            $orders = $this->data['orders'];
                                            
                                            if($orders) {
                                            foreach ($orders as $row) {

                                            //$prodcut_info = $this->product_model->GetProduct($row->ProductId);
                                            //$user = $this->common_model->GetCustomer($this->input->post('order_user'));
                                            
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <label class="option block mn">
                                                    <input type="checkbox" name="orders[]" value="<?php echo $row->OrderId;?>" class="case">
                                                    <span class="checkbox mn"></span>
                                                </label>
                                            </td>
                                            
                                            <td class="text-center"><?php echo $row->OrderNumber;?></td>
                                            <td class="text-left"><?php echo $row->FirstName;?></td>
                                            <td class="text-center"><?php echo ($row->PaymentMethod) ? $row->PaymentMethod : 'Bank';?></td>
                                            <td class="text-right"><?php echo currency().$row->OrderTotal;?></td>
                                            <td class="text-center"><?php echo date('Y-m-d',strtotime($row->DateAdded));?></td>
                                            <?php 
                                                // echo $row->Status;
                                                if($row->Status=='pending') {
                                                    $tic_status = 'btn-primary';
                                                } else if($row->Status=='paid') {
                                                    $tic_status = 'btn-success';
                                                } else {
                                                    $tic_status = 'btn-danger';
                                                }

                                            ?>
                                            <td class="">
                                                <div class="btn-group text-right">
                                                    <button aria-expanded="true" data-toggle="dropdown" class="btn <?php echo $tic_status;?> br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo ucwords($row->Status); ?>
                                                        <!-- <span class="caret ml5"></span> -->
                                                    </button>
                                                </div>
                                            </td>
                                            <!--<td class="allcp-form">
                                                <label class="block mt15 switch switch-primary">
                                                    <input type="checkbox" <?php if($row->Status=='1') echo 'checked'; ?> id="t<?php echo $row->OrderId;?>" name="status" class="status" value="<?php echo $row->OrderId;?>">
                                                    <label data-off="OFF" data-on="ON" for="t<?php echo $row->OrderId;?>"></label>
                                                    <span><?php //echo $row->MemberStatus;?></span>
                                                </label>
                                            </td>-->
                                            <td class="">
                                            
                                                <div class="btn-group text-right">
                                                    <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo $this->lang->line('label_action'); ?>
                                                        <span class="caret ml5"></span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo base_url().'admin/orders/edit/'.$row->OrderId;?>"><?php echo $this->lang->line('label_edit'); ?></a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url().'admin/orders/invoice/'.$row->OrderId;?>"><?php echo $this->lang->line('label_view'); ?></a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url().'admin/orders/delete/'.$row->OrderId;?>"><?php echo $this->lang->line('label_delete'); ?></a>
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
                                </form>
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

<!--  jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>


<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/sales-stats-clients.js"></script>

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

function deleteAll(){
    if($('.case:checked').length) {
     confirm('Are you sure?') ? $('#form-orders').submit() : false;
    }
}

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/orders/inactive/'+id,
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
                    url:'<?php echo base_url();?>admin/orders/active/'+id,
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
