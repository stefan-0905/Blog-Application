@extends('layouts.backend')
@section('title')
    MyBLOG | All Posts
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
                            <div class="pull-right form-inline">
                                <div>
                                    <form style="width:100%;" accept-charset="utf-8" method="post" class="pull-right" id="form-filter" action="#">
                                        <div class="input-group pull-right">
                                            <input type="hidden" name="search">
                                            <input type="text" name="keywords" class="form-control input-sm" style="width: 150px;" placeholder="Search..." value="">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default search-btn" type="button"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php $links = []; ?>
                                @foreach($statusList as $key => $value)
                                    @if($value)
                                        <?php $selected = Request::get('status') == $key ? 'selected-status' : ''; ?>
                                        <?php $links[] = "<a class='{$selected}' href=\"?status={$key}\">". ucwords($key) . " ({$value})</a>" ?>
                                    @endif
                                @endforeach 
                                {!! implode(' | ', $links) !!}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            @include('backend.includes.session_message')
                            @if(!$posts->count())
                                <div class="alert alert-danger">
                                    <strong>No record fount.</strong>
                                </div>
                            @else
                                @if($onlyTrashed)
                                    @include('backend.posts.table-trash')
                                @else
                                    @include('backend.posts.table')
                                @endif
                            @endif
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            {{ $posts->appends(Request::query())->links() }}
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                </div>
            <!-- ./row -->
            </section>
    @endsection