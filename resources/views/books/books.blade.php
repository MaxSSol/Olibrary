@extends('layouts.light')

@section('title', 'Library Books')

@section('content')
    <x-header/>
    <main class="py-5">
        <section class="filter">
            <div class="sort-btn d-flex justify-content-between align-items-center border-top border-bottom">
                <div class="sort-btn-buttons d-flex align-items-center py-2">
                    <p class="fw-bold">Filters</p>
                    <button type="button" class="mx-3 sort-title-button btn btn-sm btn-outline-primary" data-sort="asc">Name A-Z</button>
                    <button type="button" class="sort-title-button btn btn-sm btn-outline-primary" data-sort="desc">Name Z-A</button>

                </div>
                <div class="sort-btn-search">
                    <input class="form-control sort-search" type="text" placeholder="Search" data-search="title" aria-label="Search">
                </div>
            </div>
        </section>
        <section class="section-books mt-5">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($books as $book)
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="https://s3.amazonaws.com/loa-production-23ffs35gui41a/volumes/images/000/000/068/ecommerce/9780940450660.jpg?1446054155" class="card-img-top w-50 mx-auto" alt="not work"/>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$book->title}}</h5>
                            <p class="card-text">{{$book->path_file}}</p>
                            <a href="{{route('books.show', ['id' => $book->id])}}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-5 d-flex justify-content-center">
            {{ $books->withQueryString()->links() }}
            </div>
        </section>
    </main>
    <x-footer/>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.sort-title-button').click(function () {
                if ('{{request('categoryId')}}' !== '') {
                    var categoryId = '{{request('categoryId')}}'
                }
                let sort = $(this).data('sort')
                $.ajax({
                    url: "{{route('books.books')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        categoryId: categoryId,
                        sortByTitle: sort
                    },
                    success: (data) => {
                        $('.section-books').html(data)
                    },
                })
            })
            $('.sort-search').change(function () {
                let sort = $(this).val()
                $.ajax({
                    url: "{{route('books.books')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    data: {
                        search: sort
                    },
                    success: (data) => {
                        $('.section-books').html(data)
                    },
                })
            })
        })
    </script>
@endsection

