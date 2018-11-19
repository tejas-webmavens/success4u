<!--  Sidebar   -->
<?php $mlsetting  = $this->common_model->GetRow("MatrixStatus='1'","arm_matrixsetting"); ?>
    <aside id="sidebar_left" class="nano nano-light affix">

        <!--  Sidebar Left Wrapper   -->
        <div class="sidebar-left-content nano-content">

            <!--  Sidebar Header  -->
            <header class="sidebar-header">

                <!--  Sidebar - Author  -->
                <div class="sidebar-widget author-widget">
                    <div class="media">
                        <a class="media-left" href="#">
                         <?php $path= $this->common_model->GetCustomer($this->session->userdata('MemberID')); ?>

                            <img alt="Image" src="<?php echo base_url()."uploads/UserProfileImage/";echo $path->ProfileImage;?>" class="img-responsive">
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
                            <a href="<?php echo base_url();?>admin" class="text-primary" data-toggle="tooltip" data-placement="top"
                               title="Dashboard">
                                <span class="fa fa-dashboard"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="<?php echo base_url();?>admin/orders" class="text-system" data-toggle="tooltip"
                               data-placement="top" title="Orders">
                                <span class="fa fa-info-circle"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="<?php echo base_url();?>admin/income" class="text-warning" data-toggle="tooltip"
                               data-placement="top" title="Invoices">
                                <span class="fa fa-file"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="<?php echo base_url();?>admin/customers" class="text-alert" data-toggle="tooltip" data-placement="top"
                               title="Users">
                                <span class="fa fa-users"></span>
                            </a>
                        </div>
                        <div class="col-xs-4 col-sm-2 pln prn">
                            <a href="<?php echo base_url();?>admin/generalsetting" class="text-danger" data-toggle="tooltip"
                               data-placement="top" title="Settings">
                                <span class="fa fa-cogs"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </header>
            <!--  /Sidebar Header  -->
            

            <?php 
                $userid = $this->session->userdata('MemberID');
                $userlevel = $this->session->userdata('UserLevel');
                if($userlevel==2) {
                    $access_list_data = $this->common_model->Subadminaccess($userid,$userlevel);
                    
                    $pages = json_decode($access_list_data->access_list);
                    
                    
                ?>
            <ul class="nav sidebar-menu">
                <li class="sidebar-label pt30">Menu</li>

                <li>
                    <a class="" href="<?php echo base_url();?>admin">
                        <span class="fa fa-dashboard"></span>
                        <span class="sidebar-title">Dashboard</span>
                        
                    </a>
                </li>
                
                <?php 
                    if(in_array('Subadmin', $pages)) {
                ?>
                <li>
                    <a class="" href="<?php echo base_url();?>admin/subadmin">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="sidebar-title">Subadmin</span>
                    </a>
                </li>
                <?php } ?>
                <?php 
                    if( in_array('Customers', $pages) || in_array('Mtapay', $pages) || in_array('Mtmpay', $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-star-empty"></span>
                        <span class="sidebar-title">Members</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/customers/add">
                                <span class="fa fa-file-text-o"></span> Create Members </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/customers">
                                <span class="fa fa-file-text-o"></span> Members </a>
                        </li>
                        <?php 
                            if(in_array('Mtapay', $pages) || in_array('Mtmpay', $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/mtapay">
                                <span class="fa fa-file-text-o"></span> Member Bankwire Payments </a>
                        </li>
                        <?php if($mlsetting->MTMPayStatus==1 ) { ?>    
                        <li>
                            <a href="<?php echo base_url();?>admin/mtmpay">
                                <span class="fa fa-file-text-o"></span> Member Payments </a>
                        </li>
                        <?php } ?>
                        <?php } ?> 
                    </ul>
                </li>
                <?php 
                    }
                ?>
                <?php if( in_array('Category', $pages) || in_array('Product', $pages) || in_array('Reviews', $pages)) { ?>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-euro"></span>
                        <span class="sidebar-title">E-Commerce</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('category'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/category">
                                <span class="glyphicon glyphicon-tags"></span> Category </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('product'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/product">
                                <span class="glyphicon glyphicon-tags"></span> Products </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('reviews'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/reviews">
                                <span class="glyphicon glyphicon-tags"></span> Reviews </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('orders'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/orders">
                                <span class="glyphicon glyphicon-tags"></span> Orders </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('coupon'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/coupon">
                                <span class="glyphicon glyphicon-tags"></span> Coupons </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('shipping'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-euro"></span>
                        <span class="sidebar-title">Shipping</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/shipping/shippingtotal">
                                <span class="glyphicon glyphicon-tags"></span> Shipping Total </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/shipping/shippingapi">
                                <span class="glyphicon glyphicon-tags"></span> Shipping Method</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('sales'), $pages) || in_array(ucfirst('income'), $pages) || in_array(ucfirst('transaction'), $pages) || in_array(ucfirst('withdraw'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-random"></span>
                        <span class="sidebar-title">Finance</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('sales'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/sales">
                                <span class="fa fa-file-text-o"></span> Sales Statements </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('income'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/income">
                                <span class="fa fa-file-text-o"></span> Income Statements </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('transaction'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/transaction">
                                <span class="fa fa-file-text-o"></span> Transactions History </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('withdraw'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/withdraw">
                                <span class="fa fa-file-text-o"></span> Payout request List </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('withdraw'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/withdraw/payouts">
                                <span class="fa fa-file-text-o"></span> Payouts </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('ewallet'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-level-up"></span>
                        <span class="sidebar-title">E-Wallet</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/ewallet/balance">
                                <span class="fa fa-file-text-o"></span> Balance </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/ewallet/addewallet">
                                <span class="fa fa-file-text-o"></span> Add to Ewallet </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('emailtemplate'), $pages) || in_array(ucfirst('sms'), $pages) || in_array(ucfirst('newsletter'), $pages) || in_array(ucfirst('testimonial'), $pages) || in_array(ucfirst('sms'), $pages) || in_array(ucfirst('transaction'), $pages) ) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-education"></span>
                        <span class="sidebar-title">Preference</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('emailtemplate'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/emailtemplate">
                                <span class="fa fa-file-text-o"></span> E-Mail Templates </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('sms'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/sms/template">
                                <span class="fa fa-file-text-o"></span> SMS Templates </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('newsletter'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/newsletter">
                                <span class="fa fa-file-text-o"></span>News Letter </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('testimonial'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/testimonial">
                                <span class="fa fa-file-text-o"></span> Manage Testimonials </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('sms'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/sms">
                                <span class="fa fa-file-text-o"></span> SMS Management</a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('transaction'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/latestnews">
                                <span class="fa fa-file-text-o"></span> Latest News</a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                if($mlsetting->Id!=9)
                {

                    if(in_array(ucfirst('epin'), $pages)) {
                ?>     <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-bookmark"></span>
                        <span class="sidebar-title">Manage Epin</span>
                        <span class="caret"></span>
                    </a>
                   <ul class="nav sub-nav">

                        <li>
                            <a href="<?php echo base_url();?>admin/epin/addpin">
                                <span class="fa fa-file-text-o"></span> Create Epin </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/epin/adduserrequest">
                                <span class="fa fa-file-text-o"></span> Create User Epin Request </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/epin/request">
                                <span class="fa fa-file-text-o"></span> Request Epin Management</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/epin/cancelurequests">
                                <span class="fa fa-file-text-o"></span>list of cancel Requests</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/epin">
                                <span class="fa fa-file-text-o"></span> Epin management</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/epin/expiryepin">
                                <span class="fa fa-file-text-o"></span> Expired Epins</a>
                        </li>
                    </ul>
                </li>
                <?php }
                } ?>
                <?php 
                    if(in_array(ucfirst('marketingtool'), $pages) || in_array(ucfirst('subscriber'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-lock"></span>
                        <span class="sidebar-title">Marketing</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('marketingtool'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/marketingtool">
                                <span class="fa fa-file-text-o"></span> Marketing Tools </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('subscriber'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/subscriber">
                                <span class="fa fa-file-text-o"></span> Subscriber List </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('autorespond'), $pages) || in_array(ucfirst('leadcapture'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/autorespond ">
                        <span class="glyphicon glyphicon-indent-right"></span>
                        <span class="sidebar-title">Autoresponder</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('autorespond'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/autorespond">
                                <span class="fa fa-file-text-o"></span> Auto Responder management</a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('leadcapture'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/leadcapture">
                                <span class="fa fa-file-text-o"></span>Lead Captures page</a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('Generalsetting'), $pages) || in_array(ucfirst('Paymentsetting'), $pages) || in_array(ucfirst('Registersetting'), $pages) || in_array(ucfirst('Mlmsetting'), $pages) || in_array(ucfirst('Smtpsetting'), $pages) || in_array(ucfirst('Rewardsetting'), $pages) || in_array(ucfirst('Fundsetting'), $pages) || in_array(ucfirst('Languagesetting'), $pages) || in_array(ucfirst('Currencysetting'), $pages) || in_array(ucfirst('Recurringsetting'), $pages) || in_array(ucfirst('Usersetting'), $pages) || in_array(ucfirst('Customfieldsetting'), $pages) || in_array(ucfirst('Captcha'), $pages) || in_array(ucfirst('pvsetting'), $pages) || in_array(ucfirst('boardplansetting'), $pages) || in_array(ucfirst('packagesetting'), $pages) ) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-cog"></span>
                        <span class="sidebar-title">Settings</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('Generalsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/generalsetting">
                                <span class="glyphicon glyphicon-tags"></span> <?php echo ucwords('Site Settings'); ?></a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Paymentsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/paymentsetting">
                                <span class="glyphicon glyphicon-tags"></span> <?php echo ucwords('Payment Settings');?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Registersetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/registersetting">
                                <span class="fa fa-money"></span> <?php echo ucwords('Register Settings'); ?></a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Mlmsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/mlmsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('mlm Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Smtpsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/smtpsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('smtp Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Rewardsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/rewardsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('reward Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Fundsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/fundsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('fund transfer Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Languagesetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/languagesetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('language setting'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Currencysetting'), $pages)) {
                        ?> 
                        <li>
                            <a href="<?php echo base_url();?>admin/currencysetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('currency setting'); ?> </a>
                        </li> 
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Recurringsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/recurringsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('Recurring Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Usersetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/usersetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('user Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Customfieldsetting'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/customfieldsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('customfield Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('Captcha'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/captcha">
                                <span class="fa fa-users"></span> <?php echo ucwords('captcha Settings'); ?> </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('pvsetting'), $pages) || in_array(ucfirst('boardplansetting'), $pages) || in_array(ucfirst('packagesetting'), $pages)) {
                        ?>
                       
                        <?php 
                            if($mlsetting->Id==4) { ?>         
                        <li>
                            <a href="<?php echo base_url();?>admin/pvsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('binary pv Settings'); ?> </a>
                        </li>
                        <?php }elseif($mlsetting->Id==5 || $mlsetting->Id==8) { ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/boardplansetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('board plan Settings'); ?> </a>
                        </li>
                        <?php }else{?>
                        <li>
                            <a href="<?php echo base_url();?>admin/packagesetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('packages Settings'); ?> </a>
                        </li>
                        <?php }?>
                        <?php } ?>
                          <?php 
                            if(in_array(ucfirst('Ranksettings'), $pages)) {
                        ?> 
                        <li>
                            <a href="<?php echo base_url();?>admin/ranksetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('Rank settings'); ?> </a>
                        </li> 
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('pages'), $pages) || in_array(ucfirst('navigation'), $pages) || in_array(ucfirst('faq'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-th"></span>
                        <span class="sidebar-title">CMS</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('pages'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/pages">
                                <span class="fa fa-file-text-o"></span> Pages </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('navigation'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/navigation">
                                <span class="fa fa-file-text-o"></span> CMS Menu </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('faq'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/faq">
                                <span class="fa fa-file-text-o"></span> FAQ's </a>
                        </li>
                        <?php } ?>
                        
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('report'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-list-alt"></span>
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
                            <a href="<?php echo base_url();?>admin/report/reward">
                                <span class="fa fa-file-text-o"></span> reward Commission </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/bonus">
                                <span class="fa fa-file-text-o"></span> Bonus </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/payout">
                                <span class="fa fa-file-text-o"></span> Payouts </a>
                        </li>
                       <!--  <li>
                            <a href="<?php echo base_url();?>admin/report/epin">
                                <span class="fa fa-file-text-o"></span> Epins </a>
                        </li> -->
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('ticket'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-tags"></span>
                        <span class="sidebar-title">Ticket System</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/ticket/add">
                                <span class="fa fa-file-text-o"></span> Create Ticket </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/ticket">
                                <span class="fa fa-file-text-o"></span> Tracking Ticket </a>
                        </li>
                        
                    </ul>
                </li>
                <?php } ?>
                <?php 
                    if(in_array(ucfirst('backup'), $pages)) {
                ?>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-scissors"></span>
                        <span class="sidebar-title">Utilities</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <?php 
                            if(in_array(ucfirst('backup'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/backup">
                                <span class="fa fa-file-text-o"></span> Database Migration </a>
                        </li>
                        <?php } ?>
                        <?php 
                            if(in_array(ucfirst('banned'), $pages)) {
                        ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/banned">
                                <span class="fa fa-file-text-o"></span> Ban IP </a>
                        </li>
                        <?php } ?>
                        
                    </ul>
                </li>
                <?php } ?>
                 
            </ul>
            <?php } else {?>
                <!--  Sidebar Menu   -->
            <ul class="nav sidebar-menu">
                <li class="sidebar-label pt30">Menu</li>

                <li>
                    <a class="" href="<?php echo base_url();?>admin">
                        <span class="fa fa-dashboard"></span>
                        <span class="sidebar-title">Dashboard</span>
                        
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo base_url();?>admin/subadmin">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="sidebar-title">Subadmin</span>
                        
                    </a>
                </li>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-star-empty"></span>
                        <span class="sidebar-title">Members</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/customers/add">
                                <span class="fa fa-file-text-o"></span> Create Members </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/customers">
                                <span class="fa fa-file-text-o"></span> Members </a>
                        </li>
                        <li >
                           <!--  <a href="<?php echo base_url();?>admin/export/archive/members"> -->
                            <a href="<?php echo base_url();?>admin/report/customers">
                                <span class="fa fa-file-text-o"></span> Export </a>
                        </li>
                        <li >
                           <!--  <a href="<?php echo base_url();?>admin/export/archive/members"> -->
                            <a href="<?php echo base_url();?>admin/mtapay">
                                <span class="fa fa-file-text-o"></span> Member Bankwire Payments </a>
                        </li>
                        <?php if($mlsetting->MTMPayStatus==1 ) { ?>    
                        <li >
                            <a href="<?php echo base_url();?>admin/mtmpay">
                                <span class="fa fa-file-text-o"></span> Member Payments </a>
                        </li>
                        <?php } ?> 
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-euro"></span>
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
                            <a href="<?php echo base_url();?>admin/reviews">
                                <span class="glyphicon glyphicon-tags"></span> Reviews </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/orders">
                                <span class="glyphicon glyphicon-tags"></span> Orders </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/coupon">
                                <span class="glyphicon glyphicon-tags"></span> Coupons </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-euro"></span>
                        <span class="sidebar-title">Shipping</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/shipping/shippingtotal">
                                <span class="glyphicon glyphicon-tags"></span> Shipping Total </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/shipping/shippingapi">
                                <span class="glyphicon glyphicon-tags"></span> Shipping Method</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-random"></span>
                        <span class="sidebar-title">Finance</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/sales">
                                <span class="fa fa-file-text-o"></span> Sales Statements </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/income">
                                <span class="fa fa-file-text-o"></span> Income Statements </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/transaction">
                                <span class="fa fa-file-text-o"></span> Transactions History </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/withdraw">
                                <span class="fa fa-file-text-o"></span> Payout request List </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/withdraw/payouts">
                                <span class="fa fa-file-text-o"></span> Payouts </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-level-up"></span>
                        <span class="sidebar-title">E-Wallet</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/ewallet/balance">
                                <span class="fa fa-file-text-o"></span> Balance </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/ewallet/addewallet">
                                <span class="fa fa-file-text-o"></span> Add to Ewallet </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/withdrawsetting">
                                <span class="fa fa-file-text-o"></span> Withdraw Settings </a>
                        </li>
                    </ul>
                </li>
                
                <!-- <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-tower"></span>
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
                </li> -->

                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-education"></span>
                        <span class="sidebar-title">Preference</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/emailtemplate">
                                <span class="fa fa-file-text-o"></span> E-Mail Templates </a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url();?>admin/sms/template">
                                <span class="fa fa-file-text-o"></span> SMS Templates </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/newsletter">
                                <span class="fa fa-file-text-o"></span>News Letter </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/testimonial">
                                <span class="fa fa-file-text-o"></span> Manage Testimonials </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/sms">
                                <span class="fa fa-file-text-o"></span> SMS Management</a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/latestnews">
                                <span class="fa fa-file-text-o"></span> Latest News</a>
                        </li>
                         <li >
                            <a href="<?php echo base_url();?>admin/banner">
                                <span class="fa fa-file-text-o"></span>Banner Image</a>
                        </li>
                    </ul>
                </li>

                <?php
                    if($mlsetting->Id!=9)
                    {?>


                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-bookmark"></span>
                        <span class="sidebar-title">Manage Epin</span>
                        <span class="caret"></span>
                    </a>
                   <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/epin/addpin">
                                <span class="fa fa-file-text-o"></span> Create Epin </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/epin/adduserrequest">
                                <span class="fa fa-file-text-o"></span> Create User Epin Request </a>
                        </li>
                        <li >
                            <a href="<?php echo base_url();?>admin/epin/request">
                                <span class="fa fa-file-text-o"></span> Request Epin Management</a>
                        </li>
                         <li >
                            <a href="<?php echo base_url();?>admin/epin/cancelurequests">
                                <span class="fa fa-file-text-o"></span>list of cancel Requests</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/epin">
                                <span class="fa fa-file-text-o"></span> Epin management</a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/epin/expiryepin">
                                <span class="fa fa-file-text-o"></span> Expired Epins</a>
                        </li>
                        
                        <li >
                            <a href="<?php echo base_url();?>admin/report/epin">
                                <span class="fa fa-file-text-o"></span> Export Epin</a>
                        </li>
                    </ul>
                </li>
              <? }

                ?>
                <!-- <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-comment"></span>
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
                </li> -->
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-lock"></span>
                        <span class="sidebar-title">Marketing</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/marketingtool">
                                <span class="fa fa-file-text-o"></span> Marketing Tools </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/subscriber">
                                <span class="fa fa-file-text-o"></span> Subscriber List </a>
                        </li>
                        
                        
                        
                    </ul>
                </li>

                <li>
                    <a class="accordion-toggle" href="<?php echo base_url();?>admin/autorespond ">
                        <span class="glyphicon glyphicon-indent-right"></span>
                        <span class="sidebar-title">Autoresponder</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <!-- <li>
                            <a href="<?php echo base_url();?>admin/autorespond/addautorespond">
                                <span class="fa fa-file-text-o"></span> add auto responder</a>
                        </li> -->
                        <li>
                            <a href="<?php echo base_url();?>admin/autorespond">
                                <span class="fa fa-file-text-o"></span> Auto Responder management</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/leadcapture">
                                <span class="fa fa-file-text-o"></span>Lead Captures page</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-cog"></span>
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
                            <a href="<?php echo base_url();?>admin/mlmsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('mlm Settings'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/smtpsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('smtp Settings'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/rewardsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('reward Settings'); ?> </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/fundsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('fund transfer Settings'); ?> </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url();?>admin/languagesetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('language setting'); ?> </a>
                        </li> 
                         <li>
                            <a href="<?php echo base_url();?>admin/currencysetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('currency setting'); ?> </a>
                        </li> 
                         <li>
                            <a href="<?php echo base_url();?>admin/recurringsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('Recurring Settings'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/usersetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('user Settings'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/customfieldsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('customfield Settings'); ?> </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/captcha">
                                <span class="fa fa-users"></span> <?php echo ucwords('captcha Settings'); ?> </a>
                        </li>
                       
                        <?php 
                            if($mlsetting->Id==4) { ?>         
                         <li>
                            <a href="<?php echo base_url();?>admin/pvsetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('binary pv Settings'); ?> </a>
                        </li>
                          <?}elseif($mlsetting->Id==9) { ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/hyipsetting">
                                <span class="fa fa-users"></span> <? echo ucwords('binary hyip Settings'); ?> </a>
                        </li>
                        <?php }elseif($mlsetting->Id==5 || $mlsetting->Id==8) { ?>
                        <li>
                            <a href="<?php echo base_url();?>admin/boardplansetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('board plan Settings'); ?> </a>
                        </li>
                        <?php }else{?>
                        <li>
                            <a href="<?php echo base_url();?>admin/packagesetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('packages Settings'); ?> </a>
                        </li>
                        <?php }?>
                             <li>
                            <a href="<?php echo base_url();?>admin/ranksetting">
                                <span class="fa fa-users"></span> <?php echo ucwords('Rank settings'); ?> </a>
                        </li>

                    </ul>
                 
                </li>
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-th"></span>
                        <span class="sidebar-title">CMS</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/pages">
                                <span class="fa fa-file-text-o"></span> Pages </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/navigation">
                                <span class="fa fa-file-text-o"></span> CMS Menu </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/faq">
                                <span class="fa fa-file-text-o"></span> FAQ's </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-list-alt"></span>
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
                            <a href="<?php echo base_url();?>admin/report/reward">
                                <span class="fa fa-file-text-o"></span> reward Commission </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/bonus">
                                <span class="fa fa-file-text-o"></span> Bonus </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/report/payout">
                                <span class="fa fa-file-text-o"></span> Payouts </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url();?>admin/report/epin">
                                <span class="fa fa-file-text-o"></span> Epins </a>
                        </li> -->
                        
                    </ul>
                </li>
               <!--  <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-sunglasses"></span>
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
                </li> -->
                <li>
                    <a class="accordion-toggle" href="#">
                        <span class="glyphicon glyphicon-tags"></span>
                        <span class="sidebar-title">Ticket System</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/ticket/add">
                                <span class="fa fa-file-text-o"></span> Create Ticket </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/ticket">
                                <span class="fa fa-file-text-o"></span> Tracking Ticket </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="accordion-toggle " href="#">
                        <span class="glyphicon glyphicon-scissors"></span>
                        <span class="sidebar-title">Utilities</span>
                        <span class="caret"></span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="<?php echo base_url();?>admin/backup">
                                <span class="fa fa-file-text-o"></span> Database Migration </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>admin/banned">
                                <span class="fa fa-file-text-o"></span> Ban IP </a>
                        </li>
                        
                    </ul>
                </li>
                
            </ul>
            <?php } ?>
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