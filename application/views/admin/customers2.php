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


        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Left  -->
            <aside class="chute chute-left chute290" data-chute-height="match">

                <!--  Menu Block  -->
                <div class="allcp-form theme-primary">

                    <h5 class="pln"> Find Users</h5>

                    <h6 class="mb15"> by ID</h6>

                    <div class="section mb20">
                        <label for="customer-id" class="field prepend-icon">
                            <input type="text" name="customer-id" id="customer-id" class="gui-input"
                                   placeholder="ID #">
                            <label for="customer-id" class="field-icon">
                                <i class="fa fa-user"></i>
                            </label>
                        </label>
                    </div>

                    <h6 class="mb15"> by name</h6>

                    <div class="section mb20">
                        <label for="customer-name" class="field prepend-icon">
                            <input type="text" name="customer-name" id="customer-name" class="gui-input"
                                   placeholder="Name">
                            <label for="customer-name" class="field-icon">
                                <i class="fa fa-user"></i>
                            </label>
                        </label>
                    </div>
                    <h6 class="mb15"> by email</h6>

                    <div class="section mb20">
                        <label for="customer-email" class="field prepend-icon">
                            <input type="text" name="customer-email" id="customer-email" class="gui-input"
                                   placeholder="Email">
                            <label for="customer-email" class="field-icon">
                                <i class="fa fa-envelope-o"></i>
                            </label>
                        </label>
                    </div>

                    <h6 class="mb15"> by country</h6>

                    <div class="section mb20">
                        <label class="field select">
                            <select id="customer-location" name="customer-location">
                                <option value="0" selected="selected">Location</option>
                                <option value="1">USA</option>
                                <option value="2">Canada</option>
                                <option value="3">France</option>
                                <option value="4">China</option>
                                <option value="4">Spain</option>
                            </select>
                            <i class="arrow double"></i>
                        </label>
                    </div>

                    <h6 class="mb15"> by date</h6>

                    <div class="section row mb20">
                        <div class="col-md-6 ph10">
                            <label for="datepicker1" class="field prepend-icon">
                                <input type="text" id="datepicker1" name="datepicker1"
                                       class="gui-input fs13"
                                       placeholder="From">
                                <label class="field-icon">
                                    <i class="fa fa-calendar"></i>
                                </label>
                            </label>
                        </div>
                        <div class="col-md-6 ph10">
                            <label for="datepicker2" class="field prepend-icon">
                                <input type="text" id="datepicker2" name="datepicker2"
                                       class="gui-input fs13"
                                       placeholder="To">
                                <label class="field-icon">
                                    <i class="fa fa-calendar"></i>
                                </label>
                            </label>
                        </div>
                    </div>

                    <hr class="short">

                    <div class="section">
                        <button class="btn btn-primary pull-right ph30" type="button">Search</button>
                    </div>

                </div>

            </aside>
            <!--  /Column Left  -->

            <!--  Column Center  -->
            <div class="chute chute-center pt30">

                <!--  Table  -->
                <div class="panel">
                    <div class="panel-menu allcp-form theme-primary mtn">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="field select">
                                    <select id="filter-purchases" name="filter-purchases">
                                        <option value="0">Filter by Purchases22</option>
                                        <option value="1">1-49</option>
                                        <option value="2">50-499</option>
                                        <option value="1">500-999</option>
                                        <option value="2">1000+</option>
                                    </select>
                                    <i class="arrow double"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="field select">
                                    <select id="filter-group" name="filter-group">
                                        <option value="0">Filter by Group</option>
                                        <option value="1">Clients</option>
                                        <option value="2">Vendors</option>
                                        <option value="3">Distributors</option>
                                        <option value="4">Employees</option>
                                    </select>
                                    <i class="arrow double"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body pn">
                        <div class="table-responsive">
                            <table class="table allcp-form theme-warning tc-checkbox-1 fs13">
                                <thead>
                                <tr class="bg-light">
                                    <th class="text-center"><?php echo $this->lang->line('label_name');?></th>
                                    <th class=""><?php echo $this->lang->line('label_email');?></th>
                                    <th class=""><?php echo $this->lang->line('label_address');?></th>
                                    <th class=""><?php echo $this->lang->line('label_city');?></th>
                                    <th class=""><?php echo $this->lang->line('label_phone');?></th>
                                    <th class=""><?php echo $this->lang->line('label_status');?></th>
                                    <th class=""><?php echo $this->lang->line('label_action');?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                print_r($customers['customers']);
                                    foreach ($customers['customers'] as $row) {
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <label class="option block mn">
                                            <input type="checkbox" name="inputname" value="FR">
                                            <span class="checkbox mn"></span>
                                        </label>
                                    </td>
                                    <td class=""><?php echo $row->UserName;?></td>
                                    <td class=""><?php echo $row->Email;?></td>
                                    <td class=""><?php echo $row->Address;?></td>
                                    <td class=""><?php echo $row->City;?></td>
                                    <!--<td class=""><?php echo $row->Phone;?></td>-->
                                    <td>
                                        <div class="btn-group text-right">
                                            <button type="button"
                                                    class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"> <?php echo $row->MemberStatus;?>
                                                <span class="caret ml5"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <!-- <li class="divider"></li> -->
                                                <li class="active">
                                                    <a href="<?php echo base_url().'admin/customers/active/'.$row->MemberId;?>"><?php echo $this->lang->line('label_active');?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/inactive/'.$row->MemberId;?>"><?php echo $this->lang->line('label_inactive');?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    
                                    <td class="text-right">
                                        <div class="btn-group text-right">
                                            <button type="button"
                                                    class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false"> <?php echo $this->lang->line('label_action');?>
                                                <span class="caret ml5"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/add/'.$row->MemberId;?>"><?php echo $this->lang->line('label_edit');?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url().'admin/customers/delete/'.$row->MemberId;?>"><?php echo $this->lang->line('label_delete');?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url();?>admin/customers/profile/<?php echo $row->MemberId;?>"><?php echo $this->lang->line('label_profile');?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url();?>admin/customers/Passwordreset/<?php echo $row->MemberId;?>"><?php echo $this->lang->line('label_resetpassword');?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                            
                                </tr>
                                <?php } ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!--  /Column Center  -->

        </section>
        <!--  Content  -->
        <section id="content" class="table-layout animated fadeIn">

            <!--  Column Center  -->
            <div class="chute chute-center">

                <div class="row">
 
                    

                    <div class="col-md-12">
                        <div class="panel panel-visible" id="spy6">
                            <div class="panel-heading">
                                <div class="panel-title hidden-xs">
                                    <!-- <div class="row">
                                        <div class="col-md-8"> -->
                                            <?php echo $this->lang->line('page_title');?>
                                        <!-- </div>
                                        <div class="col-md-2"> -->

                                            <div class="btn-group pull-right text-right">
                                                <button type="button" class="btn btn-success br2 btn-xs fs12 dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"> <?php echo $this->lang->line('label_export');?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/customers/ExportCSV';?>"><?php echo $this->lang->line('export_csv');?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/customers/Exportxml';?>"><?php echo $this->lang->line('export_xml');?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url();?>admin/customers/ExportPDF"><?php echo $this->lang->line('export_pdf');?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                       <!--  </div>
                                        <div class="col-md-2"> -->

                                            <div class="btn-group pull-right text-right">
                                                <button onclick="deleteAll()" class="btn btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <!-- <button class="btn btn-success" type="submit" name="active"><i class="fa fa-thumbs-o-up"></i></button> -->
                                                <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/customers/add" data-original-title="Add New"><i class="fa fa-plus"></i></a>
                                            </div>

                                        <!-- </div>

                                </div> -->
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

<!--  HighCharts Plugin  -->
<script src="<?php echo base_url();?>assets/js/plugins/highcharts/highcharts.js"></script>

<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/tables-data.js"></script>

<!--  /Scripts  -->
<script type="text/javascript">
$(".case").on('click',function(){
    var chk=$('.case:checked').length ? true : false;
    $('#selectall').prop('checked',chk);
});

function deleteAll(){
    if($('.case:checked').length) {
     confirm('Are you sure?') ? $('#form-customer').submit() : false;
    }
}

</script>
</body>

</html>
