@extends('layouts.light')
<style>
    .square-box {
        height: 700px;
        width: auto;
    }

</style>
@section('title', 'Library Home')

@section('content')
    <x-header/>
    <main class="py-5 d-flex text-center align-items-center container square-box">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Library</h1>
            <p class="lead text-muted pt-3">
                A champion of America’s great writers and timeless works, Library of America guides readers in finding and exploring the exceptional writing that reflects the nation’s history and culture.
            </p>
            <div class="access pt-4">
                <a class="btn btn-primary me-3" href="{{route('books')}}">Check books</a>
                <a class="btn btn-primary" href="{{route('books')}}">Share books</a>
            </div>
        </div>
    </main>
@endsection
