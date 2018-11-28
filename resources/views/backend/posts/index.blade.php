@extends('layouts.backend')
@section('title')
    All Posts
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Posts
            <small>All Blog Posts</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('posts') }}">Posts</a></li>
            <li class="active">All Posts</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a id="add-button" title="Add New" class="btn btn-success" href="{{ route('post.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                            </div>
                            <div class="pull-right">
                                <form accept-charset="utf-8" method="post" class="form-inline" id="form-filter" action="#">
                                    <div class="input-group">
                                        <input type="hidden" name="search">
                                        <input type="text" name="keywords" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search..." value="">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-default search-btn" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(!$posts->count())
                                <div class="alert alert-danger">
                                    <strong>No record fount.</strong>
                                </div>
                            @else
                                <table class="table table-bordered table-condesed">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Title</th>
                                        <th width="150px">Author</th>
                                        <th width="150px">Category</th>
                                        <th width="170px">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td width="70">
                                                <a title="Edit" class="btn btn-xs btn-default edit-row" href="#">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a title="Delete" class="btn btn-xs btn-danger delete-row" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->author->name }}</td>
                                            <td>{{ $post->category->title }}</td>
                                            <td>
                                                <abbr title="{{ $post->created_at }}">
                                                    {{ $post->created_at->toFormattedDateString() }}
                                                </abbr> | {!! $post->publicationLabel() !!}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            {{ $posts->links() }}
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                </div>
            <!-- ./row -->
            </section>
    @endsection