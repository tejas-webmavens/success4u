?><!DOCTYPE html>
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

<body class="tables-datatables" data-spy="scroll" data-target="#nav-spy" data-offset="300"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>

<!--  Customizer  -->
<?php error_reporting(0);?>
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

        <?php  ?>
            <div class="row">
            <!--  Column search  -->

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs">
                                <?php echo ucwords($this->lang->line('filter'));?>
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                            <div class="allcp-form theme-primary">
                            <form method="post" action="<?php echo base_url().'admin/report/rewardSearch';?>" name="search_form">

                                <div class="section row mb20">
                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> <?php echo ucwords($this->lang->line('filtername'));?></h6>
                                        <label for="username" class="field prepend-icon">
                                            <input type="text" name="username" id="username" class="gui-input" placeholder="<?php echo ucwords($this->lang->line('username'));?>" value="<?php echo set_value('username');?>">
                                            <label for="username" class="field-icon">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </label>
                                    </div>

                                    
                                  <!--   <div class="col-md-3 ph10">
                                        <h6 class="mb15"><?php echo ucwords($this->lang->line('filterpaythrough'));?></h6>
                                        <label for="paythrough" class="field select">
                                            <select id="filter-categories" name="paythrough">
                                            <?php 
                                                $payments = $this->common_model->GetResults("PaymentStatus='1'","arm_paymentsetting");
                                                
                                            ?>
                                                <option value="" selected="selected"><?php echo ucwords($this->lang->line('filterpaythrough'));?></option>
                                                <?php for($i=0; $i<count($payments); $i++) { ?>
                                                <option value="<?php echo $payments[$i]->PaymentId;?>" <?php if($_POST['paythrough']!=''){if($_POST['paythrough']==$payments[$i]->PaymentId) { echo "selected";}}?> ><?php echo ucwords($payments[$i]->PaymentName);?></option>
                                                <?php }?>
                                                </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>
 -->
                                    
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"><?php echo ucwords($this->lang->line('filtertransactionid'));?></h6>
                                        <label for="transactionid" class="field prepend-icon">
                                            <input type="text" name="transactionid" id="transactionid" class="gui-input" placeholder="<?php echo ucwords($this->lang->line('transactionid'));?>" value="<?php echo set_value('transactionid');?>">
                                            <label for="epin" class="field-icon">
                                                <i class="fa fa-envelope"></i>
                                            </label>
                                        </label>
                                    </div>
                                     <div class="col-md-3 ph10 mt40 ">
                                        <a data-original-title="Clear Filter" href="<?php echo base_url().'admin/report/reward';?>" data-toggle="tooltip" title="" class="btn btn-danger pull-right"><i class="fa fa-eraser"></i></a>
                                    </div>
                                    
                                </div>

                                <div class="section row mb20">
                                     
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> by date</h6>
                                        <label for="datepicker1" class="field prepend-icon mb5">
                                            <input type="text" id="datepicker1" name="datepicker1" class="gui-input fs13" placeholder="From" value="<?php echo set_value('datepicker1');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div>
                                    <div class="col-md-3 ph10">
                                        <h6 class="mb15"> to date</h6>
                                        <label for="datepicker2" class="field prepend-icon">
                                            <input type="text" id="datepicker2" name="datepicker2" class="gui-input fs13" placeholder="To" value="<?php echo set_value('datepicker2');?>">
                                            <label class="field-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                        </label>
                                    </div> 
                                    <div class="col-md-3 ph10 mt40 ">

                                        <button class="btn btn-primary pull-right " type="submit" name="search"><?php echo ucwords($this->lang->line('search'));?></button>
                                    </div>
                                </div>

                                
                               </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!--  /Column Search  -->
            </div> <?php  ?>
                <!--  Column Center  -->
           

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">

                            <div class="panel-title hidden-xs">
                                <?php echo ucwords($this->lang->line('report_commissions'));?>

                                <div class="col-md-1 pull-right">
                                    <span class="allcp-form"><a class="btn btn-primary " title="" data-toggle="tooltip" href="javascript:void(0)" id="btnExport" data-original-title="Export"><i class="fa fa-download"></i></a></span>
                                </div>
                               
                            </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                       
                            
                            <div class="table-responsive export_content">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        
                                        <th class="va-m"><?php echo $this->lang->line('label_sno');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_username');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('transactionid');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_description');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_date');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('paidamount');?></th>
                                        

                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php 

                                        $rquests = $this->data;
                                       
                                         if($rquests['field']!="") {
                                             $ii=1;
                                        foreach ($rquests['field']  as $row) {
                                            
                                    ?>
                                    <tr>
                                        
                                        <td class=""><?php echo $ii++;?></td>
                                        <td class=""><?php $user =$this->common_model->GetCustomer($row->MemberId); echo ucwords($user->UserName);?></td>
                                        <td class=""><?php if($row->TransactionId!=''){echo $row->TransactionId;}else{echo"---";}?></td>
                                        <td class=""><?php if($row->Description!=''){echo $row->Description;}else{echo"---";}?></td>
                                        <td class=""><?php echo date("M d,Y h:i:s",strtotime($row->DateAdded));?></td>
                                        <td class=""><?php echo $row->Credit;?></td>
                                        
                                    </tr>
                                    <?php 
                                        }   }
                                    ?>
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

 $(document).ready(function() {
    $('#datatable2').DataTable();
});

</script>
<script>
    $(function() {

        $("#btnExport").click(function(){
            // download('member.xls', $('.export_content').html());
            download('<?php echo  $this->lang->line("report_commissions")."-".date("dMY");?>.xls', $( ".export_content .row:eq( 1 )" ).html());
        });
    
    });
    function download(filename, text) {
        
        var pom = document.createElement('a');
        pom.setAttribute('href', 'data:application/vnd-ms-excel;charset=utf-8,' + encodeURIComponent(text));
        pom.setAttribute('download', filename);

        if (document.createEvent) {
            var event = document.createEvent('MouseEvents');
            event.initEvent('click', true, true);
            pom.dispatchEvent(event);
        }
        else {
            pom.click();
                }
            }
</script>
</body>

</html>
