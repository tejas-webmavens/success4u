@extends('layouts.dashboard')
@section('title', 'View All Available Ads')
@section('content')

<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">View Ads</h4>
                    </div>
                </div>

<div class="row m-t-20">

            @if(count($adverts) > 0)
                @foreach($adverts as $advert)
                    @if($advert->status == 0)
                            <div class="col-sm-4 col-xs-12">
                                <div class="card card-block text-xs-center">
                                    <h4 class="card-title">{{ $advert->ptc->title }}</h4>
                                    <p class="card-text"><b>{{ $advert->ptc->rewards }}</b> BTC</p>
                                    <a href="{{route('userCashLinks.show', $advert->id)}}" class="btn btn-primary">View Ad</a>
                                    <p class="card-text">{{ $advert->ptc->duration }} seconds</p>
                                </div>
                            </div>

                    @endif        
                @endforeach            

            @else
                        <h1 class="text-center">No Advertisement Right Now</h1>
            @endif

</div>

<center>
<div class="btn-group m-b-20">
    <a type="button" href="{{ $adverts->previousPageUrl() }}" class="btn btn-primary waves-effect waves-light">
            <span class="btn-label"><i class="fa fa-arrow-left"></i>
                </span>Last Page</a>

    <a type="button" href="{{ $adverts->nextPageUrl() }}" class="btn btn-success waves-effect waves-light">Next Page
            <span class="btn-label btn-label-right"><i class="fa fa-arrow-right"></i>
                </span>
    </a>            
</div>
</center>



@endsection