@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <h2 class="title">Pick the best plan for you</h2>
                        <h5 class="description">You have Free Unlimited Updates and Premium Support on each package.</h5>
                    </div>
                </div>


                <div class="card-content">
                    <br>
                    <div class="col-md-3">
                        <div class="card card-pricing card-plain">
                            <div class="card-content">
                                <h6 class="category">Freelancer</h6>
                                <div class="icon  icon-warning">
                                    <i class="material-icons">weekend</i>
                                </div>
                                <h3 class="card-title">FREE</h3>
                                <p class="card-description">
                                    Welcome To Free Plan. We have to say sorry for you becuse there is no earning in this free membership.
                                </p>
                                <a href="" class="btn btn-warning btn-round">Free</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-pricing card-raised">
                            <div class="card-content">
                                <h6 class="category">Silver</h6>
                                <div class="icon icon-info">
                                    <i class="material-icons">highlight</i>
                                </div>
                                <h3 class="card-title">$25</h3>
                                <p class="card-description">
                                    This is good for starting. Membership duration is 365 days, Per Click $ 0.005, Per Referral Click Value $ 0.002 with unlimited referrals.
                                </p>
                                <a href="" class="btn btn-info btn-round">Upgrade Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-pricing card-raised">
                            <div class="card-content">
                                <h6 class="category">Gold</h6>
                                <div class="icon icon-primary">
                                    <i class="material-icons">weekend</i>
                                </div>
                                <h3 class="card-title">$80</h3>
                                <p class="card-description">
                                    This is good for regular income. Membership duration is 365 days, Per Click $ 0.007, Per Referral Click Value $ 0.003 with unlimited referrals.
                                </p>
                                <a href="" class="btn btn-primary btn-round">Upgrade Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-pricing card-raised">
                            <div class="card-content">
                                <h6 class="category">Dimond</h6>
                                <div class="icon icon-success">
                                    <i class="material-icons">business</i>
                                </div>
                                <h3 class="card-title">$200</h3>
                                <p class="card-description">
                                    This is good for settlement income. Membership duration is 365 days, Per Click $ 0.010, Per Referral Click Value $ 0.004 with unlimited referrals.
                                </p>
                                <a href="" class="btn btn-success btn-round">Upgrade Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection