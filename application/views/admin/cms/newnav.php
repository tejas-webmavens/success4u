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

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.min.css">
    <!--  Favicon  -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico">


<link href="<?php echo BASE_uRL(); ?>assets/admin/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/css/style.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/jquery-1.10.2.min.js"></script> 
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/jquery-ui-1.9.2.js"></script> 
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/jquery.nestable.js"></script> 

<script src="<?php echo BASE_uRL(); ?>assets/admin/js/excanvas.min.js"></script> 
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/bootstrap.js"></script>
<script src="<?php echo BASE_uRL(); ?>assets/admin/js/base.js"></script> 
<link href="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="<?php echo BASE_uRL(); ?>assets/admin/js/trevor/sir-trevor-icons.css" rel="stylesheet">

    <!--  IE8 HTML5 support   -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
<style>
.navbar-fixed-top {
	position: fixed;
}
</style>

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
            <!-- <div class="row">
                <div class="col-xs-12"> -->
                    <div role="tabpanel" id="" class="allcp-form theme-primary tab-pane">
                        <div class="panel">
                            <div class="panel-heading"> 
                                <div class="section row mb20">
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
                            </div>
                            <div class="panel-body pn">

							    <div class="row">
								    <div class="col-md-6">
								          <div class="panel">
								            <div class="panel-heading">
								              <h3><?php echo $this->lang->line('menu_new_pages'); ?></h3>
								            </div>
								            <!-- /widget-header -->
								            <div class="panel-body pn">
								            	<div class="control-group section">		
								             		
													<?php $attr = array('id' => 'navForm');
													echo form_open('admin/navigation/insert', $attr); ?>	

								            		<?php echo form_error('navSlug', '<div class="state-error">', '</div>'); ?>									
													<label class="control-label" for="navSlug"><?php echo $this->lang->line('menu_new_nav_slug'); ?></label>
													<div class="controls">
									                    <?php 	
									                    	$data = array(
																'name'        => 'navSlug',
																'id'          => 'navSlug',
																'class'       => 'gui-input',
																'maxlength'		=> '10',
																'value'		=> set_value('navSlug', '', FALSE)
															);
												
															echo form_input($data); 
														?>
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->
								                
								                <div class="control-group section">		
								            		<?php echo form_error('navTitle', '<div class="state-error">', '</div>'); ?>									
													<label class="control-label" for="navTitle"><?php echo $this->lang->line('menu_new_nav_title'); ?></label>
													<div class="controls">
									                    <?php 	
									                    	$data = array(
															  	'name'        => 'navTitle',
															  	'id'          => 'navTitle',
															  	'class'       => 'gui-input',
															  	'value'		=> set_value('navTitle', '', FALSE)
															);
												
															echo form_input($data); 
														?>
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->

								              	<hr />
								                <h3><?php echo $this->lang->line('menu_new_add_page'); ?></h3>
								                <hr />
								             	<div class="control-group section">		
													<label class="control-label" for="pagesList"><?php echo $this->lang->line('menu_new_select_page'); ?></label>
													<div class="controls">
														<label class="field select" for="pagesList">
								                        <?php 
								                       		$att = 'id="pagesList" class="gui-input"';
															$data = array();
															foreach ($pages as $p){
																$data[$p['pageUrl']] = $p['navTitle'];	
															}
															echo form_dropdown('pagesList', $data, '1', $att); 
														?>
														<i class="arrow double"></i>
														</label>

													</div> <!-- /controls -->				
												</div> <!-- /control-group -->  

									      		<div class="control-group section">		
													<div class="controls">
								           				<a class="btn btn-primary" onClick="addNav()"><?php echo $this->lang->line('btn_add'); ?></a>
								      				</div> <!-- /controls -->				
												</div> <!-- /control-group -->

								            	<hr />
								           		<div class="control-group section">		
													<label class="control-label" for="customlinkTitle"><?php echo $this->lang->line('menu_new_custom_title'); ?></label>
													<div class="controls">
								                       <input type="text" class="gui-input" id="customlinkTitle" value="" />
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->  

								            	<div class="control-group section">		
													<label class="control-label" for="customURLHREF"><?php echo $this->lang->line('menu_new_custom_link'); ?></label>
													<div class="controls">
								                       <input type="text" class="gui-input" id="customURLHREF" value="http://" />
													</div> <!-- /controls -->				
												</div> <!-- /control-group -->

								      			<div class="control-group section">		
													<div class="controls">
								           				<a class="btn btn-primary" onClick="addCustomURL()"><?php echo $this->lang->line('btn_add'); ?></a>
								      				</div> <!-- /controls -->				
												</div> <!-- /control-group -->    
								            
								                 
								            </div> 
								          </div>
	          								<!-- /widget -->
	 
	         
									     </div>
									      <!-- /span4 -->

									<div class="col-md-6">
									        <div class="panel">
									            <div class="panel-heading">
									              <h3><?php echo $this->lang->line('menu_new_nav'); ?></h3>
									            </div>
									            <!-- /widget-header -->
									            <div class="panel-body pn">
										      		<div class="dd" id="navHolder">
											   			<ul class="dd-list" id="mainNav">
											   			</ul>
										      		</div>
										            <hr />
										            <div class="control-group">	
										                <input type="hidden" id="seriaNav" name="seriaNav"/>
										                <input type="hidden" name="convertedNav" id="convertedNav"/>
										                <div class="controls">
										                	<a class="btn btn-primary" onClick="serializeNav()"><?php echo $this->lang->line('btn_save'); ?></a>
										                </div> <!-- /controls -->
										                <?php echo form_close() ?>
													</div> <!-- /control-group -->  
									            </div> 
									        </div>
									        <!-- /widget -->
									     </div>
								</div>
      							<!-- /row --> 
    						</div>
	                    </div>
	                </div>
	            <!-- </div> -->


           
        
        </section>
        <!--  /Content  -->

    </section>
    <?php //$this->load->view('admin/footer');?>
<script type="text/javascript">

function addNav(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var navSelected = $('#pagesList').val();
	$.ajax({
		  url: "<?php echo base_url(); ?>admin/navigation/navadd/" + navSelected,
		  type: "POST",
		  success: function(html){
			var navContainer = $('#navContainer'); //jquery selector (get element by id)
              if(html){
				 document.getElementById("mainNav").innerHTML += html;
              }
		  },
		  error: function (html){
			alert('error');
		  }
		});
	
}

function addCustomURL(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var customlinkTitle = document.getElementById("customlinkTitle").value;
	var customURLHREF = document.getElementById("customURLHREF").value;
	if (customlinkTitle != ""){
	newLink = "<li class='dd-item' data-href='" + customURLHREF +"' data-title='" + customlinkTitle +"' data-type='1'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='icon-remove'></i></a><div class='dd-handle'>" + customlinkTitle +"</div></li>";	
	document.getElementById("mainNav").innerHTML += newLink;
	}
}

function addDropDown(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var parentTitle = document.getElementById("parentTitle").value;
	var parentSlug = document.getElementById("parentSlug").value;
	var regexp = /^[a-zA-Z0-9-_]+$/;
	if (parentSlug.search(regexp) == -1)
    { alert('<?php echo $this->lang->line('menu_new_drop_error'); ?>'); }
	else
    {  
	if (parentTitle != "" && parentSlug != ""){
	newLink = "<li class='dd-item parent' data-href='" + parentSlug + "' data-title='" + parentTitle +"'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='icon-remove'></i></a><div class='dd-handle'>" + parentTitle +" <b class='caret dd-caret'></b></div></li>";	
	document.getElementById("mainNav").innerHTML += newLink;
	}}
}

 function updateOutput(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
            
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
	
$(document).ready(function()
{

   

    // activate Nestable for list 1
    $('.dd').nestable({
        group: 1,
		listNodeName:'ul',
		maxDepth: 2,
    })
    .on('change', updateOutput);
	 // output initial serialised data
    updateOutput($('.dd').data('output', $('#seriaNav')));
});

function serializeNav(){
    updateOutput($('.dd').data('output', $('#seriaNav')));
  	var jsn = JSON.parse(document.getElementById('seriaNav').value);
  	var parentHREF = '';
	var parseJsonAsHTMLTree = function(jsn) {
    var result = '';
	
jsn.forEach(function(item) {
      if (item.title && item.children) {
        result += '<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">' + item.title + '<b class="caret"></b></a><ul class="dropdown-menu">';
		parentHREF = item.href;
        result += parseJsonAsHTMLTree(item.children);
		parentHREF = "";
        result += '</ul></li>';
      } else {
		  if (parentHREF == ""){
			  	if (item.href != "home"){
					if (item.type != "1"){
        				result += '<li><a href="/' + item.href + '">' + item.title + '</a></li>';
					} else {
			  			result += '<li><a href="' + item.href + '">' + item.title + '</a></li>';
					}
				} else {
				result += '<li><a href="<?php echo base_url(); ?>">' + item.title + '</a></li>';
				}				
		  } else {
				if (item.type != "1"){
			  	result += '<li><a href="/' + parentHREF + "/" + item.href + '">' + item.title + '</a></li>';
				} else {
			  	result += '<li><a href="' + item.href + '">' + item.title + '</a></li>';
				}
		  }
      }
    });

    return result + '';
  };

  var result = '<ul class="nav navbar-nav">' + parseJsonAsHTMLTree(jsn) + '</ul>';
  document.getElementById('convertedNav').value = result;
  document.getElementById('seriaNav').value = document.getElementById("mainNav").innerHTML;
  document.getElementById("navForm").submit();
 }
</script>

