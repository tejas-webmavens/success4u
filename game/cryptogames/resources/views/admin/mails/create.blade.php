@extends('layouts.admin')

@section('title', 'Send Email To User or Outsider')

@section('content')


    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="green">
                    <i class="material-icons">email</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Send Email Section -
                        <small class="category">Send Email to Your Website User and Receive Email From Outsider</small>
                    </h4>

                    <div class="alert alert-info">
                        <p class="text-center">
                            This message box supported HTML Tag & Markdown Content. For more details click : <br>
                            <a href="https://summernote.org/" target="_blank">HTML Editor</a>  <br>
                            <a href="https://dillinger.io/" target="_blank">Markdown Editor</a>  <br>
                        </p>
                    </div>

                    <form action="{{route('adminEmail.send')}}" role="form" id="contact-form"  method="POST">
                        {{csrf_field()}}
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
                            <div class="row">
                                <div class="form-group label-floating">
                                    <select class="selectpicker" name="status" data-style="btn btn-success btn-round" title="Select Email Receiver Status" data-size="7">
                                        <option value="1">Our User</option>
                                        <option value="2">Outsider</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group label-floating">
                                <label for="email" class="control-label">Send To</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <br>

                            <div class="form-group label-floating">
                                <label for="subject" class="control-label">Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control">
                            </div>
                            <br>
                            <div class="form-group label-floating">
                                <label for="message" class="control-label">Your message</label>
                                <textarea name="body" class="form-control" id="message" rows="10"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-primary pull-right">Send Message</button>
                                </div>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>

    </div>

@endsection