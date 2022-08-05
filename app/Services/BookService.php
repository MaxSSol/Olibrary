<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class BookService
{
    public function uploadImage($book, $request)
    {
        Storage::delete('public/books/images/' . $book->image_name);
        $request
            ->file('bookImage')
            ->storeAs('public/books/images', $request->bookImage->getClientOriginalName());
    }

    public function uploadBook($book, $request)
    {
        Storage::delete('public/books/files/' . $book->file_name);
        $request
            ->file('bookFile')
            ->storeAs('public/books/files', $request->bookFile->getClientOriginalName());
        $request['file_name'] = $request->bookFile->getClientOriginalName();
    }
}
