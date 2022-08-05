@extends('layouts.auth')

@section('title', 'Verify email')

@push('styles')
    <style>
        .square-box {
            height: 800px;
        }
    </style>
@endpush

@section('content')
    <main class="form-verify-email">
        @if(\Illuminate\Support\Facades\Session::has('status'))
            <h1 class="h3 mb-4 fw-normal">{{\Illuminate\Support\Facades\Session::get('status')}}</h1>
            <a class="btn btn-success" href="{{route('account.account')}}">Go to account</a>
        @else
            <form method="POST" action="{{route('verification.send')}}">
                @csrf
                <h1 class="h3 mb-4 fw-normal">Please verify your email</h1>
                @error('formErrors')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-floating mb-2">
                    <p>Email: {{$user->email}}</p>
                </div>
                <div class="form-submit-button">
                    <button class="btn btn-primary">
                        Verify
                    </button>
                </div>
            </form>
        @endif
    </main>
@endsection
