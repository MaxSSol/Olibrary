<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    public function authors()
    {
        return $this->belongsToMany(
            Authors::class,
            'author_book',
            'author_id',
            'book_id'
        );
    }
    public function categories()
    {
        return $this->belongsToMany(
            Categories::class,
            'category_book',
            'book_id',
            'category_id'
        );
    }
}
