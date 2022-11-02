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
          <div class="col-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary mt-2 btn-sm btn-block" data-toggle="modal" data-target="#cararegistrasi">
              Cara Registrasi
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="cararegistrasi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Cara Registrasi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <ul>
                      <li>Membuat akun login terlebih dahulu "<a href="{{ url('register', []) }}">Register a new account</a>"</li>
                      <li>Melakukan "<a href="{{ url('login', []) }}">Login</a>"</li>
                      <li>Melengkapi identitas peserta</li>
                      <li>Memilih menu <b>pendaftaran</b> untuk mendaftar kelas pertandingan</li>
                    </ul>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
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