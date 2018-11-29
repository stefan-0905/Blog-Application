@extends('layouts.backend')
@section('title')
    MyBLOG | Edit Post
@endsection

@section('content')
    <section class="content-header">
        <h1>
        Edit Post
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('posts') }}">Posts</a></li>
            <li class="active">Edit Post</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- form start -->
            <form id="create-post-form" role="form" method="POST" action="{{ route('post.update', ['id'=> $post->id]) }}" enctype="multipart/form-data">
                
                @csrf
                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{ $post->title }}" placeholder="Enter Title here" id="title" class="form-control">
                                @if ($errors->has('title'))
                                    <span class="help-block">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" rows="10" class="form-control">{{ $post->body }}</textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">{{ $errors->first('body') }}</span>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->
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
                                <div class='input-group date' id='published'>
                                    <input id="published_at" value="{{ $post->published_at }}" type='text' name="published" class="form-control" />
                                    <span class="input-group-addon">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                @if ($errors->has('published'))
                                    <span class="help-block">{{ $errors->first('published') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="pull-left">
                                <a id="draft-btn" href="#" class="btn btn-default">Save Draft</a>
                            </div>
                            <div class="pull-right">
                                <button id="publish" class="btn btn-primary">Publish</button>
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
                                        <input type="radio" name="category_id" 
                                                id="{{ $category->id}}" 
                                                value="{{ $category->id}}"
                                                @if($post->category->id == $category->id) 
                                                    checked
                                                @endif>
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
                                    <img 
                                    @if($post->image!="") 
                                        src="{{$post->image_thumb}}"
                                    @else 
                                        data-src="holder.js/200x150" 
                                    @endif
                                    alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="image"
                                        @if($post->image!="") value="{{$post->image}}" @endif>
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

    // Settings for datetimepicker
    $('#published').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        showClear: true,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'glyphicon glyphicon-screenshot',
            clear: 'fas fa-trash',
            close: 'fas fa-times'
        }
    });

    // Saving post as draft
    $('#draft-btn').click(function(e) {
        e.preventDefault();
        $('#published_at').val("");
        $('#create-post-form').submit();
    });

    $('#publish').click(function(e) {
        e.preventDefault();
        $('#published_at').val('{{ now() }}');
        $('#create-post-form').submit();
    });

</script>


@endsection