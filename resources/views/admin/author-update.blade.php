@extends('layouts.light')

@section('title', 'Update the author' . $author->full_name)

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <x-header/>
    <main>
        <div class="back-button">
            <a class="btn fw-bold" href="{{\Illuminate\Support\Facades\URL::previous()}}">
                <img src="https://img.icons8.com/material-outlined/20/000000/left.png"/>
                Back
            </a>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.author.update', $author)}}" method="POST">
            @csrf
            <section class="update-author">
                <div class="update-author-info text-center mb-5">
                    <h1>Update the author: {{$author->full_name}}</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="update-author-first-name input-group mb-3 me-3">
                            <span class="input-group-text" id="book-title">First name</span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="First name"
                                aria-label="First name"
                                aria-describedby="author-first-name"
                                value="{{$author->first_name}}"
                                name="first_name"/>
                        </div>
                        <div class="update-author-last-name input-group mb-3 me-3">
                            <span class="input-group-text" id="last-name">Last name</span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Last name"
                                aria-label="Last name"
                                aria-describedby="author-last-name"
                                value="{{$author->last_name}}"
                                name="last_name"/>
                        </div>
                        <div class="update-author-book">
                            <span class="input-group-text" id="book-author">Books</span>
                            <select
                                class="form-control select-book"
                                name="books[]"
                                multiple="multiple"
                                aria-describedby="author-book">
                                @foreach($author->books as $book)
                                    <option selected value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                                @foreach($books as $book)
                                    <option value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating update-book-description">
                            <span class="input-group-text" id="author-biography">Biography</span>
                            <textarea
                                class="form-control"
                                placeholder="Biography"
                                id="author-biography"
                                name="biography"
                                aria-label="Biography"
                                aria-describedby="biography"
                                style="height: 100px">
                            {{$author->biography}}
                        </textarea>
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

@section('body-scripts')
    <script>
        $(document).ready(function() {
            $('.select-book').select2();
        });
    </script>
@endsection
