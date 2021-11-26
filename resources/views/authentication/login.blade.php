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
            <input type="email" class="form-control" id="floatingEmail" placeholder="info@olibrary.com" name="email">
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
            <button class="w-100 btn btn-primary btn-lg mb-2" type="submit">Sign in</button>
            <a href="{{route('auth.registration')}}">Don`t have account? Sign up</a>
        </div>
    </form>
</main>
@endsection
