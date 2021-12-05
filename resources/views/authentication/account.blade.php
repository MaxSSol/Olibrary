@extends('layouts.light')

@section('title', 'Account')

@section('content')
    <x-header></x-header>
    <main>
        <section class="profile mt-5 d-flex align-items-center justify-content-between">
            <div class="profile-information mt-2">
                <p class="fw-bold"><img src="https://img.icons8.com/material-sharp/20/000000/user.png"/> {{$user->name}}</p>
                <div class="profile-email">
                    <p class="fw-normal"><img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/15/000000/external-email-interface-kiranshastry-lineal-kiranshastry.png"/> Email:
                        {{$user->email}}</p>
                </div>
                <p class="fw-normal"><img src="https://img.icons8.com/ios-filled/20/000000/clock--v2.png"/> Joined: {{$user->created_at}}</p>
            </div>
            <div class="profile-information-change">
                <button class="btn btn-primary">
                    <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/24/000000/external-setting-basic-ui-elements-flatart-icons-outline-flatarticons.png"/>
                    Change
                </button>
            </div>
        </section>
        <section class="profile-activity mt-5">
            <div class="profile-activity-reading">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Reading</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Favourites</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Downloaded</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Level</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">.333</div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">..3333.</div>
                </div>
            </div>
        </section>
    </main>
@endsection
