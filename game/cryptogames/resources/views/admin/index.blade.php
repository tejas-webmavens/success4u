@extends('layouts.admin')

@section('title', 'Website Admin Dashboard Controller')

@section('content')

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="orange">
                            <i class="material-icons">monetization_on</i>
                        </div>
                        <div class="card-content">
                            <p class="category">USD</p>
                            <h4 class="card-title">{{$earn}}</h4>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons text-danger">account_circle</i>
                                <a href="#">Total Earn</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="green">
                            <i class="material-icons">done_all</i>
                        </div>
                        <div class="card-content">
                            <p class="category">USD</p>

                            <h4 class="card-title">{{$deposit}}</h4>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">eject</i> Total Deposit
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header" data-background-color="blue">
                            <i class="material-icons">https</i>
                        </div>
                        <div class="card-content">
                            <p class="category">USD</p>
                            <h4 class="card-title">{{$pending}}</h4>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="material-icons">hourglass_empty</i> Total Pending Withdraw
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

@endsection
