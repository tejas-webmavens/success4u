@extends('layouts.dashboard')
@section('title', 'My Referral & Link')
@section('content')

<style type="text/css">
    img {
    width: 60px;
    height: 60px;
}
</style>

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Referrals</h4>
                    </div>
                </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">

                    <div class="row m-t-50">

                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-1 m-t-20"></div>

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-10 m-t-20">
                                    <h4 class="header-title m-t-0">Referrals</h4>
                                    <p>{{ $link }}</p>

                    <div class="p-20">
                       @if(count($referrals) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Membership</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Join Date</th>
                            </tr>
                            </thead>
                            <tbody>


                                @php $id=0;@endphp
                                @foreach($referrals as $referral)
                                    @php $id++;@endphp
                                    <tr>
                                        <td class="text-center" width="10%" >
                                            <img src="{{$referral->user->profile->avatar}}" class="img-responsive img-circle" alt="No Photo"  >
                                        </td>
                                        <td class="text-center">{{$referral->user->name}}</td>
                                        <td class="text-center">{{$referral->user->membership->name}}</td>
                                        <td class="text-center">Active</td>
                                        <td class="text-center">{{$referral->user->created_at->diffForHumans()}}</td>
                                    </tr>

                                @endforeach


                            </tbody>
                        </table>

                            @else
                            <h1> There is no Refer You have made.</h1>

                        @endif              

                                </div>
                            </div>                

            </div>
        </div>
    </div>

@endsection