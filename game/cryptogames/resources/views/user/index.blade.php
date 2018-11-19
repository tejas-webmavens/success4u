@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')


                    <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-bank pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Account Balance</h6>
                            <h2 class="m-b-20"><i class="fa fa-btc"></i> <span data-plugin="counterup">{{$user->profile->main_balance}}</span></h2>
<!--                             <span class="label label-success"> +0.0000 BTC </span> <span class="text-muted">Last earning</span> -->
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-users pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Referral Balance</h6>
                            <h2 class="m-b-20"><i class="fa fa-btc"></i> <span data-plugin="counterup">{{$user->profile->referral_balance}}</span></h2>
<!--                             <span class="label label-success"> +0.0000 BTC </span> <span class="text-muted">Last earning</span> -->
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-suitcase pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Deposited Balance</h6>
                            <h2 class="m-b-20"><i class="fa fa-btc"></i> <span data-plugin="counterup">{{$user->profile->deposit_balance}}</span></h2>
<!--                             <span class="label label-success"> +0.0000 BTC </span> <span class="text-muted">Last deposit</span> -->
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card-box tilebox-one">
                            <i class="fa fa-cloud-upload pull-xs-right text-muted"></i>
                            <h6 class="text-muted text-uppercase m-b-20">Total Withdraw</h6>
                            <h2 class="m-b-20"><i class="fa fa-btc"></i> <span data-plugin="counterup">{{$withdraw}}</span></h2>
<!--                             <span class="label label-danger"> -0.0000 BTC </span> <span class="text-muted">Last withdraw</span> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->



<div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="card">
                                    <a href="{{route('userRollGame')}}"><img class="card-img-top img-fluid" src="{{asset('styles/images/gallery/roll_game.jpg')}}" alt="Card image cap"></a>
                                    <div class="card-block text-xs-center">
                                    <h4 class="m-t-0 header-title">Roll Game</h4>
                                    <a href="{{route('userRollGame')}}" class="btn btn-primary-outline waves-effect waves-light w-lg">Play Game</a>
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="card">
                                    <a href="{{route('userFaucet')}}">
                                    <img class="card-img-top img-fluid" src="{{asset('styles/images/gallery/faucet.jpg')}}" alt="Card image cap">
                                    </a>
                                    <div class="card-block text-xs-center">
                                        <h4 class="m-t-0 header-title">Faucet</h4>
                                    <a href="{{route('userFaucet')}}" class="btn btn-primary-outline waves-effect waves-light w-lg">Go to Faucet</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="card">
                                    <a href="{{route('userSlot')}}">
                                    <img class="card-img-top img-fluid" src="{{asset('styles/images/gallery/slot_game.jpg')}}" alt="Card image cap">
                                     </a>
                                    <div class="card-block text-xs-center">
                                        <h4 class="m-t-0 header-title">Slot Game</h4>
                                    <a href="{{route('userSlot')}}" class="btn btn-primary-outline waves-effect waves-light w-lg">Play Game</a>
                                    </div>
                                </div>
                            </div>

</div>

<div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="card">
                                    <a href="{{route('userCointail')}}">
                                        <img class="card-img-top img-fluid" src="{{asset('styles/images/gallery/cointail_game.jpg')}}" alt="Card image cap"></a>
                                    <div class="card-block text-xs-center">
                                    <h4 class="m-t-0 header-title">Coin Tail Game</h4>
                                    <a href="{{route('userCointail')}}" class="btn btn-primary-outline waves-effect waves-light w-lg">Play Game</a>
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="card">
                                    <a href="{{route('userCash.links')}}">
                                    <img class="card-img-top img-fluid" src="{{asset('styles/images/gallery/view_ads.jpg')}}" alt="Card image cap">
                                    </a>
                                    <div class="card-block text-xs-center">
                                        <h4 class="m-t-0 header-title">View Ads</h4>
                                    <a href="{{route('userCash.links')}}" class="btn btn-primary-outline waves-effect waves-light w-lg">View Ads</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="card">
                                    <a href="{{route('userMemberships')}}">
                                    <img class="card-img-top img-fluid" src="{{asset('styles/images/gallery/upgrade.jpg')}}" alt="Card image cap">
                                    </a>
                                    <div class="card-block text-xs-center">
                                        <h4 class="m-t-0 header-title">Memberships</h4>
                                    <a href="{{route('userMemberships')}}" class="btn btn-primary-outline waves-effect waves-light w-lg">Upgrade</a>
                                    </div>
                                </div>
                            </div>

</div>

@endsection