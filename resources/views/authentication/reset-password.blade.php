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
        <form method="POST" action="{{route('password.update', ['token' => $token])}}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="h3 mb-4 fw-normal">Reset password</h1>
            <input type="hidden" value="{{request('email')}}" name="email">
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPasswordConfirm" placeholder="Password" name="password_confirmation">
                <label for="floatingPasswordConfirm">Confirm password</label>
            </div>
            <button class="w-100 btn btn-primary btn-lg mb-2" type="submit">Reset password</button>
        </form>
    </main>
@endsection
