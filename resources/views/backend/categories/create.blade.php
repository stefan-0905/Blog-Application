@extends('layouts.backend')
@section('title')
    MyBLOG | Create New Category
@endsection

@section('content')
    <section class="content-header">
        <h1>
        Add new Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('posts') }}">Categories</a></li>
            <li class="active">Add New Category</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('categories.store') }}">
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
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save Category</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                        {{-- /.box-footer --}}
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

</script>


@endsection