@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('styles')


@endsection


@section('content')

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="purple">
                    <i class="material-icons">face</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">Blog Section -
                        <small class="category">Edit Blog Post</small>
                    </h4>
                    <form action="{{route('admin.posts.update',['id'=>$post->id])}}" method="post" enctype="multipart/form-data">

                        {{csrf_field()}}

                        @if(count($errors) > 0)
                            <div class="alert alert-danger alert-with-icon" data-notify="container">
                                <i class="material-icons" data-notify="icon">notifications</i>
                                <span data-notify="message">

                                    @foreach($errors->all() as $error)
                                        <li><strong> {{$error}} </strong></li>
                                    @endforeach

                            </span>
                            </div>
                        @endif


                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label  class="control-label" for="title">Post Title</label>
                                    <input id="title" name="title" type="text" value="{{$post->title}}" class="form-control">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{$post->featured}}" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                      <input type="file" name="featured" />
                                                    </span>
                                        <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <select class="selectpicker" name="category_id" data-style="btn btn-warning btn-round" title="Select Category" data-size="7">

                                        @foreach($categories as $category)

                                            <option value="{{$category->id}}"

                                                    @if($post->category->id == $category->id)

                                                    selected

                                                    @endif

                                            > {{$category->name}} </option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <select class="selectpicker" name="category" data-style="btn btn-warning btn-round" multiple title="Select Category" data-size="7">

                                        @foreach($tags as $tag)

                                            <option value="{{$tag->id}}"

                                                    @foreach($post->tags as $t)

                                                    @if($tag->id == $t->id)

                                                    selected

                                                    @endif

                                                    @endforeach
                                            >
                                                {{$tag->tag}}
                                            </option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label  class="control-label" for="content">Post Content</label>
                                    <textarea class="form-control" name="body" id="content" rows="10">{{$post->content}}</textarea>
                                </div>
                            </div>
                        </div>

                        <a href="{{route('admin.posts.index')}}" class="btn btn-rose">Cancel Post</a>

                        <button type="submit" class="btn btn-success pull-right">Update Profile</button>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

@endsection