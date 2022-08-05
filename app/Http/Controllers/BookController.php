<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request, BookFilter $filters)
    {
        $books = Book::filter($filters)->paginate(15);
        if ($request->ajax()) {
            return view('books.ajaxBooks', ['books' => $books])->render();
        }
        return view('books.books', ['books' => $books]);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $favorite = \request()->user()->favorites()->where(function (Builder $query) use ($id) {
            return $query->where('book_id', $id);
        })->exists();
        return view('books.show', ['book' => $book, 'favorite' => $favorite]);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $this->authorize('update', $request->user());
        $book = Book::findOrFail($id);
        $this->authorize('update', $book);
        if ($request->hasFile('bookFile')) {
            Storage::delete('public/books/files/' . $book->file_name);
            $request
                ->file('bookFile')
                ->storeAs('public/books/files', $request->bookFile->getClientOriginalName());
            $request['file_name'] = $request->bookFile->getClientOriginalName();
        }
        if ($request->hasFile('bookImage')) {
            Storage::delete('public/books/images/' . $book->image_name);
            $request
                ->file('bookImage')
                ->storeAs('public/books/images', $request->bookImage->getClientOriginalName());
            $request['image_name'] = $request->bookImage->getClientOriginalName();
        }
        $book->update($request->all());
        $book->authors()->detach();
        $book->authors()->attach($request->authors);
        return redirect(route('admin.book.update', $book));
    }

    public function edit($id)
    {
        $book = Book::with('authors')->findOrFail($id);
        Gate::authorize('edit-book');
        $authors = Author::all();
        return view('admin.book-update', ['book' => $book, 'authors' => $authors]);
    }

    public function create()
    {
        $authors = Author::all();
        Gate::authorize('create-book');
        return view('admin.book-create', ['authors' => $authors]);
    }

    public function store(CreateBookRequest $request)
    {
        $this->authorize('create', $request->user());
        $request['file_name'] = $request->bookFile->getClientOriginalName();
        $request['image_name'] = $request->bookImage->getClientOriginalName();
        $book = Book::create($request->all());
        $request->file('bookFile')->storeAs('public/books/files', $request->bookFile->getClientOriginalName());
        $request->file('bookImage')->storeAs('public/books/images', $request->bookImage->getClientOriginalName());
        $book->authors()->attach($request->authors);
        return redirect(route('admin.dashboard'));
    }

    public function destroy(Request $request)
    {
        $book = Book::findOrFail($request->post('id'))->delete();
        return view('admin.books-ajax', ['books' => Book::all()])->render();
    }
}
