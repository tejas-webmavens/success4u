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
        <div class="chute chute-center pt30">

                  

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-visible" id="spy6">
                        <div class="panel-heading">
                            

                            <div class="panel-title hidden-xs">
                             <div class="row">
                             <div class="col-md-4">
                                <?php echo ucwords($this->lang->line('pagetitle_latestfaq'));?>
                                </div>
                                  <div class="col-md-1 pull-right">
                                <span class="allcp-form"><a class="btn btn-primary pull-right" title="" data-toggle="tooltip" href="<?php echo base_url();?>admin/faq/updatefaq" data-original-title=" <?php echo ucwords($this->lang->line('pagetitle_addfaq'));?>"><i class="fa fa-plus"></i></a></span>
                               </div>
                                 <div class="allcp-form col-md-4 pull-right">
                                        <form name="selectLanguage" method="post" id="selectLanguage" action="<?php echo base_url();?>admin/Faq/filter">
                                        <label for="languagename" class="field select">
                                            <?php 
                                                $lang_id = ($this->input->post('languagename')) ? $this->input->post('languagename') : '';
                                            ?>
                                            <select onChange="SelectedLanguageFunc(this.value)" name="languagename">
                                                <option value="" selected="selected"><?php echo ucwords($this->lang->line('faq_language_Select'));?></option>
                                                <?php 
                                                    foreach ($languages as $language) {
                                                ?>
                                                    <option value="<?php echo $language->LanguageId;?>"><?php echo ucwords($language->LanguageName);?></option>
                                                <?php   
                                                    }
                                                ?>
                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                        </form>
                                    </div>
                                  

                                <!-- <a class="pull-right" href="#">Create User</a> -->
                            </div>
                        </div>
                        </div>
                        <hr class="short">
                        <div class="panel-body pn">
                        <div class="section row mbn">
                                <?php if($this->session->flashdata('error_message')) { ?>    
                                    <div class="col-md-12 bg-danger pt10 pb10 mb10">
                                        <span class=""><?php echo $this->session->flashdata('error_message');?></span>
                                    </div>
                                <?php  unset($_SESSION['error_message']);} ?>
                                
                                <?php if($this->session->flashdata('success_message')) { ?>    
                                    <div class="col-md-12 bg-success pt10 pb10 mb10">
                                        <span class=""><?php echo $this->session->flashdata('success_message');?></span>
                                    </div>
                                <?php  unset($_SESSION['success_message']);} ?>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <!-- <th>
                                            <label class="option block mn">
                                                <input type="checkbox" name="selectall" value="" id="selectall">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </th> -->
                                        <th class="va-m"><?php echo $this->lang->line('label_sno');?></th>
                                        <th class="va-m"><?php echo $this->lang->line('label_faqtype');?></th>
                                         <th class="va-m"><?php echo $this->lang->line('label_question');?></th>
                                         <th class="va-m"><?php echo $this->lang->line('label_answer');?></th>
                                         <th class="va-m"><?php echo $this->lang->line('faq_language_lbl'); ?></th>
                                      <th class="va-m"><?php echo $this->lang->line('label_status');?></th> 
                                        <th class="va-m"><?php echo $this->lang->line('label_action');?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $testimonials = $this->data;
                                        $i=0;
                                        if($testimonials['pages']){
                                        foreach ($testimonials['pages']  as $row) {

                                            $condition = "LanguageId='".$row->LanguageId."' AND IsDelete='0'";
                                            $lang_name = $this->common_model->GetRow($condition, 'arm_language');
                                            if($lang_name) {
                                                $content_language = $lang_name->LanguageName;
                                            } else {
                                                $content_language = $this->config->item('language');
                                            }

                                             $i++;
                                             
                                    ?>
                                    <tr>
                                       <!--  <td class="text-center">
                                            <label class="option block mn">
                                                <input type="checkbox" name="inputname[]" value="<?php echo $row->PackageId;?>" class="case">
                                                <span class="checkbox mn"></span>
                                            </label>
                                        </td> -->
                                        <td class=""><?php echo $i;?></td>
                                        <td class=""><?php echo $row->Type;?></td>
                                        <td class=""><?php echo substr(urldecode($row->FaqQuestion), 0, 30)?></td>
                                        <td class=""><?php echo substr(urldecode($row->FaqAnswer), 0, 30)?></td>
                                        <td class=""><?php echo ucfirst($content_language);?></td>
                                       
                                        <td class="allcp-form">
                                            <label class="block mt15 switch switch-primary">
                                                <input type="checkbox" <?php if($row->Status=='1') echo 'checked'; ?> id="t<?php echo $row->FaqId;?>" name="enablestatus" class="enablestatus" value="<?php echo $row->FaqId;?>">
                                                <label data-off="OFF" data-on="ON" for="t<?php echo $row->FaqId;?>"></label>
                                                <span><?php //echo $row->MemberStatus;?></span>
                                            </label>

                                        </td>


                                        <td class="">
                                        
                                            <div class="btn-group text-right">
                                                <button aria-expanded="true" data-toggle="dropdown" class="btn btn-success br2 btn-xs fs12 dropdown-toggle" type="button"> <?php echo ucwords($this->lang->line('action'));?>
                                                    <span class="caret ml5"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/faq/updatefaq/'.$row->FaqId;?>"><?php echo ucwords($this->lang->line('edit'));?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo base_url().'admin/faq/delete/'.$row->FaqId;?>"><?php echo ucwords($this->lang->line('delete'));?></a>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
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

<?php $this->load->view('admin/activemenu');?>

<!--  /Scripts  -->
<script type="text/javascript">
$("#selectall").on('click',function(){
    var chk=$('#selectall:checked').length ? true : false;
    if(chk){
        $('.case').prop('checked',true);
    } else {
        $('.case').prop('checked',false);
    }
});

function deleteAll(){
    if($('.case:checked').length) {
     confirm('Are you sure?') ? $('#form-customer').submit() : false;
    }
}

(function($) {

    $(document).ready(function() {
        // console.log('sdsd');
        $('.enablestatus').click(function() {
            if (!$(this).is(':checked')) {
                var id = $(this).val();
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url();?>admin/latestnews/disable/'+id,
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
                    url:'<?php echo base_url();?>admin/latestnews/enable/'+id,
                    success : function(){
                        console.log('fail');
                    }
                });
            }
        });

        
    });

 })(jQuery);
  $(document).ready(function() {


    $('#datatable2').DataTable();
} );

  function SelectedLanguageFunc(languageid) {
    if(languageid){
        // console.log(languageid);
        $('#selectLanguage').submit();
    }
}

</script>

<!--<script type="text/javascript">

 $(document).ready(function() {
    $('a[href^="'+document.location+'"]').parent().addClass("active");
    $('a[href^="'+document.location+'"]').parents().prev('a.accordion-toggle').addClass("menu-open");

} );


</script>-->
</body>

</html>
