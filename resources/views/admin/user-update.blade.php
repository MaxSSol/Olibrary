@extends('layouts.light')

@section('title', 'Update:' . $user->name)

@section('content')
    <x-header/>
    <main>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.user.update', $user)}}" method="POST">
            @csrf
            <section class="update-user">
                <div class="update-user-info text-center mb-5">
                    <h1>Update user: {{$user->name}}</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="update-user-name  input-group mb-3 me-3">
                            <span class="input-group-text" id="user-name">Name</span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Name"
                                aria-label="Name"
                                aria-describedby="user-name"
                                value="{{$user->name}}"
                                name="name"/>
                        </div>
                        <div class="update-user-email input-group mb-3 me-3">
                            <span class="input-group-text" id="user-email">Email</span>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Email"
                                aria-label="Email"
                                aria-describedby="user-email"
                                value="{{$user->email}}"
                                name="email"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="update-user-password input-group mb-3 me-3">
                            <span class="input-group-text" id="user-password">Password</span>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Password"
                                aria-label="Password"
                                aria-describedby="user-password"
                                name="password"/>
                        </div>
                        <div class="update-user-role input-group mb-3 me-3">
                            <span class="input-group-text" id="user-role">Role</span>
                            <select class="form-select" name="role">
                                @foreach($user->roles as $role)
                                    <option selected value="{{$role->id}}">{{$role->title}}</option>
                                @endforeach
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </section>
        </form>
    </main>
@endsection
