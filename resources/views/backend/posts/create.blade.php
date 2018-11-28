@extends('layouts.backend')
@section('title')
    Create New Post
@endsection

@section('content')
    <section class="content-header">
        <h1>
        Add New Post
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('posts') }}">Posts</a></li>
            <li class="active">Add New Post</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" name="title" placeholder="Enter Title here" id="title" class="form-control">
                                @if ($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" rows="10" class="form-control"></textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">{{ $errors->first('body') }}</span>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Publish</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
                                <label for="published">Publish date</label>
                                <input type="text" name="published" class="form-control">
                                @if ($errors->has('published'))
                                    <span class="help-block">{{ $errors->first('published') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default">Save Draft</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-primary">Publish</a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Category</h3>
                        </div>
                        <div class="box-body">
                            @foreach($categories as $category)
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="category_id" id="{{ $category->id}}" value="{{ $category->id}}">
                                        {{ $category->title }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Feature Image</h3>
                        </div>
                        <div class="box-body text-center">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://placehold.it/200x200" width="100%" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                        <input type="file" name="image">
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script>
    var simplemde1 = new SimpleMDE({ element: $("#body")[0] });

</script>


@endsection