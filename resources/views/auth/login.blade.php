@extends('layouts.main')

@section('page-title','Home')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('page-content')
<div class="signin-content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <figure><img src="{{ asset('images/signin-image.jpg') }}" alt="sing up image"></figure>
            <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
        </div>

        <div class="col-md-6 col-10">
            <h2 class="form-title">LOGIN</h2>
            <form method="POST" class="register-form" id="login-form" action="{{route('login')}}">
                @csrf
                <div class="form-group">
                    <label for="email"><i class="ti-email"></i>E-Mail</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Your E-Mail">

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password"><i class="ti-lock"></i>Password</label>
                    <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Your Password">
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remember" id="agree-term" class="agree-term" />
                    <label for="agree-term" class="label-agree-term"><span><span></span></span>Remember Me</label>
                </div>

                <div class="form-group form-button">
                    <button  type="submit" name="signin" id="signin" class="btn btn-default btn-cons">Login</button>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                    <a class="btn btn-link link" href="{{ URL::to('auth/google') }}">
                        <i class="fab fa-google"></i> Login with Google Account
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 
