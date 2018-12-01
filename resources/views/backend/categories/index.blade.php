@extends('layouts.backend')
@section('title')
    MyBLOG | All Categories
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categories
            <small>All Categories</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="active">All Categories</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a id="add-button" title="Add New" class="btn btn-success" href="{{ route('categories.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            @include('backend.includes.session_message')
                            @if(!$categories->count())
                                <div class="alert alert-danger">
                                    <strong>No record fount.</strong>
                                </div>
                            @else
                                @include('backend.categories.table')
                            @endif
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer clearfix">
                            {{ $categories->appends(Request::query())->links() }}
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                </div>
            <!-- ./row -->
            </section>
    @endsection