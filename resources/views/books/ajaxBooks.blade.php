
<section class="section-books mt-5">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
@foreach($books as $book)
    <div class="col">
        <div class="card shadow-sm">
            <img src="https://s3.amazonaws.com/loa-production-23ffs35gui41a/volumes/images/000/000/068/ecommerce/9780940450660.jpg?1446054155" class="card-img-top w-50 mx-auto" alt="not work"/>
            <div class="card-body text-center">
                <h5 class="card-title">{{$book->title}}</h5>
                <p class="card-text">{{$book->path_file}}</p>
                <a href="#" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
    @endforeach
    </div>
    <div class="mt-5 d-flex justify-content-center">
        {{ $books->withQueryString()->links() }}
    </div>
</section>
