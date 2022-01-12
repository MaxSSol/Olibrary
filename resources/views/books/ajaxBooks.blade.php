<section class="section-books mt-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($books as $book)
            <div class="col-3">
                <div class="card shadow-sm" style="height: 600px; width: 250px;">
                    <img style="height: 400px; width: 250px"
                         src="{{ asset('storage/books/images/' . $book->image_name) }}"/>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$book->title}}</h5>
                        <a href="{{route('books.show', $book)}}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-5 d-flex justify-content-center">
        {{ $books->withQueryString()->links() }}
    </div>
</section>
