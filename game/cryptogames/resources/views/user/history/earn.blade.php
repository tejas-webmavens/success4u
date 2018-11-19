@extends('layouts.dashboard')
@section('title', 'My Earning History')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Earning History</h4>
                    </div>
                </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card-box">

                    <div class="row m-t-50">

                        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-1 m-t-20"></div>

                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-10 m-t-20">
                                    <h4 class="header-title m-t-0">Earning History</h4>

                    <div class="p-20">
                        @if(count($earns) > 0)
                        <div class="table-responsive">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Source</th>
                                    <th class="text-center">From</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Add Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $id=0;@endphp
                                @foreach($earns as $log)
                                    @php $id++;@endphp
                                    <tr>
                                        <td class="text-center">{{$log->for}}</td>
                                        <td class="text-center">{{$log->from}}</td>
                                        <td class="text-center">{{$log->amount}} BTC</td>
                                        <td class="text-center">{{$log->details}}</td>
                                        <td class="text-center">{{$log->created_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    @else

                        <h1 class="text-center">No Earning History</h1>
                    @endif              

                                </div>
                            {{$earns->render()}}
                            </div>                

            </div>
        </div>
    </div>

@endsection