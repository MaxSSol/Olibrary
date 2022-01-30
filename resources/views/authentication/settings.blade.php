@extends('layouts.light')

@section('title', 'Settings')

@section('content')
    <x-header></x-header>
    <main>
        <div class="d-flex justify-content-center text-center">
            <form method="POST">
                @csrf
                <div class="form-floating mb-1">
                    <p class="fw-bold">Name: {{$user->name}}</p>
                </div>
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                @error('password')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" id="floatingName" placeholder="Name" name="name">
                    <label for="floatingName">New Name</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">New Password</label>
                </div>
                <button class="btn btn-warning">Change</button>
            </form>
        </div>
    </main>
@endsection
