@extends('layouts.dashboard')
@section('title', 'My Withdraw History')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Withdraw History</h4>
                    </div>
                </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">

                    <div class="row m-t-50">

                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-1 m-t-20"></div>

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-10 m-t-20">
                                    <h4 class="header-title m-t-0">Withdraw History</h4>

                    <div class="p-20">
                        @if(count($withdraws) > 0)
                    <div class="table-responsive">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Gateway Name</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Charge</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $id=0;@endphp
                                @foreach($withdraws as $withdraw)
                                    @php $id++;@endphp
                            <tr>
                                <td class="text-center">{{$withdraw->gateway_name}}</td>
                                <td class="text-center">{{$withdraw->account}}</td>
                                <td class="text-center">{{$withdraw->charge}} BTC</td>
                                <td class="text-center">{{$withdraw->net_amount}} BTC</td>
                                @if($withdraw->status == 1)
                                    <td class="text-center">{{$withdraw->updated_at->diffForHumans()}}</td>
                                @else
                                    <td class="text-center">{{$withdraw->created_at->diffForHumans()}}</td>
                                @endif
                                <td >

                                    @if($withdraw->status == 1)

                                        <span class="label label-success"> Completed </span>

                                    @else

                                        <span class="label label-warning"> Pending </span>

                                    @endif



                                </td>
                            </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else

                        <h1 class="text-center">No Withdraw Request</h1>
                    @endif              

                                </div>
                            {{$withdraws->render()}}
                            </div>                

            </div>
        </div>
    </div>


    @if(config('app.chat'))

        @include('includes.chat')

    @else

    @endif

@endsection