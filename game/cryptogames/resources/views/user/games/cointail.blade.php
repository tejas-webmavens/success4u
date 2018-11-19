@extends('layouts.dashboard')
@section('title', 'Coin Tail Game')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Coin Tail Game</h4>
                    </div>
                </div>

    <div class="row">
        <div class="col-xs-12">
                    <div class="row">

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 m-t-20">
                                    <div class="card-box">
                                    <h4 class="header-title m-t-0">Coin Tail</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Earn up to <b>{{ $game_pay }}</b>% of your bet.
                                    </p>

                                    <form action="" method="post" role="form">
                                      {!! csrf_field() !!}
                                    <div class="row" style="text-align: center;">
                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 m-t-20">
                                      <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <img src="{{asset('img/casino/head.png')}}" style="width: 200px;">
                                                        
                                                        <div class="radio" style="margin-top: 25px;">
                                                            <input type="radio" name="game" id="radio1" value="0" checked="">
                                                            <label for="radio1">
                                                                <b>HEAD</b>
                                                            </label>
                                                        </div>


                                                    </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 m-t-20">
                                      <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <img src="{{asset('img/casino/tail.png')}}" style="width: 200px;">
                                                        <br>
                                                        <div class="radio" style="margin-top: 25px;">
                                                            <input type="radio" name="game" id="radio2" value="1" checked="">
                                                            <label for="radio2">
                                                                <b>TAIL</b>
                                                            </label>
                                                        </div>


                                                    </div>
                                        </div>
                                    </div>
                                    </div>
                                    <br>

                                        <label>Amount Bet (BTC)</label>
                                        <input class="form-control form-control-lg m-b-20" name="amount" placeholder="0.00001000">

                    @if(Session::has('cointail_message'))
                    <br>
                        <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>    
                            <strong>{{Session::get('cointail_message')}}</strong>
                        </div>
                    @endif

                    @if(count($errors) > 0)
                    <br>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button> 
                            @foreach($errors->all() as $error)   
                            <li><strong> {{$error}} </strong></li> 
                            @endforeach
                        </div>
                    @endif
                                      <br>
                                      <center>
                                      {!! Recaptcha::render() !!}
                                      </center>
                                      <br>
                                      <button type="submit" name="tail" class="btn btn-block btn-lg btn-primary waves-effect waves-light"><span>Bet</span> <i class="fa fa-btc m-l-5"></i></button>
                                    </form>               

                                </div>
                            </div>

        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6 m-t-20">
            <div class="card-box">
                <h4 class="header-title m-t-0">Last 15 Bets from all users</h4>
            <table class="table table-striped" style="text-align: center;">
                                            <thead>
                                            <tr>
                                                <th style="text-align: center;">Amount</th>
                                                <th style="text-align: center;">Bet</th>
                                                <th style="text-align: center;">Game</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($game_dates as $ga)
                                            @if ($ga->best == 'Earn')    
                                            <tr class="text-success">
                                            @else
                                            <tr class="text-danger">
                                            @endif
                                                <td>{{ $ga->amount }} BTC</td>
                                                <td>{{ $ga->game }}</td>
                                                <td>{{ $ga->best }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
        </div>
    </div>

                            </div>                

        </div>
    </div>




@endsection