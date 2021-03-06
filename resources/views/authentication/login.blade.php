@extends('layouts.auth')

@section('title', 'Sign in')

@push('styles')
    <style>
        .square-box {
            height: 800px;
        }
    </style>
@endpush

@section('content')
<main class="form-signin">
    <form method="POST" action="{{route('auth.login')}}">
        @csrf
        <h1 class="h3 mb-4 fw-normal">Please sign in</h1>
        @error('formErrors')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-floating mb-2">
            <input type="email" class="form-control" id="floatingEmail" placeholder="info@olibrary.com/infologin" name="email">
            <label for="floatingEmail">Email address</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="checkbox">
            <input class="form-check-input" type="checkbox" value="true" name="remember" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
            <button id="submit-sign" class="w-100 btn btn-primary btn-lg mb-2" type="submit">Sign in</button>
            <a href="{{route('auth.registration')}}">Don`t have account? Sign up</a>
            <br/>
            <a href="{{route('password.request')}}">Forgot password?</a>
        </div>
        <div class="form-google d-flex justify-content-end">
            <div class="form-google-title me-3">
                <p>Login with:</p>
            </div>
            <div class="google-button">
                <a href="{{route('auth.google')}}">
                    <img src="https://img.icons8.com/fluency/25/000000/google-logo.png"/>
                </a>
            </div>
        </div>
    </form>
</main>
@endsection
