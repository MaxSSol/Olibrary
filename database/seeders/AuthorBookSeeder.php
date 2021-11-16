<?php

namespace Database\Seeders;

use App\Models\Authors;
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
        $authors = Authors::all();
        $authors->each(function ($author) use ($books) {
            $author->books()->attach(
                $books->random(1)->pluck('id')
            );
        });
    }
}
