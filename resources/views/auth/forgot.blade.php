@extends('layout.auth')

@section('title')
    Forgot Password
@endsection


@section('content')
<div class="register-logo">
    <a href=""><b>Forgot Password</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg font-italic"></p>

      <form action="{{ route('forgot.password', []) }}" method="post">
        @csrf
        @method('PUT')
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

        <div class='form-group'>
          <select name='hint' id='forhint' onchange="pilih(this)" onload="pilih(this)" class="form-control @error('hint')
            is-invalid
          @enderror">
              <option value=''>Select hint</option>
              @foreach ($hint as $item)
                  <option value="{{$item->idhint}}" @if (old('hint')==$item->idhint)
                      selected
                  @endif>{{$item->namahint}}</option>
              @endforeach
          <select>

          @error('hint')
            <div class="invalid-feedback">{{$message}}</div>
          @enderror
      </div>

      <script>
        function pilih(data) {
           var hint = data.value;
           if(hint>0) {
            document.getElementById('foranswer').disabled=false;
           }else {
            document.getElementById('foranswer').disabled=true;
           }
          //  alert(hint);
        }
      </script>

      <div class='form-group'>
          <input type='text' name='answer' id='foranswer' @if (old('hint')>0)
          @else
            disabled
          @endif class="form-control @error('answer')
            is-invalid
          @enderror" placeholder='Answer your hint' value="{{old('answer')}}">
          @error('answer')
            <div class="invalid-feedback">{{$message}}</div>
          @enderror
      </div>

      <hr>

      <div class="input-group mb-3">
        <input type="password" class="form-control @error('password')
            is-invalid
        @enderror" placeholder="New password" name="password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        @error('password')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="input-group mb-3">
        <input type="password" class="form-control @error('password_confirm')
            is-invalid
        @enderror" placeholder="Retype password" name="password_confirm">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        @error('password_confirm')
            <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
        

        <div class="row">
          <div class="col-12 ">
            <button type="submit" class="btn btn-success btn-block"> Reset Password</button>
          </div>
          <div class="col-12 mt-2">
            <a href="{{ url('register', []) }}" class="text-center">Register a new account</a>
            <br>
            <a href="{{ url('login', []) }}" class="text-center">Login</a>
          </div>
          
        </div>
      </form>
      
    </div>
  </div>
@endsection