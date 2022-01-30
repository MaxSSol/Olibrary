<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->belongsToMany(
            Books::class,
            'category_book',
            'book_id',
            'category_id'
        );
    }
}
