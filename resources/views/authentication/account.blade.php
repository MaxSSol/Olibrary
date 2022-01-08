@extends('layouts.light')

@section('title', 'Account')

@section('content')
    <x-header></x-header>
    <main>
        <section class="profile mt-5 d-flex align-items-center justify-content-between">
            <div class="profile-information mt-2">
                <p class="fw-bold"><img src="https://img.icons8.com/material-sharp/20/000000/user.png" alt="User"/> {{$user->name}}
                </p>
                <div class="profile-email">
                    <p class="fw-normal">
                        <img
                            src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/15/000000/external-email-interface-kiranshastry-lineal-kiranshastry.png"
                            alt="Email"/>
                        Email:
                        {{$user->email}}</p>
                </div>
                <p class="fw-normal">
                    <img src="https://img.icons8.com/ios-filled/20/000000/clock--v2.png" alt="Joined"/>
                    Joined: {{$user->created_at}}</p>
            </div>
            <div class="profile-information-change">
                <a class="btn btn-primary" href="{{route('account.settings')}}">
                    <img
                        src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/24/000000/external-setting-basic-ui-elements-flatart-icons-outline-flatarticons.png"
                        alt="Change"/>
                    Change
                </a>
            </div>
        </section>
        <section class="profile-activity mt-5">
            <div class="profile-activity-favourite">
                <p class="fw-bold">
                    <span>
                      <img src="https://img.icons8.com/ios-glyphs/20/000000/filled-like.png" alt="favourite"/>
                    </span>
                    Favourite
                </p>
                <div class="profile-favourite">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="table">
                        @foreach($user->favorites as $favorite)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$favorite->title}}</td>
                                @foreach($favorite->authors as $author)
                                    <td>{{$author->full_name}}</td>
                                @endforeach
                                <td>
                                    <a class="btn btn-primary" href="{{route('books.show', $favorite->id)}}">
                                        <img src="https://img.icons8.com/material-rounded/20/000000/visible.png"/>
                                    </a>
                                    <a class="btn btn-primary" href="{{route('books.remove.favorite', ['book' => $favorite->id])}}">
                                        <img src="https://img.icons8.com/material-rounded/20/000000/dislike.png"/>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection
