@extends('layouts.main')

@section('content')
<div class="row w-100 m-0">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
      <form action="{{ Route('register') }}" method="post" class="card col-lg-4 mx-auto">
        @csrf
          <div class="card-body px-5 py-5">
            <h3 class="card-title text-left mb-3">Register</h3>
            @if(session()->has('registerError'))
                <div class="alert alert-danger" role="alert">
                    {{ session('registerError') }}
                </div>
            @endif
              <div class="form-group">
                <label>Username <span class="text-danger font-bold">*</span></label>
                <input type="text" name="username" class="form-control p_input @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label>Email <span class="text-danger font-bold">*</span></label>
                <input type="email" name="email" class="form-control p_input @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label>Password <span class="text-danger font-bold">*</span></label>
                <input type="password" name="password" class="form-control p_input @error('password') is-invalid @enderror">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
              </div>
              <p class="sign-up text-center">Already have an Account?<a href="{{ Route('showLogin') }}"> Sign Up</a></p>
              <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
          </div>
      </form>
    </div>
  </div>
@endsection