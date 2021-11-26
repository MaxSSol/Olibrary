@extends('layouts.light')

@section('title', 'Book:'.$book->title)

@section('content')
    <x-header/>
    <main>
        <section class="page-subheader d-flex align-items-center justify-content-between border-bottom">
            <div class="back-button">
                <button class="btn fw-bold">
                    <img src="https://img.icons8.com/material-outlined/20/000000/left.png"/>
                    Back
                </button>
            </div>
            <div class="share-buttons">
                <button class="btn fw-bold">
                    Print
                    <img src="https://img.icons8.com/ios-filled/20/000000/print.png"/>
                </button>
                <button class="btn fw-bold">
                    Share
                    <img src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/20/000000/external-share-interface-kiranshastry-lineal-kiranshastry.png"/>
                </button>
            </div>
        </section>
        <section class="book-detail d-flex justify-content-between">
            <div class="book-info mt-3">
                <p class="book-title h1">{{$book->title}}</p>
                <p class="book-description-title pt-2 fw-bold">Description:</p>
                <p class="book-description fs-5" style="text-align: justify">
                    {{$book->description}}
                </p>
            </div>
            <div class="book-info-download ms-4 mt-3 text-center">
                <img src="https://s3.amazonaws.com/loa-production-23ffs35gui41a/volumes/images/000/000/068/ecommerce/9780940450660.jpg?1446054155"/>
                <button type="button" class="mt-3 btn btn-lg bg-danger">Download</button>
            </div>
        </section>
    </main>
    <x-footer/>
@endsection

