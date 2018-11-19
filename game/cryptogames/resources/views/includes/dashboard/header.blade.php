        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="{{route('userDashboard')}}" class="logo">
                            <i class="zmdi zmdi-group-work icon-c-logo"></i>
                            <span>{{config('app.name')}}</span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav pull-right">

                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="{{asset(Auth::user()->profile->avatar)}}" alt="user" class="img-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Welcome {{ Auth::user()->name }}</small> </h5>
                                    </div>

                                    @if(Auth::user()->admin)

                                     <!-- item-->
                                    <a href="{{route('adminIndex')}}" class="dropdown-item notify-item">
                                        <i class="fa fa-eye"></i> <span>Admin Dashboard</span>
                                    </a>

                                    @endif

                                    <!-- item-->
                                    <a href="{{route('userDashboard')}}" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{route('userProfile')}}" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </div>
                            </li>

                        </ul>

                    </div> <!-- end menu-extras -->
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
                                <a href="{{route('userDashboard')}}"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-puzzle-piece"></i> <span> Games </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{route('userRollGame')}}">Roll Game</a></li>
                                    <li><a href="{{route('userCointail')}}">Coin Tail Game</a></li>
                                    <li><a href="{{route('userSlot')}}">Slot Game</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-btc"></i> <span> Earn </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{route('userFaucet')}}">Faucet</a></li>
                                    <li><a href="{{route('userCash.links')}}">View Ads</a></li>
                                    <li><a href="{{route('userMemberships')}}">Memberships</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fa fa-bank"></i> <span> Bank </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{route('userDeposit.create')}}">Deposit</a></li>
                                    <li><a href="{{route('userWithdraw.create')}}">Withdraw</a></li>
                                    <li><a href="{{route('userFundsTransfer')}}">Exchange</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="zmdi zmdi-album"></i> <span> History </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{route('userDeposits')}}">Deposit History</a></li>
                                    <li><a href="{{route('userWithdraws')}}">Withdraw History</a></li>
                                    <li><a href="{{route('userEarns')}}">Earning History</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('userReferrals')}}"><i class="fa fa-users"></i> <span> Referrals </span> </a>
                            </li>

                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>