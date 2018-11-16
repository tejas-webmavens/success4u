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
<?php $this->load->view('admin/customizer'); ?>
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
        <section id="content" class="">
        <?php $order = $this->data['order'][0]; 
        // print_r($order);
        ?>

            <div class="panel invoice-panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Order</span>

                    <div class="panel-header-menu pull-right mr10">
                        
                        <a href="javascript:window.print()" class="btn btn-xs btn-default btn-gradient mr5">
                            <i class="fa fa-print fs13"></i>
                        </a>

                    </div>
                </div>
                <div class="panel-body p20" id="invoice-item">

                    <div class="row mb30">
                        <div class="col-md-4">
                            <div class="pull-left">
                                <h5 class="mn"> <?php echo $this->lang->line('label_payment_date'); ?>: <?php echo date('Y-m-d',strtotime($order->DateAdded)); ?> </h5>
                                <!-- <h5 class="mn"> Status:
                                    <b class="text-success">Paid</b>
                                </h5> -->
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right text-right">
                                <h2 class="invoice-logo-text hidden lh10">ThemeREX</h2>
                                <h6> <?php echo $this->lang->line('label_sales_rep'); ?>
                                    <b class="text-primary">ARMCIP</b>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="invoice-info">
                        <div class="col-md-6">
                            <div class="">
                                <h6>Order Details</h6>
                                <p class=""><?php echo $this->lang->line('label_order_number'); ?>: <?php echo $order->OrderNumber; ?></p>
                                <p class=""><?php echo $this->lang->line('label_user_name'); ?>: <?php echo $order->FirstName.' '.$order->LastName; ?></p>
                                <p class=""><?php echo $this->lang->line('label_payment_mode'); ?>: <?php echo ($order->PaymentMethod) ? $order->PaymentMethod : 'Bank' ; ?></p>
                                <p class=""><?php echo $this->lang->line('label_order_status'); ?>: <?php echo $order->Status; ?></p>
                                <p class=""><?php echo $this->lang->line('label_payment_date'); ?>: <?php echo date('Y-m-d',strtotime($order->DateAdded)); ?></p>
                                <!-- <p><?php echo $this->lang->line('label_payment_date'); ?>:</p>
                                <p><?php echo $this->lang->line('label_payment_date'); ?>:</p> -->
                            </div>
                            
                        </div>
                        <!--<div class="col-md-4">
                            <div class="">
                                <h6>Product Details</h6>
                                <p class=""><?php echo $this->lang->line('label_order_product'); ?>: <?php echo $order->ProductId; ?></p>
                                <p class=""><?php echo $this->lang->line('label_product_price'); ?>: <?php echo $order->Price; ?></p>
                                <p class=""><?php echo $this->lang->line('label_product_quantity'); ?>: <?php echo ($order->Quantity) ? $order->Quantity : 'Bank' ; ?></p>
                                <p class=""><?php echo $this->lang->line('label_order_total'); ?>: <?php echo currency().$order->OrderTotal; ?></p>
                                <p class=""><?php echo $this->lang->line('label_order_date'); ?>: <?php echo date('Y-m-d',strtotime($order->DateAdded)); ?></p>
                            </div>
                        </div>-->
                        <div class="col-md-6">
                            <div class="">
                                <h6>Ship To</h6>
                                <p class=""><?php echo $this->lang->line('label_shipping_user'); ?>: <?php echo $order->ShipFirstName.' '.$order->ShipLastName; ?></p>
                                <p class=""><?php echo $this->lang->line('label_shipping_address'); ?>: <?php echo $order->ShipAddress1.' '.$order->ShipAddress2; ?></p>
                                <p class=""><?php echo $this->lang->line('label_shipping_city'); ?>: <?php echo $order->ShipCity.' - '.$order->ShipZip; ?></p>
                                <p class=""><?php echo $this->lang->line('label_shipping_state'); ?>: <?php echo $order->ShipState; ?></p>
                                <p class=""><?php echo $this->lang->line('label_shipping_country'); ?>: <?php echo $order->ShipCountry; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="invoice-table">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="hidden-xs">#</th>
                                    <th>Item</th>
                                    <th style="width: 135px;">Quantity</th>
                                    <th class="hidden-xs">Rate</th>
                                    <th class="text-right pr10">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $products = $this->order_model->GetOrderProducts($order->OrderId);
                                    //print_r($products);
                                    foreach ($products as $row) { ?>
                                        <tr>
                                            <td class="hidden-xs">
                                                <b><?php echo $row->OrderId;?></b>
                                            </td>
                                            <td><?php echo $row->ProductName;?></td>
                                            <td><?php echo $row->Quantity;?></td>
                                            <td class="hidden-xs"><?php echo currency().$row->Price; ?></td>
                                            <td class="text-right pr10"><?php echo currency().$row->Total; ?></td>
                                        </tr>
                                    <?php 
                                        } 
                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" id="invoice-footer">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <table class="table" id="basic-invoice-result">
                                    <thead>
                                    <tr>
                                        <th>
                                            <b>Sub Total:</b>
                                        </th>
                                        <th><?php echo currency().$order->OrderTotal; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td>
                                            <b>Total</b>
                                        </td>
                                        <td><?php echo currency().$order->OrderTotal; ?></td>
                                    </tr>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="<?php echo base_url().'admin/orders/add';?>" id="form-edit-coupon">
                    <div class="row mt20">
                        <div class="col-md-12">

                            <div class="row mb20">
                                <div class="col-md-4 ph10">
                                    <?php echo $this->lang->line('label_order_status'); ?>
                                </div>

                                <div class="col-md-8 ph10 allcp-form">
                                    <label class="field select">
                                        <select id="order_status" name="order_status">
                                            <option value="paid" <?php echo set_select('order_status');?> <?php if($order->Status=='paid') echo 'selected';?>>Paid</option>
                                            <option value="unpaid" <?php echo set_select('order_status');?> <?php if($order->Status=='unpaid') echo 'selected';?>>Un Paid</option>
                                            <option value="cancelled" <?php echo set_select('order_status');?> <?php if($order->Status=='cancelled') echo 'selected';?> >Cancelled</option>
                                            <option value="pending" <?php echo set_select('order_status');?> <?php if($order->Status=='pending') echo 'selected';?> >Pending</option>
                                        </select>
                                        <i class="arrow double"></i>
                                    </label>
                                </div>
                            </div>
                            <?php echo form_error('order_status');?>
                            <div class="row mb20">
                                <div class="col-md-4 ph10">
                                    <?php echo $this->lang->line('label_order_coment'); ?>

                                </div>
                                <div class="col-md-8 ph10 allcp-form">
                                    <div class="section" id="spy3">
                                        <label for="comment" class="field prepend-icon">
                                            <textarea class="gui-textarea" id="comment" name="comment" placeholder="<?php echo $this->lang->line('place_order_comment'); ?>"><?php echo set_value('comment', urldecode($order->Comment)); ?></textarea>
                                            <label for="comment" class="field-icon">
                                                <i class="fa fa-comment"></i>
                                            </label>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="OrderId" value="<?php if(isset($order->OrderId)) echo $order->OrderId;?>"/>

                            <div class="clearfix"></div>
                            <div class="row mb20">
                                <div class="pull-right">
                                    <button class="btn btn-primary mb5" type="submit">
                                        <i class="fa fa-floppy-o pr5"></i> <?php echo $this->lang->line('btn_update_coupon'); ?>
                                    </button>
                                </div>
                            </div>


                            

                            <!-- <div class="clearfix"></div> -->
                            
                        </div>
                    </div>
                    </form>

                </div>
            </div>

        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->

<!--  jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  HighCharts Plugin  -->
<script src="<?php echo base_url();?>assets/js/plugins/highcharts/highcharts.js"></script>

<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

    });
</script>
<!--  /Scripts  -->

</body>

</html>
