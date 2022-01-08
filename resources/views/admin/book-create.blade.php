@extends('layouts.light')

@section('title', 'Create a book')

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
        <form action="{{route('admin.book.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <section class="update-book">
                <div class="update-book-info text-center mb-5">
                    <h1>Create a book</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="update-book-title input-group mb-3 me-3">
                            <span class="input-group-text" id="book-title">Title</span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Title"
                                aria-label="Title"
                                aria-describedby="book-title"
                                name="title"
                                value="{{old('title')}}"/>
                        </div>
                        <div class="my-3">
                            <label for="formFile" class="form-label">File</label>
                            <input class="form-control" type="file" id="formFile" name="bookFile">
                        </div>
                        <div class="update-book-author">
                            <span class="input-group-text" id="book-author">Author</span>
                            <select
                                class="form-control select-author"
                                name="authors[]"
                                multiple="multiple"
                                aria-describedby="book-author">
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}">{{$author->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating update-book-description">
                            <span class="input-group-text" id="book-description">Description</span>
                            <textarea
                                class="form-control"
                                placeholder="Description"
                                id="book-description"
                                name="description"
                                aria-label="Title"
                                aria-describedby="book-description"
                                style="height: 100px">
                                {{old('description')}}
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
            $('.select-author').select2();
        });
    </script>
@endsection
