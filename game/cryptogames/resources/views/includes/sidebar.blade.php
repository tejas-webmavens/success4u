<div class="sidebar" data-active-color="rose" data-background-color="black">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
    <div class="logo">
        <a href="{{route('adminIndex')}}" class="simple-text">
            {{config('app.dev_name')}} - Admin
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="#" class="simple-text">
            TPA
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{asset(Auth::user()->profile->avatar)}}" alt="User Photo" class="img">
            </div>
            <div class="info">
                <a data-toggle="collapse" href="" class="collapsed">
                    {{ Auth::user()->name }}

                </a>


            </div>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="{{route('adminIndex')}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li>
                <a data-toggle="collapse" href="#UserMail">
                    <i class="material-icons">markunread_mailbox</i>
                    <p>Email System
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="UserMail">
                    <ul class="nav">
                        <li>
                            <a href="{{route('adminEmail')}}">Inbox</a>
                        </li>
                        <li>
                            <a href="{{route('adminEmail.create')}}">Compose Email</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#UserMember">
                    <i class="material-icons">face</i>
                    <p>Member
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="UserMember">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.users.index')}}">All Member</a>
                        </li>
                        <li>
                            <a href="{{route('admin.user.create')}}">Create Member</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#ptcAds">
                    <i class="material-icons">computer</i>
                    <p>PTC Ads
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="ptcAds">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.ptcs.index')}}">All PTC Ads</a>
                        </li>
                        <li>
                            <a href="{{route('admin.ptc.create')}}">Create PTC Ads</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li>
                <a href="{{route('admin.gateways.index')}}">
                    <i class="material-icons">call_split</i>
                    <p>Instant Gateways
                    </p>
                </a>
            </li>

            <li>
                <a data-toggle="collapse" href="#lGateways">
                    <i class="material-icons">transfer_within_a_station</i>
                    <p>Withdraw Gateway
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="lGateways">
                    <ul class="nav">

                        <li>
                            <a href="{{route('admin.gateways.local')}}">All Withdraw Gateways</a>
                        </li>

                        <li>
                            <a href="{{route('admin.local.create')}}">Create Withdraw Gateway</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#membership">
                    <i class="material-icons">settings_input_antenna</i>
                    <p>Membership
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="membership">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.memberships.index')}}">All Membership</a>
                        </li>
                        <li>
                            <a href="{{route('admin.membership.create')}}">Create Membership</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#DepositArea">
                    <i class="material-icons">payment</i>
                    <p>Deposit Area
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="DepositArea">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.users.deposit')}}">All Deposits

                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li>
                <a data-toggle="collapse" href="#WithdrawArea">
                    <i class="material-icons">account_balance</i>
                    <p>Withdraw Area
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="WithdrawArea">
                    <ul class="nav">
                        <li>
                            <a href="{{route('admin.users.withdraws')}}">Completed Withdraw

                            </a>
                        </li>

                        <li>
                            <a href="{{route('admin.withdraws.request')}}">Withdraw Request</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#SupportArea">
                    <i class="material-icons">supervisor_account</i>
                    <p>Support Area
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="SupportArea">
                    <ul class="nav">
                        <li>
                            <a href="{{route('adminSupports.open')}}">All Open Ticket
                            </a>
                        </li>
                        <li>
                            <a href="{{route('adminSupports.index')}}">All Close Ticket</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li>
                <a href="{{route('websiteSettings')}}">
                    <i class="material-icons">settings</i>
                    <p>Settings
                    </p>
                </a>
            </li>

        </ul>
    </div>
</div>