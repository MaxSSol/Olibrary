<table class="table text-center">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr class="book" data-target="{{$book->id}}">
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$book->title}}</td>
            <td class="text-start">{{$book->description}}</td>
            <td class="d-flex">
                <a type="button" class="btn btn-primary me-2" href="{{route('admin.book.update', $book)}}">
                    <img src="https://img.icons8.com/ios-filled/20/000000/update-left-rotation.png"/>
                </a>
                <button class="btn btn-danger book-delete" data-book="{{$book->id}}">
                    <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
