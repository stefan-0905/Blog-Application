@extends('layouts.backend')
@section('title')
    MyBLOG | Delete Confirmation
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Delete Confirmation
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li class="active">Delete Confirmation</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body">
                            @include('backend.includes.session_message')
                            <p>You have specified this user for deletion:</p>
                            <p>ID #{{ $user->id }}: {{ $user->name }}</p>
                            <p>What should be done with content owned by this user?</p>
                            <p>
                                <input type="radio" name="delete_option" value="delete" checked> Delete All Content
                            </p>
                            <p>
                                <input type="radio" name="delete_option" value="attribute"> Attribute Content To
                                <select name="selected_user">
                                    @foreach($users as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </p>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                            <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
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