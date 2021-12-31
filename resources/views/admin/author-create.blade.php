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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('admin.author.store')}}" method="POST">
            @csrf
            <section class="create-author">
                <div class="create-author-info text-center mb-5">
                    <h1>Create an Author</h1>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="create-author-first-name  input-group mb-3 me-3">
                            <span class="input-group-text" id="author-first-name">First name</span>
                            <input type="hidden" value="" name="id">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Name"
                                aria-label="Name"
                                aria-describedby="author-last-name"
                                name="first_name"/>
                        </div>
                        <div class="create-author-last-name input-group mb-3 me-3">
                            <span class="input-group-text" id="author-last-name">Last name</span>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Last name"
                                aria-label="Last name"
                                aria-describedby="author-last-name"
                                name="last_name"/>
                        </div>
                        <div class="update-book-author">
                            <span class="input-group-text" id="book-author">Book</span>
                            <select
                                class="form-control select-author"
                                name="books[]"
                                multiple="multiple"
                                aria-describedby="book-author">
                                @foreach($books as $book)
                                    <option value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating create-author-biography">
                            <span class="input-group-text" id="book-description">Biography</span>
                            <textarea
                                class="form-control"
                                placeholder="Biography"
                                id="book-description"
                                name="biography"
                                aria-label="biography"
                                aria-describedby="author-biography"
                                style="height: 100px">
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
