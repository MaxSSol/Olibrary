<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\Categories;
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
        $books = Books::all();
        $categories = Categories::all();
        $books->each(function ($book) use ($categories) {
            $book->categories()->attach(
                $categories->random(1)->pluck('id')
            );
        });
    }
}
