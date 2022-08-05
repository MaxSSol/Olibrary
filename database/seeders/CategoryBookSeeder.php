<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::all();
        $categories = Category::all();
        $books->each(function ($book) use ($categories) {
            $book->categories()->attach(
                $categories->random(1)->pluck('id')
            );
        });
    }
}
