<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'path_file'
    ];

    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'author_book',
            'book_id',
            'author_id'
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

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }
}
