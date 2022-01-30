<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BookDownloadController extends Controller
{
    public function download($id)
    {
        $book = Books::findOrFail($id);
        return response()->download(storage_path('app/public/books/files/' . $book->file_name));
    }
}
