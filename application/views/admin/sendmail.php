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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/summernote/summernote.css">

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
                                <div class="section row mb20">
                                    <?php if($this->session->flashdata('error_message')) { ?>    
                                        <div class="col-md-12 bg-danger pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['error_message']); } ?>
                                    
                                    <?php if($this->session->flashdata('success_message')) { ?>    
                                        <div class="col-md-12 bg-success pt10 pb10 ">
                                            <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                        </div>
                                    <?php unset($_SESSION['success_message']); } ?>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <h3><?php echo $this->lang->line('page_title_sendmail'); ?></h3>
                                    </div>
                                    <div class="col-md-1 pull-right">
                                        <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url().'admin/customers';?>" data-original-title="<?php echo $this->lang->line('label_back'); ?>"><i class="fa fa-reply"></i></a></span>
                                    </div>
                                </div>
                    
                                <form method="post" action="<?php echo base_url().'admin/customers/sendMail/'.$this->uri->segment(4);?>" id="form-send-mail">
                                
                                    <div class="panel-body pn">
                                   
                                        <div class="tab-content pn br-n allcp-form theme-primary">

                                            <div class="section row mbn">
                                                
                                                <div class="col-md-12 ph10">
                                                    
                                                    <div class="section mb10">
                                                        <label for="mailsubject" class="field prepend-icon">
                                                            <input type="text" name="mailsubject" id="mailsubject" class="event-name gui-input br-light light" placeholder="<?php echo $this->lang->line('label_subject'); ?>" value="<?php echo set_value('mailsubject'); ?>">
                                                            <label for="mail_subject" class="field-icon">
                                                                <i class="fa fa-tag"></i>
                                                            </label>
                                                        </label>
                                                        <?php echo form_error('mailsubject'); ?>
                                                    </div>

                                                    <div class="section mb10">
                                                        <div class="panel-body pn of-h" id="summer-demo">
                                                            <textarea id="message" class="ckeditor gui-input" name="message" style="display: block;"><?php echo set_value('message'); ?></textarea>
                                                        </div>
                                                        <?php echo form_error('message'); ?>
                                                    </div>

                                                </div>
                                            </div>

                                            <hr class="short alt">

                                            <div class="section mbn text-right">
                                                <p class="text-right">
                                                    <button class="btn btn-bordered btn-primary" type="submit"><?php echo $this->lang->line('btn_sendmail'); ?></button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                
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
    <?php $this->load->view('admin/sidebar_right'); ?>
    <!--  /Sidebar Right  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->

<?php $this->load->view('admin/footer'); ?>
<script src="<?php echo base_url();?>assets/js/plugins/tagsinput/tagsinput.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/allcp/forms/js/additional-methods.min.js"></script>







<!--  FileUpload JS  -->
<script src="<?php echo base_url();?>assets/js/plugins/fileupload/fileupload.js"></script>
<script src="<?php echo base_url();?>assets/js/plugins/holder/holder.min.js"></script>

 <!-- /Scripts  

<script src="<?php echo base_url();?>assets/js/pages/user-forms-editors.js"></script>-->
<!-- Ckeditor JS -->
<script src="<?php echo base_url();?>assets/js/plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/activemenu'); ?>

<script type="text/javascript">
(function($) {

    $(document).ready(function() {

        // $.validator.methods.smartCaptcha = function(value, element, param) {
        //     return value == param;
        // };

        $("#form-add-ticket").validate({

            // States

            errorClass: "state-error",
            validClass: "state-success",
            errorElement: "em",

            // Rules

            rules: {
                ticketsubject: {
                    required: true
                },
                ticketpriority: {
                    required: true
                },
                users: {
                    required: true
                },
                ticketdesc: {
                    required: true
                }
                
                
            },

            // error message
            messages: {
                ticketsubject: {
                    required: 'Please enter ticket subject'
                },
                ticketpriority: {
                    required: 'Please enter ticket priority'
                },
                users: {
                    required: 'Please select user'
                },
                ticketdesc: {
                    required: 'Please enter the ticket detail description'
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

        $('#show_info').click(function() {

            if ($(this).is(':checked')) {
                $('#additional-option').css('display', 'block');
            } else {
                $('#additional-option').css('display', 'none');
            }
        })

         $('#ticket_category').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            $(".productname > option").remove();
            //console.log(valueSelected);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url();?>admin/ticket/GetProduct/"+valueSelected,
                success: function(columns) //we're calling the response json array 'cities'
                {
                 
                    $.each(columns,function(id,name) {
                        //console.log(id);
                        // console.log(name);
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(name);
                        // opt.html("<input type='hidden' name='column[]' value='"+name+"'/>"+name);
                        $('.productname').append(opt);
                    });
                }
            });
        });

    });

})(jQuery);
</script>
<script type="text/javascript">
    var image_row = 1;

function addImage() {
    html = '<div class="fileupload fileupload-new allcp-form mt-20" data-provides="fileupload" id="add_image' + image_row  + '"> <div class="fileupload-preview thumbnail mb20"> <img data-src="holder.js/100%x140" alt="holder"/> </div> <div class="row"> <div class="col-xs-7 pr5 ph10"> <input type="text" name="ProductImage' + image_row + '" id="ProductImage' + image_row + '"class="text-center event-name gui-input br-light bg-light"placeholder="Image tags"> <label for="ProductImage' + image_row + '" class="field-icon"></label> </div> <div class="col-xs-5 ph10"> <span class="button btn-primary btn-file btn-block"> <span class="fileupload-new">Select</span> <span class="fileupload-exists">Change</span> <input type="file" name="ProductImage[]" value="<?php echo set_value('ProductImage + image_row + '); ?>"> </span> </div> </div> <button class="btn btn-danger pull-right mt20" type="button" onclick="$(\'#add_image' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button> </div>  ';

    

    $('#product_multi_image').append(html);

    image_row++;
}
</script>



</body>

</html>
