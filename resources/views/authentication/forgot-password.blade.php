@extends('layouts.auth')

@section('title', 'Reset password')

@push('styles')
    <style>
        .square-box {
            height: 800px;
        }
    </style>
@endpush

@section('content')
    <main class="form-forgot-password">
        @if(\Illuminate\Support\Facades\Session::has('status'))
            <h1 class="h3 mb-4 fw-normal">{{Session::get('status')}}</h1>
        @else
        <form method="POST" action="{{route('password.email')}}">
            @csrf
                <h1 class="h3 mb-4 fw-normal">Reset password</h1>
            @error('email')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="floatingEmail" placeholder="info@olibrary.com/infologin" name="email">
                <label for="floatingEmail">Email address</label>
            </div>
                <button class="w-100 btn btn-primary btn-lg mb-2" type="submit">Reset password</button>
            </div>
        </form>
        @endif
    </main>
@endsection
