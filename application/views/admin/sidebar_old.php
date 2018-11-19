<!--  Sidebar   -->
    <aside id="sidebar_left" class="nano nano-light affix">

        <!--  Sidebar Left Wrapper   -->
        <div class="sidebar-left-content nano-content">

            <!--  Sidebar Header  -->
            <header class="sidebar-header">

                <!--  Sidebar - Author  -->
                <div class="sidebar-widget author-widget">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="<?php echo base_url();?>assets/img/avatars/icon.png" class="img-responsive">
                        </a>

                        <div class="media-body">
                            <div class="media-links">
                                <a href="#" class="sidebar-menu-toggle">User Menu -</a> <a href="<?php echo base_url();?>admin/logout">Logout</a>
                            </div>
                            <div class="media-author"><?php echo $this->session->userdata('full_name');?></div>
                        </div>
                    </div>
                </div>

                <!--  Sidebar - Author Menu   -->
                <div class="sidebar-widget menu-widget">
                    <div class="row text-center mbn">
                        <div class="col-xs-2 pln prn">
                            <a href="dashboard1.html" class="text-primary" data-toggle="tooltip" data-placement="top"
                               title="Dashboard">
                                <span class="fa fa-dashboard"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="charts-highcharts.html" class="text-info" data-toggle="tooltip"
                               data-placement="top"
                               title="Stats">
                                <span class="fa fa-bar-chart-o"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="sales-stats-products.html" class="text-system" data-toggle="tooltip"
                               data-placement="top" title="Orders">
                                <span class="fa fa-info-circle"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="sales-stats-purchases.html" class="text-warning" data-toggle="tooltip"
                               data-placement="top" title="Invoices">
                                <span class="fa fa-file"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="basic-profile.html" class="text-alert" data-toggle="tooltip" data-placement="top"
                               title="Users">
                                <span class="fa fa-users"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="management-tools-dock.html" class="text-danger" data-toggle="tooltip"
                               data-placement="top" title="Settings">
                                <span class="fa fa-cogs"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </header>
            <!--  /Sidebar Header  -->

            <!--  Sidebar Menu   -->
            <ul class="nav sidebar-menu">
                <li class="sidebar-label pt30">Menu</li>

                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin">
                        <span class="fa fa-dashboard"></span>
                        <span class="sidebar-title">Dashboard</span>
                        
                    </a>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Customers</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/customers/add">
                                <span class="fa fa-file-text-o"></span> Create Customer </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/customers">
                                <span class="fa fa-file-text-o"></span> Customers </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/export">
                                <span class="fa fa-file-text-o"></span> Export </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/category">
                        <span class="fa fa-share-square-o"></span>
                        <span class="sidebar-title">E-Commerce</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/category">
                                <span class="glyphicon glyphicon-tags"></span> Category </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/product">
                                <span class="glyphicon glyphicon-tags"></span> Products </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/orders">
                                <span class="glyphicon glyphicon-tags"></span> Orders </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/coupon/">
                                <span class="glyphicon glyphicon-tags"></span> Coupons </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/statement">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Finance</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/statement/sales">
                                <span class="fa fa-file-text-o"></span> Sales Statements </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/statement/income">
                                <span class="fa fa-file-text-o"></span> Income Statements </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/transaction">
                                <span class="fa fa-file-text-o"></span> Transaction History </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/statement/withdraw">
                                <span class="fa fa-file-text-o"></span> Withdraw List </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/statement/payouts">
                                <span class="fa fa-file-text-o"></span> Payouts </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/ewallet">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">E-Wallet</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/ewallet/balance">
                                <span class="fa fa-file-text-o"></span> Balance </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/ewallet/withdraw">
                                <span class="fa fa-file-text-o"></span> Withdraw Settings </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">MLM</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/mlm/settings">
                                <span class="fa fa-file-text-o"></span> Settings </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/mlm/importexport">
                                <span class="fa fa-file-text-o"></span> Import / Export </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/mlm/importexport">
                                <span class="fa fa-file-text-o"></span> Pools </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/mlm/importexport">
                                <span class="fa fa-file-text-o"></span> Create Pool </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Preference</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/preference/email">
                                <span class="fa fa-file-text-o"></span> E-Mail Templates </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/preference/news">
                                <span class="fa fa-file-text-o"></span>News Letter </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/preference/testimonial">
                                <span class="fa fa-file-text-o"></span> Manage Testimonials </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/preference/sms">
                                <span class="fa fa-file-text-o"></span> SMS Management</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Manage Epin</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/epin/add">
                                <span class="fa fa-file-text-o"></span> Create Epin </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/epin/product">
                                <span class="fa fa-file-text-o"></span> Manage Epin Product </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/epin/track">
                                <span class="fa fa-file-text-o"></span> Tracking Epin </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/epin/export">
                                <span class="fa fa-file-text-o"></span> Export Epin</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Messanger</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/messanger/add">
                                <span class="fa fa-file-text-o"></span> Create Message </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/messanger">
                                <span class="fa fa-file-text-o"></span> Manage Message </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Marketing</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/market/text">
                                <span class="fa fa-file-text-o"></span> Managing Text </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/market/image">
                                <span class="fa fa-file-text-o"></span> Managing Image </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/market/video">
                                <span class="fa fa-file-text-o"></span> Managing Video </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="fa fa-share-square-o"></span>
                        <span class="sidebar-title">Settings</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/generalsetting">
                                <span class="glyphicon glyphicon-tags"></span> <?php echo ucwords('Site Settings'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/paymentsetting">
                                <span class="glyphicon glyphicon-tags"></span> <?php echo ucwords('Payment Settings');?> </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/registersetting">
                                <span class="fa fa-money"></span> <?php echo ucwords('Register Settings'); ?></a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa fa-users"></span> <?php echo ucwords('mlm Settings'); ?> </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/smtpsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('smtp Settings'); ?> </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/fundsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('fund transfer Settings'); ?> </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/withsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('withdraw Settings'); ?> </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/recurringsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('Recurring Settings'); ?> </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">CMS</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/cms/add">
                                <span class="fa fa-file-text-o"></span> Create CMS </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/cms/add">
                                <span class="fa fa-file-text-o"></span> Managing CMS </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Report</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/report/customers">
                                <span class="fa fa-file-text-o"></span> Customers </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/sales">
                                <span class="fa fa-file-text-o"></span> Sales </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/commission">
                                <span class="fa fa-file-text-o"></span> Commission </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/bonus">
                                <span class="fa fa-file-text-o"></span> Bonus </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/payout">
                                <span class="fa fa-file-text-o"></span> Payouts </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Replicated website</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/replicate/add">
                                <span class="fa fa-file-text-o"></span> Create Replicated </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/replicate">
                                <span class="fa fa-file-text-o"></span> Managing Replicated </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Ticket System</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/ticket/add">
                                <span class="fa fa-file-text-o"></span> Create Ticket </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/ticket/add">
                                <span class="fa fa-file-text-o"></span> Tracking Ticket </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/customers">
                        <span class="fa fa-user"></span>
                        <span class="sidebar-title">Utllities</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/utllity/database">
                                <span class="fa fa-file-text-o"></span> Database Migration </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/utllity/ban">
                                <span class="fa fa-file-text-o"></span> Ban IP </a>
                        </li>
                        
                    </ul>
                </li>
                
                
                
            </ul>
            <!--  /Sidebar Menu   -->

            <!--  Sidebar Hide Button  -->
            <div class="sidebar-toggler">
                <a href="#">
                    <span class="fa fa-arrow-circle-o-left"></span>
                </a>
            </div>
            <!--  /Sidebar Hide Button  -->

        </div>
        <!--  /Sidebar Left Wrapper   -->

    </aside>