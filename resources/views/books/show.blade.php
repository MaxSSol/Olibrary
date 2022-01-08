@extends('layouts.light')

@section('title', 'Book:'.$book->title)

@section('content')
    <x-header/>
    <main>
        <section class="page-subheader d-flex align-items-center justify-content-between border-bottom">
            <div class="back-button">
                <a class="btn fw-bold" href="{{\Illuminate\Support\Facades\URL::previous()}}">
                    <img src="https://img.icons8.com/material-outlined/20/000000/left.png"/>
                    Back
                </a>
            </div>
            <div class="share-buttons">
                <button class="btn fw-bold btn-favorite" style="{{$favorite ? '' : 'display:none'}}" data-book="{{$book->id}}">
                    Favorite
                    <img class="favorite-icon" src="https://img.icons8.com/external-prettycons-solid-prettycons/20/000000/external-favorite-essentials-prettycons-solid-prettycons.png"/>
                </button>
                <button class="btn fw-bold btn-add-to-favorite" data-book="{{$book->id}}" style="{{$favorite ? 'display:none' : ''}}">
                    Favorite
                    <img class="favorite-icon" src="https://img.icons8.com/external-prettycons-lineal-prettycons/20/000000/external-favorite-essentials-prettycons-lineal-prettycons.png"/>
                </button>
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
        <section class="book-detail">
            <div class="row">
                <div class="col">
                    <div class="book-info mt-3">
                        <p class="book-title h1">{{$book->title}}</p>
                        <p class="book-description-title pt-2 fw-bold">Description:</p>
                        <p class="book-description fs-5" style="text-align: justify">
                            {{$book->description}}
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="book-info-download ms-4 mt-3 d-flex justify-content-center">
                        <img class="h-25" src="https://s3.amazonaws.com/loa-production-23ffs35gui41a/volumes/images/000/000/068/ecommerce/9780940450660.jpg?1446054155"/>
                    </div>
                    <div class="btn-download d-flex justify-content-center">
                        <a type="button" class="mt-3 btn btn-lg bg-success" href="{{route('books.download', $book)}}">
                            <span class="fw-light">Download</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-footer/>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('body-scripts')
    <script>
        $(document).ready(function () {
            $('.btn-add-to-favorite').click(function () {
                let book = $(this).data('book');
                $.ajax({
                    url: "{{route('books.favorite')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        book: book,
                    },
                    success: (data) => {
                        console.log(2)
                        $('.btn-add-to-favorite').hide()
                        $('.btn-favorite').show()
                        $('.favorite-icon').attr('src','https://img.icons8.com/external-prettycons-solid-prettycons/20/000000/external-favorite-essentials-prettycons-solid-prettycons.png')
                    },
                })
            })
            $('.btn-favorite').click(function () {
                let book = $(this).data('book');
                $.ajax({
                    url: "{{route('books.remove.favorite')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        book: book,
                    },
                    success: (data) => {
                        $('.btn-add-to-favorite').show()
                        $('.btn-favorite').hide()
                        $('.favorite-icon').attr('src','https://img.icons8.com/external-prettycons-lineal-prettycons/20/000000/external-favorite-essentials-prettycons-lineal-prettycons.png')
                    },
                })
            })
        })
    </script>
@endsection
