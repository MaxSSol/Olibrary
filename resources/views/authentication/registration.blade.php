@extends('layouts.auth')

@section('title', 'Sign up')

@push('styles')
    <style>
        .square-box {
            height: 800px;
        }
    </style>
@endpush

@section('content')
<main class="form-signin">
    <form action="{{route('auth.registration')}}" method="POST">
        @csrf
        <h1 class="h3 mb-4 fw-normal">Please sign up</h1>
        <div class="form-floating mb-2">
            <input type="email" class="form-control" id="floatingEmail" placeholder="info@olibrary.com" name="email" value="{{ old('email') }}">
            <label for="floatingEmail">Email address</label>
            @error('email')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control" id="floatingLogin" placeholder="Login" name="name" value="{{ old('name') }}">
            <label for="floatingLogin">Login</label>
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="form-floating mb-2">
            @error('password')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="checkbox">
            <button class="w-100 btn btn-primary btn-lg mb-2" type="submit">Sign in</button>
            <a href="{{route('auth.login')}}">Have account? Sign in</a>
        </div>
    </form>
</main>
@endsection
