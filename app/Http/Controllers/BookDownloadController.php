<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookDownloadController extends Controller
{
    public function download($id)
    {
        $book = Book::findOrFail($id);
        return response()->download(storage_path('app/public/books/files/' . $book->file_name));
    }
}
