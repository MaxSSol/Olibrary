@extends('layouts.light')

@section('title', 'Update book:' . $book->title)

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

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
        <form action="{{route('admin.book.update', $book)}}" enctype="multipart/form-data" method="POST">
            @csrf
        <section class="update-book">
            <div class="update-book-info text-center mb-5">
                <h1>Update book: {{$book->title}}</h1>
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
                            value="{{$book->title}}"
                            name="title"/>
                    </div>
                    <div class="my-3">
                        <p class="fw-bold">File: {{$book->file_name}}</p>
                        <label for="formFile" class="form-label">Update file</label>
                        <input class="form-control" type="file" id="formFile" name="bookFile">
                    </div>
                    <div class="update-book-author">
                        <span class="input-group-text" id="book-author">Author</span>
                        <select
                            class="form-control select-author"
                            name="authors[]"
                            multiple="multiple"
                            aria-describedby="book-author">
                            @foreach($book->authors as $author)
                                <option selected value="{{$author->id}}">{{$author->full_name}}</option>
                            @endforeach
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
                            {{$book->description}}
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
