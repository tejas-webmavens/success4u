        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="{{route('welcome')}}" class="logo">
                            <i class="zmdi zmdi-group-work icon-c-logo"></i>
                            <span>{{config('app.name')}}</span>
                        </a>
                    </div>
                    <!-- End Logo container-->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->


            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li>
                                <a href="{{route('welcome')}}"><i class="zmdi zmdi-view-dashboard"></i> <span> Home </span> </a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('contact')}}"><i class="fa fa-envelope"></i> <span> Support </span> </a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('register')}}"><i class="fa fa-sign-out"></i> <span> Register </span> </a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('login')}}"><i class="fa fa-sign-in"></i> <span> Login </span> </a>
                            </li>

                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>