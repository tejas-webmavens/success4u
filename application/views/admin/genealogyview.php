

<div style="display:none"> <?php echo $val;?></div>






<script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/jquery.jOrgChart.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/custom.css"/>
<link href="<?php echo  base_url();?>assets/genview/css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo  base_url();?>assets/genview/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo  base_url();?>assets/genview/js/jquery.min.js"></script>
<link href="<?php echo  base_url();?>assets/genview/css/autocomplete.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo  base_url();?>assets/genview/js/jquery.ui.min.js"></script>
<script src="<?php echo  base_url();?>assets/genview/js/jquery.jOrgChart.js"></script>
<script>
    jQuery(document).ready(function() {
	
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop : false
        });
    });
    </script>


<div id="chart" class="orgChart" align="center"></div>
<br/><br/><br/>
<div align="center">
    <a id="minusBtn" onclick="minus()" style="cursor:pointer"><img src="<?php echo base_url();?>assets/img/plugins/details_close.png" /></a>
    <a id="plusBtn" onclick="plus()" style="cursor:pointer"><img src="<?php echo base_url();?>assets/img/plugins/details_open.png" /></a>
</div>

<script>
        jQuery(document).ready(function() {
		
            $("#show-list").click(function(e){ 
                e.preventDefault(); 
                
                $('#list-html').toggle('fast', function(){
                    if($(this).is(':visible')){
					
                        $('#show-list').text('Hide underlying list.');
                        $(".topbar").fadeTo('fast',0.9);
                    }else{
					
                        $('#show-list').text('Show underlying list.');
                        $(".topbar").fadeTo('fast',1);
                    }
                });
            });
            
            $('#list-html').text($('#org').html());
            
            $("#org").bind("DOMSubtreeModified", function() { 
                $('#list-html').text('');
                
                $('#list-html').text($('#org').html());
                
                prettyPrint();
            });
        });
    var currFFZoom = 1;
    var currIEZoom = 100;

    function plus(){
            
            var step = 0.05;
            currFFZoom += step;
            $('body').css('MozTransform','scale(' + currFFZoom + ')');
            var stepie = 25;
            currIEZoom += stepie;
            $('body').css('zoom', ' ' + currIEZoom + '%');

    };
    function minus(){
        if(currFFZoom > 0.05 ) {
            var step = 0.05;
            currFFZoom -= step;
            $('body').css('MozTransform','scale(' + currFFZoom + ')');
            var stepie = 25;
            currIEZoom -= stepie;
            $('body').css('zoom', ' ' + currIEZoom + '%');
        }
    };
    </script>
