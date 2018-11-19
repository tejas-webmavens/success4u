

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h2 class="title">Choose your desire Plan to invest</h2>
            <h5 class="description">Our all Payouts are fully Automatic , Here no withdrawal required, our system automatically sent the profit direct to your account through which you was Invested Here.</h5>
            <div class="section-space"></div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4 ">
            <div class="card card-pricing card-raised">
                <div class="card-content content-primary">
                    <h6 class="category">Basic</h6>
                    <h1 class="card-title"><small>$</small>10<small>.00</small></h1>
                    <ul>
                        <li><b>1-3%</b> Money Return</li>
                        <li>Deposit Included In Payment</li>
                        <li>Reinvestment Avilable</li>
                        <li>Profit Accural 7 Days Week</li>
                    </ul>

                    @if(Auth::guest())
                    <a href="{{route('register')}}" class="btn btn-white btn-round">
                        Get Started
                    </a>
                    @else
                        <a href="" class="btn btn-white btn-round">
                            Get Started
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-pricing card-raised">
                <div class="card-content content-info">
                    <h6 class="category text-info">Advanced</h6>
                    <h1 class="card-title"><small>$</small>50<small>.00</small></h1>
                    <ul>
                        <li><b>2-5%</b> Money Return</li>
                        <li>Deposit Included In Payment</li>
                        <li>Reinvestment Avilable</li>
                        <li>Profit Accural 7 Days Week</li>
                    </ul>
                    @if(Auth::guest())
                        <a href="{{route('register')}}" class="btn btn-white btn-round">
                            Get Started
                        </a>
                    @else
                        <a href="" class="btn btn-white btn-round">
                            Get Started
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-pricing card-raised">
                <div class="card-content content-success">
                    <h6 class="category text-info">Professional</h6>
                    <h1 class="card-title"><small>$</small>100<small>.00</small></h1>
                    <ul>
                        <li><b>3-7%</b> Money Return</li>
                        <li>Deposit Included In Payment</li>
                        <li>Reinvestment Avilable</li>
                        <li>Profit Accural 7 Days Week</li>
                    </ul>
                    @if(Auth::guest())
                        <a href="{{route('register')}}" class="btn btn-white btn-round">
                            Get Started
                        </a>
                    @else
                        <a href="" class="btn btn-white btn-round">
                            Get Started
                        </a>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>