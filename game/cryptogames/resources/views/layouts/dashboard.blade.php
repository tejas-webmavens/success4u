<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SpotGames - Bitcoin Gambling Script">
        <meta name="author" content="MadisonScripts">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="{{asset('styles/images/favicon.ico')}}">

        <!-- App title -->
        <title>{{config('app.name')}} - @yield('title')</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{asset('styles/plugins/morris/morris.css')}}">

        <!-- Switchery css -->
        <link href="{{asset('styles/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />

        <!-- App CSS -->
        <link href="{{asset('styles/css/style.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="{{asset('styles/js/modernizr.min.js')}}"></script>

    </head>

<body>

        <!-- Navigation Bar-->
        @include('includes.dashboard.header')
        <!-- End Navigation Bar-->

        <div class="wrapper">
            <div class="container">

                @yield('content')

                <!-- Footer -->
                <footer class="footer text-right">
                @include('includes.dashboard.footer')
                </footer>
                <!-- End Footer -->


            </div> <!-- container -->



        </div> <!-- End wrapper -->

</body>
<!--   Core JS Files   -->
<script src="{{asset('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/material.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{asset('js/moment.min.js')}}"></script>
<!--  Charts Plugin -->
<script src="{{asset('js/chartist.min.js')}}"></script>
<!--  Plugin for the Wizard -->
<script src="{{asset('js/jquery.bootstrap-wizard.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('js/bootstrap-notify.js')}}"></script>
<!--   Sharrre Library    -->
<script src="{{asset('js/jquery.sharrre.js')}}"></script>
<!-- DateTimePicker Plugin -->
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
<!-- Vector Map plugin -->
<script src="{{asset('js/jquery-jvectormap.js')}}"></script>
<!-- Sliders Plugin -->
<script src="{{asset('js/nouislider.min.js')}}"></script>
<!-- Select Plugin -->
<script src="{{asset('js/jquery.select-bootstrap.js')}}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{asset('js/jquery.datatables.js')}}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{asset('js/sweetalert2.js')}}"></script>
<!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('js/jasny-bootstrap.min.js')}}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{asset('js/fullcalendar.min.js')}}"></script>
<!-- TagsInput Plugin -->
<script src="{{asset('js/jquery.tagsinput.js')}}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('js/material-dashboard.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
        
        <!--Morris Chart-->
        <script src="{{asset('styles/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('styles/plugins/raphael/raphael-min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('styles/js/jquery.core.js')}}"></script>
        <script src="{{asset('styles/js/jquery.app.js')}}"></script>

                <!-- Counter Up  -->
        <script src="{{asset('styles/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
        <script src="{{asset('styles/plugins/counterup/jquery.counterup.min.js')}}"></script>

                <!-- Page specific js -->
        <script src="{{asset('styles/pages/jquery.dashboard.js')}}"></script>


<script src="{{asset('js/sweetalert2.js')}}"></script>




<script>
    @if (session()->has('message'))
    swal({
        title: "{!! session()->get('title')  !!}",
        text: "{!! session()->get('message')  !!}",
        type: "{!! session()->get('type')  !!}",
        buttonsStyling: false,
        confirmButtonClass: "btn btn-success",
        confirmButtonText: "OK"
    });
    @endif

</script>



<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();
    });

</script>

</html>