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
                            
                                <div class="section row mbn">
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
                                    
                                    <?php //echo $this->lang->line('page_title');?>

                                    <div class="btn-group pull-right text-right">
                                        <button onclick="deleteAll()" class="btn btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <!-- <button class="btn btn-success" type="submit" name="active"><i class="fa fa-thumbs-o-up"></i></button> -->
                                        <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/customers/add" data-original-title="Add New"><i class="fa fa-plus"></i></a>
                                    </div>
                                      
                                </div>

                                <!--  Column Left  -->
                                <aside class="">

                                    <!--  Menu Block  -->
                                    <div class="allcp-form theme-primary">
                                    <form method="post" action="" name="search_form">

                                        <h5 class="pln"> Filter Users</h5>

                                        <div class="section row mb20">
                                            
                                            <div class="col-md-3 ph10">
                                                <h6 class="mb15"> by First name</h6>
                                                <label for="order-id" class="field prepend-icon">
                                                    <input type="text" name="order-id" id="order-id" class="gui-input"
                                                           placeholder="First Name">
                                                    <label for="order-id" class="field-icon">
                                                        <i class="fa fa-tag"></i>
                                                    </label>
                                                </label>
                                            </div>

                                            
                                            <div class="col-md-3 ph10">
                                                <h6 class="mb15"> by User Name</h6>
                                                <label for="price1" class="field prepend-icon mb5">
                                                    <input type="text" name="price1" id="price1" class="gui-input" placeholder="User Name">
                                                    <label for="price1" class="field-icon">
                                                        <i class="fa fa-usd"></i>
                                                    </label>
                                                </label>
                                            </div>

                                            
                                            <div class="col-md-3 ph10">
                                                <h6 class="mb15"> by User Email</h6>
                                                <label for="price2" class="field prepend-icon">
                                                    <input type="text" name="price2" id="price2" class="gui-input" placeholder="User Email">
                                                    <label for="price2" class="field-icon">
                                                        <i class="fa fa-usd"></i>
                                                    </label>
                                                </label>
                                            </div>

                                        </div>

                                        <div class="section row mb20">
                                            <div class="col-md-3 ph10">
                                                <h6 class="mb15"> by Status</h6>
                                                <label class="field select">
                                                    <select id="filter-categories" name="filter-categories">
                                                        <option value="0" selected="selected">Filter by Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="2">In active</option>
                                                        <option value="3">Free</option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </label>
                                            </div>
                                            <div class="col-md-3 ph10">
                                                <h6 class="mb15"> by date</h6>
                                                <label for="datepicker1" class="field prepend-icon mb5">
                                                    <input type="text" id="datepicker1" name="datepicker1"
                                                           class="gui-input fs13"
                                                           placeholder="From">
                                                    <label class="field-icon">
                                                        <i class="fa fa-calendar"></i>
                                                    </label>
                                                </label>
                                            </div>
                                            <div class="col-md-3 ph10">
                                                <h6 class="mb15"> to date</h6>
                                                <label for="datepicker2" class="field prepend-icon">
                                                    <input type="text" id="datepicker2" name="datepicker2"
                                                           class="gui-input fs13"
                                                           placeholder="To">
                                                    <label class="field-icon">
                                                        <i class="fa fa-calendar"></i>
                                                    </label>
                                                </label>
                                            </div>
                                            <div class="col-md-3 ph10">
                                                <button class="btn btn-primary pull-right ph30" type="submit" name="search">Search</button>
                                            </div>
                                        </div>

                                        <hr class="short">
                                       </form>
                                    </div>

                                </aside>
                                <!--  /Column Left  -->

                                
                                
                                <!--  Recent Orders  -->

                                <div class="panel-body pn">
                        <div class="table-responsive">
                            <table class="table allcp-form theme-warning tc-checkbox-1 fs13 table table-striped table-hover" id="datatable2">
                                <thead>
                                <tr class="bg-light">
                                    <th class="">Select</th>
                                    <th class="">Name</th>
                                    <th class="">Email</th>
                                    <th class="">Sponsor</th>
                                    <th class="">Registered</th>
                                    <th class="">Status</th>
                                    <th class="">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                        
                                    $customers = $this->data;
                                    foreach ($customers['customers'] as $row) {
                                ?>
                                <tr>
                                    <td class="">
                                        <label class="option block mn">
                                            <input type="checkbox" name="inputname" value="<?php echo $row->MemberId;?>">
                                            <span class="checkbox mn"></span>
                                        </label>
                                    </td>
                                    <td class=""><?php echo $row->FirstName.' '.$row->LastName;?></td>
                                    <td class=""><?php echo $row->Email;?></td>
                                    <td class=""><?php echo (isset($row->Sponsor)) ? $row->Sponsor : 'admin' ;?></td>
                                    <td class=""><?php echo date('m/d/Y', strtotime($row->DateAdded));?></td>
                                    <td class="">
                                        <label class="block mt15 switch switch-primary">
                                            <input type="checkbox" <?php if($row->MemberStatus=='Active'); echo 'checked'; ?> id="t<?php echo $row->MemberId;?>" name="status" class="status" value="<?php echo $row->MemberId;?>">
                                            <label data-off="DISABLE" data-on="Enable" for="t<?php echo $row->MemberId;?>"></label>
                                            <span><?php //echo $row->MemberStatus;?></span>
                                        </label>

                                    </td>
                                    <td class="">
                                    
                                        <div class="btn-group text-right">
                                            <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> Action
                                                <span class="caret ml5"></span>
                                            </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/add/'.$row->MemberId;?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/profile/'.$row->MemberId;?>">Profile</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/reset/'.$row->MemberId;?>">Reset Password</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/delete/'.$row->MemberId;?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php 
                                    }   
                                ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--  /Column Center  -->

        </section>
        <!--  /Content  -->

    </section>

    <!--  Sidebar Right  -->
    <aside id="sidebar_right" class="nano affix">

        <!--  Sidebar Right Content  -->
        <div class="sidebar-right-wrapper nano-content">

            <div class="sidebar-block br-n p15">

                <h6 class="title-divider text-muted mb20"> Visitors Stats
                <span class="pull-right"> 2015
                  <i class="fa fa-caret-down ml5"></i>
                </span>
                </h6>

                <div class="progress mh5">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="34"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 34%">
                        <span class="fs11">New visitors</span>
                    </div>
                </div>
                <div class="progress mh5">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="66"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 66%">
                        <span class="fs11 text-left">Returnig visitors</span>
                    </div>
                </div>
                <div class="progress mh5">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45"
                         aria-valuemin="0"
                         aria-valuemax="100" style="width: 45%">
                        <span class="fs11 text-left">Orders</span>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt30 mb10">New visitors</h6>

                <div class="row">
                    <div class="col-xs-5">
                        <h3 class="text-primary mn pl5">350</h3>
                    </div>
                    <div class="col-xs-7 text-right">
                        <h3 class="text-warning mn">
                            <i class="fa fa-caret-down"></i> 15.7% </h3>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt25 mb10">Returnig visitors</h6>

                <div class="row">
                    <div class="col-xs-5">
                        <h3 class="text-primary mn pl5">660</h3>
                    </div>
                    <div class="col-xs-7 text-right">
                        <h3 class="text-success-dark mn">
                            <i class="fa fa-caret-up"></i> 20.2% </h3>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt25 mb10">Orders</h6>

                <div class="row">
                    <div class="col-xs-5">
                        <h3 class="text-primary mn pl5">153</h3>
                    </div>
                    <div class="col-xs-7 text-right">
                        <h3 class="text-success mn">
                            <i class="fa fa-caret-up"></i> 5.3% </h3>
                    </div>
                </div>

                <h6 class="title-divider text-muted mt40 mb20"> Site Statistics
                    <span class="pull-right text-primary fw600">Today</span>
                </h6>
            </div>
        </div>
    </aside>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->
<?php $this->load->view('admin/footer'); ?>


<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<!--  Datatables JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script> 

<!--  Tagmanager JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

<script src="<?php echo base_url();?>assets/js/pages/sales-stats-products.js"></script>
<!--  /Scripts  -->



<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>
<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

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
                product_quantity: {
                    required: true
                },
                product_price: {
                    required: true
                },
                product_vendor: {
                    required: true
                },
                product_sku: {
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
                product_quantity: {
                    required: 'Please enter product quantity'
                },
                product_price: {
                    required: 'Please enter product price'
                },
                product_vendor: {
                    required: 'Please enter product ventor'
                },
                product_sku: {
                    required: 'Please enter product SKU'
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

        $('.status').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/customers/inactive/'+id,
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
                    url:'<?php echo base_url();?>admin/customers/active/'+id,
                    success : function(){
                        console.log('fail');
                    }
                });
            }
        });

    });

})(jQuery);
</script>

</body>

</html>
