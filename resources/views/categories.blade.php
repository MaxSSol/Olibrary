@extends('layouts.light')

@section('title', 'Library Books')

@section('content')
    <x-header/>
    <main class="py-3">
        <section class="mt-2">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($categories as $category)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://s3.amazonaws.com/loa-production-23ffs35gui41a/volumes/images/000/000/068/ecommerce/9780940450660.jpg?1446054155" class="card-img-top w-50 mx-auto" alt="not work"/>
                            <div class="card-body text-center">
                                <h5 class="card-title">{{$category->title}}</h5>
                                <p class="card-text">{{$category->description}}</p>
                                <a href="{{route('books.books', ['categoryId' => $category->id])}}" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
        </section>
    </main>
    <x-footer/>
@endsection
