@extends('layout.auth')

@section('title')
    Login
@endsection

@section('content')
<div class="register-logo">
    <a href=""><b>LOGIN</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg font-italic">please enter your account</p>

      <form action="{{ route('proses.login', []) }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email')
              is-invalid
          @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

          @error('email')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password')
              is-invalid
          @enderror" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>

        

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"> Sign In</button>
          </div>
          <div class="col-12 mt-2">
            <a href="{{ url('register', []) }}" class="text-center">Register a new account</a>
            <br>
            <a href="{{ url('forgot', []) }}" class="text-center">I forgot my password</a>
          </div>
          
        </div>
      </form>
      
    </div>
  </div>
@endsection