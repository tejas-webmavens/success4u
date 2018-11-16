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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.css">

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
    <?php $this->load->view('admin/topnav'); ?>
   

    <!--  Sidebar   -->
    <?php $this->load->view('admin/sidebar'); ?>

    <!--  Main Wrapper  -->
    <section id="content_wrapper">

        <!--  Topbar Menu Wrapper  -->
        <?php $this->load->view('admin/toper');?>
        <!--  /Topbar Menu Wrapper  -->

        <!--  Topbar  -->
        <?php $this->load->view('admin/topmenu');?>
        <!--  /Topbar  -->

        <!--  Content  -->
        <section id="content" class="animated fadeIn">
        
            <div class="row">
                <div class="col-md-8 mb40">

                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"><?php echo $profile->FirstName;?>'s Profile</span>
                        </div>
                        <div class="panel-body p25 pb10">

                            <div class="row">
                                <div class="col-sm-3 col-md-6">
                                <?php
                                    if($profile->ProfileImage)
                                        $image = base_url().$profile->ProfileImage;
                                    else 
                                        $image = base_url().'uploads/UserProfileImage/profile_avatar.jpg';
                                ?>
                                    <a href="#">
                                        <img class="media-object img-responsive" src="<?php echo $image;?>" alt=""/>
                                    </a>
                                </div>
                                <div class="col-sm-9 col-md-6">
                                    <h2 class="media-heading fs30 mb20"><?php echo $profile->FirstName.' '.$profile->LastName;?></h2>
                                    <?php if(!$subadmin) { ?>
                                        <p><a href="<?php echo base_url().'admin/customers/sendMail/'.$profile->MemberId;?>" ><i class="fa fa-fw fa-envelope"></i> Send Email</a></p>
                                        <p><a href="<?php echo base_url().'user/register/?ref='.$profile->ReferralName;?>"><i class="fa fa-fw fa-envelope"></i> Referal Link</a></p>
                                    <?php } ?>
                                </div>
                            </div>

                            <h3 class="mt10">Personal Information</h3>
                            <hr class="short">
                            <div class="row">
                                <div class="col-sm-6">
                                    <b>First Name</b> <br/>
                                    <?php echo $profile->FirstName;?>
                                </div>
                                <div class="col-sm-6">
                                    <b>Last Name</b> <br/>
                                    <?php echo $profile->FirstName;?>
                                </div>
                            </div>

                            <div class="row mt20">
                                <div class="col-sm-6">
                                    <b>Email</b> <br/>
                                    <?php echo $profile->Email;?>
                                </div>
                                <div class="col-sm-6">
                                    <b>Phone</b> <br/>
                                    <?php echo $profile->Phone;?>
                                </div>
                            </div>
                            <?php if(!$subadmin) { ?>
                            <h3 class="mt10">Upline Information</h3>
                            <hr class="short">
                            <div class="row">
                                <div class="col-sm-6">
                                    <b>Sponsor Name</b> <br/>
                                    <?php $sponsor_details = $this->common_model->GetCustomer($profile->DirectId);?>
                                    <?php echo $sponsor_details->FirstName;?>
                                </div>
                                <div class="col-sm-6">
                                    <b>Email Id</b> <br/>
                                    <?php echo $sponsor_details->Email;?>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <?php if(!$subadmin) { ?>
                <div class="col-md-4">
                    <div class="row">
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart0.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Member Package</h6>
                                                <h4 class="mt5 mbn"><?php if($profile->MemberId == '2') { echo ""; } else { echo ucwords($packagedetails->PackageName); } ?></h4>                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart0.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Total earnings</h6>
                                                <h4 class="mt5 mbn"><?php echo currency().number_format($total_eraring,2);?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart0.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Total withdraw</h6>
                                                <h4 class="mt5 mbn"><?php echo currency().number_format($total_withdraw,2);?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart0.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Current balance</h6>
                                                <h4 class="mt5 mbn"><?php echo currency().number_format($balance,2);?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart0.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Referral earnings</h6>

                                                <h4 class="mt5 mbn"><?php $Balance = $this->common_model->Getcusomerbalance($profile->MemberId); echo currency().number_format($Balance,2);?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart0.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Total purchased</h6>
                                                <h4 class="mt5 mbn"><?php echo currency().number_format($orders_total,2);?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-6 col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart1.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Epins Balance</h6>

                                                <h2 class="fs40 mt5 mbn"><?php echo $epincount = $this->common_model->Getepincount($profile->MemberId);?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden-sm col-md-12 ph10">
                                <div class="panel panel-tile">
                                    <div class="panel-body">
                                        <div class="row pv10">
                                            <div class="col-xs-5 ph10"><img alt="" class="img-responsive mauto" src="<?php echo base_url();?>assets/img/pages/clipart2.png"></div>
                                            <div class="col-xs-7 pl5">
                                                <h6 class="text-muted">Total Balance</h6>

                                                <h2 class="fs40 mt5 mbn"><?php echo number_format($Balance,2);?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                </div>
                <?php } ?>
            </div>
            <?php if(!$subadmin) { ?>
            <div class="row">
                <div class="col-md-12 mb40">
                    <div class="tab-block">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab1" data-toggle="tab">EPINS</a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab">Referrals </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab">Transactions</a>
                            </li>
                        </ul>
                        <div class="tab-content p30">
                            <div id="tab1" class="tab-pane active">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        
                                        <thead class="bg-dark">
                                        <tr>
                                            <th class="br-t-n">Create Date</th>
                                            <th class="br-t-n pl30">Package</th>
                                            <th class="br-t-n pl30">Package Fee</th>
                                            <th class="br-t-n hidden-xs">Start Date</th>
                                            <th class="br-t-n">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if($epins) {
                                                foreach ($epins as $row) {
                                                    switch ($row->RequestStatus) {
                                                        case '0':
                                                            $epin_status = 'Request';
                                                            $label = 'label-primary';
                                                            break;
                                                        case '1':
                                                            $epin_status = 'Activated';
                                                            $label = 'label-success';
                                                            break;
                                                        case '2':
                                                            $epin_status = 'Canceled';
                                                            $label = 'label-danger';
                                                            break;
                                                    }
                                        ?>
                                                <tr>
                                                    <td><?php echo date('M d, Y', strtotime($row->DateAdded));?></td>
                                                    <td class="pl30"><?php echo $row->PaymentAmount;?></td>
                                                    <td class="pl30"><?php echo $row->PaymentAmount;?></td>
                                                    <td class="hidden-xs"><?php echo date('M d, Y', strtotime($row->DateAdded));?></td>
                                                    <td><span class="label <?php echo $label;?> ml5"><?php echo $epin_status;?></span></td>
                                                </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                        
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div id="tab2" class="tab-pane">
                                <div class="panel-heading">
                                    <span class="panel-title">Referrals Information</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="va-m">Create Date</th>
                                                <th class="va-m">User</th>
                                                <th class="va-m">Email</th>
                                                <th class="va-m">Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($referals) {
                                                foreach ($referals as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td class=""><?php echo date('m/d/Y', strtotime($row->DateAdded));?></td>
                                                <td class=""><?php echo $row->FirstName.' '.$row->LastName; ?></td>
                                                <td class=""><?php echo $row->Email; ?></td>
                                                <td class=""><?php echo ($row->SubscriptionsStatus) ? 'Active' : 'Pending';?></td>
                                            </tr>
                                            <?php 
                                                    }
                                                } else {   
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="5">No Records Found!</td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="tab-pane">
                                <div class="panel-heading">
                                    <span class="panel-title">Transaction History</span>
                                </div>
                                <div class="panel-body pn">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="va-m">Create Date</th>
                                                <th class="va-m">Number</th>
                                                <th class="va-m">Name</th>
                                                <th class="va-m">Description</th>
                                                <th class="va-m">Debit</th>
                                                <th class="va-m">Credit</th>
                                                <th class="va-m">Balance</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($transactions) {
                                                foreach ($transactions as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td class=""><?php echo date('m/d/Y', strtotime($row->DateAdded));?></td>
                                                <td class=""><?php echo $row->TransactionId;?></td>
                                                <td class=""><?php echo $row->TransactionName;?></td>
                                                <td class=""><?php echo $row->Description;?></td>
                                                <td class="text-right"><?php echo $row->Debit;?></td>
                                                <td class="text-right"><?php echo $row->Credit;?></td>
                                                <td class=""><?php echo $row->Balance;?></td>
                                                
                                            </tr>
                                            <?php 
                                                    }
                                                } else {   
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="7">No Records Found!</td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

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

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable2').DataTable();
    });
</script>
</body>

</html>
