@extends('layouts.dashboard')
@section('title', 'BTC Preview')
@section('content')


<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Deposit Preview</h4>
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
                                        Deposit Preview
                                    </p>

                    <div class="p-20">


                        <div class="tab-content" id="myTabContent">
                                                <div role="tabpanel" class="tab-pane fade active in" id="instant" aria-labelledby="home-tab" aria-expanded="true">

                                                    <center><img src="{{ $qrcode_url }}">

                                                    
                                                 <h5>Please send exactly <strong>{{ $amount }}</strong> {{ $currency }} to this bitcoin addresss: <strong>{{ $address }}</strong></h5>

                                                 </center>

                                    
                                                </div>

                         </div>



                                </div>

                            </div>                

            </div>
        </div>
    </div>



@endsection