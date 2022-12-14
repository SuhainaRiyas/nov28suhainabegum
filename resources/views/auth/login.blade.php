@extends('layouts.theme')

@section('title')
<title>Task  | Log in</title>
@endsection

@section('content')
<div class="login-box">
  <div class="login-logo">
    <h3>Student Register</h3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('login') }}" method="post">
          @csrf
        <div class="input-group mb-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
         @enderror
        </div>
        <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          
          @error('password')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
             </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     

      <p class="mb-1 mt-4">
      @if (Route::has('password.request'))
<!--         <a href="{{ route('password.request') }}">Forgot Password</a>
 -->      @endif
      </p>
      <p class="mb-0">
      @if (Route::has('register'))
        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
      @endif
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection
