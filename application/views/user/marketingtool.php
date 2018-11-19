<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <?php $metatitle = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitemetatitle'",'arm_setting');
      $metakey = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitemetakeyword'",'arm_setting');
      $metadesp = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitemetadescription'",'arm_setting');
      $sitelogo = $this->common_model->GetRow("Page='sitesetting' AND KeyValue='sitelogo'",'arm_setting');

   ?>
              
    <title><?php echo  $metatitle->ContentValue;?></title>
    <meta name="keywords" content="<?php echo  $metakey->ContentValue;?>"/>
    <meta name="description" content="<?php echo  $metadesp->ContentValue;?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="<?php echo base_url();?>assets/user/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/user/fonts/font-awesome/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/admin.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/css/feather.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/morris/morris.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/user/js/plugins/datatables/dataTables.bootstrap.css">
<!--
	
	<link rel="stylesheet" href=js/"plugins/jvectormap/jquery-jvectormap-1.2.2.css">

    <link rel="stylesheet" href="js/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="js/plugins/daterangepicker/daterangepicker-bs3.css">

    <link rel="stylesheet" href="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition skin-blue sidebar-mini">
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
														<h3 class="box-title"><?php echo  ucwords($this->lang->line('pagetitle'));?></h3>
														<div class="box-tools pull-right">
																<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
																<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
														</div>
												</div>
												<div class="box-body">
														
																<?	
                                                                if($this->data['marketingtool']){
																	$i=1;
																  for($j=0; $j< count($this->data['marketingtool']);$j++ )
                                                                  {

																  	
																   ?>
																		
																				<?php if($this->data['marketingtool'][$j]->MarketingType=="text"){
																					?>
																			
																				<p><?php echo  $this->data['marketingtool'][$j]->MarketingText;?></p> 
																				<p><textarea style="width:100%;" ><a href="<?php echo  $this->data['referlink'];?>"><?php echo  $this->data['marketingtool'][$j]->MarketingText;?></a> </textarea> </p> <?php }?>
																				<?php if($this->data['marketingtool'][$j]->MarketingType=="image"){
                                                                                    ?>
                                                                                <p> <img  src="<?php echo  base_url().$this->data['marketingtool'][$j]->MarketingImage;?>"/></p>  
                                                                                <p><textarea style="width:100%;"><a href="<?php echo  $this->data['referlink'];?>"><img src="<?php echo  base_url().$this->data['marketingtool'][$j]->MarketingVideoLink;?>"/></a></textarea></p>  <?php }?>
                                                                                
                                                                                <?php if($this->data['marketingtool'][$j]->MarketingType=="document"){
                                                                                    ?>
                                                                                <p> <a download="" target="" href="<?php echo  base_url().$this->data['marketingtool'][$j]->MarketingDocument;?>"><?php echo ucwords($this->lang->line('marketingdocument')); ?></a></p>  
                                                                                <p><textarea style="width:100%;"><a download="" target="" href="<?php echo  base_url().$this->data['marketingtool'][$j]->MarketingDocument;?>"><?php echo $this->lang->line('marketingdocument'); ?></a></textarea></p>  <?php }?>
                                                                                
																				<?php if($this->data['marketingtool'][$j]->MarketingType=="video"){
																					?>
																				<p><iframe  src="<?php echo  $this->data['marketingtool'][$j]->MarketingVideoLink;?>"></iframe></td> 
																				<p><textarea style="width:100%;"><a href="<?php echo  $this->data['referlink'];?>"><iframe src="<?php echo  $this->data['marketingtool'][$j]->MarketingVideoLink;?>"/></iframe></a></textarea></p>  <?php }?>

																				
																				
																				
																		
																		
																<?php 	}
                                                                }
                                                                else{ 

                                                                    echo "No Records Found";
                                                                }?>
																		
																
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
