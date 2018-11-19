@extends('layouts.dashboard')
@section('title', 'Balance Transfer')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Exchange</h4>
                    </div>
                </div>

<div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-two">
                                    <i class="fa fa-bitcoin pull-xs-right text-muted"></i>
                                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">Account Balance</h6>
                                    <h2 class="m-b-10"><span data-plugin="counterup" style="font-size: 20px;">{{Auth::user()->profile->main_balance}} BTC</span></h2>
                                </div>

                                <div class="card-box tilebox-two">
                                    <i class="fa fa-bitcoin pull-xs-right text-muted"></i>
                                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">Referral Balance</h6>
                                    <h2 class="m-b-10"><span data-plugin="counterup" style="font-size: 20px;">{{Auth::user()->profile->referral_balance}} BTC</span></h2>
                                </div>

                                <div class="card-box tilebox-two">
                                    <i class="fa fa-bitcoin pull-xs-right text-muted"></i>
                                    <h6 class="text-primary text-uppercase m-b-15 m-t-10">Deposit Balance</h6>
                                    <h2 class="m-b-10"><span data-plugin="counterup" style="font-size: 20px;">{{Auth::user()->profile->deposit_balance}} BTC</span></h2>
                                </div>
        </div>

    <div class="col-xs-8">
            <div class="card-box">

                    <div class="row m-t-50">

                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-2 m-t-20"></div>

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-8 m-t-20">
                                    <h4 class="header-title m-t-0">Exchange</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Exchange your Balance
                                    </p>

                    <div class="p-20">
                                    
                                    <div class="tab-content">
                        <div class="tab-pane active" id="self">

                            <form action="{{route('userFundsTransfer.self')}}" method="post">
                                {{ csrf_field() }}
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                                        <span data-notify="message">

                                            @foreach($errors->all() as $error)

                                                        <li><strong> {{$error}} </strong></li>
                                            @endforeach

                                        </span>
                                    </div>
                                @endif

                                @if(Session::has('ex_message'))
                                    <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>    
                                        <strong>{{Session::get('ex_message')}}</strong><br>
                                    </div>
                                @endif

                            <fieldset class="form-group">
                                                    <label for="from">From Balance</label>
                                                    <select class="form-control" name="account" data-style="btn btn-info btn-round" title="Select Status" data-size="7" id="from">
                                                        <option value="1" > Deposit Balance</option>
                                                        <option value="2" > Account Balance</option>
                                                        <option value="3" selected> Referral Balance</option>
                                                    </select>
                            </fieldset>

                            <fieldset class="form-group">
                                                    <label for="tob">To Balance</label>
                                                    <select class="form-control" name="transfer" data-style="btn btn-info btn-round" title="Select Status" data-size="7" id="tob">
                                                        <option value="1" selected >Deposit Balance</option>
                                                        <option value="2" >Account Balance</option>
                                                    </select>
                            </fieldset>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label  class="control-label" for="amount">Exchange Amount (BTC)</label>
                                        <input id="amount" name="amount" type="text" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <br>

                                <button type="submit" class="btn btn-primary waves-effect waves-light w-lg pull-right">Exchange</button>
                                <div class="clearfix"></div>
                            </form>


                        </div>
                        @if($settings->transfer == 1)
                        <div class="tab-pane" id="other">

                            <form action="{{route('userFundsTransfer.others')}}" method="post">
                                {{ csrf_field() }}
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                                        <i class="material-icons" data-notify="icon">notifications</i>
                                        <span data-notify="message">

                                            @foreach($errors->all() as $error)

                                                <li><strong> {{$error}} </strong></li>
                                            @endforeach

                                        </span>
                                    </div>
                                @endif

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group label-floating">
                                        <select class="selectpicker" name="account" data-style="btn btn-info btn-round" title="Select Status" data-size="7">
                                            <option value="1" selected >Main Balance</option>
                                            <option value="2" >Deposit Balance</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label  class="control-label" for="email">Receiver Email Address</label>
                                        <input id="email" name="email" type="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label  class="control-label" for="amount">Sending Amount</label>
                                        <input id="amount" name="amount" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                                <a href="{{route('userDashboard')}}" class="btn btn-rose">Cancel Transfer</a>

                                <button type="submit" class="btn btn-success pull-right">Transfer Now</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                        @endif
                    </div>

                                </div>

                            </div>                

            </div>
        </div>
    </div>

@endsection