@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
<div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Support</h4>
                    </div>
                </div>
<div class="row">
    <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <div class="card-box">

                                @auth

                                    <form action="{{route('userSupport.post')}}" role="form" id="contact-form"  method="POST">

                                        {{csrf_field()}}

                                        <div class="header header-raised header-primary text-center">
                                            <h4 class="header-title m-t-0">Support</h4>

                                        </div>
                                        <div class="card-content">
                                            @if(count($errors) > 0)
                                                <div class="alert alert-danger alert-with-icon" data-notify="container">
                                                    <i class="material-icons" data-notify="icon">notifications</i>
                                                    <span data-notify="message">
                                                        @foreach($errors->all() as $error)
                                                            <li><strong> {{$error}} </strong></li>
                                                        @endforeach
                                                    </span>
                                                </div>
                                                <br>
                                            @endif

                                            <br>
                                            <div class="form-group label-floating">
                                                <label for="subject" class="control-label">Subject</label>
                                                <input type="text" id="subject" name="subject" class="form-control">
                                            </div>
                                            <br>

                                            <br>
                                            <div class="form-group label-floating">
                                                <label for="message" class="control-label">Your message</label>
                                                <textarea name="body" class="form-control" id="message" rows="20"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary pull-right">Send Message</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>


                                @endauth

                                @guest
                                        <form action="{{route('GuestEmail')}}" role="form" id="contact-form"  method="POST">

                                            {{csrf_field()}}

                                            <div class="header header-raised header-primary text-center">
                                                <h4 class="header-title m-t-0">Support</h4>

                                            </div>
                                            <div class="card-content">

                                                @if (session()->has('message'))
                                                    <div class="alert alert-{!! session()->get('type')  !!}">
                                                        <span class="text-center">{!! session()->get('title')  !!}</span>
                                                        <br>
                                                        <span>{!! session()->get('message')  !!}</span>
                                                    </div>
                                                @endif



                                                @if(count($errors) > 0)
                                                    <div class="alert alert-danger alert-with-icon" data-notify="container">
                                                        <i class="material-icons" data-notify="icon">notifications</i>
                                                        <span data-notify="message">
                                                        @foreach($errors->all() as $error)
                                                                <li><strong> {{$error}} </strong></li>
                                                            @endforeach
                                                    </span>
                                                    </div>
                                                    <br>
                                                @endif
                                                <br>
                                                    <div class="form-group label-floating">
                                                        <label for="subject" class="control-label">Subject</label>
                                                        <input type="text" id="subject" name="subject" class="form-control">
                                                    </div>
                                                <br>
                                                    <div class="form-group label-floating">
                                                        <label for="name" class="control-label">Your Full Name</label>
                                                        <input type="text" id="name" name="name" class="form-control">
                                                    </div>
                                                <br>
                                                    <br>
                                                    <div class="form-group label-floating">
                                                        <label for="email" class="control-label">Your Email Address</label>
                                                        <input type="email" id="email" name="email" class="form-control">
                                                    </div>
                                                    <br>
                                                <div class="form-group label-floating">
                                                    <label for="message" class="control-label">Your message</label>
                                                    <textarea name="body" class="form-control" id="message" rows="20"></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary pull-right">Send Message</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                @endguest


                            </div>
                        </div>
                        </div>

@endsection