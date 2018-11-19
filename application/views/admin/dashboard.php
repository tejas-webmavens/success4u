
<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!--  CSS - theme  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/skin/default_skin/css/theme.css">

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.min.css">

    <!--  Plugins  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/c3charts/c3.min.css">

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

<!--  Body Wrap   -->
<div id="main">

    <!--  Header   -->
    <?php $this->load->view('admin/topnav');?>

    <!--  Sidebar   -->
    <?php $this->load->view('admin/sidebar');?>

    <!--  Main Wrapper  -->
    <section id="content_wrapper">

        <!--  Topbar Menu Wrapper  -->
        <?php $this->load->view('admin/toper');?>

        <!--  Topbar Menu Wrapper  -->
        <?php $this->load->view('admin/topmenu');?>

        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">
                <!-- <div class="row">
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
                </div> -->
                <div class="row">
                    <div class="col-sm-6 col-md-4 ph10">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="<?php echo base_url();?>assets/img/pages/clipart0.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h6 class="text-muted">TODAY ORDERS</h6>
                                        <?php 
                                            $NewOrder = $this->common_model->GetTodayorder();

                                        ?>
                                        <h2 class="fs40 mt5 mbn"><?php echo currency().number_format(($NewOrder) ? $NewOrder : '0',2);?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 ph10">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="<?php echo base_url();?>assets/img/pages/clipart1.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h6 class="text-muted">TODAY COMMISSIONS</h6>
                                        <?php 
                                            $admin_commision = $this->common_model->GetTodayComm();
                                        ?>
                                        <h2 class="fs40 mt5 mbn"><?php echo currency().number_format(($admin_commision) ? $admin_commision : '0', 2);?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden-sm col-md-4 ph10">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-5 ph10"><img src="<?php echo base_url();?>assets/img/pages/clipart2.png"
                                                                    class="img-responsive mauto" alt=""/></div>
                                    <div class="col-xs-7 pl5">
                                        <h6 class="text-muted">TODAY SIGN-UPS</h6>
                                        <?php 
                                            $NewMember = $this->common_model->GetAllMembers();
                                        ?>
                                        <h2 class="fs40 mt5 mbn"><span style="font-size:30px"><?php echo ($newmember) ? $newmember: '0';?></span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="row">
                    
                     <div class="col-md-4">
                        <div class="well bg-primary-lighten">
                            <div class="widget-tile">
                                <section>
                                <h5>NEW <strong>SIGN-UPS</strong> </h5>
                                <div><span style="font-size:30px"><?php echo ($newmember) ? $newmember: '0';?></span> today</div>
                                <div class="progress progress-xs progress-white progress-over-tile">
                                <div aria-valuemax="0" aria-valuetransitiongoal="0" class="progress-bar progress-bar-danger" style="" aria-valuenow="0"></div>
                                </div>
                                <label class="progress-label label-white"> This month: 0 </label><br>
                                <label class="progress-label label-white"> Last month: 0 </label>
                                </section>
                            <div class="hold-icon"><i class="fa fa-users"></i></div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well bg-success-darken">
                            <div class="widget-tile">
                                <section>
                                    <h5>NEW <strong>ORDERS</strong> </h5>
                                    
                                    <div><span style="font-size:30px">$<?php echo number_format(($orders->OrderTotal) ? $orders->OrderTotal : '0',2);?></span> today</div>
                                    <div class="progress progress-xs progress-white progress-over-tile">
                                        <div aria-valuemax="0" aria-valuetransitiongoal="0" class="progress-bar progress-bar-danger" style="" aria-valuenow="0"></div>
                                    </div>
                                    <label class="progress-label label-white"> This month: $0.00 </label><br>
                                    <label class="progress-label label-white"> Last month: $0.00 </label>
                                </section>
                                <div class="hold-icon"><i class="fa fa-shopping-cart"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well bg-info-darken">
                            <div class="widget-tile">
                                <section>
                                <h5><strong>COMMISSIONS</strong> </h5>
                                <?php

                                ?>
                                <div><span style="font-size:30px"><?php echo number_format(($comm->Debit) ? $comm->Debit : '0', 2);?></span> today</div>
                                <div class="progress progress-xs progress-white progress-over-tile">
                                <div aria-valuemax="0.00" aria-valuetransitiongoal="0.00" class="progress-bar progress-bar-danger" style="" aria-valuenow="0"></div>
                                </div>
                                <label class="progress-label label-white"> This month: $0.00 </label><br>
                                <label class="progress-label label-white"> Last month: $0.00 </label>
                                </section>
                            <div class="hold-icon"><i class="fa fa-money"></i></div>
                          </div>
                        </div>
                    </div>
                </div> -->
                
                <div class="row">
                    <div class="col-xs-5">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> Top 10 Recruiters</span>
                            </div>
                            
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                        <thead>
                                        <tr class="bg-light">
                                            <th class="">Image</th>
                                            <th class="">User Name</th>
                                            <th class=""># Recruited</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($members) {
                                            arsort($members,true);
                                            $i = 1;
                                            foreach ($members as $key => $value) {
                                                if($i < 11) {
                                                    $member = $this->common_model->GetCustomer($key);
                                                    if($member) {
                                        ?>
                                        <tr>
                                            
                                            <?php 
                                                if($member->ProfileImage) 
                                                    $profile_image = base_url().$member->ProfileImage;
                                                else 
                                                    $profile_image = base_url().'assets/img/pages/clipart2.png';
                                            ?>
                                            <?php 
                                               if($member->MemberId == '1'){

                                                    if($member->ProfileImage) {
                                                        $profile_image = base_url().'uploads/UserProfileImage/'.$member->ProfileImage;
                                                    }
                                                     else {
                                                    $profile_image = base_url().'assets/img/pages/clipart2.png';

                                                    }
                                              } 
                                            ?>
                                            <td class=""><img class="img-circle" style="width:50px;" src="<?php echo $profile_image?>" alt="<?php echo $member->UserName;?>"/></td>
                                            <td class=""><?php echo $member->UserName;?></td>
                                            <td class=""><?php echo ($value) ? $value : '0';?></td>
                                        </tr>
                                        <?php
                                                    }
                                                    $i++;
                                                }
                                            }
                                        } else {   

                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="8">No Records Found!</td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> Top 10 Earners</span>
                            </div>
                            
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                        <thead>
                                        <tr class="bg-light">
                                            <th class="">Image</th>
                                            <th class="">User Name</th>
                                            <th class=""># Earnings</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($earners) {

                                            foreach ($earners as $earn) {
                                                $customer1 = $this->common_model->GetCustomer($earn->MemberId);
                                                if($customer1) {
                                                
                                        ?>
                                        <tr>
                                            
                                            <?php 
                                                if($customer1->ProfileImage) 
                                                    $profile_image = base_url().$customer1->ProfileImage;
                                                else 
                                                    $profile_image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';
                                            ?>

                                             <?php 
                                               if($customer1->MemberId == '1'){

                                                    if($customer1->ProfileImage) {
                                                        $profile_image = base_url().'uploads/UserProfileImage/'.$customer1->ProfileImage;
                                                    }
                                                     else {
                                                    $profile_image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';

                                                    }
                                              } 
                                            ?>
                                            <td class=""><img class="img-circle" style="width:50px;" src="<?php echo $profile_image?>" alt="<?php echo $customer1->UserName;?>"/></td>
                                            <td class=""><?php echo $customer1->UserName;?></td>
                                            <td class=""><?php echo $CurrencySymbol." ".$earn->earns;?></td>
                                        </tr>
                                        <?php 
                                                }
                                                }
                                            } else {   
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="8">No Records Found!</td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    
                                    </table>
                                    <?php //echo $balance->Balance;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="panel-title hidden-xs"> Top 10 Purchased</span>
                            </div>
                            
                            <div class="panel-body pn">
                                <div class="table-responsive">
                                    <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                        <thead>
                                        <tr class="bg-light">
                                            <th class="">Image</th>
                                            <th class="">User Name</th>
                                            <th class=""># Purchased Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                        if($purchased) {
                                            foreach ($purchased as $purchase) {
                                                if($purchase->MemberId) {
                                                    $customer = $this->common_model->GetCustomer($purchase->MemberId);
                                                    if($customer) {
                                    ?>
                                                        <tr>
                                                            
                                                            <?php 
                                                                if($customer->ProfileImage) 
                                                                    $profile_image = base_url().$customer->ProfileImage;
                                                                else 
                                                                    $profile_image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';
                                                            ?>

                                                            <?php 
                                               if($customer->MemberId == '1'){

                                                    if($customer->ProfileImage) {
                                                        $profile_image = base_url().'uploads/UserProfileImage/'.$customer->ProfileImage;
                                                    }
                                                     else {
                                                    $profile_image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';

                                                    }
                                              } 
                                            ?>
                                                            <td class=""><img class="img-circle" style="width:50px;" src="<?php echo $profile_image?>" alt="<?php echo $customer->UserName;?>"/></td>
                                                            <td class=""><?php echo $customer->UserName;?></td>
                                                            <td class=""><?php echo $CurrencySymbol." ".$purchase->OrderTotal;?></td>
                                                        </tr>
                                    <?php 
                                                        }
                                                }
                                            }
                                        } else {   
                                    ?>
                                        <tr>
                                            <td class="text-center" colspan="8">No Records Found!</td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--  Area Chart  -->
                <!-- <div class="row">
                    <div class="col-md-6">
                        
                        <div class="panel" id="pchart1">
                            <div class="panel-heading">
                                <span class="panel-title"> Best Sellers</span>
                            </div>
                            <div class="panel-body">
                                <div id="area-chart1" style="height: 420px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="panel" id="pchart9">
                            <div class="panel-heading">
                                <span class="panel-title fw600">Visitor Activity</span>
                            </div>
                            <div class="panel-body pn">
                                <div id="high-datamap" style="width: 100%; height: 300px; margin: 0 auto"></div>
                            </div>
                            <div class="panel-footer bg-light pn">
                                <div id="high-siblingmap" style="width: 100%; height: 150px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel" id="pchart6">
                            <div class="panel-heading">
                              <span class="panel-title text-info fw600"> <i class="fa fa-pencil hidden"></i> Credit and Debit chart</span>
                            </div>
                            <div class="panel-menu br3 mt20">
                                <div class="chart-legend" data-chart-id="#high-line3">
                                    <a type="button" data-chart-id="0" class="legend-item btn btn-sm btn-warning">Income</a>
                                    <a type="button" data-chart-id="2" class="legend-item btn btn-info btn-sm">Sales</a>
                                </div>
                            </div>
                            <div class="panel-body pn">
                                <div id="high-line3" style="width: 100%; height: 410px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--  Quick Links  -->
                <!-- <div class="row">
                    <div class="col-md-9">
                        
                        <div class="panel">
                            <div class="panel-heading">
                        <span class="panel-title fw600">
                            <i class="fa fa-pencil hidden"></i> Sales stats</span>
                            </div>
                            <div class="panel-body pn">


                                <div id="high-line2" style="width: 100%; height: 250px; margin: 0 auto"></div>


                                <div class="p15 pt5 mt15 bg-light br-t">
                                    <div class="table-responsive">
                                        <table class="table mbn allcp-form fs13 table-legend" data-chart-id="#high-line2">
                                            <thead>
                                            <tr class="">
                                                <th class="w30">ID</th>
                                                <th class="w50">Chart</th>
                                                <th>Year</th>
                                                <th class="text-right">Total Sales</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="fs15 fw600">1.</td>
                                                <td>
                                                    <label class="switch switch-warning block mbn">
                                                        <input type="checkbox" class="legend-switch" name="features" id="s1" value="0">
                                                        <label for="s1" data-on="ON" data-off="OFF"></label>
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="fs20 va-m fw600 text-muted">
                                                    2013
                                                </td>
                                                <td class="fs15 fw600 text-right">15,163</td>
                                            </tr>
                                            <tr>
                                                <td class="fs15 fw600">2.</td>
                                                <td>
                                                    <label class="switch switch-primary block mbn">
                                                        <input type="checkbox" class="legend-switch" name="features" id="s2" value="1">
                                                        <label for="s2" data-on="ON" data-off="OFF"></label>
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="fs20 va-m fw600 text-muted">
                                                    2014
                                                </td>
                                                <td class="fs15 fw600 text-right">19,858</td>
                                            </tr>
                                            <tr>
                                                <td class="fs15 fw600">3.</td>
                                                <td>
                                                    <label class="switch switch-alert block mbn">
                                                        <input type="checkbox" class="legend-switch" name="features" id="s3" value="3">
                                                        <label for="s3" data-on="ON" data-off="OFF"></label>
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td class="fs20 va-m fw600 text-muted">
                                                    2015
                                                </td>
                                                <td class="fs15 fw600 text-right">17,525</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img src="<?php echo base_url();?>assets/img/pages/clipart0.png"
                                                                            class="img-responsive mauto" alt=""/></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">TOTAL ORDERS</h6>
                                                <?php 
                                                    $NewOrder = $this->common_model->GetNewOrders();
                                                ?>
                                                <h2 class="fs40 mt5 mbn"><?php echo $NewOrder;?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img src="<?php echo base_url();?>assets/img/pages/clipart1.png"
                                                                            class="img-responsive mauto" alt=""/></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">TOTAL PRODUCTS</h6>
                                                <?php 
                                                    $NewProducts = $this->common_model->GetNewProducts();
                                                ?>
                                                <h2 class="fs40 mt5 mbn"><?php echo $NewProducts;?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden-sm col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img src="<?php echo base_url();?>assets/img/pages/clipart2.png"
                                                                            class="img-responsive mauto" alt=""/></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">TOTAL CUSTOMERS</h6>
                                                <?php 
                                                    $NewMember = $this->common_model->GetNewMembers();
                                                ?>
                                                <h2 class="fs40 mt5 mbn"><?php echo $NewMember;?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
            <!--  /Column Center  -->

        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <?php $this->load->view('admin/sidebar_right');?>

</div>
<!--  /Body Wrap   -->

<!-- footer -->
<?php //$this->load->view('admin/footer');?>
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  HighCharts Plugin  -->
<script src="<?php echo base_url();?>assets/js/plugins/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/c3charts/d3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/c3charts/c3.min.js"></script>

<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<!--<script src="<?php echo base_url();?>assets/js/pages/dashboard2.js"></script>-->

<!--  Page JS  -->
<script src="<?php echo base_url();?>assets/js/demo/charts/highcharts.js"></script>

<!-- <script src="assets/js/demo/charts/highcharts.js"></script> -->

<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // ChighCharts JS
        demoHighCharts.init();
        /* Hichcharts functions */


    });
    var demoHighCharts = function () {

    // Hichcharts colors
    var highColors = [bgWarning, bgPrimary, bgInfo, bgAlert,
        bgDanger, bgSuccess, bgSystem, bgDark
    ];

    // Spark colors
    var sparkColors = {
        "primary": [bgPrimary, bgPrimaryLr, bgPrimaryDr],
        "info": [bgInfo, bgInfoLr, bgInfoDr],
        "warning": [bgWarning, bgWarningLr, bgWarningDr],
        "success": [bgSuccess, bgSuccessLr, bgSuccessDr],
        "alert": [bgAlert, bgAlertLr, bgAlertDr]
    };

    // High Charts Demo
    var demoHighCharts = function () {
        

        var demoHighLines = function () {
           

            var line3 = $('#high-line3');

            if (line3.length) {

                // High Line 3
                $('#high-line3').highcharts({
                    credits: false,
                    colors: highColors,
                    chart: {
                        backgroundColor: '#f4f7f9',
                        className: 'br-r',
                        type: 'line',
                        zoomType: 'x',
                        panning: true,
                        panKey: 'shift',
                        marginTop: 25,
                        marginRight: 1
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        gridLineColor: '#e5eaee',
                        lineColor: '#e5eaee',
                        tickColor: '#e5eaee',
                        categories: ['Jan', 'Feb', 'Mar', 'Apr',
                            'May', 'Jun', 'Jul', 'Aug',
                            'Sep', 'Oct', 'Nov', 'Dec'
                        ]
                    },
                    yAxis: {
                        min: 0,
                        tickInterval: 10,
                        gridLineColor: '#e5eaee',
                        title: {
                            text: null
                        }
                    },
                    plotOptions: {
                        spline: {
                            lineWidth: 3
                        },
                        area: {
                            fillOpacity: 0.2
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                        name: 'income',
                        data: [<?php echo $income_chart_data;?>]
                    }, {
                        name: 'Expense',
                        data: [<?php echo $outcome_chart_data;?>]
                    }]
                });

            }

        }; // End High Line Charts Demo

        // Init Chart Types
        
        demoHighLines();
        

    }; // End High Charts Demo

    return {
        init: function () {
            // Init Demo Charts
            demoHighCharts();
        }
    }
}();
</script>

</body>

</html>
