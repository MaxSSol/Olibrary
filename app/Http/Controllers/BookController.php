<?php

namespace App\Http\Controllers;

use App\Filters\BookFilter;
use App\Models\Books;
use Illuminate\Http\Request;

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
}
