<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Books;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request, BookFilter $filters)
    {
        $books = Books::filter($filters)->paginate(15);
        if ($request->ajax()) {
            return view('books.ajaxBooks', ['books' => $books])->render();
        }
        return view('books.books', ['books' => $books]);
    }

    public function show($id)
    {
        $book = Books::findOrFail($id);
        $favorite = \request()->user()->favorites()->where(function (Builder $query) use ($id) {
            return $query->where('book_id', $id);
        })->exists();
        return view('books.show', ['book' => $book, 'favorite' => $favorite]);
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = Books::findOrFail($id);
        if ($request->bookFile !== null) {
            Storage::delete('/books/files/' . $book->file_name);
            $request->file('bookFile')->storeAs('/books/files', $request->bookFile->getClientOriginalName());
        }
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'file_name' => $request->bookFile !== null ? $request->bookFile->getClientOriginalName() : $book->file_name,
        ]);
        $book->authors()->detach();
        $book->authors()->attach($request->authors);
        return redirect(route('admin.book.update', $book));
    }

    public function edit($id)
    {
        $book = Books::with('authors')->findOrFail($id);
        $authors = Author::all();
        return view('admin.book-update', ['book' => $book, 'authors' => $authors]);
    }

    public function create()
    {
        $authors = Author::all();
        return view('admin.book-create', ['authors' => $authors]);
    }

    public function store(CreateBookRequest $request)
    {
        $book = Books::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_name' => $request->bookFile->getClientOriginalName(),
        ]);
        $request->file('bookFile')->storeAs('/books/files', $request->bookFile->getClientOriginalName());
        $book->authors()->attach($request->authors);
        return redirect(route('admin.dashboard'));
    }

    public function destroy(Request $request)
    {
        $book = Books::findOrFail($request->post('id'))->delete();
        return view('admin.books-ajax', ['books' => Books::all()])->render();
    }
}
