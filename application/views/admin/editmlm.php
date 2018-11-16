<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
    <?php $this->load->view('admin/meta');?>

    <!--  Fonts  -->
    <!-- <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'> -->

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

            <!--  Topbar  -->
            <?php $this->load->view('admin/topmenu');?>

            <!--  Content  -->
            <section id="content" class="table-layout animated fadeIn">

                <!--  Column Center  -->
                <div class="chute chute-center">
                 
                    <div class="mw1000 center-block">

                        <!--  General Information  -->
                        <div class="panel mb35">
                            <form method="post" action="" id="allcp-form" enctype="multipart/form-data">
                                <div class="panel-heading">
                                    <span class="panel-title"><?php echo  ucwords($this->lang->line('page'.$matrixid)." ".$this->lang->line('pagetitle_mlm')); ?></span>
                                </div>
                                
                                <div class="section row mbn">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['error_message']); } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 mt10 mb20">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['success_message']); } ?>
                                </div>
                                <div class="panel-body br-t">
                                
                                   <?
                                  // print_r($this->data);
                                   // echo"matrix : ". $matrixid;
                                   if($matrixid==1)
                                   {
                                    $this->load->view("admin/matrix/forcematrix.php",$matrixdetails);
                                   }
                                   else if($matrixid==2)
                                   {
                                     $this->load->view("admin/matrix/unilevelmatrix.php",$matrixdetails);
                                   }
                                   else if($matrixid==3)
                                   {
                                     $this->load->view("admin/matrix/monolinematrix.php",$matrixdetails);
                                   }
                                   else if($matrixid==4)
                                   {
                                     $this->load->view("admin/matrix/binarymatrix.php",$matrixdetails);
                                   }
                                   else if($matrixid==5)
                                   {
                                     $this->load->view("admin/matrix/boardmatrix.php",$matrixdetails);
                                   }
                                   else if($matrixid==6)
                                   {
                                     $this->load->view("admin/matrix/xupmatrix.php",$matrixdetails);
                                   }
                                     else if($matrixid==7)
                                   {
                                     $this->load->view("admin/matrix/oddevenmatrix.php",$matrixdetails);
                                   }
                                    else if($matrixid==8)
                                   {
                                     $this->load->view("admin/matrix/boardmatrix1.php",$matrixdetails);
                                   }
                                    else if($matrixid==9)
                                   {
                                     $this->load->view("admin/matrix/binaryhyip.php",$matrixdetails);
                                   }
                                   
                                   ?>
                                </div>

                            </form>
                        </div>
                        <!-- panel md35 ends-->

                    </div>
                </div>
                <!--  /Column Center  -->

            </section>
            <!--  /Content  -->

        </section>

        <!--  Sidebar Right  -->
        <?php $this->load->view('admin/sidebar_right');?>

    </div>
    <!--  /Body Wrap   -->

<!--  Scripts  -->
<?php $this->load->view('admin/footer');?>


<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>

<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>

 
<script type="text/javascript">
function checkdb()
{
    var clr = $('input[name=cleardb]:checked', '#allcp-form').val();
    var mst = $('input[name=matrixstatus]:checked', '#allcp-form').val();


    if(clr=='1' && mst=='1')
    {
       confirm("Are want clear Data base also ?") ?  $("#allcp-form").submit() : false;
            
    }
    else
    {
            $("#allcp-form").submit();
    }

}


(function($) {

    $(document).ready(function() {

        // "use strict";
        // // Init Theme Core
        // Core.init();

        // // Init Demo JS
        // Demo.init();

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#allcp-form").validate({

            // States
          

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                matrixwidth: {
                    required: true,
                    number: true
                },
                matrixdepth: {
                    required: true,
                    number: true
                },
                changedirect: {
                    required: true
                },
                freemember: {
                    required: true
                },
                earncommisionstatus: {
                    required: true
                },
                levelcommissionstatus: {
                    required: true
                },
                levelcommissiontype: {
                    required: true
                },
                directcommissionstatus: {
                    required: true
                },
                directcommissiontype: {
                    required: true
                },
                owncommissionstatus: {
                    required: true
                },
                owncommissiontype: {
                    required: true
                },
                matrixcommission: {
                    required: true
                },
                repeatcommissionstatus: {
                    required: true
                },
                spilloversystem: {
                    required: true
                },
                recyclestatus: {
                    required: true
                }
               
               /* sitebanner: {
                    extension: "jpg|png|gif|jpeg"
                }
                
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                }*/
            },

            // error message
            messages: {
                matrixwidth: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                matrixdepth: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },                
                changedirect: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                freemember: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                earncommisionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                levelcommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                levelcommissiontype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                directcommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                directcommissiontype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                owncommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                owncommissiontype: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                matrixcommission: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                repeatcommissionstatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>',
                     number: '<?php echo ucwords($this->lang->line('errornumber')); ?>'
                },
                spilloversystem: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
                },
                recyclestatus: {
                    required: '<?php echo ucwords($this->lang->line('require')); ?>'
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

    });

})(jQuery);
</script>                                                                                                                                                                                                                       <!--  /Scripts  -->

</body>

</html>
