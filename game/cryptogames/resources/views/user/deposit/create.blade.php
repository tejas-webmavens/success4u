@extends('layouts.dashboard')
@section('title', 'Cash in balance to your account')
@section('content')


<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Deposit</h4>
                    </div>
                </div>

<div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
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
                                    <h4 class="header-title m-t-0">Deposit</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Deposit Balance
                                    </p>

                    <div class="p-20">

                        @if(Session::has('dep_message'))
                        <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>    
                            <strong>{{Session::get('dep_message')}}</strong>
                        </div>
                    @endif


                        <div class="tab-content" id="myTabContent">
                                                <div role="tabpanel" class="tab-pane fade active in" id="instant" aria-labelledby="home-tab" aria-expanded="true">

                                    <form action="{{route('userDeposit.btc')}}" method="post">
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
                                            <br>
                                        @endif

                                        <fieldset class="form-group">
                                                    <label for="tob">Select Deposit Gateway</label>
                                                    <select class="form-control" name="gateway" data-style="btn btn-warning btn-round" title="Select Deposit Gateway" data-size="7" id="tob">
                                                         @foreach($gateways as $gateway)
                                                            <option value="{{$gateway->id}}">{{$gateway->name}}</option>
                                                        @endforeach
                                                    </select>
                                        </fieldset>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="form-group label-floating">

                                                    <label  class="control-label" for="amount">Deposit Amount</label>
                                                    <input id="amount" name="amount" type="text" class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input id="currency" name="currency" type="hidden" value="BTC">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light w-lg pull-right">Deposit</button>
                                        <div class="clearfix"></div>
                                    </form>
                                                </div>

                         </div>



                                </div>

                            </div>                

            </div>
        </div>
    </div>



@endsection