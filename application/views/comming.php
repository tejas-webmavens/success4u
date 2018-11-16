<!DOCTYPE html>
<html>

<head>
    <!--  Meta and Title  -->
     <?php $this->load->view('user/meta');?>

    <!--  Fonts  -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

    <!--  CSS - theme  -->
    <link rel="stylesheet" type="text/css" href="assets/skin/default_skin/css/theme.css">

    <!--  CSS - allcp forms  -->
    <link rel="stylesheet" type="text/css" href="assets/allcp/forms/css/forms.css">

    <!--  Favicon  -->
    <link rel="shortcut icon" href="assets/img/favicon.ico">

    <!--  IE8 HTML5 support   -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="utility-page sb-l-c sb-r-c"><a href="https://www.hostinger.com/cpanel-login?utm_source=fri&utm_medium=www&utm_campaign=fripwr" target="_blank" rel="nofollow"><div style="position: -webkit-sticky;position: sticky;top: 0;z-index: 99999;left: 0;right: 0;margin: 0 auto;text-align: center;background: #6747C7;"><img src="https://user-images.githubusercontent.com/9257291/46002195-0ed1a000-c0b6-11e8-8c9b-8098861e4abc.png" style="width: auto;max-width: 100%;text-align: center;border-radius: 2px;"></div></a>

<!--  Body Wrap   -->
<div id="main" class="animated fadeIn">

    <!--  Main Wrapper  -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>

        <!--  Content  -->
        <section id="content">

            <div class="allcp-form theme-info" id="login1" style="margin-top: 6%;">

                <div id="counter"></div>

                <div class="bg-primary text-center mb20 br3 pv15">
                    <img src="assets/img/logo.png" alt=""/>
                </div>

                <div class="panel">

                    <p>Stay notified about coming updates. Sign up now and get notified for free!</p>
                    <!--  /Panel Heading  -->
                    <form method="post" action="/" id="contact">

                        <div class="row">
                            <div class="col-sm-9 ph10 mb5">
                                <label for="password" class="field prepend-icon">
                                    <input type="text" name="password" id="password" class="gui-input"
                                           placeholder="Your Email Address">
                                    <label for="password" class="field-icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </label>
                                </label>
                            </div>
                            <div class="col-sm-3 ph10 mb5">
                                <button type="submit" class="button btn-primary mr10 btn-block">Notify</button>
                            </div>
                        </div>

                        <!--  /Form  -->

                    </form>
                </div>
            </div>

        </section>
        <!--  /Content  -->

    </section>
    <!--  /Main Wrapper  -->

</div>
<!--  /Body Wrap   -->

<!--  Scripts  -->

<!--  jQuery  -->
<script src="assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!--  Countdown JS  -->
<script src="assets/js/plugins/countdown/jquery.plugin.min.js"></script>
<script src="assets/js/plugins/countdown/jquery.countdown.min.js"></script>

<!--  CanvasBG JS  -->
<script src="assets/js/plugins/canvasbg/canvasbg.js"></script>

<!--  Theme Scripts  -->
<script src="assets/js/utility/utility.js"></script>
<script src="assets/js/demo/demo.js"></script>
<script src="assets/js/main.js"></script>

<!--  Page JS  -->
<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // Init CanvasBG
        CanvasBG.init({
            Loc: {
                x: window.innerWidth / 10,
                y: window.innerHeight / 20
            }
        });

        // Init Countdown
        var newYear = new Date();
        newYear = new Date(2016, 12, 0);
        $('#counter').countdown({
            until: newYear
        });


    });
</script>

<!--  /Scripts  -->

</body>

</html>