@extends('layouts.dashboard')
@section('title', 'Pick the best plan for you')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Memberships</h4>
                    </div>
                </div>

<div class="row">
        <div class="col-xs-12">
            <div class="card-box">

                    <div class="row m-t-50">

                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-2 m-t-20"></div>

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-8 m-t-20">
                                    <h4 class="header-title m-t-0">Pick the best plan for you</h4>
                                    <p class="text-muted font-13 m-b-10">
                                        Bigger package has Bigger Earning System and Premium Support on each package.
                                    </p>

                            @if(Session::has('upgrade_message'))
                             <div class="alert alert-{{Session::get('type')}} alert-dismissible fade in" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">×</span>
                             </button>
                             <strong>{{Session::get('upgrade_message')}}!</strong> 
                             </div>
                            @endif

                                    <div class="row">

                                    @if($memberships)
                                      @foreach($memberships as $membership)
                                      <div class="col-sm-4 col-xs-12">
                                          <div class="card card-inverse text-xs-center" style="background-color: #333; border-color: #333;">
                                              <div class="card-block">
                                                  <h3 class="card-title">{{$membership->name}}</h3>
                                                  <h5 class="card-title">@if($membership->price == 0)
                                                Free
                                               @else
                                                {{$membership->price}} BTC
                                               @endif</h5>
                                               <table class="table table-bordered" style="background-color: #fff">
                                                    <tbody>
                                                    <tr>
                                                        <td>Duration</td>
                                                        @if($membership->id == 1)
                                                        <td>Lifetime</td>
                                                        @else
                                                        <td>{{$membership->duration}} Days</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Daily Ads</td>
                                                        <td>{{$membership->ad_limit}} Ads</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Type</td>
                                                        <td>{{$membership->name}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                  <p class="card-text">{!! $membership->details !!}</p>
                                              <center>
                                                @if($membership->id == $user->membership_id)
                                                  <a class="btn btn-warning disabled">Already Upgraded</a>
                                                @else
                                                  <a href="{{route('userMembership.upgrade', $membership->id)}}" class="btn btn-primary">Upgrade</a>
                                                @endif
                                              </center>
                                              </div>
                                          </div>
                                      </div>

                                      @endforeach
                                    @endif

                                    </div>

                                </div>

                            </div>                

            </div>
        </div>
    </div>




@endsection