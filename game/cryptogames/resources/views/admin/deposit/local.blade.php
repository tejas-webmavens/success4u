@extends('layouts.admin')

@section('title', 'All User Deposit Request')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">contacts</i>
                </div>
                <br>
                <h4 class="card-title">Deposit Request</h4>
                <div class="card-content">
                    <br>
                    <br>
                    @if(count($deposits) > 0)
                        <div class="table-responsive">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">SN</th>
                                    <th class="text-center">Transaction Id</th>
                                    <th class="text-center">Gateway</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Set As</th>
                                    <th class="text-center">Set As</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $id=0;@endphp
                                @foreach($deposits as $deposit)
                                    @php $id++;@endphp
                                    <tr>
                                        <td class="text-center">{{ $id }}</td>
                                        <td class="text-center">{{$deposit->transaction_id}}</td>
                                        <td class="text-center">{{$deposit->gateway_name}}</td>
                                        <td class="text-center">$ {{$deposit->amount}}</td>
                                        <td class="text-center">{{$deposit->details}}</td>
                                        <td class="text-center">{{$deposit->created_at->diffForHumans()}}</td>
                                        <td class="text-center td-actions">

                                            @if($deposit->status == 0)

                                                <a href="{{route('admin.deposit.update', $deposit->id)}}" type="button" class="btn btn-success">
                                                    <i class="material-icons">edit</i> Complete
                                                </a>
                                            @endif

                                        </td>

                                        <td class="text-center td-actions">

                                            @if($deposit->status == 0)
                                                <a href="{{route('admin.deposit.fraud', $deposit->id)}}" type="button" class="btn btn-warning">
                                                    <i class="material-icons">edit</i> Fraud
                                                </a>
                                            @endif

                                        </td>

                                        <td class="text-center td-actions">

                                            @if($deposit->status == 1)
                                                <button class="btn btn-success btn-sm">
                                        <span class="btn-label">
                                            <i class="material-icons">check</i>
                                        </span>Completed
                                                </button>

                                            @else

                                                <button class="btn btn-primary btn-sm">
                                        <span class="btn-label">
                                            <i class="material-icons">warning</i>
                                        </span>
                                                    Pending
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    @else

                        <h1 class="text-center">No Deposit Request</h1>
                    @endif

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-5">

                            {{$deposits->render()}}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection