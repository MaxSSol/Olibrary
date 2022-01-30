<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Books;
use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = Books::all();
        $authors = Author::all();
        $authors->each(function ($author) use ($books) {
            $author->books()->attach(
                $books->random(1)->pluck('id')
            );
        });
    }
}
