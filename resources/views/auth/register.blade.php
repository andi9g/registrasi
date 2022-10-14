@extends('layout.auth')

@section('title')
    Register
@endsection

@section('content')
<div class="register-logo">
    <a href=""><b>REGISTER</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg font-italic">please enter your new account</p>

      <form action="{{ route('store.register', []) }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('name')
              is-invalid
          @enderror" placeholder="Full name" name="name" value="{{ old('name') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
        </div>


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
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" required id="agreeTerms" name="setuju" value="agree" @if (old('setuju')=='agree')
                  checked
              @endif class="@error('setuju')
                  is-invalid
              @enderror">
              <label for="agreeTerms" class="my-0 py-0">
               I agree to the <a href="#">terms</a>
              </label>

              @error('setuju')
                  <div class="invalid-feedback">Please Confirm Agree</div>
              @enderror
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>
      <a href="{{ url('login', []) }}" class="text-center">I already have a account</a>
    </div>
  </div>
@endsection