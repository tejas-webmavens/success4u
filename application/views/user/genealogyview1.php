<style type="text/css">
       
.node {
    border-radius: 50px;
    height: 95px;
    margin-bottom: -42px;
      max-height: 68px;
    max-width: 71px;
}

.geotxt
{
    margin-top:20px;
}





   </style>
  
 <?php echo $val;?>
  





<!--<script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/jquery.jOrgChart.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/custom.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/tipstyle.css"/>
<link href="<?php echo  base_url();?>assets/genview/css/prettify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo  base_url();?>assets/genview/js/prettify.js"></script>
<script type="text/javascript" src="<?php echo  base_url();?>assets/genview/js/jquery.min.js"></script>
<link href="<?php echo  base_url();?>assets/genview/css/autocomplete.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo  base_url();?>assets/genview/js/jquery.ui.min.js"></script>
<script src="<?php echo  base_url();?>assets/genview/js/jquery.jOrgChart.js"></script>-->
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/tipstyle.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo  base_url();?>assets/genview/css/jquery.jOrgChart.css"/>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>    
<script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script>

<script type='text/javascript'>
   $(document).ready(function() {

    $(".tip_trigger").hover(function(){

        $(this).find('.tip').show(); //Show tooltip

    }, function() {
        $(this).find('.tip').hide(); //Hide tooltip
    }).mousemove(function(e) {
          var mousex = e.pageX + 20; //Get X coodrinates

          var mousey = e.pageY + 20; //Get Y coordinates
          var tipWidth = $(this).find('.tip').width(); //Find width of tooltip
          var tipHeight = $(this).find('.tip').height(); //Find height of tooltip




         //Distance of element from the right edge of viewport
          var tipVisX = $(window).width() - (mousex + tipWidth);
         //Distance of element from the bottom edge of viewport
          var tipVisY = $(window).height() - (mousey + tipHeight);

        if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport (Exceeds the right side of viewport)
            mousex = e.pageX - tipWidth - 20; //Set new X coordinate
            $(this).find('.tip').css({  top: mousey, left: mousex }); //Move tooltip element to the left side
        } if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport (Exceeds the bottom of the viewport)
            mousey = e.pageY - tipHeight - 20; //Set new Y coordinate
            $(this).find('.tip').css({  top: mousey, left: mousex }); //Move tooltip element on top
        } else { //By Default have the tooltip on the bottom right
            $(this).find('.tip').css({  top: mousey, left: mousex });
        }
    });
});

  </script>


<br/><br/><br/>
<!-- <div align="center">
    <a id="minusBtn" onclick="minus()" style="cursor:pointer"><img src="<?php echo base_url();?>assets/img/plugins/details_close.png" /></a>
    <a id="plusBtn" onclick="plus()" style="cursor:pointer"><img src="<?php echo base_url();?>assets/img/plugins/details_open.png" /></a>
</div>
 -->
<script>
    jQuery(document).ready(function() {
	
        
        var currIEZoom = 100;
            $('body').css('zoom', ' ' + currIEZoom + '%');
        
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
