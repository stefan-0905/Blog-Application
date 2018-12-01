@extends('layouts.backend')
@section('title')
    MyBLOG | Edit Category
@endsection

@section('content')
    <section class="content-header">
        <h1>
        Edit Category
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="active">Edit Category</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('categories.update', ['category'=> $category->slug]) }}">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{ $category->title }}" placeholder="Enter Title here" id="title" class="form-control">
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

    // Setting current datetime for published_at property and Publishing post
    $('#publish').click(function(e) {
        e.preventDefault();
        if($('#published_at').val() == '')
            $('#published_at').val('{{ now() }}');
        $('#create-post-form').submit();
    });

</script>


@endsection