@extends('layouts.dashboard')
@section('title', 'Faucet')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Faucet</h4>
                    </div>
                </div>

    <div class="row">
        <div class="col-xs-12">
                    <div class="row">

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-5 m-t-20">
                                    <div class="card-box">
                                    <h4 class="header-title m-t-0">Faucet</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Claim <b>{{ $faucet_pay }}</b> BTC every <b>{{ $faucet_time }}</b> minutes.
                                    </p>


                    @if(Session::has('f_message'))
                    <br>
                        <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>    
                            <strong>{{Session::get('f_message')}}</strong>
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

                    @if($next_claim <= 0)
                                    <form action="" method="post" role="form">
                                      {!! csrf_field() !!}
                                      <br>
                                      <center>
                                      {!! Recaptcha::render() !!}
                                      </center>
                                      <br>
                                      <button type="submit" class="btn btn-block btn-lg btn-primary waves-effect waves-light"><span>Claim</span> <i class="fa fa-btc m-l-5"></i></button>
                                    </form>
                    @else
                    <center>
                    <h5><b>{{ $next_claim }} minutes left for next claim.</b></h5>
                    </center>
                    @endif               

                                </div>
                            </div>

        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-7 m-t-20"></div>

                            </div>                

        </div>
</div>




@endsection