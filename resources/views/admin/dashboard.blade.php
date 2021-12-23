@extends('layouts.light')

@section('title', 'Admin')

@section('content')
    <x-header></x-header>
    <section class="admin mt-5">
        <div class="admin-panel">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link" id="nav-users-tab" data-bs-toggle="tab" data-bs-target="#nav-users" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Users</button>
                    <button class="nav-link" id="nav-books-tab" data-bs-toggle="tab" data-bs-target="#nav-books" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Books</button>
                    <button class="nav-link" id="nav-authors-tab" data-bs-toggle="tab" data-bs-target="#nav-authors" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Authors</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @can('view', \App\Models\User::class)
                <div class="tab-pane fade show active" id="nav-users" role="tabpanel" aria-labelledby="nav-users-tab">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->updated_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary modal-t" data-bs-toggle="modal" data-bs-target="#u{{$user->id}}">
                                        <img src="https://img.icons8.com/fluency-systems-filled/20/000000/life-cycle-female.png"/>
                                    </button>
                                    <x-admin-user-modal user="{{$user->id}}"/>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#a{{$user->id}}">
                                        <img src="https://img.icons8.com/ios-glyphs/20/000000/activity.png"/>
                                    </button>
                                    <x-admin-user-activity-modal user="{{$user->id}}"></x-admin-user-activity-modal>
                                    @if ($user->banned == 0)
                                        <a class="btn btn-success" href="{{route('admin.user.ban', ['id' => $user->id])}}">
                                            <img src="https://img.icons8.com/windows/20/000000/remove-user-male--v1.png"/>
                                        </a>
                                    @else
                                        <a class="btn btn-danger" href="{{route('admin.user.unban', ['id' => $user->id])}}">
                                            <img src="https://img.icons8.com/windows/20/000000/remove-user-male--v1.png"/>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endcan
                <div class="tab-pane fade" id="nav-books" role="tabpanel" aria-labelledby="nav-books-tab">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Authors</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$book->title}}</td>
                                @foreach($book->authors as $author)
                                    <td>{{$author->first_name . ' ' . $author->last_name}}</td>
                                @endforeach
                                <td class="text-start">{{$book->description}}</td>
                                <td class="d-flex">
                                    <button class="btn btn-primary me-2">
                                        <img src="https://img.icons8.com/ios-filled/20/000000/update-left-rotation.png"/>
                                    </button>
                                    <button class="btn btn-danger">
                                        <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-authors" role="tabpanel" aria-labelledby="nav-authors-tab">
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Count books</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$author->first_name}}</td>
                                <td>{{$author->last_name}}</td>
                                <td>{{$author->books()->count()}}</td>
                                <td>
                                    <button class="btn btn-primary">
                                        <img src="https://img.icons8.com/ios-filled/20/000000/update-left-rotation.png"/>
                                    </button>
                                    <button class="btn btn-danger">
                                        <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.save-changes').click(function () {
                let target = $(this).data('save-button');
                let id = $('.user-id[data-id="'+ target + '"]').data('id')
                let name = $('.name[data-name="'+ target + '"]').val() === '' ? $('.name[data-name="'+ target + '"]').attr('placeholder') : $('.name[data-name="'+ target + '"]').val();
                let email = $('.email[data-email="'+ target + '"]').val() === '' ? $('.email[data-email="'+ target + '"]').attr('placeholder') : $('.email[data-email="'+ target + '"]').val();
                let role = $('.form-select[data-select="'+ target + '"]').val();
                $.ajax({
                    url: "{{route('admin.user.update')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        id: id,
                        name: name,
                        email: email,
                        role: role,
                    },
                    success: (data) => {
                        location.reload()
                    },
                })
            })
        })
    </script>
@endsection
