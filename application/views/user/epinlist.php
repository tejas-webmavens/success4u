<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('user/meta');?>
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.css">
<!--
    
    <link rel="stylesheet" href=js/"plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <link rel="stylesheet" href="js/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="js/plugins/daterangepicker/daterangepicker-bs3.css">

    <link rel="stylesheet" href="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
<!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'> -->
</head>
<body class="hold-transition skin-blue sidebar-mini"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>
<div class="wrapper">
        <?php $this->load->view('user/user_header');?>
        <?php $this->load->view('user/user_aside');?>
        <div class="content-wrapper">
                <section class="content">
                <?php $this->load->view('user/pagelink');?>
                <?php $this->load->view('user/userinfo');?>
                        <div class="row">
                                <div class="col-xs-12">
                                        <div class="box">
                                                <div class="box-header with-border">
                                                        <h3 class="box-title"><?echo ucwords($this->lang->line('pagetitle_epin'));?></h3>
                                                        <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                        </div>
                                                </div>
                                                <div class="box-body">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                                <thead>
                                                                        <tr>
                                                                                <th><?echo ucwords($this->lang->line('label_sno'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_expiry'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_transaction'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_package'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_fee'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_status'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_useduser'));?></th>
                                                                                <th><?echo ucwords($this->lang->line('label_createdate'));?></th>

                                                                                
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?  
                                                                    if($this->data['field']) {
                                                                        $i=1;
                                                                        $j=1;
                                                                        while( $i<= count($this->data['field']) ){

                                                                        $j= $i;
                                                                        $j--;
                                                                   ?>
                                                                        <tr>
                                                                                <td><?echo $i;?></td>
                                                                                <td><?echo $this->data['field'][$j]->ExpiryDay;?></td>
                                                                                <td><?echo $this->data['field'][$j]->EpinTransactionId;?></td>
                                                                                <td><?php $user = $this->epin_model->Getfielddata($this->data['field'][$j]->EpinPackageId); if($user!=''){echo $user->PackageName;}else{echo"--";}?></td>
                                                                                <td><?echo $this->data['field'][$j]->EpinAmount;?></td>
                                                                                <td><?php  $EpinStatus=$this->data['field'][$j]->EpinStatus; if($EpinStatus=='0') { echo ucwords($this->lang->line('unused')); } elseif($EpinStatus=='1') { echo ucwords($this->lang->line('allocated'));} elseif($EpinStatus=='2') { echo ucwords($this->lang->line('used'));}elseif($EpinStatus=='3') { echo ucwords($this->lang->line('cancel'));} else { echo '---';}?></td>
                                                                                
                                                                                <td><?php if($this->data['field'][$j]->UsedBy=='0')     { echo "---";} else{ $user = $this->common_model->GetCustomer($this->data['field'][$j]->UsedBy); echo $user->UserName;}?></td>
                                                                                <td><?php echo  $this->data['field'][$j]->DateAdded;?></td>
                                                                        </tr>
                                                                        
                                                                <? $i++;    } 
                                                                    } 
                                                                    else { 
                                                                ?>
                                                                        <tr>
                                                                            <td class="text-center" colspan="7"><?php echo $this->lang->line('label_no_records'); ?></td>
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
                </section>
        </div>
        <div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo base_url();?>assets/user/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
<script src="<?php echo base_url();?>assets/user/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/plugins/morris/morris.min.js"></script>
<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
<!--<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!--<script src="plugins/fastclick/fastclick.min.js"></script>-->
<script src="<?php echo base_url();?>assets/user/js/js/app.min.js"></script>
<script src="<?php echo base_url();?>assets/user/js/js/pages/dashboard.js"></script>
<!--    <script src="js/js/demo.js"></script>-->
<script src="<?php echo base_url();?>assets/user/js/justgage.js"></script>
<script>
    var g1, g2, g3;

    document.addEventListener("DOMContentLoaded", function(event) {
        g1 = new JustGage({
            id: "g1",
            value: getRandomInt(350, 980),
            min: 350,
            max: 980,
            /*title: "Lone Ranger",*/
            label: "miles traveled"
        });

        g2 = new JustGage({
            id: "g2",
            value: 32,
            min: 50,
            max: 100,
            title: "Empty Tank",
            label: ""
        });

        g3 = new JustGage({
            id: "g3",
            value: 120,
            min: 50,
            max: 100,
            title: "Meltdown",
            label: ""
        });
 var g5 = new JustGage({
        id: "g5",
        value: getRandomInt(0, 100),
        min: 0,
        max: 100,
        /*title: "Animation Type",*/
        label: "",
        startAnimationTime: 2000,
        startAnimationType: ">",
        refreshAnimationTime: 1000,
        refreshAnimationType: "bounce"
      });
        setInterval(function() {
            g1.refresh(getRandomInt(350, 980));
            g2.refresh(getRandomInt(0, 49));
            g3.refresh(getRandomInt(101, 200));
             g6.refresh(getRandomInt(0, 100));
        }, 2500);
    });
    </script>
</body>
</html>
