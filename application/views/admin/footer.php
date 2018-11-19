<!--  Scripts  -->

<!--  jQuery  -->
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  Theme Scripts  -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/sales-stats-clients.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    	if(document.location=='<?php echo base_url();?>admin'){
    		// console.log(document.location);	
    	} else {
    		// console.log('<?php echo base_url();?>');
	        $('ul.nav.sidebar-menu li a[href^="'+document.location+'"]').parent().addClass("active");
	        $('ul.nav.sidebar-menu li a[href^="'+document.location+'"]').parents().prev('a.accordion-toggle').addClass("menu-open");
	    }
    });
</script>
<!--  /Scripts  -->
