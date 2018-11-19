@extends('layouts.dashboard')
@section('title', 'Roll Game')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Roll Game</h4>
                    </div>
                </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">

                    <div class="row m-t-50">

                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-3 m-t-20"></div>

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 m-t-20">
                                    <h4 class="header-title m-t-0">Roll Game</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Please fill the captcha below and press the Roll button to receive your free Bitcoins. The amount of Bitcoins you win is depends upon the number you roll, and its paid according to its corresponding position in the payout table at bottom.
                                    </p>

                    <div class="p-20">
                                        <table class="table table-striped" style="text-align: center;">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center;">LUCKY NUMBER</th>
                                                <th style="text-align: center;">PAYOUT AMOUNT</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>0 - 9885</td>
                                                <td>{{ $pay_1 }} BTC</td>
                                            </tr>
                                            <tr>
                                                <td>9886 - 9985</td>
                                                <td>{{ $pay_2 }} BTC</td>
                                            </tr>
                                            <tr>
                                                <td>9986 - 9993</td>
                                                <td>{{ $pay_3 }} BTC</td>
                                            </tr>
                                            <tr>
                                                <td>9994 - 9997</td>
                                                <td>{{ $pay_4 }} BTC</td>
                                            </tr>
                                            <tr>
                                                <td>9998 - 9999</td>
                                                <td>{{ $pay_5 }} BTC</td>
                                            </tr>
                                            <tr>
                                                <td>10000</td>
                                                <td>{{ $pay_6 }} BTC</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                    @if(Session::has('roll_message'))
                        <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>    
                            <strong>{{Session::get('roll_message')}}</strong><br>
                            <strong>{{Session::get('pay_amount')}}</strong> 
                        </div>
                    @endif

                    @if(count($errors) > 0)

                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button> 
                            @foreach($errors->all() as $error)   
                            <li><strong> {{$error}} </strong></li> 
                            @endforeach
                        </div>
                    @endif

                    @if($time_roll <= 0)
                                    <form action="" method="post" role="form">
                                      {!! csrf_field() !!}
                                      <br>
                                      <center>
                                      {!! Recaptcha::render() !!}
                                      </center>
                                      <br>
                                      <button type="submit" class="btn btn-block btn-lg btn-primary waves-effect waves-light"><span>Roll</span> <i class="fa fa-btc m-l-5"></i></button>
                                    </form>
                    @else
                    <center>
                    <h5><b>{{ $time_roll }} minutes left for next claim.</b></h5>
                    </center>
                    @endif                

                                </div>

                            </div>                

            </div>
        </div>
    </div>



@endsection