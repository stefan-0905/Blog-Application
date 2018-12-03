@extends('layouts.backend')
@section('title')
    MyBLOG | Create New User
@endsection

@section('content')
    <section class="content-header">
        <h1>
        Add new User
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li class="active">Add New User</li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="col-xs-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter name here" id="name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" name="email" placeholder="Enter Email here" id="email" class="form-control">
                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                                <label for="bio">Bio</label>
                                <textarea name="bio" id="bio" rows="3" class="form-control" placeholder="Enter Small Bio here"></textarea>
                                @if ($errors->has('bio'))
                                    <span class="help-block">{{ $errors->first('bio') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">Choose a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">New Password</label>
                                <input type="password" name="password" placeholder="Enter password here" id="password" class="form-control">
                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation">New Password</label>
                                <input type="password" name="password_confirmation" placeholder="Confirm password here" id="password_confirmation" class="form-control">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create User</button>
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