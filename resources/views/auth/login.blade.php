@extends('layouts.authentication')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>My</b>BLOG</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                <span class="form-control-feedback">
                    <i class="fas fa-envelope"></i>
                </span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                <span class="form-control-feedback">
                    <i class="fas fa-lock"></i>
                </span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
  
      <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fab fa-facebook-f"></i> Sign in using
              Facebook
          </a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fab fa-google-plus-g"></i> Sign in using
              Google+
          </a>
      </div>
      <!-- /.social-auth-links -->
  
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
          </a>
          <br>
      @endif
      <a href="register.html" class="btn btn-link">Register a new membership</a>
  
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  
  @endsection