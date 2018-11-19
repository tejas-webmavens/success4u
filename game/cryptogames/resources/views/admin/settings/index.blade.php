@extends('layouts.admin')

@section('title', 'Update Website Settings')

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header card-header-tabs" data-background-color="purple">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title">Web Site Settings:</span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="active">
                                    <a href="#general" data-toggle="tab">
                                        <i class="material-icons">bug_report</i> General
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#features" data-toggle="tab">
                                        <i class="material-icons">code</i> Site Features
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#settings" data-toggle="tab">
                                        <i class="material-icons">cloud</i> User
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#games" data-toggle="tab">
                                        <i class="material-icons">games</i> Games
                                        <div class="ripple-container"></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">

                            <form action="{{route('generalSettings',['id'=>$settings->id])}}" method="post">
                                {{csrf_field()}}

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

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="site_name">Site Name</label>
                                            <input id="site_name" name="site_name" type="text" value="{{$settings->site_name}}" class="form-control">

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="site_title">Site Title</label>
                                            <input id="site_title" name="site_title" type="text" value="{{$settings->site_title}}" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="company_name">Company Name</label>
                                            <input id="company_name" name="company_name" type="text" value="{{$settings->company_name}}" class="form-control">

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="contact_email">Contact Email Address</label>
                                            <input id="contact_email" name="contact_email" value="{{$settings->contact_email}}" type="text" class="form-control">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="app_contact">System Contact Email</label>
                                            <input id="app_contact" name="app_contact" type="text" value="{{$settings->app_contact}}" class="form-control">

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="disqus">Disqus Comment System Site Username</label>
                                            <input id="disqus" name="disqus" type="text" value="{{$settings->disqus}}" class="form-control">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="address">Company Address</label>
                                            <input id="address" name="address" type="text" value="{{$settings->address}}" class="form-control">

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="contact_number">Phone Number</label>
                                            <input id="contact_number" name="contact_number" type="text" value="{{$settings->contact_number}}" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="chat_code">Tawk To Chat Code</label>
                                            <input id="chat_code" name="chat_code" type="text" value="{{$settings->chat_code}}" class="form-control">

                                        </div>
                                    </div>



                                </div>
                                <a href="{{route('adminIndex')}}" class="btn btn-rose">Cancel Configure</a>

                                <button type="submit" class="btn btn-success pull-right">Save Changes</button>

                                <div class="clearfix"></div>

                            </form>


                        </div>
                        <div class="tab-pane" id="features">

                            <form action="{{route('featuresSettings',['id'=>$settings->id])}}" method="post">
                                {{csrf_field()}}

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

                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Paid To Click Settings. If you Turn Off then All PTC System Will be Turn Off. </p>
                                            <div class="form-group label-floating">
                                                <select class="selectpicker" name="ptc" data-style="btn btn-info btn-round" title="Select Status" data-size="7">

                                                    <option value="0"
                                                            @if($settings->ptc == 0)
                                                            selected
                                                            @endif
                                                    >Turn Off</option>
                                                    <option value="1"
                                                            @if($settings->ptc == 1)
                                                            selected
                                                            @endif

                                                    >Turn On</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Pay Per Video Settings. If you Turn Off then All PPV System Will be Turn Off. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="ppv" data-style="btn btn-success btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->ppv == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->ppv == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Payment Proof Settings. If you Turn Off then No one can see Payment Proof Page. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="payment_proof" data-style="btn btn-info btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->payment_proof == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->payment_proof == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <div class="row">

                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Deposit & Withdraw Settings. If you Turn Off, No one can see Info in HomePage. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="latest_deposit" data-style="btn btn-info btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->latest_deposit == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->latest_deposit == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Fund Transfer Settings. If you Turn Off, No one can Transfer Fund User to User. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="transfer" data-style="btn btn-success btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->transfer == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->transfer == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Live Chat Settings. If you Turn Off, No one can Use live chat. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="live_chat" data-style="btn btn-info btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->live_chat == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->live_chat == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <hr>
                                <br>
                                <div class="row">

                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Membership Upgrade Settings. If you Turn Off, No one can see Upgrade option. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="membership_upgrade" data-style="btn btn-info btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->membership_upgrade == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->membership_upgrade == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <p class="text-danger text-center"> This is a Investment Settings. If you Turn Off, No one can see Investment System. </p>
                                        <div class="form-group label-floating">
                                            <select class="selectpicker" name="invest" data-style="btn btn-success btn-round" title="Select Status" data-size="7">

                                                <option value="0"
                                                        @if($settings->invest == 0)
                                                        selected
                                                        @endif
                                                >Turn Off</option>
                                                <option value="1"
                                                        @if($settings->invest == 1)
                                                        selected
                                                        @endif

                                                >Turn On</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <br>


                                <a href="{{route('adminIndex')}}" class="btn btn-rose">Cancel Configure</a>

                                <button type="submit" class="btn btn-warning pull-right">Save Changes</button>

                                <div class="clearfix"></div>

                            </form>


                        </div>
                        <div class="tab-pane" id="settings">


                            <form action="{{route('usersSettings',['id'=>$settings->id])}}" method="post">
                                {{csrf_field()}}

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

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="minimum_deposit">Minimum Deposit (in BTC)</label>
                                            <input id="minimum_deposit" name="minimum_deposit" type="text" value="{{$settings->minimum_deposit +0}}" class="form-control">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="minimum_withdraw">Minimum Withdraw (in BTC)</label>
                                            <input id="minimum_withdraw" name="minimum_withdraw" type="text" value="{{$settings->minimum_withdraw +0}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="self_transfer">Self Transfer Commission (in Percentage)</label>
                                            <input id="self_transfer" name="self_transfer" type="text" value="{{$settings->self_transfer + 0}}" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="other_transfer">Member to Member Transfer Commission (in Percentage)</label>
                                            <input id="other_transfer" name="other_transfer" type="text" value="{{$settings->other_transfer + 0}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="signup_bonus">Normal Sign up Bonus (in BTC)</label>
                                            <input id="signup_bonus" name="signup_bonus" type="text" value="{{$settings->signup_bonus + 0}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="link_share">Referral Link Share Bonus (in BTC)</label>
                                            <input id="link_share" name="link_share" type="text" value="{{$settings->link_share + 0}}" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="referral_signup">Referral Sign Up Bonus (in BTC)</label>
                                            <input id="referral_signup" name="referral_signup" type="text" value="{{$settings->referral_signup + 0}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="referral_deposit">Referral Deposit Commission (in Percentage)</label>
                                            <input id="referral_deposit" name="referral_deposit" type="text" value="{{$settings->referral_deposit + 0}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="referral_advert">Referral PTC & PPV Commission (in Percentage)</label>
                                            <input id="referral_advert" name="referral_advert" type="text" value="{{$settings->referral_advert + 0}}" class="form-control">

                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="referral_upgrade">Referral Membership Upgrade Commission (in Percentage)</label>
                                            <input id="referral_upgrade" name="referral_upgrade" type="text" value="{{$settings->referral_upgrade + 0}}" class="form-control">

                                        </div>
                                    </div>


                                </div>

                                <a href="{{route('adminIndex')}}" class="btn btn-rose">Cancel Configure</a>

                                <button type="submit" class="btn btn-success pull-right">Save Changes</button>

                                <div class="clearfix"></div>

                            </form>


                        </div>

                        <div class="tab-pane" id="games">


                            <form action="{{route('gamesSettings',['id'=>$settings->id])}}" method="post">
                                {{csrf_field()}}

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

                                <h4>Roll Game</h4>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="ref_roll">Referral Percentage: (in Percentage)</label>
                                            <input id="ref_roll" name="ref_roll" type="text" value="{{$settings->ref_roll}}" class="form-control">

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="time_roll">Game Pause Time-Period (Minutes):</label>
                                            <input id="time_roll" name="time_pay_roll" type="text" value="{{$settings->time_pay_roll}}" class="form-control">

                                        </div>
                                    </div>

<!--                                     <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="self_transfer">Self Transfer Commission (in Percentage)</label>
                                            <input id="self_transfer" name="self_transfer" type="text" value="{{$settings->self_transfer + 0}}" class="form-control">

                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="roll_level1">0 - 9885 (Winning Amount):</label>
                                            <input id="roll_level1" name="roll_level1" type="text" value="{{$settings->roll_level1}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="roll_level2">9886 - 9985 (Winning Amount):</label>
                                            <input id="roll_level2" name="roll_level2" type="text" value="{{$settings->roll_level2}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="roll_level3">9986 - 9993 (Winning Amount):</label>
                                            <input id="roll_level3" name="roll_level3" type="text" value="{{$settings->roll_level3}}" class="form-control">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for=" roll_level4">9994 - 9997 (Winning Amount):</label>
                                            <input id=" roll_level4" name=" roll_level4" type="text" value="{{$settings->   roll_level4}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for=" roll_level5">9998 - 9999 (Winning Amount):</label>
                                            <input id=" roll_level5" name=" roll_level5" type="text" value="{{$settings->   roll_level5}}" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">
                                            <label  class="control-label" for="roll_level6">10000 (Winning Amount):</label>
                                            <input id="roll_level6" name="roll_level6" type="text" value="{{$settings->roll_level6}}" class="form-control">

                                        </div>
                                    </div>

                                </div>

                                <h4>Faucet</h4>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="faucet_pay">Pay Amount:</label>
                                            <input id="faucet_pay" name="faucet_pay" type="text" value="{{$settings->faucet_pay}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="faucet_time">Pay Pause Time-Period (Minutes):</label>
                                            <input id="faucet_time" name="faucet_time" type="text" value="{{$settings->faucet_time}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="ref_faucet">Referral Percentage:</label>
                                            <input id="ref_faucet" name="ref_faucet" type="text" value="{{$settings->ref_faucet}}" class="form-control">

                                        </div>
                                    </div>

                                </div>

                                <h4>Coin Tail</h4>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="cointail_pay">Pay Amount (in Percentage):</label>
                                            <input id="cointail_pay" name="cointail_pay" type="text" value="{{$settings->cointail_pay}}" class="form-control">

                                        </div>
                                    </div>

                                </div>

                                <h4>Slot</h4>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="bar">Pay Amount (Bar|Bar|Bar):</label>
                                            <input id="bar" name="bar" type="text" value="{{$settings->bar}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="orange">Pay Amount (Orange|Orange|Orange):</label>
                                            <input id="orange" name="orange" type="text" value="{{$settings->orange}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="grape">Pay Amount (Grape|Grape|Grape):</label>
                                            <input id="grape" name="grape" type="text" value="{{$settings->grape}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="seven">Pay Amount (Seven|Seven|Seven):</label>
                                            <input id="seven" name="seven" type="text" value="{{$settings->seven}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="bell">Pay Amount (Bell|Bell|Bell):</label>
                                            <input id="bell" name="bell" type="text" value="{{$settings->bell}}" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="bar">Pay Amount (Bar|Bar|Bar):</label>
                                            <input id="bar" name="bar" type="text" value="{{$settings->bar}}" class="form-control">

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group label-floating">

                                            <label  class="control-label" for="price_slot">Price Slot Credit:</label>
                                            <input id="price_slot" name="price_slot" type="text" value="{{$settings->price_c_slot}}" class="form-control">

                                        </div>
                                    </div>
                                </div>

                                <a href="{{route('adminIndex')}}" class="btn btn-rose">Cancel Configure</a>

                                <button type="submit" class="btn btn-success pull-right">Save Changes</button>

                                <div class="clearfix"></div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection