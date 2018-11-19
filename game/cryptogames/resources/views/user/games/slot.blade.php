@extends('layouts.dashboard')
@section('title', 'Slot Game')
@section('content')

<style type="text/css">
    #casino {
    border-top: 20px dotted rgb(180, 75, 119);
    border-bottom: 10px solid #A48E4E;
    background-color: rgb(240, 150, 150);
}
#casino .content:nth-child(1) {
    text-align: center;
    background: url({{asset('img/casino/machine.png')}}) no-repeat 50% 80px;
    height: 620px;
}
#casino .content > div {
    clear: both;
    padding-top: 200px;
    width: 300px;
    margin: 0 auto;
}
.slotMachine {
    width: 32.333333%;
    border: 5px solid #000;
    height: 100px;
    padding: 0px;
    overflow: hidden;
    display: inline-block;
    text-align: center;
    background-color: #ffffff;
}
.btn-group-casino {
    margin-top: 150px;
    margin-left: -32px;
}
.btn-group-justified {
    display: table;
    width: 100%;
    table-layout: fixed;
    border-collapse: separate;
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-block;
    vertical-align: middle;
}
.slotMachine .slot {
    height: 100px;
    background-position-x: 55%;
    background-repeat: no-repeat;
}
.Cherry {
    background-image: url({{asset('img/casino/Cherry.png')}});
}
.Orange {
    background-image: url({{asset('img/casino/Orange.png')}});
}
.Grape {
    background-image: url({{asset('img/casino/Grape.png')}});
}
.Bell {
    background-image: url({{asset('img/casino/Bell.png')}});
}
.Bar {
    background-image: url({{asset('img/casino/Bar.png')}});
}
.Seven {
    background-image: url({{asset('img/casino/Seven.png')}});
}
</style>

            <div class="row">

                <div class="col-xs-12 col-lg-12 col-xl-6 m-t-20">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Prizes</h4>
                        <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Game</th>
                                                        <th>Prize</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Bar Bar Bar</td>
                                                        <td>{{ $pay_bar }} BTC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cherry Cherry Cherry</td>
                                                        <td>{{ $pay_cherry }} BTC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Orange Orange Orange</td>
                                                        <td>{{ $pay_orange }} BTC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grape Grape Grape</td>
                                                        <td>{{ $pay_grape }} BTC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Seven Seven Seven</td>
                                                        <td>{{ $pay_seven }} BTC</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bell Bell Bell</td>
                                                        <td>{{ $pay_bell }} BTC</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                    </div>
                    <div class="card-box">
                        <h4 class="header-title m-t-0">ADS</h4>
                    </div>
                    <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-6 m-t-20">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">ADS</h4>

                    </div>
                </div>
                <div class="col-xs-12 col-lg-12 col-xl-6 m-t-20">
                    <div class="card-box">
                        <h4 class="header-title m-t-0">Buy Slot Credits</h4>
                        <br>
                        <form action="{{route('userBuySlot')}}" method="POST">
                            <fieldset class="form-group">
                                <label for="credits">Credits Amount</label>
                                <input type="number" class="form-control" id="credits" name="credits">
                                <small class="text-muted">Price per credit: {{ $price_slot }} BTC
                                </small>
                            </fieldset>
                                                        {!! csrf_field() !!}
                            @if(Session::has('buy_message'))
                            <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                            <strong>{{Session::get('buy_message')}}!</strong> 
                            </div>
                             @endif
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                            <button type="submit" class="btn btn-warning waves-effect waves-light w-lg">Buy Credits</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                    </div>
                </div>


                <div class="col-xs-12 col-lg-12 col-xl-6 m-t-20">
                    <div class="card-box">
                            <div id="casino" style="padding-top:50px;">
            <div class="content">
                <h1>Slot Game</h1>
                <div>

@if(isset($result1))                    
                    <div id="casino1" class="slotMachine" style="margin-left: -65px;">
                        <div class="slot {{ $result1 }}"></div>
                    </div>

                    <div id="casino2" class="slotMachine">
                        <div class="slot {{ $result2 }}"></div>
                    </div>

                    <div id="casino3" class="slotMachine">
                        <div class="slot {{ $result3 }}"></div>
                    </div>
@else

                    <div id="casino1" class="slotMachine" style="margin-left: -65px;">
                        <div class="slot Cherry"></div>
                    </div>

                    <div id="casino2" class="slotMachine">
                        <div class="slot Orange"></div>
                    </div>

                    <div id="casino3" class="slotMachine">
                        <div class="slot Grape"></div>
                    </div>

@endif

                    <div class="btn-group btn-group-justified btn-group-casino" role="group">
                    @if(Session::has('slot_message'))
                        <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                            <strong>{{Session::get('slot_message')}}!</strong> 
                        </div>
                    @endif
                     <form action="" method="post" role="form">
                        {!! csrf_field() !!}
                        <button type="submit" id="showtoast" class="btn btn-primary btn-lg btn-block waves-effect waves-light"> <span>Play Spin</span> <i class="fa fa-bitcoin"></i> </button>
                     </form>                    
                    </div>
                </div>
                <br>
                <p><b>Your Slot Credits: {{ $slot_credits }}</b></p>
            </div>
            <div class="clearfix"></div>
        </div>


            </div>
        </div>
    </div>




@endsection