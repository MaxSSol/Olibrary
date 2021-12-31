<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Http\Requests\AdminBookRequest;
use App\Http\Requests\CreateAuthorRequest;
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
        $book->fill([
            'title' => $request->title,
            'description' => $request->description,
            'path_file' => $request->bookFile !== null ? $request->bookFile->getClientOriginalName() : $book->path_file,
        ]);
        $book->save();
        if ($request->bookFile !== null) {
            $request->bookFile->storeAs('Books', $book->path_file);
        }
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
            'path_file' => $request->bookFile->getClientOriginalName(),
        ]);
        Storage::disk('local')->put($book->path_file, 'Books');
        $book->authors()->attach($request->authors);
        return redirect(route('admin.dashboard'));
    }

    public function destroy(Request $request)
    {
        $book = Books::findOrFail($request->post('id'))->delete();
        return view('admin.books-ajax', ['books' => Books::all()])->render();
    }
}
